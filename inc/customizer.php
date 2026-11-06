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

    /* ==========================================================================
       1. Contact Settings Section
       ========================================================================== */
    $wp_customize->add_section(
        'drive_contact_section',
        array(
            'title'       => __( 'Contact Settings', 'drive' ),
            'priority'    => 35,
            'description' => __( 'Configure the contact email used on the Contact page, in the footer, and for receiving contact form inquiries.', 'drive' ),
        )
    );

    // Contact Email Setting
    $wp_customize->add_setting(
        'drive_contact_email',
        array(
            'default'           => get_option( 'admin_email' ),
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        )
    );

    $wp_customize->add_control(
        'drive_contact_email',
        array(
            'label'       => __( 'Contact & Support Email', 'drive' ),
            'description' => __( 'Used as the displayed support email on the Contact Us page, footer mail link, and target inbox for contact form messages.', 'drive' ),
            'section'     => 'drive_contact_section',
            'type'        => 'email',
        )
    );

    /* ==========================================================================
       2. Social Links Section
       ========================================================================== */
    $wp_customize->add_section(
        'drive_social_section',
        array(
            'title'       => __( 'Social Media Links', 'drive' ),
            'priority'    => 36,
            'description' => __( 'Manage links for social profiles displayed across the site (e.g. footer social row and homepage YouTube banner). Leave blank to hide.', 'drive' ),
        )
    );

    // YouTube Channel URL
    $wp_customize->add_setting(
        'drive_youtube_url',
        array(
            'default'           => 'https://www.youtube.com',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'drive_youtube_url',
        array(
            'label'       => __( 'YouTube Channel URL', 'drive' ),
            'description' => __( 'URL to your official YouTube channel (used in the footer and homepage banner).', 'drive' ),
            'section'     => 'drive_social_section',
            'type'        => 'url',
        )
    );

    // Facebook URL
    $wp_customize->add_setting(
        'drive_facebook_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'drive_facebook_url',
        array(
            'label'       => __( 'Facebook Page URL', 'drive' ),
            'section'     => 'drive_social_section',
            'type'        => 'url',
        )
    );

    // Twitter / X URL
    $wp_customize->add_setting(
        'drive_twitter_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'drive_twitter_url',
        array(
            'label'       => __( 'X (Twitter) Profile URL', 'drive' ),
            'section'     => 'drive_social_section',
            'type'        => 'url',
        )
    );

    // Instagram URL
    $wp_customize->add_setting(
        'drive_instagram_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'drive_instagram_url',
        array(
            'label'       => __( 'Instagram Profile URL', 'drive' ),
            'section'     => 'drive_social_section',
            'type'        => 'url',
        )
    );

    // TikTok URL
    $wp_customize->add_setting(
        'drive_tiktok_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        )
    );
    $wp_customize->add_control(
        'drive_tiktok_url',
        array(
            'label'       => __( 'TikTok Profile URL', 'drive' ),
            'section'     => 'drive_social_section',
            'type'        => 'url',
        )
    );
}
add_action( 'customize_register', 'drive_customize_register' );

/**
 * Helper to get configured contact email with fallback to admin_email
 *
 * @return string
 */
function drive_get_contact_email() {
    $email = get_theme_mod( 'drive_contact_email' );
    if ( ! empty( $email ) && is_email( $email ) ) {
        return sanitize_email( $email );
    }
    return get_option( 'admin_email' );
}

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
