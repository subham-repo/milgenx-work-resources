<?php

if ( ! function_exists( 'boldlab_load_page_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function boldlab_load_page_header() {
		// Include header template
		echo apply_filters( 'boldlab_filter_header_template', boldlab_get_template_part( 'header', 'templates/header' ) );
	}
	
	add_action( 'boldlab_action_page_header_template', 'boldlab_load_page_header' );
}

if ( ! function_exists( 'boldlab_register_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function boldlab_register_navigation_menus() {
		$navigation_menus = apply_filters( 'boldlab_filter_register_navigation_menus', array( 'main-navigation' => esc_html__( 'Main Navigation', 'boldlab' ) ) );
		
		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}
	
	add_action( 'boldlab_action_after_include_modules', 'boldlab_register_navigation_menus' );
}

if ( ! function_exists( 'boldlab_get_header_logo_image' ) ) {
	/**
	 * Function that return header logo image html
	 *
	 * @return string containing html of logo image
	 */
	function boldlab_get_header_logo_image() {
		$logo_image      = '<img itemprop="logo" class="qodef-header-logo-image qodef--main" src="' . BOLDLAB_ASSETS_ROOT . '/img/logo.png' . '" alt="' . get_bloginfo( 'name', 'display' ) . '" />';
		$customizer_logo = get_custom_logo();
		
		if ( ! empty( $customizer_logo ) ) {
			$customizer_logo_id = get_theme_mod( 'custom_logo' );
			
			if ( $customizer_logo_id ) {
				$customizer_logo_id_attr = array(
					'class'    => 'qodef-header-logo-image qodef--main',
					'itemprop' => 'logo',
				);
				
				$image_alt = get_post_meta( $customizer_logo_id, '_wp_attachment_image_alt', true );
				if ( empty( $image_alt ) ) {
					$customizer_logo_id_attr['alt'] = get_bloginfo( 'name', 'display' );
				}
				
				$logo_image = wp_get_attachment_image( $customizer_logo_id, 'full', false, $customizer_logo_id_attr );
			}
		}
		
		return apply_filters( 'boldlab_filter_header_logo_image', $logo_image );
	}
}