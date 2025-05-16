<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Clubio
 */
?>
<?php
$clubio_add_content = esc_attr(get_post_meta($post->ID, 'clubio_add_content', true ));
$clubio_post_add_content = do_shortcode(get_post_meta($post->ID, 'clubio_post_add_content', true ));
$clubio_post_fstate = esc_attr(get_post_meta($post->ID, 'clubio_post_fstate', true ));

global $clubio_blog_type;
global $k;

$k = $k + 1;
?>
<div id="post-<?php the_ID(); ?>" class="ch-blog-posts__post <?php echo esc_attr ($clubio_post_fstate != 'true' && '' !== get_the_post_thumbnail() ? 'post_with_img' : 'post_without_img'); ?> <?php echo esc_attr (isset($clubio_blog_type) && ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') ? 'col-md-6 col_grid' : ''); ?> <?php echo (is_sticky() ? 'clubio_sticky' : ''); ?>">
    <?php
    if ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') : ?><div class="tt-news"><?php endif;

    if ( ('' !== get_the_post_thumbnail() && ! is_single()) ||  $clubio_post_add_content != '' || $clubio_post_fstate != 'true') :
        if ($clubio_add_content != true) :  echo do_shortcode(get_post_meta($post->ID, 'clubio_post_add_content', true )); endif;
        if ($clubio_post_fstate != 'true' && '' !== get_the_post_thumbnail()) : ?>
        <a class="tt-news__img" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'clubio-featured-image' );
            echo (isset($clubio_blog_type) && ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') ? '<span class="tt-btn"><span>'. esc_html('know more', 'clubio').'</span></span>' : ''); ?>
        </a>
        <?php endif;
    endif;
    echo (isset($clubio_blog_type) && ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') ? '<div class="tt-news__time">'. get_the_date('l, M d, Y').'</div>' : '');
    if ( 'post' === get_post_type()) :
        if (!isset($clubio_blog_type) || $clubio_blog_type == 'simple' || $clubio_blog_type == '') :
        ?>
        <div class="news-single__layout">
            <?php clubio_posted_on(); ?>
            <?php  endif; ?>
    <?php
    endif;
        if ( is_single() ) {
            the_title( '<h1 class="entry-title">', '</h1>' );
        } elseif ( is_front_page() && is_home() ) {
            echo '<h2 class="tt-news__title">';
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
            if ( is_sticky() && is_home() && ! is_paged() ) {
                printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'clubio' ) );
            }
            echo '</h2>';
        } else {
            echo '<h2 class="tt-news__title">';
            the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' );
            if ( is_sticky() && is_home() && ! is_paged() ) {
                printf( '<span class="sticky-post">%s</span>', _x( 'Featured', 'post', 'clubio' ) );
            }
            echo '</h2>';
        }
    ?>
    <?php if (!isset($clubio_blog_type) || $clubio_blog_type == 'simple' || $clubio_blog_type == '') : ?>
    <div class="post-teaser">
        <?php
        the_content();
        wp_link_pages( array(
            'before'      => '<div class="page-links">',
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ) );
        ?>
    </div>
        </div>
     <?php endif;  ?>
    <?php if ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') : ?></div><?php endif; ?>
	<?php
	if ( is_single() ) {
        clubio_entry_footer();
	}
	?>
</div>
