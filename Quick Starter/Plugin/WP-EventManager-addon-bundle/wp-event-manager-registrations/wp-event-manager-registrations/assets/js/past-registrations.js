jQuery(document).ready(function($) {

	jQuery(".event-manager-past-registrations").on( 'click', 'a.unregister-attendee', function() {
		return confirm(event_manager_registration.i18n_confirm_delete);     
	});
});