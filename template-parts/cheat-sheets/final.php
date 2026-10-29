<?php
/**
 * Final Call-to-Action Section Template Part
 *
 * Section ID: #final
 *
 * Matches the top half of the screenshot:
 * - Floating Cheat Sheet 3-Card Mockup:
 *   - Center: Realistic Cheat Sheet Booklet Cover (exact hero card)
 *   - Left: Peeking Road Signs card (tilted -8deg)
 *   - Right: Peeking Answers card (tilted +8deg)
 *   - Subtle soft shadow glow underneath
 * - Heading: "Ready for your [State] permit test?"
 * - Lead: "Get the cheat sheet and review the key rules before test day."
 * - Primary CTA: "Get Your Cheat Sheet · $[XX] →" (scrolls to #pricing / links to checkout)
 * - Trust Microcopy: "[XX]-day money-back guarantee · Secure checkout · Instant PDF download"
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
$price_amount   = '$14';
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
?>

<section id="final" class="cheat-final-section" aria-labelledby="final-heading">
    <div class="site-container cheat-final-container">
        
        <!-- Floating 3-Card Display Stage -->
        <div class="final-cards-stage" aria-hidden="true">
            
            <!-- Left Peeking Card: Road Signs -->
            <div class="final-peek-card peek-left">
                <div class="final-peek-header">
                    <span class="peek-title">ROAD SIGNS</span>
                </div>
                <div class="final-peek-body">
                    <div class="final-sign-item">
                        <div class="final-mini-shape circle"></div>
                        <div class="final-mini-lines">
                            <span class="final-line w-60"></span>
                        </div>
                    </div>
                    <div class="final-sign-item">
                        <div class="final-mini-shape triangle"></div>
                        <div class="final-mini-lines">
                            <span class="final-line w-75"></span>
                        </div>
                    </div>
                    <div class="final-sign-item">
                        <div class="final-mini-shape rect"></div>
                        <div class="final-mini-lines">
                            <span class="final-line w-50"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Peeking Card: Answers -->
            <div class="final-peek-card peek-right">
                <div class="final-peek-header right">
                    <span class="peek-title">ANSWERS</span>
                    <span class="peek-badge"><?php echo esc_html( $current_state_code . '-' . strtoupper( $curr_data['name'] ) ); ?></span>
                </div>
                <div class="final-peek-body">
                    <div class="final-qa-box">
                        <span class="final-line w-90"></span>
                        <span class="final-line w-70 teal"></span>
                    </div>
                    <div class="final-qa-box">
                        <span class="final-line w-80"></span>
                        <span class="final-line w-65 teal"></span>
                    </div>
                    <div class="final-qa-box">
                        <span class="final-line w-85"></span>
                        <span class="final-line w-55 teal"></span>
                    </div>
                </div>
            </div>

            <!-- Center Main Booklet Cover (Exact Hero Cheat Sheet Design) -->
            <div class="final-center-cover">
                <div class="catalog-cover-mockup final-cover-mockup">
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
            </div><!-- .final-center-cover -->

        </div><!-- .final-cards-stage -->

        <!-- Heading & Copy -->
        <h2 id="final-heading" class="final-title">
            <?php 
            printf(
                /* translators: %s: State name */
                esc_html__( 'Ready for your %s permit test?', 'drive' ),
                esc_html( $current_state_name )
            ); 
            ?>
        </h2>

        <p class="final-lead">
            <?php esc_html_e( 'Get the cheat sheet and review the key rules before test day.', 'drive' ); ?>
        </p>

        <!-- Main Orange CTA Button -->
        <div class="final-cta-btn-wrap">
            <a href="#pricing" class="final-cta-btn">
                <span>
                    <?php 
                    printf(
                        /* translators: %s: Price */
                        esc_html__( 'Get Your Cheat Sheet · %s', 'drive' ),
                        esc_html( $price_amount )
                    ); 
                    ?>
                </span>
                <span class="cta-arrow" aria-hidden="true">→</span>
            </a>
        </div>

        <!-- Trust Points Microcopy -->
        <div class="final-trust-row">
            <div class="final-trust-item">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                </svg>
                <span>
                    <?php 
                    printf(
                        /* translators: %s: Guarantee days */
                        esc_html__( '[%s]–day money–back guarantee', 'drive' ),
                        esc_html( $guarantee_days )
                    ); 
                    ?>
                </span>
            </div>

            <span class="trust-sep" aria-hidden="true">·</span>

            <div class="final-trust-item">
                <span><?php esc_html_e( 'Secure checkout', 'drive' ); ?></span>
            </div>

            <span class="trust-sep" aria-hidden="true">·</span>

            <div class="final-trust-item">
                <span><?php esc_html_e( 'Instant PDF download', 'drive' ); ?></span>
            </div>
        </div><!-- .final-trust-row -->

    </div><!-- .cheat-final-container -->
</section>
