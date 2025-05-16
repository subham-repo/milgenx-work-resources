<div class="wpem-registration-info-block notice">	

	<div class="wpem-regi-main-info-block">

		<?php do_action('admin_event_registration_status_overview_detail_before');?>
        	
    	<?php if( isset($_REQUEST['_event_listing']) && !empty($_REQUEST['_event_listing']) ) : ?>
    	<div class="wpem-regi-event-details-wrapper">
			<h3><?php _e('Event Details','wp-event-manager-registrations'); ?></h3>
			<div class="wpem-regi-event-details">

				<?php if( isset($event_link) && !empty($event_link) ) : ?>
				<div class="wpem-regi-event-details-box wpem-regi-event-details-event-name">
					<p><?php _e('Event Name','wp-event-manager-registrations'); ?></p>
					<h3><?php echo $event_link;  ?></h3>
				</div>
				<?php endif; ?>

				<?php if(!empty($event_start_date)) : ?>
				<div class="wpem-regi-event-details-box wpem-regi-event-details-event-start-dt">
					<p><?php _e('Event Start Date & Time','wp-event-manager-registrations'); ?></p>
					<h3><?php echo $event_start_date;  ?> @ <?php echo $event_start_time;  ?></h3>
				</div>
				<?php endif; ?>

				<?php if(!empty($event_end_date)) : ?>
				<div class="wpem-regi-event-details-box wpem-regi-event-details-event-end-dt">
					<p><?php _e('Event End Date & Time','wp-event-manager-registrations'); ?></p>
					<h3><?php echo $event_end_date;  ?>	@ <?php echo $event_end_time;  ?></h3>
				</div>
				<?php endif; ?>

				<?php if(!empty($event_location)) : ?>
				<div class="wpem-regi-event-details-box wpem-regi-event-details-event-venue">
					<p><?php _e('Event Venue','wp-event-manager-registrations'); ?></p>
					<h3><?php echo $event_location;  ?></h3>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php endif; ?>
        	
        	
		<div class=" wpem-regi-block-wrapper">
			<h3><?php _e('Registrations Details','wp-event-manager-registrations'); ?></h3>
			<div class="wpem-regi-block-wrap">
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-users wpem-regi-icon-t-regi"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title"><?php _e($total_registrations,'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("Total Registration",'wp-event-manager-registrations');?></div>
					</div>
				</div>
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-user-plus wpem-regi-icon-new"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title"><?php _e($total_new_registrations,'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("New",'wp-event-manager-registrations');?></div>
					</div>
				</div>
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-user-check wpem-regi-icon-confirm"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title"><?php _e($total_confirm_registrations,'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("Confirm",'wp-event-manager-registrations');?></div>
					</div>
				</div>
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-hour-glass wpem-regi-icon-waiting"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title"><?php _e($total_waiting_registrations,'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("Waiting",'wp-event-manager-registrations');?></div>
					</div>
				</div>
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-user-minus wpem-regi-icon-cancelled"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title"><?php _e($total_cancelled_registrations,'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("Cancelled",'wp-event-manager-registrations');?></div>
					</div>
				</div>
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-box-add wpem-regi-icon-archived"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title "><?php _e($total_archived_registrations,'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("Archived",'wp-event-manager-registrations');?></div>
					</div>
				</div>

				<?php if( isset($_REQUEST['_event_listing']) && !empty($_REQUEST['_event_listing']) ) : ?>
				<div class="wpem-regi-info-blocks">
					<div class="wpem-regi-info-block-icon">
						<i class="wpem-icon-checkbox-checked wpem-regi-icon-checkin"></i>
					</div>
					<div class="wpem-regi-info-block-info">
						<div class="wpem-regi-info-block-title "><?php _e( get_total_checkedin_by_event_id(),'wp-event-manager-registrations');  ?></div>
						<div class="wpem-regi-info-block-desc"><?php _e("Total Checkin",'wp-event-manager-registrations');?></div>
					</div>
				</div>
				<?php endif; ?>

				<input type="hidden" name="event_id" value="<?php echo $event_id;?>" />

			</div>
		</div>

		<?php do_action('admin_event_registration_status_overview_detail_after');?>

	</div>

</div>