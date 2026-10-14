<?php
/**
 * Header template for Amannisa theme
 *
 * @package Amannisa
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <!-- Critical Anti-FOUC Inlined Styling (Renders immediately before any external network requests) -->
    <style id="amannisa-critical-css">
    :root {
      --pink: #E8006F; --pink-hover: #c9005f; --pink-soft: #ffe6e6; --pink-light: #fff0f5;
      --bg: #FFF8E6; --bg-card: #FFF3E3; --ink: #141414; --mut: #6b6b76; --line: #f5d3d8;
      --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      --font-display: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      --header-height: 80px;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: var(--font-sans); background-color: var(--bg); color: var(--ink); line-height: 1.6; margin: 0; padding: 0; overflow-x: hidden; }
    img, svg, video { max-width: 100%; height: auto; display: block; }
    .pg:not(.on) { display: none !important; }
    .pg.on { display: block !important; }
    h1, h2, h3, h4, .h { font-family: var(--font-display); font-weight: 800; color: var(--ink); line-height: 1.15; letter-spacing: -0.02em; }
    a { color: inherit; text-decoration: none; }
    .wrap { width: 100%; max-width: 1180px; margin: 0 auto; padding: 0 clamp(16px, 4vw, 28px); }
    .site-header { position: sticky; top: 0; z-index: 100; background: rgba(255, 248, 230, 0.96); backdrop-filter: blur(14px); border-bottom: 1px solid var(--line); }
    .bar { display: flex; align-items: center; justify-content: space-between; height: 80px; gap: 16px; }
    .brand { display: flex; align-items: center; gap: 12px; }
    .brand img { width: 44px; height: 44px; border-radius: 12px; }
    .brand b { font-size: 20px; font-weight: 800; color: var(--pink); display: block; line-height: 1.1; }
    .brand small { font-size: 10px; letter-spacing: 0.12em; color: var(--mut); display: block; }
    .main-nav { display: flex; align-items: center; gap: 24px; }
    .main-nav a { font-weight: 600; font-size: 15px; color: var(--ink); }
    .main-nav a.on, .main-nav a:hover { color: var(--pink); }
    .header-actions { display: flex; align-items: center; gap: 12px; }
    #menu-toggle { display: none; font-size: 24px; cursor: pointer; border: none; background: none; }
    .btn { display: inline-flex; align-items: center; justify-content: center; background: var(--pink); color: #fff !important; font-weight: 600; padding: 13px 26px; border-radius: 9999px; border: none; cursor: pointer; text-decoration: none; box-shadow: 0 8px 24px rgba(232, 0, 111, 0.22); }
    .btn.o { background: transparent; color: var(--pink) !important; border: 2px solid var(--pink); box-shadow: none; }
    .pill { display: inline-block; background: var(--pink-soft); color: var(--pink); font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 9999px; }
    .rn { position: fixed; right: 28px; top: 50%; transform: translateY(-50%); z-index: 90; background: var(--pink); color: #fff !important; font-weight: 700; font-size: 13px; padding: 14px 24px; border-radius: 9999px; display: flex; align-items: center; gap: 8px; box-shadow: 0 10px 30px rgba(232, 0, 111, 0.4); text-decoration: none; }
    .hero { padding: clamp(24px, 5vw, 60px) 0; display: grid; grid-template-columns: 1.15fr 0.85fr; gap: clamp(24px, 4vw, 56px); align-items: center; }
    .hero h1 { font-size: clamp(34px, 5vw, 56px); margin: 16px 0 20px; }
    .hero h1 span { color: var(--pink); }
    .hero p { font-size: clamp(16px, 2.2vw, 19px); line-height: 1.6; color: #3c3c44; max-width: 580px; margin-bottom: 28px; }
    .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
    .photo-card { position: relative; border-radius: 36px; overflow: hidden; box-shadow: 0 24px 60px rgba(0,0,0,0.12); }
    @media (max-width: 991px) {
      .main-nav { display: none; }
      .main-nav.open { display: flex; flex-direction: column; position: fixed; top: 80px; left: 0; right: 0; background: #FFF8E6; padding: 24px; border-bottom: 1px solid var(--line); z-index: 99; }
      #menu-toggle { display: block; }
      .hero { grid-template-columns: 1fr; }
      .rn { top: auto; bottom: 20px; right: 20px; transform: none; }
    }
    </style>

    <!-- Performance Optimization: Preconnect & Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <?php
    $hero_preload_img = amannisa_get_option( 'hero_image' );
    if ( empty( $hero_preload_img ) ) {
        $hero_preload_img = amannisa_asset( 'images/hero.jpg' );
    }
    ?>
    <link rel="preload" as="image" href="<?php echo esc_url( $hero_preload_img ); ?>" fetchpriority="high">
    <?php wp_head(); ?>
    <?php
    $style_css_file = get_template_directory() . '/assets/css/style.css';
    $style_css_ver  = file_exists( $style_css_file ) ? filemtime( $style_css_file ) : '1.3.0';
    ?>
    <!-- Direct Stylesheet Link (Ensures styling loads even if caching plugins rewrite wp_enqueue_style) -->
    <link rel="stylesheet" id="amannisa-direct-style" href="<?php echo esc_url( amannisa_asset( 'css/style.css' ) . '?ver=' . $style_css_ver ); ?>">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Accessible Skip Link -->
<a class="screen-reader-text" href="#main-content" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">
    <?php esc_html_e( 'Skip to content', 'amannisa' ); ?>
</a>

<!-- Header Bar -->
<header class="site-header">
    <div class="wrap bar">
        <?php
        $site_name = get_bloginfo( 'name' );
        $brand_name = amannisa_get_option( 'brand_name' );
        if ( empty( $brand_name ) ) {
            $brand_name = ( ! empty( $site_name ) && strtolower( trim( $site_name ) ) !== 'wordpress' ) ? $site_name : 'Amnnisa';
        }

        $site_desc = get_bloginfo( 'description' );
        $brand_tagline = amannisa_get_option( 'brand_tagline' );
        if ( empty( $brand_tagline ) ) {
            $brand_tagline = ( ! empty( $site_desc ) && stripos( $site_desc, 'just another' ) === false ) ? $site_desc : 'SAFETY PLATFORM';
        }

        $custom_logo_url = amannisa_get_option( 'brand_logo_image' );
        if ( empty( $custom_logo_url ) && function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
            $logo_id = get_theme_mod( 'custom_logo' );
            $logo_data = wp_get_attachment_image_src( $logo_id, 'full' );
            if ( $logo_data ) {
                $custom_logo_url = $logo_data[0];
            }
        }
        if ( empty( $custom_logo_url ) ) {
            $custom_logo_url = amannisa_asset( 'images/logo.jpg' );
        }
        ?>
        <a class="brand" href="#home" aria-label="<?php echo esc_attr( $brand_name ); ?>">
            <img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( $brand_name ); ?> Logo" width="44" height="44">
            <span>
                <b><?php echo esc_html( $brand_name ); ?></b>
                <small><?php echo esc_html( $brand_tagline ); ?></small>
            </span>
        </a>

        <nav class="main-nav" id="nav" aria-label="Main Navigation">
            <a href="#home" class="on"><?php esc_html_e( 'Home', 'amannisa' ); ?></a>
            <a href="#about"><?php esc_html_e( 'About Us', 'amannisa' ); ?></a>
            <a href="#team"><?php esc_html_e( 'Our Team', 'amannisa' ); ?></a>
            <a href="#collaborators"><?php esc_html_e( 'Legal & Collaborators', 'amannisa' ); ?></a>
            <a href="#involved"><?php esc_html_e( 'Get Involved', 'amannisa' ); ?></a>
            <a href="#contact"><?php esc_html_e( 'Contact', 'amannisa' ); ?></a>
        </nav>

        <div class="header-actions">
            <a class="btn" href="#report"><?php esc_html_e( 'Report Now', 'amannisa' ); ?></a>
            <button id="menu-toggle" aria-label="Toggle navigation menu" aria-expanded="false" aria-controls="nav">☰</button>
        </div>
    </div>
</header>

<!-- Floating Action / Report Button -->
<a class="rn" href="#report" aria-label="Report a case securely">
    <span>🛡</span> REPORT NOW
</a>

<!-- Reusable SVG Graphic Definition -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
    <symbol id="art" viewBox="0 0 600 200">
        <rect width="600" height="200" rx="32" fill="#ffe1e6"/>
        <circle cx="70" cy="30" r="95" fill="#ffc2d4" opacity=".65"/>
        <circle cx="545" cy="175" r="110" fill="#f9a8c4" opacity=".55"/>
        <circle cx="300" cy="100" r="82" fill="none" stroke="#E8006F" stroke-opacity=".25" stroke-width="2"/>
        <circle cx="300" cy="100" r="62" fill="none" stroke="#E8006F" stroke-opacity=".35" stroke-width="2"/>
        <path d="M300 28 L358 50 V105 C358 140 334 160 300 172 C266 160 242 140 242 105 V50Z" fill="#E8006F"/>
        <path d="M300 134 C270 114 262 100 262 90 a17 17 0 0 1 38 -9 a17 17 0 0 1 38 9 c0 10 -8 24 -38 44z" fill="#fff8e6"/>
        <g fill="#E8006F" opacity=".5">
            <circle cx="150" cy="120" r="6"/>
            <circle cx="185" cy="80" r="4"/>
            <circle cx="450" cy="80" r="6"/>
            <circle cx="415" cy="128" r="4"/>
        </g>
    </symbol>
</svg>

<main id="main-content">
