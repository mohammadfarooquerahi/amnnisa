<?php
/**
 * Main Interactive Platform Content Template Part
 * Fully editable via WordPress Customizer (Appearance -> Customize)
 * and Team Members Custom Post Type.
 *
 * @package Amnnisa
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Hero variables
$hero_pill         = amannisa_get_option( 'hero_pill', '🛡 Women\'s Safety & Empowerment Initiative' );
$hero_title_1      = amannisa_get_option( 'hero_title_1', 'Dignity.' );
$hero_title_2      = amannisa_get_option( 'hero_title_2', 'Safety.' );
$hero_title_3      = amannisa_get_option( 'hero_title_3', 'Innovation.' );
$hero_description  = amannisa_get_option( 'hero_description', 'Amnnisa secures women\'s dignity and empowers women — guiding them on how to respond to threats and harassment through legal guidance, technical guidance, moral support, and data-driven collaboration.' );
$hero_btn1_text    = amannisa_get_option( 'hero_btn1_text', 'Report a case now →' );
$hero_btn1_link    = amannisa_get_option( 'hero_btn1_link', '#report' );
$hero_btn2_text    = amannisa_get_option( 'hero_btn2_text', 'Learn about us' );
$hero_btn2_link    = amannisa_get_option( 'hero_btn2_link', '#about' );
$hero_image        = amannisa_get_option( 'hero_image' ) ?: amannisa_asset( 'images/hero.jpg' );
$hero_overlay_text = amannisa_get_option( 'hero_overlay_text', 'Women\'s Dignity & Safety Platform' );

// 2. Pillars variables
$pillars_pill  = amannisa_get_option( 'pillars_pill', 'Our Pillars' );
$pillars_title = amannisa_get_option( 'pillars_title', 'What Amnnisa stands for' );

// 3. Take Action variables
$action_pill     = amannisa_get_option( 'action_pill', 'Take Action' );
$action_title    = amannisa_get_option( 'action_title', 'Four ways to engage with Amnnisa' );
$action_subtitle = amannisa_get_option( 'action_subtitle', 'Whether you need help, want to contribute ideas, or stand with our mission.' );
$track_title     = amannisa_get_option( 'track_title', 'Track your report' );
$track_desc      = amannisa_get_option( 'track_desc', 'Already submitted? Email us your reference details to check the status and get our response.' );
$track_btn_text  = amannisa_get_option( 'track_btn_text', 'Track status →' );
$track_link      = amannisa_get_option( 'track_link', '#involved:track' );

// 4. Founder Quote variables
$quote_text     = amannisa_get_option( 'quote_text', '"Amnnisa is not a charity we offer women — it is the infrastructure of dignity they were always owed."' );
$quote_author   = amannisa_get_option( 'quote_author', 'HOMAIR NISAR — FOUNDER, AMANNISA' );
$quote_btn_text = amannisa_get_option( 'quote_btn_text', 'Read our story →' );
$quote_btn_link = amannisa_get_option( 'quote_btn_link', '#about' );

// 5. Steps variables
$steps_pill  = amannisa_get_option( 'steps_pill', 'How it works' );
$steps_title = amannisa_get_option( 'steps_title', 'Three simple steps' );

// 6. Hotlines variables
$hotline_title    = amannisa_get_option( 'hotline_title', 'In immediate danger? Call for help now.' );
$hotline_subtitle = amannisa_get_option( 'hotline_subtitle', 'Amnnisa is not an emergency service. If you are at risk right now, contact the authorities first.' );

// 7. Stats variables
$stat_1_val = amannisa_get_option( 'stat_1_val', 'MUET' );
$stat_1_lbl = amannisa_get_option( 'stat_1_lbl', 'Business Incubation Center' );
$stat_2_val = amannisa_get_option( 'stat_2_val', '100%' );
$stat_2_lbl = amannisa_get_option( 'stat_2_lbl', 'Private & confidential submissions' );
$stat_3_val = amannisa_get_option( 'stat_3_val', '1-click' );
$stat_3_lbl = amannisa_get_option( 'stat_3_lbl', 'To report from anywhere on the site' );
$incubation_text  = amannisa_get_option( 'incubation_text', 'Incubated at' );
$incubation_image = amannisa_get_option( 'incubation_image' ) ?: amannisa_asset( 'images/bic-incubator.jpg' );

// 8. About Us variables
$about_pill  = amannisa_get_option( 'about_pill', 'About Us' );
$about_title = amannisa_get_option( 'about_title', 'Securing women\'s dignity' );
$about_desc  = amannisa_get_option( 'about_desc', 'Amnnisa is a women\'s safety and empowerment initiative guiding women on how to respond to threats and harassment through legal, technical, and moral support. Founded by Homair Nisar and incubated at the MUET Business Incubation Center, Jamshoro. We combine empathetic guidance, technical countermeasures, and data-backed advocacy so no woman feels alone or unprotected.' );

// 9. Founder spotlight
$team_pill        = amannisa_get_option( 'team_pill', 'Our Team' );
$team_title       = amannisa_get_option( 'team_title', 'The people behind Amnnisa' );
$team_subtitle    = amannisa_get_option( 'team_subtitle', 'Students and professionals working together for women\'s dignity and safety.' );
$founder_badge    = amannisa_get_option( 'founder_badge', 'Founder & Vision' );
$founder_name     = amannisa_get_option( 'founder_name', 'Homair Nisar' );
$founder_role     = amannisa_get_option( 'founder_role', 'Founder, Amnnisa' );
$founder_bio      = amannisa_get_option( 'founder_bio', 'Homair Nisar founded Amnnisa with a single conviction: that every woman deserves to walk through life with dignity, safety, and the full backing of her community. As a student-leader incubated at the MUET Business Incubation Center, he envisions Amnnisa as a bridge between immediate protection and systemic change — leveraging technology, legal literacy, and empathetic care to rewrite how society responds to harassment.' );
$founder_image    = amannisa_get_option( 'founder_image' ) ?: amannisa_asset( 'images/founder-homair-nisar.jpg' );

// 10. Contact variables
$contact_pill             = amannisa_get_option( 'contact_pill', 'Contact' );
$contact_title            = amannisa_get_option( 'contact_title', 'Get in touch' );
$contact_email            = amannisa_get_option( 'contact_email', 'amnnisafoundation@gmail.com' );
$contact_instagram        = amannisa_get_option( 'contact_instagram', 'https://www.instagram.com/amannisa_pk' );
$contact_instagram_handle = amannisa_get_option( 'contact_instagram_handle', '@amannisa_pk' );
$contact_whatsapp         = amannisa_get_option( 'contact_whatsapp', 'https://whatsapp.com/channel/0029Vb7sh2jI7BeKLp1uf13O' );
$contact_location         = amannisa_get_option( 'contact_location', 'Business Incubation Center, Mehran University of Engineering and Technology (MUET), Jamshoro' );
?>

<!-- ==========================================
     PAGE 1: HOME
     ========================================== -->
<div class="pg on" id="p-home">
    <div class="wrap hero">
        <div>
            <span class="pill"><?php echo esc_html( $hero_pill ); ?></span>
            <h1><?php echo esc_html( $hero_title_1 ); ?><br><span><?php echo esc_html( $hero_title_2 ); ?></span><br><?php echo esc_html( $hero_title_3 ); ?></h1>
            <p><?php echo esc_html( $hero_description ); ?></p>
            <div class="hero-btns">
                <a class="btn" href="<?php echo esc_url( $hero_btn1_link ); ?>"><?php echo esc_html( $hero_btn1_text ); ?></a>
                <a class="btn o" href="<?php echo esc_url( $hero_btn2_link ); ?>"><?php echo esc_html( $hero_btn2_text ); ?></a>
            </div>
        </div>

        <div class="photo-card">
            <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $hero_overlay_text ); ?>" fetchpriority="high" loading="eager" decoding="async" width="600" height="750">
            <div class="photo-card-overlay">
                <span><?php echo esc_html( $hero_overlay_text ); ?></span>
            </div>
        </div>
    </div>

    <!-- 5 Pillars Section -->
    <section class="dark">
        <div class="wrap tc">
            <span class="pill"><?php echo esc_html( $pillars_pill ); ?></span>
            <h2><?php echo esc_html( $pillars_title ); ?></h2>
            
            <div class="g g5" style="text-align: left; margin-top: 36px;">
                <?php
                $default_pillars = array(
                    1 => array( '🛡', 'Secure', 'Women\'s safety through guidance and technology.' ),
                    2 => array( '💗', 'Dignity', 'Every interaction respects privacy and the individual.' ),
                    3 => array( '💡', 'Empower', 'Through innovation, education, and community.' ),
                    4 => array( '⚖', 'Guide', 'Legal, technical, and moral support in one place.' ),
                    5 => array( '🤝', 'Collaborate', 'Universities, organizations, and legal-tech partners together.' ),
                );
                for ( $i = 1; $i <= 5; $i++ ) :
                    $p_icon  = amannisa_get_option( "pillar_{$i}_icon", $default_pillars[$i][0] );
                    $p_title = amannisa_get_option( "pillar_{$i}_title", $default_pillars[$i][1] );
                    $p_desc  = amannisa_get_option( "pillar_{$i}_desc", $default_pillars[$i][2] );
                ?>
                <div class="pc">
                    <div class="ic"><?php echo esc_html( $p_icon ); ?></div>
                    <h3><?php echo esc_html( $p_title ); ?></h3>
                    <p><?php echo esc_html( $p_desc ); ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- 4 Action Cards Section -->
    <section>
        <div class="wrap">
            <div class="tc">
                <span class="pill" style="background:#ffe6e6;color:#8a0044"><?php echo esc_html( $action_pill ); ?></span>
                <h2><?php echo esc_html( $action_title ); ?></h2>
                <p style="color:var(--mut);max-width:580px;margin:0 auto 36px">
                    <?php echo esc_html( $action_subtitle ); ?>
                </p>
            </div>

            <div class="g g4">
                <?php
                $default_cards = array(
                    1 => array( '💡', 'Share an Idea', 'Propose an initiative, feature, or solution.', '#involved:idea', 'c1' ),
                    2 => array( '🛡', 'Report a Case', 'Report harassment or threats — anonymously if you choose.', '#involved:case', 'c2' ),
                    3 => array( '👥', 'Join the Mission', 'Volunteer, partner, or contribute your skills.', '#involved:join', 'c3' ),
                    4 => array( '♡', 'Donate', 'Support Amnnisa — portal coming soon.', '#involved:donate', 'c4' ),
                );
                for ( $i = 1; $i <= 4; $i++ ) :
                    $c_icon  = amannisa_get_option( "card_{$i}_icon", $default_cards[$i][0] );
                    $c_title = amannisa_get_option( "card_{$i}_title", $default_cards[$i][1] );
                    $c_desc  = amannisa_get_option( "card_{$i}_desc", $default_cards[$i][2] );
                    $c_link  = amannisa_get_option( "card_{$i}_link", $default_cards[$i][3] );
                    $c_class = $default_cards[$i][4];
                ?>
                <a class="card <?php echo esc_attr( $c_class ); ?>" href="<?php echo esc_url( $c_link ); ?>">
                    <div class="ic"><?php echo esc_html( $c_icon ); ?></div>
                    <h3><?php echo esc_html( $c_title ); ?></h3>
                    <p><?php echo esc_html( $c_desc ); ?></p>
                    <b class="a"><?php esc_html_e( 'Get started →', 'amannisa' ); ?></b>
                </a>
                <?php endfor; ?>
            </div>

            <!-- Incident tracking row -->
            <a class="track" href="<?php echo esc_url( $track_link ); ?>">
                <div class="ic">
                    <?php
                    $track_img = amannisa_get_option( 'track_icon_image' );
                    if ( ! empty( $track_img ) ) :
                    ?>
                        <img src="<?php echo esc_url( $track_img ); ?>" alt="Track" width="36" height="36">
                    <?php else : ?>
                        📋
                    <?php endif; ?>
                </div>
                <div class="track-content">
                    <h3><?php echo esc_html( $track_title ); ?></h3>
                    <span style="color:var(--mut)"><?php echo esc_html( $track_desc ); ?></span>
                </div>
                <b class="a" style="color:var(--pink)"><?php echo esc_html( $track_btn_text ); ?></b>
            </a>
        </div>
    </section>

    <!-- Founder Quote Section -->
    <section class="quote">
        <div class="wrap">
            <div class="h" style="font-size:64px;color:var(--pink);line-height:1">”</div>
            <h2><?php echo esc_html( $quote_text ); ?></h2>
            <small style="letter-spacing:.08em;font-weight:700;color:var(--mut);text-transform:uppercase">
                <?php echo esc_html( $quote_author ); ?>
            </small>
            <br><br>
            <a class="btn o" href="<?php echo esc_url( $quote_btn_link ); ?>"><?php echo esc_html( $quote_btn_text ); ?></a>
        </div>
    </section>

    <!-- Three simple steps -->
    <section style="background:#fff3e2">
        <div class="wrap tc">
            <span class="pill" style="background:#ffe6e6;color:#8a0044"><?php echo esc_html( $steps_pill ); ?></span>
            <h2><?php echo esc_html( $steps_title ); ?></h2>

            <div class="g g3" style="text-align:left;margin-top:34px">
                <?php
                $step_classes = array( 1 => 'c2', 2 => 'c1', 3 => 'c4' );
                $default_steps = array(
                    1 => array( 'Tell us', 'Share what happened in your own words — anonymously if you choose.' ),
                    2 => array( 'Get guided', 'Our team replies with legal, technical, and moral guidance for your situation.' ),
                    3 => array( 'Stay protected', 'Your details stay private and are never shared without your consent.' ),
                );
                for ( $i = 1; $i <= 3; $i++ ) :
                    $s_title = amannisa_get_option( "step_{$i}_title", $default_steps[$i][0] );
                    $s_desc  = amannisa_get_option( "step_{$i}_desc", $default_steps[$i][1] );
                ?>
                <div class="card <?php echo esc_attr( $step_classes[$i] ); ?>" style="cursor:default">
                    <div class="ic"><?php echo esc_html( $i ); ?></div>
                    <h3><?php echo esc_html( $s_title ); ?></h3>
                    <p><?php echo esc_html( $s_desc ); ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Emergency Hotlines Notice -->
    <section style="padding: 50px 0">
        <div class="wrap">
            <div class="pc" style="background:var(--ink);border-radius:32px;padding:36px">
                <h3 style="font-size: clamp(22px, 3vw, 28px); color: #fff;"><?php echo esc_html( $hotline_title ); ?></h3>
                <p style="margin: 8px 0 24px; color: #cfc7b8;">
                    <?php echo esc_html( $hotline_subtitle ); ?>
                </p>
                <div class="g g4" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    <?php
                    $default_hotlines = array(
                        1 => array( '15', 'Police emergency' ),
                        2 => array( '1099', 'Ministry of Human Rights' ),
                        3 => array( '1122', 'Medical emergency / Rescue' ),
                        4 => array( '9911', 'Sindh Women Helpline' ),
                    );
                    for ( $i = 1; $i <= 4; $i++ ) :
                        $h_num = amannisa_get_option( "hotline_{$i}_number", $default_hotlines[$i][0] );
                        $h_lbl = amannisa_get_option( "hotline_{$i}_label", $default_hotlines[$i][1] );
                    ?>
                    <div>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $h_num ) ); ?>" style="text-decoration:none;display:inline-block;" aria-label="<?php echo esc_attr( $h_lbl . ' ' . $h_num ); ?>">
                            <b class="h" style="font-size:clamp(30px, 4vw, 36px);color:var(--pink);display:block;line-height:1;"><?php echo esc_html( $h_num ); ?></b>
                            <span style="color:#cfc7b8;display:inline-flex;align-items:center;gap:6px;margin-top:6px;"><?php echo esc_html( $h_lbl ); ?> <span style="font-size:12px;opacity:0.8;">📞</span></span>
                        </a>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats & Incubation -->
    <section>
        <div class="wrap">
            <div class="stats">
                <div>
                    <b><?php echo esc_html( $stat_1_val ); ?></b>
                    <span><?php echo esc_html( $stat_1_lbl ); ?></span>
                </div>
                <div>
                    <b><?php echo esc_html( $stat_2_val ); ?></b>
                    <span><?php echo esc_html( $stat_2_lbl ); ?></span>
                </div>
                <div>
                    <b><?php echo esc_html( $stat_3_val ); ?></b>
                    <span><?php echo esc_html( $stat_3_lbl ); ?></span>
                </div>
            </div>

            <div class="inc">
                <span><?php echo esc_html( $incubation_text ); ?></span>
                <img src="<?php echo esc_url( $incubation_image ); ?>" alt="<?php echo esc_attr( $incubation_text ); ?>" loading="lazy" decoding="async" width="220" height="70">
            </div>
        </div>
    </section>
</div>

<!-- ==========================================
     PAGE 2: ABOUT US
     ========================================== -->
<div class="pg" id="p-about">
    <div class="wrap">
        <div class="ph">
            <span class="pill"><?php echo esc_html( $about_pill ); ?></span>
            <h1><?php echo esc_html( $about_title ); ?></h1>
            <p><?php echo esc_html( $about_desc ); ?></p>
        </div>

        <div class="g g3" style="margin: 40px 0;">
            <?php
            $default_guidance = array(
                1 => array( '⚖', 'Legal guidance', 'Clear direction on rights and the steps to take under the law.' ),
                2 => array( '💻', 'Technical guidance', 'Practical help for digital safety, account security, and evidence preservation.' ),
                3 => array( '💗', 'Moral support', 'A private, respectful space to be heard without judgment or exposure.' ),
            );
            for ( $i = 1; $i <= 3; $i++ ) :
                $g_icon  = amannisa_get_option( "guidance_{$i}_icon", $default_guidance[$i][0] );
                $g_title = amannisa_get_option( "guidance_{$i}_title", $default_guidance[$i][1] );
                $g_desc  = amannisa_get_option( "guidance_{$i}_desc", $default_guidance[$i][2] );
            ?>
            <div class="pc" style="background:#fff3e8;border-color:var(--line)">
                <div class="ic"><?php echo esc_html( $g_icon ); ?></div>
                <h3><?php echo esc_html( $g_title ); ?></h3>
                <p style="color:var(--mut)"><?php echo esc_html( $g_desc ); ?></p>
            </div>
            <?php endfor; ?>
        </div>

        <!-- FAQ Accordion -->
        <div style="max-width:800px;margin:0 auto;padding-bottom:60px">
            <h2 class="tc" style="font-size:34px;margin-bottom:24px"><?php esc_html_e( 'Common questions', 'amannisa' ); ?></h2>
            
            <?php
            $default_faqs = array(
                1 => array( 'Is my report really private?', 'Yes. You can report completely anonymously, and your identity is never exposed or shared without your explicit consent.' ),
                2 => array( 'Do I need proof to report?', 'No. Proof helps strengthen your case, but you can report first and our team will guide you on how to safely gather and preserve evidence.' ),
                3 => array( 'Is Amnnisa an emergency service?', 'No. If you are in immediate physical danger, please call police emergency 15 or 1122 right away before reaching out to us.' ),
                4 => array( 'Who can join the mission?', 'Students, volunteers, lawyers, technologists, and organizations passionate about women\'s safety are welcome to apply via our Get Involved section.' ),
            );
            for ( $i = 1; $i <= 4; $i++ ) :
                $faq_q = amannisa_get_option( "faq_{$i}_q", $default_faqs[$i][0] );
                $faq_a = amannisa_get_option( "faq_{$i}_a", $default_faqs[$i][1] );
                if ( ! empty( $faq_q ) ) :
            ?>
            <details class="box">
                <summary><?php echo esc_html( $faq_q ); ?></summary>
                <p><?php echo esc_html( $faq_a ); ?></p>
            </details>
            <?php
                endif;
            endfor;
            ?>
        </div>
    </div>
</div>

<!-- ==========================================
     PAGE 3: OUR TEAM (DYNAMIC FROM WP ADMIN)
     ========================================== -->
<div class="pg" id="p-team">
    <div class="wrap">
        <div class="ph">
            <span class="pill"><?php echo esc_html( $team_pill ); ?></span>
            <h1><?php echo esc_html( $team_title ); ?></h1>
            <p><?php echo esc_html( $team_subtitle ); ?></p>
        </div>

        <!-- Founder & Vision Spotlight -->
        <div class="fnd">
            <div class="im">
                <img src="<?php echo esc_url( $founder_image ); ?>" alt="<?php echo esc_attr( $founder_name ); ?>" loading="lazy" decoding="async" width="460" height="460">
            </div>
            <div>
                <span class="pill" style="background:#ffe1e6"><?php echo esc_html( $founder_badge ); ?></span>
                <h2><?php echo esc_html( $founder_name ); ?></h2>
                <b style="color:var(--pink);display:block;margin-bottom:12px;font-size:16px;"><?php echo esc_html( $founder_role ); ?></b>
                <p><?php echo esc_html( $founder_bio ); ?></p>
            </div>
        </div>

        <!-- Dynamic Team Grid (Managed via WP Admin -> Team Members) -->
        <div class="tm" style="padding-bottom: 60px;">
            <?php
            $team_members = amannisa_get_team_members();
            foreach ( $team_members as $member ) :
            ?>
            <div class="tm-card">
                <div class="im">
                    <img src="<?php echo esc_url( $member['photo'] ); ?>" alt="<?php echo esc_attr( $member['name'] ); ?>" loading="lazy" decoding="async" width="280" height="280">
                </div>
                <h3><?php echo esc_html( $member['name'] ); ?></h3>
                <p><?php echo esc_html( $member['role'] ); ?></p>
                <?php if ( ! empty( $member['department'] ) ) : ?>
                    <small><?php echo esc_html( $member['department'] ); ?></small>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Link to Legal Support & Collaborators -->
        <div style="text-align: center; margin-top: 10px; margin-bottom: 50px;">
            <a class="btn o" href="#collaborators" style="display: inline-flex; align-items: center; gap: 8px;">
                <span>⚖</span> <?php esc_html_e( 'Meet Our Legal Team & Collaborators →', 'amannisa' ); ?>
            </a>
        </div>
    </div>
</div>

<!-- ==========================================
     PAGE 3B: LEGAL TEAM, TEAM MEMBERS & COLLABORATORS
     ========================================== -->
<div class="pg" id="p-collaborators">
    <div class="wrap" style="padding-top: 40px; padding-bottom: 70px;">
        <div class="ph">
            <span class="pill"><?php esc_html_e( 'Legal & Collaborators', 'amannisa' ); ?></span>
            <h1><?php esc_html_e( 'Legal Support, Team & Collaborators', 'amannisa' ); ?></h1>
            <p><?php esc_html_e( 'Trusted advocates, dedicated society members, and collaborative partners advancing women\'s safety together.', 'amannisa' ); ?></p>
        </div>

        <div class="amn-jump-nav" aria-label="Section Quick Links">
            <a href="#legal-team" class="amn-jump-pill">⚖ <?php esc_html_e( 'Legal Team', 'amannisa' ); ?></a>
            <a href="#team-members" class="amn-jump-pill">👥 <?php esc_html_e( 'Team Members', 'amannisa' ); ?></a>
            <a href="#collaborators-section" class="amn-jump-pill">🤝 <?php esc_html_e( 'Collaborators', 'amannisa' ); ?></a>
        </div>

        <div class="amn-wrap">
            <!-- LEGAL TEAM -->
            <section class="amn-sec" id="legal-team">
                <span class="amn-tag"><?php esc_html_e( 'Legal Team', 'amannisa' ); ?></span>
                <h2><?php esc_html_e( 'Legal Support', 'amannisa' ); ?> <span><?php esc_html_e( 'You Can Trust', 'amannisa' ); ?></span></h2>
                <p class="amn-sub"><?php esc_html_e( 'Our legal team guides survivors through reporting, rights and next steps with care, confidentiality and respect.', 'amannisa' ); ?></p>

                <div class="amn-grid amn-grid-legal">
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/rabia.png' ) ); ?>" alt="Rabia Samo" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Rabia Samo</h3>
                        <div class="amn-role"><?php esc_html_e( 'Advocate', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( '15+ years of experience handling harassment cases.', 'amannisa' ); ?></p>
                    </div>
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/afsheen.png' ) ); ?>" alt="Afsheen Naz Bhutto" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Afsheen Naz Bhutto</h3>
                        <div class="amn-role"><?php esc_html_e( 'Advocate', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( '15+ years of experience handling harassment cases.', 'amannisa' ); ?></p>
                    </div>
                </div>
                <div class="amn-note">
                    <span style="font-size: 20px; line-height: 1;">🛡️</span>
                    <div>
                        <strong><?php esc_html_e( 'Confidential & Safe', 'amannisa' ); ?>:</strong> <?php esc_html_e( 'Amnnisa provides legal guidance and support. Every report is handled confidentially.', 'amannisa' ); ?>
                    </div>
                </div>
            </section>

            <!-- TEAM MEMBERS -->
            <section class="amn-sec" id="team-members">
                <span class="amn-tag"><?php esc_html_e( 'Team Members', 'amannisa' ); ?></span>
                <h2><?php esc_html_e( 'The People', 'amannisa' ); ?> <span><?php esc_html_e( 'Behind Amnnisa', 'amannisa' ); ?></span></h2>
                <p class="amn-sub"><?php esc_html_e( 'Dedicated members who volunteer their time, skills and heart to make women safer.', 'amannisa' ); ?></p>
                <div class="amn-grid">
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/paras.png' ) ); ?>" alt="Paras Bhutto" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Paras Bhutto</h3>
                        <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                    </div>
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/huzaifa.png' ) ); ?>" alt="Huzaifa Junejo" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Huzaifa Junejo</h3>
                        <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                    </div>
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/umar.png' ) ); ?>" alt="Umar Qureshi" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Umar Qureshi</h3>
                        <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                    </div>
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/younis.png' ) ); ?>" alt="Syed Younis Shah" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Syed Younis Shah</h3>
                        <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                    </div>
                    <div class="amn-card">
                        <div class="amn-av">
                            <img src="<?php echo esc_url( amannisa_asset( 'images/aina.png' ) ); ?>" alt="Aina Syed" loading="lazy" decoding="async" width="96" height="96">
                        </div>
                        <h3>Aina Syed</h3>
                        <div class="amn-role"><?php esc_html_e( 'Team Member', 'amannisa' ); ?></div>
                        <p><?php esc_html_e( 'Official Amnnisa Society member', 'amannisa' ); ?></p>
                    </div>
                </div>
            </section>

            <!-- COLLABORATORS -->
            <section class="amn-sec" id="collaborators-section">
                <span class="amn-tag"><?php esc_html_e( 'Collaborators', 'amannisa' ); ?></span>
                <h2><?php esc_html_e( 'Our', 'amannisa' ); ?> <span><?php esc_html_e( 'Partners & Collaborators', 'amannisa' ); ?></span></h2>
                <p class="amn-sub"><?php esc_html_e( 'Organizations and institutions that support Amnnisa\'s mission.', 'amannisa' ); ?></p>
                <div class="amn-collab">
                    <div class="amn-logo">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/draftify.png' ) ); ?>" alt="Draftify" loading="lazy" decoding="async" width="170" height="85" style="border-radius:18px">
                        <b>Draftify</b>
                        <small><?php esc_html_e( 'Strategic Partner', 'amannisa' ); ?></small>
                    </div>
                    <div class="amn-logo">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/women.png' ) ); ?>" alt="WomenWheelz" loading="lazy" decoding="async" width="170" height="85">
                        <b>WomenWheelz</b>
                        <small><?php esc_html_e( 'Collaborator & Mobility Partner', 'amannisa' ); ?></small>
                    </div>
                    <div class="amn-logo">
                        <img src="<?php echo esc_url( amannisa_asset( 'images/yen.png' ) ); ?>" alt="YEN" loading="lazy" decoding="async" width="170" height="85">
                        <b>YEN</b>
                        <small><?php esc_html_e( 'Youth Empowerment Network', 'amannisa' ); ?></small>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- ==========================================
     PAGE 4: GET INVOLVED
     ========================================== -->
<div class="pg" id="p-involved">
    <div class="wrap">
        <div class="ph">
            <span class="pill"><?php esc_html_e( 'Get Involved', 'amannisa' ); ?></span>
            <h1><?php esc_html_e( 'Take a private, secure step', 'amannisa' ); ?></h1>
            <svg class="art" viewBox="0 0 600 200" role="img" aria-label="Shield and heart illustration" style="width:100%;max-width:760px;display:block;margin:28px auto 0;">
                <use href="#art"/>
            </svg>
        </div>

        <div class="tabs" id="tabs">
            <div class="tab on" data-t="idea"><?php esc_html_e( '💡 Share an Idea', 'amannisa' ); ?></div>
            <div class="tab" data-t="case"><?php esc_html_e( '🛡 Report a Case', 'amannisa' ); ?></div>
            <div class="tab" data-t="track"><?php esc_html_e( '🔍 Track your Report', 'amannisa' ); ?></div>
            <div class="tab" data-t="join"><?php esc_html_e( '👥 Join the Mission', 'amannisa' ); ?></div>
            <div class="tab" data-t="donate"><?php esc_html_e( '♡ Donate', 'amannisa' ); ?></div>
        </div>

        <div id="panels" style="padding-bottom: 70px;">
            <!-- Tab 1: Share an Idea -->
            <div class="box" data-p="idea">
                <h2><?php esc_html_e( 'Share an Idea', 'amannisa' ); ?></h2>
                <p><?php esc_html_e( 'Have an initiative, feature, or solution in mind? Share it with us — anonymously if you prefer.', 'amannisa' ); ?></p>
                <form data-sub="Amnnisa – New idea">
                    <div style="display:none!important;visibility:hidden;height:0;width:0;overflow:hidden;" aria-hidden="true"><input type="text" name="website_url" tabindex="-1" autocomplete="off" value=""></div>
                    <div class="an">
                        <span>
                            <b><?php esc_html_e( 'Submit anonymously', 'amannisa' ); ?></b>
                            <small><?php esc_html_e( 'Hide your name and contact from this submission.', 'amannisa' ); ?></small>
                        </span>
                        <input type="checkbox" name="_anon" aria-label="Submit anonymously">
                    </div>
                    <div class="fr">
                        <div>
                            <label><?php esc_html_e( 'Name (optional)', 'amannisa' ); ?></label>
                            <input name="Name" placeholder="Your name">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Email or contact', 'amannisa' ); ?></label>
                            <input name="Contact" placeholder="you@example.com">
                        </div>
                    </div>
                    <label><?php esc_html_e( 'Idea category *', 'amannisa' ); ?></label>
                    <select name="Category" required>
                        <option value=""><?php esc_html_e( 'Choose a category', 'amannisa' ); ?></option>
                        <option>New feature</option>
                        <option>Awareness / education</option>
                        <option>Partnership</option>
                        <option>Other</option>
                    </select>
                    <label><?php esc_html_e( 'Describe your idea *', 'amannisa' ); ?></label>
                    <textarea name="Idea" required placeholder="Share your idea, suggestion, or proposal in detail..."></textarea>
                    <br><br>
                    <button type="submit" class="btn full"><?php esc_html_e( 'Send idea', 'amannisa' ); ?></button>
                </form>
            </div>

            <!-- Tab 2: Report a Case -->
            <div class="box hide" data-p="case">
                <h2><?php esc_html_e( 'Report a Case', 'amannisa' ); ?></h2>
                <p><?php esc_html_e( 'Report harassment or threats. Your identity is protected by default.', 'amannisa' ); ?></p>
                <form data-sub="Amnnisa – Case report">
                    <div style="display:none!important;visibility:hidden;height:0;width:0;overflow:hidden;" aria-hidden="true"><input type="text" name="website_url" tabindex="-1" autocomplete="off" value=""></div>
                    <div class="an">
                        <span>
                            <b><?php esc_html_e( 'Report anonymously', 'amannisa' ); ?></b>
                            <small><?php esc_html_e( 'No name or contact will be included — strongly recommended.', 'amannisa' ); ?></small>
                        </span>
                        <input type="checkbox" name="_anon" aria-label="Report anonymously">
                    </div>
                    <div class="fr">
                        <div>
                            <label><?php esc_html_e( 'Name (optional)', 'amannisa' ); ?></label>
                            <input name="Name" placeholder="Your name">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Contact (optional)', 'amannisa' ); ?></label>
                            <input name="Contact" placeholder="Email or phone">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Type of incident *', 'amannisa' ); ?></label>
                            <select name="Incident type" required>
                                <option value=""><?php esc_html_e( 'Select type', 'amannisa' ); ?></option>
                                <option>Online harassment</option>
                                <option>Workplace / campus harassment</option>
                                <option>Stalking</option>
                                <option>Threats</option>
                                <option>Blackmail / extortion</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Urgency level', 'amannisa' ); ?></label>
                            <select name="Urgency">
                                <option value=""><?php esc_html_e( 'Select urgency', 'amannisa' ); ?></option>
                                <option>Low</option>
                                <option>Medium</option>
                                <option>High</option>
                                <option>Emergency</option>
                            </select>
                        </div>
                    </div>
                    <label><?php esc_html_e( 'Location / Institution (optional)', 'amannisa' ); ?></label>
                    <input name="Location" placeholder="e.g. MUET Jamshoro, Online, Workplace name">
                    <label><?php esc_html_e( 'What happened? *', 'amannisa' ); ?></label>
                    <textarea name="What happened" required placeholder="Describe the incident in your own words. Include dates and any context that helps us guide you..."></textarea>
                    <p style="font-size:13px;color:var(--mut);margin-top:8px">
                        📎 <?php esc_html_e( 'Have proof? Attach images, screenshots, or documents to the email that opens.', 'amannisa' ); ?>
                    </p>
                    <div class="conf">
                        <b><?php esc_html_e( 'Confidentiality guaranteed.', 'amannisa' ); ?></b> <?php esc_html_e( 'Reports are private. Your identity is never exposed without your explicit consent.', 'amannisa' ); ?>
                    </div>
                    <button type="submit" class="btn full"><?php esc_html_e( '🛡 Submit report securely', 'amannisa' ); ?></button>
                </form>
            </div>

            <!-- Tab 3: Track Report -->
            <div class="box hide" data-p="track">
                <h2><?php esc_html_e( 'Track your private thread', 'amannisa' ); ?></h2>
                <p><?php esc_html_e( 'Enter the reference details from your submission. We\'ll email you the status and any replies from our team.', 'amannisa' ); ?></p>
                <form data-sub="Amnnisa – Status request">
                    <div style="display:none!important;visibility:hidden;height:0;width:0;overflow:hidden;" aria-hidden="true"><input type="text" name="website_url" tabindex="-1" autocomplete="off" value=""></div>
                    <label><?php esc_html_e( 'Your reference (or the date and type of your report)', 'amannisa' ); ?></label>
                    <input name="Reference" required placeholder="AN-XXXX-XXXX">
                    <label><?php esc_html_e( 'Your email *', 'amannisa' ); ?></label>
                    <input type="email" name="Reply to" required placeholder="you@example.com">
                    <br><br>
                    <button type="submit" class="btn full"><?php esc_html_e( 'Request update', 'amannisa' ); ?></button>
                </form>
            </div>

            <!-- Tab 4: Join the Mission -->
            <div class="box hide" data-p="join">
                <h2><?php esc_html_e( 'Join the Mission', 'amannisa' ); ?></h2>
                <p><?php esc_html_e( 'Volunteer, partner, or contribute your skills to Amnnisa.', 'amannisa' ); ?></p>
                <form data-sub="Amnnisa – Join the mission">
                    <div style="display:none!important;visibility:hidden;height:0;width:0;overflow:hidden;" aria-hidden="true"><input type="text" name="website_url" tabindex="-1" autocomplete="off" value=""></div>
                    <div class="fr">
                        <div>
                            <label><?php esc_html_e( 'Name *', 'amannisa' ); ?></label>
                            <input name="Name" required placeholder="Your full name">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Email *', 'amannisa' ); ?></label>
                            <input type="email" name="Email" required placeholder="you@example.com">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Phone', 'amannisa' ); ?></label>
                            <input name="Phone" placeholder="+92 3XX XXXXXXX">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'University / Organization', 'amannisa' ); ?></label>
                            <input name="Organization" placeholder="e.g. MUET, Sindh University">
                        </div>
                    </div>
                    <label><?php esc_html_e( 'Area of interest', 'amannisa' ); ?></label>
                    <select name="Interest">
                        <option value=""><?php esc_html_e( 'How would you like to help?', 'amannisa' ); ?></option>
                        <option>Volunteer</option>
                        <option>Partnership</option>
                        <option>Tech / development</option>
                        <option>Legal support</option>
                        <option>Awareness / media</option>
                    </select>
                    <label><?php esc_html_e( 'Tell us more', 'amannisa' ); ?></label>
                    <textarea name="Message" placeholder="Tell us about your background, skills, and why you want to support Amnnisa..."></textarea>
                    <br><br>
                    <button type="submit" class="btn full"><?php esc_html_e( 'Send application', 'amannisa' ); ?></button>
                </form>
            </div>

            <!-- Tab 5: Donate -->
            <div class="box hide" data-p="donate" style="text-align:center">
                <div class="ic" style="margin:auto auto 16px">♡</div>
                <span class="pill"><?php esc_html_e( 'Coming soon', 'amannisa' ); ?></span>
                <h2 style="margin:14px 0 8px"><?php esc_html_e( 'Donate', 'amannisa' ); ?></h2>
                <p style="max-width:540px;margin:0 auto 24px">
                    <?php esc_html_e( 'Our secure donation portal is being prepared. Leave your email and we\'ll notify you the moment it goes live so you can support our mission.', 'amannisa' ); ?>
                </p>
                <form data-sub="Amnnisa – Donation notify" style="max-width:420px;margin:auto;text-align:left">
                    <div style="display:none!important;visibility:hidden;height:0;width:0;overflow:hidden;" aria-hidden="true"><input type="text" name="website_url" tabindex="-1" autocomplete="off" value=""></div>
                    <label><?php esc_html_e( 'Email', 'amannisa' ); ?></label>
                    <input type="email" name="Email" required placeholder="you@example.com">
                    <br><br>
                    <button type="submit" class="btn full"><?php esc_html_e( 'Notify me', 'amannisa' ); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==========================================
     PAGE 5: CONTACT
     ========================================== -->
<div class="pg" id="p-contact">
    <div class="wrap">
        <div class="ph">
            <span class="pill"><?php echo esc_html( $contact_pill ); ?></span>
            <h1><?php echo esc_html( $contact_title ); ?></h1>
            <svg class="art" viewBox="0 0 600 200" role="img" aria-label="Shield and heart illustration" style="width:100%;max-width:760px;display:block;margin:28px auto 0;">
                <use href="#art"/>
            </svg>
        </div>

        <div class="cg" style="padding: 36px 0 70px;">
            <div class="box" style="margin:0;max-width:none">
                <h2><?php esc_html_e( 'Send a message', 'amannisa' ); ?></h2>
                <p><?php esc_html_e( 'Name is optional — leave it blank to stay anonymous.', 'amannisa' ); ?></p>
                <form data-sub="Amnnisa – Contact message">
                    <div style="display:none!important;visibility:hidden;height:0;width:0;overflow:hidden;" aria-hidden="true"><input type="text" name="website_url" tabindex="-1" autocomplete="off" value=""></div>
                    <div class="fr">
                        <div>
                            <label><?php esc_html_e( 'Name (optional)', 'amannisa' ); ?></label>
                            <input name="Name" placeholder="Your name">
                        </div>
                        <div>
                            <label><?php esc_html_e( 'Email *', 'amannisa' ); ?></label>
                            <input type="email" name="Email" required placeholder="you@example.com">
                        </div>
                    </div>
                    <label><?php esc_html_e( 'Message *', 'amannisa' ); ?></label>
                    <textarea name="Message" required placeholder="How can we help? Tell us what you need or what questions you have..."></textarea>
                    <br><br>
                    <button type="submit" class="btn full"><?php esc_html_e( '🛡 Send securely', 'amannisa' ); ?></button>
                </form>
            </div>

            <div>
                <?php if ( ! empty( $contact_instagram ) ) : ?>
                <a class="ci" style="background:#ffece3" href="<?php echo esc_url( $contact_instagram ); ?>" target="_blank" rel="noopener noreferrer">
                    <div class="ic">◎</div>
                    <div>
                        <b>Instagram</b><br>
                        <span style="color:var(--pink)"><?php echo esc_html( $contact_instagram_handle ); ?></span>
                    </div>
                </a>
                <?php endif; ?>

                <?php if ( ! empty( $contact_whatsapp ) ) : ?>
                <a class="ci" style="background:#f4ffe9" href="<?php echo esc_url( $contact_whatsapp ); ?>" target="_blank" rel="noopener noreferrer">
                    <div class="ic">💬</div>
                    <div>
                        <b>WhatsApp Channel</b><br>
                        <span style="color:#25d366;font-weight:600"><?php esc_html_e( 'Join our channel', 'amannisa' ); ?></span>
                    </div>
                </a>
                <?php endif; ?>

                <div class="ci" style="flex-direction:column;align-items:flex-start">
                    <div class="ic" style="background:#ffe6e6">✉</div>
                    <b>Email</b>
                    <a style="color:var(--pink);word-break:break-all;" href="<?php echo esc_url( 'mailto:' . $contact_email ); ?>">
                        <?php echo esc_html( $contact_email ); ?>
                    </a>
                </div>

                <div class="ci dk">
                    <div class="ic">📍</div>
                    <b>Location</b>
                    <span style="color:#cfc6b4;font-size:14px;line-height:1.5;margin-top:4px;">
                        <?php echo esc_html( $contact_location ); ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
