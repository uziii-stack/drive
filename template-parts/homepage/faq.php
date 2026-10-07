<?php
/**
 * Template part for displaying the Homepage FAQ Section
 *
 * Replicates the 2-column FAQ layout matching design:
 * - Left: "FAQ" teal category tag, bold headline, subtitle, and dark "Still have a question?" contact card
 * - Right: Accordion list with item 1 active/expanded by default (teal border & glow), plus/close icons, and smooth toggle
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section id="faq" class="homepage-section faq-section" aria-labelledby="faq-heading">
    <div class="site-container faq-container">
        
        <div class="faq-split-grid">
            
            <!-- Left Column: Headline, Subtitle & Dark Contact Card -->
            <div class="faq-left-col">
                
                <!-- Category Tag -->
                <span class="faq-category-tag"><?php esc_html_e( 'FAQ', 'drive' ); ?></span>

                <!-- Main Section Title -->
                <h2 id="faq-heading" class="faq-main-title">
                    <?php esc_html_e( 'Frequently Asked', 'drive' ); ?><br>
                    <?php esc_html_e( 'Questions', 'drive' ); ?>
                </h2>

                <!-- Subtitle -->
                <p class="faq-subtitle">
                    <?php esc_html_e( 'Quick answers about how the site works, what is free and how we keep things state-specific.', 'drive' ); ?>
                </p>

                <!-- Dark Contact Callout Card -->
                <div class="faq-contact-card">
                    <h3 class="contact-card-title"><?php esc_html_e( 'Still have a question?', 'drive' ); ?></h3>
                    <p class="contact-card-desc"><?php esc_html_e( 'Send us a message and we will get back to you.', 'drive' ); ?></p>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-contact-white" id="btn-faq-contact">
                        <span class="btn-label"><?php esc_html_e( 'Contact us', 'drive' ); ?></span>
                        <span class="btn-arrow" aria-hidden="true">→</span>
                    </a>
                </div>

            </div><!-- .faq-left-col -->


            <!-- Right Column: Accordion List -->
            <div class="faq-right-col">
                <div class="faq-accordion-list" id="faqAccordionList">
                    
                    <!-- FAQ Item 1 (Active by Default) -->
                    <div class="faq-accordion-item is-active" id="faq-item-1">
                        <button type="button" 
                                class="faq-question-btn" 
                                aria-expanded="true" 
                                aria-controls="faq-ans-1"
                                id="faq-btn-1">
                            <span class="faq-question-text"><?php esc_html_e( 'Is DMV Learners Permit Test affiliated with the DMV?', 'drive' ); ?></span>
                            <span class="faq-toggle-icon" aria-hidden="true">
                                <span class="icon-line line-h"></span>
                                <span class="icon-line line-v"></span>
                            </span>
                        </button>
                        <div class="faq-answer-collapse" id="faq-ans-1" role="region" aria-labelledby="faq-btn-1">
                            <div class="faq-answer-body">
                                <p><?php esc_html_e( 'No. We are an independent educational test-prep resource created to help students study the official state driver handbooks and pass their permit exams. We are not affiliated with or endorsed by any state DMV agency.', 'drive' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="faq-accordion-item" id="faq-item-2">
                        <button type="button" 
                                class="faq-question-btn" 
                                aria-expanded="false" 
                                aria-controls="faq-ans-2"
                                id="faq-btn-2">
                            <span class="faq-question-text"><?php esc_html_e( 'Are the questions specific to my state?', 'drive' ); ?></span>
                            <span class="faq-toggle-icon" aria-hidden="true">
                                <span class="icon-line line-h"></span>
                                <span class="icon-line line-v"></span>
                            </span>
                        </button>
                        <div class="faq-answer-collapse" id="faq-ans-2" role="region" aria-labelledby="faq-btn-2">
                            <div class="faq-answer-body">
                                <p><?php esc_html_e( "Yes. Traffic rules, speed limits, legal blood alcohol limits, and fines vary across states. Every test, mock exam, and cheat sheet is tailored specifically to your state's official driving manual.", 'drive' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="faq-accordion-item" id="faq-item-3">
                        <button type="button" 
                                class="faq-question-btn" 
                                aria-expanded="false" 
                                aria-controls="faq-ans-3"
                                id="faq-btn-3">
                            <span class="faq-question-text"><?php esc_html_e( 'Is it free to use?', 'drive' ); ?></span>
                            <span class="faq-toggle-icon" aria-hidden="true">
                                <span class="icon-line line-h"></span>
                                <span class="icon-line line-v"></span>
                            </span>
                        </button>
                        <div class="faq-answer-collapse" id="faq-ans-3" role="region" aria-labelledby="faq-btn-3">
                            <div class="faq-answer-body">
                                <p><?php esc_html_e( 'Yes, all topic practice questions, timed mock tests, and printable cheat sheets are 100% free to access without hidden fees.', 'drive' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="faq-accordion-item" id="faq-item-4">
                        <button type="button" 
                                class="faq-question-btn" 
                                aria-expanded="false" 
                                aria-controls="faq-ans-4"
                                id="faq-btn-4">
                            <span class="faq-question-text"><?php esc_html_e( 'Do I need to create an account?', 'drive' ); ?></span>
                            <span class="faq-toggle-icon" aria-hidden="true">
                                <span class="icon-line line-h"></span>
                                <span class="icon-line line-v"></span>
                            </span>
                        </button>
                        <div class="faq-answer-collapse" id="faq-ans-4" role="region" aria-labelledby="faq-btn-4">
                            <div class="faq-answer-body">
                                <p><?php esc_html_e( 'No sign-up or registration is required. You can choose your state and vehicle type and begin practicing immediately.', 'drive' ); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="faq-accordion-item" id="faq-item-5">
                        <button type="button" 
                                class="faq-question-btn" 
                                aria-expanded="false" 
                                aria-controls="faq-ans-5"
                                id="faq-btn-5">
                            <span class="faq-question-text"><?php esc_html_e( 'What is the difference between a practice test and a mock test?', 'drive' ); ?></span>
                            <span class="faq-toggle-icon" aria-hidden="true">
                                <span class="icon-line line-h"></span>
                                <span class="icon-line line-v"></span>
                            </span>
                        </button>
                        <div class="faq-answer-collapse" id="faq-ans-5" role="region" aria-labelledby="faq-btn-5">
                            <div class="faq-answer-body">
                                <p><?php esc_html_e( 'Topic practice tests let you study specific subjects at your own pace with instant answer feedback. Mock tests are full-length timed simulations formatted with passing score thresholds matching the official state exam.', 'drive' ); ?></p>
                            </div>
                        </div>
                    </div>

                </div><!-- .faq-accordion-list -->
            </div><!-- .faq-right-col -->

        </div><!-- .faq-split-grid -->

    </div><!-- .site-container -->
</section><!-- #faq -->
