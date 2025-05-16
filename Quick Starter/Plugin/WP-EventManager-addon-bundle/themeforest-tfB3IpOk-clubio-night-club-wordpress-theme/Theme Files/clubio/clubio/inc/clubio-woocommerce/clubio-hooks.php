<?php
add_action( 'woocommerce_before_single_product_summary', 'clubio_wrapper_row_start', 4 );
add_action( 'woocommerce_before_single_product_summary', 'clubio_woo_wrapper_start', 5 );
add_action( 'woocommerce_before_single_product_summary', 'clubio_woo_wrapper_end', 30 );
add_action( 'woocommerce_single_product_summary', 'clubio_woo_after_summary_only_start', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 6 );
add_action( 'woocommerce_before_main_content', 'clubio_woo_bc_wrapper_start' , 11);
add_action( 'woocommerce_before_main_content', 'clubio_woo_bc_wrapper_end' , 21);

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

remove_action( 'woocommerce_before_main_content' , 'woocommerce_breadcrumb' , 20, 0);

add_action( 'woocommerce_single_product_summary', 'clubio_woo_price_wrapper_start', 9 );
add_action( 'woocommerce_single_product_summary', 'clubio_woo_price_wrapper_end', 11 );
add_action( 'woocommerce_before_add_to_cart_form', 'clubio_woo_addcart_wrapper_start', 5 );
add_action( 'woocommerce_after_add_to_cart_form', 'clubio_woo_addcart_wrapper_end', 5 );
add_action( 'woocommerce_after_single_product_summary', 'clubio_wrapper_row_end', 5 );
add_action( 'woocommerce_after_single_product_summary', 'clubio_woo_tabs_start', 5 );
add_action( 'woocommerce_after_single_product_summary', 'clubio_woo_tabs_end', 11 );
add_action( 'woocommerce_after_single_product_summary', 'clubio_woo_upsells_start', 12 );
add_action( 'woocommerce_after_single_product_summary', 'clubio_woo_upsells_end', 21 );
add_action( 'woocommerce_before_shop_loop_item', 'clubio_woo_product_loop_image_start', 9);
add_action( 'woocommerce_before_shop_loop_item_title', 'clubio_woo_product_loop_image_end', 10);

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
add_action( 'woocommerce_shop_loop_item_title', 'clubio_woo_template_loop_product_title');

add_action( 'woocommerce_shop_loop_item_title', 'clubio_woo_product_loop_info_start', 9);

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price');
add_action( 'woocommerce_after_shop_loop_item_title', 'clubio_woo_template_loop_product_price');

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 9 );

add_action( 'woocommerce_after_shop_loop_item', 'clubio_woo_product_loop_info_end', 11);
add_action( 'woocommerce_before_shop_loop', 'clubio_woo_filter_wrapper_start',10 );
add_action( 'woocommerce_before_shop_loop', 'clubio_woo_filter_wrapper_end', 50 );
add_action( 'woocommerce_after_shop_loop', 'clubio_woo_loop_clear', 5 );
add_action( 'woocommerce_after_shop_loop', 'clubio_woo_pagination_wrapper_start', 6 );
add_action( 'woocommerce_after_shop_loop', 'clubio_woo_pagination_wrapper_end', 15 );
add_action( 'woocommerce_cart_collaterals', 'clubio_woo_cart_collaterals_start', 4 );
add_action( 'woocommerce_cart_collaterals', 'clubio_woo_cart_collaterals_middle', 6 );
add_action( 'woocommerce_cart_collaterals', 'clubio_woo_cart_collaterals_end', 11 );

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 5 );

add_filter( 'woocommerce_review_gravatar_size', 'wowmall_woocommerce_review_gravatar_size' );

function remove_loop_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
}
add_action('init','remove_loop_button');


remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating' , 10);
add_action( 'woocommerce_review_meta', 'woocommerce_review_display_rating' , 20);

add_filter('woocommerce_show_page_title', '__return_false');
add_action( 'woocommerce_before_shop_loop', 'clubio_wc_listing_wrapper_begin' , 9);
add_action( 'woocommerce_after_shop_loop', 'clubio_wc_listing_wrapper_end' , 14);

add_action( 'woocommerce_no_products_found', 'clubio_woo_no_products_found_start', 9);
add_action( 'woocommerce_no_products_found', 'clubio_woo_no_products_found_end',11);
add_action( 'woocommerce_before_shop_loop', 'clubio_woo_loop_subcategories','19');




