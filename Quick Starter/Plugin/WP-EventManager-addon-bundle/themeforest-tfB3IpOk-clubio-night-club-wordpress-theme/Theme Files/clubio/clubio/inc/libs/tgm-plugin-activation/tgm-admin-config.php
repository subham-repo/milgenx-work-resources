<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
require_once get_template_directory() . '/inc/libs/tgm-plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'clubio_register_plugins' );
function clubio_register_plugins() {
    $plugins = array(
        array(
            'name'     => esc_html__('One Click Demo Import','clubio'),
            'slug'     => 'one-click-demo-import',
            'required' => true,
        ),

        array(
            'name'      => esc_html__('Clubio Core','clubio'),
            'slug'      => 'theme-core',
            'source'    => get_template_directory() . '/inc/libs/tgm-plugin-activation/plugins/theme-core.zip',
            'required'  => true,
            'version'  => '1.2.1'
        ),
        array(
            'name'     => esc_html__('WooCommerce','clubio'),
            'slug'     => 'woocommerce',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Contact Form 7','clubio'),
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'      => esc_html__('WPBakery Visual Composer','clubio'),
            'slug'      => 'js_composer',
            'source'    => get_template_directory() . '/inc/libs/tgm-plugin-activation/plugins/js_composer.zip',
            'required'  => true
        ),
        array(
            'name'     => esc_html__('WP Reset','clubio'),
            'slug'     => 'wp-reset',
            'required' => false,
        )
    );
    $config = array(
        'id'           => 'clubio',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true,
        'message'      => '',
    );
    tgmpa( $plugins, $config );
}
