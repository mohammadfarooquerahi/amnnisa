<?php
/**
 * Amnnisa Form Handler, Admin Submissions Manager & SMTP Dispatcher
 * Handles AJAX form submissions, sends verified emails to admin via wp_mail(),
 * provides an Admin Submissions Dashboard, Admin Bar shortcuts, Dashboard Widget,
 * and built-in SMTP delivery configuration.
 *
 * @package Amannisa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Configure PHPMailer for Custom SMTP when enabled in Customizer
 */
function amannisa_setup_phpmailer( $phpmailer ) {
    $smtp_enabled = get_theme_mod( 'smtp_enabled', 0 );
    if ( ! $smtp_enabled ) {
        return;
    }

    $host       = get_theme_mod( 'smtp_host', 'smtp.gmail.com' );
    $port       = (int) get_theme_mod( 'smtp_port', 587 );
    $encryption = get_theme_mod( 'smtp_encryption', 'tls' );
    $username   = get_theme_mod( 'smtp_username', 'amnnisafoundation@gmail.com' );
    $password   = get_theme_mod( 'smtp_password', '' );
    $from_email = get_theme_mod( 'smtp_from_email', 'amnnisafoundation@gmail.com' );
    $from_name  = get_theme_mod( 'smtp_from_name', 'Amnnisa Platform' );

    $phpmailer->isSMTP();
    $phpmailer->Host       = ! empty( $host ) ? $host : 'smtp.gmail.com';
    $phpmailer->SMTPAuth   = ! empty( $password );
    $phpmailer->Port       = $port > 0 ? $port : 587;
    $phpmailer->Username   = $username;
    $phpmailer->Password   = $password;
    $phpmailer->SMTPSecure = ( $encryption === 'ssl' ) ? 'ssl' : 'tls';

    if ( ! empty( $from_email ) && is_email( $from_email ) ) {
        $phpmailer->From     = $from_email;
        $phpmailer->FromName = ! empty( $from_name ) ? $from_name : 'Amnnisa Platform';
    }
}
add_action( 'phpmailer_init', 'amannisa_setup_phpmailer' );

/**
 * Capture wp_mail failures for diagnostics
 */
function amannisa_capture_mail_error( $wp_error ) {
    if ( is_wp_error( $wp_error ) ) {
        update_option( 'amannisa_last_mail_error', array(
            'time'    => current_time( 'mysql' ),
            'message' => $wp_error->get_error_message(),
        ) );
    }
}
add_action( 'wp_mail_failed', 'amannisa_capture_mail_error' );

/**
 * Handle AJAX Form Submission (both logged-in and guest visitors)
 */
