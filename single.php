<?php
/**
 * The template for displaying all single posts
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="site-container page-layout-container">
    <div class="content-area single-post-content">
        <?php
        get_template_part( 'template-parts/global/breadcrumbs' );

        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/content/content', get_post_type() );

            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'drive' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'drive' ) . '</span> <span class="nav-title">%title</span>',
                )
            );

            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div><!-- .content-area -->

    <?php get_sidebar(); ?>
</div><!-- .site-container -->

<?php
get_footer();
