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
$us_map_states      = function_exists( 'drive_get_us_map_states' ) ? drive_get_us_map_states() : array();

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_state_code = $code;
        $current_s_name     = $data['name'];
        break;
    }
}

$active_st_viewbox = '6.9 140.2 167.4 286.7';
$active_st_path    = 'M77.194,374.3L78.25,374.65L79.813,376.093L81.113,376.912L81.793,378.752L81.326,379.506L80.534,378.817L78.9,378.289L78.636,377.506L78.981,376.105L77.773,375.493L77.194,374.3ZM74.747,384.219L75.326,384.284L76.382,387.134L78.27,389.977L76.829,390.131L75.793,388.683L74.747,384.219ZM65.174,358.362L66.362,358.73L66.24,359.3L65.123,359.092L65.174,358.362ZM58.281,374.306L59.245,374.401L60.728,376.116L59.804,376.182L58.636,375.464L58.281,374.306ZM56.616,355.05L58.291,356.053L59.459,356.261L60.494,357.394L61.692,357.78L62.352,357.163L63.58,357.834L62.636,358.51L60.728,358.255L59.53,358.57L56.89,357.406L57.134,356.249L56.616,355.05ZM50.251,355.18L51.733,355.418L54.139,355.388L53.936,356.308L55.002,356.854L54.86,357.78L51.916,358.119L51.195,357.382L50.251,355.18ZM46.819,353.441L48.596,353.061L49.388,354.444L48.332,354.367L46.819,353.441ZM32.596,159.951L40.332,162.332L46.454,164.107L49.753,164.837L51.337,165.448L57.946,167.324L62.108,168.404L68.159,170.244L83.671,174.768L95.793,177.991L100.452,179.166L94.046,203.997L91.965,212.277L88.828,224.321L84.514,240.503L83.295,245.525L94.767,262.757L101.457,272.866L116.584,295.607L132.086,318.977L144.4,337.503L156.847,356.183L156.248,359.074L156.948,360.083L157.263,361.751L158.491,363.247L158.897,365.717L158.715,366.12L159.334,367.687L158.907,369.278L159.811,369.634L161.435,371.914L162.258,372.46L162.765,373.629L162.176,374.567L160.085,376.128L158.715,376.68L156.836,377.031L156.116,378.746L153.882,380.479L154.187,382.094L153.608,382.444L153.547,385.952L152.847,386.225L152.39,389.098L151.669,389.431L150.156,390.879L149.903,391.497L148.024,391.681L148.319,392.737L147.466,393.936L148.329,394.856L147.791,397.332L146.979,398.614L147.405,400.08L148.644,400.62L150.167,400.816L150.684,403.76L150.299,405.143L148.887,406.123L148.826,406.901L147.091,407.096L145.73,406.74L145.07,407.049L99.498,401.659L99.701,399.534L98.95,397.913L97.935,398.145L98.341,395.1L98.067,394.595L98.869,393.556L99.031,390.363L98.716,387.727L96.534,382.254L95.153,380.699L94.524,379.286L93.346,378.55L92.493,376.449L91.072,374.929L90.229,374.419L89.143,373.018L87.925,370.958L86.422,369.818L86.168,370.697L84.696,370.804L82.118,369.284L81.976,368.483L82.757,367.972L82.991,367.171L82.605,364.743L81.671,362.47L80.849,361.935L77.61,361.371L76.351,361.793L75.631,360.837L74.169,360.261L71.753,358.374L71.012,358.148L69.702,356.735L69.316,354.124L67.885,352.194L67.509,352.135L66.555,350.574L65.002,349.256L62.991,348.68L62.21,348.971L60.788,348.081L59.316,347.915L57.195,346.152L54.88,345.243L51.956,344.632L48.809,344.258L48.525,342.406L46.454,340.489L47.895,338.239L47.631,336.66L48.637,334.867L48.312,333.401L47.906,333.223L49.56,329.934L49.763,328.142L48.393,326.854L47.895,327.151L46.393,325.661L45.916,324.551L46.911,322.936L47.327,321.244L46.911,320.051L45.286,319.339L44.078,316.923L43.449,314.697L41.591,313.278L41.307,312.269L41.418,310.643L39.754,307.752L39.733,305.021L38.698,304.232L38.21,301.893L37.175,299.685L35.723,298.355L34.83,296.117L35.094,294.669L35.043,292.188L35.662,290.591L35.145,289.902L36.271,288.988L36.677,289.878L38.129,288.97L39.672,285.907L39.175,282.731L38.282,281.378L37.398,281.699L35.104,281.016L33.733,279.247L32.657,276.499L32.129,276.327L31.957,274.955L31.449,274.267L31.551,273.038L32.546,270.687L32.292,268.782L32.434,267.761L31.581,266.544L32.962,263.006L33.256,260.84L35.277,260.691L35.337,262.525L34.87,263.048L34.546,264.621L34.708,265.743L36.251,266.651L37.439,268.622L37.946,268.675L38.485,270.1L39.266,270.26L38.444,268.823L38.332,266.871L38.556,265.036L37.459,263.44L37.733,262.763L36.414,261.671L37.317,260.406L37.297,259.017L36.211,258.602L35.845,257.236L37.002,257.207L37.165,256.548L38.342,256.809L39.205,256.251L38.921,254.731L37.601,253.443L35.713,253.746L35.043,255.669L35.662,256.672L34.83,256.91L34.383,257.64L35.185,259.005L34.2,258.424L34.231,259.89L33.246,259.925L32.901,259.047L31.612,257.42L30.759,257.432L29.754,255.77L29.399,254.583L28.546,253.651L27.612,253.224L26.769,253.918L26.211,253.491L27.764,251.336L28.292,250.268L28.018,248.534L28.485,247.846L27.967,246.676L27.246,246.664L27.541,245.37L27.094,243.079L25.449,241.15L24.414,239.541L23.226,235.57L20.942,231.819L20.109,229.848L20.13,228.975L21.378,227.74L21.561,226.933L21.186,221.525L21.409,219.442L22.109,217.792L23.612,215.702L23.612,214.462L24.048,212.693L23.693,211.654L24.048,209.155L23.328,208.193L23.267,207.059L22.211,204.264L21.592,203.682L21.581,201.907L20.495,200.934L18.485,197.194L19.104,196.096L19.206,194.256L18.922,193.086L19.906,191.448L21.429,189.59L24.779,186.094L26.637,183.779L27.723,181.659L27.216,180.9L27.734,178.917L29.155,177.279L31.256,172.898L31.673,170.44L31.622,165.828L31.175,165.787L30.444,164.445L31.916,162.379L32.596,159.951Z';

