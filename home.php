<?php
/**
 * The template for displaying the blog posts index
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
        <header class="page-header">
            <h1 class="page-title">
                <?php
                if ( single_post_title( '', false ) ) {
                    single_post_title();
                } else {
                    esc_html_e( 'Latest Articles & Guides', 'drive' );
                }
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
