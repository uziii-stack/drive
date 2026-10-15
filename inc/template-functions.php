<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function drive_body_classes( $classes ) {
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    if ( is_front_page() ) {
        $classes[] = 'is-front-page';
    }

    return $classes;
}
add_filter( 'body_class', 'drive_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function drive_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'drive_pingback_header' );

/**
 * Register state query variables
 *
 * @param array $vars Registered query vars.
 * @return array
 */
function drive_register_query_vars( $vars ) {
    $vars[] = 'drive_state';
    return $vars;
}
add_filter( 'query_vars', 'drive_register_query_vars' );

/**
 * Register state rewrite rules (/[state]/)
 */
function drive_state_rewrite_rules() {
    add_rewrite_tag( '%drive_state%', '([^&/]+)' );
    add_rewrite_rule( '^([a-z\-]+)/?$', 'index.php?drive_state=$matches[1]', 'bottom' );
}
add_action( 'init', 'drive_state_rewrite_rules' );

/**
 * Route state requests to the state-hub template
 *
 * @param string $template Matched template.
 * @return string
 */
function drive_state_template_include( $template ) {
    $state = get_query_var( 'drive_state' );
    if ( ! empty( $state ) ) {
        $all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
        $is_valid_state = false;
        foreach ( $all_states as $code => $data ) {
            if ( $data['slug'] === $state || strtolower( $code ) === strtolower( $state ) ) {
                $is_valid_state = true;
                break;
            }
        }

        if ( $is_valid_state ) {
            $state_template = DRIVE_THEME_DIR . '/templates/states/state-hub.php';
            if ( file_exists( $state_template ) ) {
                return $state_template;
            }
        }
    }

    return $template;
}
add_filter( 'template_include', 'drive_state_template_include' );
