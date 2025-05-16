<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clubio
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg7">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="profile" href="//gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!--cv_1.1-->
<?php wp_body_open(); ?>
<div class="pre-loader">
    <div class="sk-fading-circle">
        <div class="sk-circle1 sk-circle"></div>
        <div class="sk-circle2 sk-circle"></div>
        <div class="sk-circle3 sk-circle"></div>
        <div class="sk-circle4 sk-circle"></div>
        <div class="sk-circle5 sk-circle"></div>
        <div class="sk-circle6 sk-circle"></div>
        <div class="sk-circle7 sk-circle"></div>
        <div class="sk-circle8 sk-circle"></div>
        <div class="sk-circle9 sk-circle"></div>
        <div class="sk-circle10 sk-circle"></div>
        <div class="sk-circle11 sk-circle"></div>
        <div class="sk-circle12 sk-circle"></div>
    </div>
</div>
<nav class="panel-menu" id="mobile-menu">
    <ul></ul>
    <div class="mm-navbtn-names">
        <div class="mm-closebtn"><?php echo esc_attr('Close','clubio'); ?></div>
        <div class="mm-backbtn"><?php echo esc_attr('Back','clubio'); ?></div>
    </div>
</nav>
<header id="tt-header" class="align-items-center <?php echo (clubio_sidebars('sb_header_info_btns') ? 'col-btns-full' : 'col-no-btns'); ?>">
    <div class="tt-holder">
        <div class="tt-col">
            <?php
                if (function_exists('clubio_logo_svg')) {
                    clubio_logo_svg();
                } elseif ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    echo '<a class="bloginfo_name tt-logo tt-logo-alignment" href="'.esc_url( home_url( '/' ) ).'" rel="home">'.esc_attr(get_bloginfo( 'name' )).'</a>';
                }
            ?>
        </div>
        <div class="tt-col tt-col tt-desctop-parent tt-wide">
            <?php if ( has_nav_menu( 'clubio_header_navigation' ) ) { ?>
            <?php get_template_part( 'template-parts/navigation/navigation', 'tt-top' ); ?>
            <?php } elseif (has_nav_menu( 'top' )) { ?>
            <?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
            <?php } ?>
        </div>
        <?php if (clubio_sidebars('sb_header_info_btns')) : echo '<div class="tt-col tt-col-btns">'.clubio_sidebars('sb_header_info_btns').'</div>'; endif;?>
        <div class="tt-col tt-col-obj">
            <?php if (clubio_sidebars('sb_header_rb')) : echo clubio_sidebars('sb_header_rb'); endif;?>
            <div class="tt-obj tt-obj-toggle">
                <a href="#" class="tt-menu-toggle icon-menu icon-menu-toggle"></a>
            </div>
        </div>
    </div>
</header>
<?php add_filter( 'get_search_form', 'clubio_search_form_general' ); ?>
<div id="page" class="site">
<div class="page-main" >
        <div class="site-content-contain">
		<div id="content">