<?php
/**
 * Template Name: Contact Page
 *
 * Dedicated Contact Us Page matching the theme's design language:
 * - Clean hero section with eyebrow badge, title, and intro
 * - 2-column contact interface:
 *   - Left: Direct contact cards (Email, Instant Support, Guarantee/Refund inquiries, FAQ link)
 *   - Right: Modern high-converting contact card with validation and AJAX submission
 * - Quick resolution FAQ / Trust strip
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$admin_email   = get_option( 'admin_email' );
$contact_nonce = wp_create_nonce( 'drive_contact_nonce' );
?>

<main id="primary" class="site-main contact-page-main" role="main">

    <!-- Contact Page Hero -->
    <section class="contact-hero-section" aria-labelledby="contact-hero-title">
        <div class="site-container contact-hero-container">
            <div class="contact-hero-badge">
                <span class="badge-dot" aria-hidden="true"></span>
                <span><?php esc_html_e( 'SUPPORT & INQUIRIES', 'drive' ); ?></span>
            </div>
            <h1 id="contact-hero-title" class="contact-hero-title">
                <?php esc_html_e( "We're here to help you pass.", 'drive' ); ?>
            </h1>
            <p class="contact-hero-lead">
                <?php esc_html_e( 'Have a question about your DMV permit test cheat sheet, order download, or need help studying? Reach out and our team will get back to you promptly.', 'drive' ); ?>
            </p>
        </div>
    </section>

    <!-- Main Contact Layout (2-Column Grid) -->
    <section class="contact-content-section" aria-label="<?php esc_attr_e( 'Contact Information and Form', 'drive' ); ?>">
        <div class="site-container contact-grid-container">

            <!-- Left Column: Support Cards & Direct Info -->
            <div class="contact-info-col">
                
                <!-- Email Support Card -->
                <div class="contact-info-card">
                    <div class="contact-card-icon-box" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="3"/>
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                    </div>
                    <div class="contact-card-body">
                        <span class="contact-card-label"><?php esc_html_e( 'EMAIL US DIRECTLY', 'drive' ); ?></span>
                        <h2 class="contact-card-heading"><?php esc_html_e( 'Fast Email Support', 'drive' ); ?></h2>
                        <p class="contact-card-text">
                            <?php esc_html_e( 'Our dedicated support team replies to all inquiries within 24 hours on business days.', 'drive' ); ?>
                        </p>
                        <a href="mailto:<?php echo esc_attr( $admin_email ); ?>" class="contact-card-link">
                            <span><?php echo esc_html( $admin_email ); ?></span>
                            <span class="link-arrow" aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

                <!-- Guarantee & Orders Card -->
                <div class="contact-info-card">
                    <div class="contact-card-icon-box" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <polyline points="9 12 11 14 15 10"/>
                        </svg>
                    </div>
                    <div class="contact-card-body">
                        <span class="contact-card-label"><?php esc_html_e( 'ORDERS & REFUNDS', 'drive' ); ?></span>
                        <h2 class="contact-card-heading"><?php esc_html_e( '30-Day Guarantee', 'drive' ); ?></h2>
                        <p class="contact-card-text">
                            <?php esc_html_e( 'Need help accessing your PDF download or requesting our money-back guarantee? Simply mention your order email.', 'drive' ); ?>
                        </p>
                    </div>
                </div>

                <!-- Instant FAQ Card -->
                <div class="contact-info-card faq-promo-card">
                    <div class="contact-card-icon-box" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/>
                            <line x1="12" y1="17" x2="12.01" y2="17"/>
                        </svg>
                    </div>
                    <div class="contact-card-body">
                        <span class="contact-card-label"><?php esc_html_e( 'QUICK ANSWERS', 'drive' ); ?></span>
                        <h2 class="contact-card-heading"><?php esc_html_e( 'Frequently Asked Questions', 'drive' ); ?></h2>
                        <p class="contact-card-text">
                            <?php esc_html_e( 'Find instant answers regarding permit tests, printable cheat sheets, and DMV handbook sources.', 'drive' ); ?>
                        </p>
                        <a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>" class="contact-card-link">
                            <span><?php esc_html_e( 'Visit the FAQ section', 'drive' ); ?></span>
                            <span class="link-arrow" aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

            </div><!-- .contact-info-col -->

            <!-- Right Column: Interactive Contact Form Card -->
            <div class="contact-form-col">
                <div class="contact-form-card">
                    
                    <div class="contact-form-header">
                        <h2 class="contact-form-title"><?php esc_html_e( 'Send us a message', 'drive' ); ?></h2>
                        <p class="contact-form-desc">
                            <?php esc_html_e( 'Fill out the form below and we will get back to you as soon as possible.', 'drive' ); ?>
                        </p>
                    </div>

                    <form id="driveContactForm" class="drive-contact-form" novalidate>
                        
                        <!-- Anti-spam Honeypot (hidden from genuine users) -->
                        <div class="form-hp" style="display:none;" aria-hidden="true">
                            <input type="text" name="contact_hp" tabindex="-1" autocomplete="off" />
                        </div>

                        <input type="hidden" name="action" value="drive_submit_contact" />
                        <input type="hidden" name="nonce" value="<?php echo esc_attr( $contact_nonce ); ?>" />

                        <!-- Name field -->
                        <div class="form-group">
                            <label for="contact_name" class="form-label">
                                <?php esc_html_e( 'Your Name', 'drive' ); ?> <span class="required" aria-hidden="true">*</span>
                            </label>
                            <input type="text" 
                                   id="contact_name" 
                                   name="name" 
                                   class="form-control" 
                                   placeholder="<?php esc_attr_e( 'e.g. Alex Johnson', 'drive' ); ?>" 
                                   required />
                            <span class="form-error-msg" id="name_error"></span>
                        </div>

                        <!-- Email field -->
                        <div class="form-group">
                            <label for="contact_email" class="form-label">
                                <?php esc_html_e( 'Email Address', 'drive' ); ?> <span class="required" aria-hidden="true">*</span>
                            </label>
                            <input type="email" 
                                   id="contact_email" 
                                   name="email" 
                                   class="form-control" 
                                   placeholder="<?php esc_attr_e( 'e.g. alex@example.com', 'drive' ); ?>" 
                                   required />
                            <span class="form-error-msg" id="email_error"></span>
                        </div>

                        <!-- Inquiry Subject / Topic -->
                        <div class="form-group">
                            <label for="contact_subject" class="form-label">
                                <?php esc_html_e( 'Topic / Subject', 'drive' ); ?>
                            </label>
                            <select id="contact_subject" name="subject" class="form-control form-select">
                                <option value="Cheat Sheet Order Inquiries"><?php esc_html_e( 'Cheat Sheet Order / Download Support', 'drive' ); ?></option>
                                <option value="30-Day Money Back Guarantee"><?php esc_html_e( '30-Day Guarantee / Refund Request', 'drive' ); ?></option>
                                <option value="DMV Test Questions Question"><?php esc_html_e( 'Question about Practice Tests or Questions', 'drive' ); ?></option>
                                <option value="General Inquiry"><?php esc_html_e( 'General Feedback or Other', 'drive' ); ?></option>
                            </select>
                        </div>

                        <!-- Message textarea -->
                        <div class="form-group">
                            <label for="contact_message" class="form-label">
                                <?php esc_html_e( 'Message', 'drive' ); ?> <span class="required" aria-hidden="true">*</span>
                            </label>
                            <textarea id="contact_message" 
                                      name="message" 
                                      rows="5" 
                                      class="form-control form-textarea" 
                                      placeholder="<?php esc_attr_e( 'How can we help you?', 'drive' ); ?>" 
                                      required></textarea>
                            <span class="form-error-msg" id="message_error"></span>
                        </div>

                        <!-- Submit CTA Button -->
                        <button type="submit" id="contactSubmitBtn" class="btn btn-primary contact-submit-btn">
                            <span class="btn-text"><?php esc_html_e( 'Send Message', 'drive' ); ?></span>
                            <span class="btn-arrow" aria-hidden="true">→</span>
                            <span class="btn-spinner" aria-hidden="true"></span>
                        </button>

                        <!-- Response Notice Banner -->
                        <div id="contactFormNotice" class="contact-form-notice" role="alert" style="display: none;"></div>

                    </form>

                </div><!-- .contact-form-card -->
            </div><!-- .contact-form-col -->

        </div><!-- .contact-grid-container -->
    </section>

</main><!-- #primary -->

<?php
get_footer();

