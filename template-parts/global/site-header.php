<?php
/**
 * Template part for displaying the modern site header
 *
 * Implements the sleek full-width dark navbar matching Figma:
 * - Desktop (>= 992px): WP Site Logo on left, State Dropdown + Vehicle Switcher on right
 * - Mobile (< 992px): Logo on left + Compact [ CA | 🚗 ⌄ ] Chip Button on right (NO Hamburger)
 * - Divider line below header spans exactly from logo to the right action button
 * - Highly optimized down to 320px with zero horizontal overflow
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$all_states     = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$vehicle_types  = function_exists( 'drive_get_vehicle_types' ) ? drive_get_vehicle_types() : array();

// Determine current state
$current_state_slug = 'california'; // Default matching reference design
if ( isset( $_GET['state'] ) && ! empty( $_GET['state'] ) ) {
    $req_state = sanitize_title( wp_unslash( $_GET['state'] ) );
    foreach ( $all_states as $code => $data ) {
        if ( $data['slug'] === $req_state || strtolower( $code ) === strtolower( $req_state ) ) {
            $current_state_slug = $data['slug'];
            break;
        }
    }
} elseif ( get_query_var( 'drive_state' ) ) {
    $current_state_slug = sanitize_title( get_query_var( 'drive_state' ) );
}

$current_state_code = 'CA';
$current_s_name     = 'California';
foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_state_code = $code;
        $current_s_name     = $data['name'];
        break;
    }
}

// Determine current vehicle type
$current_veh = 'car';
if ( isset( $_GET['veh'] ) && ! empty( $_GET['veh'] ) ) {
    $req_veh = sanitize_title( wp_unslash( $_GET['veh'] ) );
    if ( array_key_exists( $req_veh, $vehicle_types ) ) {
        $current_veh = $req_veh;
    }
} elseif ( is_page() ) {
    $page_slug = get_post_field( 'post_name', get_post() );
    if ( strpos( $page_slug, 'motorcycle' ) !== false ) {
        $current_veh = 'motorcycle';
    } elseif ( strpos( $page_slug, 'cdl' ) !== false ) {
        $current_veh = 'cdl';
    }
}

$current_veh_slug = isset( $vehicle_types[ $current_veh ]['slug'] ) ? $vehicle_types[ $current_veh ]['slug'] : 'car-practice-test';
?>

<header id="masthead" class="site-header fullwidth-dark-header" role="banner">
    <div class="header-container">
        
        <!-- Left: Brand / WP Site Logo -->
        <div class="site-branding">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link" rel="home">
                <?php 
                $logo_src = '';
                if ( has_custom_logo() ) {
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $custom_logo_data = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                    if ( ! empty( $custom_logo_data[0] ) ) {
                        $logo_src = $custom_logo_data[0];
                    }
                } elseif ( file_exists( get_template_directory() . '/assets/images/logo-icon.png' ) ) {
                    $logo_src = get_template_directory_uri() . '/assets/images/logo-icon.png';
                } elseif ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) {
                    $logo_src = get_template_directory_uri() . '/assets/images/logo.png';
                }
                ?>

                <?php if ( ! empty( $logo_src ) ) : ?>
                    <span class="brand-logo-badge brand-custom-logo-badge" aria-hidden="true">
                        <img src="<?php echo esc_url( $logo_src ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo-img" width="34" height="34" />
                    </span>
                <?php else : ?>
                    <span class="brand-logo-badge" aria-hidden="true">
                        <svg width="34" height="34" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="18" cy="18" r="16" fill="#1C1E2E" stroke="#ffffff" stroke-width="2.5"/>
                            <circle cx="9.5" cy="26.5" r="2.5" fill="#F26419"/>
                            <path d="M11 18.5L16 23.5L25.5 13" stroke="#00B4A6" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                <?php endif; ?>

                <span class="brand-title-wrap">
                    <span class="brand-title-desktop">
                        <span class="brand-name-main"><?php esc_html_e( 'DMV Learners Permit', 'drive' ); ?></span>
                        <span class="brand-name-accent"><?php esc_html_e( 'Test', 'drive' ); ?></span>
                    </span>
                    <span class="brand-title-mobile">
                        <span class="brand-title-line-1"><?php esc_html_e( 'DMV Learners', 'drive' ); ?></span>
                        <span class="brand-title-line-2"><?php esc_html_e( 'Permit', 'drive' ); ?> <span class="brand-name-accent"><?php esc_html_e( 'Test', 'drive' ); ?></span></span>
                    </span>
                </span>
            </a>
        </div>

        <!-- Right: Actions -->
        <div class="header-actions">
            
            <!-- 1. Desktop State Selector Dropdown (Hidden on Mobile) -->
            <div class="header-state-selector desktop-state-selector" id="header-state-selector">
                <button type="button" class="header-state-trigger" id="stateDropdownTrigger" aria-haspopup="true" aria-expanded="false" aria-controls="stateMegaDropdown" aria-label="<?php esc_attr_e( 'Select State', 'drive' ); ?>">
                    <span class="state-icon-wrap" aria-hidden="true">
                        <svg class="state-us-svg" width="22" height="16" viewBox="0 0 28 20" fill="currentColor">
                            <path d="M1.2 5.5c.4-.7 1.5-.8 2.2-1.1 1-.7 2.2-.2 3.3-.6 1.3-.4 2.6-1.4 4-1.5 1.5-.1 3 .6 4.6.7 1.5.1 3.1-.5 4.7-.7 1.3-.2 2.6.3 3.9.4 1 .1 2.1-.3 3 .2.6.3.8 1.2.7 1.9-.1 1.2-.7 2.3-1.2 3.4-.4 1-1 1.8-1 2.9.1 1 .8 1.8.6 2.9-.2 1-1 1.8-1.9 2.4-1.3.9-2.8 1.5-4.3 1.5-1.2 0-2.4-.5-3.6-.7-1.5-.3-3 .3-4.4.3-1.5 0-3.1-.7-4.6-1.1-1.3-.4-2.6-.8-3.8-1.5-1-.6-1.5-1.6-1.9-2.7-.4-1.2-.2-2.6-.2-3.9.1-1-.3-1.9-.1-2.9.2-.5.4-.9.4-1.4z"/>
                        </svg>
                    </span>
                    <span class="header-state-name" id="selectedStateLabel"><?php echo esc_html( $current_s_name ); ?></span>
                    <span class="state-chevron-wrap" aria-hidden="true">
                        <svg class="state-chevron-svg" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>

                <!-- 3-Column State Mega Dropdown Card (Desktop) -->
                <div class="state-mega-dropdown-card" id="stateMegaDropdown" role="menu" aria-label="<?php esc_attr_e( 'Select State', 'drive' ); ?>">
                    <div class="state-mega-dropdown-inner">
                        <div class="state-dropdown-header">
                            <span class="state-dropdown-title"><?php esc_html_e( 'Select Your State', 'drive' ); ?></span>
                            <span class="state-dropdown-subtitle"><?php esc_html_e( 'Choose a state to access official DMV practice tests', 'drive' ); ?></span>
                        </div>
                        <div class="state-mega-columns-grid">
                            <?php
                            $state_chunks = array_chunk( $all_states, ceil( count( $all_states ) / 3 ), true );
                            foreach ( $state_chunks as $chunk ) :
                            ?>
                                <div class="state-mega-column">
                                    <?php foreach ( $chunk as $st_code => $st_data ) : 
                                        $st_url = home_url( '/' . esc_attr( $st_data['slug'] ) . '/' . esc_attr( $current_veh_slug ) . '/' );
                                        $is_active = ( $st_data['slug'] === $current_state_slug ) ? 'is-selected' : '';
                                    ?>
                                        <a href="<?php echo esc_url( $st_url ); ?>" 
                                           class="state-mega-link <?php echo esc_attr( $is_active ); ?>" 
                                           data-state-slug="<?php echo esc_attr( $st_data['slug'] ); ?>"
                                           data-state-name="<?php echo esc_attr( $st_data['name'] ); ?>"
                                           role="menuitem">
                                            <?php echo esc_html( $st_data['name'] ); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Vehicle Switcher Tabs / Icons (Desktop - Hidden on Mobile) -->
            <div class="header-vehicle-switcher desktop-vehicle-switcher" role="tablist" aria-label="<?php esc_attr_e( 'Vehicle Type', 'drive' ); ?>">
                
                <!-- Car -->
                <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/car-practice-test/' ) ); ?>" 
                   class="vehicle-switch-btn <?php echo ( $current_veh === 'car' ) ? 'is-active' : ''; ?>" 
                   data-vehicle="car" 
                   role="tab" 
                   aria-selected="<?php echo ( $current_veh === 'car' ) ? 'true' : 'false'; ?>"
                   aria-label="<?php esc_attr_e( 'Car Permit Tests', 'drive' ); ?>"
                   title="<?php esc_attr_e( 'Car Permit Tests', 'drive' ); ?>">
                    <span class="veh-btn-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                            <circle cx="7" cy="15" r="1.5" fill="currentColor"/>
                            <circle cx="17" cy="15" r="1.5" fill="currentColor"/>
                        </svg>
                    </span>
                </a>

                <!-- Motorcycle -->
                <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/motorcycle-practice-test/' ) ); ?>" 
                   class="vehicle-switch-btn <?php echo ( $current_veh === 'motorcycle' ) ? 'is-active' : ''; ?>" 
                   data-vehicle="motorcycle" 
                   role="tab" 
                   aria-selected="<?php echo ( $current_veh === 'motorcycle' ) ? 'true' : 'false'; ?>"
                   aria-label="<?php esc_attr_e( 'Motorcycle Permit Tests', 'drive' ); ?>"
                   title="<?php esc_attr_e( 'Motorcycle Permit Tests', 'drive' ); ?>">
                    <span class="veh-btn-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="5.5" cy="17.5" r="3.5"/>
                            <circle cx="18.5" cy="17.5" r="3.5"/>
                            <path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/>
                            <path d="M12 17.5V14l-3-4"/>
                            <path d="M5.5 17.5L9 12"/>
                        </svg>
                    </span>
                </a>

                <!-- CDL / Truck -->
                <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/cdl-practice-test/' ) ); ?>" 
                   class="vehicle-switch-btn <?php echo ( $current_veh === 'cdl' ) ? 'is-active' : ''; ?>" 
                   data-vehicle="cdl" 
                   role="tab" 
                   aria-selected="<?php echo ( $current_veh === 'cdl' ) ? 'true' : 'false'; ?>"
                   aria-label="<?php esc_attr_e( 'CDL Commercial Tests', 'drive' ); ?>"
                   title="<?php esc_attr_e( 'CDL Commercial Tests', 'drive' ); ?>">
                    <span class="veh-btn-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 4h12v12H2z"/>
                            <path d="M14 9h4l3 3v4h-7V9z"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/>
                            <circle cx="18.5" cy="18.5" r="2.5"/>
                        </svg>
                    </span>
                </a>

            </div>

            <!-- 3. Mobile & Compact Chip: [ CA | 🚗 ⌄ ] (Replaces Hamburger completely) -->
            <button type="button" class="header-state-veh-chip" id="mobileStateVehChip" aria-haspopup="dialog" aria-expanded="false" aria-controls="mobileStateVehModal" aria-label="<?php esc_attr_e( 'Select state and vehicle type', 'drive' ); ?>">
                <span class="chip-state-abbr" id="headerChipState"><?php echo esc_html( $current_state_code ); ?></span>
                <span class="chip-divider" aria-hidden="true"></span>
                <span class="chip-veh-icon" id="headerChipVehIcon" aria-hidden="true">
                    <?php if ( 'motorcycle' === $current_veh ) : ?>
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="5.5" cy="17.5" r="3.5"/>
                            <circle cx="18.5" cy="17.5" r="3.5"/>
                            <path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/>
                            <path d="M12 17.5V14l-3-4"/>
                            <path d="M5.5 17.5L9 12"/>
                        </svg>
                    <?php elseif ( 'cdl' === $current_veh ) : ?>
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 4h12v12H2z"/>
                            <path d="M14 9h4l3 3v4h-7V9z"/>
                            <circle cx="5.5" cy="18.5" r="2.5"/>
                            <circle cx="18.5" cy="18.5" r="2.5"/>
                        </svg>
                    <?php else : ?>
                        <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                            <circle cx="7" cy="15" r="1.5" fill="#00B4A6"/>
                            <circle cx="17" cy="15" r="1.5" fill="#00B4A6"/>
                        </svg>
                    <?php endif; ?>
                </span>
                <span class="chip-chevron" aria-hidden="true">
                    <svg width="11" height="11" viewBox="0 0 12 12" fill="none">
                        <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </button>

        </div><!-- .header-actions -->

    </div><!-- .header-container -->

    <!-- Mobile Slide-Up State & Vehicle Picker Sheet -->
    <div id="mobileStateVehModal" class="mobile-state-veh-modal" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Choose state and vehicle', 'drive' ); ?>" aria-hidden="true">
        <div class="mobile-modal-backdrop" id="mobileModalBackdrop"></div>
        <div class="mobile-modal-sheet">
            <div class="mobile-modal-handle-bar" aria-hidden="true"></div>
            
            <div class="mobile-modal-header">
                <span class="mobile-modal-title"><?php esc_html_e( 'Select State & Vehicle', 'drive' ); ?></span>
                <button type="button" class="mobile-modal-close" id="mobileModalClose" aria-label="<?php esc_attr_e( 'Close', 'drive' ); ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Vehicle Selection Pills -->
            <div class="mobile-modal-veh-block">
                <div class="mobile-modal-section-label"><?php esc_html_e( 'Vehicle Type', 'drive' ); ?></div>
                <div class="mobile-modal-veh-grid">
                    
                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/car-practice-test/' ) ); ?>" 
                       class="mobile-modal-veh-btn <?php echo ( $current_veh === 'car' ) ? 'is-active' : ''; ?>" 
                       data-veh="car">
                        <span class="m-veh-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                                <circle cx="7" cy="15" r="1.5" fill="currentColor"/>
                                <circle cx="17" cy="15" r="1.5" fill="currentColor"/>
                            </svg>
                        </span>
                        <span class="m-veh-name"><?php esc_html_e( 'Car', 'drive' ); ?></span>
                    </a>

                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/motorcycle-practice-test/' ) ); ?>" 
                       class="mobile-modal-veh-btn <?php echo ( $current_veh === 'motorcycle' ) ? 'is-active' : ''; ?>" 
                       data-veh="motorcycle">
                        <span class="m-veh-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="5.5" cy="17.5" r="3.5"/>
                                <circle cx="18.5" cy="17.5" r="3.5"/>
                                <path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/>
                                <path d="M12 17.5V14l-3-4"/>
                                <path d="M5.5 17.5L9 12"/>
                            </svg>
                        </span>
                        <span class="m-veh-name"><?php esc_html_e( 'Motorcycle', 'drive' ); ?></span>
                    </a>

                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/cdl-practice-test/' ) ); ?>" 
                       class="mobile-modal-veh-btn <?php echo ( $current_veh === 'cdl' ) ? 'is-active' : ''; ?>" 
                       data-veh="cdl">
                        <span class="m-veh-icon" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 4h12v12H2z"/>
                                <path d="M14 9h4l3 3v4h-7V9z"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                        </span>
                        <span class="m-veh-name"><?php esc_html_e( 'CDL', 'drive' ); ?></span>
                    </a>

                </div>
            </div>

            <!-- State List with Quick Search -->
            <div class="mobile-modal-states-block">
                <div class="mobile-modal-section-label"><?php esc_html_e( 'State (50 States)', 'drive' ); ?></div>
                <div class="mobile-state-search-box">
                    <input type="text" id="mobileStateSearchInput" placeholder="<?php esc_attr_e( 'Filter state (e.g. California, TX)...', 'drive' ); ?>" autocomplete="off" />
                </div>
                <div class="mobile-modal-states-grid" id="mobileModalStatesGrid">
                    <?php foreach ( $all_states as $st_code => $st_data ) : 
                        $st_url = home_url( '/' . esc_attr( $st_data['slug'] ) . '/' . esc_attr( $current_veh_slug ) . '/' );
                        $is_active = ( $st_data['slug'] === $current_state_slug ) ? 'is-selected' : '';
                    ?>
                        <a href="<?php echo esc_url( $st_url ); ?>" 
                           class="mobile-modal-state-link <?php echo esc_attr( $is_active ); ?>" 
                           data-state-code="<?php echo esc_attr( $st_code ); ?>"
                           data-state-name="<?php echo esc_attr( $st_data['name'] ); ?>"
                           data-state-slug="<?php echo esc_attr( $st_data['slug'] ); ?>">
                            <span class="m-st-code"><?php echo esc_html( $st_code ); ?></span>
                            <span class="m-st-name"><?php echo esc_html( $st_data['name'] ); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

        </div><!-- .mobile-modal-sheet -->
    </div><!-- #mobileStateVehModal -->

</header><!-- #masthead -->
