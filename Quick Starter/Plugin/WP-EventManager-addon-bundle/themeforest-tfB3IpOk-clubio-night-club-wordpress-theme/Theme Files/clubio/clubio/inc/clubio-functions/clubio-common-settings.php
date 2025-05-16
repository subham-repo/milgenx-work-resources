<?php
function clubio_sidebars($type) {
    $sidebar = '';
    switch ($type) {
        case 'default01':
            $sidebar = 'sidebar-1';
            break;

        case 'sb_footer01':
            $sidebar = 'Theme-Footer-Logos';
            break;
        case 'sb_footer02':
            $sidebar = 'Theme-Footer-Information';
            break;
        case 'sb_footer03':
            $sidebar = 'Theme-Footer-Socials';
            break;
        case 'sb_footer04':
            $sidebar = 'Theme-Footer-Copyright';
            break;

        case 'sb_blog01':
            $sidebar = 'Theme-Blog-Home';
            break;
        case 'sb_blog02':
            $sidebar = 'Theme-Blog-Default';
            break;
        case 'sb_shop01':
            $sidebar = 'Theme-Shop';
            break;
        case 'sb_header_info_btns':
            $sidebar = 'Theme-Header-Info-Buttons';
            break;

        case 'sb_header_rb':
            $sidebar = 'Theme-Header-Right-Buttons';
            break;
        case 'sb_forms':
            $sidebar = 'Theme-Forms';
            break;
    }
    ob_start();
    dynamic_sidebar($sidebar);
    $sidebar = ob_get_clean();
    if ($sidebar) {
        return $sidebar;
    } else {
        return false;
    }
}

function clubio_plugin_detect ($plugin_layout) {
    switch ($plugin_layout) :
        case 'shortcodes':
            $plugin_layout = in_array('theme-core/theme-core.php', apply_filters('active_plugins', get_option('active_plugins')));
            break;
        case 'woo':
            $plugin_layout = in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
            break;
        case 'polylang':
            $plugin_layout = in_array('polylang/polylang.php', apply_filters('active_plugins', get_option('active_plugins')));
            break;
        case 'scroll':
            $plugin_layout = in_array('infinite-scroll-ajax-load-more/infinite-scroll-ajax-load-more.php', apply_filters('active_plugins', get_option('active_plugins')));
            break;
    endswitch;
    return $plugin_layout;
}

function clubio_tags() {
    $clubio_tags = array(
        'strong' => array('class' => true,'id' => true,'style' => true),
        'div' => array('class' => true,'id' => true,'style' => true),
        'p' => array('class' => true,'id' => true,'style' => true),
        'br' => array('class' => true,'style' => true),
        'a' => array('class' => true,'href' => true,'alt' => true,'id' => true,'style' => true),
        'span' => array('class' => true,'id' => true,'style' => true),
        'ul' => array('class' => true,'id' => true,'style' => true),
        'ol' => array('class' => true,'id' => true,'style' => true),
        'li' => array('class' => true,'id' => true,'style' => true),
        'i' => array('class' => true,'id' => true,'style' => true),
        'iframe' => array('src' => true,'id' => true),
        'img' => array('src' => true,'alt' => true,'class' => true,'id' => true,'style' => true, 'width' => true, 'height' => true, 'srcset' => true, 'sizes' => true),
        'ins' => array(),
        'del' => array(),
        'h3' => array('class' => true,'id' => true,'style' => true),
        'button' => array('class' => true,'id' => true,'aria-label' => true,'data-dismiss' => true,'style' => true),
        'form' => array('role' => true,'class' => true,'lang' => true,'id' => true,'dir' => true,'style' => true),
        'input' => array('type' => true, 'id' => true, 'name' => true,'value' => true,'size' => true,'class' => true, 'placeholder' => true, 'aria-invalid' => true,'style' => true),
        'select' => array('type' => true,'value' => true,'name' => true,'class' => true, 'id' => true, 'aria-invalid' => true,'style' => true),
        'option' => array('value' => true,'style' => true),
        'textarea' => array('cols' => true,'rows' => true,'name' => true,'class' => true, 'aria-invalid' => true,'id' => true,'placeholder' => true,'style' => true),
        'svg' => array('viewbox' => true,'class' => true, 'version' => true,'xmlns' => true,'width' => true,'height' => true,'fill' => true),
        'title' => array(),
        'path' => array('d' => true,'fill' => true, 'class' => true,'id' => true),
        'g' => array(),

        /*
        'defs' => array(),
        'filter' => array('id' => true,'x' => true,'y' => true,'width' => true,'height' => true, 'filterUnits' => true,'color-interpolation-filters' => true),
        'feFlood' => array('flood-opacity' => true,'result' => true),
        'feColorMatrix' => array('id' => true,'type' => true,'values' => true),
        'feOffset' => array(),
        'feGaussianBlur' => array('stdDeviation' => true),
        'feBlend' => array('mode' => true,'in2' => true,'result' => true,'in' => true),
        */

    );
    return $clubio_tags;
}
function clubio_add_logo () {
    $custom_logo_id = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );

    if ($image[0] == '') {
        $logo_src = get_template_directory_uri().'/images/logo.png';

        if ( is_front_page() ) :
            return '<h1><a href="'.esc_url( home_url( '/' ) ).'" rel="home"><img src="'.esc_url($logo_src).'" alt="'.esc_attr__('VIP Clubio','clubio').'" /></a></h1>';
        else :
            return '<a href="'.esc_url( home_url( '/' ) ).'" rel="home"><img src="'.esc_url($logo_src).'" alt="'.esc_attr__('VIP Clubio','clubio').'" /></a>';
        endif;

    } else {
        return the_custom_logo();
    }
}
add_action( 'after_switch_theme', 'clubio_add_logo' );

