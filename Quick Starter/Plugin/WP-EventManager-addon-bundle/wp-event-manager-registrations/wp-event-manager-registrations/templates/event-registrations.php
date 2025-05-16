<div class="wpem-dashboard-main-header">
	<div class="wpem-dashboard-main-title wpem-dashboard-main-filter">
		<h3 class="wpem-theme-text"><?php _e('Event Registrations List', 'wp-event-manager-registrations'); ?></h3>
	</div>
	<form class="wpem-filter-event-registrations wpem-form-wrapper filter-event-registrations" method="GET">
		<div class="wpem-events-filter">
			<div class="wpem-events-filter-block">
				<div class="wpem-form-group">
					<select name="event_id" id="event_id">
						<option value=""><?php _e('Select Event', 'wp-event-manager'); ?></option>
						<?php if (!empty($events)) : ?>
							<?php foreach ($events as $key => $event) : ?>
								<option value="<?php echo esc_html($event->ID); ?>" <?php selected($event_id, $event->ID); ?>><?php echo esc_html($event->post_title); ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			</div>

			<div class="wpem-events-filter-block">
				<div class="wpem-form-group">
					<input type="text" name="registration_byname" class="registration_byname" placeholder="<?php _e('Type text and press enter', 'wp-event-manager-registrations'); ?>" value="<?php echo $registration_byname; ?>">
				</div>
			</div>

			<div class="wpem-events-filter-block">
				<div class="wpem-form-group">
					<select name="registration_status" class="registration_status">
						<option value=""><?php _e('Filter by status', 'wp-event-manager-registrations'); ?>...</option>
						<?php foreach (get_event_registration_statuses() as $name => $label) : ?>
							<option value="<?php echo esc_attr($name); ?>" <?php selected($registration_status, $name); ?>><?php echo esc_html($label); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="wpem-events-filter-block">
				<div class="wpem-form-group">
					<select name="registration_orderby" class="registration_orderby">
						<option value=""><?php _e('Newest first', 'wp-event-manager-registrations'); ?></option>
						<option value="name" <?php selected($registration_orderby, 'name'); ?>><?php _e('Sort by name', 'wp-event-manager-registrations'); ?></option>
					</select>
					<input type="hidden" name="action" value="show_registrations" />
					<?php if (!empty($_GET['page_id'])) : ?>
						<input type="hidden" name="page_id" value="<?php echo absint($_GET['page_id']); ?>" />
					<?php endif; ?>
				</div>
			</div>




		</div>
		<?php if(isset($_GET['event_id']) ||  isset($_GET['registration_byname']) || isset($_GET['registration_status']) || isset($_GET['registration_orderby'])){ ?> 
	<div class="showing_applied_filters showing-applied-filters" ><span><?php printf(__('Found %d registrations.','wp-event-manager-registrations'),$registration_data->found_posts);?></span><a href="<?php echo esc_url(add_query_arg(array('action' => 'show_registrations'),get_permalink() ) );?>" class="reset"><?php _e('Reset','wp-event-manager-registrations');?></a></div>
	<?php } ?>

	</form>


