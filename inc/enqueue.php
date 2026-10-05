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

    // Main stylesheet (Theme definitions & CSS variables)
    $style_css_path = DRIVE_THEME_DIR . '/style.css';
    $style_version  = file_exists( $style_css_path ) ? filemtime( $style_css_path ) : $theme_version;
    wp_enqueue_style( 'drive-theme-style', get_stylesheet_uri(), array(), $style_version );

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
