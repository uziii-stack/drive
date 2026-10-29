<?php
/**
 * Sticky Buy Bar Component for Mobile on Cheat Sheet Pages
 *
 * Implements the fixed bottom bar matching client screenshot:
 * - Left side:
 *   - Mini cheat sheet cover thumbnail
 *   - Price "$[14]"
 *   - Vehicle label (e.g., "Car cheat sheet")
 * - Right side:
 *   - Big Orange CTA Button: "Get Your Cheat Sheet"
 *
 * Appears throughout the cheat sheet template on mobile devices.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$current_state_slug = get_query_var( 'drive_state' );
$current_vehicle    = get_query_var( 'drive_vehicle' );

if ( empty( $current_state_slug ) ) {
    $current_state_slug = 'california';
}
if ( empty( $current_vehicle ) ) {
    $current_vehicle = 'car';
}

$vehicle_key = strtolower( trim( $current_vehicle ) );
if ( 'truck' === $vehicle_key ) {
    $vehicle_key = 'cdl';
}

$all_states         = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$current_state_name = 'California';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_name = $data['name'];
        break;
    }
}

$cover_image = 'car-cheat-sheet-cover.png';
$vehicle_label_text = __( 'Car cheat sheet', 'drive' );

if ( 'motorcycle' === $vehicle_key ) {
    $cover_image        = 'motorcycle-cheat-sheet-cover.png';
    $vehicle_label_text = __( 'Motorcycle cheat sheet', 'drive' );
} elseif ( 'cdl' === $vehicle_key ) {
    $cover_image        = 'cdl-cheat-sheet-cover.png';
    $vehicle_label_text = __( 'CDL cheat sheet', 'drive' );
}

$price_amount = '$14';
?>

<!-- Sticky Mobile Buy Bar -->
<div class="cs-sticky-buy-bar" id="csStickyBuyBar" aria-hidden="false">
    <div class="cs-sticky-buy-container">
        
        <!-- Left Product Info -->
        <div class="cs-sticky-product-info">
            <div class="cs-sticky-thumb-wrap" aria-hidden="true">
                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $cover_image ); ?>" 
                     alt="<?php echo esc_attr( $current_state_name . ' ' . $vehicle_label_text ); ?>" 
                     class="cs-sticky-thumb-img" 
                     width="32" 
                     height="42" 
                     loading="lazy" />
            </div>
            <div class="cs-sticky-meta">
                <span class="cs-sticky-price"><?php echo esc_html( $price_amount ); ?></span>
                <span class="cs-sticky-label"><?php echo esc_html( $vehicle_label_text ); ?></span>
            </div>
        </div>

        <!-- Right CTA Button -->
        <div class="cs-sticky-cta-wrap">
            <a href="#pricing" class="btn cs-sticky-btn">
                <?php esc_html_e( 'Get Your Cheat Sheet', 'drive' ); ?>
            </a>
        </div>

    </div>
</div>
