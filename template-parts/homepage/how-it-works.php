<?php
/**
 * Template part for displaying the "How It Works" Section on Homepage
 *
 * Replicates the clean 3-step interactive section matching design:
 * - Top: Centered "HOW IT WORKS" teal tag, main title, and subtitle
 * - Left: 3 interactive step cards with large numbers (01, 02, 03), teal border on active, and dark "Get Started →" button
 * - Right: Dark browser walkthrough video mockup card with top bar, step badge, play icon, and segmented timeline
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="how-it-works" class="homepage-section how-it-works-section" aria-labelledby="how-it-works-heading">
    <div class="site-container how-container">
        
        <!-- Section Header -->
        <div class="how-section-header">
            <span class="how-category-tag"><?php esc_html_e( 'HOW IT WORKS', 'drive' ); ?></span>
            <h2 id="how-it-works-heading" class="how-main-title">
                <?php esc_html_e( 'Three simple steps to start practicing', 'drive' ); ?>
            </h2>
            <p class="how-subtitle">
                <?php esc_html_e( 'From choosing your state to your first mock test in a few clicks.', 'drive' ); ?>
            </p>
        </div>

        <!-- 2-Column Interactive Grid -->
        <div class="how-split-grid">
            
            <!-- Left Column: 3 Steps + CTA -->
            <div class="how-steps-col">
                <div class="how-steps-list" role="tablist" aria-label="<?php esc_attr_e( 'How it works steps', 'drive' ); ?>">
                    
                    <!-- Step 01 -->
                    <button type="button" 
                            class="how-step-card is-active" 
                            data-step="1" 
                            data-step-title="<?php esc_attr_e( '01 · Choose your state', 'drive' ); ?>"
                            id="how-step-tab-1"
                            role="tab"
                            aria-selected="true"
                            aria-controls="how-mockup-panel">
                        <div class="how-step-num">01</div>
                        <div class="how-step-body">
                            <h3 class="how-step-heading"><?php esc_html_e( 'Choose your state', 'drive' ); ?></h3>
                            <p class="how-step-text">
                                <?php esc_html_e( "Pick your state on the map or from the list. Everything follows your state's driver handbook.", 'drive' ); ?>
                            </p>
                        </div>
                    </button>

                    <!-- Step 02 -->
                    <button type="button" 
                            class="how-step-card" 
                            data-step="2" 
                            data-step-title="<?php esc_attr_e( '02 · Pick your vehicle', 'drive' ); ?>"
                            id="how-step-tab-2"
                            role="tab"
                            aria-selected="false"
                            aria-controls="how-mockup-panel">
                        <div class="how-step-num">02</div>
                        <div class="how-step-body">
                            <h3 class="how-step-heading"><?php esc_html_e( 'Pick your vehicle', 'drive' ); ?></h3>
                            <p class="how-step-text">
                                <?php esc_html_e( 'Car, truck or motorcycle. Each one has its own questions and cheat sheet.', 'drive' ); ?>
                            </p>
                        </div>
                    </button>

                    <!-- Step 03 -->
                    <button type="button" 
                            class="how-step-card" 
                            data-step="3" 
                            data-step-title="<?php esc_attr_e( '03 · Practice and take mock tests', 'drive' ); ?>"
                            id="how-step-tab-3"
                            role="tab"
                            aria-selected="false"
                            aria-controls="how-mockup-panel">
                        <div class="how-step-num">03</div>
                        <div class="how-step-body">
                            <h3 class="how-step-heading"><?php esc_html_e( 'Practice and take mock tests', 'drive' ); ?></h3>
                            <p class="how-step-text">
                                <?php esc_html_e( 'Start free in your dashboard with topic practice and a timed mock test. No sign-up needed to begin.', 'drive' ); ?>
                            </p>
                        </div>
                    </button>

                </div><!-- .how-steps-list -->

                <!-- CTA Button -->
                <div class="how-cta-wrap">
                    <a href="#state-selector" class="btn-how-dark-cta" id="btn-how-start-practicing">
                        <span class="btn-label"><?php esc_html_e( 'Get Started', 'drive' ); ?></span>
                        <span class="btn-arrow-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 10h12M11 5l5 5-5 5"/>
                            </svg>
                        </span>
                    </a>
                </div>

            </div><!-- .how-steps-col -->


            <!-- Right Column: Browser Walkthrough Mockup -->
            <div class="how-mockup-col" id="how-mockup-panel" role="tabpanel" aria-labelledby="how-step-tab-1">
                <div class="how-browser-mockup">
                    
                    <!-- Top Browser Header Bar -->
                    <div class="how-browser-topbar">
                        <div class="how-browser-dots" aria-hidden="true">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                        <div class="how-browser-url">
                            <span class="url-text"><?php echo esc_html( wp_parse_url( home_url(), PHP_URL_HOST ) ?: 'dmvlearnerspermittest.com' ); ?></span>
                        </div>
                    </div>

                    <!-- Browser Inner Canvas / Video Mockup -->
                    <div class="how-browser-content">
                        
                        <!-- Walkthrough Video -->
                        <video class="how-walkthrough-video" 
                               id="howWalkthroughVideo" 
                               autoplay 
                               muted 
                               loop 
                               playsinline 
                               preload="metadata">
                            <source src="https://driving-tests.org/premium/video/DTO.mp4" type="video/mp4">
                        </video>

                        <!-- Top-Left Step Badge Pill -->
                        <div class="how-mockup-step-pill" id="how-mockup-step-pill">
                            <?php esc_html_e( '01 · Choose your state', 'drive' ); ?>
                        </div>

                        <!-- Bottom Segmented Timeline Controls -->
                        <div class="how-video-controls">
                            <div class="how-timeline-segments">
                                <span class="timeline-segment is-active" data-step-seg="1"></span>
                                <span class="timeline-segment" data-step-seg="2"></span>
                                <span class="timeline-segment" data-step-seg="3"></span>
                            </div>
                            <button type="button" class="how-pause-btn" id="btn-how-video-toggle" aria-label="<?php esc_attr_e( 'Pause video walkthrough loop', 'drive' ); ?>">
                                <svg class="icon-pause" width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <rect x="6" y="4" width="4" height="16" rx="1"></rect>
                                    <rect x="14" y="4" width="4" height="16" rx="1"></rect>
                                </svg>
                                <svg class="icon-play" width="13" height="13" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                                    <polygon points="6 4 20 12 6 20"></polygon>
                                </svg>
                            </button>
                        </div>

                    </div><!-- .how-browser-content -->

                </div><!-- .how-browser-mockup -->
            </div><!-- .how-mockup-col -->

        </div><!-- .how-split-grid -->

    </div><!-- .how-container -->
</section><!-- #how-it-works -->
