<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * Designed with high-polish dark theme matching the brand:
 * - Curved road graphic
 * - 404 badge and glowing typography
 * - Interactive detour DMV practice test card
 * - Search bar and quick category navigation
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404-section" aria-labelledby="error-heading">
        
        <!-- Curved Road Background Graphic: 2 Gray Asphalt Lanes traversing across Charcoal (#2B2D42) -->
        <div class="error-road-bg-wrap" aria-hidden="true">
            <svg class="error-road-svg" viewBox="0 0 1440 240" fill="none" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <!-- Upper Roadway Lane (Gray Asphalt #383A52) -->
                <path d="M -50 110 C 380 165, 740 150, 1100 85 C 1240 65, 1380 85, 1500 105 L 1500 150 C 1380 130, 1240 110, 1100 130 C 740 195, 380 210, -50 155 Z" fill="#383A52"/>
                
                <!-- Lower Roadway Lane (Gray Asphalt #383A52) -->
                <path d="M -50 155 C 380 210, 740 195, 1100 130 C 1240 110, 1380 130, 1500 150 L 1500 195 C 1380 175, 1240 155, 1100 175 C 740 240, 380 255, -50 200 Z" fill="#383A52"/>
                
                <!-- Top Road Edge Line -->
                <path d="M -50 110 C 380 165, 740 150, 1100 85 C 1240 65, 1380 85, 1500 105" stroke="rgba(255, 255, 255, 0.18)" stroke-width="1.5"/>
                
                <!-- Center Dashed Lane Divider Line -->
                <path d="M -50 155 C 380 210, 740 195, 1100 130 C 1240 110, 1380 130, 1500 150" stroke="rgba(255, 255, 255, 0.45)" stroke-width="2.5" stroke-linecap="round" stroke-dasharray="14 16"/>
                
                <!-- Bottom Road Edge Line -->
                <path d="M -50 200 C 380 255, 740 240, 1100 175 C 1240 155, 1380 175, 1500 195" stroke="rgba(255, 255, 255, 0.18)" stroke-width="1.5"/>
            </svg>
        </div>

        <div class="error-404-container">
            <div class="error-split-grid">
                
                <!-- Left Column: Copy & CTAs -->
                <div class="error-content-col">
                    
                    <div class="error-pill-badge">
                        <span class="badge-dot" aria-hidden="true"></span>
                        <span class="badge-text"><?php esc_html_e( '404 ERROR · OFF ROAD', 'drive' ); ?></span>
                    </div>

                    <div class="error-hero-number" aria-hidden="true">404</div>

                    <h1 id="error-heading" class="error-main-title">
                        <?php esc_html_e( 'Looks like you took a', 'drive' ); ?> <span class="text-teal-glow"><?php esc_html_e( 'wrong turn', 'drive' ); ?></span>
                    </h1>

                    <p class="error-subtext">
                        <?php esc_html_e( 'The page or permit test you are looking for has taken an unexpected exit. Let’s get you back on the right road to your driver license.', 'drive' ); ?>
                    </p>

                    <!-- CTAs -->
                    <div class="error-action-row">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-error-orange">
                            <span><?php esc_html_e( 'Return to Homepage', 'drive' ); ?></span>
                            <span class="btn-arrow" aria-hidden="true">
                                <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 10h12M11 5l5 5-5 5"/>
                                </svg>
                            </span>
                        </a>

                        <a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>" class="btn-error-dark">
                            <span><?php esc_html_e( 'Choose Your State', 'drive' ); ?></span>
                        </a>
                    </div>

                    <!-- Quick Links -->
                    <div class="error-quick-links">
                        <span class="error-quick-label"><?php esc_html_e( 'Popular Tests:', 'drive' ); ?></span>
                        <a href="<?php echo esc_url( home_url( '/california/car-practice-test/' ) ); ?>" class="error-quick-pill"><?php esc_html_e( 'California Car', 'drive' ); ?></a>
                        <a href="<?php echo esc_url( home_url( '/texas/car-practice-test/' ) ); ?>" class="error-quick-pill"><?php esc_html_e( 'Texas Car', 'drive' ); ?></a>
                        <a href="<?php echo esc_url( home_url( '/florida/car-practice-test/' ) ); ?>" class="error-quick-pill"><?php esc_html_e( 'Florida Car', 'drive' ); ?></a>
                    </div>

                </div><!-- .error-content-col -->


                <!-- Right Column: DMV Practice Card Mockup (Detour themed) -->
                <div class="error-mockup-col">
                    <div class="error-question-card">
                        
                        <div class="error-card-meta">
                            <span class="error-card-tag"><?php esc_html_e( 'DETOUR SCENARIO', 'drive' ); ?></span>
                            <span class="error-card-counter"><?php esc_html_e( 'Question 404 of 404', 'drive' ); ?></span>
                        </div>

                        <div class="error-card-progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                            <div class="error-card-progress-fill" style="width: 100%;"></div>
                        </div>

                        <h2 class="error-card-question">
                            <?php esc_html_e( 'What is the correct driving maneuver when encountering a 404 Dead End?', 'drive' ); ?>
                        </h2>

                        <div class="error-card-options">
                            
                            <!-- Correct Option -->
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-option-btn is-correct">
                                <span class="opt-label"><?php esc_html_e( 'Make a safe U-turn back to the homepage', 'drive' ); ?></span>
                                <span class="opt-check-badge" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 10.5L8 14.5L16 6"/>
                                    </svg>
                                </span>
                            </a>

                            <!-- Distractor 1 -->
                            <a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>" class="error-option-btn">
                                <span class="opt-label"><?php esc_html_e( 'Select a valid state & start practicing', 'drive' ); ?></span>
                            </a>

                            <!-- Distractor 2 -->
                            <button type="button" class="error-option-btn" onclick="window.history.back();">
                                <span class="opt-label"><?php esc_html_e( 'Reverse back to the previous page', 'drive' ); ?></span>
                            </button>

                        </div>

                    </div><!-- .error-question-card -->
                </div><!-- .error-mockup-col -->

            </div><!-- .error-split-grid -->
        </div><!-- .error-404-container -->

    </section>
</main>

<?php
get_footer();
