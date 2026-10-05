<?php
/**
 * Template part for displaying posts in blog archive/loop
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php body_class( 'post-entry-card' ); ?>>
    <?php drive_post_thumbnail(); ?>

    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
            <div class="entry-meta">
                <?php
                drive_posted_on();
                drive_posted_by();
                ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-summary entry-content">
        <?php
        if ( is_singular() ) {
            the_content();
        } else {
            the_excerpt();
        }
        ?>
    </div>

    <footer class="entry-footer">
        <?php drive_entry_footer(); ?>
    </footer>
</article>
