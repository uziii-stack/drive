<?php
/**
 * Template part for displaying the State FAQ Section
 *
 * Implements the 2-column FAQ layout matching the reference screenshot:
 * - Left Column:
 *   - Eyebrow: "FAQ" (Teal uppercase)
 *   - Heading: "[State] permit test questions" (Dynamic state name)
 *   - Description: "Can't find your answer? The official handbook has the full rules."
 *   - Teal-underlined link with arrow: "Read the official handbook →"
 * - Right Column:
 *   - Accordion cards with item 1 active by default (teal active border, teal circular close/x button)
 *   - Inactive items have a dark circular plus button (+)
 *   - Smooth expand/collapse matching main.js initFaqAccordion()
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$all_states = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();

// Determine state context
$current_state_slug = 'california';
if ( get_query_var( 'drive_state' ) ) {
    $current_state_slug = sanitize_title( get_query_var( 'drive_state' ) );
} elseif ( isset( $_GET['state'] ) && ! empty( $_GET['state'] ) ) {
    $req_state = sanitize_title( wp_unslash( $_GET['state'] ) );
    foreach ( $all_states as $code => $data ) {
        if ( $data['slug'] === $req_state || strtolower( $code ) === strtolower( $req_state ) ) {
            $current_state_slug = $data['slug'];
            break;
        }
    }
}

// Find state name
$current_state_name = 'California';
foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_state_name = $data['name'];
        break;
    }
}

// State-specific FAQ items matching the reference screenshot exactly
$faq_items = array(
    array(
        'q' => sprintf( __( 'What score do I need to pass the %s permit test?', 'drive' ), $current_state_name ),
        'a' => sprintf( __( 'You need a passing score of 80%% on the knowledge test. You get three attempts per application. If you are under 18 and fail, you must wait seven days before you retake it.', 'drive' ) ),
    ),
    array(
        'q' => sprintf( __( 'How much does a %s permit cost?', 'drive' ), $current_state_name ),
        'a' => sprintf( __( 'The standard application fee for a %s driver license or instruction permit is typically between $35 and $45 depending on your local DMV office and application type.', 'drive' ), $current_state_name ),
    ),
    array(
        'q' => sprintf( __( 'How old do I need to be to get a permit in %s?', 'drive' ), $current_state_name ),
        'a' => sprintf( __( 'In %s, you can apply for a provisional instruction permit once you turn 15½, provided you have completed or are enrolled in an approved driver education course.', 'drive' ), $current_state_name ),
    ),
    array(
        'q' => __( 'Is the cheat sheet the same as the official handbook?', 'drive' ),
        'a' => sprintf( __( 'No. The official %s driver handbook is over 100 pages. Our cheat sheet condenses the essential rules, road signs, fines, and high-frequency test questions into a printable summary you can study in 20 minutes.', 'drive' ), $current_state_name ),
    ),
);
?>

<section id="state-faq" class="state-faq-section" aria-labelledby="state-faq-heading">
    <div class="site-container state-faq-container">
        
        <div class="state-faq-split-grid">
            
            <!-- Left Column: Copy & Handbook Link -->
            <div class="state-faq-left-col">
                <span class="state-faq-eyebrow"><?php esc_html_e( 'FAQ', 'drive' ); ?></span>
                
                <h2 id="state-faq-heading" class="state-faq-title">
                    <?php 
                    printf(
                        /* translators: %s: State name */
                        esc_html__( '%s permit test questions', 'drive' ),
                        esc_html( $current_state_name )
                    ); 
                    ?>
                </h2>

                <p class="state-faq-desc">
                    <?php esc_html_e( "Can't find your answer? The official handbook has the full rules.", 'drive' ); ?>
                </p>

                <div class="state-faq-handbook-wrap desktop-handbook-wrap">
                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/car-practice-test/' ) ); ?>" class="state-faq-handbook-link">
                        <span><?php esc_html_e( 'Read the official handbook', 'drive' ); ?></span>
                        <span class="handbook-arrow" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 10h12M11 5l5 5-5 5"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div><!-- .state-faq-left-col -->

            <!-- Right Column: Accordion List -->
            <div class="state-faq-right-col">
                <div class="faq-accordion-list" id="stateFaqAccordionList">
                    
                    <?php foreach ( $faq_items as $index => $item ) : 
                        $item_num   = $index + 1;
                        $is_active  = ( 0 === $index ); // First item open by default matching screenshot
                    ?>
                        <div class="faq-accordion-item <?php echo $is_active ? 'is-active' : ''; ?>" id="state-faq-item-<?php echo esc_attr( $item_num ); ?>">
                            
                            <button type="button" 
                                    class="faq-question-btn" 
                                    aria-expanded="<?php echo $is_active ? 'true' : 'false'; ?>" 
                                    aria-controls="state-faq-ans-<?php echo esc_attr( $item_num ); ?>"
                                    id="state-faq-btn-<?php echo esc_attr( $item_num ); ?>">
                                
                                <span class="faq-question-text"><?php echo esc_html( $item['q'] ); ?></span>
                                
                                <span class="faq-toggle-icon" aria-hidden="true">
                                    <span class="icon-line line-h"></span>
                                    <span class="icon-line line-v"></span>
                                </span>
                            </button>

                            <div class="faq-answer-collapse" 
                                 id="state-faq-ans-<?php echo esc_attr( $item_num ); ?>" 
                                 role="region" 
                                 aria-labelledby="state-faq-btn-<?php echo esc_attr( $item_num ); ?>">
                                <div class="faq-answer-body">
                                    <p><?php echo esc_html( $item['a'] ); ?></p>
                                </div>
                            </div>

                        </div><!-- .faq-accordion-item -->
                    <?php endforeach; ?>

                </div><!-- .faq-accordion-list -->

                <!-- Mobile Handbook Link (Rendered below accordion on mobile matching screenshot) -->
                <div class="state-faq-handbook-wrap mobile-handbook-wrap">
                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/car-practice-test/' ) ); ?>" class="state-faq-handbook-link">
                        <span><?php esc_html_e( 'Read the official handbook', 'drive' ); ?></span>
                        <span class="handbook-arrow" aria-hidden="true">
                            <svg width="15" height="15" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 10h12M11 5l5 5-5 5"/>
                            </svg>
                        </span>
                    </a>
                </div>

            </div><!-- .state-faq-right-col -->

        </div><!-- .state-faq-split-grid -->

    </div><!-- .site-container -->
</section><!-- #state-faq -->