function clubio_css_body_class($classes){
    global $server,$link,$theme_id;

    $classes[] = 'clubio-theme-set';
    if (is_front_page()) :
        $classes[] = 'home-page';
    endif;
    return $classes;
}
add_filter('body_class', 'clubio_css_body_class');

function clubio_get_parent_blog_page() {
    global $wp_query;
    if (isset($wp_query->post->ID)) {
        $thePostID = $wp_query->post->ID;
    } else {
        $thePostID = '';
    }
    global $post;
    if (isset($post->ID)) {
        $thePostID = $post->ID;
    } else {
        $thePostID = '';
    }
    global $wp_query;
    $page = $wp_query->get_queried_object();
    if (isset($page->ID)) : $page_id = $page->ID; endif;
    $page_id = get_queried_object_id();
    return $page_id;
}
add_filter( 'widget_title', 'clubio_remove_widget_title' );
function clubio_remove_widget_title( $title ) {
    if ( empty( $title ) ) return '';
    if ( $title[0] == '!' ) return '';
    return $title;
}

add_filter('widget_text', 'do_shortcode');

function clubio_add_admin_favicon() {
    $icon_url = get_template_directory_uri().'/favicon.ico';
    echo '<link rel="shortcut icon" href="' .esc_url ($icon_url) . '" />';
}
add_action('login_head', 'clubio_add_admin_favicon');
add_action('admin_head', 'clubio_add_admin_favicon');

function clubio_the_posts_pagination() {
    if( is_singular() )
        return;
    global $wp_query;
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    if ( $paged >= 1 )
        $links[] = $paged;

    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    global $clubio_blog_type;


    if (isset($clubio_blog_type) && ($clubio_blog_type == 'grid' || $clubio_blog_type == 'grid_s') ) {

        echo '<div class="container-fluid"><div class="tt-news-list m-0"><div class="row">';
        echo do_shortcode('[ajax-loadmore-button]');
        echo '</div></div></div>';

    } else {
        echo '<div class="clubio-post-pagination  '.$clubio_blog_type.'">';

        echo '<ul class="pagination">' . "\n";
        if ( get_previous_posts_link() )
            printf( '<li class="tt-link-arrow ch-arrow-prev">%s</li>' . "\n", get_previous_posts_link('<svg class="icon icon-video-play" width="10" height="12" viewBox="0 0 10 12" xmlns="//www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.72668 5.26101L1.65318 0.804285C1.44407 0.679788 1.18441 0.70053 0.988295 0.70053C0.203857 0.70053 0.207337 1.30617 0.207337 1.4596V10.5686C0.207337 10.6984 0.203903 11.3278 0.988295 11.3278C1.18441 11.3278 1.44411 11.3484 1.65318 11.224L8.72664 6.76729C9.30723 6.42182 9.20691 6.01413 9.20691 6.01413C9.20691 6.01413 9.30727 5.60643 8.72668 5.26101Z" /></svg>') );

        if ( ! in_array( 1, $links ) ) {
            $class = 1 == $paged ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
            if ( ! in_array( 2, $links ) )
                echo '<li class="ch_dots_wr"><span class="ch_dots_prev">&hellip;</span></li>';
        }

        sort( $links );
        foreach ( (array) $links as $link ) {
            $class = $paged == $link ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
        }

        if ( ! in_array( $max, $links ) ) {
            if ( ! in_array( $max - 1, $links ) )
                echo '<li class="ch_dots_wr"><span class="ch_dots_next">&hellip;</span></li>' . "\n";
            $class = $paged == $max ? ' class="active"' : '';
            printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
        }

        if ( get_next_posts_link() )
            printf( '<li class="tt-link-arrow ch-arrow-next">%s</li>' . "\n", get_next_posts_link('<svg class="icon icon-video-play" width="10" height="12" viewBox="0 0 10 12"><path fill-rule="evenodd" clip-rule="evenodd" d="M8.72668 5.26101L1.65318 0.804285C1.44407 0.679788 1.18441 0.70053 0.988295 0.70053C0.203857 0.70053 0.207337 1.30617 0.207337 1.4596V10.5686C0.207337 10.6984 0.203903 11.3278 0.988295 11.3278C1.18441 11.3278 1.44411 11.3484 1.65318 11.224L8.72664 6.76729C9.30723 6.42182 9.20691 6.01413 9.20691 6.01413C9.20691 6.01413 9.30727 5.60643 8.72668 5.26101Z" /></svg>'));
        echo '</ul></div>' . "\n";
    }
}

