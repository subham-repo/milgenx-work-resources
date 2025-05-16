<?php
function clubio_wrapper_row_start() {
    echo '<div class="subpages-inner section-marker"><div class="container"><div class="row"> ';
}
function clubio_woo_wrapper_start() {
    echo '<div class="col-md-6 tt-single-product__image">';
}
function clubio_woo_wrapper_end() {
    echo '</div><div class="col-md-6">';
}
function clubio_wrapper_row_end() {
    echo '</div></div></div></div></div>';
}
function clubio_woo_tabs_start() {
    echo '<div class="container"><div class="prd-tabs-wrap">';
}
function clubio_woo_tabs_end() {
    echo '</div></div>';
}
function clubio_woo_price_wrapper_start() {
    echo '<div class="product-block-price">';
}
function clubio_woo_price_wrapper_end() {
    global $product;
    echo '</div>';
    if ($product->get_shipping_class() != '') :
    echo '<div class="product-block-price-comment">+ '.ucfirst(str_replace("-"," ",esc_attr($product->get_shipping_class()))).'</div>';
    endif;
}
function clubio_woo_after_summary_only_start() {
    global $product;
    echo '<div class="product-block-info '.($product->is_on_sale() ? 'padding-top33' : '').'"> ';
}
function clubio_woo_addcart_wrapper_start() {
    echo '<div class="product-block-actions">';
}
function clubio_woo_addcart_wrapper_end() {
    echo '</div>';
}
function clubio_woo_upsells_start() {
    echo '<div class="container"> ';
}
function clubio_woo_upsells_end() {
    echo '</div>';
}
function clubio_woo_product_loop_image_start() {
    echo '<div class="product-card__image"> ';
}
function clubio_woo_product_loop_image_end() {
    echo '</div>';
}
function clubio_woo_template_loop_product_title() {
    echo "<h3><a href='" . esc_url(get_the_permalink()) . "'>" . get_the_title() . "</a></h3>";
}
function clubio_woo_product_loop_info_start() {
    echo '<div class="product-card__description"> <div class="product-card__description__left"> ';
}
function clubio_woo_product_loop_info_end() {

    global $product;
    $classes = array(
        'product_type_' . $product->get_type(),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
    );

    $classes[] = 'tt-btn-default';
    $classes = array_filter( $classes );
    $class   = join( ' ', $classes );
    $icon = ($product->get_type() == 'simple' ? '' : '');

    $text    = '<span class=add_to_cart_button_text>' . esc_attr( $product->add_to_cart_text() ) . '</span>';
    $link    = sprintf( '</div><div class="ch-atc-btn"><a rel="nofollow" href="%s" data-quantity="1" data-product_id="%s" data-product_sku="%s" class="%s">%s%s</a></div>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        esc_attr( $class ),
        wp_kses( $icon , clubio_tags()),
        $text
    );

    echo wp_kses($link, clubio_tags());




    echo '</div>';
}
function clubio_woo_template_loop_product_price() {
    echo '<div class="price"> ';
    woocommerce_template_loop_price();
    echo '</div>';
}
function clubio_woo_filter_wrapper_start() {
    echo '<div class="filters-row align-items-center">';
}
function clubio_woo_filter_wrapper_end() {
    echo '</div>';
}
function clubio_woo_loop_clear () {
    echo '<div class="clearfix"></div>';
}
function clubio_woo_pagination_wrapper_start () {
    echo '<div class="simple-pagination tt-simple-pagination mt-5 pagination justify-content-center">';
}
function clubio_woo_pagination_wrapper_end () {
    echo '</div>';
}
function clubio_woo_cart_collaterals_start () {
    echo '<div class="row clubio-collaterals"><div class="col-md-6 col-lg-6 ">';
}
function clubio_woo_cart_collaterals_middle () {
    echo '</div><div class="divider visible-sm visible-xs"></div><div class="col-md-6 col-lg-push-1-7">';
}
function clubio_woo_cart_collaterals_end () {
    echo '</div></div>';
}
function wowmall_woocommerce_review_gravatar_size() {
    return 72;
}

function clubio_woo_bc_wrapper_start() {
    echo '
<div id="subtitle-wrapper">
    <div class="subtitle__img"></div>
    <h1 class="subtitle__title">'.esc_html__('Shop', 'clubio').'</h1>
    ';
    if (function_exists('clubio_theme_breadcrumbs')):  clubio_theme_breadcrumbs(); endif;
}
function clubio_woo_bc_wrapper_end() {
    echo '</div>';
}
function clubio_wc_get_gallery_image_html_thumbnails( $attachment_id, $main_image = false ) {
    $flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
    $gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
    $thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
    $image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    $image             = wp_get_attachment_image( $attachment_id, $image_size, false, array(
        'title'                   => get_post_field( 'post_title', $attachment_id ),
    ) );
    return '<a href="#" class="product-previews-item" data-image="' . esc_url( $full_src[0] ) . '" data-zoom-image="' . esc_url( $full_src[0] ) . '">' . $image . '</a>';
}
function clubio_wc_get_gallery_image_html_main( $attachment_id, $main_image = false ) {
    $full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
    $full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
    return '<img id="mainImage" src="'.$full_src[0].'" data-zoom-image="'.$full_src[0].'"  />';
}

