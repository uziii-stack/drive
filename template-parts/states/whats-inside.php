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
                
                <!-- Feature 1: 150 must-know questions (Clipboard Check) -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="5" y="4" width="14" height="17" rx="3" ry="3"></rect>
                            <path d="M9 2h6a1 1 0 0 1 1 1v1H8V3a1 1 0 0 1 1-1z"></path>
                            <polyline points="9 13 11 15 15 10"></polyline>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <span class="feature-highlight" id="insideQuestionCount"><?php echo esc_html( $q_count ); ?></span> <?php esc_html_e( 'must–know questions', 'drive' ); ?>
                    </div>
                </div>

                <!-- Feature 2: Answers with explanations (Speech / Message Bubble) -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            <line x1="8" y1="9" x2="16" y2="9"></line>
                            <line x1="8" y1="13" x2="13" y2="13"></line>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <?php esc_html_e( 'Answers with explanations', 'drive' ); ?>
                    </div>
                </div>

                <!-- Feature 3: Every road sign explained (Octagon / No-Entry / Stop Sign) -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                    </div>
                    <div class="feature-text">
                        <?php esc_html_e( 'Every road sign explained', 'drive' ); ?>
                    </div>
                </div>

                <!-- Feature 4: Demerit points explained (Shield with Exclamation) -->
                <div class="inside-feature-card">
                    <div class="feature-icon-badge" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
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
