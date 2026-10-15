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

    $all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
    $slugs = array();
    foreach ( $all_states as $code => $data ) {
        if ( ! empty( $data['slug'] ) ) {
            $slugs[] = preg_quote( $data['slug'], '#' );
        }
    }

    if ( ! empty( $slugs ) ) {
        $pattern = '^(' . implode( '|', $slugs ) . ')/?$';
        add_rewrite_rule( $pattern, 'index.php?drive_state=$matches[1]', 'top' );
    }

    // Also support fallback pattern
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

    // If query var isn't set yet (e.g. rewrite cache pending or query param ?state=xyz)
    if ( empty( $state ) && isset( $_GET['state'] ) && ! empty( $_GET['state'] ) ) {
        $state = sanitize_title( wp_unslash( $_GET['state'] ) );
    }

    // Direct path detection fallback if permalinks are not flushed yet
    if ( empty( $state ) ) {
        $req_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
        $site_path = wp_parse_url( home_url(), PHP_URL_PATH );
        if ( ! empty( $site_path ) && $site_path !== '/' ) {
            $req_uri = substr( $req_uri, strlen( rtrim( $site_path, '/' ) ) );
        }
        $parts = explode( '?', $req_uri );
        $path = trim( $parts[0], '/' );
        if ( ! empty( $path ) && strpos( $path, '/' ) === false ) {
            $all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
            foreach ( $all_states as $code => $data ) {
                if ( $data['slug'] === $path || strtolower( $code ) === strtolower( $path ) ) {
                    $state = $data['slug'];
                    set_query_var( 'drive_state', $state );
                    break;
                }
            }
        }
    }

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
                // Ensure 200 HTTP status if it was treated as 404
                status_header( 200 );
                global $wp_query;
                if ( is_object( $wp_query ) ) {
                    $wp_query->is_404 = false;
                }
                return $state_template;
            }
        }
    }

    return $template;
}
add_filter( 'template_include', 'drive_state_template_include' );
