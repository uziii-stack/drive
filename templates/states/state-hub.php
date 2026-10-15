<?php
/**
 * Template Name: State Page Template
 * Description: Dynamic landing page template for state cheat sheet and permit test hubs.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$current_state_slug = 'california';

if ( get_query_var( 'drive_state' ) ) {
    $current_state_slug = sanitize_title( get_query_var( 'drive_state' ) );
} elseif ( isset( $_GET['state'] ) && ! empty( $_GET['state'] ) ) {
    $req_state = sanitize_title( wp_unslash( $_GET['state'] ) );
    foreach ( $all_states as $code => $data ) {
        if ( $data['slug'] === $req_state || strtolower( $code ) === strtolower( $req_state ) ) {
            $current_state_slug = $data['slug'];
            break;
        }
    }
}
?>

<div class="state-page-wrapper">
    <?php
    // Hero Section for State Page matching the reference design
    get_template_part( 'template-parts/states/hero' );

    // Additional state page sections can be added here or reuse modular components
    ?>
</div>

<?php
get_footer();
