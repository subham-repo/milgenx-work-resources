<?php
//ch colors


function clubio_get_customizer_css() {
    ob_start();

    $color_header_sticky_bg     = clubio_get_rgb( get_theme_mod( 'color_header_sticky_bg', '' ) );
    $color_header_sticky_bg_rgb         = (count($color_header_sticky_bg) > 2 ? vsprintf('%1$s,%2$s,%3$s', $color_header_sticky_bg ) : '');

    ?>

:root {
    <?php if ( get_theme_mod( 'clubio_theme_color', '' ) != '' ) : ?>
    --main_color: <?php echo sanitize_hex_color( get_theme_mod( 'clubio_theme_color', '' ) ); ?>;
    <?php endif; ?>
    <?php if ( get_theme_mod( 'clubio_theme_color_2', '' ) != '' ) : ?>
    --main_color_2: <?php echo sanitize_hex_color( get_theme_mod( 'clubio_theme_color_2', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_general_body_bg', '' ) != '' ) : ?>
    --color_general_body_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_general_body_bg', '' ) ); ?>;
    <?php endif; ?>
}

<?php if ( get_theme_mod( 'color_general_bg_dark', '' ) != '' ) : ?>
    :root {
    --color_general_bg_dark: <?php echo sanitize_hex_color( get_theme_mod( 'color_general_bg_dark', '' ) ); ?>;
    }
    .block.block-bg-booking{background-image:none}
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_general_bg_light', '' ) != '' ) : ?>
    :root {
    --color_general_bg_light: <?php echo sanitize_hex_color( get_theme_mod( 'color_general_bg_light', '' ) ); ?>;
    }
    .bg-page-rates1,
    .bg-page-gallery1,
    .bg-page-equipment1,.bg-page-testimonials1,
    .bg-page-testimonials2,
    .bg-page-services2,.bg-page-services1,
    .bg-page-about1,.bg-page-about2,
    .block-bg-team:before,.bg-page-project1,
    .ch-block-projects,
    .bg-home-latest-news,
    .block-bg-welcome,
    .block-bg-engineer{background-image:none}
    <?php endif; ?>

:root {

<?php if ( get_theme_mod( 'color_general_btn_top_bg', '' ) != '' ) : ?>
    --color_general_btn_top_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_general_btn_top_bg', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_general_btns_player', '' ) != '' ) : ?>
    --color_general_btns_player: <?php echo sanitize_hex_color( get_theme_mod( 'color_general_btns_player', '' ) ); ?>;
    <?php endif; ?>

<?php if ( get_theme_mod( 'color_header_bg', '' ) != '' ) : ?>
    --color_header_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_bg', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_header_sticky_bg', '' ) != '' ) : ?>
    --color_header_sticky_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_sticky_bg', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_header_l', '' ) != '' ) : ?>
    --color_header_l: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_l', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_header_l_h', '' ) != '' ) : ?>
    --color_header_l_h: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_l_h', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_header_dd_bg', '' ) != '' ) : ?>
    --color_header_dd_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_dd_bg', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_header_dd_l', '' ) != '' ) : ?>
    --color_header_dd_l: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_dd_l', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_header_dd_l_h', '' ) != '' ) : ?>
    --color_header_dd_l_h: <?php echo sanitize_hex_color( get_theme_mod( 'color_header_dd_l_h', '' ) ); ?>;
    <?php endif; ?>
}

<?php if ( get_theme_mod( 'color_footer_bg', '' ) != '' ) : ?>
    .footer{background-image:none}
    :root {
    --color_footer_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_bg', '' ) ); ?>;
    }
<?php endif; ?>

<?php if ( get_theme_mod( 'bg_image_footer', '' ) != '' ) : ?>
    @media (min-width: 1024px) {
        #tt-footer .footer-wrapper {
            background-image: url("<?php echo esc_html(get_theme_mod('bg_image_footer'));?>");
            background-repeat: no-repeat;
            background-position:center center
        }
    }
    <?php endif; ?>


<?php if ( get_theme_mod( 'bg_image_footer2', '' ) != '' ) : ?>
    @media (max-width: 1024px) and (min-width: 576px) {
        #tt-footer .footer-wrapper {
            background-image: url("<?php echo esc_html(get_theme_mod('bg_image_footer2'));?>");
            background-repeat: no-repeat;
            background-position:center center
        }
    }
    <?php endif; ?>


<?php if ( get_theme_mod( 'bg_image_footer3', '' ) != '' ) : ?>
    @media (max-width: 575px) {
        #tt-footer .footer-wrapper {
            background-image: url("<?php echo esc_html(get_theme_mod('bg_image_footer3'));?>");
            background-repeat: no-repeat;
            background-position:center center
        }
    }
    <?php endif; ?>













:root {
<?php if ( get_theme_mod( 'color_footer_t', '' ) != '' ) : ?>
    --color_footer_t: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_t', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_footer_l', '' ) != '' ) : ?>
    --color_footer_l: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_l', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_footer_l_h', '' ) != '' ) : ?>
    --color_footer_l_h: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_l_h', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_footer_i', '' ) != '' ) : ?>
    --color_footer_i: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_i', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_footer_i_h', '' ) != '' ) : ?>
    --color_footer_i_h: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_i_h', '' ) ); ?>;
    <?php endif; ?>

