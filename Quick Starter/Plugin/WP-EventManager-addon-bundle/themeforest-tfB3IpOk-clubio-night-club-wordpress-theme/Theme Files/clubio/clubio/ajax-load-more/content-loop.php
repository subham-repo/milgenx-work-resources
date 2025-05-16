<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
global $post;
$clubio_post_fstate = esc_attr(get_post_meta($post->ID, 'clubio_post_fstate', true ));
?>
<div id="post-<?php the_ID(); ?>" class="col-md-6">
    <a href="<?php the_permalink(); ?>" class="tt-news  <?php echo 'state_'.$clubio_post_fstate; ?>">
        <div class="tt-news__img">
            <?php
    if (  $clubio_post_fstate != 'true') :
            if (has_post_thumbnail ()) {
                the_post_thumbnail( );
            }
    endif;
            ?>
            <div class="tt-btn"><span><?php esc_html_e('know more','clubio'); ?></span></div>
        </div>
        <div class="tt-news__time"> <?php echo get_the_date('l, M d, Y'); ?></div>
        <h2 class="tt-news__title"><?php the_title (); ?></h2>
    </a>
</div>