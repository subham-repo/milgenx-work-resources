<?php
/**
 * Custom header implementation
 *
 * @package clubio
 */
function clubio_custom_header_setup() {
	add_theme_support(
		'custom-header',
		apply_filters(
			'clubio_custom_header_args',
			array(
				'default-image'    => get_parent_theme_file_uri( '/assets/images/subtitle-wrapper01.jpg' ),
				'width'            => 2881,
				'height'           => 437,
				'flex-height'      => true,
			)
		)
	);
	register_default_headers(
		array(
			'default-image' => array(
				'url'           => '%s/assets/images/subtitle-wrapper01.jpg',
				'thumbnail_url' => '%s/assets/images/subtitle-wrapper01.jpg',
				'description'   => esc_html__( 'Default Header Image', 'clubio' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'clubio_custom_header_setup' );