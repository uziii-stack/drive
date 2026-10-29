<?php
/**
 * FAQ Accordion Section Template Part
 *
 * Section ID: #faq
 *
 * Implements the FAQ accordion matching the screenshot:
 * - Eyebrow: "FAQ" (Teal uppercase)
 * - Heading: "Good questions, quick answers" (Charcoal #2B2D42)
 * - Accordion items:
 *   - Closed items: Light grey pill box (#F4F5F7), charcoal text, dark circular button with plus (+) icon
 *   - Open item (Item 1 by default): White background, crisp teal border (#00B4A6), teal circular button with cross/close (×) icon, clean body paragraph with dynamic state name.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Current context
$current_state_slug = get_query_var( 'drive_state' );
$current_vehicle    = get_query_var( 'drive_vehicle' );

if ( empty( $current_state_slug ) ) {
    $current_state_slug = 'california';
}
if ( empty( $current_vehicle ) ) {
    $current_vehicle = 'car';
}

$all_states         = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$current_state_name = 'California';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_name = $data['name'];
        break;
    }
}

$guarantee_days = '30';
$current_year   = date( 'Y' );

// 5 Questions matching screenshot
$faq_items = array(
    array(
        'q' => __( 'Is this an official DMV document?', 'drive' ),
        'a' => sprintf(
            /* translators: 1: State name, 2: State name */
            __( 'No. It is an independent study guide built from the official %1$s driver handbook. We are not affiliated with the %2$s DMV or any government agency.', 'drive' ),
            $current_state_name,
            $current_state_name
        ),
        'is_open' => true,
    ),
    array(
        'q' => __( 'How do I get my cheat sheet?', 'drive' ),
        'a' => __( 'Right after completing checkout, you will receive an instant download link on screen and via email to save the PDF directly to your device.', 'drive' ),
        'is_open' => false,
    ),
    array(
        'q' => __( 'Can I use it on my phone?', 'drive' ),
        'a' => __( 'Yes! The cheat sheet is formatted as an ultra-clear, mobile-friendly PDF that reads perfectly on your iPhone, Android, tablet, laptop, or desktop. You can also print it out on standard US Letter or A4 paper.', 'drive' ),
        'is_open' => false,
    ),
    array(
        'q' => __( 'How does the money–back guarantee work?', 'drive' ),
        'a' => sprintf(
            /* translators: %s: Days */
            __( 'If you are not satisfied for any reason, simply email us within %s days of purchase and we will issue a full refund immediately—no questions asked.', 'drive' ),
            $guarantee_days
        ),
        'is_open' => false,
    ),
    array(
        'q' => __( 'Which handbook edition is it based on?', 'drive' ),
        'a' => sprintf(
            /* translators: 1: Year, 2: State name */
            __( 'It is verified and updated for the latest %1$s edition of the official %2$s driver manual and driving statutes.', 'drive' ),
            $current_year,
            $current_state_name
        ),
        'is_open' => false,
    ),
);
?>

<section id="faq" class="cheat-faq-section" aria-labelledby="faq-heading">
    <div class="site-container cheat-faq-container">
        
        <!-- Header -->
        <div class="faq-header">
            <span class="faq-eyebrow"><?php esc_html_e( 'FAQ', 'drive' ); ?></span>
            <h2 id="faq-heading" class="faq-title"><?php esc_html_e( 'Good questions, quick answers', 'drive' ); ?></h2>
        </div>

        <!-- Accordion List (Using exact homepage FAQ card markup) -->
        <div class="faq-accordion-list faq-accordion" id="faqAccordion">
            <?php foreach ( $faq_items as $index => $item ) : 
                $item_id   = 'faq-item-' . $index;
                $button_id = 'faq-btn-' . $index;
                $panel_id  = 'faq-ans-' . $index;
                $is_open   = ! empty( $item['is_open'] );
            ?>
                <div class="faq-accordion-item faq-item <?php echo $is_open ? 'is-active is-open' : ''; ?>" id="<?php echo esc_attr( $item_id ); ?>">
                    <button type="button" 
                            class="faq-question-btn" 
                            id="<?php echo esc_attr( $button_id ); ?>" 
                            aria-expanded="<?php echo $is_open ? 'true' : 'false'; ?>" 
                            aria-controls="<?php echo esc_attr( $panel_id ); ?>">
                        <span class="faq-question-text faq-q-text"><?php echo esc_html( $item['q'] ); ?></span>
                        <span class="faq-toggle-icon" aria-hidden="true">
                            <span class="icon-line line-h"></span>
                            <span class="icon-line line-v"></span>
                        </span>
                    </button>

                    <div class="faq-answer-collapse faq-answer-panel" 
                         id="<?php echo esc_attr( $panel_id ); ?>" 
                         role="region" 
                         aria-labelledby="<?php echo esc_attr( $button_id ); ?>"
                         <?php echo $is_open ? '' : 'hidden'; ?>>
                        <div class="faq-answer-body faq-answer-inner">
                            <p><?php echo esc_html( $item['a'] ); ?></p>
                        </div>
                    </div>
                </div><!-- .faq-accordion-item -->
            <?php endforeach; ?>
        </div><!-- .faq-accordion-list -->

    </div><!-- .cheat-faq-container -->
</section>

