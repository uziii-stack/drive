<?php
/**
 * The template for displaying search results pages
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
        <?php get_template_part( 'template-parts/global/breadcrumbs' ); ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Search Results for: %s', 'drive' ), '<span>' . get_search_query() . '</span>' );
                ?>
            </h1>
        </header>

        <?php
        if ( have_posts() ) :
            echo '<div class="posts-grid">';
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content/content', get_post_type() );
            endwhile;
            echo '</div>';

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
