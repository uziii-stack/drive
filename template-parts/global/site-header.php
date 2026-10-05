<?php
/**
 * Template part for displaying the site header
 *
 * Implements the sleek floating pill-style header with branding,
 * navigation menu, and the dynamic push-text arrow CTA button.
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<header id="masthead" class="site-header pill-header" role="banner">
    <div class="site-container header-site-container">
        <div class="header-pill-bar">
            
            <!-- Left: Brand / Logo Area (Text-based until logo asset is placed) -->
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-link" rel="home">
                        <span class="brand-text"><?php bloginfo( 'name' ); ?></span>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Middle / Right: Navigation & Mobile Drawer -->
            <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'drive' ); ?>">
                <button class="menu-toggle" aria-controls="primary-menu-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation menu', 'drive' ); ?>">
                    <span class="menu-toggle-icon-wrap" aria-hidden="true">
                        <span class="menu-toggle-bar bar-1"></span>
                        <span class="menu-toggle-bar bar-2"></span>
                        <span class="menu-toggle-bar bar-3"></span>
                    </span>
                    <span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation menu', 'drive' ); ?></span>
                </button>

                <div id="primary-menu-drawer" class="primary-menu-drawer">
                    <div class="primary-menu-drawer-inner">
                        <?php
                        $all_states     = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
                        $vehicle_types  = function_exists( 'drive_get_vehicle_types' ) ? drive_get_vehicle_types() : array();
                        $current_state  = 'alaska'; // Default or context-derived state slug
                        $current_s_name = isset( $all_states['AK']['name'] ) ? $all_states['AK']['name'] : 'Alaska';
                        $current_veh    = 'car';
                        $current_v_name = 'Car';
                        ?>

                        <ul id="primary-menu" class="nav-menu primary-menu-list">
                            
                            <!-- 1. State Selector Dropdown (3-Column Mega Menu) -->
                            <li class="menu-item menu-item-has-children nav-state-item" id="nav-state-dropdown-item">
                                <a href="<?php echo esc_url( home_url( '/#state-selector' ) ); ?>" class="nav-dropdown-trigger state-trigger" aria-haspopup="true" aria-expanded="false">
                                    <span class="nav-trigger-icon-wrap" aria-hidden="true">
                                        <!-- Location Pin SVG -->
                                        <svg class="nav-svg-icon icon-pin" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                    </span>
                                    <span class="nav-trigger-label current-state-text"><?php echo esc_html( $current_s_name ); ?></span>
                                    <span class="nav-chevron-wrap" aria-hidden="true">
                                        <svg class="nav-chevron-svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <path d="M2.5 3.75L5 6.25L7.5 3.75" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>

                                <!-- 3-Column State Mega Dropdown Card -->
                                <div class="nav-mega-menu state-mega-menu" aria-label="<?php esc_attr_e( 'Select State', 'drive' ); ?>">
                                    <div class="state-mega-columns-grid">
                                        <?php
                                        $state_chunks = array_chunk( $all_states, ceil( count( $all_states ) / 3 ), true );
                                        foreach ( $state_chunks as $chunk ) :
                                        ?>
                                            <div class="state-mega-column">
                                                <?php foreach ( $chunk as $st_code => $st_data ) : 
                                                    $st_url = home_url( '/' . esc_attr( $st_data['slug'] ) . '/car-practice-test/' );
                                                    $is_active = ( $st_data['slug'] === $current_state ) ? 'is-selected' : '';
                                                ?>
                                                    <a href="<?php echo esc_url( $st_url ); ?>" class="state-mega-link <?php echo esc_attr( $is_active ); ?>" data-state-slug="<?php echo esc_attr( $st_data['slug'] ); ?>">
                                                        <?php echo esc_html( $st_data['name'] ); ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </li>

                            <!-- 2. Vehicle Selector Dropdown -->
                            <li class="menu-item menu-item-has-children nav-vehicle-item" id="nav-vehicle-dropdown-item">
                                <a href="<?php echo esc_url( home_url( '/#vehicle-selector' ) ); ?>" class="nav-dropdown-trigger vehicle-trigger" aria-haspopup="true" aria-expanded="false">
                                    <span class="nav-trigger-icon-wrap" aria-hidden="true">
                                        <!-- Car Icon SVG -->
                                        <svg class="nav-svg-icon icon-car" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z"/>
                                            <circle cx="7.5" cy="14.5" r="1.5"/>
                                            <circle cx="16.5" cy="14.5" r="1.5"/>
                                        </svg>
                                    </span>
                                    <span class="nav-trigger-label current-vehicle-text"><?php echo esc_html( $current_v_name ); ?></span>
                                    <span class="nav-chevron-wrap" aria-hidden="true">
                                        <svg class="nav-chevron-svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                            <path d="M2.5 3.75L5 6.25L7.5 3.75" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </a>

                                <!-- Vehicle Selector Dropdown Menu Card -->
                                <div class="nav-dropdown-menu vehicle-dropdown-menu" aria-label="<?php esc_attr_e( 'Select Vehicle Type', 'drive' ); ?>">
                                    <ul class="vehicle-options-list">
                                        
                                        <!-- Car -->
                                        <li>
                                            <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state ) . '/car-practice-test/' ) ); ?>" class="vehicle-option-link is-active" data-vehicle="car">
                                                <span class="veh-icon-box" aria-hidden="true">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 17H5v-4.66l.12-.34h13.77l.11.34V17z"/>
                                                        <circle cx="7.5" cy="14.5" r="1.5"/>
                                                        <circle cx="16.5" cy="14.5" r="1.5"/>
                                                    </svg>
                                                </span>
                                                <span class="veh-name"><?php esc_html_e( 'Car', 'drive' ); ?></span>
                                            </a>
                                        </li>

                                        <!-- CDL -->
                                        <li>
                                            <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state ) . '/cdl-practice-test/' ) ); ?>" class="vehicle-option-link" data-vehicle="cdl">
                                                <span class="veh-icon-box" aria-hidden="true">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M4 16c0 .88.39 1.67 1 2.22V20c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h8v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1.78c.61-.55 1-1.34 1-2.22V6c0-3.5-3.58-4-8-4s-8 .5-8 4v10zm3.5 1c-.83 0-1.5-.67-1.5-1.5S6.67 14 7.5 14s1.5.67 1.5 1.5S8.33 17 7.5 17zm9 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zm1.5-6H6V6h12v5z"/>
                                                    </svg>
                                                </span>
                                                <span class="veh-name"><?php esc_html_e( 'CDL (Commercial Vehicles)', 'drive' ); ?></span>
                                            </a>
                                        </li>

                                        <!-- Motorcycle -->
                                        <li>
                                            <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state ) . '/motorcycle-practice-test/' ) ); ?>" class="vehicle-option-link" data-vehicle="motorcycle">
                                                <span class="veh-icon-box" aria-hidden="true">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M19.44 9.03L15.41 5H11v2h3.59l2 2H5c-2.8 0-5 2.2-5 5s2.2 5 5 5c2.46 0 4.45-1.69 4.9-4h4.2c.45 2.31 2.44 4 4.9 4 2.8 0 5-2.2 5-5 0-2.54-1.86-4.63-4.56-4.97zM7.82 15C7.4 16.15 6.28 17 5 17c-1.63 0-3-1.37-3-3s1.37-3 3-3c1.28 0 2.4.85 2.82 2H5v2h2.82zm11.18 2c-1.63 0-3-1.37-3-3s1.37-3 3-3 3 1.37 3 3-1.37 3-3 3z"/>
                                                    </svg>
                                                </span>
                                                <span class="veh-name"><?php esc_html_e( 'Motorcycle', 'drive' ); ?></span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            <!-- Standard Nav Items -->
                            <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#features' ) ); ?>"><span><?php esc_html_e( 'Cheat Sheets', 'drive' ); ?></span></a></li>
                            <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#how-it-works' ) ); ?>"><span><?php esc_html_e( 'How It Works', 'drive' ); ?></span></a></li>
                            <li class="menu-item"><a href="<?php echo esc_url( home_url( '/#faq' ) ); ?>"><span><?php esc_html_e( 'FAQ', 'drive' ); ?></span></a></li>

                        </ul>

                        <!-- Mobile/Tablet Drawer Bottom CTA Button -->
                        <div class="mobile-drawer-cta-wrap">
                            <a href="<?php echo esc_url( home_url( '/#premium' ) ); ?>" class="btn-header-cta btn-drawer-cta">
                                <span class="btn-cta-inner">
                                    <span class="btn-cta-arrow-left" aria-hidden="true">
                                        <svg class="btn-cta-svg" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span class="btn-cta-text"><?php esc_html_e( 'Pass with premium', 'drive' ); ?></span>
                                    <span class="btn-cta-arrow-right" aria-hidden="true">
                                        <svg class="btn-cta-svg" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div><!-- .primary-menu-drawer-inner -->
                </div><!-- .primary-menu-drawer -->
            </nav>

            <!-- Desktop (>= 1200px) Far Right CTA Button -->
            <div class="header-cta-wrap desktop-header-cta">
                <a href="<?php echo esc_url( home_url( '/#premium' ) ); ?>" class="btn-header-cta">
                    <span class="btn-cta-inner">
                        <span class="btn-cta-arrow-left" aria-hidden="true">
                            <svg class="btn-cta-svg" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="btn-cta-text"><?php esc_html_e( 'Pass with premium', 'drive' ); ?></span>
                        <span class="btn-cta-arrow-right" aria-hidden="true">
                            <svg class="btn-cta-svg" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.33334 8H12.6667M12.6667 8L8.66668 4M12.6667 8L8.66668 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </span>
                </a>
            </div>

        </div><!-- .header-pill-bar -->
    </div><!-- .header-site-container -->
</header><!-- #masthead -->