</div>
<div id="event-manager-event-registrations">
	<h3 class="wpem-theme-text"><?php if ($event_id) printf(__('The event registrations for "%s" are listed below.', 'wp-event-manager-registrations'), '<a href="' . get_permalink($event_id) . '">' . get_the_title($event_id) . '</a>'); ?></h3>

	<?php do_action('single_event_registration_dashboard_before'); ?>
	<?php
	$author_id = get_current_user_id();
	get_event_manager_template('registration-status-overview-detail.php',
								array( 'total_registrations'=>$registration_data->found_posts,
						               'total_new_registrations'=>get_event_registration_status_count_by_author($author_id,$event_id,'new'),
						               'total_confirm_registrations'=>get_event_registration_status_count_by_author($author_id,$event_id,'confirmed'),
						               'total_waiting_registrations'=>get_event_registration_status_count_by_author($author_id,$event_id,'waiting'),
						               'total_cancelled_registrations'=>get_event_registration_status_count_by_author($author_id,$event_id,'cancelled'),
						               'total_archived_registrations'=>get_event_registration_status_count_by_author($author_id,$event_id,'archived')
						               ),
								'wp-event-manager-registrations',
								EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR. '/templates/' 
	);
 ?>

	<div class="wpem-main wpem-event-registrations-list-wrapper event-registrations">
		<div class="wpem-event-regi-list-body">
			<h3 class="wpem-theme-text"><?php _e('Attendee List', 'wp-event-manager-registrations'); ?></h3>
			<?php if ($registrations) : ?>
				<?php foreach ($registrations as $registration) : ?>
					<?php if (isset($registration->post_title) && !empty($registration->post_title)) : ?>
						<div class="event-registration wpem-event-regi-list" id="registration-<?php esc_attr_e($registration->ID); ?>">
							<div class="wpem-event-regi-list-head">
								<div class="wpem-event-regi-list-head-left">
									<div class="wpem-event-regi-info">
										<?php event_registration_header($registration); ?>
									</div>
								</div>
								<div class="wpem-event-regi-list-head-right">
									<div class="wpem-event-regi-status-label" title="<?php printf(__('Registration Status: %s ', 'wp-event-manager'),  $registration->post_status); ?>">
										<div class="wpem-event-regi-status-label-text wpem-<?= $registration->post_status; ?>-label"><?php printf(__(' %s ', 'wp-event-manager'),  $registration->post_status); ?></div>
									</div>
									<div class="wpem-event-regi-checkin-out">
										<?php
										$check_in = get_post_meta($registration->ID, '_check_in', true);
										if (isset($check_in) && $check_in == true) {
											$checkin_hidden =   'hidden';
											$undo_hidden = '';
										} else {
											$checkin_hidden = '';
											$undo_hidden = 'hidden';
										}
										echo "<span class='" . $checkin_hidden . "'><a href='#' class='button-secondary registration-checkin' data-source='web' data-value='1' data-registration-id='" . $registration->ID . "'>" . __('Check in', 'wp-event-manager-registrations') . "</a></span>";
										echo "<span class='" . $undo_hidden . "'><a href='#' class='button-secondary registration-uncheckin' data-source='' data-value='0' data-registration-id='" . $registration->ID . "' >" . __('Undo Check in', 'wp-event-manager-registrations') . "</a></span>";
										?>
									</div>
								</div>
							</div>
							<div class="wpem-event-regi-list-footer">

								<?php do_action('event_registration_dashboard_footer_start', $registration->ID); ?>

								<div class="wpem-event-regi-footer-action-bar">
									<?php event_registration_footer($registration); ?>
								</div>

								<section class="event-registration-content">
									<label class="wpem-form-label-text" for="registration-content"><?php _e( 'More info', 'wp-event-manager-registrations' ); ?>:</label>
									<?php do_action('event_registration_dashboard_meta_start', $registration->ID); ?>
									<?php event_registration_meta($registration); ?>
									<?php /* No need now: event_registration_content( $registration ); */ ?>
									<?php do_action('event_registration_dashboard_meta_end', $registration->ID); ?>
								</section>

								<section class="event-registration-edit">
									<?php event_registration_edit($registration); ?>
								</section>

								<section class="event-registration-notes">
										<label class="wpem-form-label-text" for="registration-content"><?php _e( 'Notes', 'wp-event-manager-registrations' ); ?>:</label>

									<?php event_registration_notes($registration); ?>
								</section>

								<?php do_action('event_registration_dashboard_footer_end', $registration->ID); ?>

							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>

				<?php get_event_manager_template('pagination.php', array('max_num_pages' => $max_num_pages)); ?>

			<?php else : ?>
				<div class="wpem-alert wpem-alert-danger"><?php _e('There are currently no result.', 'wp-event-manager-registrations'); ?></div>
			<?php endif; ?>
		</div>

		<?php do_action('single_event_registration_dashboard_after'); ?>

	</div>
