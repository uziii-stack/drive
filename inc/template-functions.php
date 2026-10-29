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
    $vars[] = 'drive_vehicle';
    return $vars;
}
add_filter( 'query_vars', 'drive_register_query_vars' );

/**
 * Register state and cheat sheet rewrite rules:
 * - /[state]/
 * - /[state]/[vehicle]-cheat-sheet/
 */
function drive_state_rewrite_rules() {
    add_rewrite_tag( '%drive_state%', '([^&/]+)' );
    add_rewrite_tag( '%drive_vehicle%', '([^&/]+)' );

    $all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
    $slugs = array();
    foreach ( $all_states as $code => $data ) {
        if ( ! empty( $data['slug'] ) ) {
            $slugs[] = preg_quote( $data['slug'], '#' );
        }
    }

    if ( ! empty( $slugs ) ) {
        $state_pattern = '(' . implode( '|', $slugs ) . ')';
        // Specific cheat sheet product page: /[state]/[vehicle]-cheat-sheet/
        add_rewrite_rule( '^' . $state_pattern . '/(car|motorcycle|cdl|truck)-cheat-sheet/?$', 'index.php?drive_state=$matches[1]&drive_vehicle=$matches[2]', 'top' );
        // State hub: /[state]/
        add_rewrite_rule( '^' . $state_pattern . '/?$', 'index.php?drive_state=$matches[1]', 'top' );
    }

    // Fallback generic rewrite rules
    add_rewrite_rule( '^([a-z\-]+)/(car|motorcycle|cdl|truck)-cheat-sheet/?$', 'index.php?drive_state=$matches[1]&drive_vehicle=$matches[2]', 'bottom' );
    add_rewrite_rule( '^([a-z\-]+)/?$', 'index.php?drive_state=$matches[1]', 'bottom' );
}
add_action( 'init', 'drive_state_rewrite_rules' );

/**
 * Route state and cheat-sheet requests to their respective templates
 *
 * @param string $template Matched template.
 * @return string
 */
function drive_state_template_include( $template ) {
    $state   = get_query_var( 'drive_state' );
    $vehicle = get_query_var( 'drive_vehicle' );

    // URL path detection fallback if permalinks are not flushed
    $req_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
    $site_path = wp_parse_url( home_url(), PHP_URL_PATH );
    if ( ! empty( $site_path ) && $site_path !== '/' ) {
        $req_uri = substr( $req_uri, strlen( rtrim( $site_path, '/' ) ) );
    }
    $parts = explode( '?', $req_uri );
    $path_segments = array_values( array_filter( explode( '/', trim( $parts[0], '/' ) ) ) );

    if ( count( $path_segments ) >= 2 && preg_match( '/^(car|motorcycle|cdl|truck)-cheat-sheet$/i', $path_segments[1], $matches ) ) {
        $state   = sanitize_title( $path_segments[0] );
        $vehicle = strtolower( $matches[1] );
        set_query_var( 'drive_state', $state );
        set_query_var( 'drive_vehicle', $vehicle );
    } elseif ( empty( $state ) && count( $path_segments ) === 1 ) {
        $state = sanitize_title( $path_segments[0] );
        set_query_var( 'drive_state', $state );
    }

    if ( ! empty( $state ) ) {
        $all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
        $is_valid_state = false;
        foreach ( $all_states as $code => $data ) {
            if ( $data['slug'] === $state || strtolower( $code ) === strtolower( $state ) ) {
                $is_valid_state = true;
                $state = $data['slug'];
                break;
            }
        }

        if ( $is_valid_state ) {
            // Check if this is a cheat sheet product page
            if ( ! empty( $vehicle ) ) {
                $cheat_sheet_template = DRIVE_THEME_DIR . '/templates/cheat-sheets/single-cheat-sheet.php';
                if ( file_exists( $cheat_sheet_template ) ) {
                    status_header( 200 );
                    global $wp_query;
                    if ( is_object( $wp_query ) ) {
                        $wp_query->is_404 = false;
                    }
                    return $cheat_sheet_template;
                }
            }

            // Otherwise, route to the state hub page
            $state_template = DRIVE_THEME_DIR . '/templates/states/state-hub.php';
            if ( file_exists( $state_template ) ) {
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
