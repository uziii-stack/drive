<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Drive
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<div class="site-container page-layout-container">
    <div class="content-area not-found-wrapper">
        <section class="error-404 not-found">
            <header class="page-header">
                <span class="error-code">404</span>
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'drive' ); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Perhaps try selecting your state from our homepage or searching below.', 'drive' ); ?></p>

                <div class="error-actions">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
                        <?php esc_html_e( 'Back to Homepage', 'drive' ); ?>
                    </a>
                </div>

                <div class="error-search-box">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </section>
    </div>
</div>

<?php
get_footer();
