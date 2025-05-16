<div id="event-manager-event-registrations-export">
	<div class="wpem-dashboard-main-header">
		<form action="" class="wpem-form-wrapper" method="get">
			<div class="wpem-events-filter">				
				<div class="wpem-events-filter-block">
					<div class="wpem-form-group">
						<select name="event_id" id="event_id" required="required">
							<option value=""><?php _e('Select Events','wp-event-manager');?></option>
							<?php if(!empty($events)) : ?>
								<?php foreach ($events as $key => $event) : ?>
									<option value="<?php echo esc_html( $event->ID ); ?>" <?php selected( $event_id, $event->ID ); ?>><?php echo esc_html( $event->post_title ); ?></option>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</div>
				</div>
				<div class="wpem-events-filter-block wpem-events-filter-submit">
					<div class="wpem-form-group">
						<input type="hidden" name="action" value="export_registrations">
						<input type="hidden" name="download-csv" value="1">
						<button type="submit" class="wpem-theme-button"><i class="wpem-icon-download3"></i> <?php _e('Download CSV','wp-event-manager');?></button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
