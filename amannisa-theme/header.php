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