if ( isset( $us_map_states[ $current_state_code ] ) ) {
    $active_st_viewbox = isset( $us_map_states[ $current_state_code ]['viewBox'] ) ? $us_map_states[ $current_state_code ]['viewBox'] : $active_st_viewbox;
    $active_st_path    = isset( $us_map_states[ $current_state_code ]['path'] ) ? $us_map_states[ $current_state_code ]['path'] : $active_st_path;
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
                    <span class="state-icon-wrap" id="headerStateIconWrap" aria-hidden="true">
                        <svg class="state-us-svg" id="headerStateSvg" width="20" height="18" viewBox="<?php echo esc_attr( $active_st_viewbox ); ?>" fill="currentColor">
                            <path id="headerStatePath" d="<?php echo esc_attr( $active_st_path ); ?>"/>
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
                                        $st_vb = isset( $us_map_states[ $st_code ]['viewBox'] ) ? $us_map_states[ $st_code ]['viewBox'] : '0 0 975 610';
                                        $st_path = isset( $us_map_states[ $st_code ]['path'] ) ? $us_map_states[ $st_code ]['path'] : '';
                                    ?>
                                        <a href="<?php echo esc_url( $st_url ); ?>" 
                                           class="state-mega-link <?php echo esc_attr( $is_active ); ?>" 
                                           data-state-slug="<?php echo esc_attr( $st_data['slug'] ); ?>"
                                           data-state-name="<?php echo esc_attr( $st_data['name'] ); ?>"
                                           data-state-code="<?php echo esc_attr( $st_code ); ?>"
                                           data-state-viewbox="<?php echo esc_attr( $st_vb ); ?>"
                                           data-state-path="<?php echo esc_attr( $st_path ); ?>"
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

</header><!-- #masthead -->

<!-- Mobile Slide-Up State & Vehicle Picker Sheet (Global Drawer) -->
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
                    $st_vb = isset( $us_map_states[ $st_code ]['viewBox'] ) ? $us_map_states[ $st_code ]['viewBox'] : '0 0 975 610';
                    $st_path = isset( $us_map_states[ $st_code ]['path'] ) ? $us_map_states[ $st_code ]['path'] : '';
                ?>
                    <a href="<?php echo esc_url( $st_url ); ?>" 
                       class="mobile-modal-state-link <?php echo esc_attr( $is_active ); ?>" 
                       data-state-code="<?php echo esc_attr( $st_code ); ?>"
                       data-state-name="<?php echo esc_attr( $st_data['name'] ); ?>"
                       data-state-slug="<?php echo esc_attr( $st_data['slug'] ); ?>"
                       data-state-viewbox="<?php echo esc_attr( $st_vb ); ?>"
                       data-state-path="<?php echo esc_attr( $st_path ); ?>">
                        <span class="m-st-code"><?php echo esc_html( $st_code ); ?></span>
                        <span class="m-st-name"><?php echo esc_html( $st_data['name'] ); ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div><!-- .mobile-modal-sheet -->
</div><!-- #mobileStateVehModal -->
