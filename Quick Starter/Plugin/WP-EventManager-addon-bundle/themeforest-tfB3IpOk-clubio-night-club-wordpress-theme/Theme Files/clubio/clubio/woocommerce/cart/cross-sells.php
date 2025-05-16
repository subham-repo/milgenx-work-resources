<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;
if ( $cross_sells ) : ?>
	<div class="cross-sells products">
		<h3><?php esc_html_e( 'You May Be Interested In&hellip;', 'clubio' ) ?></h3>
        <div class="prd-grid prd-carousel carousel-related" data-slick='{"slidesToShow":2}'>
            <?php
            foreach ( $cross_sells as $cross_sell ) :
            $post_object = get_post( $cross_sell->get_id() );
            setup_postdata( $GLOBALS['post'] =& $post_object );
            wc_get_template_part( 'content', 'product' );
            endforeach;
            ?>
        </div>
	</div>
<?php endif;
wp_reset_postdata();