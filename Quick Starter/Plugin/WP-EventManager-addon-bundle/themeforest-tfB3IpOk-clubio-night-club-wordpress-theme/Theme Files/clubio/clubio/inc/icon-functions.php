<?php
/**
 * SVG icons related functions and filters
 *
 * @package Clubio
 */
function clubio_get_svg( $args = array() ) {
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'clubio' );
	}
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'clubio' );
	}
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'fallback'    => false,
	);
	$args = wp_parse_args( $args, $defaults );
	$aria_hidden = ' aria-hidden="true"';
	$aria_labelledby = '';
	if ( $args['title'] ) {
		$aria_hidden     = '';
		$aria_labelledby = ' aria-labelledby="title-' . uniqid() . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . uniqid() . ' desc-' . uniqid() . '"';
		}
	}
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . uniqid() . '">' . esc_attr( $args['title'] ) . '</title>';
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . uniqid() . '">' . esc_attr( $args['desc'] ) . '</desc>';
		}
	}
	$svg .= ' <use href="#icon-' . esc_attr( $args['icon'] ) . '" xlink:href="#icon-' . esc_attr( $args['icon'] ) . '"></use> ';
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}
	$svg .= '</svg>';
	return $svg;
}
function clubio_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	$social_icons = clubio_social_links_icons();

	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . clubio_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}
	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'clubio_nav_menu_social_icons', 10, 4 );
function clubio_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'top' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . clubio_get_svg( array( 'icon' => 'angle-down' ) );
			}
		}
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'clubio_dropdown_icon_to_menu_link', 10, 4 );
function clubio_social_links_icons() {
	$social_links_icons = array(
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);
	return apply_filters( 'clubio_social_links_icons', $social_links_icons );
}