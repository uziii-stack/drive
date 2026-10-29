<?php
/**
 * Hero Section Template Part for Cheat Sheet Product Page
 *
 * Implements the layout shown in client mockup:
 * - Left column:
 *   - Eyebrow pill: teal dot + "CALIFORNIA · CAR"
 *   - H1: "[State] [Vehicle] Permit Test Cheat Sheet"
 *   - Description text: "[150/250] must-know questions with answers, every road sign..."
 *   - Price display: "$[XX] one-time · instant PDF"
 *   - CTA button: "Get Your Cheat Sheet →" (scrolls to #pricing / links to checkout)
 *   - Ghost link: "See what's inside" (scrolls to #inside)
 *   - Trust micro-copy: "[XX]-day money-back guarantee · Secure checkout · Instant PDF download"
 *   - Other vehicles switch: "Also available: Motorcycle · Truck (CDL)"
 * - Right column:
 *   - Light rounded backdrop with subtle curved dashed line
 *   - Left peeking card: "ROAD SIGNS" (octagonal sign, circular sign sample preview)
 *   - Center realistic cheat sheet book cover:
 *     - Header brand + pill tag
 *     - State name (teal) + Big question count (150/250) + subtitle + orange underline
 *     - Vehicle intersection aerial photo with seamless overlay
 *     - Footer domain & disclaimer
 *   - Right peeking card: "ANSWERS" (question & answer preview)
 *   - Floating badge: "Printable PDF" with download/document icon
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Current context passed from template or query vars
$current_state_slug = get_query_var( 'drive_state' );
$current_vehicle    = get_query_var( 'drive_vehicle' );

if ( empty( $current_state_slug ) ) {
    $current_state_slug = 'california';
}
if ( empty( $current_vehicle ) ) {
    $current_vehicle = 'car';
}

// Normalize vehicle type
$vehicle_key = strtolower( trim( $current_vehicle ) );
if ( 'truck' === $vehicle_key ) {
    $vehicle_key = 'cdl';
}

// State display data
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

// Vehicle specific fields
$question_count = ( 'cdl' === $vehicle_key ) ? '250' : '150';
$vehicle_labels = array(
    'car'        => array(
        'name'        => __( 'Car', 'drive' ),
        'badge'       => __( 'CAR', 'drive' ),
        'tag'         => __( 'CAR CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-aerial.jpg',
        'sub_title'   => __( 'Important Permit Test Questions', 'drive' ),
        'others'      => array(
            array( 'label' => __( 'Motorcycle', 'drive' ), 'slug' => 'motorcycle-cheat-sheet' ),
            array( 'label' => __( 'Truck (CDL)', 'drive' ), 'slug' => 'cdl-cheat-sheet' ),
        ),
    ),
    'motorcycle' => array(
        'name'        => __( 'Motorcycle', 'drive' ),
        'badge'       => __( 'MOTORCYCLE', 'drive' ),
        'tag'         => __( 'MOTORCYCLE CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-motorcycle.jpg',
        'sub_title'   => __( 'Important Motorcycle Test Questions', 'drive' ),
        'others'      => array(
            array( 'label' => __( 'Car', 'drive' ), 'slug' => 'car-cheat-sheet' ),
            array( 'label' => __( 'Truck (CDL)', 'drive' ), 'slug' => 'cdl-cheat-sheet' ),
        ),
    ),
    'cdl'        => array(
        'name'        => __( 'Truck (CDL)', 'drive' ),
        'badge'       => __( 'TRUCK (CDL)', 'drive' ),
        'tag'         => __( 'TRUCK (CDL) CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-cdl.jpg',
        'sub_title'   => __( 'Important CDL Test Questions', 'drive' ),
        'others'      => array(
            array( 'label' => __( 'Car', 'drive' ), 'slug' => 'car-cheat-sheet' ),
            array( 'label' => __( 'Motorcycle', 'drive' ), 'slug' => 'motorcycle-cheat-sheet' ),
        ),
    ),
);

$curr_data     = isset( $vehicle_labels[ $vehicle_key ] ) ? $vehicle_labels[ $vehicle_key ] : $vehicle_labels['car'];
$site_logo_src = function_exists( 'drive_get_site_logo_src' ) ? drive_get_site_logo_src() : '';
$price_display = '$14'; // Default price token, can be dynamic
$guarantee_days = '30';
?>

<section id="hero" class="cheat-hero-section" aria-labelledby="cheat-hero-heading">
    <div class="site-container cheat-hero-container">
        
        <!-- Left Column: Copy & CTAs -->
        <div class="cheat-hero-content">
            
            <!-- Eyebrow Pill -->
            <div class="cheat-hero-pill">
                <span class="cheat-pill-dot" aria-hidden="true"></span>
                <span class="cheat-pill-text"><?php echo esc_html( strtoupper( $current_state_name . ' · ' . $curr_data['name'] ) ); ?></span>
            </div>

            <!-- Main Heading H1 -->
            <h1 id="cheat-hero-heading" class="cheat-hero-title">
                <?php 
                printf(
                    /* translators: 1: State name, 2: Vehicle name */
                    esc_html__( '%1$s %2$s Permit Test Cheat Sheet', 'drive' ),
                    esc_html( $current_state_name ),
                    esc_html( $curr_data['name'] )
                );
                ?>
            </h1>

            <!-- Lead Paragraph -->
            <p class="cheat-hero-lead">
                <?php 
                printf(
                    /* translators: 1: Question count, 2: State name */
                    esc_html__( '%1$s must-know questions with answers, every road sign explained and the key rules from the official %2$s driver handbook, in one printable PDF.', 'drive' ),
                    esc_html( $question_count ),
                    esc_html( $current_state_name )
                );
                ?>
            </p>

            <!-- Price Row -->
            <div class="cheat-hero-price-row">
                <span class="cheat-hero-price-amount"><?php echo esc_html( $price_display ); ?></span>
                <span class="cheat-hero-price-meta"><?php esc_html_e( 'one-time · instant PDF', 'drive' ); ?></span>
            </div>

            <!-- CTA Group -->
            <div class="cheat-hero-cta-group">
                <a href="#pricing" class="btn btn-primary cheat-hero-cta-btn">
                    <span><?php esc_html_e( 'Get Your Cheat Sheet', 'drive' ); ?></span>
                    <span class="btn-arrow" aria-hidden="true">→</span>
                </a>
                <a href="#inside" class="cheat-hero-secondary-link">
                    <?php esc_html_e( "See what's inside", 'drive' ); ?>
                </a>
            </div>

            <!-- Trust Micro-Copy -->
            <div class="cheat-hero-trust-row">
                <span class="trust-item trust-guarantee">
                    <svg class="trust-check-icon" width="16" height="16" viewBox="0 0 20 20" fill="none" aria-hidden="true">
                        <circle cx="10" cy="10" r="9" stroke="#00B4A6" stroke-width="1.8"/>
                        <path d="M6 10l3 3 5-6" stroke="#00B4A6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <?php printf( esc_html__( '%s-day money-back guarantee', 'drive' ), esc_html( $guarantee_days ) ); ?>
                </span>
                <span class="trust-dot-sep" aria-hidden="true">·</span>
                <span class="trust-item"><?php esc_html_e( 'Secure checkout', 'drive' ); ?></span>
                <span class="trust-dot-sep" aria-hidden="true">·</span>
                <span class="trust-item"><?php esc_html_e( 'Instant PDF download', 'drive' ); ?></span>
            </div>

            <!-- Also Available Switcher -->
            <div class="cheat-hero-also-available">
                <span class="also-label"><?php esc_html_e( 'Also available:', 'drive' ); ?></span>
                <div class="also-links">
                    <?php 
                    $others_count = count( $curr_data['others'] );
                    foreach ( $curr_data['others'] as $idx => $other ) :
                        $other_url = home_url( '/' . esc_attr( $current_state_slug ) . '/' . esc_attr( $other['slug'] ) . '/' );
                        ?>
                        <a href="<?php echo esc_url( $other_url ); ?>" class="also-link"><?php echo esc_html( $other['label'] ); ?></a>
                        <?php if ( $idx < $others_count - 1 ) : ?>
                            <span class="also-dot" aria-hidden="true">·</span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>

        </div><!-- .cheat-hero-content -->

        <!-- Right Column: Visual Stage with Backdrop & Peeking Sample Pages -->
        <div class="cheat-hero-stage-col" aria-hidden="true">
            <div class="cheat-hero-stage">
                
                <!-- Inner Rounded Backdrop (#F4F5F7) which holds the road line -->
                <div class="cheat-hero-backdrop-box">
                    <!-- Road SVG with gentle curved dashed line contained safely inside the backdrop, swooping across the very bottom below the cards -->
                    <svg class="stage-dashed-curve" viewBox="0 0 500 120" preserveAspectRatio="none" fill="none">
                        <path d="M 0 65 Q 250 100 500 50" stroke="#B0B2C0" stroke-width="4" stroke-dasharray="14 10" stroke-linecap="round"/>
                    </svg>
                </div>

                <!-- Left Sample Peeking Page: "ROAD SIGNS" -->
                <div class="peek-sample-page peek-left">
                    <div class="peek-sample-header">
                        <span class="peek-sample-title">ROAD SIGNS</span>
                    </div>
                    <div class="peek-sample-body">
                        <!-- Sign Row 1: Stop sign octagon -->
                        <div class="peek-sign-item">
                            <div class="peek-sign-shape octagon"></div>
                            <div class="peek-sign-lines">
                                <span class="peek-line w-75"></span>
                                <span class="peek-line w-50"></span>
                            </div>
                        </div>
                        <!-- Sign Row 2: Yield / Warning triangle -->
                        <div class="peek-sign-item">
                            <div class="peek-sign-shape circle"></div>
                            <div class="peek-sign-lines">
                                <span class="peek-line w-80"></span>
                                <span class="peek-line w-60"></span>
                            </div>
                        </div>
                        <!-- Sign Row 3: Speed limit -->
                        <div class="peek-sign-item">
                            <div class="peek-sign-shape rect"></div>
                            <div class="peek-sign-lines">
                                <span class="peek-line w-70"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sample Peeking Page: "ANSWERS" -->
                <div class="peek-sample-page peek-right">
                    <div class="peek-sample-header right-align">
                        <span class="peek-sample-title">ANSWERS</span>
                        <span class="peek-sample-badge"><?php echo esc_html( $current_state_code . '-' . strtoupper( $curr_data['name'] ) ); ?></span>
                    </div>
                    <div class="peek-sample-body">
                        <!-- Q&A Row 1 -->
                        <div class="peek-qa-box">
                            <span class="peek-question-line">8-sided sign mean?</span>
                            <span class="peek-answer-line">hen go when it is safe.</span>
                        </div>
                        <!-- Q&A Row 2 -->
                        <div class="peek-qa-box">
                            <span class="peek-line w-90"></span>
                            <span class="peek-line w-70 teal-line"></span>
                        </div>
                        <!-- Q&A Row 3 -->
                        <div class="peek-qa-box">
                            <span class="peek-line w-85"></span>
                            <span class="peek-line w-60 teal-line"></span>
                        </div>
                    </div>
                </div>

                <!-- Center: Cheat Sheet Book Cover Mockup -->
                <div class="cheat-hero-cover-wrap">
                    <div class="catalog-cover-mockup">
                        <div class="sheet-inner client-cover-style">
                            <!-- Dashed Circular Accent Pattern -->
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
                                <div class="sheet-big-num orange-accent">
                                    <?php echo esc_html( $question_count ); ?>
                                </div>
                                <span class="sheet-main-title"><?php echo esc_html( $curr_data['sub_title'] ); ?></span>
                                <div class="title-orange-underline"></div>
                            </div>

                            <!-- Photo / Artwork -->
                            <div class="sheet-graphic-preview has-photo">
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $curr_data['cover_photo'] ); ?>" 
                                     alt="<?php echo esc_attr( $current_state_name . ' ' . $curr_data['name'] . ' Cheat Sheet' ); ?>" 
                                     class="aerial-photo-img" />
                            </div>

                            <!-- Footer Bar -->
                            <div class="sheet-footer-bar client-cover-footer">
                                <span class="footer-domain">dmvlearnerspermittest.com</span>
                                <span class="footer-meta">Built from official <?php echo esc_html( $current_state_name ); ?> handbook · Not affiliated with any state DMV</span>
                            </div>
                        </div><!-- .sheet-inner -->
                    </div><!-- .catalog-cover-mockup -->
                </div><!-- .cheat-hero-cover-wrap -->

                <!-- Floating Badge: Printable PDF -->
                <div class="floating-printable-pill">
                    <svg class="pill-download-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                    <span><?php esc_html_e( 'Printable PDF', 'drive' ); ?></span>
                </div>

            </div><!-- .cheat-hero-stage -->
        </div><!-- .cheat-hero-stage-col -->

    </div><!-- .cheat-hero-container -->
</section>

