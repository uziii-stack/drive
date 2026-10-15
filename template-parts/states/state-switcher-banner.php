<?php
/**
 * Template part for displaying "Not in [State]?" switcher box on State Pages
 *
 * Implements the rounded border banner matching the reference screenshot:
 * - Rounded container box with crisp dark border
 * - Left side:
 *   - Heading: "Not in [State]?" (Dynamic state name)
 *   - Quick-access State Chips (Adjacent/popular states, excluding the current state)
 * - Right side:
 *   - Clean state select dropdown: "Choose another state..."
 *   - Dark navy button: "Go" (redirects immediately to the selected state)
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

// Find current state name
$current_state_name = 'California';
foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug ) {
        $current_state_name = $data['name'];
        break;
    }
}

// State chip recommendations tailored to the state / top popular states
$popular_chips_map = array(
    'california' => array( 'oregon', 'nevada', 'arizona', 'texas', 'florida', 'new-york' ),
    'texas'      => array( 'oklahoma', 'louisiana', 'new-mexico', 'california', 'florida', 'new-york' ),
    'florida'    => array( 'georgia', 'alabama', 'texas', 'california', 'new-york', 'north-carolina' ),
    'new-york'   => array( 'new-jersey', 'connecticut', 'pennsylvania', 'california', 'florida', 'texas' ),
);

$selected_chip_slugs = isset( $popular_chips_map[ $current_state_slug ] )
    ? $popular_chips_map[ $current_state_slug ]
    : array( 'california', 'texas', 'florida', 'new-york', 'pennsylvania', 'illinois' );

// Filter out current state from chips
$state_chips = array();
foreach ( $selected_chip_slugs as $c_slug ) {
    if ( $c_slug === $current_state_slug ) {
        continue;
    }
    foreach ( $all_states as $code => $data ) {
        if ( $data['slug'] === $c_slug ) {
            $state_chips[] = $data;
            break;
        }
    }
}
?>

<section class="state-switcher-banner-section" aria-label="<?php esc_attr_e( 'Choose another state', 'drive' ); ?>">
    <div class="site-container state-switcher-container">
        
        <div class="state-switcher-card">
            
            <!-- Left: Title & Quick State Chips -->
            <div class="switcher-left-col">
                <h2 class="switcher-title">
                    <?php 
                    printf(
                        /* translators: %s: State name */
                        esc_html__( 'Not in %s?', 'drive' ),
                        esc_html( $current_state_name )
                    ); 
                    ?>
                </h2>

                <div class="switcher-chips-list" role="list">
                    <?php foreach ( $state_chips as $chip_st ) : 
                        $chip_url = function_exists( 'drive_get_state_url' ) ? drive_get_state_url( $chip_st['slug'] ) : home_url( '/' . esc_attr( $chip_st['slug'] ) . '/' );
                    ?>
                        <a href="<?php echo esc_url( $chip_url ); ?>" class="state-quick-chip" role="listitem">
                            <?php echo esc_html( $chip_st['name'] ); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right: Dropdown + Go Button -->
            <div class="switcher-right-col">
                <form class="switcher-select-form" onsubmit="event.preventDefault(); var sel = document.getElementById('stateSwitcherSelect'); if (sel && sel.value) { window.location.href = sel.value; }">
                    <label for="stateSwitcherSelect" class="screen-reader-text"><?php esc_html_e( 'Choose another state', 'drive' ); ?></label>
                    <div class="switcher-select-wrap">
                        <select id="stateSwitcherSelect" class="switcher-select-dropdown" aria-label="<?php esc_attr_e( 'Choose another state', 'drive' ); ?>">
                            <option value="" disabled selected><?php esc_html_e( 'Choose another state...', 'drive' ); ?></option>
                            <?php foreach ( $all_states as $st_code => $st_data ) : 
                                if ( $st_data['slug'] === $current_state_slug ) continue;
                                $target_url = function_exists( 'drive_get_state_url' ) ? drive_get_state_url( $st_data['slug'] ) : home_url( '/' . esc_attr( $st_data['slug'] ) . '/' );
                            ?>
                                <option value="<?php echo esc_url( $target_url ); ?>">
                                    <?php echo esc_html( $st_data['name'] ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="select-arrow" aria-hidden="true">
                            <svg width="10" height="10" viewBox="0 0 12 12" fill="none">
                                <path d="M2.5 4.5L6 8L9.5 4.5" stroke="#64748b" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>

                    <button type="submit" class="btn-switcher-go" id="btnSwitcherGo">
                        <?php esc_html_e( 'Go', 'drive' ); ?>
                    </button>
                </form>
            </div>

        </div><!-- .state-switcher-card -->

    </div><!-- .site-container -->
</section><!-- .state-switcher-banner-section -->
