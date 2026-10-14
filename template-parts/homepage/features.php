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

    <div class="site-container offer-container">
        <div class="offer-grid-layout">

            <!-- Perspective Road Background Graphic from Figma Specs -->
            <div class="offer-road-bg" aria-hidden="true">
                <svg class="offer-road-svg" viewBox="0 0 740 800" preserveAspectRatio="none" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Road Surface (Fill #383A52, width 740, height 800) -->
                    <polygon points="0,800 320,0 420,0 740,800" fill="#383A52" />
                    
                    <!-- Left Line (Stroke #4A4C66, width 6px, exactly 20px inside road) -->
                    <line x1="20" y1="800" x2="340" y2="0" stroke="#4A4C66" stroke-width="6" stroke-linecap="round" />
                    
                    <!-- Right Line (Stroke #4A4C66, width 6px, exactly 20px inside road) -->
                    <line x1="720" y1="800" x2="400" y2="0" stroke="#4A4C66" stroke-width="6" stroke-linecap="round" />
                    
                    <!-- Middle Dashed Line (#FFFFFF2E, width 6px, dashes: 40 34) -->
                    <line x1="370" y1="800" x2="370" y2="0" stroke="#FFFFFF2E" stroke-width="6" stroke-linecap="round" stroke-dasharray="40 34" />
                </svg>
            </div>

            <!-- Left Column: Copy & CTA -->
            <div class="offer-content-col">
                
                <!-- Category Tag -->
                <div class="offer-category-tag">
                    <?php esc_html_e( 'WHAT WE OFFER', 'drive' ); ?>
                </div>

                <!-- Main Section Title -->
                <h2 id="what-we-offer-heading" class="offer-main-title">
                    <?php esc_html_e( 'Everything you need', 'drive' ); ?><br class="offer-title-br">
                    <?php esc_html_e( 'to prepare for your', 'drive' ); ?><br class="offer-title-br">
                    <?php esc_html_e( 'permit test', 'drive' ); ?>
                </h2>

                <!-- Subtitle Description -->
                <p class="offer-subtitle">
                    <?php esc_html_e( "Study at your own pace with tools built around your state's driver handbook.", 'drive' ); ?>
                </p>

                <!-- Desktop CTA Action Button -->
                <div class="offer-cta-wrap offer-cta-desktop">
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
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" stroke="#2B2D42" stroke-width="2" stroke-linecap="round"/>
                                <rect x="9" y="2" width="6" height="3.5" rx="1" fill="#F4F5F7" stroke="#2B2D42" stroke-width="1.8"/>
                                <path d="M9 13.5l2.2 2.2 4.3-4.3" stroke="#00B4A6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="offer-card-text">
                            <h3 class="offer-card-title"><?php esc_html_e( 'Practice Tests', 'drive' ); ?></h3>
                            <p class="offer-card-desc"><?php esc_html_e( 'Topic-wise questions to learn one section at a time.', 'drive' ); ?></p>
                        </div>
                    </div>

                    <!-- Card 2: Mock Tests -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="13.5" r="7.5" stroke="#2B2D42" stroke-width="2"/>
                                <path d="M12 2v3.5M9.5 2h5" stroke="#2B2D42" stroke-width="2" stroke-linecap="round"/>
                                <path d="M18.5 5.5l-1.5 1.5" stroke="#2B2D42" stroke-width="1.8" stroke-linecap="round"/>
                                <circle cx="12" cy="13.5" r="1.2" fill="#00B4A6"/>
                                <path d="M12 9.5v4l2.5 1.5" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="offer-card-text">
                            <h3 class="offer-card-title"><?php esc_html_e( 'Mock Tests', 'drive' ); ?></h3>
                            <p class="offer-card-desc"><?php esc_html_e( 'Timed tests that feel like the real test day.', 'drive' ); ?></p>
                        </div>
                    </div>

                    <!-- Card 3: Cheat Sheets (PDF) -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7L15 2z" stroke="#2B2D42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M14 2v5h5" stroke="#2B2D42" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="14.5" r="3.5" fill="#00B4A6"/>
                                <path d="M12 12.8v3.4M10.2 14.7l1.8 1.8 1.8-1.8" stroke="#ffffff" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="offer-card-text">
                            <h3 class="offer-card-title"><?php esc_html_e( 'Cheat Sheets (PDF)', 'drive' ); ?></h3>
                            <p class="offer-card-desc"><?php esc_html_e( 'Key rules and road signs in a printable PDF.', 'drive' ); ?></p>
                        </div>
                    </div>

                    <!-- Card 4: States Covered -->
                    <div class="offer-feature-card">
                        <div class="offer-card-icon-box" aria-hidden="true">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6l6-3 6 3 6-3v15l-6 3-6-3-6 3V6z" stroke="#2B2D42" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 3v15M15 6v15" stroke="#2B2D42" stroke-width="1.5"/>
                                <path d="M12 7.5a2.5 2.5 0 0 1 2.5 2.5c0 2.2-2.5 4.5-2.5 4.5s-2.5-2.3-2.5-4.5A2.5 2.5 0 0 1 12 7.5z" fill="#00B4A6" stroke="#2B2D42" stroke-width="1.2" stroke-linejoin="round"/>
                                <circle cx="12" cy="10" r="0.9" fill="#ffffff"/>
                            </svg>
                        </div>
                        <div class="offer-card-text">
                            <h3 class="offer-card-title"><?php echo esc_html( sprintf( __( '%d States Covered', 'drive' ), $all_states_count ) ); ?></h3>
                            <p class="offer-card-desc"><?php esc_html_e( 'Car, truck and motorcycle content for each state.', 'drive' ); ?></p>
                        </div>
                    </div>

                </div><!-- .offer-cards-grid -->

                <!-- Mobile Only CTA Action Button (Positioned after cards as in screenshot) -->
                <div class="offer-cta-wrap offer-cta-mobile">
                    <a href="#state-selector" class="btn-hero-orange btn-offer-cta" id="btn-offer-start-free-mobile">
                        <span class="btn-label"><?php esc_html_e( 'Start Practicing Free', 'drive' ); ?></span>
                        <span class="btn-arrow-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 10h12M11 5l5 5-5 5"/>
                            </svg>
                        </span>
                    </a>
                </div>

            </div><!-- .offer-cards-col -->

        </div><!-- .offer-grid-layout -->
    </div><!-- .offer-container -->

</section><!-- #what-we-offer -->
