<?php

if ( ! function_exists( 'boldlab_get_new_posts' ) ) {
	/**
	 * Function that load new posts for pagination functionality
	 *
	 * @return void
	 */
	function boldlab_get_new_posts() {

		if ( ! isset( $_POST ) || empty( $_POST ) ) {
			boldlab_get_ajax_status( 'error', esc_html__( 'Post is invalid', 'boldlab' ) );
		} else {
			$options = isset( $_POST['options'] ) ? $_POST['options'] : array();

			if ( ! empty( $options ) ) {
				$plugin     = $options['plugin'];
				$module     = $options['module'];
				$shortcode  = $options['shortcode'];
				$query_args = boldlab_get_query_params( $options );

				$options['query_result'] = new \WP_Query( $query_args );
				if ( isset( $options['object_class_name'] ) && ! empty( $options['object_class_name'] ) ) {
					$options['this_shortcode'] = new $options['object_class_name'](); // needed for pagination loading items since object is not transferred via data params
				}

				ob_start();

				$get_template_part = $plugin . '_get_template_part';

				// Variable name is function name - escaped no need
				echo apply_filters( "boldlab_filter_{$get_template_part}", $get_template_part( $module . '/' . $shortcode, 'templates/loop', '', $options ) );

				$html = ob_get_contents();

				ob_end_clean();

				boldlab_get_ajax_status( 'success', esc_html__( 'Items are loaded', 'boldlab' ), $html );
			} else {
				boldlab_get_ajax_status( 'error', esc_html__( 'Options are invalid', 'boldlab' ) );
			}
		}
	}

	add_action( 'wp_ajax_nopriv_boldlab_get_new_posts', 'boldlab_get_new_posts' );
	add_action( 'wp_ajax_boldlab_get_new_posts', 'boldlab_get_new_posts' );
}

if ( ! function_exists( 'boldlab_get_query_params' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param $params array - options value
	 *
	 * @return array
	 */
	function boldlab_get_query_params( $params ) {
		$post_type      = isset( $params['post_type'] ) && ! empty( $params['post_type'] ) ? $params['post_type'] : 'post';
		$posts_per_page = isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ? $params['posts_per_page'] : - 1;

		$args = array(
			'post_status'         => 'publish',
			'post_type'           => esc_attr( $post_type ),
			'posts_per_page'      => $posts_per_page,
			'orderby'             => $params['orderby'],
			'order'               => $params['order'],
			'ignore_sticky_posts' => 1
		);

		if ( isset( $params['next_page'] ) && ! empty( $params['next_page'] ) ) {
			$args['paged'] = intval( $params['next_page'] );
		} else {
			$args['paged'] = 1;
		}

		if ( isset( $params['additional_query_args'] ) && ! empty( $params['additional_query_args'] ) ) {
			foreach ( $params['additional_query_args'] as $key => $value ) {
				$args[ esc_attr( $key ) ] = $value;
			}
		}

		return apply_filters( 'boldlab_filter_query_params', $args, $params );
	}
}

if ( ! function_exists( 'boldlab_get_pagination_data' ) ) {
	/**
	 * Function that return pagination data
	 *
	 * @param $plugin string - plugin name
	 * @param $module string - module name
	 * @param $shortcode string - shortcode name
	 * @param $post_type string - post type value
	 * @param $params array - shortcode params
	 *
	 * @return array
	 */
	function boldlab_get_pagination_data( $plugin, $module, $shortcode, $post_type, $params ) {
		$data = array();

		if ( ! empty( $post_type ) && ! empty( $params ) ) {
			$additional_params = array(
				'plugin'        => str_replace( '-', '_', esc_attr( $plugin ) ),
				'module'        => esc_attr( $module ),
				'shortcode'     => esc_attr( $shortcode ),
				'post_type'     => esc_attr( $post_type ),
				'next_page'     => '2',
				'max_pages_num' => $params['query_result']->max_num_pages
			);

			unset( $params['query_result'] );

			if ( isset( $params['holder_classes'] ) ) {
				unset( $params['holder_classes'] );
			}

			if ( isset( $params['slider_attr'] ) ) {
				unset( $params['slider_attr'] );
			}

			$data = json_encode( array_filter( array_merge( $additional_params, $params ) ) );
		}

		return $data;
	}
}

if ( ! function_exists( 'boldlab_add_link_pages' ) ) {
	/**
	 * Function which add pagination for blog single and page
	 */
	function boldlab_add_link_pages() {
		$args_pages = array(
			'before'      => '<div class="qodef-single-links qodef-m"><span class="qodef-m-single-links-title">' . esc_html__( 'Pages: ', 'boldlab' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%'
		);

		wp_link_pages( $args_pages );
	}

	add_action( 'boldlab_action_after_blog_single_content', 'boldlab_add_link_pages' );
	add_action( 'boldlab_action_after_page_content', 'boldlab_add_link_pages' );
}