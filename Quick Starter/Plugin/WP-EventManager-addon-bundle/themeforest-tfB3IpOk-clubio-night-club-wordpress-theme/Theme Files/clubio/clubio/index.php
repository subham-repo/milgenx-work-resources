<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists. *
 * Learn more: //codex.wordpress.org/Template_Hierarchy
 *
 * @package Clubio
 */

get_header();
global $clubio_blog_type;
if ( is_home() && ! is_front_page() ) :
    $page_id = clubio_get_parent_blog_page();
    $clubio_title_state = esc_attr(get_post_meta($page_id, 'tt_title_state', true ));
    if (single_post_title('',false) != '') :        
		if (!isset($clubio_title_state) || $clubio_title_state != true) : ?>
        <div id="subtitle-wrapper">
            <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>            <h1 class="subtitle__title"><?php single_post_title(); ?></h1>
            <?php
            if (function_exists('clubio_theme_breadcrumbs')) :
                clubio_theme_breadcrumbs();
            endif;
            ?>
        </div>
        <?php 
		endif; 
    endif;
else :
    ?>

<div id="subtitle-wrapper">
    <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>
    <h1 class="subtitle__title"><?php esc_html_e( 'Blog Posts', 'clubio' ); ?></h1>
            <?php
            if (function_exists('clubio_theme_breadcrumbs')) :
            clubio_theme_breadcrumbs();
            endif;
            ?>
    </div>
	<?php endif; ?>
<?php if ( have_posts() ) : ?>
    <div id="tt-pageContent">
<?php endif; ?>
<div class="subpages-inner section-marker">
    <div class="<?php echo esc_attr ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s' ? 'container-fluid' : 'container'); ?>">
        <?php
        $sidebar_id1 = clubio_sidebars('sb_blog02');
        $sidebar_id2 = clubio_sidebars('sb_blog01');

        if ((is_dynamic_sidebar($sidebar_id1) || is_dynamic_sidebar($sidebar_id2)) && ! is_page() ) {
            $class = 'col-sm-12 col-md-8 col-lg-9 blog-center-right';
            $class_row = 'row';
        } else {
            $class = 'no-sidebar index-php';
            $class_row = 'block_full_width';
        }
        if ($clubio_blog_type != 'grid') :
            if (single_post_title('',false) != '') :  endif;
            ?>
    <div class="<?php echo esc_attr($class_row); ?>">
        <div id="primary" class="content-area <?php echo esc_attr($class); ?> aside 123">
		    <main id="main" class="site-main page-main news-single">
        <?php endif; 
		if ( have_posts() ) :
        if ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') : ?>
            <div class="tt-news-list">
            <div id="main-posts" class="row <?php echo esc_attr ($clubio_blog_type == 'grid_s' ? 'blog-post-sidebar' : ''); ?>">
        <?php
        endif;
        $k = 0;
        while ( have_posts() ) : the_post();
            get_template_part( 'template-parts/post/content', get_post_format() );
        endwhile;

        if ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') :
            echo '</div></div> ';
        endif;
    else :
        get_template_part( 'template-parts/post/content', 'none' );
    endif;
        ?>
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
        <?php
        if ($clubio_blog_type == 'grid') :
        if (function_exists('clubio_the_posts_pagination')) {
            clubio_the_posts_pagination();
        } else {
            the_posts_pagination( array(
                'prev_text' => clubio_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . esc_html__( 'Previous page', 'clubio' ) . '</span>',
                'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'clubio' ) . '</span>' . clubio_get_svg( array( 'icon' => 'arrow-right' ) ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'clubio' ) . ' </span>',
            ) );
        }

            endif;
        ?>
    </div>
</div>
<?php if ( have_posts() ) : ?>
    </div>
    <?php endif; ?>
<?php get_footer();
