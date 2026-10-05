<?php
/**
 * The template for displaying archive pages
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="site-container page-layout-container">
    <div class="content-area">
        <?php
        get_template_part( 'template-parts/global/breadcrumbs' );

        if ( have_posts() ) :
            ?>
            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header>

            <div class="posts-grid">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template-parts/content/content', get_post_type() );
                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content/content', 'none' );
        endif;
        ?>
    </div><!-- .content-area -->

    <?php get_sidebar(); ?>
</div><!-- .site-container -->

<?php
get_footer();
