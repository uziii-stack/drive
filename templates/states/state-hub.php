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
    // Hero Section for State Page matching reference
    get_template_part( 'template-parts/states/hero' );

    // What's Inside Feature Bar matching reference
    get_template_part( 'template-parts/states/whats-inside' );

    // All State Cheat Sheets 3-Card Grid matching reference
    get_template_part( 'template-parts/states/all-cheat-sheets' );

    // State FAQ Section matching reference
    get_template_part( 'template-parts/states/faq' );

    // "Not in [State]?" Switcher Box matching reference
    get_template_part( 'template-parts/states/state-switcher-banner' );
    ?>
</div>

<?php
get_footer();
