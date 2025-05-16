<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Clubio
 */
    get_header(); 
?>
<div id="subtitle-wrapper">
    <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>
    <h1 class="subtitle__title"><?php esc_html_e('404', 'clubio'); ?></h1>
    <?php if (function_exists('clubio_theme_breadcrumbs')) : clubio_theme_breadcrumbs(); endif; ?>
</div>
<div id="tt-pageContent">
    <div class="section-indent05 section-marker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="four-zero-page-area">
                        <h2><?php esc_html_e('404', 'clubio'); ?></h2>
                        <h3><?php esc_html_e('Sorry. Page Was Not Found', 'clubio'); ?></h3>
                        <p><?php esc_html_e('The page you are looking is not available or has been removed.', 'clubio'); ?></p>
                        <?php get_search_form(); ?>
                        <div class="wp-block-button aligncenter">
                            <a class="tt-btn-default tt-btn__wide" href="<?php echo esc_url( home_url( '/' ) ) ?>">
                                <span><?php esc_html_e('back to home page', 'clubio'); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>