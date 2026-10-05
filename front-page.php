<?php
/**
 * The template for displaying the front page
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="homepage-sections-wrapper">
    <?php
    get_template_part( 'template-parts/homepage/hero' );
    get_template_part( 'template-parts/homepage/state-selector' );
    get_template_part( 'template-parts/homepage/features' );
    get_template_part( 'template-parts/homepage/how-it-works' );
    get_template_part( 'template-parts/homepage/youtube' );
    get_template_part( 'template-parts/homepage/testimonials' );
    get_template_part( 'template-parts/homepage/faq' );
    get_template_part( 'template-parts/homepage/final-cta' );
    ?>
</div>

<?php
get_footer();
