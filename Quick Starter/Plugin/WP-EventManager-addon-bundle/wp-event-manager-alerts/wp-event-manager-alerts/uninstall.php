<?php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$options = array(
	'event_manager_alerts_email_template',
	'event_manager_alerts_auto_disable',
	'event_manager_alerts_matches_only',
	'event_manager_alerts_page_slug',
	'event_manager_alerts_page_id'
);

foreach ( $options as $option ) {
	delete_option( $option );
}