<?php
/**
 * Theme basic setup and theme supports
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'drive_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     */
    function drive_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'drive', DRIVE_THEME_DIR . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 800, 450, true );

        // Register navigation menu locations
        register_nav_menus(
            array(
                'primary' => esc_html__( 'Primary Header Menu', 'drive' ),
                'footer'  => esc_html__( 'Footer Menu', 'drive' ),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Custom logo support
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 60,
                'width'       => 240,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Responsive embedded content
        add_theme_support( 'responsive-embeds' );

        // Editor styles support
        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/css/main.css' );
    }
endif;
add_action( 'after_setup_theme', 'drive_setup' );

/**
 * Register widget area.
 */
function drive_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'drive' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here to appear in your sidebar on posts/archives.', 'drive' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'drive_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function drive_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'drive_content_width', 1200 );
}
add_action( 'after_setup_theme', 'drive_content_width', 0 );
