<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clubio
 */
?>
<article id="post-<?php the_ID(); ?>" class="<?php  get_post_class(); ?>content-page tt-entry-header entry <?php esc_attr(get_post_meta($post->ID, 'tt_title_state', true )); ?> <?php echo esc_attr(get_post_meta($post->ID, 'tt_block_css', true )); ?>">
    <?php if (!isset($clubio_title_state) || $clubio_title_state != true) : ?>
    <div  id="subtitle-wrapper" class="<?php echo esc_attr (get_post_meta($post->ID, 'tt_title_class_outer', true )); ?>">
        <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>
        <?php the_title( '<h1 class="subtitle__title '.esc_attr(get_post_meta($post->ID, 'tt_title_class', true )).'">', '</h1>' ); ?>
        <?php if (function_exists('clubio_theme_breadcrumbs'))  clubio_theme_breadcrumbs(); ?>
        <?php echo (isset($clubio_promo_content) && $clubio_promo_content != '' ? '<p class="p--lg">'.wp_kses($clubio_promo_content, clubio_tags()).'</p>' : '');  ?>
    </div>
    <?php endif; ?>
    <div id="tt-pageContent" class="<?php echo 'theme_plugin_detect_'.clubio_plugin_detect('shortcodes'); ?>  <?php echo (( comments_open() || get_comments_number() ) ? '' : ''); ?>">
        <div class="subpages-inner section-marker">
            <div class="container">
                <?php
                the_content();
                wp_link_pages( array(
                    'before'      => '<div class="page-links">',
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) );

                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </div>

        </div>
    </div>
</article>