function amannisa_handle_form_submission() {
    // 1. Anti-Spam Honeypot Verification
    if ( ! empty( $_POST['website_url'] ) ) {
        // Silently drop bot spam without raising alarm
        wp_send_json_success( array(
            'message' => __( 'Thank you! Your request has been received.', 'amannisa' ),
            'ref_id'  => 'AN-BOT-FILTERED'
        ) );
        exit;
    }

    // 2. Transient-Based Rate Limiting (Anti-DDoS / Flooding)
    $client_ip  = sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' );
    $rate_key   = 'amannisa_rate_' . md5( $client_ip );
    $rate_count = (int) get_transient( $rate_key );

    if ( $rate_count >= 8 ) {
        wp_send_json_error( array(
            'message' => __( 'Too many submissions received from this connection. For safety, please wait a few minutes before submitting again.', 'amannisa' )
        ) );
        exit;
    }
    set_transient( $rate_key, $rate_count + 1, 10 * MINUTE_IN_SECONDS );

    // 3. Security Nonce Check with Host Fallback
    $nonce_valid = isset( $_POST['security'] ) && wp_verify_nonce( $_POST['security'], 'amannisa_form_nonce' );
    if ( ! $nonce_valid ) {
        // If nonce failed (e.g. aggressive page caching), verify request origin
        $referer = wp_get_referer();
        $home    = home_url();
        if ( ! $referer || strpos( $referer, $home ) === false ) {
            wp_send_json_error( array(
                'message' => __( 'Security verification failed. Please refresh the page and try again.', 'amannisa' )
            ) );
        }
    }

    $form_type = isset( $_POST['form_type'] ) ? sanitize_text_field( $_POST['form_type'] ) : 'Contact Inquiry';
    $is_anon   = isset( $_POST['_anon'] ) && ( $_POST['_anon'] === 'true' || $_POST['_anon'] === '1' || $_POST['_anon'] === 'on' );

    // Generate unique tracking reference ID
    $ref_id = 'AN-' . date( 'Y' ) . '-' . strtoupper( wp_generate_password( 5, false, false ) );

    // Collect & sanitize fields
    $fields       = array();
    $user_name    = '';
    $user_contact = '';
    $urgency      = '';

    foreach ( $_POST as $key => $value ) {
        if ( in_array( $key, array( 'action', 'security', 'form_type', '_anon', 'website_url' ), true ) ) {
            continue;
        }

        $clean_key = sanitize_text_field( $key );
        $clean_val = is_array( $value ) ? implode( ', ', array_map( 'sanitize_text_field', $value ) ) : sanitize_textarea_field( $value );

        if ( empty( trim( $clean_val ) ) ) {
            continue;
        }

        // Anonymity handling
        if ( $is_anon && preg_match( '/^(name|contact|email|phone)$/i', $clean_key ) ) {
            continue;
        }

        if ( strtolower( $clean_key ) === 'name' ) {
            $user_name = sanitize_text_field( $clean_val );
        }
        if ( in_array( strtolower( $clean_key ), array( 'contact', 'email', 'reply to' ), true ) ) {
            $user_contact = sanitize_text_field( $clean_val );
        }
        if ( strtolower( $clean_key ) === 'urgency' ) {
            $urgency = sanitize_text_field( $clean_val );
        }

        $fields[$clean_key] = $clean_val;
    }

    // Determine recipient admin email: STRICTLY prioritize amnnisafoundation@gmail.com
    $primary_email = get_theme_mod( 'contact_email', 'amnnisafoundation@gmail.com' );
    if ( empty( $primary_email ) || ! is_email( $primary_email ) ) {
        $primary_email = 'amnnisafoundation@gmail.com';
    }

    $recipients = array( $primary_email );
    $site_admin = get_option( 'admin_email' );
    if ( is_email( $site_admin ) && strtolower( $site_admin ) !== strtolower( $primary_email ) ) {
        $recipients[] = $site_admin;
    }

    // Strip CRLF characters to prevent header injection
    $user_name    = str_replace( array( "\r", "\n", "\t" ), '', $user_name );
    $user_contact = str_replace( array( "\r", "\n", "\t" ), '', $user_contact );
    $form_type    = str_replace( array( "\r", "\n", "\t" ), '', $form_type );
    $urgency      = str_replace( array( "\r", "\n", "\t" ), '', $urgency );

    // Build email subject
    $urgency_tag = ! empty( $urgency ) ? " [Urgency: {$urgency}]" : '';
    $subject     = "[Amnnisa Alert] {$form_type}{$urgency_tag} — Ref: {$ref_id}";

    // Build HTML email body
    $email_html = amannisa_build_email_template( $form_type, $ref_id, $fields, $is_anon, $urgency );

    // Set email headers
    $from_email = get_theme_mod( 'smtp_from_email', 'amnnisafoundation@gmail.com' );
    if ( ! is_email( $from_email ) ) {
        $from_email = 'amnnisafoundation@gmail.com';
    }
    $from_name = get_theme_mod( 'smtp_from_name', 'Amnnisa Platform' );

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $from_name . ' <' . $from_email . '>',
    );

    if ( ! empty( $user_contact ) && is_email( $user_contact ) && ! $is_anon ) {
        $sender_display = ! empty( $user_name ) ? $user_name : 'Amnnisa Submitter';
        $headers[]      = 'Reply-To: ' . $sender_display . ' <' . $user_contact . '>';
    }

    // Send the email via WordPress wp_mail()
    $mail_sent = wp_mail( $recipients, $subject, $email_html, $headers );

    // Store submission in WordPress database
    amannisa_save_submission( array(
        'ref_id'    => $ref_id,
        'date'      => current_time( 'mysql' ),
        'type'      => $form_type,
        'is_anon'   => $is_anon,
        'urgency'   => $urgency ?: 'Standard',
        'name'      => $is_anon ? 'Anonymous' : ( $user_name ?: 'Not specified' ),
        'contact'   => $is_anon ? 'Hidden (Anonymous)' : ( $user_contact ?: 'Not specified' ),
        'fields'    => $fields,
        'ip'        => sanitize_text_field( $_SERVER['REMOTE_ADDR'] ?? '' ),
        'mail_sent' => $mail_sent,
    ) );

    // Response message
    $success_msg = sprintf(
        __( 'Thank you! Your %s has been received securely and dispatched to the Amnnisa team. Your reference ID is %s.', 'amannisa' ),
        esc_html( $form_type ),
        '<strong>' . esc_html( $ref_id ) . '</strong>'
    );

    wp_send_json_success( array(
        'message'   => $success_msg,
        'ref_id'    => $ref_id,
        'mail_sent' => $mail_sent,
    ) );
}
add_action( 'wp_ajax_amannisa_submit_form', 'amannisa_handle_form_submission' );
add_action( 'wp_ajax_nopriv_amannisa_submit_form', 'amannisa_handle_form_submission' );

