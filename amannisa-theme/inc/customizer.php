<?php
/**
 * Amnnisa Theme Customizer Settings
 * Makes all sections, texts, images, branding, SMTP, and links fully editable from WP Admin.
 *
 * @package Amannisa
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function amannisa_customize_register( $wp_customize ) {

    // Main Theme Options Panel
    $wp_customize->add_panel( 'amannisa_theme_panel', array(
        'title'       => __( 'Amnnisa Site Content & Sections', 'amannisa' ),
        'description' => __( 'Edit all branding, content, text, images, hotlines, and SMTP settings across the entire Amnnisa platform.', 'amannisa' ),
        'priority'    => 20,
    ) );

    // Helper to register standard text setting & control
    $add_text = function( $section, $id, $label, $default = '', $type = 'text', $priority = 10 ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => $type === 'textarea' ? 'sanitize_textarea_field' : ( $type === 'url' ? 'esc_url_raw' : ( $type === 'email' ? 'sanitize_email' : 'sanitize_text_field' ) ),
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => $section,
            'type'     => $type,
            'priority' => $priority,
        ) );
    };

    // Helper to register checkbox setting & control
    $add_checkbox = function( $section, $id, $label, $default = 1, $priority = 10 ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $id, array(
            'label'    => $label,
            'section'  => $section,
            'type'     => 'checkbox',
            'priority' => $priority,
        ) );
    };

    // Helper to register image setting & control
    $add_image = function( $section, $id, $label, $priority = 10 ) use ( $wp_customize ) {
        $wp_customize->add_setting( $id, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
            'label'    => $label,
            'section'  => $section,
            'priority' => $priority,
        ) ) );
    };

    /* -------------------------------------------------------------------------
       0. BRANDING & HEADER IDENTITY
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_branding_section', array(
        'title'    => __( '0. Header Brand, Logo & Tagline', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 5,
    ) );

    $add_text( 'amannisa_branding_section', 'brand_name', 'Platform Brand Name', 'Amnnisa' );
    $add_text( 'amannisa_branding_section', 'brand_tagline', 'Header Tagline / Subtitle', 'SAFETY PLATFORM' );
    $add_image( 'amannisa_branding_section', 'brand_logo_image', 'Upload Custom Logo (Overrides default logo.jpg)' );

    /* -------------------------------------------------------------------------
       1. HERO SECTION
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_hero_section', array(
        'title'    => __( '1. Home — Hero Section', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 10,
    ) );

    $add_text( 'amannisa_hero_section', 'hero_pill', 'Badge / Pill Text', '🛡 Women\'s Safety & Empowerment Initiative' );
    $add_text( 'amannisa_hero_section', 'hero_title_1', 'Main Headline Line 1', 'Dignity.' );
    $add_text( 'amannisa_hero_section', 'hero_title_2', 'Main Headline Line 2 (Pink Highlight)', 'Safety.' );
    $add_text( 'amannisa_hero_section', 'hero_title_3', 'Main Headline Line 3', 'Innovation.' );
    $add_text( 'amannisa_hero_section', 'hero_description', 'Hero Description Paragraph', 'Amnnisa secures women\'s dignity and empowers women — guiding them on how to respond to threats and harassment through legal guidance, technical guidance, moral support, and data-driven collaboration.', 'textarea' );
    $add_text( 'amannisa_hero_section', 'hero_btn1_text', 'Primary CTA Button Text', 'Report a case now →' );
    $add_text( 'amannisa_hero_section', 'hero_btn1_link', 'Primary CTA Button Link', '#report' );
    $add_text( 'amannisa_hero_section', 'hero_btn2_text', 'Secondary CTA Button Text', 'Learn about us' );
    $add_text( 'amannisa_hero_section', 'hero_btn2_link', 'Secondary CTA Button Link', '#about' );
    $add_image( 'amannisa_hero_section', 'hero_image', 'Hero Photo (Upload to override default)' );
    $add_text( 'amannisa_hero_section', 'hero_overlay_text', 'Hero Photo Overlay Label', 'Women\'s Dignity & Safety Platform' );

    /* -------------------------------------------------------------------------
       2. PILLARS SECTION
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_pillars_section', array(
        'title'    => __( '2. Home — Our Pillars (5)', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 20,
    ) );

    $add_text( 'amannisa_pillars_section', 'pillars_pill', 'Section Badge', 'Our Pillars' );
    $add_text( 'amannisa_pillars_section', 'pillars_title', 'Section Title', 'What Amnnisa stands for' );

    $default_pillars = array(
        1 => array( '🛡', 'Secure', 'Women\'s safety through guidance and technology.' ),
        2 => array( '💗', 'Dignity', 'Every interaction respects privacy and the individual.' ),
        3 => array( '💡', 'Empower', 'Through innovation, education, and community.' ),
        4 => array( '⚖', 'Guide', 'Legal, technical, and moral support in one place.' ),
        5 => array( '🤝', 'Collaborate', 'Universities, organizations, and legal-tech partners together.' ),
    );

    foreach ( $default_pillars as $i => $data ) {
        $add_text( 'amannisa_pillars_section', "pillar_{$i}_icon", "Pillar $i Icon / Emoji", $data[0] );
        $add_text( 'amannisa_pillars_section', "pillar_{$i}_title", "Pillar $i Title", $data[1] );
        $add_text( 'amannisa_pillars_section', "pillar_{$i}_desc", "Pillar $i Description", $data[2] );
    }

    /* -------------------------------------------------------------------------
       3. TAKE ACTION CARDS & TRACK BAR
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_action_section', array(
        'title'    => __( '3. Home — Take Action Cards & Track', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 30,
    ) );

    $add_text( 'amannisa_action_section', 'action_pill', 'Section Badge', 'Take Action' );
    $add_text( 'amannisa_action_section', 'action_title', 'Section Title', 'Four ways to engage with Amnnisa' );
    $add_text( 'amannisa_action_section', 'action_subtitle', 'Section Subtitle', 'Whether you need help, want to contribute ideas, or stand with our mission.' );

    $default_cards = array(
        1 => array( '💡', 'Share an Idea', 'Propose an initiative, feature, or solution.', '#involved:idea' ),
        2 => array( '🛡', 'Report a Case', 'Report harassment or threats — anonymously if you choose.', '#involved:case' ),
        3 => array( '👥', 'Join the Mission', 'Volunteer, partner, or contribute your skills.', '#involved:join' ),
        4 => array( '♡', 'Donate', 'Support Amnnisa — portal coming soon.', '#involved:donate' ),
    );

    foreach ( $default_cards as $i => $data ) {
        $add_text( 'amannisa_action_section', "card_{$i}_icon", "Card $i Icon", $data[0] );
        $add_text( 'amannisa_action_section', "card_{$i}_title", "Card $i Title", $data[1] );
        $add_text( 'amannisa_action_section', "card_{$i}_desc", "Card $i Description", $data[2] );
        $add_text( 'amannisa_action_section', "card_{$i}_link", "Card $i Link", $data[3] );
    }

    $add_text( 'amannisa_action_section', 'track_title', 'Track Bar Title', 'Track your report' );
    $add_text( 'amannisa_action_section', 'track_desc', 'Track Bar Description', 'Already submitted? Email us your reference details to check the status and get our response.', 'textarea' );
    $add_text( 'amannisa_action_section', 'track_btn_text', 'Track Bar Button Text', 'Track status →' );
    $add_text( 'amannisa_action_section', 'track_link', 'Track Bar Link', '#involved:track' );
    $add_image( 'amannisa_action_section', 'track_icon_image', 'Custom Track Icon Image (Optional: upload icon image or leave empty for 📋)' );

    /* -------------------------------------------------------------------------
       4. FOUNDER QUOTE
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_quote_section', array(
        'title'    => __( '4. Home — Founder Quote', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 40,
    ) );

    $add_text( 'amannisa_quote_section', 'quote_text', 'Quote Text', '"Amnnisa is not a charity we offer women — it is the infrastructure of dignity they were always owed."', 'textarea' );
    $add_text( 'amannisa_quote_section', 'quote_author', 'Author & Title', 'HOMAIR NISAR — FOUNDER, AMNNISA' );
    $add_text( 'amannisa_quote_section', 'quote_btn_text', 'Button Text', 'Read our story →' );
    $add_text( 'amannisa_quote_section', 'quote_btn_link', 'Button Link', '#about' );

    /* -------------------------------------------------------------------------
       5. THREE SIMPLE STEPS (HOW IT WORKS)
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_steps_section', array(
        'title'    => __( '5. Home — How It Works (3 Steps)', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 50,
    ) );

    $add_text( 'amannisa_steps_section', 'steps_pill', 'Badge', 'How it works' );
    $add_text( 'amannisa_steps_section', 'steps_title', 'Title', 'Three simple steps' );

    $default_steps = array(
        1 => array( 'Tell us', 'Share what happened in your own words — anonymously if you choose.' ),
        2 => array( 'Get guided', 'Our team replies with legal, technical, and moral guidance for your situation.' ),
        3 => array( 'Stay protected', 'Your details stay private and are never shared without your consent.' ),
    );

    foreach ( $default_steps as $i => $data ) {
        $add_text( 'amannisa_steps_section', "step_{$i}_title", "Step $i Title", $data[0] );
        $add_text( 'amannisa_steps_section', "step_{$i}_desc", "Step $i Description", $data[1] );
    }

    /* -------------------------------------------------------------------------
       6. EMERGENCY HOTLINES
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_hotlines_section', array(
        'title'    => __( '6. Home — Emergency Hotlines', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 60,
    ) );

    $add_text( 'amannisa_hotlines_section', 'hotline_title', 'Box Title', 'In immediate danger? Call for help now.' );
    $add_text( 'amannisa_hotlines_section', 'hotline_subtitle', 'Box Notice', 'Amnnisa is not an emergency service. If you are at risk right now, contact the authorities first.', 'textarea' );

    $default_hotlines = array(
        1 => array( '15', 'Police emergency' ),
        2 => array( '1099', 'Ministry of Human Rights' ),
        3 => array( '1122', 'Medical emergency / Rescue' ),
        4 => array( '9911', 'Sindh Women Helpline' ),
    );

    foreach ( $default_hotlines as $i => $data ) {
        $add_text( 'amannisa_hotlines_section', "hotline_{$i}_number", "Hotline $i Number", $data[0] );
        $add_text( 'amannisa_hotlines_section', "hotline_{$i}_label", "Hotline $i Label", $data[1] );
    }

    /* -------------------------------------------------------------------------
       7. STATS & INCUBATION
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_stats_section', array(
        'title'    => __( '7. Home — Stats & Incubation', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 70,
    ) );

    $add_text( 'amannisa_stats_section', 'stat_1_val', 'Stat 1 Value', 'MUET' );
    $add_text( 'amannisa_stats_section', 'stat_1_lbl', 'Stat 1 Label', 'Business Incubation Center' );
    $add_text( 'amannisa_stats_section', 'stat_2_val', 'Stat 2 Value', '100%' );
    $add_text( 'amannisa_stats_section', 'stat_2_lbl', 'Stat 2 Label', 'Private & confidential submissions' );
    $add_text( 'amannisa_stats_section', 'stat_3_val', 'Stat 3 Value', '1-click' );
    $add_text( 'amannisa_stats_section', 'stat_3_lbl', 'Stat 3 Label', 'To report from anywhere on the site' );

    $add_text( 'amannisa_stats_section', 'incubation_text', 'Incubation Badge Text', 'Incubated at' );
    $add_image( 'amannisa_stats_section', 'incubation_image', 'Incubator Logo Image' );

    /* -------------------------------------------------------------------------
       8. ABOUT US PAGE
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_about_section', array(
        'title'    => __( '8. About Us Page & FAQs', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 80,
    ) );

    $add_text( 'amannisa_about_section', 'about_pill', 'Badge', 'About Us' );
    $add_text( 'amannisa_about_section', 'about_title', 'Page Title', 'Securing women\'s dignity' );
    $add_text( 'amannisa_about_section', 'about_desc', 'About Description', 'Amnnisa is a women\'s safety and empowerment initiative guiding women on how to respond to threats and harassment through legal, technical, and moral support. Founded by Homair Nisar and incubated at the MUET Business Incubation Center, Jamshoro. We combine empathetic guidance, technical countermeasures, and data-backed advocacy so no woman feels alone or unprotected.', 'textarea' );

    // 3 Guidance pillars
    $add_text( 'amannisa_about_section', 'guidance_1_icon', 'Guidance 1 Icon', '⚖' );
    $add_text( 'amannisa_about_section', 'guidance_1_title', 'Guidance 1 Title', 'Legal guidance' );
    $add_text( 'amannisa_about_section', 'guidance_1_desc', 'Guidance 1 Description', 'Clear direction on rights and the steps to take under the law.' );

    $add_text( 'amannisa_about_section', 'guidance_2_icon', 'Guidance 2 Icon', '💻' );
    $add_text( 'amannisa_about_section', 'guidance_2_title', 'Guidance 2 Title', 'Technical guidance' );
    $add_text( 'amannisa_about_section', 'guidance_2_desc', 'Guidance 2 Description', 'Practical help for digital safety, account security, and evidence preservation.' );

    $add_text( 'amannisa_about_section', 'guidance_3_icon', 'Guidance 3 Icon', '💗' );
    $add_text( 'amannisa_about_section', 'guidance_3_title', 'Guidance 3 Title', 'Moral support' );
    $add_text( 'amannisa_about_section', 'guidance_3_desc', 'Guidance 3 Description', 'A private, respectful space to be heard without judgment or exposure.' );

    // FAQs
    $default_faqs = array(
        1 => array( 'Is my report really private?', 'Yes. You can report completely anonymously, and your identity is never exposed or shared without your explicit consent.' ),
        2 => array( 'Do I need proof to report?', 'No. Proof helps strengthen your case, but you can report first and our team will guide you on how to safely gather and preserve evidence.' ),
        3 => array( 'Is Amnnisa an emergency service?', 'No. If you are in immediate physical danger, please call police emergency 15 or 1122 right away before reaching out to us.' ),
        4 => array( 'Who can join the mission?', 'Students, volunteers, lawyers, technologists, and organizations passionate about women\'s safety are welcome to apply via our Get Involved section.' ),
    );

    foreach ( $default_faqs as $i => $data ) {
        $add_text( 'amannisa_about_section', "faq_{$i}_q", "FAQ $i Question", $data[0] );
        $add_text( 'amannisa_about_section', "faq_{$i}_a", "FAQ $i Answer", $data[1], 'textarea' );
    }

    /* -------------------------------------------------------------------------
       9. OUR TEAM & FOUNDER
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_founder_section', array(
        'title'    => __( '9. Our Team — Founder Spotlight', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 90,
    ) );

    $add_text( 'amannisa_founder_section', 'team_pill', 'Team Page Badge', 'Our Team' );
    $add_text( 'amannisa_founder_section', 'team_title', 'Team Page Title', 'The people behind Amnnisa' );
    $add_text( 'amannisa_founder_section', 'team_subtitle', 'Team Page Subtitle', 'Students and professionals working together for women\'s dignity and safety.' );

    $add_text( 'amannisa_founder_section', 'founder_badge', 'Founder Badge', 'Founder & Vision' );
    $add_text( 'amannisa_founder_section', 'founder_name', 'Founder Name', 'Homair Nisar' );
    $add_text( 'amannisa_founder_section', 'founder_role', 'Founder Title', 'Founder, Amnnisa' );
    $add_text( 'amannisa_founder_section', 'founder_bio', 'Founder Bio', 'Homair Nisar founded Amnnisa with a single conviction: that every woman deserves to walk through life with dignity, safety, and the full backing of her community. As a student-leader incubated at the MUET Business Incubation Center, he envisions Amnnisa as a bridge between immediate protection and systemic change — leveraging technology, legal literacy, and empathetic care to rewrite how society responds to harassment.', 'textarea' );
    $add_image( 'amannisa_founder_section', 'founder_image', 'Founder Photo (Upload to override default photo)' );

    /* -------------------------------------------------------------------------
       10. CONTACT & SOCIAL CHANNELS
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_contact_section', array(
        'title'    => __( '10. Contact & Social Channels', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 100,
    ) );

    $add_text( 'amannisa_contact_section', 'contact_pill', 'Badge', 'Contact' );
    $add_text( 'amannisa_contact_section', 'contact_title', 'Title', 'Get in touch' );
    $add_text( 'amannisa_contact_section', 'contact_email', 'Admin Recipient Email (Receives All Form Submissions)', 'amnnisafoundation@gmail.com', 'email' );
    $add_text( 'amannisa_contact_section', 'contact_instagram', 'Instagram Profile Link', 'https://www.instagram.com/amannisa_pk', 'url' );
    $add_text( 'amannisa_contact_section', 'contact_instagram_handle', 'Instagram Handle Text', '@amannisa_pk' );
    $add_text( 'amannisa_contact_section', 'contact_whatsapp', 'WhatsApp Channel Link', 'https://whatsapp.com/channel/0029Vb7sh2jI7BeKLp1uf13O', 'url' );
    $add_text( 'amannisa_contact_section', 'contact_location', 'Physical Address', 'Business Incubation Center, Mehran University of Engineering and Technology (MUET), Jamshoro', 'textarea' );

    /* -------------------------------------------------------------------------
       11. FOOTER SETTINGS
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_footer_section', array(
        'title'    => __( '11. Footer Content & Copyright', 'amannisa' ),
        'panel'    => 'amannisa_theme_panel',
        'priority' => 110,
    ) );

    $add_text( 'amannisa_footer_section', 'footer_blurb', 'Footer Mission Blurb', 'Securing women\'s dignity and empowering women through legal guidance, technical guidance, moral support, and innovation.', 'textarea' );
    $add_text( 'amannisa_footer_section', 'footer_founder_credit', 'Founder Credit Line', 'Founded by Homair Nisar · MUET Business Incubation Center' );
    $add_text( 'amannisa_footer_section', 'footer_copyright', 'Copyright Text', 'Built with ♥ for dignity & safety.' );

    /* -------------------------------------------------------------------------
       12. SMTP EMAIL DELIVERY CONFIGURATION
       ------------------------------------------------------------------------- */
    $wp_customize->add_section( 'amannisa_smtp_section', array(
        'title'       => __( '12. SMTP Email Delivery (Gmail / Host)', 'amannisa' ),
        'description' => __( 'Configure reliable email dispatch so all Case Reports, Contact inquiries, Ideas, and Join applications reach amnnisafoundation@gmail.com without getting dropped by spam filters.', 'amannisa' ),
        'panel'       => 'amannisa_theme_panel',
        'priority'    => 120,
    ) );

    $add_checkbox( 'amannisa_smtp_section', 'smtp_enabled', 'Enable Custom SMTP Delivery', 0, 10 );
    $add_text( 'amannisa_smtp_section', 'smtp_host', 'SMTP Host', 'smtp.gmail.com', 'text', 20 );
    $add_text( 'amannisa_smtp_section', 'smtp_port', 'SMTP Port (587 for TLS, 465 for SSL)', '587', 'text', 30 );
    $add_text( 'amannisa_smtp_section', 'smtp_encryption', 'Encryption (tls or ssl)', 'tls', 'text', 40 );
    $add_text( 'amannisa_smtp_section', 'smtp_username', 'SMTP Username (e.g. amnnisafoundation@gmail.com)', 'amnnisafoundation@gmail.com', 'text', 50 );
    $add_text( 'amannisa_smtp_section', 'smtp_password', 'SMTP App Password (16-char Google App Password)', '', 'text', 60 );
    $add_text( 'amannisa_smtp_section', 'smtp_from_email', 'From Email Address', 'amnnisafoundation@gmail.com', 'email', 70 );
    $add_text( 'amannisa_smtp_section', 'smtp_from_name', 'From Name Display', 'Amnnisa Platform', 'text', 80 );
}
add_action( 'customize_register', 'amannisa_customize_register' );
