<?php
/**
 * Money-Back Guarantee Section Template Part
 *
 * Section ID: #guarantee
 *
 * Implements the dark charcoal guarantee banner matching the screenshot:
 * - Background: Dark charcoal (#26283B)
 * - Faint giant watermark shield with checkmark on the right side
 * - Eyebrow pill: teal border + shield icon + "[30]-DAY MONEY-BACK GUARANTEE"
 * - Title:
 *   - "Not happy with your cheat sheet?" (White)
 *   - "Get a full refund." (Teal #00B4A6)
 * - Lead text: "We want the cheat sheet to help you study. If it does not, you get your money back. No long forms."
 * - Horizontal 3-step pill bar (dark container #32354B):
 *   - 1 Buy your cheat sheet → 2 Study with it → 3 Not happy? Email us within [30] days
 * - Bottom link with teal underline: "Read the refund policy →"
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$guarantee_days = '30';
$refund_url     = function_exists( 'get_privacy_policy_url' ) && get_privacy_policy_url() ? get_privacy_policy_url() : home_url( '/refund-policy/' );
?>

<section id="guarantee" class="cheat-guarantee-section" aria-labelledby="guarantee-heading">
    
    <!-- Large Faint Shield Watermark in Background (Right side) -->
    <div class="guarantee-watermark-shield" aria-hidden="true">
        <svg viewBox="0 0 200 240" fill="none">
            <path d="M100 20 L180 50 V130 C180 185 100 220 100 220 C100 220 20 185 20 130 V50 L100 20 Z" 
                  stroke="rgba(255, 255, 255, 0.05)" 
                  stroke-width="7" 
                  stroke-linejoin="round"/>
            <polyline points="65 125 90 150 145 95" 
                      stroke="rgba(255, 255, 255, 0.05)" 
                      stroke-width="7" 
                      stroke-linecap="round" 
                      stroke-linejoin="round"/>
        </svg>
    </div>

    <div class="site-container cheat-guarantee-container">
        
        <!-- Eyebrow Pill -->
        <div class="guarantee-pill">
            <svg class="pill-shield-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
            <span class="pill-text">
                <?php 
                printf(
                    /* translators: %s: Number of guarantee days */
                    esc_html__( '[%s]–DAY MONEY–BACK GUARANTEE', 'drive' ),
                    esc_html( $guarantee_days )
                ); 
                ?>
            </span>
        </div>

        <!-- 2-Line Heading -->
        <h2 id="guarantee-heading" class="guarantee-title">
            <span class="title-white"><?php esc_html_e( 'Not happy with your cheat sheet?', 'drive' ); ?></span>
            <span class="title-teal"><?php esc_html_e( 'Get a full refund.', 'drive' ); ?></span>
        </h2>

        <!-- Subtitle -->
        <p class="guarantee-desc">
            <?php esc_html_e( 'We want the cheat sheet to help you study. If it does not, you get your money back. No long forms.', 'drive' ); ?>
        </p>

        <!-- 3-Step Pill Bar -->
        <div class="guarantee-steps-pill" role="list">
            
            <div class="guarantee-step-item" role="listitem">
                <span class="step-num-circle">1</span>
                <span class="step-label"><?php esc_html_e( 'Buy your cheat sheet', 'drive' ); ?></span>
            </div>

            <span class="step-arrow-sep" aria-hidden="true">→</span>

            <div class="guarantee-step-item" role="listitem">
                <span class="step-num-circle">2</span>
                <span class="step-label"><?php esc_html_e( 'Study with it', 'drive' ); ?></span>
            </div>

            <span class="step-arrow-sep" aria-hidden="true">→</span>

            <div class="guarantee-step-item" role="listitem">
                <span class="step-num-circle">3</span>
                <span class="step-label">
                    <?php 
                    printf(
                        /* translators: %s: Days */
                        esc_html__( 'Not happy? Email us within [%s] days', 'drive' ),
                        esc_html( $guarantee_days )
                    ); 
                    ?>
                </span>
            </div>

        </div><!-- .guarantee-steps-pill -->

        <!-- Bottom Policy Link -->
        <a href="<?php echo esc_url( $refund_url ); ?>" class="guarantee-policy-link">
            <span><?php esc_html_e( 'Read the refund policy', 'drive' ); ?></span>
            <span class="policy-arrow" aria-hidden="true">→</span>
        </a>

    </div><!-- .cheat-guarantee-container -->
</section>