/**
 * Build Styled HTML Email Template
 */
function amannisa_build_email_template( $type, $ref_id, $fields, $is_anon, $urgency ) {
    $urgency_color = '#E8006F';
    if ( strtolower( $urgency ) === 'emergency' ) {
        $urgency_color = '#d90429';
    } elseif ( strtolower( $urgency ) === 'high' ) {
        $urgency_color = '#f72585';
    }

    $rows = '';
    foreach ( $fields as $k => $v ) {
        $rows .= '<tr>
            <td style="padding:10px 14px;border-bottom:1px solid #f0e6d6;font-weight:600;color:#333;width:32%;background:#fffdf9;">' . esc_html( $k ) . '</td>
            <td style="padding:10px 14px;border-bottom:1px solid #f0e6d6;color:#141414;line-height:1.5;">' . nl2br( esc_html( $v ) ) . '</td>
        </tr>';
    }

    $anon_banner = '';
    if ( $is_anon ) {
        $anon_banner = '<div style="background:#fff0f3;border-left:4px solid #E8006F;padding:10px 14px;margin-bottom:16px;border-radius:6px;font-size:13px;color:#8a0044;">
            🛡 <strong>Confidential Submission:</strong> The submitter chose to remain anonymous. Identity and contact details are concealed.
        </div>';
    }

    return '<!DOCTYPE html>
    <html>
    <head><meta charset="utf-8"></head>
    <body style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Helvetica,Arial,sans-serif;background:#FFF8E6;color:#141414;margin:0;padding:24px;">
        <div style="max-width:620px;margin:0 auto;background:#ffffff;border-radius:18px;overflow:hidden;box-shadow:0 6px 24px rgba(0,0,0,0.08);border:1px solid #f1e6cf;">
            <!-- Header -->
            <div style="background:#141414;padding:24px 30px;color:#ffffff;display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <h1 style="margin:0;font-size:22px;letter-spacing:-0.02em;color:#ffffff;">🌸 Amnnisa Platform</h1>
                    <p style="margin:4px 0 0;font-size:12px;color:#cfc6b4;letter-spacing:0.1em;text-transform:uppercase;">Women\'s Safety &amp; Dignity Initiative</p>
                </div>
            </div>

            <!-- Content Area -->
            <div style="padding:28px 30px;">
                <div style="margin-bottom:20px;">
                    <span style="display:inline-block;background:' . $urgency_color . ';color:#ffffff;font-size:12px;font-weight:700;padding:4px 12px;border-radius:999px;text-transform:uppercase;letter-spacing:0.08em;">
                        ' . esc_html( $type ) . '
                    </span>
                    <span style="float:right;font-size:13px;color:#6b6b76;font-family:monospace;font-weight:700;">
                        Ref: ' . esc_html( $ref_id ) . '
                    </span>
                </div>

                ' . $anon_banner . '

                <h2 style="font-size:18px;margin:0 0 16px;color:#141414;">New Submission Received</h2>
                
                <table style="width:100%;border-collapse:collapse;font-size:14px;border:1px solid #f0e6d6;border-radius:10px;overflow:hidden;">
                    <tbody>
                        ' . $rows . '
                    </tbody>
                </table>

                <div style="margin-top:24px;padding:14px;background:#fff8ee;border-radius:10px;font-size:12px;color:#6b6b76;line-height:1.5;">
                    📅 <strong>Submitted at:</strong> ' . current_time( 'F j, Y, g:i a' ) . '<br>
                    🔒 <strong>Confidentiality Policy:</strong> Please handle all reports in strict confidence according to platform protocol.
                </div>
            </div>

            <!-- Footer -->
            <div style="background:#faf5eb;padding:14px 30px;text-align:center;font-size:11px;color:#8c8273;border-top:1px solid #f1e6cf;">
                Amnnisa · Incubated at Business Incubation Center, MUET Jamshoro
            </div>
        </div>
    </body>
    </html>';
}

