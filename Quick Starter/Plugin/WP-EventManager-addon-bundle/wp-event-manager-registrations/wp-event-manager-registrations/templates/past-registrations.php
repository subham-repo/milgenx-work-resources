<table class="wpem-main wpem-responsive-table-wrapper event-manager-past-registrations">
	<thead>
		<tr>
			<th class="wpem-heading-text"><?php _e( 'Event', 'wp-event-manager-registrations' ); ?></th>
			<th class="wpem-heading-text"><?php _e( 'Date Registered', 'wp-event-manager-registrations' ); ?></th>
			<th class="wpem-heading-text"><?php _e( 'Status', 'wp-event-manager-registrations' ); ?></th>	
			<th class="wpem-heading-text"><?php _e( 'Unregister', 'wp-event-manager-registrations' ); ?></th>		
		</tr>
	</thead>
	<?php foreach ( $registrations as $registration ) {
		global $wp_post_statuses;

		$registration_id = $registration->ID;
		$event_id         = wp_get_post_parent_id( $registration_id );
		$event            = get_post( $event_id );
		$event_title      = get_post_meta( $registration_id, '_event_registered_for', true ); ?>

		<tr>
			 <td data-title="<?php _e( 'Event', 'wp-event-manager-registrations' ); ?>">
			 	<?php if ( $event && $event->post_status == 'publish' ) { ?>
			 		<a href="<?php echo esc_url( get_permalink( $event_id ) ); ?>"><?php echo esc_html( $event_title ); ?></a>
			 	<?php } else {
			 		echo esc_html( $event_title );
			 	} ?>
			 </td>
			  <td data-title="<?php _e( 'Date Registered', 'wp-event-manager-registrations' ); ?>">
			 	<?php echo esc_html( get_the_date( get_option( 'date_format' ), $registration_id ) ); ?>
			 </td>
			 <td data-title="<?php _e( 'Status', 'wp-event-manager-registrations' ); ?>">
			 	<?php echo esc_html( $wp_post_statuses[ get_post_status( $registration_id ) ]->label ); ?>
			 </td>	
			 <td data-title="<?php _e( 'Unregister', 'wp-event-manager-registrations' ); ?>"> 
			 	<a  href="<?php echo add_query_arg('unregister',$registration_id);?>" class="wpem-theme-button unregister-attendee"><span><?php _e( 'Unregister', 'wp-event-manager-registrations' ); ?></span></a>
			 </td>		
		</tr>

	<?php } ?>
</table>
<?php get_event_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>

<?php wp_reset_postdata(); ?>