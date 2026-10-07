<?php
/**
 * Template part for displaying the Homepage YouTube Banner Section
 *
 * Replicates the clean dark callout banner matching design:
 * - Rounded dark slate-navy card (#25283c) on white background
 * - Left: Rounded icon box with YouTube play logo, bold title with teal highlight, and subtitle
 * - Right: Crisp white "Subscribe on YouTube" button with external link icon
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$youtube_channel_url = get_theme_mod( 'drive_youtube_url', 'https://www.youtube.com' );
?>

<section id="youtube-banner" class="homepage-section youtube-banner-section" aria-label="<?php esc_attr_e( 'YouTube Video Lessons', 'drive' ); ?>">
    <div class="site-container youtube-container">
        
        <div class="youtube-banner-card">
            
            <!-- Left: Icon Box + Headline & Subtitle -->
            <div class="youtube-banner-left">
                
                <!-- YouTube Icon Box -->
                <div class="youtube-icon-box" aria-hidden="true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </div>

                <!-- Text Content -->
                <div class="youtube-text-block">
                    <h2 class="youtube-banner-title">
                        <?php esc_html_e( 'Free video lessons on our', 'drive' ); ?> <span class="text-teal-glow"><?php esc_html_e( 'YouTube channel', 'drive' ); ?></span>
                    </h2>
                    <p class="youtube-banner-subtext">
                        <?php esc_html_e( 'Watch, learn and practice along with step-by-step permit test videos.', 'drive' ); ?>
                    </p>
                </div>

            </div><!-- .youtube-banner-left -->

            <!-- Right: Subscribe Button -->
            <div class="youtube-banner-right">
                <a href="<?php echo esc_url( $youtube_channel_url ); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="btn-youtube-subscribe"
                   id="btn-youtube-channel">
                    <span class="btn-label"><?php esc_html_e( 'Subscribe on YouTube', 'drive' ); ?></span>
                    <span class="btn-external-icon" aria-hidden="true">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </span>
                </a>
            </div>

        </div><!-- .youtube-banner-card -->

    </div><!-- .site-container -->
</section><!-- #youtube-banner -->