/**
 * Save Submission into Database (wp_options)
 */
function amannisa_save_submission( $data ) {
    $submissions = get_option( 'amannisa_form_submissions', array() );
    if ( ! is_array( $submissions ) ) {
        $submissions = array();
    }
    // Prepend new submission
    array_unshift( $submissions, $data );
    // Keep last 200 submissions
    if ( count( $submissions ) > 200 ) {
        $submissions = array_slice( $submissions, 0, 200 );
    }
    update_option( 'amannisa_form_submissions', $submissions, false );
}

/**
 * Admin Menu: Submissions Dashboard
 */
function amannisa_admin_submissions_menu() {
    $submissions = get_option( 'amannisa_form_submissions', array() );
    $count       = is_array( $submissions ) ? count( $submissions ) : 0;
    $count_badge = $count > 0 ? sprintf( ' <span class="awaiting-mod update-plugins count-%d"><span class="pending-count">%d</span></span>', $count, $count ) : '';

    add_menu_page(
        __( 'Amnnisa Submissions', 'amannisa' ),
        __( 'Submissions', 'amannisa' ) . $count_badge,
        'manage_options',
        'amannisa-submissions',
        'amannisa_render_submissions_page',
        'dashicons-email-alt',
        22
    );
}
add_action( 'admin_menu', 'amannisa_admin_submissions_menu' );

/**
 * Add Top WP Admin Bar Shortcut
 */
function amannisa_admin_bar_node( $wp_admin_bar ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $submissions = get_option( 'amannisa_form_submissions', array() );
    $count       = is_array( $submissions ) ? count( $submissions ) : 0;

    $wp_admin_bar->add_node( array(
        'id'    => 'amannisa-submissions-node',
        'title' => '🌸 Amnnisa Submissions (' . $count . ')',
        'href'  => admin_url( 'admin.php?page=amannisa-submissions' ),
        'meta'  => array(
            'title' => __( 'View all received reports and inquiries', 'amannisa' ),
        ),
    ) );
}
add_action( 'admin_bar_menu', 'amannisa_admin_bar_node', 90 );

