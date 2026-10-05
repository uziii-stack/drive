<?php
/**
 * Template part for displaying the Homepage Hero section
 *
 * Implements the high-converting social proof hero layout featuring
 * the pass-holder photo wall, floating stat badges, central punchy copy,
 * main CTA button, and trust indicators.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="hero" class="homepage-section homepage-hero hero-pass-wall" aria-labelledby="hero-main-heading">
    <div class="site-container hero-container">
        
        <div class="hero-grid-layout">
            
            <!-- 1. Left Social Proof Flank (Pass-holder photos & stat badges) -->
            <div class="hero-flank hero-flank-left" aria-hidden="true">
                <div class="hero-cards-cluster cluster-left">
                    
                    <!-- Photo Card 1 (Top Left) -->
                    <div class="hero-photo-card card-tilt-left photo-1">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-1.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-1">
                                <span class="avatar-badge-icon">🪪</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 2 (Top Center-Left) -->
                    <div class="hero-photo-card card-tilt-right photo-2">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-2.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-2">
                                <span class="avatar-badge-icon">🚗</span>
                            </div>
                        </div>
                    </div>

                    <!-- Yellow Stat Badge (97% Pass Rate) -->
                    <div class="hero-stat-badge badge-yellow">
                        <div class="stat-number">97%</div>
                        <div class="stat-label"><?php esc_html_e( 'Industry-leading pass rate', 'drive' ); ?></div>
                    </div>

                    <!-- Photo Card 3 (Mid Left) -->
                    <div class="hero-photo-card card-tilt-left photo-3">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-3.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-3">
                                <span class="avatar-badge-icon">✨</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 4 (Mid Center-Left) -->
                    <div class="hero-photo-card card-tilt-right photo-4">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-4.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-4">
                                <span class="avatar-badge-icon">🎉</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 5 (Bottom Left) -->
                    <div class="hero-photo-card card-tilt-left photo-5">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-5.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-5">
                                <span class="avatar-badge-icon">👍</span>
                            </div>
                        </div>
                    </div>

                    <!-- Purple Stat Badge (1,144 Tests Completed) -->
                    <div class="hero-stat-badge badge-purple">
                        <div class="stat-number">1,144</div>
                        <div class="stat-label"><strong><?php esc_html_e( 'tests', 'drive' ); ?></strong> <?php esc_html_e( 'completed today', 'drive' ); ?></div>
                    </div>

                </div>
            </div><!-- .hero-flank-left -->

            <!-- 2. Center Content Area (Headline, Story Subtext, CTA, Trust Bar) -->
            <div class="hero-center-content">
                
                <div class="hero-eyebrow">
                    <span><?php esc_html_e( 'YOUR SHORTCUT TO A DRIVER\'S LICENSE', 'drive' ); ?></span>
                </div>

                <h1 id="hero-main-heading" class="hero-title">
                    <?php esc_html_e( 'Ace Your DMV Test', 'drive' ); ?> 
                    <span class="text-highlight-blue"><?php esc_html_e( 'Without Any Drama', 'drive' ); ?></span>
                </h1>

                <p class="hero-story-p">
                    <?php esc_html_e( 'Scary. Boring. Confusing. No, we\'re not talking about what it\'s like catching up on the news these days. We\'re talking about the permit test. The manuals are daunting. The paperwork is hard to navigate. The DMV is filled with sneezy noses, crying babies, and groans of frustration. No wonder you avoid it all.', 'drive' ); ?>
                </p>

                <p class="hero-hook-text">
                    <?php esc_html_e( 'What if we told you there\'s a better way?', 'drive' ); ?>
                </p>

                <div class="hero-cta-box">
                    <a href="#state-selector" class="btn-hero-primary" id="btn-hero-start">
                        <?php esc_html_e( 'Go to practice tests', 'drive' ); ?>
                    </a>
                </div>

                <div class="hero-trust-bar">
                    <span class="trust-item"><?php esc_html_e( '6M+ practice tests taken this year', 'drive' ); ?></span>
                    <span class="trust-dot" aria-hidden="true">•</span>
                    <span class="trust-item"><?php esc_html_e( 'State-specific', 'drive' ); ?></span>
                    <span class="trust-dot" aria-hidden="true">•</span>
                    <span class="trust-item"><?php esc_html_e( 'No registration required', 'drive' ); ?></span>
                </div>

            </div><!-- .hero-center-content -->

            <!-- 3. Right Social Proof Flank (Pass-holder photos & stat badge) -->
            <div class="hero-flank hero-flank-right" aria-hidden="true">
                <div class="hero-cards-cluster cluster-right">
                    
                    <!-- Photo Card 6 (Top Right) -->
                    <div class="hero-photo-card card-tilt-right photo-6">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-6.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-6">
                                <span class="avatar-badge-icon">🪪</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 7 (Top Far Right) -->
                    <div class="hero-photo-card card-tilt-left photo-7">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-7.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-7">
                                <span class="avatar-badge-icon">⭐</span>
                            </div>
                        </div>
                    </div>

                    <!-- Pink Stat Badge (2026 Updated) -->
                    <div class="hero-stat-badge badge-pink">
                        <div class="stat-number">2026</div>
                        <div class="stat-label"><?php esc_html_e( 'updated', 'drive' ); ?></div>
                    </div>

                    <!-- Photo Card 8 (Mid Right) -->
                    <div class="hero-photo-card card-tilt-right photo-8">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-8.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-8">
                                <span class="avatar-badge-icon">🙌</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 9 (Mid Center-Right) -->
                    <div class="hero-photo-card card-tilt-left photo-9">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-9.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-9">
                                <span class="avatar-badge-icon">🚦</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 10 (Bottom Right) -->
                    <div class="hero-photo-card card-tilt-right photo-10">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-10.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-10">
                                <span class="avatar-badge-icon">💯</span>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Card 11 (Bottom Far Right) -->
                    <div class="hero-photo-card card-tilt-left photo-11">
                        <div class="photo-img-wrap">
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-pass-11.jpg' ); ?>" alt="" onerror="this.parentElement.classList.add('is-fallback')" />
                            <div class="photo-placeholder-avatar avatar-11">
                                <span class="avatar-badge-icon">🚗</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- .hero-flank-right -->

        </div><!-- .hero-grid-layout -->

    </div><!-- .hero-container -->
</section><!-- #hero -->
