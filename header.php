<?php
/**
 * The header for our theme
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site-wrapper">
    <a class="skip-link screen-reader-text" href="#primary-content">
        <?php esc_html_e( 'Skip to content', 'drive' ); ?>
    </a>

    <?php get_template_part( 'template-parts/global/site-header' ); ?>

    <main id="primary-content" class="site-main" tabindex="-1">