/**
 * Add WordPress Dashboard Widget on main /wp-admin screen
 */
function amannisa_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'amannisa_dashboard_widget',
        __( '🌸 Amnnisa Platform — Recent Submissions', 'amannisa' ),
        'amannisa_render_dashboard_widget'
    );
}
add_action( 'wp_dashboard_setup', 'amannisa_add_dashboard_widget' );

function amannisa_render_dashboard_widget() {
    $submissions = get_option( 'amannisa_form_submissions', array() );
    $subs = is_array( $submissions ) ? array_slice( $submissions, 0, 5 ) : array();

    if ( empty( $subs ) ) {
        echo '<p style="color:#777;">' . esc_html__( 'No submissions received yet. When visitors fill forms on the site, they will be listed here.', 'amannisa' ) . '</p>';
        return;
    }

    echo '<ul style="margin:0;padding:0;list-style:none;">';
    foreach ( $subs as $s ) {
        $urgency_color = '#E8006F';
        if ( strtolower( $s['urgency'] ?? '' ) === 'emergency' ) {
            $urgency_color = '#d90429';
        }
        echo '<li style="padding:8px 0;border-bottom:1px solid #f0f0f1;display:flex;justify-content:space-between;align-items:center;">';
        echo '<div>';
        echo '<strong style="color:' . esc_attr( $urgency_color ) . ';">' . esc_html( $s['ref_id'] ) . '</strong> ';
        echo '<span style="background:#eee;padding:2px 6px;border-radius:3px;font-size:11px;">' . esc_html( $s['type'] ) . '</span> ';
        echo '<small style="color:#666;">by ' . esc_html( $s['name'] ) . '</small>';
        echo '</div>';
        echo '<small style="color:#999;">' . esc_html( $s['date'] ) . '</small>';
        echo '</li>';
    }
    echo '</ul>';
    echo '<p style="margin-top:12px;"><a class="button button-primary" href="' . esc_url( admin_url( 'admin.php?page=amannisa-submissions' ) ) . '">' . esc_html__( 'View All Submissions →', 'amannisa' ) . '</a></p>';
}

/**
 * Render Admin Submissions Page
 */
