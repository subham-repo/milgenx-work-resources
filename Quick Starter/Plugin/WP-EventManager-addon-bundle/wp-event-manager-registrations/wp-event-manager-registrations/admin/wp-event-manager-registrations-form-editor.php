<?php

/**
 * WP_Event_Manager_Registrations_Form_Editor class.
 */
class WP_Event_Manager_Registrations_Form_Editor {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	/**
	 * Add form editor menu item
	 */
	public function admin_menu() {
		add_submenu_page( 'edit.php?post_type=event_registration', __( 'Registration Form', 'wp-event-manager-registrations' ),  __( 'Registration Form', 'wp-event-manager-registrations' ) , 'manage_options', 'event-registrations-form-editor', array( $this, 'output' ) );
	}

	/**
	 * Register scripts
	 */
	public function admin_enqueue_scripts() {
		wp_register_script( 'wp-event-manager-registrations-form-editor', plugins_url( '/assets/js/form-editor.min.js', EVENT_MANAGER_REGISTRATIONS_FILE ), array( 'jquery', 'jquery-ui-sortable', 'chosen' ), EVENT_MANAGER_REGISTRATIONS_VERSION, true );
		wp_register_script( 'chosen', EVENT_MANAGER_PLUGIN_URL . '/assets/js/jquery-chosen/chosen.jquery.min.js', array( 'jquery' ), '1.1.0', true );
		wp_localize_script( 'wp-event-manager-registrations-form-editor', 'wp_event_manager_registrations_form_editor', array(
			'cofirm_delete_i18n' => __( 'Are you sure you want to delete this row?', 'wp-event-manager-registrations' ),
			'cofirm_reset_i18n'  => __( 'Are you sure you want to reset your changes? This cannot be undone.', 'wp-event-manager-registrations' )
		) );
	}

