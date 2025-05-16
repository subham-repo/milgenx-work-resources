<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Clubio
 */
get_header();
global $post;
                while ( have_posts() ) : the_post();                        ?>
                <div id="subtitle-wrapper">
                    <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>            <h1 class="subtitle__title"><?php single_post_title(); ?></h1>
                    <?php
                    if (function_exists('clubio_theme_breadcrumbs')) :
                        clubio_theme_breadcrumbs();
                    endif;
                    ?>
                </div>
                <?php
                    $sidebar_id1 = clubio_sidebars('sb_blog02');
                    $sidebar_id2 = clubio_sidebars('sb_blog01');
                    $sidebar_default = clubio_sidebars('default01');
                    if ((is_dynamic_sidebar($sidebar_id1) || is_dynamic_sidebar($sidebar_id2) || is_dynamic_sidebar($sidebar_default)) ) {
                        $class = 'col-sm-12 col-md-8 col-lg-9 blog-center-right';
                        $class_row = 'row';
                    } else {
                        $class = 'no-sidebar single-php';
                        $class_row = 'block_full_width';
                    }
                    ?>
                <div id="tt-pageContent">
                    <div class="subpages-inner section-marker">
                        <div class="container">
                            <div class="<?php echo esc_attr($class_row); ?>">
                            <div class="content-area <?php echo esc_attr($class); ?>">
                                    <?php
                                    if ($post->post_type == 'product') {
                                        the_content();
                                    } else {
                                        get_template_part( 'template-parts/post/ttcontent-single', get_post_format() );
                                        if ( comments_open() || get_comments_number() ) :
                                            comments_template();
                                        endif;
                                    }
                                    ?>
                                </div>
                                <?php (($post->post_type == 'product') ? '' : get_sidebar()); ?>
                            </div>
                        </div>
                    </div>
                </div>
          <?php
                endwhile;
          ?>
<?php get_footer();