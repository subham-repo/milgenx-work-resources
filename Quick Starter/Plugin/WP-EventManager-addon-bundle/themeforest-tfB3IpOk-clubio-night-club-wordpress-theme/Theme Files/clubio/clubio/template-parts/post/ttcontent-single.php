<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Clubio
 */

$clubio_add_content = esc_attr(get_post_meta($post->ID, 'clubio_add_content', true ));
$clubio_post_add_content = do_shortcode(get_post_meta($post->ID, 'tt_post_add_content', true ));
$clubio_post_s_fstate = esc_attr(get_post_meta($post->ID, 'tt_post_s_fstate', true ));
?>
<article id="post-<?php the_ID(); ?>" class="news-single">
    <div class="news-single__img <?php echo (has_post_thumbnail( get_queried_object_id() ) && $clubio_post_s_fstate != 'true' ? 'ch-is-image' : 'ch-is-no-image'); ?>">
        <?php
        if ( !has_post_thumbnail(get_queried_object_id())) {
            $clubio_single_image = 'true';
        } else {
            $clubio_single_image = (!has_post_thumbnail( get_queried_object_id()) || $clubio_post_s_fstate == 'true' ? (!isset($clubio_post_s_fstate) || $clubio_post_s_fstate == '' ? 'false' : esc_attr($clubio_post_s_fstate)) : '');
            $thumbnail_test = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),"size");
            if ($thumbnail_test[0] == '') : $clubio_single_image = 'true';  endif;

                    if ($clubio_post_s_fstate != 'true') :
                        echo get_the_post_thumbnail( get_queried_object_id(), 'clubio-featured-image' );
                    endif;
        }
        ?>
    </div>
    <div class="news-single__layout pb-1">
        <?php if ( 'post' === get_post_type() ) : ?>
        <?php clubio_posted_on(); ?>
        <?php endif; ?>
        <?php
        if ( is_single() ) {
            //the_title( '<h1 class="news-single__title">', '</h1>' );
        } elseif ( is_front_page() && is_home() ) {
            the_title( '<h2 class="news-single__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        } else {
            the_title( '<h2 class="news-single__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }
        ?>
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
        <?php
        if ($clubio_post_add_content != '' && ($clubio_add_content != true)) : echo ('<hr><div class="add_content_wrapper">'.do_shortcode(get_post_meta($post->ID, 'tt_post_add_content', true )).'</div>'); endif;
        ?>

        <?php
        if ( is_single() ) {
            clubio_entry_footer();
        }
        if ( ! is_singular( 'attachment' ) ) :
            get_template_part( 'template-parts/post/author', 'bio' );
        endif;
        get_template_part( 'template-parts/post/navigation', 'block' );
        ?>
    </div>
</article>
