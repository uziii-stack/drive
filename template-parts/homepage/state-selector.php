<?php
/**
 * Template part for displaying the Interactive Choose Your State Map Section
 *
 * Replicated exactly from reference design:
 * - Badge: "● STATE-SPECIFIC PRACTICE"
 * - Headline: "Find your state , start practicing"
 * - Description: "Every test and cheat sheet follows your state's own driver handbook. Click your state to get started."
 * - Region Filter Pills: West, Midwest, South, Northeast
 * - Mint-Teal gradient color-graded interactive SVG US Map
 * - Floating white state name tooltip
 * - Bottom row: "Or select your state from the list..." dropdown + Orange "Continue →" button
 * - Footnote: "Hover to see a state name. Click to open its page."
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$states_data = function_exists( 'drive_get_us_map_states' ) ? drive_get_us_map_states() : array();
$all_states  = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();

// Region groupings
$region_west      = array( 'WA', 'OR', 'CA', 'NV', 'ID', 'MT', 'WY', 'UT', 'CO', 'AZ', 'NM', 'AK', 'HI' );
$region_midwest   = array( 'ND', 'SD', 'NE', 'KS', 'MN', 'IA', 'MO', 'WI', 'IL', 'MI', 'IN', 'OH' );
$region_south     = array( 'TX', 'OK', 'AR', 'LA', 'MS', 'TN', 'KY', 'AL', 'GA', 'FL', 'SC', 'NC', 'VA', 'WV', 'MD', 'DE', 'DC' );
$region_northeast = array( 'PA', 'NY', 'NJ', 'CT', 'RI', 'MA', 'VT', 'NH', 'ME' );

// Color grading mapping based on visual design gradient (West to East)
$zone_1 = array( 'AK', 'HI', 'WA', 'OR', 'NV', 'ID', 'MT', 'WY', 'UT', 'CO', 'AZ', 'NM' );
$zone_2 = array( 'ND', 'SD', 'NE', 'KS', 'MN', 'IA', 'MO', 'WI', 'IL' );
$zone_3 = array( 'TX', 'OK', 'AR', 'LA', 'MS', 'TN', 'KY', 'AL', 'GA', 'FL' );
$zone_4 = array( 'MI', 'IN', 'OH', 'WV', 'VA', 'NC', 'SC', 'MD', 'DE', 'DC' );
$zone_5 = array( 'PA', 'NY', 'NJ', 'CT', 'RI', 'MA', 'VT', 'NH', 'ME' );
?>

<section id="state-selector" class="homepage-section homepage-state-selector" aria-labelledby="state-selector-heading">
    <div class="site-container state-selector-container">
        
        <!-- 1. Header Area matching reference -->
        <div class="state-section-header">
            
            <div class="state-top-badge">
                <span class="badge-dot" aria-hidden="true"></span>
                <span class="badge-text"><?php esc_html_e( 'STATE–SPECIFIC PRACTICE', 'drive' ); ?></span>
            </div>

            <h2 id="state-selector-heading" class="state-main-title">
                <?php esc_html_e( 'Find your state , start practicing', 'drive' ); ?>
            </h2>

            <p class="state-sub-description">
                <?php esc_html_e( 'Every test and cheat sheet follows your state\'s own driver handbook.', 'drive' ); ?><br>
                <?php esc_html_e( 'Click your state to get started.', 'drive' ); ?>
            </p>

            <!-- Region Filter Buttons (Pills) -->
            <div class="state-region-pills" role="tablist" aria-label="<?php esc_attr_e( 'Filter by region', 'drive' ); ?>">
                <button type="button" class="region-pill-btn" data-region="west" role="tab" aria-selected="false">
                    <?php esc_html_e( 'West', 'drive' ); ?>
                </button>
                <button type="button" class="region-pill-btn" data-region="midwest" role="tab" aria-selected="false">
                    <?php esc_html_e( 'Midwest', 'drive' ); ?>
                </button>
                <button type="button" class="region-pill-btn" data-region="south" role="tab" aria-selected="false">
                    <?php esc_html_e( 'South', 'drive' ); ?>
                </button>
                <button type="button" class="region-pill-btn" data-region="northeast" role="tab" aria-selected="false">
                    <?php esc_html_e( 'Northeast', 'drive' ); ?>
                </button>
            </div>

        </div><!-- .state-section-header -->


        <!-- 2. Interactive Map Container -->
        <div class="state-map-wrapper">
            
            <!-- Dynamic Floating White Hover Tooltip -->
            <div id="state-map-tooltip" class="state-map-tooltip" role="status" aria-live="polite" aria-hidden="true">
                <div class="tooltip-state-name" id="tooltip-state-name">California</div>
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
                    <g class="map-states-layer">
                        <?php foreach ( $states_data as $code => $state ) : 
                            // Determine region
                            $region_name = 'other';
                            if ( in_array( $code, $region_west, true ) ) $region_name = 'west';
                            elseif ( in_array( $code, $region_midwest, true ) ) $region_name = 'midwest';
                            elseif ( in_array( $code, $region_south, true ) ) $region_name = 'south';
                            elseif ( in_array( $code, $region_northeast, true ) ) $region_name = 'northeast';

                            // Determine mint-teal gradient zone
                            $zone_class = 'zone-1';
                            if ( in_array( $code, $zone_1, true ) ) $zone_class = 'zone-1';
                            elseif ( in_array( $code, $zone_2, true ) ) $zone_class = 'zone-2';
                            elseif ( in_array( $code, $zone_3, true ) ) $zone_class = 'zone-3';
                            elseif ( in_array( $code, $zone_4, true ) ) $zone_class = 'zone-4';
                            elseif ( in_array( $code, $zone_5, true ) ) $zone_class = 'zone-5';

                            $state_url = function_exists( 'drive_get_state_url' ) ? drive_get_state_url( $state['slug'] ) : home_url( '/' . esc_attr( $state['slug'] ) . '/' );
                        ?>
                            <path 
                                id="state-path-<?php echo esc_attr( $code ); ?>"
                                class="state-path <?php echo esc_attr( $zone_class ); ?>"
                                d="<?php echo esc_attr( $state['path'] ); ?>"
                                data-state-code="<?php echo esc_attr( $code ); ?>"
                                data-state-name="<?php echo esc_attr( $state['name'] ); ?>"
                                data-state-slug="<?php echo esc_attr( $state['slug'] ); ?>"
                                data-region="<?php echo esc_attr( $region_name ); ?>"
                                data-url="<?php echo esc_url( $state_url ); ?>"
                                tabindex="0"
                                role="link"
                                aria-label="<?php echo esc_attr( sprintf( __( 'Prepare for %s Driving Permit Test', 'drive' ), $state['name'] ) ); ?>"
                            />
                        <?php endforeach; ?>
                    </g>
                </svg>
            </div><!-- .map-svg-responsive-box -->

        </div><!-- .state-map-wrapper -->


        <!-- 3. Bottom Controls Row (Dropdown + Continue Button) -->
        <div class="state-bottom-controls-wrap">
            <div class="state-controls-form">
                
                <div class="state-select-custom-box custom-map-dropdown-wrap" id="customMapStateWrapper">
                    <label for="state-map-dropdown" class="screen-reader-text"><?php esc_html_e( 'Select state from dropdown', 'drive' ); ?></label>
                    <select id="state-map-dropdown" class="state-map-dropdown" aria-label="<?php esc_attr_e( 'Select your state from the list', 'drive' ); ?>" tabindex="-1">
                        <option value="" selected><?php esc_html_e( 'Or select your state from the list...', 'drive' ); ?></option>
                        <?php foreach ( $all_states as $st_code => $st_data ) : 
                            $opt_url = function_exists( 'drive_get_state_url' ) ? drive_get_state_url( $st_data['slug'] ) : home_url( '/' . esc_attr( $st_data['slug'] ) . '/' );
                        ?>
                            <option value="<?php echo esc_url( $opt_url ); ?>">
                                <?php echo esc_html( $st_data['name'] ); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <!-- Custom Trigger Button Matching Theme Design -->
                    <button type="button" class="custom-map-trigger" id="customMapTrigger" aria-haspopup="listbox" aria-expanded="false">
                        <span class="custom-map-trigger-text" id="customMapTriggerText"><?php esc_html_e( 'Or select your state from the list...', 'drive' ); ?></span>
                        <span class="select-chevron" aria-hidden="true">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </button>

                    <!-- Custom Popover Menu Matching Theme Design -->
                    <div class="custom-map-menu" id="customMapMenu" role="listbox" aria-label="<?php esc_attr_e( 'States Menu', 'drive' ); ?>">
                        <div class="custom-map-search-wrap">
                            <span class="custom-map-search-icon" aria-hidden="true">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                            </span>
                            <input type="text" class="custom-map-search-input" id="customMapSearch" placeholder="<?php esc_attr_e( 'Filter state...', 'drive' ); ?>" autocomplete="off" />
                        </div>
                        <div class="custom-map-list" id="customMapList">
                            <?php foreach ( $all_states as $st_code => $st_data ) : 
                                $opt_url = function_exists( 'drive_get_state_url' ) ? drive_get_state_url( $st_data['slug'] ) : home_url( '/' . esc_attr( $st_data['slug'] ) . '/' );
                            ?>
                                <div class="custom-map-option" data-value="<?php echo esc_url( $opt_url ); ?>" data-name="<?php echo esc_attr( strtolower( $st_data['name'] ) ); ?>" role="option">
                                    <span class="custom-map-option-name"><?php echo esc_html( $st_data['name'] ); ?></span>
                                    <span class="custom-map-option-check" aria-hidden="true">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"></polyline>
                                        </svg>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn-map-continue" id="btnMapContinue">
                    <span class="btn-continue-text"><?php esc_html_e( 'Continue', 'drive' ); ?></span>
                    <span class="btn-continue-arrow" aria-hidden="true">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 10h12M11 5l5 5-5 5"/>
                        </svg>
                    </span>
                </button>

            </div><!-- .state-controls-form -->

            <p class="state-map-footnote">
                <?php esc_html_e( 'Hover to see a state name. Click to open its page.', 'drive' ); ?>
            </p>

        </div><!-- .state-bottom-controls-wrap -->

    </div><!-- .site-container -->
</section><!-- #state-selector -->
