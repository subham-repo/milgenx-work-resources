<?php

if ( ! function_exists( 'boldlab_get_search_page_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on search page
	 *
	 * @return int
	 */
	function boldlab_get_search_page_excerpt_length() {
		$length = apply_filters( 'boldlab_filter_search_page_excerpt_length', 180 );
		
		return intval( $length );
	}
}
