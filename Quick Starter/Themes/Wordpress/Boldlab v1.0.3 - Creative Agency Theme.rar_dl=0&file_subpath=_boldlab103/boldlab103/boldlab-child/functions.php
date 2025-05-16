<?php

if ( ! function_exists( 'boldlab_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function boldlab_child_theme_enqueue_scripts() {
		$main_style = 'boldlab-style-handle-main';
		
		wp_enqueue_style( 'boldlab-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'boldlab_child_theme_enqueue_scripts' );
}