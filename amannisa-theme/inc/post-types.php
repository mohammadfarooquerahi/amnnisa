<?php
/**
 * Custom Post Type: Team Members
 * Allows the client to add, edit, reorder, or delete team members from WP Admin.
 *
 * @package Amannisa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Custom Post Type for Team Members
 */
function amannisa_register_team_post_type() {
    $labels = array(
        'name'               => _x( 'Team Members', 'post type general name', 'amannisa' ),
        'singular_name'      => _x( 'Team Member', 'post type singular name', 'amannisa' ),
        'menu_name'          => _x( 'Team Members', 'admin menu', 'amannisa' ),
        'name_admin_bar'     => _x( 'Team Member', 'add new on admin bar', 'amannisa' ),
        'add_new'            => _x( 'Add New Member', 'team', 'amannisa' ),
        'add_new_item'       => __( 'Add New Team Member', 'amannisa' ),
        'new_item'           => __( 'New Team Member', 'amannisa' ),
        'edit_item'          => __( 'Edit Team Member', 'amannisa' ),
        'view_item'          => __( 'View Team Member', 'amannisa' ),
        'all_items'          => __( 'All Team Members', 'amannisa' ),
        'search_items'       => __( 'Search Team Members', 'amannisa' ),
        'not_found'          => __( 'No team members found.', 'amannisa' ),
        'not_found_in_trash' => __( 'No team members found in Trash.', 'amannisa' ),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Amnnisa leadership and team members.', 'amannisa' ),
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail', 'page-attributes' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'team_member', $args );
}
add_action( 'init', 'amannisa_register_team_post_type' );

/**
 * Add Meta Boxes for Role, Department, and Photo URL
 */
function amannisa_team_meta_boxes() {
    add_meta_box(
        'amannisa_team_details',
        __( 'Team Member Details & Photo', 'amannisa' ),
        'amannisa_team_meta_box_callback',
        'team_member',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'amannisa_team_meta_boxes' );

function amannisa_team_meta_box_callback( $post ) {
    wp_nonce_field( 'amannisa_save_team_meta', 'amannisa_team_nonce' );

    $role       = get_post_meta( $post->ID, '_member_role', true );
    $department = get_post_meta( $post->ID, '_member_department', true );
    $photo_url  = get_post_meta( $post->ID, '_member_photo_url', true );

    if ( empty( $role ) ) {
        $role = 'Co-Founder';
    }

    // Determine current active preview photo
    $active_photo = '';
    if ( has_post_thumbnail( $post->ID ) ) {
        $active_photo = get_the_post_thumbnail_url( $post->ID, 'medium' );
    } elseif ( ! empty( $photo_url ) ) {
        $active_photo = $photo_url;
    }
    ?>
    <div style="display:flex;gap:24px;flex-wrap:wrap;align-items:flex-start;padding:10px 0;">
        <div style="flex:1;min-width:280px;">
            <p>
                <label for="member_role"><strong><?php _e( 'Title / Role:', 'amannisa' ); ?></strong></label><br>
                <input type="text" id="member_role" name="member_role" value="<?php echo esc_attr( $role ); ?>" style="width:100%;max-width:440px;" placeholder="e.g. Co-Founder">
            </p>
            <p>
                <label for="member_department"><strong><?php _e( 'Department / Function:', 'amannisa' ); ?></strong></label><br>
                <input type="text" id="member_department" name="member_department" value="<?php echo esc_attr( $department ); ?>" style="width:100%;max-width:440px;" placeholder="e.g. Marketing & PR, Legal Support">
            </p>
            <p>
                <label for="member_photo_url"><strong><?php _e( 'Photo Image URL (Optional):', 'amannisa' ); ?></strong></label><br>
                <input type="url" id="member_photo_url" name="member_photo_url" value="<?php echo esc_url( $photo_url ); ?>" style="width:100%;max-width:440px;" placeholder="https://... or upload in Featured Image">
                <br><small style="color:#666;"><?php _e( 'You can enter a direct image URL here, OR upload a photo into the <strong>Featured Image</strong> box on the right.', 'amannisa' ); ?></small>
            </p>
        </div>

        <?php if ( ! empty( $active_photo ) ) : ?>
        <div style="background:#fff;border:1px solid #ccd0d4;padding:12px;border-radius:12px;text-align:center;">
            <strong><?php _e( 'Current Photo Preview:', 'amannisa' ); ?></strong><br>
            <img src="<?php echo esc_url( $active_photo ); ?>" alt="" style="width:110px;height:110px;object-fit:cover;border-radius:50%;margin-top:8px;border:3px solid #E8006F;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
        </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Save Meta Box Data
 */
function amannisa_save_team_meta( $post_id ) {
    if ( ! isset( $_POST['amannisa_team_nonce'] ) || ! wp_verify_nonce( $_POST['amannisa_team_nonce'], 'amannisa_save_team_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['member_role'] ) ) {
        update_post_meta( $post_id, '_member_role', sanitize_text_field( $_POST['member_role'] ) );
    }
    if ( isset( $_POST['member_department'] ) ) {
        update_post_meta( $post_id, '_member_department', sanitize_text_field( $_POST['member_department'] ) );
    }
    if ( isset( $_POST['member_photo_url'] ) ) {
        update_post_meta( $post_id, '_member_photo_url', esc_url_raw( $_POST['member_photo_url'] ) );
    }
}
add_action( 'save_post_team_member', 'amannisa_save_team_meta' );

/**
 * Custom Admin Columns for Team Members
 */
function amannisa_team_columns( $columns ) {
    $new_columns = array(
        'cb'         => $columns['cb'],
        'photo'      => __( 'Photo', 'amannisa' ),
        'title'      => __( 'Name', 'amannisa' ),
        'role'       => __( 'Role', 'amannisa' ),
        'department' => __( 'Department', 'amannisa' ),
        'order'      => __( 'Order', 'amannisa' ),
        'date'       => $columns['date'],
    );
    return $new_columns;
}
add_filter( 'manage_team_member_posts_columns', 'amannisa_team_columns' );

function amannisa_team_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'photo':
            $img_url = '';
            if ( has_post_thumbnail( $post_id ) ) {
                $img_url = get_the_post_thumbnail_url( $post_id, array( 60, 60 ) );
            } else {
                $img_url = get_post_meta( $post_id, '_member_photo_url', true );
            }

            if ( ! empty( $img_url ) ) {
                echo '<img src="' . esc_url( $img_url ) . '" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #E8006F;display:block;">';
            } else {
                echo '<span style="color:#aaa;">—</span>';
            }
            break;
        case 'role':
            echo esc_html( get_post_meta( $post_id, '_member_role', true ) );
            break;
        case 'department':
            echo esc_html( get_post_meta( $post_id, '_member_department', true ) );
            break;
        case 'order':
            $post = get_post( $post_id );
            echo esc_html( $post->menu_order );
            break;
    }
}
add_action( 'manage_team_member_posts_custom_column', 'amannisa_team_custom_column', 10, 2 );

/**
 * Auto-Seed Default 6 Team Members
 * Seeds the default members so they immediately appear in WP Admin for adding, editing, and deleting.
 */
function amannisa_seed_default_team_members() {
    $default_members = array(
        array(
            'name'       => 'Aliza Shah',
            'role'       => 'Co-Founder',
            'department' => 'Marketing & PR',
            'photo'      => amannisa_asset( 'images/team-aliza-shah.jpg' ),
            'order'      => 1,
        ),
        array(
            'name'       => 'Shanze Fatima',
            'role'       => 'Co-Founder',
            'department' => 'Legal & Harassment Support',
            'photo'      => amannisa_asset( 'images/team-shanze-fatima.jpg' ),
            'order'      => 2,
        ),
        array(
            'name'       => 'Emaan Muneer',
            'role'       => 'Co-Founder',
            'department' => 'Team Management',
            'photo'      => amannisa_asset( 'images/team-emaan-muneer.jpg' ),
            'order'      => 3,
        ),
        array(
            'name'       => 'Khadija Soomro',
            'role'       => 'Co-Founder',
            'department' => 'Finance & Logistics',
            'photo'      => amannisa_asset( 'images/team-khadija-soomro.jpg' ),
            'order'      => 4,
        ),
        array(
            'name'       => 'Humna Irfan',
            'role'       => 'Co-Founder',
            'department' => 'Chief Operating Officer',
            'photo'      => amannisa_asset( 'images/team-humna-irfan.jpg' ),
            'order'      => 5,
        ),
        array(
            'name'       => 'Amna Korai',
            'role'       => 'Co-Founder',
            'department' => 'Social Media',
            'photo'      => amannisa_asset( 'images/team-amna-korai.jpg' ),
            'order'      => 6,
        ),
    );

    foreach ( $default_members as $m ) {
        // Check if member already exists by title
        $existing = get_page_by_title( $m['name'], OBJECT, 'team_member' );
        if ( ! $existing ) {
            $post_id = wp_insert_post( array(
                'post_title'   => $m['name'],
                'post_type'    => 'team_member',
                'post_status'  => 'publish',
                'menu_order'   => $m['order'],
            ) );

            if ( $post_id && ! is_wp_error( $post_id ) ) {
                update_post_meta( $post_id, '_member_role', $m['role'] );
                update_post_meta( $post_id, '_member_department', $m['department'] );
                update_post_meta( $post_id, '_member_photo_url', $m['photo'] );
            }
        }
    }

    update_option( 'amannisa_team_seeded_v1', 1 );
}

/**
 * Hook to seed team members automatically if no team members exist in database
 */
function amannisa_check_and_seed_team() {
    if ( ! is_admin() ) {
        return;
    }

    // Handle manual re-seed trigger from admin notice
    if ( isset( $_GET['amannisa_action'] ) && $_GET['amannisa_action'] === 'seed_team' && check_admin_referer( 'amannisa_seed_team_action' ) ) {
        amannisa_seed_default_team_members();
        wp_safe_redirect( admin_url( 'edit.php?post_type=team_member&amannisa_seeded=1' ) );
        exit;
    }

    // Check if auto-seed has run
    if ( ! get_option( 'amannisa_team_seeded_v1' ) ) {
        $count = wp_count_posts( 'team_member' );
        $total = ( $count->publish ?? 0 ) + ( $count->draft ?? 0 ) + ( $count->trash ?? 0 );
        if ( $total === 0 ) {
            amannisa_seed_default_team_members();
        } else {
            update_option( 'amannisa_team_seeded_v1', 1 );
        }
    }
}
add_action( 'admin_init', 'amannisa_check_and_seed_team' );

/**
 * Admin notice on Team Members page with quick action & founder link
 */
function amannisa_team_admin_notice() {
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'team_member' ) {
        return;
    }

    if ( isset( $_GET['amannisa_seeded'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p><strong>' . esc_html__( 'Default team members successfully populated! You can now edit, add, or delete any member.', 'amannisa' ) . '</strong></p></div>';
    }

    $seed_url = wp_nonce_url( admin_url( 'edit.php?post_type=team_member&amannisa_action=seed_team' ), 'amannisa_seed_team_action' );
    $customizer_url = admin_url( 'customize.php?autofocus[section]=amannisa_founder_section' );
    ?>
    <div class="notice notice-info" style="border-left-color:#E8006F;padding:12px 14px;">
        <p style="margin:0 0 6px;">
            <strong>🌸 <?php esc_html_e( 'Amnnisa Team Management', 'amannisa' ); ?>:</strong>
            <?php esc_html_e( 'All team members listed below appear dynamically on your website\'s Team page. You can edit their titles, roles, departments, upload custom photos, or add/delete members anytime.', 'amannisa' ); ?>
        </p>
        <p style="margin:0;font-size:13px;">
            <a href="<?php echo esc_url( $seed_url ); ?>" class="button button-small" onclick="return confirm('Restore the 6 default founding team members?');">
                <?php esc_html_e( '↺ Restore Default 6 Members', 'amannisa' ); ?>
            </a>
            &nbsp;
            <a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-small">
                <?php esc_html_e( 'Edit Founder Spotlight in Customizer →', 'amannisa' ); ?>
            </a>
        </p>
    </div>
    <?php
}
add_action( 'admin_notices', 'amannisa_team_admin_notice' );

/**
 * Helper to fetch all team members for frontend rendering
 */
function amannisa_get_team_members() {
    $query = new WP_Query( array(
        'post_type'      => 'team_member',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order date',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ) );

    $members = array();

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $post_id = get_the_ID();

            // Photo determination
            $photo_url = '';
            if ( has_post_thumbnail( $post_id ) ) {
                $photo_url = get_the_post_thumbnail_url( $post_id, 'large' );
            }
            if ( empty( $photo_url ) ) {
                $photo_url = get_post_meta( $post_id, '_member_photo_url', true );
            }
            if ( empty( $photo_url ) ) {
                $photo_url = amannisa_asset( 'images/hero.jpg' );
            }

            $members[] = array(
                'name'       => get_the_title(),
                'role'       => get_post_meta( $post_id, '_member_role', true ) ?: 'Co-Founder',
                'department' => get_post_meta( $post_id, '_member_department', true ) ?: '',
                'photo'      => $photo_url,
            );
        }
        wp_reset_postdata();
    } else {
        // Fallback default 6 team members if database has no published items
        $members = array(
            array(
                'name'       => 'Aliza Shah',
                'role'       => 'Co-Founder',
                'department' => 'Marketing & PR',
                'photo'      => amannisa_asset( 'images/team-aliza-shah.jpg' ),
            ),
            array(
                'name'       => 'Shanze Fatima',
                'role'       => 'Co-Founder',
                'department' => 'Legal & Harassment Support',
                'photo'      => amannisa_asset( 'images/team-shanze-fatima.jpg' ),
            ),
            array(
                'name'       => 'Emaan Muneer',
                'role'       => 'Co-Founder',
                'department' => 'Team Management',
                'photo'      => amannisa_asset( 'images/team-emaan-muneer.jpg' ),
            ),
            array(
                'name'       => 'Khadija Soomro',
                'role'       => 'Co-Founder',
                'department' => 'Finance & Logistics',
                'photo'      => amannisa_asset( 'images/team-khadija-soomro.jpg' ),
            ),
            array(
                'name'       => 'Humna Irfan',
                'role'       => 'Co-Founder',
                'department' => 'Chief Operating Officer',
                'photo'      => amannisa_asset( 'images/team-humna-irfan.jpg' ),
            ),
            array(
                'name'       => 'Amna Korai',
                'role'       => 'Co-Founder',
                'department' => 'Social Media',
                'photo'      => amannisa_asset( 'images/team-amna-korai.jpg' ),
            ),
        );
    }

    return $members;
}
