<?php

if ( ! class_exists( 'BoldlabHandler' ) ) {
	/**
	 * Main theme class with configuration
	 */
	class BoldlabHandler {
		private static $instance;

		public function __construct() {

			// Include required files
			require_once get_template_directory() . '/constants.php';
			require_once BOLDLAB_ROOT_DIR . '/helpers/helper.php';

			// Include theme's scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'include_scripts' ) );

			// Add inline style
			add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_style' ) );

			// Localize theme's main js script
			add_action( 'wp_enqueue_scripts', array( $this, 'localize_js_scripts' ) );

			// Include theme's 3rd party plugins styles
			add_action( 'boldlab_action_before_main_css', array( $this, 'include_plugins_styles' ) );

			// Include theme's googlefonts
			add_action( 'boldlab_action_before_main_css', array( $this, 'include_google_fonts' ) );

			// Include theme's 3rd party plugins scripts
			add_action( 'boldlab_action_before_main_js', array( $this, 'include_plugins_scripts' ) );

			// Add theme's supports feature
			add_action( 'after_setup_theme', array( $this, 'set_theme_support' ) );

			// Enqueue supplemental block editor styles
			add_action( 'enqueue_block_editor_assets', array( $this, 'editor_customizer_styles' ) );

			// Add theme's body classes
			add_filter( 'body_class', array( $this, 'add_body_classes' ) );

			// Include modules
			add_action( 'after_setup_theme', array( $this, 'include_modules' ) );
		}

		public static function get_instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_scripts() {
			// CSS and JS dependency variables
			$main_css_dependency = apply_filters( 'boldlab_filter_main_css_dependency', array() );
			$main_js_dependency  = apply_filters( 'boldlab_filter_main_js_dependency', array( 'jquery' ) );

			// Enqueue theme's style
			wp_enqueue_style( 'boldlab-style-handle-style', BOLDLAB_ROOT . '/style.css' );

			// Hook to include additional scripts before theme's main style
			do_action( 'boldlab_action_before_main_css' );

			// Enqueue theme's main style
			wp_enqueue_style( 'boldlab-style-handle-main', BOLDLAB_ASSETS_CSS_ROOT . '/main.min.css', $main_css_dependency );

			// Hook to include additional scripts after theme's main style
			do_action( 'boldlab_action_after_main_css' );

			// Hook to include additional scripts before theme's main script
			do_action( 'boldlab_action_before_main_js' );

			// Enqueue theme's main script
			wp_enqueue_script( 'boldlab-script-handle-main-js', BOLDLAB_ASSETS_JS_ROOT . '/main.min.js', $main_js_dependency, false, true );

			// Hook to include additional scripts after theme's main script
			do_action( 'boldlab_action_after_main_js' );

			// Include comment reply script
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

		function add_inline_style() {
			$style = apply_filters( 'boldlab_filter_add_inline_style', $style = '' );

			if ( ! empty( $style ) ) {
				wp_add_inline_style( 'boldlab-style-handle-style', $style );
			}
		}

		function localize_js_scripts() {
			$global = array();

			$global['adminBarHeight'] = is_admin_bar_showing() ? 32 : 0;
			$global['ajaxUrl']        = esc_url( admin_url( 'admin-ajax.php' ) );

			$global = apply_filters( 'boldlab_filter_localize_main_js', $global );

			wp_localize_script( 'boldlab-script-handle-main-js', 'qodefGlobal', array(
				'vars' => $global
			) );
		}

		function include_plugins_styles() {

			// Enqueue 3rd party plugins style
			wp_enqueue_style( 'swiper', BOLDLAB_ASSETS_ROOT . '/plugins/swiper/swiper.min.css' );
			wp_enqueue_style( 'magnific-popup', BOLDLAB_ASSETS_ROOT . '/plugins/magnific-popup/magnific-popup.css' );
		}

		function include_plugins_scripts() {

			// JS dependency variables
			$js_3rd_party_dependency = apply_filters( 'boldlab_filter_js_3rd_party_dependency', 'jquery' );

			// Enqueue 3rd party plugins script
			wp_enqueue_script( 'waitforimages', BOLDLAB_ASSETS_ROOT . '/plugins/waitforimages/jquery.waitforimages.js', array( $js_3rd_party_dependency ), false, true );
			wp_enqueue_script( 'appear', BOLDLAB_ASSETS_ROOT . '/plugins/appear/jquery.appear.js', array( $js_3rd_party_dependency ), false, true );
			wp_enqueue_script( 'swiper', BOLDLAB_ASSETS_ROOT . '/plugins/swiper/swiper.min.js', array( $js_3rd_party_dependency ), false, true );
			wp_enqueue_script( 'magnific-popup', BOLDLAB_ASSETS_ROOT . '/plugins/magnific-popup/jquery.magnific-popup.min.js', array( $js_3rd_party_dependency ), false, true );
		}

		function include_google_fonts() {
			$protocol = is_ssl() ? 'https:' : 'http:';

			$font_subset_array = array(
				'latin-ext'
			);

			$font_weight_array = array(
				'300',
				'400',
				'500',
				'600',
				'700'
			);

			$default_font_family = array(
				'Barlow Condensed',
				'Hind'
			);

			$font_weight_str = implode( ',', array_unique( apply_filters( 'boldlab_filter_google_fonts_weight_list', $font_weight_array ) ) );
			$font_subset_str = implode( ',', array_unique( apply_filters( 'boldlab_filter_google_fonts_subset_list', $font_subset_array ) ) );
			$fonts_array     = apply_filters( 'boldlab_filter_google_fonts_list', $default_font_family );
			foreach ( $fonts_array as $font ) {
				$modified_default_font_family[] = $font . ':' . $font_weight_str;
			}

			$default_font_string = implode( '|', $modified_default_font_family );

			$fonts_full_list_args = array(
				'family' => urlencode( $default_font_string ),
				'subset' => urlencode( $font_subset_str ),
			);

			$google_fonts_url = add_query_arg( $fonts_full_list_args, $protocol . '//fonts.googleapis.com/css' );
			wp_enqueue_style( 'boldlab-style-handle-google-fonts', esc_url_raw( $google_fonts_url ), array(), '1.0.0' );
		}

		function set_theme_support() {

			// Make theme available for translation
			load_theme_textdomain( 'boldlab', BOLDLAB_ROOT_DIR . '/languages' );

			// Add support for feed links
			add_theme_support( 'automatic-feed-links' );

			// Add support for title tag
			add_theme_support( 'title-tag' );

			// Add support for post thumbnails
			add_theme_support( 'post-thumbnails' );

			// Add theme support for Custom Logo
			add_theme_support( 'custom-logo' );

			// Set the default content width
			$GLOBALS['content_width'] = apply_filters( 'boldlab_filter_set_content_width', 1300 );

			// Add support for post formats
			add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link', 'quote' ) );

			// Add theme support for editor style
			add_editor_style( BOLDLAB_ASSETS_CSS_ROOT . '/editor-style.css' );
		}

		function editor_customizer_styles() {

			// Include theme's Google fonts for Gutenberg editor
			$this->include_google_fonts();

			// Add editor customizer style
			wp_enqueue_style( 'boldlab-editor-customizer-styles', BOLDLAB_ASSETS_CSS_ROOT . '/editor-customizer-style.css' );

			// Add Gutenberg blocks style
			wp_enqueue_style( 'boldlab-gutenberg-blocks-style', BOLDLAB_INC_ROOT . '/gutenberg/assets/admin/css/gutenberg-blocks.css' );
		}

		function add_body_classes( $classes ) {
			$current_theme = wp_get_theme();
			$theme_name    = esc_attr( str_replace( ' ', '-', strtolower( $current_theme->get( 'Name' ) ) ) );
			$theme_version = esc_attr( $current_theme->get( 'Version' ) );

			// Check is child theme activated
			if ( $current_theme->parent() ) {

				// Add child theme version
				$classes[] = $theme_name . '-child-' . $theme_version;

				// Get main theme variables
				$current_theme = $current_theme->parent();
				$theme_name    = esc_attr( str_replace( ' ', '-', strtolower( $current_theme->get( 'Name' ) ) ) );
				$theme_version = esc_attr( $current_theme->get( 'Version' ) );
			}

			if ( $current_theme->exists() ) {
				$classes[] = $theme_name . '-' . $theme_version;
			}

			return $classes;
		}

		function include_modules() {

			// Hook to include additional files before modules inclusion
			do_action( 'boldlab_action_before_include_modules' );

			foreach ( glob( BOLDLAB_INC_ROOT_DIR . '/*/include.php' ) as $module ) {
				include_once $module;
			}

			// Hook to include additional files after modules inclusion
			do_action( 'boldlab_action_after_include_modules' );
		}
	}

	BoldlabHandler::get_instance();
}