<?php
/**
 * Template part for displaying the Homepage Hero section
 *
 * Implements the dark interactive mockup hero layout with:
 * - Top Badge: "FREE PERMIT TEST PREP · 40 STATES"
 * - Headline with vibrant teal highlight: "Get road–ready for your DMV permit test"
 * - Subtitle & Orange "Choose Your State" CTA button
 * - Feature checklist (State-specific, Car/truck/motorcycle, Free to start)
 * - Right Side: Interactive practice test question card with floating Cheat Sheet & Mock Test timer badges
 * - Subtle background curved highway road graphic
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$all_states     = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$vehicle_types  = function_exists( 'drive_get_vehicle_types' ) ? drive_get_vehicle_types() : array();

// Determine state context
$current_state_slug = 'california';
if ( isset( $_GET['state'] ) && ! empty( $_GET['state'] ) ) {
    $req_state = sanitize_title( wp_unslash( $_GET['state'] ) );
    foreach ( $all_states as $code => $data ) {
        if ( $data['slug'] === $req_state || strtolower( $code ) === strtolower( $req_state ) ) {
            $current_state_slug = $data['slug'];
            break;
        }
    }
}
$current_s_name = 'California';
foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_s_name = $data['name'];
        break;
    }
}

// Determine vehicle context
$current_veh = 'car';
if ( isset( $_GET['veh'] ) && ! empty( $_GET['veh'] ) ) {
    $req_veh = sanitize_title( wp_unslash( $_GET['veh'] ) );
    if ( array_key_exists( $req_veh, $vehicle_types ) ) {
        $current_veh = $req_veh;
    }
}
?>

<section id="hero" class="homepage-section homepage-hero hero-dark-mockup" aria-labelledby="hero-main-heading">
    
    <!-- Curved Road Background Graphic -->
    <div class="hero-road-bg-wrap" aria-hidden="true">
        <svg class="hero-road-svg" viewBox="0 0 1440 280" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <!-- Road Asphalt Surface Ribbon -->
            <path d="M-60 190 C 350 245, 680 230, 960 155 C 1180 95, 1360 140, 1500 170 L 1500 290 L -60 290 Z" fill="rgba(0, 0, 0, 0.15)"/>
            <!-- Top Lane Solid Line -->
            <path d="M-60 145 C 330 200, 660 185, 960 110 C 1180 50, 1360 95, 1500 125" stroke="rgba(255, 255, 255, 0.08)" stroke-width="2"/>
            <!-- Center Dashed Line -->
            <path d="M-60 190 C 350 245, 680 230, 960 155 C 1180 95, 1360 140, 1500 170" stroke="rgba(255, 255, 255, 0.22)" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="14 16"/>
            <!-- Bottom Lane Solid Line -->
            <path d="M-60 235 C 370 290, 700 275, 960 200 C 1180 140, 1360 185, 1500 215" stroke="rgba(255, 255, 255, 0.08)" stroke-width="2"/>
        </svg>
    </div>

    <div class="hero-container">
        
        <div class="hero-split-grid">
            
            <!-- Left Column: Copy, CTA & Checklist -->
            <div class="hero-content-col">
                
                <!-- Badge -->
                <div class="hero-top-badge">
                    <span class="badge-dot" aria-hidden="true"></span>
                    <span class="badge-text"><?php esc_html_e( 'FREE PERMIT TEST PREP · 40 STATES', 'drive' ); ?></span>
                </div>

                <!-- Headline -->
                <h1 id="hero-main-heading" class="hero-main-title">
                    <?php esc_html_e( 'Get road–ready for', 'drive' ); ?><br>
                    <?php esc_html_e( 'your', 'drive' ); ?> <span class="text-teal-glow"><?php esc_html_e( 'DMV permit test', 'drive' ); ?></span>
                </h1>

                <!-- Subtitle -->
                <p class="hero-subtext">
                    <?php esc_html_e( 'State-specific practice tests, timed mock exams and printable cheat sheets for car, truck and motorcycle.', 'drive' ); ?>
                </p>

                <!-- CTA Button -->
                <div class="hero-action-row">
                    <a href="#state-selector" class="btn-hero-orange" id="btn-hero-choose-state">
                        <span class="btn-label"><?php esc_html_e( 'Choose Your State', 'drive' ); ?></span>
                        <span class="btn-arrow-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 10h12M11 5l5 5-5 5"/>
                            </svg>
                        </span>
                    </a>
                </div>

                <!-- Checklist Features -->
                <div class="hero-checkmarks-list">
                    <div class="hero-check-item">
                        <span class="check-icon-box" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 8.5L6.5 12L13 4.5"/>
                            </svg>
                        </span>
                        <span class="check-item-text"><?php esc_html_e( 'State-specific', 'drive' ); ?></span>
                    </div>

                    <div class="hero-check-item">
                        <span class="check-icon-box" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 8.5L6.5 12L13 4.5"/>
                            </svg>
                        </span>
                        <span class="check-item-text"><?php esc_html_e( 'Car, truck & motorcycle', 'drive' ); ?></span>
                    </div>

                    <div class="hero-check-item">
                        <span class="check-icon-box" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 8.5L6.5 12L13 4.5"/>
                            </svg>
                        </span>
                        <span class="check-item-text"><?php esc_html_e( 'Free to start', 'drive' ); ?></span>
                    </div>
                </div>

            </div><!-- .hero-content-col -->


            <!-- Right Column: Interactive Practice Test Card Mockup + Floating Badges -->
            <div class="hero-mockup-col">
                <div class="hero-mockup-wrapper">
                    
                    <!-- Floating Badge: Cheat Sheet (Top Right) -->
                    <div class="floating-badge badge-cheat-sheet" aria-hidden="true">
                        <div class="badge-cheat-top">
                            <div class="badge-icon-box">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00D4C3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                    <polyline points="14 2 14 8 20 8"/>
                                    <line x1="9" y1="13" x2="15" y2="13"/>
                                    <line x1="9" y1="17" x2="15" y2="17"/>
                                </svg>
                            </div>
                            <div class="badge-cheat-text-wrap">
                                <span class="badge-title"><?php esc_html_e( 'Cheat Sheet', 'drive' ); ?></span>
                                <span class="badge-sub"><?php esc_html_e( 'Printable PDF', 'drive' ); ?></span>
                            </div>
                        </div>
                        <div class="badge-doc-lines">
                            <span class="doc-line line-1"></span>
                            <span class="doc-line line-2"></span>
                            <span class="doc-line line-3"></span>
                        </div>
                    </div>

                    <!-- Main Question Mockup Card -->
                    <div class="hero-question-card">
                        
                        <!-- Card Header Meta -->
                        <div class="card-meta-row">
                            <span class="card-tag"><?php echo esc_html( $current_s_name ); ?> · <?php echo esc_html( ucfirst( $current_veh ) ); ?></span>
                            <span class="card-counter"><?php esc_html_e( 'Question 4 of 20', 'drive' ); ?></span>
                        </div>

                        <!-- Progress Bar (20% Completed) -->
                        <div class="card-progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                            <div class="card-progress-fill" style="width: 20%;"></div>
                        </div>

                        <!-- Question Title -->
                        <h2 class="card-question-text">
                            <?php esc_html_e( 'What should you do at a flashing red traffic light?', 'drive' ); ?>
                        </h2>

                        <!-- Options List -->
                        <div class="card-options-list">
                            
                            <!-- Option 1 -->
                            <button type="button" class="card-option-btn">
                                <span class="opt-label"><?php esc_html_e( 'Slow down and continue', 'drive' ); ?></span>
                            </button>

                            <!-- Option 2: Active / Correct State matching screenshot -->
                            <button type="button" class="card-option-btn is-correct is-active">
                                <span class="opt-label"><?php esc_html_e( 'Stop fully, then go when safe', 'drive' ); ?></span>
                                <span class="opt-check-badge" aria-hidden="true">
                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 10.5L8 14.5L16 6"/>
                                    </svg>
                                </span>
                            </button>

                            <!-- Option 3 -->
                            <button type="button" class="card-option-btn">
                                <span class="opt-label"><?php esc_html_e( 'Stop only if cars are coming', 'drive' ); ?></span>
                            </button>

                        </div>

                    </div><!-- .hero-question-card -->

                    <!-- Floating Badge: Mock Test Timer (Bottom Right) -->
                    <div class="floating-badge badge-mock-timer" aria-hidden="true">
                        <div class="timer-icon-box">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="13" r="8"/>
                                <line x1="12" y1="9" x2="12" y2="13"/>
                                <line x1="12" y1="13" x2="15" y2="15"/>
                                <line x1="9.5" y1="3" x2="14.5" y2="3"/>
                            </svg>
                        </div>
                        <div class="timer-text-box">
                            <div class="timer-label"><?php esc_html_e( 'Mock Test', 'drive' ); ?></div>
                            <div class="timer-value"><?php esc_html_e( '18:42 left', 'drive' ); ?></div>
                        </div>
                    </div>

                </div><!-- .hero-mockup-wrapper -->
            </div><!-- .hero-mockup-col -->

        </div><!-- .hero-split-grid -->

    </div><!-- .hero-container -->
</section><!-- #hero -->
