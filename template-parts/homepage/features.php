<?php
/**
 * Template part for displaying the "What We Offer" Section on Homepage
 *
 * Replicates the 2-column dark section matching design:
 * - Left: "WHAT WE OFFER" teal pill tag, bold 3-line headline, descriptive subtitle, orange CTA button with arrow, subtle perspective road lines in background
 * - Right: 2x2 grid of clean white rounded cards with teal icon boxes and feature descriptions
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Calculate covered state count dynamically or fallback to 40
$all_states_count = 40;
if ( function_exists( 'drive_get_states' ) ) {
    $states_list = drive_get_states();
    if ( ! empty( $states_list ) && is_array( $states_list ) ) {
        $all_states_count = count( $states_list );
    }
}
?>

<section id="what-we-offer" class="homepage-section what-we-offer-section" aria-labelledby="what-we-offer-heading">
    
    <!-- Subtle Perspective Road Background (Left Side) -->
    <div class="offer-road-bg" aria-hidden="true">
        <svg class="offer-road-svg" viewBox="0 0 500 600" preserveAspectRatio="none" fill="none">
            <!-- Road Left Boundary -->
            <path d="M60 600 L230 0" stroke="rgba(255, 255, 255, 0.05)" stroke-width="2.5" />
            <!-- Road Right Boundary -->
            <path d="M440 600 L270 0" stroke="rgba(255, 255, 255, 0.05)" stroke-width="2.5" />
            <!-- Dashed Center Divider -->
            <line x1="250" y1="600" x2="250" y2="0" stroke="rgba(255, 255, 255, 0.07)" stroke-width="2.5" stroke-dasharray="18 24" />
        </svg>
    </div>

    <div class="site-container offer-container">
        <div class="offer-grid-layout">
            
            <!-- Left Column: Copy & CTA -->
            <div class="offer-content-col">
                
                <!-- Category Tag -->
                <div class="offer-category-tag">
                    <?php esc_html_e( 'WHAT WE OFFER', 'drive' ); ?>
                </div>

                <!-- Main Section Title -->
                <h2 id="what-we-offer-heading" class="offer-main-title">
                    <?php esc_html_e( 'Everything you need', 'drive' ); ?><br>
                    <?php esc_html_e( 'to prepare for your', 'drive' ); ?><br>
                    <?php esc_html_e( 'permit test', 'drive' ); ?>
                </h2>

                <!-- Subtitle Description -->
                <p class="offer-subtitle">
                    <?php esc_html_e( "Study at your own pace with tools built around your state's driver handbook.", 'drive' ); ?>
                </p>

                <!-- CTA Action Button -->
                <div class="offer-cta-wrap">
                    <a href="#state-selector" class="btn-hero-orange btn-offer-cta" id="btn-offer-start-free">
                        <span class="btn-label"><?php esc_html_e( 'Start Practicing Free', 'drive' ); ?></span>
                        <span class="btn-arrow-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 10h12M11 5l5 5-5 5"/>
                            </svg>
                        </span>
                    </a>
                </div>

            </div><!-- .offer-content-col -->


            <!-- Right Column: 2x2 Grid of Feature Cards -->
            <div class="offer-cards-col">
                <div class="offer-cards-grid">
                    
                    <!-- Card 1: Practice Tests -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4C3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                <path d="M9 14l2 2 4-4"></path>
                            </svg>
                        </div>
                        <h3 class="offer-card-title"><?php esc_html_e( 'Practice Tests', 'drive' ); ?></h3>
                        <p class="offer-card-desc"><?php esc_html_e( 'Topic-wise questions to learn one section at a time.', 'drive' ); ?></p>
                    </div>

                    <!-- Card 2: Mock Tests -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4C3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="13" r="8"></circle>
                                <path d="M12 9v4l2 2"></path>
                                <path d="M5 3L2 6"></path>
                                <path d="M22 6l-3-3"></path>
                                <path d="M12 2v3"></path>
                            </svg>
                        </div>
                        <h3 class="offer-card-title"><?php esc_html_e( 'Mock Tests', 'drive' ); ?></h3>
                        <p class="offer-card-desc"><?php esc_html_e( 'Timed tests that feel like the real test day.', 'drive' ); ?></p>
                    </div>

                    <!-- Card 3: Cheat Sheets (PDF) -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4C3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <path d="M12 12v6"></path>
                                <path d="M9 15l3 3 3-3"></path>
                            </svg>
                        </div>
                        <h3 class="offer-card-title"><?php esc_html_e( 'Cheat Sheets (PDF)', 'drive' ); ?></h3>
                        <p class="offer-card-desc"><?php esc_html_e( 'Key rules and road signs in a printable PDF.', 'drive' ); ?></p>
                    </div>

                    <!-- Card 4: States Covered -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00D4C3" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                <line x1="8" y1="2" x2="8" y2="18"></line>
                                <line x1="16" y1="6" x2="16" y2="22"></line>
                            </svg>
                        </div>
                        <h3 class="offer-card-title"><?php echo esc_html( sprintf( __( '%d States Covered', 'drive' ), $all_states_count ) ); ?></h3>
                        <p class="offer-card-desc"><?php esc_html_e( 'Car, truck and motorcycle content for each state.', 'drive' ); ?></p>
                    </div>

                </div><!-- .offer-cards-grid -->
            </div><!-- .offer-cards-col -->

        </div><!-- .offer-grid-layout -->
    </div><!-- .offer-container -->

</section><!-- #what-we-offer -->