<?php if ( get_theme_mod( 'color_footer_titles', '' ) != '' ) : ?>
    --color_footer_titles: <?php echo sanitize_hex_color( get_theme_mod( 'color_footer_titles', '' ) ); ?>;
    <?php endif; ?>


<?php if ( get_theme_mod( 'color_content_headings', '' ) != '' ) : ?>
    --color_content_headings: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_headings', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_content_headings_dark', '' ) != '' ) : ?>
    --color_content_headings_dark: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_headings_dark', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_content_title_t', '' ) != '' ) : ?>
    --color_content_title_t: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_title_t', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_content_title_l', '' ) != '' ) : ?>
    --color_content_title_l: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_title_l', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_content_title_l_h', '' ) != '' ) : ?>
    --color_content_title_l_h: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_title_l_h', '' ) ); ?>;
    <?php endif; ?>

<?php if ( get_theme_mod( 'color_content_title_heading', '' ) != '' ) : ?>
    --color_content_title_heading: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_title_heading', '' ) ); ?>;
    <?php endif; ?>
<?php if ( get_theme_mod( 'color_content_title_bc_bg', '' ) != '' ) : ?>
    --color_content_title_bc_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_title_bc_bg', '' ) ); ?>;
    <?php endif; ?>

}

<?php if ( get_theme_mod( 'color_content_title_bg', '' ) != '' ) : ?>
    :root {
    --color_content_title_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_content_title_bg', '' ) ); ?>;
    }
    .blog #subtitle-wrapper .subtitle__img{background-image:none !important}
<?php endif; ?>

<?php if ( get_theme_mod( 'bg_image_title', '' ) != '' ) : ?>
    .blog #subtitle-wrapper .subtitle__img{
        background-image: url("<?php echo esc_html(get_theme_mod('bg_image_title'));?>") !important;
        background-repeat: no-repeat;
        background-position:center center
    }
<?php endif; ?>
<?php if ( get_theme_mod( 'color_blog_bg', '' ) != '' ) : ?>
    :root {
    --color_blog_bg: <?php echo sanitize_hex_color( get_theme_mod( 'color_blog_bg', '' ) ); ?>;
    }
    .bg-page-blog, body.single-post .site-content-contain{background-image:none}
    <?php endif; ?>
<?php if ( get_theme_mod( 'font_h_menu', '' ) != '' ) :  ?>
    #tt-header #tt-nav > ul > li > a,#tt-nav > ul > li > a,#tt-header .nav-btn li a{font-size: <?php echo get_theme_mod( 'font_h_menu', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_h_menu_sub', '' ) != '' ) :  ?>
    #tt-nav > ul > li ul li a,.SumoSelect > .optWrapper > .options li label{font-size: <?php echo get_theme_mod( 'font_h_menu_sub', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_h_i', '' ) != '' ) :  ?>
    #tt-header .tt-obj.tt-obj-chat .tt-obj__btn .icon,.header-cart .icon{width: <?php echo get_theme_mod( 'font_h_i', '' ); ?>px; }
    #tt-header .tt-obj .tt-obj__btn,.SumoSelect > .CaptionCont > span{font-size:  <?php echo get_theme_mod( 'font_h_i', '' ); ?>px;}
