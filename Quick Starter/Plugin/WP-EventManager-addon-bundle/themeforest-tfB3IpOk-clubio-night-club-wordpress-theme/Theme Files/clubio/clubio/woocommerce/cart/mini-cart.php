<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>
        <div class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
            <?php $cart = WC()->cart; if ( !is_null($cart) && !$cart->is_empty() ) : ?>
		<?php
			do_action( 'woocommerce_before_mini_cart_contents' );

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                    $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
                    $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                    echo '<span class="cart-items-count7 count7 badge ">';
                    echo WC()->cart->get_cart_contents_count();
                    echo '</span>';
                    ?>
					<div class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?> prd-sm">
                        <div class="prd-sm-img">
                            <?php echo (apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key )); ?>
                        </div>
                        <div class="prd-sm-info">
                            <h3>
                                <?php if ( empty( $product_permalink ) ) : ?>
                                <?php echo esc_attr($product_name); ?>
                                <?php else : ?>
                                <a href="<?php echo esc_url( $product_permalink ); ?>">
                                    <?php echo esc_attr($product_name); ?>
                                </a>
                                <?php endif; ?>
                            </h3>
                            <div class="price">
                                <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                            </div>
                        </div>
                        <div class="prd-sm-delete">
                            <?php
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                                '<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                __( 'Remove this item', 'clubio' ),
                                esc_attr( $product_id ),
                                esc_attr( $cart_item_key ),
                                esc_attr( $_product->get_sku() )
                            ), $cart_item_key );
                            ?>
                        </div>
					</div>
					<?php
				}
			}
			do_action( 'woocommerce_mini_cart_contents' );
		?>
        <div class="woocommerce-mini-cart__total total header-cart-total">
            <div class="pull-left"><?php _e( 'Total', 'clubio' ); ?>:</div>
            <div class="pull-right"><?php echo WC()->cart->get_cart_subtotal(); ?></div>
        </div>
        <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
        <p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>
<?php else :
            echo '<span class="cart-items-count7 count7 badge ">';
                echo (!is_null($cart) ? WC()->cart->get_cart_contents_count() : '');
                echo '</span>';
            ?>
	<p class="woocommerce-mini-cart__empty-message 888"><?php esc_html_e( 'No products in the cart.', 'clubio' ); ?></p>
<?php endif; ?>
        </div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>
