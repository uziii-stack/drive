<?php
/**
 * Cheat Sheet Product Page Template
 *
 * Route pattern: /[state]/[vehicle]-cheat-sheet
 * Handles:
 * 1. Site Header (re-used)
 * 2. Hero (#hero)
 * 3. Trust Strip (#trust)
 * 4. What's Inside Bento (#inside)
 * 5. Take a Look Inside Carousel (#look)
 * 6. How it Works (#how)
 * 7. Cheat Sheet vs Handbook (#compare)
 * 8. Pricing (#pricing)
 * 9. Money-Back Guarantee (#guarantee)
 * 10. FAQ (#faq)
 * 11. Final CTA (#final)
 * 12. Other Cheat Sheets (#other-sheets)
 * - Sticky Buy Bar (.sticky-buy)
 * 13. Site Footer (re-used)
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="primary" class="site-main cheat-sheet-single-page" role="main">

    <?php
    // 2. Hero Section
    get_template_part( 'template-parts/cheat-sheets/hero' );

    // 3. Trust strip
    if ( locate_template( 'template-parts/cheat-sheets/trust.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/trust' );
    }

    // 4. What's inside (Bento grid)
    if ( locate_template( 'template-parts/cheat-sheets/inside.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/inside' );
    }

    // 5. Take a look inside (Carousel)
    if ( locate_template( 'template-parts/cheat-sheets/look.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/look' );
    }

    // 6. How it works
    if ( locate_template( 'template-parts/cheat-sheets/how.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/how' );
    }

    // 7. Cheat sheet vs handbook comparison
    if ( locate_template( 'template-parts/cheat-sheets/compare.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/compare' );
    }

    // 8. Pricing split card
    if ( locate_template( 'template-parts/cheat-sheets/pricing.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/pricing' );
    }

    // 9. Money-back guarantee
    if ( locate_template( 'template-parts/cheat-sheets/guarantee.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/guarantee' );
    }

    // 10. FAQ Accordion
    if ( locate_template( 'template-parts/cheat-sheets/faq.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/faq' );
    }

    // 11. Final CTA
    if ( locate_template( 'template-parts/cheat-sheets/final.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/final' );
    }

    // 12. Other cheat sheets
    if ( locate_template( 'template-parts/cheat-sheets/other-sheets.php' ) ) {
        get_template_part( 'template-parts/cheat-sheets/other-sheets' );
    }
    ?>

</main><!-- #primary -->

<?php
// Sticky Buy Bar for Mobile
if ( locate_template( 'template-parts/cheat-sheets/sticky-buy.php' ) ) {
    get_template_part( 'template-parts/cheat-sheets/sticky-buy' );
}

get_footer();

