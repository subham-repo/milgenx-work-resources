<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}


$options = array(
	'event_registration_form_require_login',
	'event_registration_prevent_multiple_registrations',
	'event_registration_delete_with_event',
	'event_registration_purge_days',
	'enable_event_registration_attendee_email',
	'enable_event_registration_organizer_email',
	'event_new_registration_default_status',
);

foreach ( $options as $option ) {
	delete_option( $option );
}

$all_fields = get_option( 'event_manager_form_fields', true );
if(is_array($all_fields)){
	$sell_tickets_fields = array('registration_limit');
	foreach ($sell_tickets_fields as $key => $value) {
		if(isset($all_fields['event'][$value]))
			unset($all_fields['event'][$value]);
	}
}
update_option('event_manager_form_fields', $all_fields);



