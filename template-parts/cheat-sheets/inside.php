<?php
/**
 * What's Inside Bento Grid Section Template Part
 *
 * Section ID: #inside
 *
 * Implements the Bento Grid matching client design:
 * - Header:
 *   - Eyebrow: "WHAT'S INSIDE" (teal uppercase)
 *   - Title: "Everything you need, nothing you don't"
 *   - Right subtext: "Every question comes with the answer and a short explanation, grouped by topic."
 * - Bento Grid:
 *   1. Featured Dark Tile (Spans 2x2):
 *      - Eyebrow: "THE CORE"
 *      - Giant number: 150 (Car/Motorcycle) or 250 (Truck/CDL) in orange #F26419
 *      - Title: "must-know questions with answers and explanations"
 *      - Subtle circular dashed arc accent graphic in background
 *   2. White Tile: "Road signs" (Icon, title, desc: Shapes, colors and meanings of the signs you will see on the test.)
 *   3. White Tile: "Right-of-way" (Icon, title, desc: Who goes first at intersections, crosswalks and stops.)
 *   4. White Tile: "Speed & lanes" (Icon, title, desc: Speed limits, lane markings, turns and passing.)
 *   5. White Tile: "Safe driving" (Icon, title, desc: Following distance, night and weather driving, sharing the road.)
 *   6. White Tile (Bottom-Left): "Alcohol & points" (or CDL Endorsements)
 *   7. Wide Dark Tile (Bottom-Right): "Every road sign, explained" with outline sign shapes on the right (Octagon, Triangle, Diamond, Circle, Square).
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$current_vehicle = get_query_var( 'drive_vehicle' );
$vehicle_key     = strtolower( trim( (string) $current_vehicle ) );
if ( 'truck' === $vehicle_key ) {
    $vehicle_key = 'cdl';
}

$question_count = ( 'cdl' === $vehicle_key ) ? '250' : '150';

// Dynamic last tile based on vehicle
$last_tile_title = __( 'Alcohol & points', 'drive' );
$last_tile_desc  = __( 'DUI rules, demerit points and what can affect your license.', 'drive' );
$last_tile_icon  = 'shield';

if ( 'cdl' === $vehicle_key ) {
    $last_tile_title = __( 'CDL endorsements', 'drive' );
    $last_tile_desc  = __( 'Air brakes, combination vehicles, tank vehicles and hazardous materials rules.', 'drive' );
    $last_tile_icon  = 'truck';
}
?>

<section id="inside" class="cheat-inside-section" aria-labelledby="inside-heading">
    <div class="site-container cheat-inside-container">
        
        <!-- Section Header -->
        <div class="inside-header-row">
            <div class="inside-header-left">
                <span class="inside-eyebrow"><?php esc_html_e( "WHAT'S INSIDE", 'drive' ); ?></span>
                <h2 id="inside-heading" class="inside-title">
                    <?php esc_html_e( 'Everything you need, nothing you don’t', 'drive' ); ?>
                </h2>
            </div>
            <div class="inside-header-right">
                <p class="inside-header-lead">
                    <?php esc_html_e( 'Every question comes with the answer and a short explanation, grouped by topic.', 'drive' ); ?>
                </p>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="inside-bento-grid">
            
            <!-- 1. The Core Featured Dark Tile (Spans 2 columns & 2 rows on desktop) -->
            <div class="bento-tile bento-tile-core">
                <div class="core-dashed-arc" aria-hidden="true"></div>
                <div class="core-inner-content">
                    <span class="core-eyebrow"><?php esc_html_e( 'THE CORE', 'drive' ); ?></span>
                    <div class="core-big-number"><?php echo esc_html( $question_count ); ?></div>
                    <h3 class="core-title">
                        <?php esc_html_e( 'must-know questions with answers and explanations', 'drive' ); ?>
                    </h3>
                </div>
            </div>

            <!-- 2. Road Signs -->
            <div class="bento-tile bento-tile-white">
                <div class="tile-icon-badge" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </div>
                <div class="tile-text-content">
                    <h3 class="tile-title"><?php esc_html_e( 'Road signs', 'drive' ); ?></h3>
                    <p class="tile-desc"><?php esc_html_e( 'Shapes, colors and meanings of the signs you will see on the test.', 'drive' ); ?></p>
                </div>
            </div>

            <!-- 3. Right-of-way (Map / 3-fold pamphlet icon) -->
            <div class="bento-tile bento-tile-white">
                <div class="tile-icon-badge" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/>
                        <line x1="8" y1="2" x2="8" y2="18"/>
                        <line x1="16" y1="6" x2="16" y2="22"/>
                    </svg>
                </div>
                <div class="tile-text-content">
                    <h3 class="tile-title"><?php esc_html_e( 'Right-of-way', 'drive' ); ?></h3>
                    <p class="tile-desc"><?php esc_html_e( 'Who goes first at intersections, crosswalks and stops.', 'drive' ); ?></p>
                </div>
            </div>

            <!-- 4. Speed & lanes (Car front icon) -->
            <div class="bento-tile bento-tile-white">
                <div class="tile-icon-badge" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                        <circle cx="7" cy="15" r="1.5" fill="currentColor"/>
                        <circle cx="17" cy="15" r="1.5" fill="currentColor"/>
                    </svg>
                </div>
                <div class="tile-text-content">
                    <h3 class="tile-title"><?php esc_html_e( 'Speed & lanes', 'drive' ); ?></h3>
                    <p class="tile-desc"><?php esc_html_e( 'Speed limits, lane markings, turns and passing.', 'drive' ); ?></p>
                </div>
            </div>

            <!-- 5. Safe driving (Shield with checkmark) -->
            <div class="bento-tile bento-tile-white">
                <div class="tile-icon-badge" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <polyline points="9 12 11 14 15 10"/>
                    </svg>
                </div>
                <div class="tile-text-content">
                    <h3 class="tile-title"><?php esc_html_e( 'Safe driving', 'drive' ); ?></h3>
                    <p class="tile-desc"><?php esc_html_e( 'Following distance, night and weather driving, sharing the road.', 'drive' ); ?></p>
                </div>
            </div>

            <!-- 6. Alcohol & points (Shield with exclamation mark) -->
            <div class="bento-tile bento-tile-white bento-tile-bottom-left">
                <div class="tile-icon-badge" aria-hidden="true">
                    <?php if ( 'cdl' === $vehicle_key ) : ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 4h12v12H2z"/>
                            <path d="M14 9h4l3 3v4h-7V9z"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/>
                            <circle cx="18.5" cy="18.5" r="2.5"/>
                        </svg>
                    <?php else : ?>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <circle cx="12" cy="16" r="0.75" fill="#00B4A6"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="tile-text-content">
                    <h3 class="tile-title"><?php echo esc_html( $last_tile_title ); ?></h3>
                    <p class="tile-desc"><?php echo esc_html( $last_tile_desc ); ?></p>
                </div>
            </div>

            <!-- 7. Wide Dark Tile: Every road sign, explained (Bottom-Right) -->
            <div class="bento-tile bento-tile-wide-dark">
                <div class="wide-dark-content">
                    <h3 class="wide-dark-title"><?php esc_html_e( 'Every road sign, explained', 'drive' ); ?></h3>
                    <p class="wide-dark-desc">
                        <?php esc_html_e( 'Shapes and colors grouped together so they are easy to remember.', 'drive' ); ?>
                    </p>
                </div>
                <div class="wide-dark-shapes" aria-hidden="true">
                    <!-- Octagon (Stop sign) -->
                    <div class="sign-shape shape-octagon" title="Stop sign shape"></div>
                    <!-- Triangle (Yield / Warning) -->
                    <div class="sign-shape shape-triangle" title="Warning triangle"></div>
                    <!-- Diamond (Warning / Caution) -->
                    <div class="sign-shape shape-diamond" title="Diamond warning"></div>
                    <!-- Circle (Railroad / Speed) -->
                    <div class="sign-shape shape-circle" title="Circular regulation"></div>
                    <!-- Square / Rectangle (Regulatory / Guide) -->
                    <div class="sign-shape shape-square" title="Regulatory square"></div>
                </div>
            </div>

        </div><!-- .inside-bento-grid -->

    </div><!-- .cheat-inside-container -->
</section>

