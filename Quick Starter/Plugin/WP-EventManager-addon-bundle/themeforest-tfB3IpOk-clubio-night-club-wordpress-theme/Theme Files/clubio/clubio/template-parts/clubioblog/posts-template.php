<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clubio
 */

global $clubio_blog_type;
if ( have_posts() ) : ?>

    <div id="subtitle-wrapper">
        <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>
        <h1 class="subtitle__title"><?php the_archive_title(); ?></h1>
            <?php
                if (function_exists('clubio_theme_breadcrumbs')) :
                    clubio_theme_breadcrumbs();
                endif;
            ?>
    </div>
	<?php endif; ?>
    <div id="tt-pageContent">
        <div class="subpages-inner section-marker">
            <div class="<?php echo esc_attr ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s' ? 'container-fluid' : 'container'); ?>">
            <?php
                $sidebar_id1 = clubio_sidebars('sb_blog01');
                if (is_dynamic_sidebar($sidebar_id1)&& ! is_page() ) {
                    $class = 'col-sm-12 col-md-8 col-lg-9 blog-center-right';
                    $class_row = 'row';
                } else {
                    $class = 'no-sidebar post-template-php';
                    $class_row = 'block_full_width';
                }

                 if ($clubio_blog_type != 'grid') :
                ?>
    <div class="<?php echo esc_attr($class_row); ?>">
                    <div id="primary" class="content-area <?php echo esc_attr($class); ?> aside">
                        <main id="main" role="main" class="news-single">
                            <?php endif; ?>
                            <?php
                            if ( have_posts() ) :

                                if ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') : ?>
            <div class="tt-news-list">
            <div id="main-posts" class="row <?php echo esc_attr ($clubio_blog_type == 'grid_s' ? 'blog-post-sidebar' : ''); ?>">

                                    <?php
                                endif;

                                while ( have_posts() ) : the_post();
                                    get_template_part( 'template-parts/post/content', get_post_format() );
                                endwhile;


                                if ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') :

                                    if (function_exists('clubio_the_posts_pagination')) {
                                        clubio_the_posts_pagination();
                                    } else {
                                        the_posts_pagination( array(
                                            'prev_text' => clubio_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'clubio' ) . '</span>',
                                            'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'clubio' ) . '</span>' . clubio_get_svg( array( 'icon' => 'arrow-right' ) ),
                                            'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'clubio' ) . ' </span>',
                                        ) );
                                    }
                                    echo '</div></div> ';
                                endif;

                            else :
                                get_template_part( 'template-parts/post/content', 'none' );
                            endif; ?>
                <?php if ($clubio_blog_type != 'grid') : ?>
		    </main>
        <?php
                if (function_exists('clubio_the_posts_pagination')) {
                    clubio_the_posts_pagination();
                } else {
                    the_posts_pagination( array(
                        'prev_text' => clubio_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'clubio' ) . '</span>',
                        'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'clubio' ) . '</span>' . clubio_get_svg( array( 'icon' => 'arrow-right' ) ),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'clubio' ) . ' </span>',
                    ) );
                }
                ?>
	    </div>
        <?php get_sidebar(); ?>
    </div>
    <?php endif; ?>
            </div>
        </div>
    </div>
