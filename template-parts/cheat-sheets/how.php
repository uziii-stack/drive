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
    'car'        => array( 'name' => 'Car', 'tag' => 'CAR CHEAT SHEET', 'sub_title' => 'Important Permit Test Questions' ),
    'motorcycle' => array( 'name' => 'Motorcycle', 'tag' => 'MOTO CHEAT SHEET', 'sub_title' => 'Motorcycle Permit Test Questions' ),
    'cdl'        => array( 'name' => 'CDL (Commercial)', 'tag' => 'CDL CHEAT SHEET', 'sub_title' => 'Commercial Permit Test Questions' ),
);
$curr_data = isset( $vehicle_labels[ $vehicle_key ] ) ? $vehicle_labels[ $vehicle_key ] : $vehicle_labels['car'];

$car_img_src = get_template_directory_uri() . '/assets/images/cars/car-cover.png';
if ( ! file_exists( get_template_directory() . '/assets/images/cars/car-cover.png' ) ) {
    $car_img_src = get_template_directory_uri() . '/assets/images/hero-car.png';
}
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

            <!-- Mini Cheat Sheet Book Mockup (Top-right corner, angled) -->
            <div class="how-mini-cover-wrap" aria-hidden="true">
                <div class="catalog-cover-mockup how-mini-mockup">
                    <div class="sheet-inner client-cover-style">
                        <div class="sheet-header">
                            <div class="sheet-brand">
                                <span class="brand-top">DMV Learners</span>
                                <span class="brand-bot">Permit <strong class="brand-test-orange">Test</strong></span>
                            </div>
                        </div>
                        <div class="sheet-title-area">
                            <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                            <div class="sheet-big-num orange-accent"><?php echo esc_html( $question_count ); ?></div>
                            <span class="sheet-main-title"><?php echo esc_html( $curr_data['sub_title'] ); ?></span>
                            <div class="title-orange-underline"></div>
                        </div>
                        <div class="sheet-image-showcase">
                            <img src="<?php echo esc_url( $car_img_src ); ?>" alt="" class="cover-showcase-img" />
                        </div>
                    </div>
                </div>
            </div>

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

                <!-- Step 2 -->
                <div class="how-step-item">
                    <div class="how-step-num-badge">2</div>
                    <h3 class="how-step-title"><?php esc_html_e( 'Get your PDF instantly', 'drive' ); ?></h3>
                    <p class="how-step-desc">
                        <?php esc_html_e( 'Check out securely and download your cheat sheet right away.', 'drive' ); ?>
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="how-step-item">
                    <div class="how-step-num-badge">3</div>
                    <h3 class="how-step-title"><?php esc_html_e( 'Study, print and go', 'drive' ); ?></h3>
                    <p class="how-step-desc">
                        <?php esc_html_e( 'Review on your phone or print it, then take your permit test.', 'drive' ); ?>
                    </p>
                </div>

            </div>
        </div><!-- .how-steps-track -->

    </div><!-- .cheat-how-container -->
</section>
