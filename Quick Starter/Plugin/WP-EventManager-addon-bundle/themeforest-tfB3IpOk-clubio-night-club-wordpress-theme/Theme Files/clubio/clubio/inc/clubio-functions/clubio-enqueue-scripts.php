<?php
/**
 * Enqueue theme Clubio scripts and styles.
 */

function clubio_base_scripts() {
    global $clubio_blog_type;

    wp_enqueue_style( 'clubio-style', get_template_directory_uri(). '/style.css', array(), false, 'all');


    if ( is_rtl() ) :
        wp_enqueue_style('clubio-theme-css-rtl', get_template_directory_uri(). '/assets/css/clubio-style-rtl.css', array(), false, 'all' );
    else:
        wp_enqueue_style('clubio-theme-css', get_template_directory_uri(). '/assets/css/clubio-style.css', array(), false, 'all' );
    endif;

    if ( is_rtl() ) :
        wp_enqueue_style('clubio-custom', get_template_directory_uri(). '/assets/css/clubio-custom-rtl.css', array(), false, 'all' );
    else:
        wp_enqueue_style('clubio-custom', get_template_directory_uri(). '/assets/css/clubio-custom.css', array(), false, 'all' );
    endif;

    if (clubio_plugin_detect('woo')):
        if ( is_rtl() ) :
            wp_enqueue_style('clubio-woo', get_template_directory_uri(). '/assets/css/clubio-woo-rtl.css', array(), false, 'all' );
        else:
            wp_enqueue_style('clubio-woo', get_template_directory_uri(). '/assets/css/clubio-woo.css', array(), false, 'all' );
        endif;
    endif;

    wp_enqueue_style('clubio-colors', get_template_directory_uri(). '/assets/css/clubio-colors.css', array(), false, 'all' );

    if (clubio_plugin_detect('woo')):
        wp_enqueue_script('clubio-zoom', get_template_directory_uri() . '/assets/js/jquery.elevateZoom/jquery.elevateZoom-3.0.8.min.js', array('jquery'), false, true);
    endif;

    wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick-carousel/slick/slick.min.js', array('jquery'), false, true);
    wp_enqueue_script('tilt', get_template_directory_uri() . '/assets/js/tilt/tilt.jquery.min.js', array('jquery'), false, true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup/dist/jquery.magnific-popup.min.js', array('jquery'), false, true);
    wp_enqueue_script('sumoselect', get_template_directory_uri() . '/assets/js/sumoselect/jquery.sumoselect.min.js', array('jquery'), false, true);
    wp_enqueue_script('air-datepicker', get_template_directory_uri() . '/assets/js/air-datepicker-master/datepicker.min.js', array('jquery'), false, true);
    wp_enqueue_script('countdown', get_template_directory_uri() . '/assets/js/countdown/jquery.countdown.min.js', array('jquery'), false, true);
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/js/popper/popper.min.js', array('jquery'), false, true);
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('lazysizes', get_template_directory_uri() . '/assets/js/lazysizes/lazysizes.min.js', array('jquery'), false, true);
    wp_enqueue_script('ls-bgset', get_template_directory_uri() . '/assets/js/lazysizes/plugins/bgset/ls.bgset.min.js', array('jquery'), false, true);
    wp_enqueue_script('clubio-custom', get_template_directory_uri() . '/assets/js/theme-js.js', array('jquery'), false, true);

    if ( get_theme_mod( 'clubio_theme_c_activate' ) == 1 ) :
        $custom_css = clubio_get_customizer_css();
        wp_add_inline_style( 'clubio-colors', $custom_css );
    endif;

}
add_action( 'wp_enqueue_scripts', 'clubio_base_scripts' );