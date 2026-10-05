<?php
/**
 * The main template file
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
        if ( have_posts() ) :

            if ( is_home() && ! is_front_page() ) :
                ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
                <?php
            endif;

            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content/content', get_post_type() );
            endwhile;

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
