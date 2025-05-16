<div class="updated">
	<p class="gam-updater-dismiss" style="float:right;"><a href="<?php echo esc_url( add_query_arg( 'dismiss-' . sanitize_title( $this->plugin_slug ), '1' ) ); ?>"><?php _e( 'Hide notice' ); ?></a></p>
	<p><?php printf( __('<a href="%s">Please enter your licence key</a> in the plugin list below to get updates for "%s".', 'wp-event-manager-alerts'), '#' . sanitize_title( $this->plugin_slug . '_licence_key_row' ), esc_html( $this->plugin_data['Name'] ) ); ?></p>
	<p><small class="description"><?php printf( __('Lost your key? <a href="%s">Retrieve it here</a>.', 'wp-event-manager-alerts'), esc_url( 'http://www.wp-eventmanager.com/lost-licence-key/' ) ); ?></small></p>
</div> 