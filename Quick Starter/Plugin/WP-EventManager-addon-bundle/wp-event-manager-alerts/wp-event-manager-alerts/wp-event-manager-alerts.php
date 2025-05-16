<?php
/**
Plugin Name: WP Event Manager - Event Alerts
Plugin URI: http://www.wp-eventmanager.com/product-category/plugins/
Description: Allow users to subscribe to event alerts for their searches. Once registered, users can access a 'My Alerts' page which you can create with the shortcode [event_alerts].
Author: WP Event Manager
Author URI: https://www.wp-eventmanager.com/
Text Domain: wp-event-manager-alerts
Domain Path: /languages
Version: 1.2.3
Since: 1.0
Requires WordPress Version at least: 4.1
Copyright: 2017 WP Event Manager
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'GAM_Updater' ) ) {
	include( 'autoupdater/gam-plugin-updater.php' );
}

function pre_check_before_installing_alerts() 
{
    /*
    * Check weather WP Event Manager is installed or not
    */
    if (! in_array( 'wp-event-manager/wp-event-manager.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
    {
            global $pagenow;
        	if( $pagenow == 'plugins.php' )
        	{
                echo '<div id="error" class="error notice is-dismissible"><p>';
                echo __( 'WP Event Manager is require to use WP Event Manager - Event Alerts' , 'wp-event-manager-alerts');
                echo '</p></div>';		
        	}
           		
    }
}
add_action( 'admin_notices', 'pre_check_before_installing_alerts' );

/**
 * WP_Event_Manager_Alerts class.
 */
class WP_Event_Manager_Alerts extends GAM_Updater {

	/**
	 * __construct function.
	 */
	public function __construct() {
		// Define constants
		define( 'EVENT_MANAGER_ALERTS_VERSION', '1.2.3' );
		define( 'EVENT_MANAGER_ALERTS_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'EVENT_MANAGER_ALERTS_PLUGIN_URL', untrailingslashit( plugins_url( basename( plugin_dir_path( __FILE__ ) ), basename( __FILE__ ) ) ) );
		
		//Include Sortcodes
		include( 'shortcodes/wp-event-manager-alerts-shortcodes.php' );

		// Includes
		include( 'core/wp-event-manager-alerts-post-types.php' );
		include( 'core/wp-event-manager-alerts-notifier.php' );

		//Include Admin Setings
		include( 'admin/wp-event-manager-alerts-settings.php' );
		//external 
		include('external/external.php');
		// Init classes
		$this->post_types = new WP_Event_Manager_Alerts_Post_Types();

		// Add actions
		add_action( 'init', array( $this, 'load_plugin_textdomain' ), 12 );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_filter( 'event_manager_event_filters_showing_events_links', array( $this, 'alert_link' ), 10, 2 );
		add_action( 'single_event_listing_button_end', array( $this, 'single_alert_link' ) );

		// Update legacy options
		if ( false === get_option( 'event_manager_alerts_page_id', false ) && get_option( 'event_manager_alerts_page_slug' ) ) {
			$page_id = get_page_by_path( get_option( 'event_manager_alerts_page_slug' ) )->ID;
			update_option( 'event_manager_alerts_page_id', $page_id );
		}
		
		// Init updates
		$this->init_updates( __FILE__ );
	}

	/**
	 * Localisation
	 *
	 * @access private
	 * @return void
	 */
	public function load_plugin_textdomain() {
	    
	    $domain = 'wp-event-manager-alerts';       
        $locale = apply_filters('plugin_locale', get_locale(), $domain);
		load_textdomain( $domain, WP_LANG_DIR . "/wp-event-manager-alerts/".$domain."-" .$locale. ".mo" );
		load_plugin_textdomain($domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * frontend_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {
		wp_register_script( 'event-alerts', EVENT_MANAGER_ALERTS_PLUGIN_URL . '/assets/js/event-alerts.min.js', array( 'jquery', 'chosen','wp-event-manager-common' ), EVENT_MANAGER_ALERTS_VERSION, true );
		wp_register_script( 'chosen', EVENT_MANAGER_PLUGIN_URL . '/assets/js/jquery-chosen/chosen.jquery.min.js', array( 'jquery' ), '1.1.0', true );
		wp_localize_script( 'event-alerts', 'event_manager_alerts', array(
			'i18n_confirm_delete' => __( 'Are you sure you want to delete this alert?', 'wp-event-manager-alerts' )
		) );
		wp_enqueue_style( 'event-alerts-frontend', EVENT_MANAGER_ALERTS_PLUGIN_URL . '/assets/css/frontend.min.css' );
		if(!wp_script_is('chosen'))
		wp_enqueue_style( 'chosen' );
	}

	/**
	 * Add the alert link
	 */
	public function alert_link( $links, $args ) {
		if ( is_user_logged_in() && get_option( 'event_manager_alerts_page_id' ) ) {
			if ( isset( $_POST[ 'form_data' ] ) ) {
				parse_str( $_POST[ 'form_data' ], $params );
				$alert_region = isset( $params[ 'search_region' ] ) ? absint( $params[ 'search_region' ] ) : '';
			} else {
				$alert_region = '';
			}
			$links['events-alert'] = array(
				'name' => __( 'Add alert', 'wp-event-manager-alerts' ),
				'url'  => add_query_arg( array(
					'action'         => 'add_alert',
					'alert_event_type' => $args['search_event_types'],
					'alert_location' => urlencode( $args['search_location'] ),
					'alert_cats'     => $args['search_categories'],
					'alert_keyword'  => urlencode( $args['search_keywords'] ),
					'alert_region'   => $alert_region
				), get_permalink( get_option( 'event_manager_alerts_page_id' ) ) )
			);
		}
		return $links;
	}
	
	/**
	 * Single listing alert link
	 */
	public function single_alert_link() {
		global $post, $event_preview;
				
		if ( ! empty( $event_preview ) ) {
			return;
		}
		
		if ( is_user_logged_in() && get_option( 'event_manager_alerts_page_id' ) ) {
			$event_type = get_event_type( $post );
			$event_types = array();
			if (! empty( $event_type ) ) {
				foreach ( $event_type as $type ) {
					$event_types[] = $type->name;
				}
			}
			$link     =  add_query_arg( array(
				'action'         => 'add_alert',
				'alert_name'     => urlencode( $post->post_title ),
					'alert_event_type' => $event_types,
				'alert_location' => urlencode( get_event_location( $post ) ),
				'alert_cats'     => wp_get_post_terms( $post->ID, 'event_listing_category', array( 'fields' => 'ids' ) ),
				'alert_keyword'  => urlencode( $post->post_title ),
				'alert_region'   => current( wp_get_post_terms( $post->ID, 'event_listing_region', array( 'fields' => 'ids' ) ) ),
			), get_permalink( get_option( 'event_manager_alerts_page_id' ) ) );
			get_event_manager_template( 'single-event-alert-link.php', array('alert_link' => $link), 'wp-event-manager-alerts', EVENT_MANAGER_ALERTS_PLUGIN_DIR . '/templates/' );
		}
	}
}

$GLOBALS['event_manager_alerts'] = new WP_Event_Manager_Alerts();