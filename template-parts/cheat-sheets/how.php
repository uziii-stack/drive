<?php
/**
 * How It Works Section Template Part
 *
 * Section ID: #how
 *
 * Matches the uploaded screenshot exactly:
 * - Charcoal background (#2B2D42 / #26283B)
 * - Eyebrow: "HOW IT WORKS" (Teal)
 * - Heading: "Three steps to your cheat sheet" (White)
 * - Video Container:
 *   - Dark rounded box (border-radius: 24px)
 *   - Subtle road dashed arc passing through
 *   - Center: Orange circular play button with black/dark play triangle
 *   - Top-right: Angled mini cheat sheet book cover mockup peeking inside the box
 *   - Bottom-left: "Video placeholder · same video on every cheat sheet page" with clock icon
 * - 3 Steps horizontal flow below video:
 *   - Teal connecting line with numbered circle badges (1, 2, 3)
 *   - Step 1: "Pick your state and vehicle" -> "Choose [State] and Car, Motorcycle or Truck (CDL)."
 *   - Step 2: "Get your PDF instantly" -> "Check out securely and download your cheat sheet right away."
 *   - Step 3: "Study, print and go" -> "Review on your phone or print it, then take your permit test."
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

<section id="how" class="cheat-how-section" aria-labelledby="how-heading">
    <div class="site-container cheat-how-container">
        
        <!-- Header -->
        <div class="how-header">
            <span class="how-eyebrow"><?php esc_html_e( 'HOW IT WORKS', 'drive' ); ?></span>
            <h2 id="how-heading" class="how-title"><?php esc_html_e( 'Three steps to your cheat sheet', 'drive' ); ?></h2>
        </div>

        <!-- Video Stage Container -->
        <div class="how-video-box">
            
            <!-- Road Dashed Arc Background Decor -->
            <svg class="how-road-svg" viewBox="0 0 900 350" fill="none" preserveAspectRatio="none" aria-hidden="true">
                <path d="M 0 250 C 250 180, 500 240, 900 120" stroke="rgba(255, 255, 255, 0.12)" stroke-width="8" stroke-dasharray="14 14" stroke-linecap="round"/>
            </svg>

            <!-- Mini Cheat Sheet Book Mockup (Top-right corner, angled - exact same cover structure as hero) -->
            <div class="how-mini-cover-wrap" aria-hidden="true">
                <div class="catalog-cover-mockup how-mini-mockup">
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
            </div><!-- .how-mini-cover-wrap -->

            <!-- Play Button Trigger -->
            <button type="button" class="how-play-btn" aria-label="<?php esc_attr_e( 'Play walkthrough video', 'drive' ); ?>">
                <svg class="how-play-triangle" width="24" height="24" viewBox="0 0 24 24" fill="#1C1E2E">
                    <polygon points="7,4 20,12 7,20"/>
                </svg>
            </button>

            <!-- Video Bottom Note -->
            <div class="how-video-note">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                <span><?php esc_html_e( 'Video placeholder · same video on every cheat sheet page', 'drive' ); ?></span>
            </div>

        </div><!-- .how-video-box -->

        <!-- 3 Steps Stepper Grid -->
        <div class="how-steps-track">
            
            <!-- Connecting Line -->
            <div class="how-connecting-line" aria-hidden="true"></div>

            <div class="how-steps-grid">
                
                <!-- Step 1 -->
                <div class="how-step-item">
                    <div class="how-step-num-badge">1</div>
                    <div class="how-step-text">
                        <h3 class="how-step-title"><?php esc_html_e( 'Pick your state and vehicle', 'drive' ); ?></h3>
                        <p class="how-step-desc">
                            <?php 
                            printf(
                                /* translators: %s: State name */
                                esc_html__( 'Choose %s and Car, Motorcycle or Truck (CDL).', 'drive' ),
                                esc_html( $current_state_name )
                            ); 
                            ?>
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="how-step-item">
                    <div class="how-step-num-badge">2</div>
                    <div class="how-step-text">
                        <h3 class="how-step-title"><?php esc_html_e( 'Get your PDF instantly', 'drive' ); ?></h3>
                        <p class="how-step-desc">
                            <?php esc_html_e( 'Check out securely and download your cheat sheet right away.', 'drive' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="how-step-item">
                    <div class="how-step-num-badge">3</div>
                    <div class="how-step-text">
                        <h3 class="how-step-title"><?php esc_html_e( 'Study, print and go', 'drive' ); ?></h3>
                        <p class="how-step-desc">
                            <?php esc_html_e( 'Review on your phone or print it, then take your permit test.', 'drive' ); ?>
                        </p>
                    </div>
                </div>

            </div>
        </div><!-- .how-steps-track -->

    </div><!-- .cheat-how-container -->
</section>