function amannisa_render_submissions_page() {
    $contact_email = get_theme_mod( 'contact_email', 'amnnisafoundation@gmail.com' );
    if ( empty( $contact_email ) || ! is_email( $contact_email ) ) {
        $contact_email = 'amnnisafoundation@gmail.com';
    }

    // Handle Test Email Trigger
    if ( isset( $_POST['amannisa_send_test_email'] ) && check_admin_referer( 'amannisa_test_email_action' ) ) {
        $test_subject = '[Amnnisa Test] Email Delivery Confirmation';
        $test_body    = '<div style="font-family:sans-serif;padding:20px;border-radius:12px;background:#FFF8E6;color:#141414;">
            <h2 style="color:#E8006F;">🌸 Amnnisa Email Delivery Working!</h2>
            <p>This test email confirms that your WordPress website is successfully dispatching emails to <strong>' . esc_html( $contact_email ) . '</strong>.</p>
            <p>Timestamp: ' . current_time( 'mysql' ) . '</p>
        </div>';
        $test_headers = array( 'Content-Type: text/html; charset=UTF-8' );

        $sent = wp_mail( $contact_email, $test_subject, $test_body, $test_headers );
        if ( $sent ) {
            echo '<div class="notice notice-success is-dismissible"><p><strong>✓ Success!</strong> Test email dispatched successfully to <strong>' . esc_html( $contact_email ) . '</strong>. Check your inbox (or spam folder).</p></div>';
        } else {
            $last_error = get_option( 'amannisa_last_mail_error' );
            $err_msg    = ! empty( $last_error['message'] ) ? $last_error['message'] : 'Host mail() service returned false.';
            echo '<div class="notice notice-error is-dismissible"><p><strong>✕ Delivery Warning:</strong> Could not send test email to ' . esc_html( $contact_email ) . '. Error details: <em>' . esc_html( $err_msg ) . '</em>. <br><strong>Recommendation:</strong> Configure SMTP in <em>Appearance → Customize → 12. SMTP Email Delivery</em> to use Gmail SMTP.</p></div>';
        }
    }

    // Handle Resend Action for a specific submission
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'resend' && isset( $_GET['ref'] ) && check_admin_referer( 'amannisa_resend_' . $_GET['ref'] ) ) {
        $ref_to_resend = sanitize_text_field( $_GET['ref'] );
        $subs          = get_option( 'amannisa_form_submissions', array() );
        $target_sub    = null;
        foreach ( $subs as $s ) {
            if ( $s['ref_id'] === $ref_to_resend ) {
                $target_sub = $s;
                break;
            }
        }

        if ( $target_sub ) {
            $sub_subject = "[Amnnisa Alert Resend] {$target_sub['type']} — Ref: {$target_sub['ref_id']}";
            $sub_body    = amannisa_build_email_template( $target_sub['type'], $target_sub['ref_id'], $target_sub['fields'], $target_sub['is_anon'], $target_sub['urgency'] );
            $headers     = array( 'Content-Type: text/html; charset=UTF-8' );
            $resend_sent = wp_mail( $contact_email, $sub_subject, $sub_body, $headers );

            if ( $resend_sent ) {
                echo '<div class="notice notice-success is-dismissible"><p><strong>✓ Email resent successfully</strong> for submission ' . esc_html( $ref_to_resend ) . ' to ' . esc_html( $contact_email ) . '.</p></div>';
            } else {
                echo '<div class="notice notice-error is-dismissible"><p><strong>✕ Resend failed.</strong> Please verify SMTP credentials in Appearance → Customize.</p></div>';
            }
        }
    }

    // Handle Delete Action
    if ( isset( $_GET['action'] ) && $_GET['action'] === 'delete' && isset( $_GET['ref'] ) && check_admin_referer( 'amannisa_delete_sub_' . $_GET['ref'] ) ) {
        $ref_to_delete = sanitize_text_field( $_GET['ref'] );
        $subs          = get_option( 'amannisa_form_submissions', array() );
        $new_subs      = array();
        foreach ( $subs as $s ) {
            if ( $s['ref_id'] !== $ref_to_delete ) {
                $new_subs[] = $s;
            }
        }
        update_option( 'amannisa_form_submissions', $new_subs, false );
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Submission deleted successfully.', 'amannisa' ) . '</p></div>';
    }

    $submissions = get_option( 'amannisa_form_submissions', array() );
    $last_error  = get_option( 'amannisa_last_mail_error' );
    $customizer_smtp = admin_url( 'customize.php?autofocus[section]=amannisa_smtp_section' );
    ?>
    <div class="wrap">
        <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:12px;">
            <h1 style="display:flex;align-items:center;gap:10px;margin:0;">
                <span>🌸</span> <?php esc_html_e( 'Amnnisa Form Submissions & Case Reports', 'amannisa' ); ?>
            </h1>

            <div style="display:flex;gap:10px;align-items:center;">
                <form method="post" style="display:inline-block;">
                    <?php wp_nonce_field( 'amannisa_test_email_action' ); ?>
                    <button type="submit" name="amannisa_send_test_email" class="button button-secondary">
                        ✉ <?php printf( esc_html__( 'Send Test Email to %s', 'amannisa' ), esc_html( $contact_email ) ); ?>
                    </button>
                </form>

                <a href="<?php echo esc_url( $customizer_smtp ); ?>" class="button button-primary">
                    ⚙ <?php esc_html_e( 'Configure SMTP Settings', 'amannisa' ); ?>
                </a>
            </div>
        </div>

        <p class="description">
            <?php printf(
                esc_html__( 'All submissions from your website (Case Reports, Ideas, Contact Inquiries, Join applications) are securely received, emailed to %s, and recorded below.', 'amannisa' ),
                '<strong>' . esc_html( $contact_email ) . '</strong>'
            ); ?>
        </p>

        <?php if ( ! empty( $last_error['message'] ) ) : ?>
        <div class="notice notice-warning" style="margin-top:14px;border-left-color:#f59e0b;">
            <p>
                <strong>⚠️ Mail Delivery Notice:</strong> Most recent mail issue logged at <em><?php echo esc_html( $last_error['time'] ?? '' ); ?></em>: <br>
                <code><?php echo esc_html( $last_error['message'] ); ?></code><br>
                <em>Tip: Ensure SMTP is enabled in <a href="<?php echo esc_url( $customizer_smtp ); ?>">SMTP Settings</a> using your Gmail account & 16-character Google App Password so emails are delivered straight to inbox.</em>
            </p>
        </div>
        <?php endif; ?>

        <hr style="margin-top:16px;">

        <?php if ( empty( $submissions ) ) : ?>
            <div style="background:#fff;border:1px solid #ccd0d4;padding:40px;text-align:center;border-radius:12px;margin-top:20px;">
                <span class="dashicons dashicons-email" style="font-size:54px;width:54px;height:54px;color:#aaa;"></span>
                <h3 style="color:#333;margin:12px 0 6px;"><?php esc_html_e( 'No submissions received yet.', 'amannisa' ); ?></h3>
                <p style="color:#666;max-width:540px;margin:0 auto 16px;">
                    <?php printf(
                        esc_html__( 'When visitors fill out any form on your site (Case Report, Contact, Join the Mission, Share an Idea, or Track Status), their submissions will instantly appear here and be emailed to %s.', 'amannisa' ),
                        esc_html( $contact_email )
                    ); ?>
                </p>
                <form method="post" style="display:inline-block;">
                    <?php wp_nonce_field( 'amannisa_test_email_action' ); ?>
                    <button type="submit" name="amannisa_send_test_email" class="button button-primary">
                        ✉ <?php esc_html_e( 'Send a Test Email Now', 'amannisa' ); ?>
                    </button>
                </form>
            </div>
        <?php else : ?>
            <div style="overflow-x:auto;width:100%;background:#ffffff;border:1px solid #ccd0d4;border-radius:8px;margin-top:20px;box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                <table class="wp-list-table widefat striped" style="border:none;table-layout:auto !important;width:100%;min-width:980px;">
                    <thead>
                        <tr>
                            <th style="white-space:nowrap;width:130px;padding:12px 14px;"><?php esc_html_e( 'Reference ID', 'amannisa' ); ?></th>
                            <th style="white-space:nowrap;width:150px;padding:12px 14px;"><?php esc_html_e( 'Date & Time', 'amannisa' ); ?></th>
                            <th style="white-space:nowrap;width:160px;padding:12px 14px;"><?php esc_html_e( 'Type', 'amannisa' ); ?></th>
                            <th style="white-space:nowrap;width:160px;padding:12px 14px;"><?php esc_html_e( 'Submitter', 'amannisa' ); ?></th>
                            <th style="white-space:nowrap;width:100px;padding:12px 14px;"><?php esc_html_e( 'Urgency', 'amannisa' ); ?></th>
                            <th style="min-width:320px;padding:12px 14px;"><?php esc_html_e( 'Details & Message', 'amannisa' ); ?></th>
                            <th style="white-space:nowrap;width:90px;padding:12px 14px;"><?php esc_html_e( 'Status', 'amannisa' ); ?></th>
                            <th style="white-space:nowrap;width:120px;padding:12px 14px;"><?php esc_html_e( 'Actions', 'amannisa' ); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $submissions as $sub ) :
                            $del_url    = wp_nonce_url( admin_url( 'admin.php?page=amannisa-submissions&action=delete&ref=' . $sub['ref_id'] ), 'amannisa_delete_sub_' . $sub['ref_id'] );
                            $resend_url = wp_nonce_url( admin_url( 'admin.php?page=amannisa-submissions&action=resend&ref=' . $sub['ref_id'] ), 'amannisa_resend_' . $sub['ref_id'] );
                        ?>
                        <tr>
                            <td style="white-space:nowrap;">
                                <strong style="color:#E8006F;font-family:monospace;font-size:13px;"><?php echo esc_html( $sub['ref_id'] ); ?></strong>
                            </td>
                            <td style="white-space:nowrap;"><?php echo esc_html( $sub['date'] ); ?></td>
                            <td style="white-space:nowrap;">
                                <span style="background:#f0f0f1;padding:4px 8px;border-radius:4px;font-weight:600;font-size:12px;white-space:nowrap;">
                                    <?php echo esc_html( $sub['type'] ); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ( ! empty( $sub['is_anon'] ) ) : ?>
                                    <span style="color:#8a0044;font-weight:bold;white-space:nowrap;">🛡 Anonymous</span>
                                <?php else : ?>
                                    <strong><?php echo esc_html( $sub['name'] ); ?></strong><br>
                                    <small style="color:#666;"><?php echo esc_html( $sub['contact'] ); ?></small>
                                <?php endif; ?>
                            </td>
                            <td style="white-space:nowrap;">
                                <?php
                                $urg = $sub['urgency'] ?? 'Standard';
                                $urg_badge = '#666';
                                if ( strtolower( $urg ) === 'emergency' ) {
                                    $urg_badge = '#d90429';
                                } elseif ( strtolower( $urg ) === 'high' ) {
                                    $urg_badge = '#E8006F';
                                }
                                ?>
                                <span style="color:<?php echo esc_attr( $urg_badge ); ?>;font-weight:bold;white-space:nowrap;">
                                    <?php echo esc_html( $urg ); ?>
                                </span>
                            </td>
                            <td style="min-width:320px;">
                                <details style="width:100%;">
                                    <summary style="cursor:pointer;color:#0073aa;font-weight:600;outline:none;white-space:nowrap;">
                                        <?php
                                        $msg_preview = $sub['fields']['What happened'] ?? ( $sub['fields']['Message'] ?? ( $sub['fields']['Idea'] ?? 'View submitted details' ) );
                                        echo esc_html( wp_trim_words( $msg_preview, 10 ) );
                                        ?>
                                    </summary>
                                    <div style="background:#f9f9f9;padding:12px;margin-top:8px;border-radius:6px;border:1px solid #ddd;font-size:13px;white-space:normal;line-height:1.5;">
                                        <?php foreach ( $sub['fields'] as $k => $v ) : ?>
                                            <p style="margin:4px 0;"><strong><?php echo esc_html( $k ); ?>:</strong> <?php echo nl2br( esc_html( $v ) ); ?></p>
                                        <?php endforeach; ?>
                                        <p style="margin:6px 0 0;color:#888;font-size:11px;">IP: <?php echo esc_html( $sub['ip'] ?? 'Unknown' ); ?></p>
                                    </div>
                                </details>
                            </td>
                            <td style="white-space:nowrap;">
                                <?php if ( ! empty( $sub['mail_sent'] ) ) : ?>
                                    <span style="color:#2a9d8f;font-weight:bold;white-space:nowrap;">✓ Sent</span>
                                <?php else : ?>
                                    <span style="color:#e76f51;font-weight:600;white-space:nowrap;" title="Saved in database, host mail was deferred or disabled">Logged</span>
                                <?php endif; ?>
                            </td>
                            <td style="white-space:nowrap;">
                                <a href="<?php echo esc_url( $resend_url ); ?>" class="button button-small" style="margin-right:4px;">Resend</a>
                                <a href="<?php echo esc_url( $del_url ); ?>" onclick="return confirm('Delete this record?');" style="color:#a00;font-size:12px;">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
