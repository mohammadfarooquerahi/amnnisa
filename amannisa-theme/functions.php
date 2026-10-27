<?php
/**
 * Amannisa Theme Functions and Definitions
 *
 * @package Amannisa
 * @version 1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Reverse Proxy SSL Detection & Auto HTTPS Upgrade
 * Essential for Hostinger CDN, LiteSpeed, Cloudflare to prevent Mixed Content Blocking.
 */
if ( ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) || ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ) {
    $_SERVER['HTTPS'] = 'on';
}

function amannisa_force_https_urls( $url ) {
    if ( is_ssl() || ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) || ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ) ) {
        return str_replace( 'http://', 'https://', $url );
    }
    return $url;
}
add_filter( 'style_loader_src', 'amannisa_force_https_urls', 999 );
add_filter( 'script_loader_src', 'amannisa_force_https_urls', 999 );
add_filter( 'template_directory_uri', 'amannisa_force_https_urls', 999 );
add_filter( 'stylesheet_directory_uri', 'amannisa_force_https_urls', 999 );
add_filter( 'theme_file_uri', 'amannisa_force_https_urls', 999 );
add_filter( 'wp_get_attachment_url', 'amannisa_force_https_urls', 999 );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function amannisa_setup() {
    // Make theme available for translation
    load_theme_textdomain( 'amannisa', get_template_directory() . '/languages' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts, pages, and custom post types
    add_theme_support( 'post-thumbnails' );

    // Custom Logo Support
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 80,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Register navigation menus
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'amannisa' ),
    ) );
}
add_action( 'after_setup_theme', 'amannisa_setup' );

/**
 * Enqueue scripts and styles.
 */
function amannisa_scripts() {
    // Google Fonts: Inter and Plus Jakarta Sans
    wp_enqueue_style(
        'amannisa-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap',
        array(),
        null
    );

    // Cache-busting versions based on file modification timestamps
    $style_file  = get_template_directory() . '/style.css';
    $style_ver   = file_exists( $style_file ) ? filemtime( $style_file ) : '1.3.0';
    $script_file = get_template_directory() . '/assets/js/main.js';
    $script_ver  = file_exists( $script_file ) ? filemtime( $script_file ) : '1.3.0';

    // Theme Main Stylesheet (Directly self-contained)
    wp_enqueue_style(
        'amannisa-style',
        get_stylesheet_uri(),
        array( 'amannisa-google-fonts' ),
        $style_ver
    );

    // Main Interactive Scripts
    wp_enqueue_script(
        'amannisa-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        $script_ver,
        true
    );

    // Pass dynamic contact email and AJAX parameters to client-side JS
    $contact_email = get_theme_mod( 'contact_email', 'amnnisafoundation@gmail.com' );
    wp_localize_script( 'amannisa-main', 'amannisaData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'amannisa_form_nonce' ),
        'mailTo'  => $contact_email,
    ) );
}
add_action( 'wp_enqueue_scripts', 'amannisa_scripts' );

/**
 * Helper to get asset URI
 */
function amannisa_asset( $path = '' ) {
    return get_template_directory_uri() . '/assets/' . ltrim( $path, '/' );
}

/**
 * Helper to safely retrieve customizer option with fallback
 */
function amannisa_get_option( $key, $default = '' ) {
    return get_theme_mod( $key, $default );
}

/**
 * Filter body class
 */
function amannisa_body_classes( $classes ) {
    $classes[] = 'amannisa-platform';
    return $classes;
}
add_filter( 'body_class', 'amannisa_body_classes' );

/**
 * Security: Send Modern HTTP Security Headers
 */
function amannisa_security_headers() {
    if ( ! is_admin() ) {
        header( 'X-Content-Type-Options: nosniff' );
        header( 'X-Frame-Options: SAMEORIGIN' );
        header( 'X-XSS-Protection: 1; mode=block' );
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
        header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
    }
}
add_action( 'send_headers', 'amannisa_security_headers' );

/**
 * Security: Hide WordPress Version & Generator Tags
 */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Security: Disable XML-RPC and Pingbacks
 */
add_filter( 'xmlrpc_enabled', '__return_false' );
add_filter( 'wp_headers', function( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
} );

/**
 * Security: Prevent User / Author Enumeration
 */
function amannisa_prevent_author_scan() {
    if ( ! is_admin() && isset( $_REQUEST['author'] ) && ( is_numeric( $_REQUEST['author'] ) || empty( $_REQUEST['author'] ) ) ) {
        wp_safe_redirect( home_url(), 301 );
        exit;
    }
}
add_action( 'template_redirect', 'amannisa_prevent_author_scan' );

/**
 * Speed: Remove WordPress Core Bloat (Emojis, Block Styles, Embeds)
 */
function amannisa_cleanup_bloat() {
    // Disable Emojis
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    // Dequeue unused Gutenberg CSS on frontend
    if ( ! is_admin() ) {
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
        wp_dequeue_style( 'wc-blocks-style' );
        wp_dequeue_style( 'classic-theme-styles' );
        wp_dequeue_style( 'global-styles' );
        wp_deregister_script( 'wp-embed' );
    }
}
add_action( 'init', 'amannisa_cleanup_bloat' );
add_action( 'wp_enqueue_scripts', 'amannisa_cleanup_bloat', 100 );

/**
 * Speed: Defer Interactive Scripts for non-blocking parsing
 */
function amannisa_defer_scripts( $tag, $handle ) {
    if ( 'amannisa-main' === $handle && strpos( $tag, 'defer' ) === false ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'amannisa_defer_scripts', 10, 2 );

// Include Customizer Settings
require_once get_template_directory() . '/inc/customizer.php';

// Include Custom Post Types (Team Members)
require_once get_template_directory() . '/inc/post-types.php';

// Include Form Submissions & Email Handler
require_once get_template_directory() . '/inc/form-handler.php';

