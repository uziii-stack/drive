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

$site_logo_src = function_exists( 'drive_get_site_logo_src' ) ? drive_get_site_logo_src() : '';

$vehicle_configs = array(
    'car' => array(
        'name'        => __( 'Car', 'drive' ),
        'badge'       => __( 'CAR CHEAT SHEET', 'drive' ),
        'count'       => '150',
        'sub_title'   => __( 'Important Permit Test Questions', 'drive' ),
        'cover_photo' => 'intersection-aerial.jpg',
        'label_text'  => __( 'Car cheat sheet', 'drive' ),
    ),
    'motorcycle' => array(
        'name'        => __( 'Motorcycle', 'drive' ),
        'badge'       => __( 'MOTORCYCLE CHEAT SHEET', 'drive' ),
        'count'       => '150',
        'sub_title'   => __( 'Important Motorcycle Test Questions', 'drive' ),
        'cover_photo' => 'intersection-motorcycle.jpg',
        'label_text'  => __( 'Motorcycle cheat sheet', 'drive' ),
    ),
    'cdl' => array(
        'name'        => __( 'Truck (CDL)', 'drive' ),
        'badge'       => __( 'TRUCK (CDL) CHEAT SHEET', 'drive' ),
        'count'       => '250',
        'sub_title'   => __( 'Important CDL Test Questions', 'drive' ),
        'cover_photo' => 'intersection-cdl.jpg',
        'label_text'  => __( 'CDL cheat sheet', 'drive' ),
    ),
);

$curr_cfg           = isset( $vehicle_configs[ $vehicle_key ] ) ? $vehicle_configs[ $vehicle_key ] : $vehicle_configs['car'];
$vehicle_label_text = $curr_cfg['label_text'];
$price_amount       = '$14';
?>

<!-- Sticky Mobile Buy Bar -->
<div class="cs-sticky-buy-bar" id="csStickyBuyBar" aria-hidden="false">
    <div class="cs-sticky-buy-container">
        
        <!-- Left Product Info -->
        <div class="cs-sticky-product-info">
            <!-- Custom HTML/CSS Cheat Sheet Cover Mockup -->
            <div class="cs-sticky-thumb-wrap" aria-hidden="true">
                <div class="catalog-cover-mockup cs-sticky-cover-mockup">
                    <div class="sheet-inner client-cover-style">
                        <div class="cover-dashed-arc" aria-hidden="true"></div>
                        <div class="sheet-header">
                            <div class="sheet-brand">
                                <div class="sheet-brand-logo-icon">
                                    <?php if ( ! empty( $site_logo_src ) ) : ?>
                                        <img src="<?php echo esc_url( $site_logo_src ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo-img" width="18" height="18" />
                                    <?php else : ?>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#00B4A6" opacity="0.3"/>
                                            <path d="M10 17l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="#00B4A6"/>
                                            <circle cx="6" cy="18" r="1.5" fill="#F26419"/>
                                            <circle cx="9" cy="19" r="1.5" fill="#F26419"/>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="sheet-brand-text">
                                    <span class="brand-top">DMV Learners</span>
                                    <span class="brand-bot">Permit <strong class="brand-test-orange">Test</strong></span>
                                </div>
                            </div>
                            <div class="sheet-pill-tag"><?php echo esc_html( $curr_cfg['badge'] ); ?></div>
                        </div>
                        <div class="sheet-title-area">
                            <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                            <div class="sheet-big-num orange-accent"><?php echo esc_html( $curr_cfg['count'] ); ?></div>
                            <span class="sheet-main-title"><?php echo esc_html( $curr_cfg['sub_title'] ); ?></span>
                            <div class="title-orange-underline"></div>
                        </div>
                        <div class="sheet-graphic-preview has-photo">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $curr_cfg['cover_photo'] ); ?>" alt="" class="aerial-photo-img" />
                        </div>
                        <div class="sheet-footer-bar client-cover-footer">
                            <span class="footer-domain">dmvlearnerspermittest.com</span>
                            <span class="footer-meta">Built from official <?php echo esc_html( $current_state_name ); ?> handbook · Not affiliated with any state DMV</span>
                        </div>
                    </div>
                </div>
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

