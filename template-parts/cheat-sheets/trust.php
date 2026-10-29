<?php
/**
 * Trust Strip Section Template Part for Cheat Sheet Product Page
 *
 * Section ID: #trust
 * Desktop: 5 items in one horizontal row, centered, with rounded light teal icon badges
 * Mobile: 2-column grid
 *
 * Items:
 * 1. Book icon: "Built from the official [State] handbook"
 * 2. Download icon: "Instant PDF download"
 * 3. 30-day clock/guarantee icon: "[XX]-day money-back guarantee"
 * 4. Padlock icon: "Secure checkout"
 * 5. Shield icon: "Not affiliated with any state DMV"
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// State context
$current_state_slug = get_query_var( 'drive_state' );
if ( empty( $current_state_slug ) ) {
    $current_state_slug = 'california';
}

$all_states         = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$current_state_name = 'California';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_name = $data['name'];
        break;
    }
}

$guarantee_days = '30';
?>

<section id="trust" class="cheat-trust-section" aria-label="<?php esc_attr_e( 'Trust and Guarantees', 'drive' ); ?>">
    <div class="site-container cheat-trust-container">
        
        <div class="cheat-trust-grid">
            
            <!-- Item 1: Official Handbook -->
            <div class="cheat-trust-item">
                <div class="trust-icon-box" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00796F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                </div>
                <span class="trust-item-text">
                    <?php 
                    printf(
                        /* translators: %s: State name */
                        esc_html__( 'Built from the official %s handbook', 'drive' ),
                        esc_html( $current_state_name )
                    );
                    ?>
                </span>
            </div>

            <!-- Item 2: Instant PDF Download -->
            <div class="cheat-trust-item">
                <div class="trust-icon-box" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00796F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="7 10 12 15 17 10"/>
                        <line x1="12" y1="15" x2="12" y2="3"/>
                    </svg>
                </div>
                <span class="trust-item-text">
                    <?php esc_html_e( 'Instant PDF download', 'drive' ); ?>
                </span>
            </div>

            <!-- Item 3: Money-Back Guarantee -->
            <div class="cheat-trust-item">
                <div class="trust-icon-box" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00796F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5"/>
                        <path d="M12 7v5l3 3"/>
                    </svg>
                </div>
                <span class="trust-item-text">
                    <?php printf( esc_html__( '%s-day money-back guarantee', 'drive' ), esc_html( $guarantee_days ) ); ?>
                </span>
            </div>

            <!-- Item 4: Secure Checkout -->
            <div class="cheat-trust-item">
                <div class="trust-icon-box" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00796F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <span class="trust-item-text">
                    <?php esc_html_e( 'Secure checkout', 'drive' ); ?>
                </span>
            </div>

            <!-- Item 5: DMV Disclaimer -->
            <div class="cheat-trust-item">
                <div class="trust-icon-box" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00796F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <polyline points="9 12 11 14 15 10"/>
                    </svg>
                </div>
                <span class="trust-item-text">
                    <?php esc_html_e( 'Not affiliated with any state DMV', 'drive' ); ?>
                </span>
            </div>

        </div><!-- .cheat-trust-grid -->

    </div><!-- .cheat-trust-container -->
</section>

