<?php
/**
 * Enqueue scripts and styles
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue styles and scripts.
 */
function drive_scripts() {
    $theme_version = DRIVE_THEME_VERSION;

    // Google Fonts: Plus Jakarta Sans (400, 500, 600, 700, 800)
    wp_enqueue_style(
        'drive-google-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet (Theme definitions & CSS variables)
    $style_css_path = DRIVE_THEME_DIR . '/style.css';
    $style_version  = file_exists( $style_css_path ) ? filemtime( $style_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-theme-style', get_stylesheet_uri(), array( 'drive-google-fonts' ), $style_version );

    // Main CSS (Layout, components, responsive primitives)
    $main_css_path = DRIVE_THEME_DIR . '/assets/css/main.css';
    $main_version  = file_exists( $main_css_path ) ? filemtime( $main_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-main-style', DRIVE_THEME_URI . '/assets/css/main.css', array( 'drive-theme-style' ), $main_version );

    // Header Component CSS
    $header_css_path = DRIVE_THEME_DIR . '/assets/css/components/header.css';
    $header_version  = file_exists( $header_css_path ) ? filemtime( $header_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-header-style', DRIVE_THEME_URI . '/assets/css/components/header.css', array( 'drive-main-style' ), $header_version );

    // State Map Component CSS
    $state_map_css_path = DRIVE_THEME_DIR . '/assets/css/components/state-map.css';
    $state_map_version  = file_exists( $state_map_css_path ) ? filemtime( $state_map_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-state-map-style', DRIVE_THEME_URI . '/assets/css/components/state-map.css', array( 'drive-main-style' ), $state_map_version );

    // Hero Section Component CSS
    $hero_css_path = DRIVE_THEME_DIR . '/assets/css/components/hero.css';
    $hero_version  = file_exists( $hero_css_path ) ? filemtime( $hero_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-hero-style', DRIVE_THEME_URI . '/assets/css/components/hero.css', array( 'drive-main-style' ), $hero_version );

    // Features / What We Offer Section Component CSS
    $features_css_path = DRIVE_THEME_DIR . '/assets/css/components/features.css';
    $features_version  = file_exists( $features_css_path ) ? filemtime( $features_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-features-style', DRIVE_THEME_URI . '/assets/css/components/features.css', array( 'drive-main-style' ), $features_version );

    // How It Works Section Component CSS
    $how_css_path = DRIVE_THEME_DIR . '/assets/css/components/how-it-works.css';
    $how_version  = file_exists( $how_css_path ) ? filemtime( $how_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-how-it-works-style', DRIVE_THEME_URI . '/assets/css/components/how-it-works.css', array( 'drive-main-style' ), $how_version );

    // YouTube Banner Section Component CSS
    $youtube_css_path = DRIVE_THEME_DIR . '/assets/css/components/youtube.css';
    $youtube_version  = file_exists( $youtube_css_path ) ? filemtime( $youtube_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-youtube-style', DRIVE_THEME_URI . '/assets/css/components/youtube.css', array( 'drive-main-style' ), $youtube_version );

    // Testimonials Section Component CSS
    $testimonials_css_path = DRIVE_THEME_DIR . '/assets/css/components/testimonials.css';
    $testimonials_version  = file_exists( $testimonials_css_path ) ? filemtime( $testimonials_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-testimonials-style', DRIVE_THEME_URI . '/assets/css/components/testimonials.css', array( 'drive-main-style' ), $testimonials_version );

    // FAQ Section Component CSS
    $faq_css_path = DRIVE_THEME_DIR . '/assets/css/components/faq.css';
    $faq_version  = file_exists( $faq_css_path ) ? filemtime( $faq_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-faq-style', DRIVE_THEME_URI . '/assets/css/components/faq.css', array( 'drive-main-style' ), $faq_version );

    // Final CTA Section Component CSS
    $final_cta_css_path = DRIVE_THEME_DIR . '/assets/css/components/final-cta.css';
    $final_cta_version  = file_exists( $final_cta_css_path ) ? filemtime( $final_cta_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-final-cta-style', DRIVE_THEME_URI . '/assets/css/components/final-cta.css', array( 'drive-main-style' ), $final_cta_version );

    // Footer Component CSS
    $footer_css_path = DRIVE_THEME_DIR . '/assets/css/components/footer.css';
    $footer_version  = file_exists( $footer_css_path ) ? filemtime( $footer_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-footer-style', DRIVE_THEME_URI . '/assets/css/components/footer.css', array( 'drive-main-style' ), $footer_version );

    // 404 Error Page Component CSS
    if ( is_404() ) {
        $error_404_css_path = DRIVE_THEME_DIR . '/assets/css/components/404.css';
        $error_404_version  = file_exists( $error_404_css_path ) ? filemtime( $error_404_css_path ) : $theme_version;
        wp_enqueue_style( 'drive-404-style', DRIVE_THEME_URI . '/assets/css/components/404.css', array( 'drive-main-style' ), $error_404_version );
    }

    // State Page Component CSS
    $state_hero_css_path = DRIVE_THEME_DIR . '/assets/css/components/state-hero.css';
    $state_hero_version  = file_exists( $state_hero_css_path ) ? filemtime( $state_hero_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-state-hero-style', DRIVE_THEME_URI . '/assets/css/components/state-hero.css', array( 'drive-main-style' ), $state_hero_version );

    // Single Cheat Sheet Product Page CSS
    $cheat_sheet_page_css_path = DRIVE_THEME_DIR . '/assets/css/components/cheat-sheet-page.css';
    $cheat_sheet_page_version  = file_exists( $cheat_sheet_page_css_path ) ? filemtime( $cheat_sheet_page_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-cheat-sheet-page-style', DRIVE_THEME_URI . '/assets/css/components/cheat-sheet-page.css', array( 'drive-state-hero-style' ), $cheat_sheet_page_version );

    // Contact Page CSS (only on contact page template or /contact/ slug)
    if ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
        $contact_css_path = DRIVE_THEME_DIR . '/assets/css/components/contact.css';
        $contact_version  = file_exists( $contact_css_path ) ? filemtime( $contact_css_path ) : $theme_version;
        wp_enqueue_style( 'drive-contact-style', DRIVE_THEME_URI . '/assets/css/components/contact.css', array( 'drive-main-style' ), $contact_version );
    }


    // Main JS (Lightweight vanilla JS)
    $main_js_path = DRIVE_THEME_DIR . '/assets/js/main.js';
    $js_version   = file_exists( $main_js_path ) ? filemtime( $main_js_path ) : $theme_version;
    wp_enqueue_script(
        'drive-main-script',
        DRIVE_THEME_URI . '/assets/js/main.js',
        array(),
        $js_version,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    // State Map Component JS
    $state_map_js_path = DRIVE_THEME_DIR . '/assets/js/components/state-map.js';
    $state_map_js_ver  = file_exists( $state_map_js_path ) ? filemtime( $state_map_js_path ) : $theme_version;
    wp_enqueue_script(
        'drive-state-map-script',
        DRIVE_THEME_URI . '/assets/js/components/state-map.js',
        array( 'drive-main-script' ),
        $state_map_js_ver,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    // Smooth Scroll Component JS
    $smooth_scroll_js_path = DRIVE_THEME_DIR . '/assets/js/components/smooth-scroll.js';
    $smooth_scroll_js_ver  = file_exists( $smooth_scroll_js_path ) ? filemtime( $smooth_scroll_js_path ) : $theme_version;
    wp_enqueue_script(
        'drive-smooth-scroll',
        DRIVE_THEME_URI . '/assets/js/components/smooth-scroll.js',
        array( 'drive-main-script' ),
        $smooth_scroll_js_ver,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    // State Hero Component JS
    $state_hero_js_path = DRIVE_THEME_DIR . '/assets/js/components/state-hero.js';
    $state_hero_js_ver  = file_exists( $state_hero_js_path ) ? filemtime( $state_hero_js_path ) : $theme_version;
    wp_enqueue_script(
        'drive-state-hero-script',
        DRIVE_THEME_URI . '/assets/js/components/state-hero.js',
        array( 'drive-main-script' ),
        $state_hero_js_ver,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    // Single Cheat Sheet Product Page Component JS
    $cheat_sheet_js_path = DRIVE_THEME_DIR . '/assets/js/components/cheat-sheet-page.js';
    $cheat_sheet_js_ver  = file_exists( $cheat_sheet_js_path ) ? filemtime( $cheat_sheet_js_path ) : $theme_version;
    wp_enqueue_script(
        'drive-cheat-sheet-script',
        DRIVE_THEME_URI . '/assets/js/components/cheat-sheet-page.js',
        array( 'drive-main-script' ),
        $cheat_sheet_js_ver,
        array(
            'in_footer' => true,
            'strategy'  => 'defer',
        )
    );

    // Contact Page Component JS
    if ( is_page_template( 'page-contact.php' ) || is_page( 'contact' ) ) {
        $contact_js_path = DRIVE_THEME_DIR . '/assets/js/components/contact.js';
        $contact_js_ver  = file_exists( $contact_js_path ) ? filemtime( $contact_js_path ) : $theme_version;
        wp_enqueue_script(
            'drive-contact-script',
            DRIVE_THEME_URI . '/assets/js/components/contact.js',
            array( 'drive-main-script' ),
            $contact_js_ver,
            array(
                'in_footer' => true,
                'strategy'  => 'defer',
            )
        );
        wp_localize_script(
            'drive-contact-script',
            'driveContactData',
            array(
                'ajaxUrl' => esc_url( admin_url( 'admin-ajax.php' ) ),
            )
        );
    }

    // Localized data
    wp_localize_script(
        'drive-main-script',
        'driveData',
        array(
            'siteUrl' => esc_url( home_url( '/' ) ),
            'ajaxUrl' => esc_url( admin_url( 'admin-ajax.php' ) ),
        )
    );

    // Comments reply script
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'drive_scripts' );
