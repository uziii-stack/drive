<?php
/**
 * Theme Helper Functions
 *
 * Presentation and utility helpers for Drive theme.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Return theme version
 *
 * @return string
 */
function drive_get_version() {
    return defined( 'DRIVE_THEME_VERSION' ) ? DRIVE_THEME_VERSION : '1.0.0';
}

/**
 * Output breadcrumbs foundation
 */
function drive_render_breadcrumbs() {
    if ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
        rank_math_the_breadcrumbs();
        return;
    }

    if ( function_exists( 'yoast_breadcrumb' ) ) {
        yoast_breadcrumb( '<nav class="breadcrumbs-nav" aria-label="' . esc_attr__( 'Breadcrumb', 'drive' ) . '">', '</nav>' );
        return;
    }

    if ( is_front_page() ) {
        return;
    }

    echo '<nav class="drive-breadcrumbs" aria-label="' . esc_attr__( 'Breadcrumb', 'drive' ) . '">';
    echo '<ol class="breadcrumb-list">';
    echo '<li class="breadcrumb-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Home', 'drive' ) . '</a></li>';

    if ( is_page() ) {
        global $post;
        if ( $post->post_parent ) {
            $parent_id   = $post->post_parent;
            $breadcrumbs = array();
            while ( $parent_id ) {
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            foreach ( $breadcrumbs as $crumb ) {
                echo $crumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }
        echo '<li class="breadcrumb-item is-active" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
    } elseif ( is_single() ) {
        $category = get_the_category();
        if ( ! empty( $category ) ) {
            echo '<li class="breadcrumb-item"><a href="' . esc_url( get_category_link( $category[0]->term_id ) ) . '">' . esc_html( $category[0]->name ) . '</a></li>';
        }
        echo '<li class="breadcrumb-item is-active" aria-current="page">' . esc_html( get_the_title() ) . '</li>';
    } elseif ( is_archive() ) {
        echo '<li class="breadcrumb-item is-active" aria-current="page">' . esc_html( get_the_archive_title() ) . '</li>';
    } elseif ( is_search() ) {
        echo '<li class="breadcrumb-item is-active" aria-current="page">' . sprintf( esc_html__( 'Search: %s', 'drive' ), esc_html( get_search_query() ) ) . '</li>';
    } elseif ( is_404() ) {
        echo '<li class="breadcrumb-item is-active" aria-current="page">' . esc_html__( 'Page Not Found', 'drive' ) . '</li>';
    }

    echo '</ol>';
    echo '</nav>';
}

/**
 * Return all 50 US States + DC in alphabetical order
 *
 * @return array
 */
function drive_get_all_states() {
    return array(
        'AL' => array( 'name' => 'Alabama', 'slug' => 'alabama' ),
        'AK' => array( 'name' => 'Alaska', 'slug' => 'alaska' ),
        'AZ' => array( 'name' => 'Arizona', 'slug' => 'arizona' ),
        'AR' => array( 'name' => 'Arkansas', 'slug' => 'arkansas' ),
        'CA' => array( 'name' => 'California', 'slug' => 'california' ),
        'CO' => array( 'name' => 'Colorado', 'slug' => 'colorado' ),
        'CT' => array( 'name' => 'Connecticut', 'slug' => 'connecticut' ),
        'DE' => array( 'name' => 'Delaware', 'slug' => 'delaware' ),
        'DC' => array( 'name' => 'District of Columbia', 'slug' => 'district-of-columbia' ),
        'FL' => array( 'name' => 'Florida', 'slug' => 'florida' ),
        'GA' => array( 'name' => 'Georgia', 'slug' => 'georgia' ),
        'HI' => array( 'name' => 'Hawaii', 'slug' => 'hawaii' ),
        'ID' => array( 'name' => 'Idaho', 'slug' => 'idaho' ),
        'IL' => array( 'name' => 'Illinois', 'slug' => 'illinois' ),
        'IN' => array( 'name' => 'Indiana', 'slug' => 'indiana' ),
        'IA' => array( 'name' => 'Iowa', 'slug' => 'iowa' ),
        'KS' => array( 'name' => 'Kansas', 'slug' => 'kansas' ),
        'KY' => array( 'name' => 'Kentucky', 'slug' => 'kentucky' ),
        'LA' => array( 'name' => 'Louisiana', 'slug' => 'louisiana' ),
        'ME' => array( 'name' => 'Maine', 'slug' => 'maine' ),
        'MD' => array( 'name' => 'Maryland', 'slug' => 'maryland' ),
        'MA' => array( 'name' => 'Massachusetts', 'slug' => 'massachusetts' ),
        'MI' => array( 'name' => 'Michigan', 'slug' => 'michigan' ),
        'MN' => array( 'name' => 'Minnesota', 'slug' => 'minnesota' ),
        'MS' => array( 'name' => 'Mississippi', 'slug' => 'mississippi' ),
        'MO' => array( 'name' => 'Missouri', 'slug' => 'missouri' ),
        'MT' => array( 'name' => 'Montana', 'slug' => 'montana' ),
        'NE' => array( 'name' => 'Nebraska', 'slug' => 'nebraska' ),
        'NV' => array( 'name' => 'Nevada', 'slug' => 'nevada' ),
        'NH' => array( 'name' => 'New Hampshire', 'slug' => 'new-hampshire' ),
        'NJ' => array( 'name' => 'New Jersey', 'slug' => 'new-jersey' ),
        'NM' => array( 'name' => 'New Mexico', 'slug' => 'new-mexico' ),
        'NY' => array( 'name' => 'New York', 'slug' => 'new-york' ),
        'NC' => array( 'name' => 'North Carolina', 'slug' => 'north-carolina' ),
        'ND' => array( 'name' => 'North Dakota', 'slug' => 'north-dakota' ),
        'OH' => array( 'name' => 'Ohio', 'slug' => 'ohio' ),
        'OK' => array( 'name' => 'Oklahoma', 'slug' => 'oklahoma' ),
        'OR' => array( 'name' => 'Oregon', 'slug' => 'oregon' ),
        'PA' => array( 'name' => 'Pennsylvania', 'slug' => 'pennsylvania' ),
        'RI' => array( 'name' => 'Rhode Island', 'slug' => 'rhode-island' ),
        'SC' => array( 'name' => 'South Carolina', 'slug' => 'south-carolina' ),
        'SD' => array( 'name' => 'South Dakota', 'slug' => 'south-dakota' ),
        'TN' => array( 'name' => 'Tennessee', 'slug' => 'tennessee' ),
        'TX' => array( 'name' => 'Texas', 'slug' => 'texas' ),
        'UT' => array( 'name' => 'Utah', 'slug' => 'utah' ),
        'VT' => array( 'name' => 'Vermont', 'slug' => 'vermont' ),
        'VA' => array( 'name' => 'Virginia', 'slug' => 'virginia' ),
        'WA' => array( 'name' => 'Washington', 'slug' => 'washington' ),
        'WV' => array( 'name' => 'West Virginia', 'slug' => 'west-virginia' ),
        'WI' => array( 'name' => 'Wisconsin', 'slug' => 'wisconsin' ),
        'WY' => array( 'name' => 'Wyoming', 'slug' => 'wyoming' ),
    );
}

/**
 * Return available vehicle permit test types
 *
 * @return array
 */
function drive_get_vehicle_types() {
    return array(
        'car' => array(
            'name'  => __( 'Car', 'drive' ),
            'slug'  => 'car-practice-test',
            'icon'  => 'car',
        ),
        'cdl' => array(
            'name'  => __( 'CDL (Commercial Vehicles)', 'drive' ),
            'slug'  => 'cdl-practice-test',
            'icon'  => 'bus',
        ),
        'motorcycle' => array(
            'name'  => __( 'Motorcycle', 'drive' ),
            'slug'  => 'motorcycle-practice-test',
            'icon'  => 'motorcycle',
        ),
    );
}
