<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Clubio
 */
get_header(); ?>
<div id="subtitle-wrapper">
    <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>
    <h1 class="subtitle__title"><?php esc_html_e('Search', 'clubio'); ?></h1>
    <?php if (function_exists('clubio_theme_breadcrumbs')) : clubio_theme_breadcrumbs(); endif; ?>
</div>
<div  id="tt-pageContent">
    <div class="section-indent05 section-marker">
        <div class="container">
            <?php
            $sidebar_id1 = clubio_sidebars('sb_blog01');
            if (is_dynamic_sidebar($sidebar_id1)&& ! is_page() ) {
                $class = 'col-md-9 ';
                $class_row = 'row';
            } else {
                $class = 'no-sidebar';
                $class_row = 'block_full_width';
            }
            ?>
            <div class="<?php echo esc_attr($class_row); ?>">
            <div id="primary" class="content-area <?php echo esc_attr($class); ?> aside">
                    <main id="main" role="main">
                        <div class="news-single">
                    <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post();
                                get_template_part( 'template-parts/post/content', 'excerpt' );
                            endwhile;
                        else : ?>
                            <div class="news-single__layout search-empty">
                            <h2 class="tt-news__title"><?php esc_html_e( 'Nothing Found', 'clubio' ); ?></h2>
                            <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'clubio' ); ?></p>
                            <?php  get_search_form();  ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php clubio_the_posts_pagination(); ?>
                    </main>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer();
