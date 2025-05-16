<?php
/*
* This file use for setings at admin site for event alerts settings.
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WP_Event_Manager_Alerts_Settings class.
 */
class WP_Event_Manager_Alerts_Settings {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() 
    {		
			add_filter( 'event_manager_settings', array( $this, 'wp_event_alerts_settings' ) );
	}

	/**
	 * Return the default email content for alerts
	 */
	public function get_default_email() {
	    return "<p>Hello {display_name},<br>
						The following events were found matching your \"{alert_name}\" event alert.</p><br>
						----<br><br>
						{events}
						<br><br><p>Your next alert for this search will be sent {alert_next_date}. To manage your alerts please login and visit your alerts page here: {alert_page_url}.
						{alert_expirey}</p>";
	}
	
	/**
	 * wp_event_alerts_settings function.
	 *
	 * @access public
	 * @return void
	 */
	public function wp_event_alerts_settings($settings) 
	{
		if ( ! get_option( 'event_manager_alerts_email_template' ) ) {
			delete_option( 'event_manager_alerts_email_template' );
		}
		$settings['event_alerts'] = array(
			__( 'Event Alerts', 'wp-event-manager-alerts' ),
			apply_filters(
				'wp_event_manager_alerts_settings',
				array(
					array(
						'name' 		=> 'event_manager_alerts_email_template',
						'std' 		=> $this->get_default_email(),
						'label' 	=> __( 'Alert Email Content', 'wp-event-manager-alerts' ),
						'desc'		=> __( 'Enter the content for your email alerts. Leave blank to use the default message. The following tags can be used to insert data dynamically:', 'wp-event-manager-alerts' ) . '<br/>' .
							'<code>{display_name}</code>' . ' - ' . __( 'The users display name in WP', 'wp-event-manager-alerts' ) . '<br/>' .
							'<code>{alert_name}</code>' . ' - ' . __( 'The name of the alert being sent', 'wp-event-manager-alerts' ) . '<br/>' .
							'<code>{alert_expirey}</code>' . ' - ' . __( 'A sentance explaining if an alert will be stopped automatically', 'wp-event-manager-alerts' ) . '<br/>' .
							'<code>{alert_next_date}</code>' . ' - ' . __( 'The date this alert will next be sent', 'wp-event-manager-alerts' ) . '<br/>' .
							'<code>{alert_page_url}</code>' . ' - ' . __( 'The url to your alerts page', 'wp-event-manager-alerts' ) . '<br/>' .
							'<code>{events}</code>' . ' - ' . __( 'The name of the alert being sent', 'wp-event-manager-alerts' ) . '<br/>' .
							'',
						'type'      => 'textarea',
						'required'  => true
					),
					array(
						'name' 		=> 'event_manager_alerts_auto_disable',
						'std' 		=> '90',
						'label' 	=> __( 'Alert Duration', 'wp-event-manager-alerts' ),
						'desc'		=> __( 'Enter the number of days before alerts are automatically disabled, or leave blank to disable this feature. By default, alerts will be turned off for a search after 90 days.', 'wp-event-manager-alerts' ),
						'type'      => 'input'
					),
					array(
						'name' 		=> 'event_manager_alerts_matches_only',
						'std' 		=> 'no',
						'label' 	=> __( 'Alert Matches', 'wp-event-manager-alerts' ),
						'cb_label' 	=> __( 'Send alerts with matches only', 'wp-event-manager-alerts' ),
						'desc'		=> __( 'Only send an alert when events are found matching its criteria. When disabled, an alert is sent regardless.', 'wp-event-manager-alerts' ),
						'type'      => 'checkbox'
					),
					array(
						'name' 		=> 'event_manager_alerts_page_id',
						'std' 		=> '',
						'label' 	=> __( 'Alerts Page ID', 'wp-event-manager-alerts' ),
						'desc'		=> __( 'So that the plugin knows where to link users to view their alerts, you must select the page where you have placed the [event_alerts] shortcode.', 'wp-event-manager-alerts' ),
						'type'      => 'page'
					)
				)
			)
		);
		return $settings;
	} 
}
new WP_Event_Manager_Alerts_Settings();