<?php
/**
 * Drive functions and definitions
 *
 * @package Drive
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Theme Constants
 */
define( 'DRIVE_THEME_VERSION', '1.0.0' );
define( 'DRIVE_THEME_DIR', get_template_directory() );
define( 'DRIVE_THEME_URI', get_template_directory_uri() );

/**
 * Modular Theme Includes
 */
require_once DRIVE_THEME_DIR . '/inc/setup.php';
require_once DRIVE_THEME_DIR . '/inc/enqueue.php';
require_once DRIVE_THEME_DIR . '/inc/template-functions.php';
require_once DRIVE_THEME_DIR . '/inc/template-tags.php';
require_once DRIVE_THEME_DIR . '/inc/helpers.php';
require_once DRIVE_THEME_DIR . '/inc/customizer.php';
require_once DRIVE_THEME_DIR . '/inc/us-map-data.php';
