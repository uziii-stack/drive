<?php
/**
 * Template part for displaying "All [State] Cheat Sheets" section on State Pages
 *
 * Implements the 3-column card grid matching the screenshot reference:
 * - Eyebrow: "CHEAT SHEETS" in bold teal uppercase
 * - Heading: "All [State] cheat sheets"
 * - 3 Cards (Car, Motorcycle, Truck CDL):
 *   - Top light rounded panel with 3D realistic cheat sheet book cover mockup
 *   - Vehicle category tag with teal icon: "CAR", "MOTORCYCLE", "TRUCK (CDL)"
 *   - Card Title: "[State] Car Cheat Sheet", "[State] Motorcycle Cheat Sheet", "[State] Truck CDL Cheat Sheet"
 *   - Description text tailored to the vehicle type
 *   - Teal underlined link with arrow: "Get Your Cheat Sheet →"
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

$sheets = array(
    'car' => array(
        'type'        => 'car',
        'badge'       => __( 'CAR', 'drive' ),
        'title'       => sprintf( __( '%s Car Cheat Sheet', 'drive' ), $current_state_name ),
        'desc'        => __( 'Road signs, right-of-way, speed limits, and the key rules for your car permit.', 'drive' ),
        'count'       => '150',
        'sub'         => __( 'Important Permit Test Questions', 'drive' ),
        'url'         => home_url( '/' . esc_attr( $current_state_slug ) . '/car-cheatsheet/' ),
        'accent'      => 'orange',
        'vehicle_art' => 'car',
    ),
    'motorcycle' => array(
        'type'        => 'motorcycle',
        'badge'       => __( 'MOTORCYCLE', 'drive' ),
        'title'       => sprintf( __( '%s Motorcycle Cheat Sheet', 'drive' ), $current_state_name ),
        'desc'        => __( 'Lane position, protective gear and the rules for your motorcycle permit.', 'drive' ),
        'count'       => '150',
        'sub'         => __( 'Important Motorcycle Test Questions', 'drive' ),
        'url'         => home_url( '/' . esc_attr( $current_state_slug ) . '/motorcycle-cheatsheet/' ),
        'accent'      => 'orange',
        'vehicle_art' => 'motorcycle',
    ),
    'cdl' => array(
        'type'        => 'cdl',
        'badge'       => __( 'TRUCK (CDL)', 'drive' ),
        'title'       => sprintf( __( '%s Truck CDL Cheat Sheet', 'drive' ), $current_state_name ),
        'desc'        => __( 'General knowledge, air brakes, and the rules you need for your CDL permit.', 'drive' ),
        'count'       => '250',
        'sub'         => __( 'Important CDL Test Questions', 'drive' ),
        'url'         => home_url( '/' . esc_attr( $current_state_slug ) . '/cdl-cheatsheet/' ),
        'accent'      => 'cdl',
        'vehicle_art' => 'truck',
    ),
);
?>

<section class="state-all-sheets-section" aria-labelledby="all-sheets-heading">
    <div class="site-container all-sheets-container">
        
        <!-- Header -->
        <div class="all-sheets-header">
            <span class="all-sheets-eyebrow"><?php esc_html_e( 'CHEAT SHEETS', 'drive' ); ?></span>
            <h2 id="all-sheets-heading" class="all-sheets-title">
                <?php 
                printf(
                    /* translators: %s: State name */
                    esc_html__( 'All %s cheat sheets', 'drive' ),
                    esc_html( $current_state_name )
                ); 
                ?>
            </h2>
        </div>

        <!-- 3-Card Grid -->
        <div class="all-sheets-grid">
            <?php foreach ( $sheets as $sheet_key => $sheet ) : ?>
                <article class="sheet-catalog-card card-type-<?php echo esc_attr( $sheet_key ); ?>">
                    
                    <!-- Top Visual Container with Mockup -->
                    <div class="sheet-card-stage">
                        <div class="catalog-cover-mockup">
                            
                            <div class="cover-inner">
                                <div class="cover-header">
                                    <div class="cover-brand">
                                        <div class="cover-mini-logo"></div>
                                        <div class="cover-brand-text">
                                            <span>DMV Learners</span>
                                            <span>Permit Test</span>
                                        </div>
                                    </div>
                                    <div class="cover-pill-tag"><?php esc_html_e( 'THE CHEAT SHEET', 'drive' ); ?></div>
                                </div>

                                <div class="cover-title-area">
                                    <span class="cover-state"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                    <span class="cover-count <?php echo ( $sheet['accent'] === 'cdl' ) ? 'count-yellow' : 'count-orange'; ?>">
                                        <?php echo esc_html( $sheet['count'] ); ?>
                                    </span>
                                    <span class="cover-subtitle"><?php echo esc_html( $sheet['sub'] ); ?></span>
                                </div>

                                <!-- Intersection Aerial Artwork -->
                                <div class="cover-art-box">
                                    <div class="intersection-scene">
                                        <div class="road-surface-v"></div>
                                        <div class="road-surface-h"></div>
                                        <div class="crosswalk-stripes n"></div>
                                        <div class="crosswalk-stripes s"></div>

                                        <?php if ( $sheet['vehicle_art'] === 'car' ) : ?>
                                            <div class="aerial-car teal-sedan">
                                                <div class="windshield"></div>
                                            </div>
                                        <?php elseif ( $sheet['vehicle_art'] === 'motorcycle' ) : ?>
                                            <div class="aerial-moto"></div>
                                        <?php elseif ( $sheet['vehicle_art'] === 'truck' ) : ?>
                                            <div class="aerial-semi-truck">
                                                <div class="truck-cab"></div>
                                                <div class="truck-trailer"></div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="intersection-light tr"></div>
                                        <div class="mini-stop-sign">STOP</div>
                                    </div>
                                </div>

                                <div class="cover-footer-bar">
                                    <span>dmvlearnerspermittest.com</span>
                                </div>
                            </div>

                        </div><!-- .catalog-cover-mockup -->
                    </div><!-- .sheet-card-stage -->

                    <!-- Bottom Details -->
                    <div class="sheet-card-details">
                        
                        <!-- Category Tag with Teal Icon -->
                        <div class="sheet-category-tag">
                            <span class="cat-icon" aria-hidden="true">
                                <?php if ( $sheet_key === 'car' ) : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/>
                                        <circle cx="7" cy="15" r="1.5" fill="currentColor"/>
                                        <circle cx="17" cy="15" r="1.5" fill="currentColor"/>
                                    </svg>
                                <?php elseif ( $sheet_key === 'motorcycle' ) : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="5.5" cy="17.5" r="3.5"/>
                                        <circle cx="18.5" cy="17.5" r="3.5"/>
                                        <path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/>
                                        <path d="M12 17.5V14l-3-4"/>
                                        <path d="M5.5 17.5L9 12"/>
                                    </svg>
                                <?php else : ?>
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M2 4h12v12H2z"/>
                                        <path d="M14 9h4l3 3v4h-7V9z"/>
                                        <circle cx="5.5" cy="18.5" r="2.5"/>
                                        <circle cx="18.5" cy="18.5" r="2.5"/>
                                    </svg>
                                <?php endif; ?>
                            </span>
                            <span class="cat-label"><?php echo esc_html( $sheet['badge'] ); ?></span>
                        </div>

                        <!-- Title -->
                        <h3 class="sheet-item-title">
                            <a href="<?php echo esc_url( $sheet['url'] ); ?>">
                                <?php echo esc_html( $sheet['title'] ); ?>
                            </a>
                        </h3>

                        <!-- Description -->
                        <p class="sheet-item-desc">
                            <?php echo esc_html( $sheet['desc'] ); ?>
                        </p>

                        <!-- Action Link with underline and arrow -->
                        <div class="sheet-item-action">
                            <a href="<?php echo esc_url( $sheet['url'] ); ?>" class="sheet-action-link">
                                <span><?php esc_html_e( 'Get Your Cheat Sheet', 'drive' ); ?></span>
                                <span class="link-arrow" aria-hidden="true">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 10h10M11 6l4 4-4 4"/>
                                    </svg>
                                </span>
                            </a>
                        </div>

                    </div><!-- .sheet-card-details -->

                </article>
            <?php endforeach; ?>
        </div><!-- .all-sheets-grid -->

    </div><!-- .all-sheets-container -->
</section><!-- .state-all-sheets-section -->