function clubio_wc_listing_wrapper_begin() {
    if (clubio_sidebars('sb_shop01')) {
        $class = 'col-sm-12 col-md-8 col-lg-9 ch-col sidebar';
        $class_content = 'row';
    } else {
        $class = 'ch-col no-sidebar';
        $class_content = '';
    }
    echo '
         <div id="tt-pageContent">
            <div class="subpages-inner section-marker">
            <div class="container">
              <div class="'.esc_attr($class_content).' listing-loop">
                   <div class="'.esc_attr($class).'"> ';
}
function clubio_wc_listing_wrapper_end() {
    echo '</div></div>';
    if (clubio_sidebars('sb_shop01')) :
        echo '<div class="col-sm-12 col-md-4 col-lg-3 column-filters aside rightColumn widget-area"><div class="column-filters-inside block-border-gradient">'.  clubio_sidebars('sb_shop01').'</div></div>';
    endif;
    echo '</div></div></div>';
}
function clubio_woo_no_products_found_start() {
    echo '<div class="container block offset-80 ch-separator page-no-products pb-8 bg-page bg-page-blog">';
}
function clubio_woo_no_products_found_end() {
    echo '</div>';
}

function clubio_woo_pr_rating() {
    echo '<div>&nbsp;</div>';
}

function clubio_woo_single_product_tab_review( $tabs ) {
    global $product;
    if ( ! comments_open() ) {
        return;
    }

    $tabs['review'] = array(
        'title' 	=> esc_html( 'Reviews ('.$product->get_review_count().')', 'clubio' ),
        'priority' 	=> 50,
        'callback' 	=> 'clubio_woo_single_product_tab_review_content'
    );
    return $tabs;
}
function clubio_woo_single_product_tab_review_content() {
    wc_get_template ('single-product-reviews.php');
}

function clubio_woo_loop_subcategories() {
    echo '<ul class="products ch-list-subcat">';
    echo woocommerce_maybe_show_product_subcategories();
    echo '</ul>';
}
function custom_jquery_add_to_cart_script(){
    if ( is_shop() || is_product_category() || is_product_tag() ):
        ?>
    <script type="text/javascript">
        (function($){
            $( document.body ).on( 'added_to_cart', function(){
                function addEvent(){
                    $('#tt-pageContent').find('.added_to_cart').each(function(index){
                        var text = $(this).html();
                        $(this).empty();
                        $(this).append('<span>' + text + '</span>');
                    });
                }
                addEvent();
            });
        })(jQuery);

    </script>
    <?php
    endif;
}
add_filter( 'woocommerce_pagination_args' , 'clubio_shop_page_pagination' );
function clubio_shop_page_pagination( $args ) {
    $args['prev_text'] = '<svg class="icon icon-video-play" width="10" height="12" viewBox="0 0 10 12" xmlns="//www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.72668 5.26101L1.65318 0.804285C1.44407 0.679788 1.18441 0.70053 0.988295 0.70053C0.203857 0.70053 0.207337 1.30617 0.207337 1.4596V10.5686C0.207337 10.6984 0.203903 11.3278 0.988295 11.3278C1.18441 11.3278 1.44411 11.3484 1.65318 11.224L8.72664 6.76729C9.30723 6.42182 9.20691 6.01413 9.20691 6.01413C9.20691 6.01413 9.30727 5.60643 8.72668 5.26101Z" /></svg>';
    $args['next_text'] =  '<svg class="icon icon-video-play" width="10" height="12" viewBox="0 0 10 12"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.72668 5.26101L1.65318 0.804285C1.44407 0.679788 1.18441 0.70053 0.988295 0.70053C0.203857 0.70053 0.207337 1.30617 0.207337 1.4596V10.5686C0.207337 10.6984 0.203903 11.3278 0.988295 11.3278C1.18441 11.3278 1.44411 11.3484 1.65318 11.224L8.72664 6.76729C9.30723 6.42182 9.20691 6.01413 9.20691 6.01413C9.20691 6.01413 9.30727 5.60643 8.72668 5.26101Z" /></svg>';
    return $args;
}

