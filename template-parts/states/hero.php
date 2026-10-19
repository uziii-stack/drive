<?php
/**
 * Template part for displaying the State Page Hero Section
 *
 * Implements the state hero layout matching the reference design:
 * - Light clean background with subtle curved dashed highway road line
 * - State pill badge: Dark charcoal pill with teal dot: "● CALIFORNIA"
 * - Dynamic Headline: "Pass your [State] permit test with one simple cheat sheet"
 * - Subtitle: "The key rules, road signs and questions from the official [State] driver handbook, in a short, printable cheat sheet for car, motorcycle or CDL."
 * - Interactive Vehicle Switcher Chips: [Car] [Motorcycle] [Truck (CDL)]
 * - Primary CTA Button: "Get Car Cheat Sheet →" (Dynamic based on selected vehicle)
 * - Trust guarantee line: 100% money-back guarantee · Secure checkout · Instant PDF download
 * - Right Side: Fanned 3D cheat sheet mockups with CDL, Car (150 Questions with intersection aerial road photo), Motorcycle + floating "Printable PDF" badge
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$all_states    = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$vehicle_types = function_exists( 'drive_get_vehicle_types' ) ? drive_get_vehicle_types() : array();

// Determine state context
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

// Find state name and code
$current_state_name = 'California';
$current_state_code = 'CA';
foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_state_name = $data['name'];
        $current_state_code = $code;
        break;
    }
}

// Determine vehicle context (Default: 'car')
$current_veh = 'car';
if ( isset( $_GET['veh'] ) && ! empty( $_GET['veh'] ) ) {
    $req_veh = sanitize_title( wp_unslash( $_GET['veh'] ) );
    if ( in_array( $req_veh, array( 'car', 'motorcycle', 'cdl' ), true ) ) {
        $current_veh = $req_veh;
    }
}

$veh_labels = array(
    'car'        => __( 'Car', 'drive' ),
    'motorcycle' => __( 'Motorcycle', 'drive' ),
    'cdl'        => __( 'Truck (CDL)', 'drive' ),
);
?>

<section id="state-hero" class="state-page-hero" aria-labelledby="state-hero-title">
    
    <!-- Subtle Highway Curved Road Line Graphic in Background -->
    <div class="state-hero-road-backdrop" aria-hidden="true">
        <svg class="state-hero-road-svg" viewBox="0 0 1440 600" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Road subtle underlay -->
            <path d="M 850 620 C 950 560, 1100 480, 1260 360 C 1380 270, 1420 180, 1480 120" stroke="rgba(43, 45, 66, 0.04)" stroke-width="80" stroke-linecap="round"/>
            <!-- Dashed Highway Centerline -->
            <path d="M 820 630 C 930 570, 1080 490, 1250 370 C 1370 280, 1430 190, 1490 130" stroke="#DCDDE3" stroke-width="3" stroke-dasharray="14 16" stroke-linecap="round"/>
        </svg>
    </div>

    <div class="site-container state-hero-container">
        <div class="state-hero-grid">
            
            <!-- Left Column: Content & Controls -->
            <div class="state-hero-content">
                
                <!-- State Pill Badge -->
                <div class="state-badge-pill">
                    <span class="state-badge-dot" aria-hidden="true"></span>
                    <span class="state-badge-label"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                </div>

                <!-- Main State Headline -->
                <h1 id="state-hero-title" class="state-hero-h1">
                    <?php 
                    printf(
                        /* translators: %s: State name */
                        esc_html__( 'Pass your %s permit test with one simple cheat sheet', 'drive' ),
                        esc_html( $current_state_name )
                    ); 
                    ?>
                </h1>

                <!-- Subtitle Description -->
                <p class="state-hero-description">
                    <?php 
                    printf(
                        /* translators: %s: State name */
                        esc_html__( 'The key rules, road signs and questions from the official %s driver handbook, in a short, printable cheat sheet for car, motorcycle or CDL.', 'drive' ),
                        esc_html( $current_state_name )
                    ); 
                    ?>
                </p>

                <!-- Vehicle Switcher Tabs / Pills -->
                <div class="state-vehicle-tabs" role="tablist" aria-label="<?php esc_attr_e( 'Choose Vehicle Type', 'drive' ); ?>">
                    
                    <!-- Car Tab -->
                    <button type="button" 
                            class="state-veh-tab <?php echo ( $current_veh === 'car' ) ? 'is-active' : ''; ?>" 
                            data-vehicle="car" 
                            data-cta-label="<?php echo esc_attr( sprintf( __( 'Get %s Cheat Sheet', 'drive' ), __( 'Car', 'drive' ) ) ); ?>"
                            role="tab" 
                            aria-selected="<?php echo ( $current_veh === 'car' ) ? 'true' : 'false'; ?>">
                        <span class="veh-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                                <circle cx="7" cy="15" r="1.5" fill="currentColor"/>
                                <circle cx="17" cy="15" r="1.5" fill="currentColor"/>
                            </svg>
                        </span>
                        <span class="veh-name"><?php esc_html_e( 'Car', 'drive' ); ?></span>
                    </button>

                    <!-- Motorcycle Tab -->
                    <button type="button" 
                            class="state-veh-tab <?php echo ( $current_veh === 'motorcycle' ) ? 'is-active' : ''; ?>" 
                            data-vehicle="motorcycle" 
                            data-cta-label="<?php echo esc_attr( sprintf( __( 'Get %s Cheat Sheet', 'drive' ), __( 'Motorcycle', 'drive' ) ) ); ?>"
                            role="tab" 
                            aria-selected="<?php echo ( $current_veh === 'motorcycle' ) ? 'true' : 'false'; ?>">
                        <span class="veh-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="5.5" cy="17.5" r="3.5"/>
                                <circle cx="18.5" cy="17.5" r="3.5"/>
                                <path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/>
                                <path d="M12 17.5V14l-3-4"/>
                                <path d="M5.5 17.5L9 12"/>
                            </svg>
                        </span>
                        <span class="veh-name"><?php esc_html_e( 'Motorcycle', 'drive' ); ?></span>
                    </button>

                    <!-- Truck / CDL Tab -->
                    <button type="button" 
                            class="state-veh-tab <?php echo ( $current_veh === 'cdl' ) ? 'is-active' : ''; ?>" 
                            data-vehicle="cdl" 
                            data-cta-label="<?php echo esc_attr( sprintf( __( 'Get %s Cheat Sheet', 'drive' ), __( 'CDL', 'drive' ) ) ); ?>"
                            role="tab" 
                            aria-selected="<?php echo ( $current_veh === 'cdl' ) ? 'true' : 'false'; ?>">
                        <span class="veh-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 4h12v12H2z"/>
                                <path d="M14 9h4l3 3v4h-7V9z"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                        </span>
                        <span class="veh-name"><?php esc_html_e( 'Truck (CDL)', 'drive' ); ?></span>
                    </button>

                </div>

                <!-- Primary CTA Button (Dynamic Label based on selected vehicle) -->
                <div class="state-hero-cta-wrap">
                    <?php 
                    $active_cta_label = sprintf( __( 'Get %s Cheat Sheet', 'drive' ), ( $current_veh === 'motorcycle' ? __( 'Motorcycle', 'drive' ) : ( $current_veh === 'cdl' ? __( 'CDL', 'drive' ) : __( 'Car', 'drive' ) ) ) );
                    $cta_url = home_url( '/' . esc_attr( $current_state_slug ) . '/' . ( $current_veh === 'cdl' ? 'cdl-cheatsheet' : ( $current_veh === 'motorcycle' ? 'motorcycle-cheatsheet' : 'car-cheatsheet' ) ) . '/' );
                    ?>
                    <a href="<?php echo esc_url( $cta_url ); ?>" class="btn-primary-orange state-hero-cta-btn" id="stateHeroCtaBtn">
                        <span class="cta-btn-text" id="stateCtaBtnText"><?php echo esc_html( $active_cta_label ); ?></span>
                        <span class="cta-btn-arrow" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </a>
                </div>

                <!-- Trust Guarantee Badges -->
                <div class="state-hero-trust-bar">
                    <div class="trust-item">
                        <span class="trust-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        </span>
                        <span class="trust-text"><?php esc_html_e( '100% money-back guarantee', 'drive' ); ?></span>
                    </div>
                    <span class="trust-bullet" aria-hidden="true">·</span>
                    <div class="trust-item">
                        <span class="trust-text"><?php esc_html_e( 'Secure checkout', 'drive' ); ?></span>
                    </div>
                    <span class="trust-bullet" aria-hidden="true">·</span>
                    <div class="trust-item">
                        <span class="trust-text"><?php esc_html_e( 'Instant PDF download', 'drive' ); ?></span>
                    </div>
                </div>

            </div>

            <!-- Right Column: Fanned Cheat Sheet Mockups & Badges -->
            <div class="state-hero-visual-col">
                <div class="state-mockup-stage">
                    
                    <!-- Fanned 3D Mockup Container -->
                    <div class="cheat-sheets-fanned-stack" id="stateMockupStack" data-active-veh="<?php echo esc_attr( $current_veh ); ?>">
                        
                        <!-- Left Card: Truck (CDL) Cheat Sheet -->
                        <div class="cheat-sheet-card card-cdl" data-card-veh="cdl">
                            <div class="sheet-inner">
                                <div class="sheet-header">
                                    <div class="sheet-brand">
                                        <div class="sheet-mini-logo"></div>
                                        <div class="sheet-brand-text">
                                            <span class="brand-top">DMV Learners</span>
                                            <span class="brand-bot">Permit Test</span>
                                        </div>
                                    </div>
                                    <div class="sheet-pill-tag">CDL CHEAT SHEET</div>
                                </div>
                                <div class="sheet-title-area">
                                    <span class="sheet-state-name"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                    <span class="sheet-big-num cdl-accent">250</span>
                                    <span class="sheet-main-title">Important CDL Questions</span>
                                </div>
                                <div class="sheet-graphic-preview cdl-theme">
                                    <div class="cdl-road-scene">
                                        <div class="truck-silhouette"></div>
                                        <div class="traffic-light-post">
                                            <div class="lamp green"></div>
                                            <div class="lamp red"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sheet-footer-bar">
                                    <span>dmvlearnerspermittest.com</span>
                                </div>
                            </div>
                        </div>

                        <!-- Center / Main Card: Car 150 Questions Cheat Sheet -->
                        <div class="cheat-sheet-card card-car is-primary" data-card-veh="car">
                            <div class="sheet-inner client-cover-style">
                                <!-- Dashed Circular Accent Pattern -->
                                <div class="cover-dashed-arc" aria-hidden="true"></div>

                                <div class="sheet-header">
                                    <div class="sheet-brand">
                                        <div class="sheet-brand-logo-icon">
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#00B4A6" opacity="0.3"/>
                                                <path d="M10 17l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="#00B4A6"/>
                                                <circle cx="6" cy="18" r="1.5" fill="#F26419"/>
                                                <circle cx="9" cy="19" r="1.5" fill="#F26419"/>
                                            </svg>
                                        </div>
                                        <div class="sheet-brand-text">
                                            <span class="brand-top">DMV Learners</span>
                                            <span class="brand-bot">Permit <strong class="brand-test-orange">Test</strong></span>
                                        </div>
                                    </div>
                                    <div class="sheet-pill-tag car-tag">CAR CHEAT SHEET</div>
                                </div>
                                
                                <div class="sheet-title-area">
                                    <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                    <span class="sheet-big-num orange-accent">150</span>
                                    <span class="sheet-main-title">Important Permit Test Questions</span>
                                    <div class="title-orange-underline"></div>
                                </div>

                                <!-- Real Aerial Intersection Photo Snippet -->
                                <div class="sheet-graphic-preview car-theme has-photo">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/intersection-aerial.jpg' ); ?>" 
                                         alt="<?php echo esc_attr( sprintf( __( '%s Car Permit Test Intersection', 'drive' ), $current_state_name ) ); ?>" 
                                         class="aerial-photo-img" />
                                </div>

                                <div class="sheet-footer-bar client-cover-footer">
                                    <span class="footer-domain">dmvlearnerspermittest.com</span>
                                    <span class="footer-meta">Built from the official <?php echo esc_html( $current_state_name ); ?> handbook · Not affiliated with any state DMV</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right Card: Motorcycle Cheat Sheet -->
                        <div class="cheat-sheet-card card-motorcycle" data-card-veh="motorcycle">
                            <div class="sheet-inner client-cover-style">
                                <!-- Top-Right Dashed Arc (from client design) -->
                                <div class="cover-dashed-arc" aria-hidden="true"></div>

                                <div class="sheet-header">
                                    <div class="sheet-brand">
                                        <div class="sheet-brand-logo-icon">
                                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#00B4A6" opacity="0.3"/>
                                                <path d="M10 17l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="#00B4A6"/>
                                                <circle cx="6" cy="18" r="1.5" fill="#F26419"/>
                                                <circle cx="9" cy="19" r="1.5" fill="#F26419"/>
                                            </svg>
                                        </div>
                                        <div class="sheet-brand-text">
                                            <span class="brand-top">DMV Learners</span>
                                            <span class="brand-bot">Permit <strong class="brand-test-orange">Test</strong></span>
                                        </div>
                                    </div>
                                    <div class="sheet-pill-tag moto-tag">MOTORCYCLE CHEAT SHEET</div>
                                </div>

                                <div class="sheet-title-area">
                                    <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                    <div class="sheet-big-num orange-accent">150</div>
                                    <span class="sheet-main-title"><?php esc_html_e( 'Important Motorcycle Test Questions', 'drive' ); ?></span>
                                    <div class="title-orange-underline"></div>
                                </div>

                                <!-- Aerial Intersection Motorcycle Photo -->
                                <div class="sheet-graphic-preview has-photo">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/intersection-motorcycle.jpg' ); ?>" 
                                         alt="<?php echo esc_attr( sprintf( __( '%s Motorcycle Permit Test Intersection', 'drive' ), $current_state_name ) ); ?>" 
                                         class="aerial-photo-img" />
                                </div>

                                <div class="sheet-footer-bar client-cover-footer">
                                    <span class="footer-domain">dmvlearnerspermittest.com</span>
                                    <span class="footer-meta">Built from the official <?php echo esc_html( $current_state_name ); ?> handbook · Not affiliated with any state DMV</span>
                                </div>
                            </div>
                        </div>

                    </div><!-- .cheat-sheets-fanned-stack -->

                    <!-- Floating Badge: Printable PDF (Bottom Right) -->
                    <div class="floating-pdf-badge" aria-label="<?php esc_attr_e( 'Printable PDF Download Available', 'drive' ); ?>">
                        <span class="pdf-badge-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                        </span>
                        <span class="pdf-badge-text"><?php esc_html_e( 'Printable PDF', 'drive' ); ?></span>
                    </div>

                </div><!-- .state-mockup-stage -->
            </div><!-- .state-hero-visual-col -->

        </div><!-- .state-hero-grid -->
    </div><!-- .state-hero-container -->
</section><!-- #state-hero -->
