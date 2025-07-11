<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $product;
?>
<li class="prd-sm">
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
    <div class="prd-sm-img">
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
            <?php echo wp_kses($product->get_image(), clubio_tags()); ?>
        </a>
    </div>
    <div class="prd-sm-info">
        <h3>
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                <?php
                $title = $product->get_name();
                $count = 30;
                $after = '...';
                if (mb_strlen($title) > $count) $title = mb_substr($title,0,$count);
                else $after = '';
                echo esc_attr($title) . $after;
                ?>
            </a>
        </h3>
        <?php if ( ! empty( $show_rating ) ) : ?>
        <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
        <?php endif; ?>
        <div class="price">
            <?php echo wp_kses($product->get_price_html(), clubio_tags()); ?>
        </div>
    </div>
	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
