<?php
/**
 * Template part for displaying the modern site header
 *
 * Implements the sleek full-width dark navbar with:
 * - Desktop: WP Site Logo on left, State Dropdown + Vehicle Switcher on right
 * - Mobile (< 992px): Ultra-clean header with Logo + Hamburger toggle;
 *   State Selector, Vehicle Type Selector, and navigation links neatly organized inside the Mobile Drawer.
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

$current_s_name = 'California';
foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_s_name = $data['name'];
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
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link" rel="home">
                    <span class="brand-logo-badge" aria-hidden="true">
                        <svg width="34" height="34" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Circular Badge with Outer Ring -->
                            <circle cx="18" cy="18" r="16" fill="#1C1E2E" stroke="#ffffff" stroke-width="2.5"/>
                            <!-- Small Accent Dot -->
                            <circle cx="9.5" cy="26.5" r="2.5" fill="#FF6B00"/>
                            <!-- Vibrant Teal Checkmark -->
                            <path d="M11 18.5L16 23.5L25.5 13" stroke="#00D4C3" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <span class="brand-title-wrap">
                        <span class="brand-name-main"><?php esc_html_e( 'DMV Learners Permit', 'drive' ); ?></span>
                        <span class="brand-name-accent"><?php esc_html_e( 'Test', 'drive' ); ?></span>
                    </span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Right: Actions (Desktop State Dropdown + Vehicle Switcher + Mobile Toggle) -->
        <div class="header-actions">
            
            <!-- 1. Desktop State Selector Dropdown (Hidden on Mobile) -->
            <div class="header-state-selector desktop-state-selector" id="header-state-selector">
                <button type="button" class="header-state-trigger" id="stateDropdownTrigger" aria-haspopup="true" aria-expanded="false" aria-controls="stateMegaDropdown" aria-label="<?php esc_attr_e( 'Select State', 'drive' ); ?>">
                    <span class="state-icon-wrap" aria-hidden="true">
                        <!-- US Map Silhouette Icon in Teal -->
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

            <!-- 3. Mobile Hamburger Toggle Button (Clean & Prominent on Mobile) -->
            <button type="button" class="menu-toggle header-hamburger-btn" id="headerMenuToggle" aria-controls="mobileMenuDrawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'drive' ); ?>">
                <span class="menu-toggle-icon-wrap" aria-hidden="true">
                    <span class="menu-toggle-bar bar-1"></span>
                    <span class="menu-toggle-bar bar-2"></span>
                    <span class="menu-toggle-bar bar-3"></span>
                </span>
                <span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation menu', 'drive' ); ?></span>
            </button>

        </div><!-- .header-actions -->

    </div><!-- .header-container -->

    <!-- Mobile Slide-Down Drawer Navigation -->
    <div id="mobileMenuDrawer" class="mobile-menu-drawer" aria-hidden="true">
        <div class="mobile-drawer-inner">
            
            <!-- 1. Mobile State Selector Accordion / Card -->
            <div class="mobile-state-accordion-block" id="mobileStateBlock">
                <button type="button" class="mobile-state-accordion-trigger" id="mobileStateTrigger" aria-expanded="false">
                    <div class="mobile-state-trigger-left">
                        <span class="state-icon-wrap" aria-hidden="true">
                            <svg class="state-us-svg" width="20" height="15" viewBox="0 0 28 20" fill="currentColor">
                                <path d="M1.2 5.5c.4-.7 1.5-.8 2.2-1.1 1-.7 2.2-.2 3.3-.6 1.3-.4 2.6-1.4 4-1.5 1.5-.1 3 .6 4.6.7 1.5.1 3.1-.5 4.7-.7 1.3-.2 2.6.3 3.9.4 1 .1 2.1-.3 3 .2.6.3.8 1.2.7 1.9-.1 1.2-.7 2.3-1.2 3.4-.4 1-1 1.8-1 2.9.1 1 .8 1.8.6 2.9-.2 1-1 1.8-1.9 2.4-1.3.9-2.8 1.5-4.3 1.5-1.2 0-2.4-.5-3.6-.7-1.5-.3-3 .3-4.4.3-1.5 0-3.1-.7-4.6-1.1-1.3-.4-2.6-.8-3.8-1.5-1-.6-1.5-1.6-1.9-2.7-.4-1.2-.2-2.6-.2-3.9.1-1-.3-1.9-.1-2.9.2-.5.4-.9.4-1.4z"/>
                            </svg>
                        </span>
                        <div class="mobile-state-info">
                            <span class="mobile-state-sub"><?php esc_html_e( 'Selected State', 'drive' ); ?></span>
                            <span class="mobile-state-curr" id="mobileSelectedStateLabel"><?php echo esc_html( $current_s_name ); ?></span>
                        </div>
                    </div>
                    <span class="mobile-state-chevron" aria-hidden="true">
                        <svg width="14" height="14" viewBox="0 0 12 12" fill="none">
                            <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>

                <!-- Expandable 50 States Grid -->
                <div class="mobile-state-list-expandable" id="mobileStateList">
                    <div class="mobile-state-columns-grid">
                        <?php foreach ( $all_states as $st_code => $st_data ) : 
                            $st_url = home_url( '/' . esc_attr( $st_data['slug'] ) . '/' . esc_attr( $current_veh_slug ) . '/' );
                            $is_active = ( $st_data['slug'] === $current_state_slug ) ? 'is-selected' : '';
                        ?>
                            <a href="<?php echo esc_url( $st_url ); ?>" 
                               class="mobile-state-link <?php echo esc_attr( $is_active ); ?>" 
                               data-state-slug="<?php echo esc_attr( $st_data['slug'] ); ?>"
                               data-state-name="<?php echo esc_attr( $st_data['name'] ); ?>">
                                <?php echo esc_html( $st_data['name'] ); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- 2. Vehicle Selection Quick Switcher (Mobile) -->
            <div class="mobile-section-block">
                <div class="mobile-section-label"><?php esc_html_e( 'Select Vehicle Type', 'drive' ); ?></div>
                <div class="mobile-vehicle-grid">
                    
                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/car-practice-test/' ) ); ?>" class="mobile-veh-btn <?php echo ( $current_veh === 'car' ) ? 'is-active' : ''; ?>">
                        <span class="veh-icon-box" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                                <circle cx="7" cy="15" r="1.5" fill="currentColor"/>
                                <circle cx="17" cy="15" r="1.5" fill="currentColor"/>
                            </svg>
                        </span>
                        <span class="veh-btn-name"><?php esc_html_e( 'Car', 'drive' ); ?></span>
                    </a>

                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/motorcycle-practice-test/' ) ); ?>" class="mobile-veh-btn <?php echo ( $current_veh === 'motorcycle' ) ? 'is-active' : ''; ?>">
                        <span class="veh-icon-box" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="5.5" cy="17.5" r="3.5"/>
                                <circle cx="18.5" cy="17.5" r="3.5"/>
                                <path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/>
                                <path d="M12 17.5V14l-3-4"/>
                                <path d="M5.5 17.5L9 12"/>
                            </svg>
                        </span>
                        <span class="veh-btn-name"><?php esc_html_e( 'Motorcycle', 'drive' ); ?></span>
                    </a>

                    <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/cdl-practice-test/' ) ); ?>" class="mobile-veh-btn <?php echo ( $current_veh === 'cdl' ) ? 'is-active' : ''; ?>">
                        <span class="veh-icon-box" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 4h12v12H2z"/>
                                <path d="M14 9h4l3 3v4h-7V9z"/>
                                <circle cx="5.5" cy="18.5" r="2.5"/>
                                <circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                        </span>
                        <span class="veh-btn-name"><?php esc_html_e( 'CDL', 'drive' ); ?></span>
                    </a>

                </div>
            </div>

            <!-- 3. Mobile Navigation Links -->
            <ul class="mobile-nav-list">
                <li class="mobile-nav-item">
                    <a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>" class="mobile-nav-link">
                        <span><?php esc_html_e( 'All 50 State Tests', 'drive' ); ?></span>
                        <span class="nav-link-arrow">→</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="<?php echo esc_url( home_url( '/#features' ) ); ?>" class="mobile-nav-link">
                        <span><?php esc_html_e( 'Cheat Sheets & PDFs', 'drive' ); ?></span>
                        <span class="nav-link-arrow">→</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="<?php echo esc_url( home_url( '/#how-it-works' ) ); ?>" class="mobile-nav-link">
                        <span><?php esc_html_e( 'How It Works', 'drive' ); ?></span>
                        <span class="nav-link-arrow">→</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>" class="mobile-nav-link">
                        <span><?php esc_html_e( 'Frequently Asked Questions', 'drive' ); ?></span>
                        <span class="nav-link-arrow">→</span>
                    </a>
                </li>
            </ul>

            <!-- 4. Mobile Drawer CTA Button -->
            <div class="mobile-drawer-cta">
                <a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>" class="btn-hero-orange btn-mobile-cta">
                    <span><?php esc_html_e( 'Choose Your State', 'drive' ); ?></span>
                    <span class="btn-arrow-icon" aria-hidden="true">→</span>
                </a>
            </div>

        </div><!-- .mobile-drawer-inner -->
    </div><!-- .mobile-menu-drawer -->

</header><!-- #masthead -->