	/**
	 * Output the screen
	 */
	public function output() {
		$tabs = array(
			'fields'                 => __( 'Form Fields', 'wp-event-manager-registrations' ),
			'organizer-notification'  => 'Organizer Notification',
			'attendee-notification' => 'Attendee Notification'
		);

		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'fields';

		wp_enqueue_script( 'wp-event-manager-registrations-form-editor' );
		wp_enqueue_style( 'chosen', EVENT_MANAGER_PLUGIN_URL . '/assets/css/chosen.css' );
		?>
		<div class="wrap wp-event-manager-registrations-form-editor">
            <h1 class="wp-heading-inline"><?php echo $tabs[$tab]; ?></h1>

			<div class="wpem-wrap wp-event-manager-registrations-form-editor">
				<h2 class="nav-tab-wrapper">
					<?php
					foreach( $tabs as $key => $value ) {
						$active = ( $key == $tab ) ? 'nav-tab-active' : '';
						echo '<a class="nav-tab ' . $active . '" href="' . admin_url( 'edit.php?post_type=event_registration&page=event-registrations-form-editor&tab=' . esc_attr( $key ) ) . '">' . esc_html( $value ) . '</a>';
					}
					?>
				</h2>
				<form method="post" id="mainform" action="edit.php?post_type=event_registration&amp;page=event-registrations-form-editor&amp;tab=<?php echo esc_attr( $tab ); ?>">
					<?php
					switch ( $tab ) {
						case 'organizer-notification' :
							$this->organizer_notification_editor();
						break;
						case 'attendee-notification' :
							$this->attendee_notification_editor();
						break;
						default :
							$this->form_editor();
						break;
					}
					?>
					<?php wp_nonce_field( 'save-' . $tab ); ?>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Output the form editor
	 */
	private function form_editor() {
		if ( ! empty( $_GET['reset-fields'] ) && ! empty( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'reset' ) ) {
			delete_option( 'event_registration_form_fields' );
			echo '<div class="updated"><p>' . __( 'The fields were successfully reset.', 'wp-event-manager-registrations' ) . '</p></div>';
		}

		if ( ! empty( $_POST ) && ! empty( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'save-fields' )  ) {
			echo $this->form_editor_save();
		}

		$fields      = get_event_registration_form_fields();
		$field_rules = apply_filters( 'event_registration_form_field_rules', array(
			__( 'Validation', 'wp-event-manager-registrations' ) => array(
				'required' => __( 'Required', 'wp-event-manager-registrations' ),
				'email'    => __( 'Email', 'wp-event-manager-registrations' ),
				'numeric'  => __( 'Numeric', 'wp-event-manager-registrations' )
			),
			__( 'Data Handling', 'wp-event-manager-registrations' ) => array(
				'from_name'  => __( 'From Name', 'wp-event-manager-registrations' ),
				'from_email' => __( 'From Email', 'wp-event-manager-registrations' )				
			)
		) );
		$field_types = apply_filters( 'event_registration_form_field_types', array(
			'text'           => __( 'Text', 'wp-event-manager-registrations' ),
			'textarea'       => __( 'Textarea', 'wp-event-manager-registrations' ),			
			'select'         => __( 'Select', 'wp-event-manager-registrations' ),
			'multiselect'    => __( 'Multiselect', 'wp-event-manager-registrations' ),
			'checkbox'       => __( 'Checkbox', 'wp-event-manager-registrations' ),	
                        'date'       	 => __( 'Date', 'wp-event-manager-registrations' ),
			'output-content' => __( 'Output content', 'wp-event-manager-registrations' ),
		) );

		
		?>
		<table class="widefat">
			<thead>
				<tr>
					<th width="1%">&nbsp;</th>
					<th><?php _e( 'Field Label', 'wp-event-manager-registrations' ); ?></th>
					<th width="1%"><?php _e( 'Type', 'wp-event-manager-registrations' ); ?></th>
					<th><?php _e( 'Description', 'wp-event-manager-registrations' ); ?></th>
					<th><?php _e( 'Placeholder / Options', 'wp-event-manager-registrations' ); ?></th>
					<th width="1%"><?php _e( 'Validation / Rules', 'wp-event-manager-registrations' ); ?></th>
					<th width="1%" class="field-actions">&nbsp;</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th colspan="4">
						<a class="button add-field" href="#"><?php _e( 'Add field', 'wp-event-manager-registrations' ); ?></a>
					</th>
					<th colspan="4" class="save-actions">
						<a href="<?php echo wp_nonce_url( add_query_arg( 'reset-fields', 1 ), 'reset' ); ?>" class="reset"><?php _e( 'Reset to defaults', 'wp-event-manager-registrations' ); ?></a>
						<input type="submit" class="save-fields button-primary" value="<?php _e( 'Save Changes', 'wp-event-manager-registrations' ); ?>" />
					</th>
				</tr>
			</tfoot>
			<tbody id="form-fields" data-field="<?php
				ob_start();
				$index     = -1;
				$field_key = '';
				$field     = array(
					'type'        => 'text',
					'label'       => '',
					'placeholder' => ''
				);
				include( 'wp-event-manager-registrations-html-form-field-editor-row.php' );
				echo esc_attr( ob_get_clean() );
			?>"><?php
				foreach ( $fields as $field_key => $field ) {
					$index ++;
					include( 'wp-event-manager-registrations-html-form-field-editor-row.php' );
				}
			?></tbody>
		</table>
		<?php
	}

	/**
	 * Save the form fields
	 */
	private function form_editor_save() {
		$field_types          = ! empty( $_POST['field_type'] ) ? array_map( 'sanitize_text_field', $_POST['field_type'] )                     : array();
		$field_labels         = ! empty( $_POST['field_label'] ) ? array_map( 'sanitize_text_field', $_POST['field_label'] )                   : array();
		$field_descriptions   = ! empty( $_POST['field_description'] ) ? array_map( 'sanitize_text_field', $_POST['field_description'] )       : array();
		$field_placeholder    = ! empty( $_POST['field_placeholder'] ) ? array_map( 'sanitize_text_field', $_POST['field_placeholder'] )       : array();
		$field_options        = ! empty( $_POST['field_options'] ) ? array_map( 'sanitize_text_field', $_POST['field_options'] )               : array();		
		$field_rules          = ! empty( $_POST['field_rules'] ) ? $this->sanitize_array( $_POST['field_rules'] )                              : array();
		$new_fields           = array();
		$index                = 0;

		foreach ( $field_labels as $key => $field ) {
			if ( empty( $field_labels[ $key ] ) ) {
				continue;
			}
			$field_name                = sanitize_title( str_replace(' ', '_', $field_labels[ $key ]) );
			$options                   = ! empty( $field_options[ $key ] ) ? array_map( 'sanitize_text_field', explode( '|', $field_options[ $key ] ) ) : array();

			$new_field                       = array();
			$new_field['label']              = $field_labels[ $key ];
			$new_field['type']               = $field_types[ $key ];
			$new_field['required']           = ! empty( $field_rules[ $key ] ) ? in_array( 'required', $field_rules[ $key ] ) : false;
			$new_field['options']            = $options ? array_combine( $options, $options ) : array();
			$new_field['placeholder']        = $field_placeholder[ $key ];
			$new_field['description']        = $field_descriptions[ $key ];
			$new_field['priority']           = $index ++;		
			$new_field['rules']              = ! empty( $field_rules[ $key ] ) ? $field_rules[ $key ] : array();
			$new_fields[ $field_name ]       = $new_field;
		}

		$result = update_option( 'event_registration_form_fields', $new_fields );

		if ( true === $result ) {
			echo '<div class="updated"><p>' . __( 'The fields were successfully saved.', 'wp-event-manager-registrations' ) . '</p></div>';
		}
	}

	/**
	 * Sanitize a 2d array
	 * @param  array $array
	 * @return array
	 */
	private function sanitize_array( $input ) {
		if ( is_array( $input ) ) {
			foreach ( $input as $k => $v ) {
				$input[ $k ] = $this->sanitize_array( $v );
			}
			return $input;
		} else {
			return sanitize_text_field( $input );
		}
	}

	/**
	 * Email editor
	 */
	private function organizer_notification_editor() {
		if ( ! empty( $_GET['reset-email'] ) && ! empty( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'reset' ) ) {
			delete_option( 'event_registration_email_content' );
			delete_option( 'event_registration_email_subject' );
			echo '<div class="updated"><p>' . __( 'The email was successfully reset.', 'wp-event-manager-registrations' ) . '</p></div>';
		}

		if ( ! empty( $_POST ) && ! empty( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'save-organizer-notification' )  ) {
			echo $this->organizer_notification_editor_save();
		}
		?>
		
		<div class="wp-event-registrations-email-content-wrapper">	
		
             <div class="admin-setting-left">			     	
			      <div class="white-background">
			      	<p><?php _e( 'Below you will find the email that is sent to an Organizer after a attendee submits an registration.', 'wp-event-manager-registrations' ); ?></p>
			        <div class="wp-event-registrations-email-content">
    					<p>
    						<label><b><?php _e( 'Email Subject', 'wp-event-manager-registrations' ); ?></b></label>
    					   	<input type="text" name="email-subject" value="<?php echo esc_attr( get_event_registration_email_subject() ); ?>" placeholder="<?php echo esc_attr( __( 'Subject', 'wp-event-manager-registrations' ) ); ?>" />
    				    </p>
    					<p>
    						<label><b><?php _e( 'Email Content', 'wp-event-manager-registrations' ); ?></b></label>
    						<textarea name="email-content" cols="71" rows="10"><?php echo esc_textarea( get_event_registration_email_content() ); ?></textarea>
    				    </p>
				     </div>
			     </div>	<!--white-background-->		       
			</div>	<!--	admin-setting-left-->  	
			
			<div class="box-info">
			   <div class="wp-event-registrations-email-content-tags">
				<p><?php _e( 'The following tags can be used to add content dynamically:', 'wp-event-manager-registrations' ); ?></p>
				<ul>
					<?php foreach ( get_event_registration_email_tags() as $tag => $name ) : ?>
						<li><code>[<?php echo esc_html( $tag ); ?>]</code> - <?php echo wp_kses_post( $name ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p><?php _e( 'All tags can be passed a prefix and a suffix which is only output when the value is set e.g. <code>[event_title prefix="Event Title: " suffix="."]</code>', 'wp-event-manager-registrations' ); ?></p>
			   </div>
		    </div> <!--box-info--> 
		</div>
		<p class="submit-email save-actions">
			<a href="<?php echo wp_nonce_url( add_query_arg( 'reset-email', 1 ), 'reset' ); ?>" class="reset"><?php _e( 'Reset to defaults', 'wp-event-manager-registrations' ); ?></a>
			<input type="submit" class="save-email button-primary" value="<?php _e( 'Save Changes', 'wp-event-manager-registrations' ); ?>" />
		</p>
		<?php
	}

	/**
	 * Save the email
	 */
	private function organizer_notification_editor_save() {
		$email_content = wp_unslash( $_POST['email-content'] );
		$email_subject = sanitize_text_field( wp_unslash( $_POST['email-subject'] ) );
		$result        = update_option( 'event_registration_email_content', $email_content );
		$result2       = update_option( 'event_registration_email_subject', $email_subject );

		if ( true === $result || true === $result2 ) {
			echo '<div class="updated"><p>' . __( 'The email was successfully saved.', 'wp-event-manager-registrations' ) . '</p></div>';
		}
	}

	/**
	 * Email editor
	 */
	private function attendee_notification_editor() {
		if ( ! empty( $_GET['reset-email'] ) && ! empty( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'reset' ) ) {
			delete_option( 'event_registration_attendee_email_content' );
			delete_option( 'event_registration_attendee_email_subject' );
			echo '<div class="updated"><p>' . __( 'The email was successfully reset.', 'wp-event-manager-registrations' ) . '</p></div>';
		}

		if ( ! empty( $_POST ) && ! empty( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'save-attendee-notification' )  ) {
			echo $this->attendee_notification_editor_save();
		}
		?>		
		
		<div class="wp-event-registrations-email-content-wrapper">
		<div class="admin-setting-left">
		   <div class="white-background">		
    		   <p><?php _e( 'Below you will find the email that is sent to a attendee after submitting an registration. Leave blank to disable.', 'wp-event-manager-registrations' ); ?></p>    		
    		   
    			  <div class="wp-event-registrations-email-content">
    				<p>
    					<label><b><?php _e( 'Email Subject', 'wp-event-manager-registrations' ); ?></b></label>
    					<input type="text" name="email-subject" value="<?php echo esc_attr( get_event_registration_attendee_email_subject() ); ?>" placeholder="<?php echo esc_attr( __( 'Subject', 'wp-event-manager-registrations' ) ); ?>" />
    				</p>
    				<p>
    					<label><b><?php _e( 'Email Content', 'wp-event-manager-registrations' ); ?></b></label>
    					<textarea name="email-content" cols="71" rows="10" placeholder="<?php _e( 'N/A', 'wp-event-manager-registrations' ); ?>"><?php echo esc_textarea( get_event_registration_attendee_email_content() ); ?></textarea>
    				</p>
    			  </div>
    			
		   </div>	<!--white-background-->
		 </div>	<!-- admin-setting-left-->     
		 
		 <div class="box-info">
			<div class="wp-event-registrations-email-content-tags">
				<p><?php _e( 'The following tags can be used to add content dynamically:', 'wp-event-manager-registrations' ); ?></p>
				<ul>
					<?php foreach ( get_event_registration_email_tags() as $tag => $name ) : ?>
						<li><code>[<?php echo esc_html( $tag ); ?>]</code> - <?php echo wp_kses_post( $name ); ?></li>
					<?php endforeach; ?>
				</ul>
				<p><?php _e( 'All tags can be passed a prefix and a suffix which is only output when the value is set e.g. <code>[event_title prefix="Event Title: " suffix="."]</code>', 'wp-event-manager-registrations' ); ?></p>
			</div></div>
		 </div> <!--box-info--> 
		
		<p class="submit-email save-actions">
			<a href="<?php echo wp_nonce_url( add_query_arg( 'reset-email', 1 ), 'reset' ); ?>" class="reset"><?php _e( 'Reset to defaults', 'wp-event-manager-registrations' ); ?></a>
			<input type="submit" class="save-email button-primary" value="<?php _e( 'Save Changes', 'wp-event-manager-registrations' ); ?>" />
		</p>
		<?php
	}

	/**
	 * Save the email
	 */
	private function attendee_notification_editor_save() {
		$email_content = wp_unslash( $_POST['email-content'] );
		$email_subject = sanitize_text_field( wp_unslash( $_POST['email-subject'] ) );
		$result        = update_option( 'event_registration_attendee_email_content', $email_content );
		$result2       = update_option( 'event_registration_attendee_email_subject', $email_subject );

		if ( true === $result || true === $result2 ) {
			echo '<div class="updated"><p>' . __( 'The email was successfully saved.', 'wp-event-manager-registrations' ) . '</p></div>';
		}
	}
}

new WP_Event_Manager_Registrations_Form_Editor();
