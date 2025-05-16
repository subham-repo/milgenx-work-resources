<div id="event-manager-alerts" class="wpem-main">
	 <div class="wpem-alert wpem-alert-info"><?php printf( __( 'Your event alerts are shown in the table below. Your alerts will be sent to %s.', 'wp-event-manager-alerts' ), $user->user_email ); ?>
       <a class="pull-right" href="<?php echo remove_query_arg( 'updated', add_query_arg( 'action', 'add_alert' ) ); ?>"><?php _e( 'Add alert', 'wp-event-manager-alerts' ); ?></a>
     </div>
    <div class="wpem-responsive-table-block"> 
		<table class="wpem-responsive-table-wrapper event-manager-alerts table table-bordered event-manager-events table-striped">
			<thead>
				<tr>
					<th class="wpem-heading-text"><?php _e( 'Alert Name', 'wp-event-manager-alerts' ); ?></th>
					<th class="wpem-heading-text"><?php _e( 'Keywords', 'wp-event-manager-alerts' ); ?></th>
					<?php if ( get_option( 'event_manager_enable_categories' ) && wp_count_terms( 'event_listing_category' ) > 0 ) : ?>
					<th class="wpem-heading-text"><?php _e( 'Categories', 'wp-event-manager-alerts' ); ?></th>
					<?php endif; ?>	
					<?php if ( taxonomy_exists( 'event_listing_tag' ) ) : ?>
					<th class="wpem-heading-text"><?php _e( 'Tags', 'wp-event-manager-alerts' ); ?></th>
					<?php endif; ?>
					<th class="wpem-heading-text"><?php _e( 'Location', 'wp-event-manager-alerts' ); ?></th>
					<th class="wpem-heading-text"><?php _e( 'Frequency', 'wp-event-manager-alerts' ); ?></th>
					<th class="wpem-heading-text"><?php _e( 'Status', 'wp-event-manager-alerts' ); ?></th>
					<th class="wpem-heading-text"><?php _e( 'Date Created', 'wp-event-manager-alerts' ); ?></th>
				</tr>
			</thead>

			<tbody>
			<?php if(! empty( $alerts ) ) : ?>
				<?php foreach ( $alerts as $alert ) : ?>
					<tr>
						<td data-title="<?php _e( 'Alert Name', 'wp-event-manager-alerts' ); ?>">
							<?php echo esc_html( $alert->post_title ); ?>
							<ul class="event-alert-actions">
								<?php
									$actions = apply_filters( 'event_manager_alert_actions', array(
										'view' => array(
											'label' => __( 'Show Results', 'wp-event-manager-alerts' ),
											'nonce' => false
										),
										'email' => array(
											'label' => __( 'Email', 'wp-event-manager-alerts' ),
											'nonce' => true
										),
										'edit' => array(
											'label' => __( 'Edit', 'wp-event-manager-alerts' ),
											'nonce' => false
										),
										'toggle_status' => array(
											'label' => $alert->post_status == 'draft' ? __( 'Enable', 'wp-event-manager-alerts' ) : __( 'Disable', 'wp-event-manager-alerts' ),
											'nonce' => true
										),
										'delete' => array(
											'label' => __( 'Delete', 'wp-event-manager-alerts' ),
											'nonce' => true
										)
									), $alert );

									foreach ( $actions as $action => $value ) {
										$action_url = remove_query_arg( 'updated', add_query_arg( array( 'action' => $action, 'alert_id' => $alert->ID ) ) );

										if ( $value['nonce'] )
											$action_url = wp_nonce_url( $action_url, 'event_manager_alert_actions' );

										echo '<li><a href="' . $action_url . '" class="event-alerts-action-' . $action . '">' . $value['label'] . '</a></li>';
									}
								?>
							</ul>
						</td>
						<td data-title="<?php _e( 'Keywords', 'wp-event-manager-alerts' ); ?>" class="alert_keyword"><?php
							if ( $value = get_post_meta( $alert->ID, 'alert_keyword', true ) )
								echo esc_html( $value );
							else
								echo '&ndash;';
						?></td>
						<?php if ( get_option( 'event_manager_enable_categories' ) && wp_count_terms( 'event_listing_category' ) > 0 ) : ?>
						<td data-title="<?php _e( 'Categories', 'wp-event-manager-alerts' ); ?>" class="alert_category"><?php
							$terms = wp_get_post_terms( $alert->ID, 'event_listing_category', array( 'fields' => 'names' ) );
							echo $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
						?></td>
						<?php endif; ?>
						<?php if ( taxonomy_exists( 'event_listing_tag' ) ) : ?>
						<td data-title="<?php _e( 'Tags', 'wp-event-manager-alerts' ); ?>" class="alert_tag"><?php
							$terms = wp_get_post_terms( $alert->ID, 'event_listing_tag', array( 'fields' => 'names' ) );
							echo $terms ? esc_html( implode( ', ', $terms ) ) : '&ndash;';
						?></td>
						<?php endif; ?>					
						<td  data-title="<?php _e( 'Location', 'wp-event-manager-alerts' ); ?>" class="alert_location"><?php
							if ( $value = get_post_meta( $alert->ID, 'alert_location', true ) )
								echo esc_html($value);
							else
								echo '&ndash;';
						?></td>
						<td data-title="<?php _e( 'Frequency', 'wp-event-manager-alerts' ); ?>" class="alert_frequency"><?php
							switch ( $freq = get_post_meta( $alert->ID, 'alert_frequency', true ) ) {
								case "daily" :
									_e( 'Daily', 'wp-event-manager-alerts' );
								break;
								case "weekly" :
									_e( 'Weekly', 'wp-event-manager-alerts' );
								break;
								case "fornightly" :
									_e( 'Fornightly', 'wp-event-manager-alerts' );
								break;
							}
						?></td>
						<td data-title="<?php _e( 'Status', 'wp-event-manager-alerts' ); ?>" class="status"><?php echo $alert->post_status == 'draft' ? __( 'Disabled', 'wp-event-manager-alerts' ) : __( 'Enabled', 'wp-event-manager-alerts' ); ?></td>
						<td data-title="<?php _e( 'Date Created', 'wp-event-manager-alerts' ); ?>" class="date"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $alert->post_date ) ); ?></td>
					</tr>
				<?php endforeach;
				else : ?>
				<td colspan="8" class="text-center"><div class="wpem-alert wpem-alert-info"><?php _e('Currently you have no alerts','wp-event-manager-alerts');?></div></td>
				<?php
				    endif;
				?>
			</tbody>
		</table>
	</div>
</div>
