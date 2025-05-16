<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * WP_Event_Manager_Registrations_Register class.
 */
class WP_Event_Manager_Registrations_Register {

	private $fields     = array();
	private $error      = '';
	private static $secret_dir = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_filter( 'sanitize_file_name_chars', array( $this, 'sanitize_file_name_chars' ) );
		add_action( 'init', array( $this, 'init' ), 20 );
		add_action( 'wp', array( $this, 'registration_form_handler' ) );
		add_filter( 'event_manager_locate_template', array( $this, 'disable_registration_form' ), 10, 2 );
		self::$secret_dir = uniqid();
	}

	/**
	 * frontend_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {
		wp_register_script( 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_URL . '/assets/js/registration.min.js', array('jquery','jquery-ui-core','jquery-ui-datepicker'), EVENT_MANAGER_REGISTRATIONS_VERSION, true );
		wp_localize_script( 'wp-event-manager-registrations', 'event_manager_registrations', array(
			'i18n_required' => __( '"%s" is a required field', 'wp-event-manager-registrations' ),
                    
                        'start_of_week' => get_option( 'start_of_week' ),
                    
                        'i18n_datepicker_format' => WP_Event_Manager_Date_Time::get_datepicker_format(),

		) );
                
	}

	/**
	 * Chars which should be removed from file names
	 */
	public function sanitize_file_name_chars( $chars ) {
		$chars[] = "%";
		$chars[] = "^";
		return $chars;
	}

	/**
	 * Init registration form
	 */
	public function init() {
		global $event_manager;

		if ( ! is_admin() ) {
			if ( has_action( 'event_manager_registration_details_email')  ) {
				add_action( 'event_manager_registration_details_email', array( $this, 'registration_form' ), 20 );

				// Unhook event manager register details
				remove_action( 'event_manager_registration_details_email', array( $event_manager->post_types, 'registration_details_email' ) );
			}
			if ( has_action( 'event_manager_registration_details_url' ) ) {
				add_action( 'event_manager_registration_details_url', array( $this, 'registration_form' ), 20 );

				// Unhook event manager register details
				remove_action( 'event_manager_registration_details_url', array( $event_manager->post_types, 'registration_details_url' ) );
			}
			//load registration form type method 
			add_action( 'event_manager_registration_details_form', array( $this, 'registration_form' ), 20 );
                        
                        
		}
	}

	public function get_fields() {
		$this->init_fields();
		return $this->fields;
	}

	/**
	 * Sanitize a text field, but preserve the line breaks! Can handle arrays.
	 * @param  string $input
	 * @return string
	 */
	private function sanitize_text_field_with_linebreaks( $input ) {
		if ( is_array( $input ) ) {
			foreach ( $input as $k => $v ) {
				$input[ $k ] = $this->sanitize_text_field_with_linebreaks( $v );
			}
			return $input;
		} else {
			return str_replace( '[nl]', "\n", sanitize_text_field( str_replace( "\n", '[nl]', strip_tags( stripslashes( $input ) ) ) ) );
		}
	}

	/**
	 * Init form fields
	 */
	public function init_fields() {
		if ( ! empty( $this->fields ) ) {
			return;
		}
                global $post;
		$current_user = is_user_logged_in() ? wp_get_current_user() : false;
                 
		$this->fields = get_event_registration_form_fields(false);
                
		// Handle values
		foreach ( $this->fields as $key => $field ) {
			if ( ! isset( $this->fields[ $key ]['value'] ) ) {
				$this->fields[ $key ]['value'] = '';
			}

			$field['rules'] = array_filter( isset( $field['rules'] ) ? (array) $field['rules'] : array() );

			// Special field type handling
			if ( in_array( 'from_name', $field['rules'] ) ) {
				if ( $current_user ) {
					$this->fields[ $key ]['value'] = $current_user->first_name . ' ' . $current_user->last_name;
				}
			}
			if ( in_array( 'from_email', $field['rules'] ) ) {
				if ( $current_user ) {
					$this->fields[ $key ]['value'] = $current_user->user_email;
				}
			}
			if ( 'select' === $field['type'] && ! $this->fields[ $key ]['required'] ) {
				$this->fields[ $key ]['options'] = array_merge( array( 0 => __( 'Choose an option', 'wp-event-manager-registrations' ) ), $this->fields[ $key ]['options'] );
			}


			// Check for already posted values
			//$this->fields[ $key ]['value'] = isset( $_POST[ $key ] ) ? $this->sanitize_text_field_with_linebreaks( $_POST[ $key ] ) : $this->fields[ $key ]['value'];
		}

		uasort( $this->fields, array( $this, 'sort_by_priority' ) );
	}

	/**
	 * Get a field from either event manager
	 */
	public static function get_field_template( $key, $field ) {
				get_event_manager_template( 'form-fields/' . $field['type'] . '-field.php', array( 'key' => $key, 'field' => $field ) );		
	}

	/**
	 * Disable registration form if needed
	 */
	public function disable_registration_form( $template, $template_name ) {
		global $post;
                //wp_enqueue_script( 'wp-event-manager-event-submission' );
		if ( 'event-registration.php' === $template_name && get_option( 'event_registration_prevent_multiple_registrations' ) && user_has_registered_for_event( get_current_user_id(), $post->ID ) ) {
			return locate_event_manager_template( 'registration-form-registered.php', 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/' );
		}
		return $template;
	}

	/**
	 * Allow users to register to a event 
	 */
	public function registration_form() {
		//wp_enqueue_script( 'wp-event-manager-event-submission' );
		if ( get_option( 'event_registration_form_require_login', 0 ) && ! is_user_logged_in() ) {
			get_event_manager_template( 'registration-form-login.php', array(), 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/' );

		} else {
			$this->init_fields();
			
			wp_enqueue_script( 'wp-event-manager-registrations' );
			get_event_manager_template( 'registration-form.php', array( 'registration_fields' => $this->fields, 'class' => $this ), 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/' );
		}
	}

	/**
	 * Sort array by priority value
	 */
	private function sort_by_priority( $a, $b ) {
		return $a['priority'] - $b['priority'];
	}

	/**
	 * Send the registration email if posted
	 */
	public function registration_form_handler() {
		if ( ! empty( $_POST['wp_event_manager_send_registration'] ) ) {
			try {
				$fields = $this->get_fields();
				$values = array();
				$event_id = absint( $_POST['event_id'] );
				$event    = get_post( $event_id );
				$meta   = array();

				if ( empty( $event_id ) || ! $event || 'event_listing' !== $event->post_type ) {
					throw new Exception( __( 'Invalid event.', 'wp-event-manager-registrations' ) );
				}

				if ( get_option( 'event_registration_prevent_multiple_registrations' ) && user_has_registered_for_event( get_current_user_id(), $event_id ) ) {
					throw new Exception( __( 'You have already registered for this event.', 'wp-event-manager-registrations' ) );
				}

				// Validate posted fields
				foreach ( $fields as $key => $field ) {
					$field['rules'] = array_filter( isset( $field['rules'] ) ? (array) $field['rules'] : array() );

					switch( $field['type'] ) {
						case "file" :
							$values[ $key ] = $this->upload_file( $key, $field );

							if ( is_wp_error( $values[ $key ] ) ) {
								throw new Exception( $field['label'] . ': ' . $values[ $key ]->get_error_message() );
							}
						break;
						default :
							$values[ $key ] = isset( $_POST[ $key ] ) ? $this->sanitize_text_field_with_linebreaks( $_POST[ $key ] ) : '';
						break;
					}

					// Validate required
					if ( $field['required'] && strlen( $values[ $key ] ) < 1 ) {
						throw new Exception( sprintf( __( ' "%s" is a required field', 'wp-event-manager-registrations' ), $field['label'] ) );
					}

					// Extra validation rules
					if ( ! empty( $field['rules'] ) && ! empty( $values[ $key ] ) ) {
						foreach( $field['rules'] as $rule ) {
							switch( $rule ) {
								case 'email' :
								case 'from_email' :
									if ( ! is_email( $values[ $key ] ) ) {
										throw new Exception( $field['label'] . ': ' . __( 'Please provide a valid email address', 'wp-event-manager-registrations' ) );
									}
								break;
								case 'numeric' :
									if ( ! is_numeric( $values[ $key ] ) ) {
										throw new Exception( $field['label'] . ': ' . __( 'Please enter a number', 'wp-event-manager-registrations' ) );
									}
								break;
							}
						}
					}
				}

				// Validation hook
				$valid = apply_filters( 'registration_form_validate_fields', true, $fields, $values );

				if ( is_wp_error( $valid ) ) {
					throw new Exception( $valid->get_error_message() );
				}

				// Prepare meta data to save
				$from_name                = '';
				$from_email               = '';
				$registration_message      = array();
				$meta['_secret_dir']      = self::$secret_dir;
				$meta['_attachment']      = array();
				$meta['_attachment_file'] = array();
				$registration_fields= array();
				

				foreach ( $fields as $key => $field ) {
					if ( empty( $values[ $key ] ) ) {
						continue;
					}

					$field['rules'] = array_filter( isset( $field['rules'] ) ? (array) $field['rules'] : array() );

					if ( in_array( 'from_name', $field['rules'] ) ) {
						$from_name = $values[ $key ];
					}

					if ( in_array( 'from_email', $field['rules'] ) ) {
						$from_email = $values[ $key ];
					}
					$registration_fields[$key]=$values[ $key ];

					if ( 'file' === $field['type'] ) {
						if ( ! empty( $values[ $key ] ) ) {
							$index = 1;
							foreach ( $values[ $key ] as $attachment ) {
								if ( ! is_wp_error( $attachment ) ) {
									if ( in_array( 'attachment', $field['rules'] ) ) {
										$meta['_attachment'][]      = $attachment->url;
										$meta['_attachment_file'][] = $attachment->file;
									} else {
										$meta[ $key. ' ' . $index ] = $attachment->url;
									}
								}
								$index ++;
							}
						}
					}
					elseif ( 'checkbox' === $field['type'] ) {
						$meta[ $key ] = $values[ $key ] ? __( 'Yes', 'wp-event-manager-registrations' ) : __( 'No', 'wp-event-manager-registrations' );
					}
					elseif ( 'multiselect' === $field['type'] ) {						
						if( is_array( $values[ $key ] ) )
						{
							$meta[ $key ] = $values[ $key ];
						}
						else
						{
							$meta[ $key ] = explode(',', $values[ $key ]);
						}
					}
					/*
					elseif ( is_array( $values[ $key ] ) ) {
						$meta[ $key ] = implode( ', ', $values[ $key ] );
					}
					*/
					else {
						$meta[ $key ] = $values[ $key ];
					}
				}
				//set rule value in meta so we can use those meta velue while sending email in notification
				$meta['from_name']  = $from_name;
				$meta['from_email'] = $from_email;
				$meta                = apply_filters( 'event_registration_form_posted_meta', $meta, $values );

				// Create registration
				if ( ! $registration_id = create_event_registration( $event_id, $registration_fields, $meta ) ) {
					throw new Exception( __( 'Could not create event registration', 'wp-event-manager-registrations' ) );
				}
				
				// Message to display
				add_action( 'event_content_start', array( $this, 'registration_form_success' ) );

				// Trigger action
				do_action( 'new_event_registration', $registration_id, $event_id );

			} catch ( Exception $e ) {
				$this->error = $e->getMessage();
				add_action( 'event_content_start', array( $this, 'registration_form_errors' ) );
			}
			//hide existing already registered message on event
			if(has_action('single_event_listing_start')){
				global $event_manager_registrations;
				remove_action( 'single_event_listing_start', array( $event_manager_registrations, 'already_registered_message' ) );
			}

			if(isset($registration_id))
				return $registration_id;
		}
	}

	/**
	 * Upload a file
	 * @return  string or array
	 */
	public function upload_file( $field_key, $field ) {
		if ( isset( $_FILES[ $field_key ] ) && ! empty( $_FILES[ $field_key ] ) && ! empty( $_FILES[ $field_key ]['name'] ) ) {
			if ( ! empty( $field['allowed_mime_types'] ) ) {
				$allowed_mime_types = $field['allowed_mime_types'];
			} else {
				$allowed_mime_types = get_allowed_mime_types();
			}

			$files           = array();
			$files_to_upload = event_manager_prepare_uploaded_files( $_FILES[ $field_key ] );

			add_filter( 'event_manager_upload_dir', array( $this, 'upload_dir' ), 10, 2 );

			foreach ( $files_to_upload as $file_to_upload ) {
				$uploaded_file = event_manager_upload_file( $file_to_upload, array( 'file_key' => $field_key ) );

				if ( is_wp_error( $uploaded_file ) ) {
					throw new Exception( $uploaded_file->get_error_message() );
				} else {
					if ( ! isset( $uploaded_file->file ) ) {
						$uploaded_file->file = str_replace( site_url(), ABSPATH, $uploaded_file->url );
					}
					$files[] = $uploaded_file;
				}
			}

			remove_filter( 'event_manager_upload_dir', array( $this, 'upload_dir' ), 10, 2 );

			return $files;
		}
	}

	/**
	 * Filter the upload directory
	 */
	public static function upload_dir( $pathdata ) {
		return 'event_registrations/' . self::$secret_dir;
	}

	/**
	 * Success message
	 */
	public function registration_form_success() {
		get_event_manager_template( 'registration-submitted.php', array(), 'wp-event-manager-registrations', EVENT_MANAGER_REGISTRATIONS_PLUGIN_DIR . '/templates/' );
	}

	/**
	 * Show errors
	 */
	public function registration_form_errors() {
		if ( $this->error ) {
			echo '<p class="event-manager-error event-manager-registrations-error wpem-alert wpem-alert-danger">' . esc_html( $this->error ) . '</p>';
		}
	}
}

new WP_Event_Manager_Registrations_Register();
