<?php
/**
 * Template part for displaying the Homepage YouTube section placeholder
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="video-lessons" class="homepage-section homepage-youtube" aria-labelledby="youtube-heading">
    <div class="site-container">
        <div class="section-header">
            <h2 id="youtube-heading" class="section-title">
                <?php esc_html_e( 'Video Study Guides & Tips', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Visual breakdowns of tricky permit questions, road signs, and safe driving rules.', 'drive' ); ?>
            </p>
        </div>

        <div class="youtube-placeholder-box">
            <p class="placeholder-note">
                <?php esc_html_e( '[Featured Video Lesson & Channel Embed Placeholder]', 'drive' ); ?>
            </p>
        </div>
    </div>
</section>
