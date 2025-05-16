<?php

if ( ! function_exists( 'boldlab_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string - plugin name
	 *
	 * @return bool
	 */
	function boldlab_is_installed( $plugin ) {
		
		switch ( $plugin ) {
			case 'framework';
				return class_exists( 'QodeFramework' );
				break;
			case 'core';
				return class_exists( 'BoldlabCore' );
				break;
			case 'gutenberg-page';
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'boldlab_include_theme_is_installed' ) ) {
	function boldlab_include_theme_is_installed( $installed, $plugin ) {
		
		if( $plugin === 'theme' ) {
			return class_exists( 'BoldlabHandler' );
		}
		
		return $installed;
	}
	
	add_filter( 'qode_framework_filter_is_plugin_installed', 'boldlab_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'boldlab_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params array of parameters to pass to template
	 */
	function boldlab_template_part( $module, $template, $slug = '', $params = array() ) {
		echo boldlab_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'boldlab_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function boldlab_get_template_part( $module, $template, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = BOLDLAB_INC_ROOT_DIR . '/' . $module;
		
		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}
		
		$template = '';
		
		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";
				
				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}
		
		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}
		
		return $html;
	}
}

if ( ! function_exists( 'boldlab_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param $status string - success or error
	 * @param $message string - ajax message value
	 * @param $data string|array - returned value
	 * @param $redirect string - url address
	 */
	function boldlab_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => $status,
			'message'  => $message,
			'data'     => $data,
			'redirect' => $redirect
		);
		
		$output = json_encode( $response );
		
		exit( $output );
	}
}

if ( ! function_exists( 'boldlab_get_icon' ) ) {
	/**
	 * Function that return icon html
	 *
	 * @param $icon string - icon class name
	 * @param $icon_pack string - icon pack name
	 * @param $backup_text string - backup text label if framework is not installed
	 * @param $params array - icon parameters
	 *
	 * @return string|mixed
	 */
	function boldlab_get_icon( $icon, $icon_pack, $backup_text, $params = array() ) {
		$value = boldlab_is_installed( 'framework' ) && boldlab_is_installed( 'core' ) ? qode_framework_icons()->render_icon( $icon, $icon_pack, $params ) : esc_html( $backup_text );
		
		return $value;
	}
}

if ( ! function_exists( 'boldlab_render_icon' ) ) {
	/**
	 * Function that render icon html
	 *
	 * @param $icon string - icon class name
	 * @param $icon_pack string - icon pack name
	 * @param $backup_text string - backup text label if framework is not installed
	 * @param $params array - icon parameters
	 */
	function boldlab_render_icon( $icon, $icon_pack, $backup_text, $params = array() ) {
		echo boldlab_get_icon( $icon, $icon_pack, $backup_text, $params );
	}
}

if ( ! function_exists( 'boldlab_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param $params array - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function boldlab_get_button_element( $params ) {
		if ( class_exists( 'BoldlabCoreButtonShortcode' ) ) {
			return BoldlabCoreButtonShortcode::call_shortcode( $params );
		} else {
			$link   = isset( $params['link'] ) ? $params['link'] : '#';
			$target = isset( $params['target'] ) ? $params['target'] : '_self';
			$text   = isset( $params['text'] ) ? $params['text'] : '';
			
			return '<a itemprop="url" class="qodef-theme-button" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $text ) . '</a>';
		}
	}
}

if ( ! function_exists( 'boldlab_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param $params array - array of parameters
	 */
	function boldlab_render_button_element( $params ) {
		echo boldlab_get_button_element( $params );
	}
}

if ( ! function_exists( 'boldlab_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param $class string
	 */
	function boldlab_class_attribute( $class ) {
		echo boldlab_get_class_attribute( $class );
	}
}

if ( ! function_exists( 'boldlab_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param $class string
	 *
	 * @return string|mixed
	 */
	function boldlab_get_class_attribute( $class ) {
		$value = boldlab_is_installed( 'framework' ) ? qode_framework_get_class_attribute( $class ) : '';
		
		return $value;
	}
}