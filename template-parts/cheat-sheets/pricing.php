<?php
/**
 * Pricing Split Card Section Template Part
 *
 * Section ID: #pricing
 *
 * Implements the 2-tone split card matching the screenshot:
 * - Eyebrow: "PRICING" (Teal uppercase)
 * - Heading: "Simple, one-time price" (Charcoal #2B2D42)
 * - Split Card Box (32px border radius, overflow hidden, shadow):
 *   - Left Column (Dark Charcoal #2B2D42 / #26283B):
 *     - Left side: Angled realistic cheat sheet cover mockup (exact same cover card)
 *     - Right side of left column:
 *       - Eyebrow: "WHAT YOU GET" (Teal uppercase)
 *       - 5 bullet points with dark circle + teal checkmark:
 *         1. [150/250] must-know questions with answers
 *         2. Every road sign explained
 *         3. Demerit points explained
 *         4. Printable PDF for phone, tablet or print
 *         5. Instant download after checkout
 *   - Right Column (White #FFFFFF):
 *     - Product Title: "[State] [Vehicle] Permit Test Cheat Sheet"
 *     - Big Price: "$14" (or $[XX]) + "one-time"
 *     - Big Orange CTA Button: "Get Your Cheat Sheet →"
 *     - 3 Trust Lines:
 *       - [XX]-day money-back guarantee (shield icon)
 *       - Secure checkout (padlock icon)
 *       - Instant PDF download (download tray icon)
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Current context
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
$current_state_code = 'CA';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_name = $data['name'];
        $current_state_code = strtoupper( $code );
        break;
    }
}

$question_count = ( 'cdl' === $vehicle_key ) ? '250' : '150';
$price_amount   = '$14'; // Default price token, customizable via options/theme_mod
$guarantee_days = '30';

$vehicle_labels = array(
    'car'        => array(
        'name'        => __( 'Car', 'drive' ),
        'badge'       => __( 'CAR', 'drive' ),
        'tag'         => __( 'CAR CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-aerial.jpg',
        'sub_title'   => __( 'Important Permit Test Questions', 'drive' ),
    ),
    'motorcycle' => array(
        'name'        => __( 'Motorcycle', 'drive' ),
        'badge'       => __( 'MOTORCYCLE', 'drive' ),
        'tag'         => __( 'MOTORCYCLE CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-motorcycle.jpg',
        'sub_title'   => __( 'Important Motorcycle Test Questions', 'drive' ),
    ),
    'cdl'        => array(
        'name'        => __( 'Truck (CDL)', 'drive' ),
        'badge'       => __( 'TRUCK (CDL)', 'drive' ),
        'tag'         => __( 'TRUCK (CDL) CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-cdl.jpg',
        'sub_title'   => __( 'Important CDL Test Questions', 'drive' ),
    ),
);
$curr_data     = isset( $vehicle_labels[ $vehicle_key ] ) ? $vehicle_labels[ $vehicle_key ] : $vehicle_labels['car'];
$site_logo_src = function_exists( 'drive_get_site_logo_src' ) ? drive_get_site_logo_src() : '';

// Checkout URL (can link to WooCommerce / Stripe checkout or dynamic modal)
$checkout_url = home_url( '/checkout/?add-to-cart=' . esc_attr( $vehicle_key ) . '&state=' . esc_attr( $current_state_slug ) );
?>

<section id="pricing" class="cheat-pricing-section" aria-labelledby="pricing-heading">
    <div class="site-container cheat-pricing-container">
        
        <!-- Header -->
        <div class="pricing-header">
            <span class="pricing-eyebrow"><?php esc_html_e( 'PRICING', 'drive' ); ?></span>
            <h2 id="pricing-heading" class="pricing-title"><?php esc_html_e( 'Simple, one–time price', 'drive' ); ?></h2>
        </div>

        <!-- Split Card -->
        <div class="pricing-split-card">
            
            <!-- Left Side: Dark Charcoal Container with Mockup & "What You Get" -->
            <div class="pricing-card-left">
                
                <!-- Left Column inside Left Side: Scaled Angled Cheat Sheet Mockup -->
                <div class="pricing-mockup-wrapper" aria-hidden="true">
                    <div class="catalog-cover-mockup pricing-cover-mockup">
                        <div class="sheet-inner client-cover-style">
                            <div class="cover-dashed-arc" aria-hidden="true"></div>

                            <!-- Header -->
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
                                <div class="sheet-pill-tag <?php echo esc_attr( $vehicle_key ); ?>-tag"><?php echo esc_html( $curr_data['tag'] ); ?></div>
                            </div>

                            <!-- Title Area -->
                            <div class="sheet-title-area">
                                <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                <div class="sheet-big-num orange-accent"><?php echo esc_html( $question_count ); ?></div>
                                <span class="sheet-main-title"><?php echo esc_html( $curr_data['sub_title'] ); ?></span>
                                <div class="title-orange-underline"></div>
                            </div>

                            <!-- Photo / Artwork -->
                            <div class="sheet-graphic-preview has-photo">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $curr_data['cover_photo'] ); ?>" 
                                     alt="" 
                                     class="aerial-photo-img" />
                            </div>

                            <!-- Footer Bar -->
                            <div class="sheet-footer-bar client-cover-footer">
                                <span class="footer-domain">dmvlearnerspermittest.com</span>
                                <span class="footer-meta">Built from official <?php echo esc_html( $current_state_name ); ?> handbook · Not affiliated with any state DMV</span>
                            </div>
                        </div><!-- .sheet-inner -->
                    </div><!-- .catalog-cover-mockup -->
                </div><!-- .pricing-mockup-wrapper -->

                <!-- Right Column inside Left Side: "What You Get" Checklist -->
                <div class="pricing-features-wrapper">
                    <span class="pricing-features-eyebrow"><?php esc_html_e( 'WHAT YOU GET', 'drive' ); ?></span>

                    <ul class="pricing-bullets-list">
                        <li class="pricing-bullet-item">
                            <span class="pricing-check-icon" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="pricing-bullet-text">
                                <?php 
                                printf(
                                    /* translators: %s: Question count */
                                    esc_html__( '%s must–know questions with answers', 'drive' ),
                                    esc_html( $question_count )
                                ); 
                                ?>
                            </span>
                        </li>

                        <li class="pricing-bullet-item">
                            <span class="pricing-check-icon" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="pricing-bullet-text"><?php esc_html_e( 'Every road sign explained', 'drive' ); ?></span>
                        </li>

                        <li class="pricing-bullet-item">
                            <span class="pricing-check-icon" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="pricing-bullet-text"><?php esc_html_e( 'Demerit points explained', 'drive' ); ?></span>
                        </li>

                        <li class="pricing-bullet-item">
                            <span class="pricing-check-icon" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="pricing-bullet-text"><?php esc_html_e( 'Printable PDF for phone, tablet or print', 'drive' ); ?></span>
                        </li>

                        <li class="pricing-bullet-item">
                            <span class="pricing-check-icon" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="pricing-bullet-text"><?php esc_html_e( 'Instant download after checkout', 'drive' ); ?></span>
                        </li>
                    </ul>
                </div><!-- .pricing-features-wrapper -->

            </div><!-- .pricing-card-left -->

            <!-- Right Side: Clean White Box with Title, Price, CTA & Trust -->
            <div class="pricing-card-right">
                
                <h3 class="pricing-product-title">
                    <?php 
                    printf(
                        /* translators: 1: State name, 2: Vehicle name */
                        esc_html__( '%1$s %2$s Permit Test Cheat Sheet', 'drive' ),
                        esc_html( $current_state_name ),
                        esc_html( $curr_data['name'] )
                    ); 
                    ?>
                </h3>

                <!-- Price Row -->
                <div class="pricing-price-row">
                    <span class="pricing-amount"><?php echo esc_html( $price_amount ); ?></span>
                    <span class="pricing-cadence"><?php esc_html_e( 'one–time', 'drive' ); ?></span>
                </div>

                <!-- Primary CTA Button -->
                <a href="<?php echo esc_url( $checkout_url ); ?>" class="pricing-buy-btn">
                    <span><?php esc_html_e( 'Get Your Cheat Sheet', 'drive' ); ?></span>
                    <span class="cta-arrow" aria-hidden="true">→</span>
                </a>

                <!-- 3 Trust Points -->
                <div class="pricing-trust-list">
                    <div class="pricing-trust-row">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <span>
                            <?php 
                            printf(
                                /* translators: %s: Number of guarantee days */
                                esc_html__( '%s–day money–back guarantee', 'drive' ),
                                esc_html( $guarantee_days )
                            ); 
                            ?>
                        </span>
                    </div>

                    <div class="pricing-trust-row">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                        <span><?php esc_html_e( 'Secure checkout', 'drive' ); ?></span>
                    </div>

                    <div class="pricing-trust-row">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                            <polyline points="7 10 12 15 17 10"/>
                            <line x1="12" y1="15" x2="12" y2="3"/>
                        </svg>
                        <span><?php esc_html_e( 'Instant PDF download', 'drive' ); ?></span>
                    </div>
                </div><!-- .pricing-trust-list -->

            </div><!-- .pricing-card-right -->

        </div><!-- .pricing-split-card -->

    </div><!-- .cheat-pricing-container -->
</section>