<?php endif; ?>
<?php if ( get_theme_mod( 'font_f_menu', '' ) != '' ) :  ?>
    .f-nav ul > li > a{font-size: <?php echo get_theme_mod( 'font_f_menu', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_f_head', '' ) != '' ) :  ?>
    .footer,.f-info__content{font-size: <?php echo get_theme_mod( 'font_f_head', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_f_links', '' ) != '' ) :  ?>
    .footer a,.f-info__content a{font-size: <?php echo get_theme_mod( 'font_f_links', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_f_heading', '' ) != '' ) :  ?>
    .f-info .f-info__content .tt-title{font-size: <?php echo get_theme_mod( 'font_f_heading', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_f_i', '' ) != '' ) :  ?>
    .f-info .f-info__icon .icon,.f-info .f-info__icon .icon.icon-place{width: <?php echo get_theme_mod( 'font_f_i', '' ); ?>px; }
    .f-social ul > li > a{font-size: <?php echo get_theme_mod( 'font_f_i', '' ); ?>px;}
    <?php endif; ?>
<?php if ( get_theme_mod( 'font_f_copyright', '' ) != '' ) :  ?>
    .f-copyright{font-size: <?php echo get_theme_mod( 'font_f_copyright', '' ); ?>px; }<?php endif; ?>
<?php if ( get_theme_mod( 'font_f_copyright_l', '' ) != '' ) :  ?>
    .f-copyright a{font-size: <?php echo get_theme_mod( 'font_f_copyright_l', '' ); ?>px; }<?php endif; ?>

<?php
    $clubio_h_font = esc_html(get_theme_mod('clubio_headings_fonts'));
    $clubio_g_font = esc_html(get_theme_mod('clubio_body_fonts'));

    if( $clubio_h_font ) {
        wp_enqueue_style( 'clubio-headings-fonts', '//fonts.googleapis.com/css?family='. $clubio_h_font );
    }
    if( $clubio_g_font ) {
        wp_enqueue_style( 'clubio-body-fonts', '//fonts.googleapis.com/css?family='. $clubio_g_font );
    }

    if ( $clubio_h_font && $clubio_h_font != '-' ) {
        $font_pieces = explode(":", $clubio_h_font);
        ?>

    .tt-btn,
    .tt-btn-default span, .tt-btn-default:hover span,
    .tt-link,
    .section-title .section-title__text,
    .section-title .section-title__text-under,
    .section-title .link-01,
    .blocktitle .tt-title,
    .blocktitle .tt-title-under,
    .tt-subtitle,
    #tt-header .nav-btn li a,
    #tt-nav > ul > li,
    #tt-nav > ul > li ul li a,
    .panel-menu #mm0.mmpanel a:not(.mm-close),
    .panel-menu .mmpanel:not(#mm0) a:not(.mm-original-link),
    .panel-menu li.mm-close-parent .mm-close,
    .panel-menu .mm-original-link,
    #subtitle-wrapper .subtitle__title,
    .mainSlider .slide .mainSlider-textmask,
    .mainSlider .slide .slide-content .container .tt-title-02,
    .event-item02 .event-item02__content .tt-title,
    .events-wide .events-wide__img .tt-text,
    .tt-promo01 .tt-promo01__layout .tt-title,
    .tt-parallax01 .tt-parallax01__title,
    tt-box01 .tt-box01__title .tt-title01,
    .promo02 .promo02__title,
    .promo-box-wide .tt-item .tt-item__label,
    .contact-info__title,
    .contact-info .contact-info__content .tt-title,
    .ttcalendar-layout01 .tt-day-grid > *,
    .tickets-wide__item .tickets-wide__description .tickets-wide__label,
    .tickets-col .tickets-col__img .tickets-col__btn,
    .tickets-col .tickets-col__title,
    .gallery-innerlayout .gallery__title,
    .gallery-externallayout .gallery__title,
    .tt-news .tt-news__title,
    .tt-block-aside .tt-aside-title, .widget-area .tt-widget-title,
    .tt-aside-post .tt-item .tt-item__title,
    .tt-comments-layout .tt-comments-layout__title,
    .tt-comments-layout .tt-item div[class^="tt-comments-level-"] .tt-content .tt-comments-title .username,
    .news-single .news-single__title,
    .news-single .news-single__subtitle,
    .news-single__meta .news-single__meta__label,
    #tt-pageContent .personal-box .personal-box__title,
    .form-single-post .tt-form-title,
    .tt-skinSelect-02 .SumoSelect,
    .modal .modal-body .modal-titleblock .modal-title,
    .modal .modal-body .modal-titleblock .modal-title__label,
    .modal-baytickets .countdown-row .countdown-section .countdown-amount,
    .modal-baytickets .baytickets__timing dt,
    .modal-baytickets .baytickets__timing dd,
    .f-nav ul > li > a,
    .f-info .f-info__content .tt-title,
    h1, h2, h3, h4, h5, h6 ,
    .wp-block-file .wp-block-file__button ,
    .tickets-wide__item .tickets-wide__description .tickets-wide__title,
    .pagination li a,
    .woocommerce .simple-pagination nav.woocommerce-pagination ul li a,
    .woocommerce .simple-pagination nav.woocommerce-pagination ul li span,
    .wpcf7-form .tt-btn-default span input[type="submit"],
    .tt-obj-languages .lang-count01,
    .news-single__data + .tt-news__title,.search-empty .tt-news__title, .post-teaser h2,
    .tt-col-categories .news-single__meta__label,
    .tt-comments-layout .comment-reply-title,
    .tt-btn-default .ch-comment-btn,
    .post-navigation .nav-links .nav-title,
    .wp-block-button__link,
    .rightColumn .widget-title,
    .button, button, input[type="button"], input[type="reset"],input[type="submit"],.is-style-outline .wp-block-button__link,
    .bliss_loadmore span{
    font-family:"<?php echo esc_attr ( $font_pieces[0]); ?>"; }

    <?php
    }
    if ( $clubio_g_font && $clubio_g_font !='-' ) {
        $font_pieces1 = explode(":", $clubio_g_font); ?>

    body,
    #tt-header .tt-obj.tt-obj-search .tt-dropdown-menu form .tt-search-input,
    #tt-header .tt-obj.tt-obj-search .tt-view-all,
    .newsletterform-01 .form-group .tt-input,
    .ttcalendar-layout01 .tt-day-grid .tt-day-event__time,
    .tt-skinSelect-01 .SumoSelect .SelectBox,
    .form-default .form-control,
    .modal-layout-dafault .form-group > label,
    .modal-layout-dafault .form-control,
    .tt-skinSelect-01 .tt-select,
    .wp-block-search .wp-block-search__input{
    font-family:"<?php echo esc_attr ($font_pieces1[0]); ?>"};
    <?php  }   ?>
<?php
    $css = ob_get_clean();
    return $css;
}