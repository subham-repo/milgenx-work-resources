<?php

if ( ! function_exists( 'boldlab_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function boldlab_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'boldlab_filter_mobile_header_template', boldlab_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}
	
	add_action( 'boldlab_action_page_header_template', 'boldlab_load_page_mobile_header' );
}

if ( ! function_exists( 'boldlab_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function boldlab_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'boldlab_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'boldlab' ) ) );
		
		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}
	
	add_action( 'boldlab_action_after_include_modules', 'boldlab_register_mobile_navigation_menus' );
}