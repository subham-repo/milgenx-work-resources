<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * WP_Event_Manager_Registrations_Past class.
 */
class WP_Event_Manager_Registrations_Past {

	/**
	 * Constructor
	 */
	function __construct() {
 		add_shortcode( 'past_registrations', array( $this, 'past_registrations' ) );
 		add_shortcode( 'my_registrations', array( $this, 'past_registrations' ) );
    }

    /**
     * Past Registrations
     */
    public function past_registrations( $atts ) {
        
        //add js for confirmation dialog for unregister user
        wp_register_script( 'wp-event-manager-past-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_URL . '/assets/js/past-registrations.min.js', array( 'jquery' ), EVENT_MANAGER_REGISTRATIONS_VERSION, true );
        
        wp_localize_script( 'wp-event-manager-past-registrations', 'event_manager_registration', array(
            'i18n_confirm_delete'         => __( 'Are you sure you want to delete this? There is no undo.', 'wp-event-manager-registrations' )
        ) );
        wp_enqueue_script( 'wp-event-manager-past-registrations' );
        
    	// If user is not logged in, abort
    	if ( ! is_user_logged_in() ) {
			do_action( 'event_manager_event_registrations_past_registration_login' );
			
			ob_start();
			if ( get_option( 'wp_event_manager_version' ) > '3.1.13' ) {
				get_event_manager_template( 'sign-in-link.php' );
			}
			else{
				get_event_manager_template( 
					'registration-form-login.php', 
					array(), 
					'wp-event-manager-registrations', 
					EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/'
				);
			}
			return ob_get_clean();
		}
		
		if ( isset($_REQUEST['unregister']) && ! empty( $_REQUEST['unregister'] ) ) {
			$registration_id = $_REQUEST['unregister'];
			wp_delete_post( $registration_id );
		}

		extract( shortcode_atts( array(
			'posts_per_page' => '25',
		), $atts ) );

    	$args = apply_filters( 'event_manager_event_registrations_past_args', array(
			'post_type'           => 'event_registration',
			'post_status'         => array_keys( get_event_registration_statuses() ),
			'posts_per_page'      => $posts_per_page,
			'offset'              => ( max( 1, get_query_var('paged') ) - 1 ) * $posts_per_page,
			'ignore_sticky_posts' => 1,
			'meta_key'            => '_attendee_user_id',
			'meta_value'          => get_current_user_id(),
		) );

		$registrations = new WP_Query( $args );

		ob_start();

		if ( $registrations->have_posts() ) {
			get_event_manager_template( 'past-registrations.php', array( 'registrations' => $registrations->posts, 'max_num_pages' => $registrations->max_num_pages ), 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/' );
		} else {
			get_event_manager_template( 'past-registrations-none.php', array(), 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/' );
		}

		return ob_get_clean();
    }

}

new WP_Event_Manager_Registrations_Past();