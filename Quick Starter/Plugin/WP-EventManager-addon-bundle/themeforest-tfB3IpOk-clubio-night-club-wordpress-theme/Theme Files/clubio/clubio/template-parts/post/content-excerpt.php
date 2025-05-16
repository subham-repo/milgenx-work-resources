<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clubio
 */
?>
<div id="post-<?php the_ID(); ?>" class="entry-content ch-blog-posts__post blog-post tt-blog-post">
    <div class="news-single__layout">
        <?php  clubio_posted_on(); ?>
        <?php
        if ( is_front_page() && ! is_home() ) {
            the_title( sprintf( '<h2 class="tt-news__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        } else {
            the_title( sprintf( '<h2 class="tt-news__title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

        } ?>
        <div class="post-teaser">
            <?php the_excerpt(); ?>
        </div>

    </div>
</div>