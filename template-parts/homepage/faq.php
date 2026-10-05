<?php
/**
 * Template part for displaying the Homepage FAQ section placeholder
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="faq" class="homepage-section homepage-faq" aria-labelledby="faq-heading">
    <div class="site-container">
        <div class="section-header">
            <h2 id="faq-heading" class="section-title">
                <?php esc_html_e( 'Frequently Asked Questions', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Find quick answers to common questions about permit tests, state requirements, and study guides.', 'drive' ); ?>
            </p>
        </div>

        <div class="faq-accordion-placeholder">
            <div class="faq-item">
                <h3 class="faq-question"><?php esc_html_e( 'Are these practice tests state-specific?', 'drive' ); ?></h3>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'Yes. Every state\'s driving manual is unique with varying road rules, legal limits, and fines. Our tests are tailored specifically to each of the 40 supported states.', 'drive' ); ?></p>
                </div>
            </div>

            <div class="faq-item">
                <h3 class="faq-question"><?php esc_html_e( 'What vehicle types do you cover?', 'drive' ); ?></h3>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'We provide targeted practice questions and cheat sheets for Car permits (Class D/C), Commercial Driver License permits (CDL Truck / Class A/B/C), and Motorcycle permits (Class M).', 'drive' ); ?></p>
                </div>
            </div>

            <div class="faq-item">
                <h3 class="faq-question"><?php esc_html_e( 'How are cheat sheets different from practice tests?', 'drive' ); ?></h3>
                <div class="faq-answer">
                    <p><?php esc_html_e( 'Cheat sheets condense the entire state handbook into essential high-yield facts, numbers, speed limits, alcohol limits, and road signs for fast last-minute revision.', 'drive' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
