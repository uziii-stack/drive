<?php
/**
 * Theme Customizer
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function drive_customize_register( $wp_customize ) {
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'drive_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'drive_customize_partial_blogdescription',
            )
        );
    }
}
add_action( 'customize_register', 'drive_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return string
 */
function drive_customize_partial_blogname() {
    return get_bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return string
 */
function drive_customize_partial_blogdescription() {
    return get_bloginfo( 'description' );
}
