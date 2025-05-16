<?php
/**
 * The template for displaying Author info
 *
 * @package Clubio
 */

if ( (bool) get_the_author_meta( 'description' ) ) : ?>
<div class="personal-box personal-box__top">
    <div class="personal-box__img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 131 ); ?></div>
	<div class="personal-box_description">
        <h6 class="personal-box__title">
            <?php echo esc_attr( get_the_author() ); ?>
        </h6>
        <p class="author-bio-description"><?php the_author_meta( 'description' ); ?></p>
        <div class="tt-social-icon-wrapper">
            <?php echo do_shortcode(get_post_meta($post->ID, 'tt_post_add_content', true ));  ?>
        </div>
	</div>
</div>
<?php endif; ?>
