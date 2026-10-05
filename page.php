<?php
/**
 * The template for displaying all single pages
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="site-container page-layout-container">
    <div class="content-area single-page-content">
        <?php
        get_template_part( 'template-parts/global/breadcrumbs' );

        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content/content', 'page' );

            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div><!-- .content-area -->
</div><!-- .site-container -->

<?php
get_footer();
