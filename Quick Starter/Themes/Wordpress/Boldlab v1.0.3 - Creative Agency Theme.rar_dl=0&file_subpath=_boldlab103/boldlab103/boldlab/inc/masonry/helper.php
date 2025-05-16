<?php
if ( ! function_exists( 'boldlab_include_masonry_scripts' ) ) {
	/**
	 * Function that include modules 3rd party scripts
	 */
	function boldlab_include_masonry_scripts() {
		wp_enqueue_script( 'isotope', BOLDLAB_INC_ROOT . '/masonry/assets/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'packery', BOLDLAB_INC_ROOT . '/masonry/assets/js/plugins/packery-mode.pkgd.min.js', array( 'jquery' ), false, true );
	}
}

if ( ! function_exists( 'boldlab_enqueue_masonry_scripts_for_templates' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts for templates
	 */
	function boldlab_enqueue_masonry_scripts_for_templates() {
		$post_type = apply_filters( 'boldlab_filter_allowed_post_type_to_enqueue_masonry_scripts', '' );

		if ( ! empty( $post_type ) && is_singular( $post_type ) ) {
			boldlab_include_masonry_scripts();
		}
	}

	add_action( 'boldlab_action_before_main_js', 'boldlab_enqueue_masonry_scripts_for_templates' );
}

if ( ! function_exists( 'boldlab_enqueue_masonry_scripts_for_shortcodes' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts for shortcodes
	 *
	 * @param $atts array
	 */
	function boldlab_enqueue_masonry_scripts_for_shortcodes( $atts ) {

		if ( isset( $atts['behavior'] ) && $atts['behavior'] == 'masonry' ) {
			boldlab_include_masonry_scripts();
		}
	}

	add_action( 'boldlab_core_action_list_shortcodes_load_assets', 'boldlab_enqueue_masonry_scripts_for_shortcodes' );
}