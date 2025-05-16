<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * WP_Event_Manager_Registrations_Settings class.
 */
class WP_Event_Manager_Registrations_Settings extends WP_Event_Manager_Settings {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->settings_group = 'wp-event-manager-registrations';
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		add_filter( 'event_manager_google_recaptcha_settings', array($this, 'google_recaptcha_settings') );
	}

	/**
	 * init_settings function.
	 *
	 * @access protected
	 * @return void
	 */
	protected function init_settings() {
		$this->settings = apply_filters( 'event_manager_registrations_settings', array(
			'registration_forms' => array(
				__( 'Registration Forms', 'wp-event-manager-registrations' ),
				array(
					array(
						'name' 		=> 'event_registration_form_require_login',
						'std' 		=> '0',
						'label' 	=> __( 'User Restriction', 'wp-event-manager-registrations' ),
						'cb_label' 	=> __( 'Only allow registered users to register', 'wp-event-manager-registrations' ),
						'desc'		=> __( 'If enabled, only logged in users can register. Non-logged in users will see the contents of the <code>registration-form-login.php</code> file instead of a form.', 'wp-event-manager-registrations' ),
						'type'      => 'checkbox'
					),
					array(
						'name' 		=> 'event_registration_prevent_multiple_registrations',
						'std' 		=> '0',
						'label' 	=> __( 'Multiple Registrations', 'wp-event-manager-registrations' ),
						'cb_label' 	=> __( 'Prevent users from registering to the same event multiple times', 'wp-event-manager-registrations' ),
						'desc'		=> __( 'Multiple registrations is depended upon the User restriction feature. In order to avoid multiple registrations, please enable User restriction as well.', 'wp-event-manager-registrations' ),
						'type'      => 'checkbox'
					),
					array(
						'name' 		=> 'event_registration_prevent_duplicate_email',
						'std' 		=> '1',
						'label' 	=> __( 'Duplicate Email', 'wp-event-manager-registrations' ),
						'cb_label' 	=> __( 'Prevent users from registering with the same email address multiple times', 'wp-event-manager-registrations' ),
						'desc'		=> __( 'If enabled, the register form will throw error.', 'wp-event-manager-registrations' ),
						'type'      => 'checkbox'
					),
					array(
						'name'        => 'enable_event_registration_organizer_email',
						'std'         => '1',
						'cb_label' => __( 'Enable Organizer email notification', 'wp-event-manager-registrations' ),
						'label'       => __( 'Organizer Email notification', 'wp-event-manager-registrations' ),
						'desc'        => __( 'Organizer will be notified via email on registration for the event.', 'wp-event-manager-registrations' ),
						'type'        => 'checkbox'
					),
					array(
						'name'        => 'enable_event_registration_attendee_email',
						'std'         => '1',
						'cb_label' => __( 'Enable Attendee email notification', 'wp-event-manager-registrations' ),
						'label'       => __( 'Attendee Email notification', 'wp-event-manager-registrations' ),
						'desc'        => __( 'Attendee will be notified via email once registration form filled with their email.', 'wp-event-manager-registrations' ),
						'type'        => 'checkbox'
					),
					array(
						'name'        => 'event_new_registration_default_status',
						'std'         => 'new',
						'label'       => __( 'New registration default status', 'wp-event-manager-registrations' ),
						'desc'        => __( 'New registration default status. Default status is New', 'wp-event-manager-registrations' ),
						'type'       => 'select',
						'options' 	=> get_event_registration_statuses(),
					),
					array(
						'name'        => 'event_new_registration_notification_status',
						'std'         => 'confirmed',
						'label'       => __( 'New registration notification status', 'wp-event-manager-registrations' ),
						'desc'        => __( 'New registration notification status. Default status is Confirmed', 'wp-event-manager-registrations' ),
						'type'       => 'select',
						'options' 	=> get_event_registration_statuses(),
					),
				)
			),
			'registration_management' => array(
				__( 'Management', 'wp-event-manager-registrations' ),
				array(
					array(
						'name' 		=> 'event_registration_delete_with_event',
						'std' 		=> '0',
						'label' 	=> __( 'Delete with Events', 'wp-event-manager-registrations' ),
						'cb_label' 	=> __( 'Delete registrations when a event is deleted', 'wp-event-manager-registrations' ),
						'desc'		=> __( 'If enabled, event registrations will be deleted when the parent event listing is deleted. Otherwise they will be kept on file and visible in the backend.', 'wp-event-manager-registrations' ),
						'type'      => 'checkbox'
					),
					array(
						'name'        => 'event_registration_purge_days',
						'std'         => '',
						'placeholder' => __( 'Do not purge data', 'wp-event-manager-registrations' ),
						'label'       => __( 'Purge Registrations', 'wp-event-manager-registrations' ),
						'desc'        => __( 'Delete registration data and files after X days of event expiry date. Leave blank to disable.
If you enter 1, It would purge the registration data after 1 day of the event expiry day.', 'wp-event-manager-registrations' ),
						'type'        => 'text'
					)
				)
			)
		) );
	}

	public function google_recaptcha_settings($settings) {

		$settings[1][] = array(
                    'name'       => 'enable_event_manager_google_recaptcha_submit_registration_form',
                    'std'        => '1',
                    'label'      => __( 'Enable reCAPTCHA for Submit Registration Form', 'wp-event-manager-registrations' ),
                    'cb_label'   => __( 'Disable this to remove reCAPTCHA for Submit Registration Form.', 'wp-event-manager-registrations' ),
                    'desc'       => '',
                    'type'       => 'checkbox',
                    'attributes' => array(),
                );

		return $settings;
	}
}
