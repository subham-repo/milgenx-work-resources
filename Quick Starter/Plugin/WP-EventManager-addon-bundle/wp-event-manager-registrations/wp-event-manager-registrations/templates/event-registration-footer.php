<?php global $wp_post_statuses; ?>
<div class="wpem-meta-wrapper">
<div class="meta">
    <?php do_action('event_registration_footer_meta_start',$registration);?>
	<div><?php echo date_i18n( get_option( 'date_format' ), strtotime( $registration->post_date ) ); ?></div>

	<?php $checkin_source = get_post_meta($registration->ID, '_checkin_source', true); ?>
	<?php if(!empty($checkin_source)) : ?>
		<div><?php _e( 'Source :', 'wp-event-manager-registrations' ); ?> <?php echo !empty($checkin_source) ? ucfirst($checkin_source) : ''; ?> </div>
	<?php endif; ?>
	
    <?php do_action('event_registration_footer_meta_end',$registration);?>
</div>
</div>

<div class="wpem-actions-wrapper">
<div class="actions">
	<?php do_action('event_registration_footer_action_start',$registration);?>
	<div class="edit action-btn"><a href="#" title="<?php _e( 'Edit', 'wp-event-manager-registrations' ); ?>" class="event-registration-toggle-edit"><?php _e( 'Edit', 'wp-event-manager-registrations' ); ?></a></div>
	<div class="notes action-btn <?php echo get_comments_number( $registration->ID ) ? 'has-notes' : ''; ?>"><a href="#" title="<?php _e( 'Notes', 'wp-event-manager-registrations' ); ?>" class="event-registration-toggle-notes"><?php _e( 'Notes', 'wp-event-manager-registrations' ); ?></a></div>

	<?php if ( $email = get_event_registration_email( $registration->ID ) ) : ?>
		<div class="email action-btn"><a href="mailto:<?php echo esc_attr( $email ); ?>?subject=<?php echo esc_attr( sprintf( __( 'Your event registration for %s', 'wp-event-manager-registrations' ), strip_tags( get_the_title( $event_id ) ) ) ); ?>&amp;body=<?php echo esc_attr( sprintf( __( 'Hello %s', 'wp-event-manager-registrations' ), get_the_title( $registration->ID ) ) ); ?>" title="<?php _e( 'Email', 'wp-event-manager-registrations' ); ?>" class="event-registration-contact"><?php _e( 'Email', 'wp-event-manager-registrations' ); ?></a></div>
	<?php endif; ?>

	<div class="content action-btn"><a href="#" title="<?php _e( 'Details', 'wp-event-manager-registrations' ); ?>" class="event-registration-toggle-content"><?php _e( 'Details', 'wp-event-manager-registrations' ); ?></a></div>
	<?php do_action('event_registration_footer_action_end',$registration);?>
</div>
</div>
