<?php
/**
 * Take a Look Inside Carousel Section Template Part
 *
 * Section ID: #look
 *
 * Implements the 3-page interactive carousel matching the screenshot:
 * - Eyebrow: "TAKE A LOOK INSIDE"
 * - Title: "Flip through a few pages"
 * - Carousel Stage:
 *   - Page 1 (Left tilted -6deg, scale 0.88): "ROAD SIGNS" (Signs preview grid: Octagon, Triangle, Diamond, Circle, Square, Pentagon house)
 *   - Page 2 (Center active, scale 1.0, shadow): "QUESTIONS & ANSWERS" (Q1. What does an eight-sided sign mean? Stop completely, then go when it is safe. + Q2, Q3, Q4)
 *   - Page 3 (Right tilted +6deg, scale 0.88): "RIGHT-OF-WAY" (Intersection aerial schematic diagram with road lanes, car, and turn arrow)
 * - Navigation Controls:
 *   - Prev arrow circle button (<)
 *   - Current active page label: "Questions & answers"
 *   - Dots indicator (3 dots, active is elongated teal pill)
 *   - Next arrow circle button (>)
 * - Bottom note: "Sample layout. Final pages may look slightly different."
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$current_state_slug = get_query_var( 'drive_state' );
if ( empty( $current_state_slug ) ) {
    $current_state_slug = 'california';
}

$all_states         = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$current_state_code = 'CA';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_code = strtoupper( $code );
        break;
    }
}

$current_vehicle = get_query_var( 'drive_vehicle' );
$vehicle_key     = strtolower( trim( (string) $current_vehicle ) );
$vehicle_label   = ( 'cdl' === $vehicle_key || 'truck' === $vehicle_key ) ? 'CDL' : ( ( 'motorcycle' === $vehicle_key ) ? 'MOTO' : 'CAR' );
$badge_text      = $current_state_code . ' · ' . $vehicle_label;
?>

<section id="look" class="cheat-look-section" aria-labelledby="look-heading">
    <div class="site-container cheat-look-container">
        
        <!-- Header -->
        <div class="look-header">
            <span class="look-eyebrow"><?php esc_html_e( 'TAKE A LOOK INSIDE', 'drive' ); ?></span>
            <h2 id="look-heading" class="look-title"><?php esc_html_e( 'Flip through a few pages', 'drive' ); ?></h2>
        </div>

        <!-- 3-Page Carousel Track Stage -->
        <div class="look-carousel-stage" id="lookCarouselStage" data-current-index="1">
            
            <!-- Page 1: ROAD SIGNS -->
            <div class="look-page-card page-road-signs" data-page-index="0" data-page-title="<?php esc_attr_e( 'Road signs', 'drive' ); ?>">
                <div class="look-card-inner">
                    <div class="look-card-header">
                        <span class="look-card-title"><?php esc_html_e( 'ROAD SIGNS', 'drive' ); ?></span>
                        <span class="look-card-badge"><?php echo esc_html( $badge_text ); ?></span>
                    </div>
                    <div class="look-card-body">
                        <!-- Sign Grid (2 columns x 3 rows) -->
                        <div class="look-signs-grid">
                            <div class="look-sign-box">
                                <div class="sign-mini-shape shape-octagon"></div>
                                <span class="sign-line w-60"></span>
                            </div>
                            <div class="look-sign-box">
                                <div class="sign-mini-shape shape-triangle"></div>
                                <span class="sign-line w-60"></span>
                            </div>
                            <div class="look-sign-box">
                                <div class="sign-mini-shape shape-diamond"></div>
                                <span class="sign-line w-60"></span>
                            </div>
                            <div class="look-sign-box">
                                <div class="sign-mini-shape shape-circle"></div>
                                <span class="sign-line w-60"></span>
                            </div>
                            <div class="look-sign-box">
                                <div class="sign-mini-shape shape-square"></div>
                                <span class="sign-line w-60"></span>
                            </div>
                            <div class="look-sign-box">
                                <div class="sign-mini-shape shape-pentagon"></div>
                                <span class="sign-line w-60"></span>
                            </div>
                        </div>
                        <div class="look-text-lines">
                            <span class="sign-line w-100"></span>
                            <span class="sign-line w-85"></span>
                            <span class="sign-line w-70"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page 2: QUESTIONS & ANSWERS (Center / Active by default) -->
            <div class="look-page-card page-questions-answers is-active" data-page-index="1" data-page-title="<?php esc_attr_e( 'Questions & answers', 'drive' ); ?>">
                <div class="look-card-inner">
                    <div class="look-card-header dark-header">
                        <span class="look-card-title"><?php esc_html_e( 'QUESTIONS & ANSWERS', 'drive' ); ?></span>
                        <span class="look-card-badge"><?php echo esc_html( $badge_text ); ?></span>
                    </div>
                    <div class="look-card-body">
                        <!-- Q1 Active Box -->
                        <div class="qa-item-box active-qa">
                            <h4 class="qa-q-title"><?php esc_html_e( 'Q1. What does an eight-sided sign mean?', 'drive' ); ?></h4>
                            <div class="qa-a-row">
                                <svg class="qa-check-icon" width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                                <span class="qa-a-text"><?php esc_html_e( 'Stop completely, then go when it is safe.', 'drive' ); ?></span>
                            </div>
                        </div>

                        <!-- Q2 Placeholder Box -->
                        <div class="qa-item-box placeholder-qa">
                            <span class="qa-num">Q2.</span>
                            <span class="sign-line w-75"></span>
                        </div>

                        <!-- Q3 Placeholder Box -->
                        <div class="qa-item-box placeholder-qa">
                            <span class="qa-num">Q3.</span>
                            <span class="sign-line w-80"></span>
                        </div>

                        <!-- Q4 Placeholder Box -->
                        <div class="qa-item-box placeholder-qa">
                            <span class="qa-num">Q4.</span>
                            <span class="sign-line w-70"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page 3: RIGHT-OF-WAY -->
            <div class="look-page-card page-right-of-way" data-page-index="2" data-page-title="<?php esc_attr_e( 'Right-of-way', 'drive' ); ?>">
                <div class="look-card-inner">
                    <div class="look-card-header">
                        <span class="look-card-title"><?php esc_html_e( 'RIGHT-OF-WAY', 'drive' ); ?></span>
                        <span class="look-card-badge"><?php echo esc_html( $badge_text ); ?></span>
                    </div>
                    <div class="look-card-body">
                        <!-- Intersection Schematic Diagram Preview -->
                        <div class="look-intersection-diagram" aria-hidden="true">
                            <div class="inter-road horizontal-road"></div>
                            <div class="inter-road vertical-road"></div>
                            <div class="inter-car main-car"></div>
                            <div class="inter-car other-car"></div>
                            <!-- Turn Arrow -->
                            <svg class="inter-turn-arrow" viewBox="0 0 40 40" fill="none">
                                <path d="M 18 32 L 18 18 Q 18 12 26 12 L 32 12" stroke="#F26419" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                                <polyline points="28 8 33 12 28 16" stroke="#F26419" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="look-text-lines">
                            <span class="sign-line w-100"></span>
                            <span class="sign-line w-90"></span>
                            <span class="sign-line w-80"></span>
                            <span class="sign-line w-65"></span>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- .look-carousel-stage -->

        <!-- Navigation Controls -->
        <div class="look-controls-wrap">
            <button type="button" class="look-arrow-btn btn-prev" id="lookPrevBtn" aria-label="<?php esc_attr_e( 'Previous page', 'drive' ); ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </button>

            <div class="look-indicator-group">
                <span class="look-current-title" id="lookCurrentTitle"><?php esc_html_e( 'Questions & answers', 'drive' ); ?></span>
                <div class="look-dots" role="tablist" aria-label="<?php esc_attr_e( 'Sample page selector', 'drive' ); ?>">
                    <button type="button" class="look-dot" data-index="0" role="tab" aria-selected="false" aria-label="<?php esc_attr_e( 'Page 1: Road signs', 'drive' ); ?>"></button>
                    <button type="button" class="look-dot is-active" data-index="1" role="tab" aria-selected="true" aria-label="<?php esc_attr_e( 'Page 2: Questions and answers', 'drive' ); ?>"></button>
                    <button type="button" class="look-dot" data-index="2" role="tab" aria-selected="false" aria-label="<?php esc_attr_e( 'Page 3: Right of way', 'drive' ); ?>"></button>
                </div>
            </div>

            <button type="button" class="look-arrow-btn btn-next" id="lookNextBtn" aria-label="<?php esc_attr_e( 'Next page', 'drive' ); ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
            </button>
        </div>

        <!-- Footnote Disclaimer -->
        <p class="look-footnote">
            <?php esc_html_e( 'Sample layout. Final pages may look slightly different.', 'drive' ); ?>
        </p>

    </div><!-- .cheat-look-container -->
</section>

