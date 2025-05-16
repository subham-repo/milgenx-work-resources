<?php
/**
 * Template part for displaying page content in tt-page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Clubio
 */

$clubio_title_state = esc_attr(get_post_meta($post->ID, 'tt_title_state', true ));
$clubio_promo_content = wp_kses(get_post_meta($post->ID, 'tt_promo_content', true ) , clubio_tags());
$ch_section_css = esc_attr(get_post_meta($post->ID, 'tt_block_css', true ));
?>
<article id="post-<?php the_ID(); ?>" class="tt-entry-header <?php esc_attr(get_post_meta($post->ID, 'tt_title_state', true )); ?>">
    <?php if (!isset($clubio_title_state) || $clubio_title_state != true) : ?>
    <div id="subtitle-wrapper" class="<?php echo esc_attr (get_post_meta($post->ID, 'tt_title_class_outer', true )); ?>">
        <div class="subtitle__img" style="background-image: url(<?php echo get_header_image(); ?>);background-color:#fff"></div>
        <?php the_title( '<h1 class="subtitle__title '.esc_attr(get_post_meta($post->ID, 'tt_title_class', true )).'">', '</h1>' ); ?>
        <?php if (function_exists('clubio_theme_breadcrumbs')):  clubio_theme_breadcrumbs(); endif; ?>
        <?php echo (isset($clubio_promo_content) && $clubio_promo_content != '' ? '<p >'.wp_kses($clubio_promo_content, clubio_tags()).'</p>' : '');  ?>
    </div>
    <?php endif; ?>
    <div id="tt-pageContent" class="<?php echo clubio_plugin_detect('shortcodes'); ?>">
        <?php if (isset($ch_section_css) && $ch_section_css != '') : ?><div class="<?php echo esc_attr($ch_section_css); ?>"><?php endif; ?>
            <?php
            the_content();
            wp_link_pages( array(
                'before'      => '<div class="page-links">',
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );
            ?>
        <?php if (isset($ch_section_css) && $ch_section_css != '') : ?></div><?php endif; ?>
    </div>
</article>