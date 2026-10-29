<?php
/**
 * Other Cheat Sheets Section Template Part
 *
 * Section ID: #other-sheets
 *
 * Matches the bottom half of the screenshot:
 * - Eyebrow: "OTHER [STATE] CHEAT SHEETS" (Teal uppercase)
 * - Title: "Riding or driving something else?" (Charcoal #2B2D42)
 * - 2-Card Grid:
 *   - Card 1: Motorcycle Cheat Sheet
 *     - Left: Angled mini Motorcycle cheat sheet cover mockup
 *     - Right:
 *       - Badge: Motorcycle icon + "MOTORCYCLE" (Teal)
 *       - Heading: "[State] Motorcycle Cheat Sheet"
 *       - Desc: "Lane position, protective gear and the rules for your motorcycle permit."
 *       - Link: "Get Your Cheat Sheet →"
 *   - Card 2: Truck (CDL) Cheat Sheet
 *     - Left: Angled mini CDL cheat sheet cover mockup
 *     - Right:
 *       - Badge: Truck icon + "TRUCK (CDL)" (Teal)
 *       - Heading: "[State] Truck CDL Cheat Sheet"
 *       - Desc: "General knowledge, air brakes and the rules you need for your CDL permit."
 *       - Link: "Get Your Cheat Sheet →"
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Current context
$current_state_slug = get_query_var( 'drive_state' );
$current_vehicle    = get_query_var( 'drive_vehicle' );

if ( empty( $current_state_slug ) ) {
    $current_state_slug = 'california';
}
if ( empty( $current_vehicle ) ) {
    $current_vehicle = 'car';
}

$vehicle_key = strtolower( trim( $current_vehicle ) );
if ( 'truck' === $vehicle_key ) {
    $vehicle_key = 'cdl';
}

$all_states         = function_exists( 'drive_get_all_states' ) ? drive_get_all_states() : array();
$current_state_name = 'California';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_name = $data['name'];
        break;
    }
}

// Prepare the two OTHER vehicles
$all_vehicle_options = array(
    'car' => array(
        'slug'       => 'car-cheat-sheet',
        'badge'      => __( 'CAR', 'drive' ),
        'title'      => sprintf( __( '%s Car Permit Cheat Sheet', 'drive' ), $current_state_name ),
        'desc'       => __( 'Right-of-way, road signs and the rules you need to pass your driver permit test.', 'drive' ),
        'count'      => '150',
        'cover_photo'=> 'intersection-aerial.jpg',
        'icon'       => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 11l1.5-5.5A2 2 0 0 1 8.4 4h7.2a2 2 0 0 1 1.9 1.5L19 11M3 11h18v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6z"/><circle cx="7" cy="15" r="1.5" fill="currentColor"/><circle cx="17" cy="15" r="1.5" fill="currentColor"/></svg>',
    ),
    'motorcycle' => array(
        'slug'       => 'motorcycle-cheat-sheet',
        'badge'      => __( 'MOTORCYCLE', 'drive' ),
        'title'      => sprintf( __( '%s Motorcycle Cheat Sheet', 'drive' ), $current_state_name ),
        'desc'       => __( 'Lane position, protective gear and the rules for your motorcycle permit.', 'drive' ),
        'count'      => '150',
        'cover_photo'=> 'intersection-motorcycle.jpg',
        'icon'       => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="5.5" cy="17.5" r="3.5"/><circle cx="18.5" cy="17.5" r="3.5"/><path d="M15 6h-3l-4 6h7.5l2-3.5L19 9"/><path d="M12 17.5V14l-3-4"/><path d="M5.5 17.5L9 12"/></svg>',
    ),
    'cdl' => array(
        'slug'       => 'cdl-cheat-sheet',
        'badge'      => __( 'TRUCK (CDL)', 'drive' ),
        'title'      => sprintf( __( '%s Truck CDL Cheat Sheet', 'drive' ), $current_state_name ),
        'desc'       => __( 'General knowledge, air brakes and the rules you need for your CDL permit.', 'drive' ),
        'count'      => '250',
        'cover_photo'=> 'intersection-cdl.jpg',
        'icon'       => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#00B4A6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4h12v12H2z"/><path d="M14 9h4l3 3v4h-7V9z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>',
    ),
);

// Filter out current vehicle so only other 2 are displayed
$other_vehicles = array();
foreach ( $all_vehicle_options as $key => $opt ) {
    if ( $key !== $vehicle_key ) {
        $other_vehicles[ $key ] = $opt;
    }
}
?>

<section id="other-sheets" class="cheat-other-section" aria-labelledby="other-sheets-heading">
    <div class="site-container cheat-other-container">
        
        <!-- Header -->
        <div class="other-header">
            <span class="other-eyebrow">
                <?php 
                printf(
                    /* translators: %s: State name */
                    esc_html__( 'OTHER %s CHEAT SHEETS', 'drive' ),
                    esc_html( strtoupper( $current_state_name ) )
                ); 
                ?>
            </span>
            <h2 id="other-sheets-heading" class="other-title"><?php esc_html_e( 'Riding or driving something else?', 'drive' ); ?></h2>
        </div>

        <!-- 2-Card Grid -->
        <div class="other-cards-grid">
            <?php foreach ( $other_vehicles as $veh_slug_key => $item ) : 
                $card_link = home_url( '/' . esc_attr( $current_state_slug ) . '/' . esc_attr( $item['slug'] ) . '/' );
            ?>
                <div class="other-sheet-card">
                    
                    <!-- Left: Mini Cheat Sheet Mockup -->
                    <div class="other-mockup-wrap" aria-hidden="true">
                        <div class="catalog-cover-mockup other-cover-mockup">
                            <div class="sheet-inner client-cover-style">
                                <div class="cover-dashed-arc" aria-hidden="true"></div>
                                <div class="sheet-header">
                                    <div class="sheet-brand">
                                        <div class="sheet-brand-text">
                                            <span class="brand-top">DMV Learners</span>
                                            <span class="brand-bot">Permit <strong class="brand-test-orange">Test</strong></span>
                                        </div>
                                    </div>
                                    <div class="sheet-pill-tag"><?php echo esc_html( $item['badge'] ); ?></div>
                                </div>
                                <div class="sheet-title-area">
                                    <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                    <div class="sheet-big-num orange-accent"><?php echo esc_html( $item['count'] ); ?></div>
                                    <span class="sheet-main-title"><?php esc_html_e( 'Important Test Questions', 'drive' ); ?></span>
                                    <div class="title-orange-underline"></div>
                                </div>
                                <div class="sheet-graphic-preview has-photo">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $item['cover_photo'] ); ?>" alt="" class="aerial-photo-img" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Info & Link -->
                    <div class="other-info-wrap">
                        <div class="other-veh-badge">
                            <?php echo $item['icon']; // SVG ?>
                            <span class="other-veh-label"><?php echo esc_html( $item['badge'] ); ?></span>
                        </div>

                        <h3 class="other-card-title"><?php echo esc_html( $item['title'] ); ?></h3>
                        <p class="other-card-desc"><?php echo esc_html( $item['desc'] ); ?></p>

                        <a href="<?php echo esc_url( $card_link ); ?>" class="other-card-link">
                            <span><?php esc_html_e( 'Get Your Cheat Sheet', 'drive' ); ?></span>
                            <span class="link-arrow" aria-hidden="true">→</span>
                        </a>
                    </div>

                </div><!-- .other-sheet-card -->
            <?php endforeach; ?>
        </div><!-- .other-cards-grid -->

    </div><!-- .cheat-other-container -->
</section>

