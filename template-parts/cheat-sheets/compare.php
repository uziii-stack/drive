<?php
/**
 * Cheat Sheet vs Handbook Section Template Part
 *
 * Section ID: #compare
 *
 * Implements the interactive comparison card matching the screenshot:
 * - Eyebrow: "CHEAT SHEET VS HANDBOOK" (Teal)
 * - Heading: "Which one do you need?" (Charcoal #2B2D42)
 * - Subtitle: "Both. The handbook is the full source. The cheat sheet is how you review it."
 * - Segmented Toggle Switch:
 *   - Tab 1: "Official handbook" (with book icon)
 *   - Tab 2: "Our cheat sheet" (with document/sheet icon, active dark pill by default)
 * - Large Rounded Card (White, border, shadow):
 *   - Left: Mockup (when "Our cheat sheet" active: angled cheat sheet cover mockup; when "Official handbook" active: official handbook cover mockup)
 *   - Right:
 *     - Title: "Our cheat sheet" / "Official handbook"
 *     - 4 Bullet points with dark round badges & teal checkmarks
 *       - Cheat sheet:
 *         1. Key rules + [150/250] questions with answers
 *         2. Road signs all together, each one explained
 *         3. Made for a quick review before your test
 *         4. $[XX] one-time
 *       - Handbook:
 *         1. Comprehensive full driver handbook ([XX]+ pages)
 *         2. Official state traffic laws and driving statutes
 *         3. Thorough in-depth study material
 *         4. Free from your state DMV
 *     - Orange CTA button: "Get Your Cheat Sheet →" (scrolls to #pricing) / "Download Free Handbook"
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
$current_state_code = 'CA';

foreach ( $all_states as $code => $data ) {
    if ( $data['slug'] === $current_state_slug || strtolower( $code ) === strtolower( $current_state_slug ) ) {
        $current_state_name = $data['name'];
        $current_state_code = strtoupper( $code );
        break;
    }
}

$question_count = ( 'cdl' === $vehicle_key ) ? '250' : '150';
$price_display  = '$14'; // Configurable / dynamic token

$vehicle_labels = array(
    'car'        => array(
        'name'        => __( 'Car', 'drive' ),
        'tag'         => __( 'CAR CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-aerial.jpg',
        'sub_title'   => __( 'Important Permit Test Questions', 'drive' ),
    ),
    'motorcycle' => array(
        'name'        => __( 'Motorcycle', 'drive' ),
        'tag'         => __( 'MOTORCYCLE CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-motorcycle.jpg',
        'sub_title'   => __( 'Important Motorcycle Test Questions', 'drive' ),
    ),
    'cdl'        => array(
        'name'        => __( 'Truck (CDL)', 'drive' ),
        'tag'         => __( 'TRUCK (CDL) CHEAT SHEET', 'drive' ),
        'cover_photo' => 'intersection-cdl.jpg',
        'sub_title'   => __( 'Important CDL Test Questions', 'drive' ),
    ),
);
$curr_data     = isset( $vehicle_labels[ $vehicle_key ] ) ? $vehicle_labels[ $vehicle_key ] : $vehicle_labels['car'];
$site_logo_src = function_exists( 'drive_get_site_logo_src' ) ? drive_get_site_logo_src() : '';
?>

<section id="compare" class="cheat-compare-section" aria-labelledby="compare-heading">
    <div class="site-container cheat-compare-container">
        
        <!-- Header -->
        <div class="compare-header">
            <span class="compare-eyebrow"><?php esc_html_e( 'CHEAT SHEET VS HANDBOOK', 'drive' ); ?></span>
            <h2 id="compare-heading" class="compare-title"><?php esc_html_e( 'Which one do you need?', 'drive' ); ?></h2>
            <p class="compare-lead">
                <?php esc_html_e( 'Both. The handbook is the full source. The cheat sheet is how you review it.', 'drive' ); ?>
            </p>
        </div>

        <!-- Segmented Toggle Tabs -->
        <div class="compare-toggle-bar" role="tablist" aria-label="<?php esc_attr_e( 'Comparison selector', 'drive' ); ?>">
            <button type="button" 
                    class="compare-toggle-btn" 
                    id="tabHandbook" 
                    data-target="panelHandbook" 
                    role="tab" 
                    aria-selected="false">
                <svg class="toggle-btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                </svg>
                <span><?php esc_html_e( 'Official handbook', 'drive' ); ?></span>
            </button>

            <button type="button" 
                    class="compare-toggle-btn is-active" 
                    id="tabCheatsheet" 
                    data-target="panelCheatsheet" 
                    role="tab" 
                    aria-selected="true">
                <svg class="toggle-btn-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
                <span><?php esc_html_e( 'Our cheat sheet', 'drive' ); ?></span>
            </button>
        </div>

        <!-- Main Display Card Stage -->
        <div class="compare-card-stage">
            
            <!-- PANEL 1: OUR CHEAT SHEET (Active by Default) -->
            <div class="compare-panel is-active" id="panelCheatsheet" role="tabpanel" aria-labelledby="tabCheatsheet">
                
                <!-- Left: Scaled Angled Cover Card Mockup -->
                <div class="compare-mockup-col">
                    <div class="compare-cover-wrapper">
                        <div class="catalog-cover-mockup compare-cover-mockup">
                            <div class="sheet-inner client-cover-style">
                                <div class="cover-dashed-arc" aria-hidden="true"></div>

                                <!-- Header -->
                                <div class="sheet-header">
                                    <div class="sheet-brand">
                                        <div class="sheet-brand-logo-icon">
                                            <?php if ( ! empty( $site_logo_src ) ) : ?>
                                                <img src="<?php echo esc_url( $site_logo_src ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="custom-logo-img" width="18" height="18" />
                                            <?php else : ?>
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z" fill="#00B4A6" opacity="0.3"/>
                                                    <path d="M10 17l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" fill="#00B4A6"/>
                                                    <circle cx="6" cy="18" r="1.5" fill="#F26419"/>
                                                    <circle cx="9" cy="19" r="1.5" fill="#F26419"/>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                        <div class="sheet-brand-text">
                                            <span class="brand-top">DMV Learners</span>
                                            <span class="brand-bot">Permit <strong class="brand-test-orange">Test</strong></span>
                                        </div>
                                    </div>
                                    <div class="sheet-pill-tag <?php echo esc_attr( $vehicle_key ); ?>-tag"><?php echo esc_html( $curr_data['tag'] ); ?></div>
                                </div>

                                <!-- Title Area -->
                                <div class="sheet-title-area">
                                    <span class="sheet-state-name state-teal-title"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                    <div class="sheet-big-num orange-accent"><?php echo esc_html( $question_count ); ?></div>
                                    <span class="sheet-main-title"><?php echo esc_html( $curr_data['sub_title'] ); ?></span>
                                    <div class="title-orange-underline"></div>
                                </div>

                                <!-- Photo / Artwork -->
                                <div class="sheet-graphic-preview has-photo">
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/' . $curr_data['cover_photo'] ); ?>" 
                                         alt="<?php echo esc_attr( $current_state_name . ' ' . $curr_data['name'] . ' Cheat Sheet' ); ?>" 
                                         class="aerial-photo-img" />
                                </div>

                                <!-- Footer Bar -->
                                <div class="sheet-footer-bar client-cover-footer">
                                    <span class="footer-domain">dmvlearnerspermittest.com</span>
                                    <span class="footer-meta">Built from official <?php echo esc_html( $current_state_name ); ?> handbook · Not affiliated with any state DMV</span>
                                </div>
                            </div><!-- .sheet-inner -->
                        </div><!-- .catalog-cover-mockup -->
                    </div><!-- .compare-cover-wrapper -->
                </div><!-- .compare-mockup-col -->

                <!-- Right: Content Details & CTA -->
                <div class="compare-info-col">
                    <h3 class="compare-info-title"><?php esc_html_e( 'Our cheat sheet', 'drive' ); ?></h3>

                    <ul class="compare-feature-list">
                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php 
                                printf(
                                    /* translators: %s: Question count */
                                    esc_html__( 'Key rules + %s questions with answers', 'drive' ),
                                    esc_html( $question_count )
                                ); 
                                ?>
                            </span>
                        </li>

                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php esc_html_e( 'Road signs all together, each one explained', 'drive' ); ?>
                            </span>
                        </li>

                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php esc_html_e( 'Made for a quick review before your test', 'drive' ); ?>
                            </span>
                        </li>

                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php 
                                printf(
                                    /* translators: %s: Price */
                                    esc_html__( '%s one-time', 'drive' ),
                                    esc_html( $price_display )
                                ); 
                                ?>
                            </span>
                        </li>
                    </ul>

                    <div class="compare-cta-wrap">
                        <a href="#pricing" class="compare-cta-btn">
                            <span><?php esc_html_e( 'Get Your Cheat Sheet', 'drive' ); ?></span>
                            <span class="cta-arrow" aria-hidden="true">→</span>
                        </a>
                    </div>
                </div><!-- .compare-info-col -->

            </div><!-- #panelCheatsheet -->

            <!-- PANEL 2: OFFICIAL HANDBOOK -->
            <div class="compare-panel" id="panelHandbook" role="tabpanel" aria-labelledby="tabHandbook" hidden>
                
                <!-- Left: Official Handbook Mockup Representation -->
                <div class="compare-mockup-col">
                    <div class="compare-cover-wrapper">
                        <div class="handbook-mockup-book">
                            <div class="handbook-inner">
                                <div class="handbook-header">
                                    <span class="hb-seal-circle"></span>
                                    <span class="hb-state-tag"><?php echo esc_html( strtoupper( $current_state_name ) ); ?></span>
                                </div>
                                <div class="handbook-title-block">
                                    <span class="hb-official-eyebrow"><?php esc_html_e( 'Official State Driver', 'drive' ); ?></span>
                                    <h4 class="hb-title"><?php esc_html_e( 'HANDBOOK', 'drive' ); ?></h4>
                                    <span class="hb-sub"><?php echo esc_html( $curr_data['name'] . ' ' . __( 'Driver License Manual', 'drive' ) ); ?></span>
                                </div>
                                <div class="handbook-mock-lines">
                                    <span class="hb-line w-80"></span>
                                    <span class="hb-line w-100"></span>
                                    <span class="hb-line w-60"></span>
                                </div>
                                <div class="handbook-footer">
                                    <span><?php esc_html_e( 'Department of Motor Vehicles', 'drive' ); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Handbook Details & CTA -->
                <div class="compare-info-col">
                    <h3 class="compare-info-title"><?php esc_html_e( 'Official handbook', 'drive' ); ?></h3>

                    <ul class="compare-feature-list">
                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php 
                                printf(
                                    /* translators: %s: State name */
                                    esc_html__( 'Comprehensive official %s manual (100+ dense pages)', 'drive' ),
                                    esc_html( $current_state_name )
                                ); 
                                ?>
                            </span>
                        </li>

                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php esc_html_e( 'Complete legal statutes and administrative regulations', 'drive' ); ?>
                            </span>
                        </li>

                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php esc_html_e( 'Thorough reference reading when you have plenty of time', 'drive' ); ?>
                            </span>
                        </li>

                        <li class="compare-feature-item">
                            <span class="feature-check-badge" aria-hidden="true">
                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="#00B4A6" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="4 10 8 14 16 6"/>
                                </svg>
                            </span>
                            <span class="feature-text">
                                <?php esc_html_e( 'Free PDF download from your state DMV', 'drive' ); ?>
                            </span>
                        </li>
                    </ul>

                    <div class="compare-cta-wrap">
                        <a href="<?php echo esc_url( home_url( '/' . esc_attr( $current_state_slug ) . '/handbook/' ) ); ?>" class="compare-cta-btn secondary-handbook-cta">
                            <span><?php esc_html_e( 'Read Official Handbook', 'drive' ); ?></span>
                            <span class="cta-arrow" aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>

            </div><!-- #panelHandbook -->

        </div><!-- .compare-card-stage -->

    </div><!-- .cheat-compare-container -->
</section>
