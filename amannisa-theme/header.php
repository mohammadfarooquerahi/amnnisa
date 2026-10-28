<?php
/**
 * Header template for Amannisa theme
 * Includes Complete SEO Suite, Preloader, Anti-FOUC Architecture & Security Upgrades
 *
 * @package Amannisa
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

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

$hero_preload_img = amannisa_get_option( 'hero_image' );
if ( empty( $hero_preload_img ) ) {
    $hero_preload_img = amannisa_asset( 'images/hero.jpg' );
}

$seo_title = $brand_name . " — Women's Safety & Empowerment Platform | Dignity. Safety. Innovation.";
$seo_desc  = "Amnnisa is Pakistan's dedicated women's safety platform. Providing confidential harassment reporting, expert legal guidance, technical security, and moral support. Incubated at MUET BIC.";
$canonical_url = home_url( '/' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    
    <!-- Security: Auto-upgrade any insecure HTTP asset requests to HTTPS (Prevents Mixed Content Blocks) -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Primary Search Engine Optimization (SEO) -->
    <title><?php echo esc_html( $seo_title ); ?></title>
    <meta name="description" content="<?php echo esc_attr( $seo_desc ); ?>">
    <meta name="keywords" content="Amnnisa, women safety Pakistan, harassment reporting, legal support women, cyber harassment help, women rights Sindh, MUET BIC incubator, report harassment anonymous">
    <meta name="author" content="Homair Nisar, Amnnisa">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url( $canonical_url ); ?>">
    <link rel="sitemap" type="application/xml" title="Sitemap" href="<?php echo esc_url( home_url( '/wp-sitemap.xml' ) ); ?>">

    <!-- Social Media Meta: OpenGraph (Facebook, WhatsApp, LinkedIn, Instagram) -->
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo esc_attr( $seo_title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $seo_desc ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $canonical_url ); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr( $brand_name ); ?>">
    <meta property="og:image" content="<?php echo esc_url( $custom_logo_url ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr( $brand_name ); ?> - Women's Safety Platform">

    <!-- Social Media Meta: Twitter / X Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $seo_title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $seo_desc ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $custom_logo_url ); ?>">

    <!-- Schema.org JSON-LD Structured Data for Google Rich Results -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "NGO",
          "@id": "<?php echo esc_url( $canonical_url ); ?>#organization",
          "name": "<?php echo esc_js( $brand_name ); ?>",
          "alternateName": "Amnnisa Foundation",
          "url": "<?php echo esc_url( $canonical_url ); ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "<?php echo esc_url( $custom_logo_url ); ?>",
            "caption": "<?php echo esc_js( $brand_name ); ?> Logo"
          },
          "description": "<?php echo esc_js( $seo_desc ); ?>",
          "founder": {
            "@type": "Person",
            "name": "Homair Nisar"
          },
          "foundingLocation": "Business Incubation Center, Mehran University of Engineering and Technology (MUET), Jamshoro",
          "sameAs": [
            "https://www.instagram.com/amannisa_pk",
            "https://whatsapp.com/channel/0029Vb7sh2jI7BeKLp1uf13O",
            "https://www.linkedin.com/in/mohammadfarooque/"
          ],
          "contactPoint": {
            "@type": "ContactPoint",
            "email": "amnnisafoundation@gmail.com",
            "contactType": "emergency support & confidential reporting",
            "availableLanguage": ["English", "Urdu", "Sindhi"]
          }
        },
        {
          "@type": "WebSite",
          "@id": "<?php echo esc_url( $canonical_url ); ?>#website",
          "url": "<?php echo esc_url( $canonical_url ); ?>",
          "name": "<?php echo esc_js( $brand_name ); ?>",
          "publisher": { "@id": "<?php echo esc_url( $canonical_url ); ?>#organization" }
        }
      ]
    }
    </script>

    <!-- Critical Anti-FOUC Inlined Styling & Preloader Engine -->
    <style id="amannisa-critical-css">
    :root {
      --pink: #E8006F; --pink-hover: #c9005f; --pink-soft: #ffe6e6; --pink-light: #fff0f5;
      --bg: #FFF8E6; --bg-card: #FFF3E3; --ink: #141414; --mut: #6b6b76; --line: #f5d3d8;
      --font-sans: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
      --font-display: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      --header-height: 80px;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { background-color: var(--bg); scroll-behavior: smooth; }
    body { font-family: var(--font-sans); background-color: var(--bg); color: var(--ink); line-height: 1.6; margin: 0; padding: 0; overflow-x: hidden; min-height: 100vh; }
    img, svg, video { max-width: 100%; height: auto; display: block; }

    /* Branded Splash Screen / Preloader (Auto-dismisses in < 0.6s, guaranteed ultra-fast) */
    #amannisa-preloader {
      position: fixed; inset: 0; z-index: 999999;
      background: #FFF8E6; display: flex; align-items: center; justify-content: center;
      transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1), visibility 0.35s ease;
      animation: amnAutoDismiss 0.35s cubic-bezier(0.16, 1, 0.3, 1) 0.5s forwards;
      pointer-events: auto;
    }
    #amannisa-preloader.loaded {
      opacity: 0 !important; visibility: hidden !important; pointer-events: none !important;
    }
    @keyframes amnAutoDismiss {
      to {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
      }
    }
    .preloader-content {
      display: flex; flex-direction: column; align-items: center; gap: 14px; text-align: center;
    }
    .preloader-logo {
      width: 84px; height: 84px; border-radius: 22px;
      box-shadow: 0 12px 32px rgba(232, 0, 111, 0.24);
      animation: amnPulse 1.8s infinite ease-in-out;
    }
    @keyframes amnPulse {
      0%, 100% { transform: scale(1); box-shadow: 0 12px 32px rgba(232, 0, 111, 0.24); }
      50% { transform: scale(1.06); box-shadow: 0 18px 44px rgba(232, 0, 111, 0.4); }
    }
    .preloader-spinner {
      width: 28px; height: 28px; border: 3px solid rgba(232, 0, 111, 0.16);
      border-top-color: #E8006F; border-radius: 50%;
      animation: amnSpin 0.75s linear infinite;
    }
    @keyframes amnSpin { to { transform: rotate(360deg); } }
    .preloader-brand {
      font-family: 'Plus Jakarta Sans', sans-serif; font-size: 22px; font-weight: 800; color: #E8006F; letter-spacing: 0.02em;
    }
    .preloader-sub {
      font-family: 'Inter', sans-serif; font-size: 11px; letter-spacing: 0.14em; text-transform: uppercase; color: #8A5A72; font-weight: 700;
    }

    /* Single Page App Section Toggles (Strictly Prevents Page Stacking) */
    .pg:not(.on) { display: none !important; }
    .pg.on { display: block !important; }

    /* Core Layout, Header & Typography */
    h1, h2, h3, h4, .h { font-family: var(--font-display); font-weight: 800; color: var(--ink); line-height: 1.15; letter-spacing: -0.02em; }
    a { color: inherit; text-decoration: none; }
    .wrap { width: 100%; max-width: 1180px; margin: 0 auto; padding: 0 clamp(16px, 4vw, 28px); }
    .site-header { position: sticky; top: 0; z-index: 100; background: rgba(255, 248, 230, 0.96); backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px); border-bottom: 1px solid var(--line); }
    .bar { display: flex; align-items: center; justify-content: space-between; height: 80px; gap: 16px; }
    .brand { display: flex; align-items: center; gap: 12px; }
    .brand img { width: 44px; height: 44px; border-radius: 12px; }
    .brand b { font-size: 20px; font-weight: 800; color: var(--pink); display: block; line-height: 1.1; }
    .brand small { font-size: 10px; letter-spacing: 0.12em; color: var(--mut); display: block; }
    
    /* Navigation Bar on Desktop */
    .main-nav { display: flex !important; align-items: center; gap: clamp(14px, 2.2vw, 28px); }
    .main-nav a { font-weight: 600; font-size: 15px; color: var(--ink); transition: color 0.2s ease; white-space: nowrap; }
    .main-nav a.on, .main-nav a:hover { color: var(--pink); }
    .header-actions { display: flex; align-items: center; gap: 12px; }
    
    /* Hamburger Menu Toggle (Hidden on Desktop, Visible on Mobile) */
    #menu-toggle { display: none !important; font-size: 24px; cursor: pointer; border: none; background: none; padding: 6px; }
    
    /* Buttons & Pills */
    .btn { display: inline-flex; align-items: center; justify-content: center; background: var(--pink); color: #fff !important; font-weight: 600; font-size: 15px; padding: 13px 26px; border-radius: 9999px; border: none; cursor: pointer; text-decoration: none; box-shadow: 0 8px 24px rgba(232, 0, 111, 0.22); transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(232, 0, 111, 0.35); }
    .btn.o { background: transparent; color: var(--pink) !important; border: 2px solid var(--pink); box-shadow: none; }
    .pill { display: inline-block; background: var(--pink-soft); color: var(--pink); font-size: 13px; font-weight: 700; padding: 6px 14px; border-radius: 9999px; }
    
    /* Floating Action / Report Button */
    .rn { position: fixed !important; right: 28px !important; top: 50% !important; transform: translateY(-50%) !important; z-index: 9000 !important; background: var(--pink) !important; color: #fff !important; font-weight: 700 !important; font-size: 13px !important; padding: 14px 24px !important; border-radius: 9999px !important; display: inline-flex !important; align-items: center !important; gap: 8px !important; box-shadow: 0 10px 30px rgba(232, 0, 111, 0.4) !important; text-decoration: none !important; letter-spacing: 0.08em !important; }
    
    /* Hero Section Responsive Grid */
    .hero { padding: clamp(28px, 5vw, 64px) 0; display: grid !important; grid-template-columns: 1.15fr 0.85fr !important; gap: clamp(24px, 4vw, 56px) !important; align-items: center !important; }
    .hero h1 { font-size: clamp(34px, 5vw, 56px); margin: 16px 0 20px; line-height: 1.1; }
    .hero h1 span { color: var(--pink); }
    .hero p { font-size: clamp(16px, 2.2vw, 19px); line-height: 1.6; color: #3c3c44; max-width: 580px; margin-bottom: 28px; }
    .hero-btns { display: flex; gap: 14px; flex-wrap: wrap; }
    .photo-card { position: relative; border-radius: 36px; overflow: hidden; box-shadow: 0 24px 60px rgba(0,0,0,0.12); }
    .photo-card img { width: 100%; height: auto; object-fit: cover; border-radius: 36px; display: block; }

    /* Mobile Breakpoint (<= 991px) */
    @media (max-width: 991px) {
      .main-nav { display: none !important; }
      .main-nav.open { display: flex !important; flex-direction: column; position: fixed; top: 80px; left: 0; right: 0; background: #FFF8E6; padding: 24px; border-bottom: 1px solid var(--line); z-index: 999; box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
      #menu-toggle { display: inline-flex !important; }
      .hero { grid-template-columns: 1fr !important; }
      .rn { top: auto !important; bottom: 20px !important; right: 20px !important; transform: none !important; padding: 12px 20px !important; font-size: 12px !important; }
    }
    </style>
    <noscript><style>#amannisa-preloader { display: none !important; }</style></noscript>

    <!-- Performance Optimization: Preconnect & Preload -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preload" as="image" href="<?php echo esc_url( $hero_preload_img ); ?>" fetchpriority="high">

    <?php wp_head(); ?>

    <?php
    $style_css_file = get_template_directory() . '/assets/css/style.css';
    $style_css_ver  = file_exists( $style_css_file ) ? filemtime( $style_css_file ) : '1.3.0';
    ?>
    <!-- Direct Stylesheet Link with SSL Auto-Upgrade -->
    <link rel="stylesheet" id="amannisa-direct-style" href="<?php echo esc_url( amannisa_asset( 'css/style.css' ) . '?ver=' . $style_css_ver ); ?>">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Amnnisa Branded Splash Preloader (Auto-dismisses in < 0.6s, guaranteed ultra-fast) -->
<div id="amannisa-preloader" aria-label="Loading Amnnisa Platform">
    <div class="preloader-content">
        <img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( $brand_name ); ?> Logo" width="84" height="84" class="preloader-logo">
        <div class="preloader-spinner"></div>
        <span class="preloader-brand"><?php echo esc_html( $brand_name ); ?></span>
        <small class="preloader-sub"><?php echo esc_html( $brand_tagline ); ?></small>
    </div>
</div>
<script>
(function(){
  var p = document.getElementById("amannisa-preloader");
  if (!p) return;
  function d() {
    p.classList.add("loaded");
    setTimeout(function(){ if (p && p.parentNode) p.parentNode.removeChild(p); }, 350);
  }
  p.addEventListener("click", d);
  p.addEventListener("touchstart", d, {passive: true});
  if (document.readyState === "complete") {
    d();
  } else {
    window.addEventListener("load", d);
    setTimeout(d, 500); // Max 0.5s splash
  }
})();
</script>

<!-- Accessible Skip Link -->
<a class="screen-reader-text" href="#main-content" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">
    <?php esc_html_e( 'Skip to content', 'amannisa' ); ?>
</a>

<!-- Header Bar -->
<header class="site-header">
    <div class="wrap bar">
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
