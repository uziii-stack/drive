<?php
/**
 * Template part for displaying the Interactive Choose Your State Map Section
 *
 * Implements the vector US interactive map with activity-level heat shading,
 * floating badge pins, dynamic dark popover on hover, and the activity legend.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$states_data = function_exists( 'drive_get_us_map_states' ) ? drive_get_us_map_states() : array();
?>

<section id="state-selector" class="homepage-section homepage-state-selector" aria-labelledby="state-selector-heading">
    <div class="site-container">
        
        <div class="section-header state-section-header">
            <span class="section-badge"><?php esc_html_e( 'State-Specific Practice Tests', 'drive' ); ?></span>
            <h2 id="state-selector-heading" class="section-title">
                <?php esc_html_e( 'Choose Your State', 'drive' ); ?>
            </h2>
            <p class="section-description">
                <?php esc_html_e( 'Select your state from the interactive map below to access verified DMV permit practice tests, state cheat sheets, and passing prep tools.', 'drive' ); ?>
            </p>
        </div>

        <!-- Interactive Map Container -->
        <div class="state-map-wrapper">
            
            <!-- Dynamic Floating Dark Hover Popover / Tooltip -->
            <div id="state-map-tooltip" class="state-map-tooltip" role="status" aria-live="polite" aria-hidden="true">
                <div class="tooltip-state-name" id="tooltip-state-name">Colorado</div>
                <div class="tooltip-state-meta">
                    <span class="tooltip-active-count" id="tooltip-active-count">16</span>
                    <span class="tooltip-active-label"><?php esc_html_e( 'active now', 'drive' ); ?></span>
                </div>
            </div>

            <!-- SVG Vector US Map -->
            <div class="map-svg-responsive-box">
                <svg 
                    id="us-interactive-map" 
                    class="us-interactive-map-svg" 
                    viewBox="0 0 975 610" 
                    xmlns="http://www.w3.org/2000/svg"
                    role="region" 
                    aria-label="<?php esc_attr_e( 'Interactive United States Driving Test Map', 'drive' ); ?>"
                >
                    <!-- 1. State Heatmap Paths Layer -->
                    <g class="map-states-layer">
                        <?php foreach ( $states_data as $code => $state ) : 
                            $level_class = 'level-' . esc_attr( $state['level'] );
                            $state_url   = home_url( '/' . esc_attr( $state['slug'] ) . '/car-practice-test/' );
                            $pin_x       = isset( $state['pin']['x'] ) ? $state['pin']['x'] : 0;
                            $pin_y       = isset( $state['pin']['y'] ) ? $state['pin']['y'] : 0;
                        ?>
                            <path 
                                id="state-path-<?php echo esc_attr( $code ); ?>"
                                class="state-path <?php echo esc_attr( $level_class ); ?>"
                                d="<?php echo esc_attr( $state['path'] ); ?>"
                                data-state-code="<?php echo esc_attr( $code ); ?>"
                                data-state-name="<?php echo esc_attr( $state['name'] ); ?>"
                                data-state-slug="<?php echo esc_attr( $state['slug'] ); ?>"
                                data-active-count="<?php echo esc_attr( $state['count'] ); ?>"
                                data-level="<?php echo esc_attr( $state['level'] ); ?>"
                                data-url="<?php echo esc_url( $state_url ); ?>"
                                data-pin-x="<?php echo esc_attr( $pin_x ); ?>"
                                data-pin-y="<?php echo esc_attr( $pin_y ); ?>"
                                tabindex="0"
                                role="link"
                                aria-label="<?php echo esc_attr( sprintf( __( '%1$s: %2$d active learners', 'drive' ), $state['name'], $state['count'] ) ); ?>"
                            />
                        <?php endforeach; ?>
                    </g>

                    <!-- 2. State Teardrop Location Pins Layer -->
                    <g class="map-pins-layer">
                        <?php foreach ( $states_data as $code => $state ) : 
                            if ( empty( $state['pin']['x'] ) || empty( $state['pin']['y'] ) ) {
                                continue;
                            }
                            $is_orange  = ( isset( $state['pin_color'] ) && 'orange' === $state['pin_color'] ) || 'very-high' === $state['level'];
                            $pin_theme  = $is_orange ? 'pin-orange' : 'pin-blue';
                            $state_url  = home_url( '/' . esc_attr( $state['slug'] ) . '/car-practice-test/' );
                        ?>
                            <g 
                                id="map-pin-<?php echo esc_attr( $code ); ?>"
                                class="map-pin-node <?php echo esc_attr( $pin_theme ); ?>"
                                transform="translate(<?php echo esc_attr( $state['pin']['x'] ); ?>, <?php echo esc_attr( $state['pin']['y'] ); ?>)"
                                data-state-code="<?php echo esc_attr( $code ); ?>"
                                data-state-name="<?php echo esc_attr( $state['name'] ); ?>"
                                data-active-count="<?php echo esc_attr( $state['count'] ); ?>"
                                data-url="<?php echo esc_url( $state_url ); ?>"
                                cursor="pointer"
                            >
                                <!-- Teardrop Pin Shape pointing directly down at state center -->
                                <path 
                                    class="pin-geometry" 
                                    d="M0,-24 C-7.5,-24 -13.5,-18 -13.5,-10.5 C-13.5,-2 0,4 0,4 C0,4 13.5,-2 13.5,-10.5 C13.5,-18 7.5,-24 0,-24 Z"
                                />
                                <!-- Pin Numeric Active Count -->
                                <text class="pin-label" x="0" y="-8.5" text-anchor="middle">
                                    <?php echo esc_html( $state['count'] ); ?>
                                </text>
                            </g>
                        <?php endforeach; ?>
                    </g>
                </svg>
            </div><!-- .map-svg-responsive-box -->

            <!-- 3. Bottom Activity Level Legend Matching Reference -->
            <div class="map-activity-legend">
                <span class="legend-heading"><?php esc_html_e( 'Activity Level:', 'drive' ); ?></span>
                <div class="legend-swatches-row">
                    <div class="legend-swatch-item">
                        <span class="legend-color-dot dot-very-high"></span>
                        <span class="legend-color-label"><?php esc_html_e( 'Very High', 'drive' ); ?></span>
                    </div>
                    <div class="legend-swatch-item">
                        <span class="legend-color-dot dot-high"></span>
                        <span class="legend-color-label"><?php esc_html_e( 'High', 'drive' ); ?></span>
                    </div>
                    <div class="legend-swatch-item">
                        <span class="legend-color-dot dot-medium"></span>
                        <span class="legend-color-label"><?php esc_html_e( 'Medium', 'drive' ); ?></span>
                    </div>
                    <div class="legend-swatch-item">
                        <span class="legend-color-dot dot-low"></span>
                        <span class="legend-color-label"><?php esc_html_e( 'Low', 'drive' ); ?></span>
                    </div>
                    <div class="legend-swatch-item">
                        <span class="legend-color-dot dot-very-low"></span>
                        <span class="legend-color-label"><?php esc_html_e( 'Very Low', 'drive' ); ?></span>
                    </div>
                </div>
            </div><!-- .map-activity-legend -->

            <!-- Mobile / Quick Selector Dropdown for Fast Access -->
            <div class="state-quick-select-wrap">
                <label for="state-quick-dropdown" class="screen-reader-text"><?php esc_html_e( 'Select your state from the list', 'drive' ); ?></label>
                <div class="quick-select-box">
                    <select id="state-quick-dropdown" class="state-quick-select" aria-label="<?php esc_attr_e( 'Choose state from list', 'drive' ); ?>">
                        <option value=""><?php esc_html_e( 'Or select your state from list...', 'drive' ); ?></option>
                        <?php foreach ( $states_data as $code => $state ) : ?>
                            <option value="<?php echo esc_url( home_url( '/' . esc_attr( $state['slug'] ) . '/car-practice-test/' ) ); ?>">
                                <?php echo esc_html( $state['name'] . ' (' . $state['count'] . ' active learners)' ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" id="btn-state-go" class="btn-state-go">
                        <?php esc_html_e( 'Start Practice Test', 'drive' ); ?>
                        <svg width="14" height="14" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </div>
            </div>

        </div><!-- .state-map-wrapper -->

    </div><!-- .site-container -->
</section><!-- #state-selector -->