class Clubio_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat( $t, $depth ) : '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);


        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth) );

        $class_names = $class_names ? esc_attr($class_names)  : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id=' .esc_attr($id) : '';

        $output .= esc_attr($indent). '<li' .esc_attr($id).' class="'.esc_attr($class_names).'">';
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target)     ? $item->target     : '';
        $atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
        $atts['href']   = !empty($item->url)        ? $item->url        : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value) ) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' .$attr. '="' .$value. '"';
            }
        }
        $title = apply_filters('the_title', $item->title, $item->ID );
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth );

        $item_output = esc_attr($args->before);


        //$item_output .= '<a'. $attributes.'><span>'.esc_attr($args->link_before).esc_attr($title).esc_attr($args->link_after);


        if (clubio_plugin_detect('polylang') && function_exists('pll_the_languages') ) {
            $item_output .= '<a'. $attributes.'>'.esc_attr($args->link_before).((strpos($title, '<img') !== false) ? ($title) : esc_attr($title)).esc_attr($args->link_after);
        } else {
            $item_output .= '<a'. $attributes.'><span>'.esc_attr($args->link_before).esc_attr($title).esc_attr($args->link_after);
        }




        if ($args->walker->has_children) :
        endif;

        $item_output .= '</span></a>'.esc_attr($args->after);


        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

if(!(function_exists( 'wp_get_attachment_by_post_name' ) ) ) {
    function wp_get_attachment_by_post_name( $post_name ) {
        $args           = array(
            'posts_per_page' => 1,
            'post_type'      => 'attachment',
            'name'           => trim( $post_name ),
        );
        $get_attachment = new WP_Query( $args );
        if ( ! $get_attachment || ! isset( $get_attachment->posts, $get_attachment->posts[0] ) ) {
            return false;
        }
        return $get_attachment->posts[0];
    }
}
function clubio_is_realy_woocommerce_page () {
    if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
    }
    $woocommerce_keys = array ( "woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" ) ;

    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
            return true ;
        }
    }
    return false;
}
if (clubio_plugin_detect('woo')) {
    if (clubio_is_realy_woocommerce_page ()) :
        $classes[] = 'ch-woo-page';
    endif;
    if (function_exists("is_shop") ) {
        $classes[] = 'shop-page';
    }
} else {
    $classes[] = 'ch-woo-no';
}
function clubio_clean_custom_menus($menu_name) {
    $menu_list = '';
    $menu_exists = wp_get_nav_menu_object( $menu_name );

    $menu_items = wp_get_nav_menu_items($menu_exists->term_id);
    foreach ((array) $menu_items as $key => $menu_item) {
        $menu_list .= '<a class="icon icon-'.strtolower(str_replace(" ","", esc_attr($menu_item->title))).'-logo" href="'. esc_url ($menu_item->url) .'"></a>';
    }
    return $menu_list;
}

function clubio_post_classes( $classes, $class, $post_id ) {
    $classes[] = 'entry';

    return $classes;
}
add_filter( 'post_class', 'clubio_post_classes', 10, 3 );

function clubio_comment_reply_link($content) {
    $extra_classes = 'ch-comment-btn';
    return preg_replace( '/comment-reply-link/', 'comment-reply-link ' . $extra_classes, $content);
}

add_filter('comment_reply_link', 'clubio_comment_reply_link', 99);

function clubio_get_rgb( $color ) {
    $color = trim( $color, '#' );
    if ( strlen( $color ) == 3 ) {
        $r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
    } elseif ( strlen( $color ) == 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array(
        'red'   => $r,
        'green' => $g,
        'blue'  => $b,
    );
}
function clubio_search_form_general( $form ) {
    $form = '
        <form role="search" method="get" class="form-default from-from-common-settings" action="'. esc_url( home_url( '/' ) ).'">
            <div class="tt-form-search theme_search_form_general">
                <input type="search" id="'. esc_attr( uniqid( 'search-form-' ) ).'" class="form-control" placeholder="'.esc_attr_x( 'Search...', 'placeholder', 'clubio' ).'" value="'.get_search_query().'" name="s" />
                <button type="submit" class="tt-btn-icon icon-search"><span class="screen-reader-text">'._x( 'Search', 'submit button', 'clubio' ).'</span></button>
            </div>
        </form>';
    return $form;
}


