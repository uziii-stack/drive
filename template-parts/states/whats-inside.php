<?php
/**
 * Template part for displaying "What's Inside" cheat sheet bar on State Pages
 *
 * Implements the sleek dark bar matching the reference screenshot:
 * - Left column:
 *   - Eyebrow: "WHAT'S INSIDE" (Teal uppercase)
 *   - Heading: "Everything in your [Vehicle] cheat sheet"
 * - 4 Feature Cards (Charcoal cards with teal rounded square icon badge & white text):
 *   1. [Question Count / 150] must-know questions
 *   2. Answers with explanations
 *   3. Every road sign explained
 *   4. Demerit points explained
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

// Determine vehicle context
$current_veh = 'car';
if ( isset( $_GET['veh'] ) && ! empty( $_GET['veh'] ) ) {
    $req_veh = sanitize_title( wp_unslash( $_GET['veh'] ) );
    if ( in_array( $req_veh, array( 'car', 'motorcycle', 'cdl' ), true ) ) {
        $current_veh = $req_veh;
    }
}

$veh_name = ( $current_veh === 'motorcycle' ) ? __( 'Motorcycle', 'drive' ) : ( ( $current_veh === 'cdl' ) ? __( 'CDL', 'drive' ) : __( 'Car', 'drive' ) );
$q_count  = ( $current_veh === 'cdl' ) ? '250' : '150';
?>

<section class="state-whats-inside-section" aria-label="<?php esc_attr_e( 'What is inside the cheat sheet', 'drive' ); ?>">
    <div class="site-container whats-inside-container">
        
        <div class="whats-inside-inner">
            
            <!-- Left Header -->
            <div class="whats-inside-heading-col">
                <span class="whats-inside-eyebrow"><?php esc_html_e( "WHAT'S INSIDE", 'drive' ); ?></span>
                <h2 class="whats-inside-title">
                    <span class="inside-title-text"><?php echo esc_html( sprintf( __( 'Everything in your %s cheat sheet', 'drive' ), $veh_name ) ); ?></span>
                </h2>
            </div>

            <!-- Right: 4 Horizontal Feature Badges -->
            <div class="whats-inside-features-grid">
                
                <!-- Feature 1: Must-Know Questions -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <span class="feature-highlight" id="insideQuestionCount"><?php echo esc_html( $q_count ); ?></span> <?php esc_html_e( 'must-know questions', 'drive' ); ?>
                    </div>
                </div>

                <!-- Feature 2: Answers with Explanations -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <?php esc_html_e( 'Answers with explanations', 'drive' ); ?>
                    </div>
                </div>

                <!-- Feature 3: Every Road Sign Explained -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" transform="rotate(45 12 12)"></rect>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <?php esc_html_e( 'Every road sign explained', 'drive' ); ?>
                    </div>
                </div>

                <!-- Feature 4: Demerit Points Explained -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <?php esc_html_e( 'Demerit points explained', 'drive' ); ?>
                    </div>
                </div>

            </div><!-- .whats-inside-features-grid -->

        </div><!-- .whats-inside-inner -->

    </div><!-- .whats-inside-container -->
</section><!-- .state-whats-inside-section -->
