<?php
/**
 * REST API Registration controller
 *
 * Handles requests to the /events/<event_id>/attendees endpoint.
 *
 * @author   WPEM
 * @since    3.1.14
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * REST API Registrations controller class.
 *
 * @extends WPEM_REST_Controller
 */
class WPEM_REST_Event_Registrations_Controller extends WPEM_REST_CRUD_Controller {
	
	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'wpem';
	
	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'events/(?P<event_id>[\d]+)/attendees';
	
	/**
	 * Post type.
	 *
	 * @var string
	 */
	protected $post_type = 'event_registration';
	
	
	/**
	 * Initialize registration actions.
	 */
	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ), 10 );

		//add tickets details on each event
		add_filter( "wpem_rest_get_event_listing_data",array($this,'wpem_registrations_add_data_to_listing'),10,3 );
	}
	
	/**
	 * Register the routes for event attendees.
	 */
	public function register_routes() {

		register_rest_route(
			$this->namespace, 
				'/' . $this->rest_base, 
				array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_items' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => $this->get_collection_params(),
				),
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'create_item' ),
					'permission_callback' => array( $this, 'create_item_permissions_check' ),
					'args'                => array_merge(
						$this->get_endpoint_args_for_item_schema( WP_REST_Server::CREATABLE ), array(
							'event_id'     => array(
								'required'    => true,
								'description' => __( 'Unique identifier for the event.', 'wp-event-manager-registrations' ),
								'type'        => 'integer',
							),
							'status' => array(
								'required'    => true,
								'type'        => 'string',
								'description' => __( 'Status of registration should contain waiting, confirm, concelled', 'wp-event-manager-registrations' ),
							),
						)
					),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);

		register_rest_route(
			$this->namespace, 
				'/' . $this->rest_base . '/(?P<id>[\d]+)', array(
				'args'   => array(
					'id' => array(
						'description' => __( 'Unique identifier for the resource.', 'wp-event-manager-registrations' ),
						'type'        => 'integer',
					),
				),
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_item' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => array(
						'context' => $this->get_context_param( array( 'default' => 'view' ) ),
					),
				),
				array(
					'methods'             => WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'update_item' ),
					'permission_callback' => array( $this, 'update_item_permissions_check' ),
					'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
				),
				array(
					'methods'             => WP_REST_Server::DELETABLE,
					'callback'            => array( $this, 'delete_item' ),
					'permission_callback' => array( $this, 'delete_item_permissions_check' ),
					'args'                => array(
						'force' => array(
							'default'     => false,
							'type'        => 'boolean',
							'description' => __( 'Whether to bypass trash and force deletion.', 'wp-event-manager-registrations' ),
						),
					),
				),

				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
				'/' . $this->rest_base . '/batch', array(
				array(
					'methods'             => WP_REST_Server::EDITABLE,
					'callback'            => array( $this, 'batch_items' ),
					'permission_callback' => array( $this, 'batch_items_permissions_check' ),
					'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::EDITABLE ),
				),
				'schema' => array( $this, 'get_public_batch_schema' ),
			)
		);

		register_rest_route(
			$this->namespace,
				'/' . $this->rest_base . '/fields', array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_attendee_fields' ),
					'permission_callback' => array( $this, 'get_item_permissions_check' ),
					'args'                => $this->get_endpoint_args_for_item_schema( WP_REST_Server::READABLE ),
				),
				'schema' => array( $this, 'get_public_batch_schema' ),
			)
		);

		register_rest_route(
			$this->namespace, 
				'/' . $this->rest_base . '/(?P<attendee_id>[\d]+)/notes', array(
				array(
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => array( $this, 'get_attendee_notes' ),
					'permission_callback' => array( $this, 'get_items_permissions_check' ),
					'args'                => $this->get_collection_params(),
				),
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'create_attendee_notes' ),
					'permission_callback' => array( $this, 'create_item_permissions_check' ),
					'args'                =>  array(
							'note'       => array(
								'required'    => true,
								'type'        => 'string',
								'description' => __( 'Note of the attendee.', 'wp-event-manager-registrations' ),
							)
						)
					
				),
				array(
					'methods'             => WP_REST_Server::DELETABLE,
					'callback'            => array( $this, 'delete_attendee_notes' ),
					'permission_callback' => array( $this, 'delete_item_permissions_check' ),
					'args'                => array(
						'force' => array(
							'default'     => false,
							'type'        => 'boolean',
							'description' => __( 'Whether to bypass trash and force deletion.', 'wp-event-manager-registrations' ),
						),
					),
				),
				'schema' => array( $this, 'get_public_item_schema' ),
			)
		);

		register_rest_route(
			$this->namespace, 
				'/' . $this->rest_base . '/(?P<attendee_id>[\d]+)/checkin', array(
				'args'   => array(
					'attendee_id' => array(
						'description' => __( 'Unique identifier for the resource.', 'wp-event-manager-registrations' ),
						'type'        => 'integer',
					),
				),
				array(
					'methods'             => WP_REST_Server::CREATABLE,
					'callback'            => array( $this, 'checkin_attendee' ),
					'permission_callback' => '__return_true',
					'args'                => array(
						'force' => array(
							'default'     => false,
							'type'        => 'boolean',
							'description' => __( 'Whether to checkin or undo checkin.', 'wp-event-manager-sell-tickets' ),
						),
						'checkin_source' => array(
							'default'     => 'app',
							'type'        => 'string',
							'description' => __( 'Checkin platform details', 'wp-event-manager-sell-tickets' ),
						),
						'checkin_device_id' => array(
							'default'     => '',
							'type'        => 'string',
							'description' => __( 'Device id', 'wp-event-manager-sell-tickets' ),
						),
						'checkin_device_name' => array(
							'default'     => '',
							'type'        => 'string',
							'description' => __( 'Device name', 'wp-event-manager-sell-tickets' ),
						),
					),
				),
			)
		);

		

	}
	
	/**
	 * Get object.
	 *
	 * @param int $id Object ID.
	 *
	 * @since  3.0.0
	 * @return Post Data object
	 */
	protected function get_object( $id ) {
		return get_post( $id );
	}

	/**
	 * Prepare a single event output for response.
	 *
	 * @param Post         $object  Object data.
	 * @param WP_REST_Request $request Request object.
	 *
	 * @since  3.0.0
	 * @return WP_REST_Response
	 */
	public function prepare_object_for_response( $object, $request ) {
		$context = ! empty( $request['context'] ) ? $request['context'] : 'view';
		$data    = $this->get_registration_data( $object, $context );

		$data     = $this->add_additional_fields_to_object( $data, $request );
		$data     = $this->filter_response_by_context( $data, $context );
		$response = rest_ensure_response( $data );
		$response->add_links( $this->prepare_links( $object, $request ) );

		/**
		 * Filter the data for a response.
		 *
		 * The dynamic portion of the hook name, $this->post_type,
		 * refers to object type being prepared for the response.
		 *
		 * @param WP_REST_Response $response The response object.
		 * @param Post Data          $object   Object data.
		 * @param WP_REST_Request  $request  Request object.
		 */
		return apply_filters( "wpem_rest_prepare_{$this->post_type}_object", $response, $object, $request );
	}
	/**
	 * Prepare objects query.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 *
	 * @since  1.0.0
	 * @return array
	 */
	protected function prepare_objects_query( $request ) {
		$args = parent::prepare_objects_query( $request );
		
		// Set post_status.
		$args['post_status'] = $request['status'];
		
		$args['post_type'] = $this->post_type;
		$args['post_parent'] = $request['event_id'];
		$args['orderby'] = isset($request['orderby']) ? $request['orderby'] : 'title';
		$args['order'] = isset($request['order']) ? $request['order'] : 'asc';
		$args['starts_with'] = isset( $request['starts_with'] ) ? $request['starts_with'] : '';

		if(isset($request['order_id']))
		$args['meta_query'] =  array(
										array(
											'key'       => '_order_id',
											'value'     => $request['order_id'],
											'compare'   => '=',
										)
								);

		if(isset($request['checkin']) && !empty($request['checkin']))
			$args['meta_query'][]=  
										array(
											'key'       => '_check_in',
											'value'     => $request['checkin'],
											'compare'   => '=',
										);

		if(isset($request['checkin_device_id']) && !empty($request['checkin_device_id']))
				$args['meta_query'][] = 
										array(
											'key'       => '_checkin_device_id',
											'value'     => $request['checkin_device_id'],
											'compare'   => '=',
										);
		if(isset($request['ticket_id']) && !empty($request['ticket_id']))
				$args['meta_query'][] = 
										array(
											'key'       => '_ticket_id',
											'value'     => $request['ticket_id'],
											'compare'   => '=',
										);
								

		if(isset($request['starts_with']) && !empty($request['starts_with']))
		add_filter( 'posts_where', array( $this , 'wpem_registration_start_with_where'), 10, 2 );

		return $args;
	}
	
		public function wpem_registration_start_with_where( $where, $query ) {
		    global $wpdb;

		    $starts_with = esc_sql( $query->get( 'starts_with' ) );

		    if ( !empty($starts_with) ) {
		        $where .= " AND $wpdb->posts.post_title LIKE '{$starts_with}%' ";
		    }

		    return $where;
		}
	/**
	 * Get event data.
	 *
	 * @param $post Event instance.
	 * @param string     $context Request context.
	 *                            Options: 'view' and 'edit'.
	 *
	 * @return array
	 */
	protected function get_registration_data( $registration, $context = 'view' ) {

		//unserialize registration data
		$registration_meta = get_post_meta($registration->ID);
		foreach ($registration_meta as $key => $value) {
			//if ( is_serialized( $value ) ) 
			$registration_meta[$key] = get_post_meta($registration->ID,$key,true);
		}

		

		$data = array(
				'id'                    => $registration->ID,
				'name'                  => $registration->post_title,
				'slug'                  => $registration->post_name,
				'permalink'             => get_permalink( $registration->ID ),
				'date_created'          => get_the_date('',$registration),
				'date_modified'         => get_the_modified_date( '', $registration),
				'status'                => $registration->post_status,
				'featured'              => $registration->_featured,
				
				'description'           => 'view' === $context ? wpautop( do_shortcode( get_event_description($registration) ) ) : get_event_description($registration ),
		
				'avatar'                => rest_get_avatar_urls( $registration->author ),
				//'menu_order'            => '',
				'meta_data'             => $registration_meta ,
		);
		
		return $data;
	}
	/**
	 * Prepare a single product review output for response.
	 *
	 * @param WP_Comment      $review Product review object.
	 * @param WP_REST_Request $request Request object.
	 * @return WP_REST_Response $response Response data.
	 */
	public function prepare_item_for_response( $registration, $request ) {
		$context = ! empty( $request['context'] ) ? $request['context'] : 'view';
		$fields  = $this->get_fields_for_response( $request );
		$data    = array();
		
		if ( in_array( 'id', $fields, true ) ) {
			$data['id'] = (int) $review->comment_ID;
		}
		if ( in_array( 'date_created', $fields, true ) ) {
			$data['date_created'] = wpem_rest_prepare_date_response( $review->comment_date );
		}
		if ( in_array( 'date_created_gmt', $fields, true ) ) {
			$data['date_created_gmt'] = wpem_rest_prepare_date_response( $review->comment_date_gmt );
		}
		if ( in_array( 'product_id', $fields, true ) ) {
			$data['product_id'] = (int) $review->comment_post_ID;
		}
		if ( in_array( 'status', $fields, true ) ) {
			$data['status'] = $this->prepare_status_response( (string) $review->comment_approved );
		}
		if ( in_array( 'reviewer', $fields, true ) ) {
			$data['reviewer'] = $review->comment_author;
		}
		if ( in_array( 'reviewer_email', $fields, true ) ) {
			$data['reviewer_email'] = $review->comment_author_email;
		}
		if ( in_array( 'review', $fields, true ) ) {
			$data['review'] = 'view' === $context ? wpautop( $review->comment_content ) : $review->comment_content;
		}
		if ( in_array( 'rating', $fields, true ) ) {
			$data['rating'] = (int) get_comment_meta( $review->comment_ID, 'rating', true );
		}
		if ( in_array( 'verified', $fields, true ) ) {
			$data['verified'] = wpem_review_is_from_verified_owner( $review->comment_ID );
		}
		if ( in_array( 'reviewer_avatar_urls', $fields, true ) ) {
			$data['reviewer_avatar_urls'] = rest_get_avatar_urls( $review->comment_author_email );
		}
		
		$data = $this->add_additional_fields_to_object( $data, $request );
		$data = $this->filter_response_by_context( $data, $context );
		
		// Wrap the data in a response object.
		$response = rest_ensure_response( $data );
		
		$response->add_links( $this->prepare_links( $review, $request ) );

		remove_filter( 'posts_where', array( $this , 'wpem_registration_start_with_where'), 10, 2 );

		
		/**
		 * Filter product reviews object returned from the REST API.
		 *
		 * @param WP_REST_Response $response The response object.
		 * @param WP_Comment       $review   Product review object used to create response.
		 * @param WP_REST_Request  $request  Request object.
		 */
		return apply_filters( 'woocommerce_rest_prepare_product_review', $response, $review, $request );
	}
	
	/**
	 * Prepare a single product review to be inserted into the database.
	 *
	 * @param  WP_REST_Request $request Request object.
	 * @return array|WP_Error  $prepared_review
	 */
	protected function prepare_item_for_database( $request ) {
		if ( isset( $request['id'] ) ) {
			$prepared_review['comment_ID'] = (int) $request['id'];
		}
		
		if ( isset( $request['review'] ) ) {
			$prepared_review['comment_content'] = $request['review'];
		}
		
		if ( isset( $request['product_id'] ) ) {
			$prepared_review['comment_post_ID'] = (int) $request['product_id'];
		}
		
		if ( isset( $request['reviewer'] ) ) {
			$prepared_review['comment_author'] = $request['reviewer'];
		}
		
		if ( isset( $request['reviewer_email'] ) ) {
			$prepared_review['comment_author_email'] = $request['reviewer_email'];
		}
		
		if ( ! empty( $request['date_created'] ) ) {
			$date_data = rest_get_date_with_gmt( $request['date_created'] );
			
			if ( ! empty( $date_data ) ) {
				list( $prepared_review['comment_date'], $prepared_review['comment_date_gmt'] ) = $date_data;
			}
		} elseif ( ! empty( $request['date_created_gmt'] ) ) {
			$date_data = rest_get_date_with_gmt( $request['date_created_gmt'], true );
			
			if ( ! empty( $date_data ) ) {
				list( $prepared_review['comment_date'], $prepared_review['comment_date_gmt'] ) = $date_data;
			}
		}
		
		/**
		 * Filters a review after it is prepared for the database.
		 *
		 * Allows modification of the review right after it is prepared for the database.
		 *
		 * @since 3.5.0
		 * @param array           $prepared_review The prepared review data for `wp_insert_comment`.
		 * @param WP_REST_Request $request         The current request.
		 */
		return apply_filters( 'woocommerce_rest_preprocess_product_review', $prepared_review, $request );
	}
	
	/**
	 * Prepare links for the request.
	 *
	 * @param WP_Comment $review Product review object.
	 * @return array Links for the given product review.
	 */
	protected function prepare_links( $review, $request ) {
		$links = array(
				'self'       => array(
						'href' => rest_url( sprintf( '/%s/%s/%d', $this->namespace, $this->rest_base, $review->comment_ID ) ),
				),
				'collection' => array(
						'href' => rest_url( sprintf( '/%s/%s', $this->namespace, $this->rest_base ) ),
				),
		);
		
		if ( 0 !== (int) $review->comment_post_ID ) {
			$links['up'] = array(
					'href' => rest_url( sprintf( '/%s/products/%d', $this->namespace, $review->comment_post_ID ) ),
			);
		}
		
		if ( 0 !== (int) $review->user_id ) {
			$links['reviewer'] = array(
					'href'       => rest_url( 'wp/v2/users/' . $review->user_id ),
					'embeddable' => true,
			);
		}
		
		return $links;
	}

	/**
	 * Prepare a single registration for create or update.
	 *
	 * @param WP_REST_Request $request Request object.
	 * @param bool            $creating If is creating a new object.
	 *
	 * @return WP_Error | Post
	 */
	protected function prepare_object_for_database( $request, $creating = false ) {
		global $reg_id;
		$id = isset( $request['id'] ) ? absint( $request['id'] ) : 0;

		if ( isset( $request['id'] ) ) {
			$event = get_post( $id );
		}
		else{
				if(!empty($request['attendee_name']) && isset($request['event_id'])  && isset($request['wp_event_manager_send_registration']) ){
					$event_id = $request['event_id'];
					$_POST =  $request;



					if(class_exists('WP_Event_Manager_Registrations_Register')){

						$registration_register = new WP_Event_Manager_Registrations_Register();
						$registration_id = $registration_register->registration_form_handler();
						$registration = get_post($registration_id);
						
					}
					
				}
				else{
					return apply_filters( 'wpem_rest_invalid_arguments', $request );
				}

		}

		/**
		 * Filters an object before it is inserted via the REST API.
		 *
		 * The dynamic portion of the hook name, `$this->post_type`,
		 * refers to the object type slug.
		 *
		 * @param Post         $event  Object object.
		 * @param WP_REST_Request $request  Request object.
		 * @param bool            $creating If is creating a new object.
		 */
		return apply_filters( "wpem_rest_pre_insert_{$this->post_type}_object", $registration, $request, $creating );
	}


	/**
	 * Delete a single item.
	 *
	 * @param WP_REST_Request $request Full details about the request.
	 *
	 * @return WP_REST_Response|WP_Error
	 */
	public function delete_item( $request ) {
		$id     = (int) $request['id'];
		$force  = (bool) $request['force'];
		$object = $this->get_object( (int) $request['id'] );
		$result = false;

		if ( ! $object || 0 === $object->ID ) {
			return new WP_Error(
				"wpem_rest_{$this->post_type}_invalid_id",
				__( 'Invalid ID.', 'wp-event-manager-rest-api' ),
				array(
					'status' => 404,
				)
			);
		}

		

		$supports_trash = EMPTY_TRASH_DAYS > 0 && is_callable( array( $object, 'get_status' ) );

		/**
		 * Filter whether an object is trashable.
		 *
		 * Return false to disable trash support for the object.
		 *
		 * @param boolean $supports_trash Whether the object type support trashing.
		 * @param WC_Data $object         The object being considered for trashing support.
		 */
		$supports_trash = apply_filters( "wpem_rest_{$this->post_type}_object_trashable", $supports_trash, $object );

		if ( ! wpem_rest_check_post_permissions( $this->post_type, 'delete', $object->ID ) ) {
			return new WP_Error(
				"wpem_rest_user_cannot_delete_{$this->post_type}",
				/* translators: %s: post type */
				sprintf( __( 'Sorry, you are not allowed to delete %s.', 'wp-event-manager-registration' ), $this->post_type ),
				array(
					'status' => rest_authorization_required_code(),
				)
			);
		}

		$request->set_param( 'context', 'edit' );
		$response = $this->prepare_object_for_response( $object, $request );

		// If we're forcing, then delete permanently.
		if ( $force ) {	
			$result = wp_delete_post($object->ID,true);
			
			//$result = 0;
		} else {
			// If we don't support trashing for this type, error out.
			if ( ! $supports_trash ) {
				return new WP_Error(
					'wpem_rest_trash_not_supported',
					/* translators: %s: post type */
					sprintf( __( 'The %s does not support trashing.', 'wp-event-manager-rest-api' ), $this->post_type ),
					array(
						'status' => 501,
					)
				);
			}

			// Otherwise, only trash if we haven't already.
			if ( is_callable( array( $object, 'get_status' ) ) ) {
				if ( 'trash' === $object->get_status() ) {
					return new WP_Error(
						'wpem_rest_already_trashed',
						/* translators: %s: post type */
						sprintf( __( 'The %s has already been deleted.', 'wp-event-manager-rest-api' ), $this->post_type ),
						array(
							'status' => 410,
						)
					);
				}

				$result =  wp_delete_post($object->ID);
			}
		}

		if ( ! $result ) {
			return new WP_Error(
				'wpem_rest_cannot_delete',
				/* translators: %s: post type */
				sprintf( __( 'The %s cannot be deleted.', 'wp-event-manager' ), $this->post_type ),
				array(
					'status' => 500,
				)
			);
		}

		/**
		 * Fires after a single object is deleted or trashed via the REST API.
		 *
		 * @param Post          $object   The deleted or trashed object.
		 * @param WP_REST_Response $response The response data.
		 * @param WP_REST_Request  $request  The request sent to the API.
		 */
		do_action( "wpem_rest_delete_{$this->post_type}_object", $object, $response, $request );

		return $response;
	}
	
	/**
	 * Get the Product Review's schema, conforming to JSON Schema.
	 *
	 * @return array
	 */
	public function get_item_schema() {
		$schema = array(
				'$schema'    => 'http://json-schema.org/draft-04/schema#',
				'title'      => 'event_registration',
				'type'       => 'object',
				'properties' => array(
						'id'               => array(
								'description' => __( 'Unique identifier for the resource.', 'wp-event-manager-registrations' ),
								'type'        => 'integer',
								'context'     => array( 'view', 'edit' ),
								'readonly'    => true,
						),
						'date_created'     => array(
								'description' => __( "The date the registration was created, in the site's timezone.", 'wp-event-manager-registrations' ),
								'type'        => 'date-time',
								'context'     => array( 'view', 'edit' ),
								'readonly'    => true,
						),
						'date_created_gmt' => array(
								'description' => __( 'The date the registration was created, as GMT.', 'wp-event-manager-registrations' ),
								'type'        => 'date-time',
								'context'     => array( 'view', 'edit' ),
								'readonly'    => true,
						),
						'event_id'       => array(
								'description' => __( 'Unique identifier for the event that the registration belongs to.', 'wp-event-manager-registrations' ),
								'type'        => 'integer',
								'context'     => array( 'view', 'edit' ),
						),
						'status'           => array(
								'description' => __( 'Status of the registration.', 'wp-event-manager-registrations' ),
								'type'        => 'string',
								'default'     => 'publish',
								'enum'        => array( 'new', 'waiting', 'confirm', 'cancelled'),
								'context'     => array( 'view', 'edit' ),
						),
						'registration_name'         => array(
								'description' => __( 'Attendee name.', 'wp-event-manager-registrations' ),
								'type'        => 'string',
								'context'     => array( 'view', 'edit' ),
						),
						'registration_email'   => array(
								'description' => __( 'Attendee email.', 'wp-event-manager-registrations' ),
								'type'        => 'string',
								'format'      => 'email',
								'context'     => array( 'view', 'edit' ),
						),
				),
		);
		
		if ( get_option( 'show_avatars' ) ) {
			$avatar_properties = array();
			$avatar_sizes      = rest_get_avatar_sizes();
			
			foreach ( $avatar_sizes as $size ) {
				$avatar_properties[ $size ] = array(
						/* translators: %d: avatar image size in pixels */
						'description' => sprintf( __( 'Avatar URL with image size of %d pixels.', 'wp-event-manager-registrations' ), $size ),
						'type'        => 'string',
						'format'      => 'uri',
						'context'     => array( 'embed', 'view', 'edit' ),
				);
			}
			$schema['properties']['registration_avatar_urls'] = array(
					'description' => __( 'Avatar URLs for the object reviewer.', 'wp-event-manager-registrations' ),
					'type'        => 'object',
					'context'     => array( 'view', 'edit' ),
					'readonly'    => true,
					'properties'  => $avatar_properties,
			);
		}
		
		return $this->add_additional_fields_schema( $schema );
	}
	
	/**
	 * Get the query params for collections.
	 *
	 * @return array
	 */
	public function get_collection_params() {
		$params = parent::get_collection_params();
		
		$params['context']['default'] = 'view';
		
		$params['after']            = array(
				'description' => __( 'Limit response to resources published after a given ISO8601 compliant date.', 'wp-event-manager-registrations' ),
				'type'        => 'string',
				'format'      => 'date-time',
		);
		$params['before']           = array(
				'description' => __( 'Limit response to reviews published before a given ISO8601 compliant date.', 'wp-event-manager-registrations' ),
				'type'        => 'string',
				'format'      => 'date-time',
		);
		$params['exclude']          = array(
				'description' => __( 'Ensure result set excludes specific IDs.', 'wp-event-manager-registrations' ),
				'type'        => 'array',
				'items'       => array(
						'type' => 'integer',
				),
				'default'     => array(),
		);
		$params['include']          = array(
				'description' => __( 'Limit result set to specific IDs.', 'wp-event-manager-registrations' ),
				'type'        => 'array',
				'items'       => array(
						'type' => 'integer',
				),
				'default'     => array(),
		);
		$params['offset']           = array(
				'description' => __( 'Offset the result set by a specific number of items.', 'wp-event-manager-registrations' ),
				'type'        => 'integer',
		);
		$params['order']            = array(
				'description' => __( 'Order sort attribute ascending or descending.', 'wp-event-manager-registrations' ),
				'type'        => 'string',
				'default'     => 'asc',
				'enum'        => array(
						'asc',
						'desc',
				),
		);
		$params['orderby']          = array(
				'description'        => __( 'Sort collection by object attribute.', 'wp-event-manager-registrations' ),
				'type'               => 'string',
				'default'            => 'title',
				'enum'               => array(
					'date',
					'id',
					'include',
					'title',
					'slug',
					'modified',
				),
		);
		$params['attendee']         = array(
				'description' => __( 'Limit result set to attendees assigned to specific user IDs.', 'wp-event-manager-registrations' ),
				'type'        => 'array',
				'items'       => array(
						'type' => 'integer',
				),
		);
		$params['attendee_exclude'] = array(
				'description' => __( 'Ensure result set excludes reviews assigned to specific user IDs.', 'wp-event-manager-registrations' ),
				'type'        => 'array',
				'items'       => array(
						'type' => 'integer',
				),
		);
		$params['attendee_email']   = array(
				'default'     => null,
				'description' => __( 'Limit result set to that from a specific author email.', 'wp-event-manager-registrations' ),
				'format'      => 'email',
				'type'        => 'string',
		);
		$params['event']          = array(
				'default'     => array(),
				'description' => __( 'Limit result set to registration assigned to specific event IDs.', 'wp-event-manager-registrations' ),
				'type'        => 'array',
				'items'       => array(
						'type' => 'integer',
				),
		);
		$params['status']           = array(
				'default'           => 'confirm',
				'description'       => __( 'Limit result set to attendees assigned a specific status.', 'wp-event-manager-registrations' ),
				'sanitize_callback' => 'sanitize_key',
				'type'              => 'string',
				'enum'              => array(
						'all',
						'new',
						'waiting',
						'confirm',
						'cancelled',
				),
		);

		$params['checkin']           = array(
		'default'           => '',
		'description'       => __( 'Limit result by checkin.', 'wp-event-manager-registrations' ),
		'sanitize_callback' => 'sanitize_key',
		'type'              => 'integer',
		);

		$params['checkin_device_id']           = array(
		'default'           => '',
		'description'       => __( 'Limit result by checkin device id.', 'wp-event-manager-registrations' ),
		'sanitize_callback' => 'sanitize_key',
		'type'              => 'integer',
		);

	$params['starts_with']           = array(
		'default'           => '',
		'description'       => __( 'Limit result by start with character.', 'wp-event-manager-registrations' ),
		'sanitize_callback' => 'sanitize_key',
		'type'              => 'string',
		);
		
		/**
		 * Filter collection parameters for the registration controller.
		 *
		 * This filter registers the collection parameter, but does not map the
		 * collection parameter to an internal WP_Comment_Query parameter. Use the
		 * `wpem_rest_registration_query` filter to set WP_Query parameters.
		 *
		 * @since 3.1.14
		 * @param array $params JSON Schema-formatted collection parameters.
		 */
		return apply_filters( 'wpem_rest_event_registration_collection_params', $params );
	}
	
	/**
	 * Get the reivew, if the ID is valid.
	 *
	 * @since 3.1.14
	 * @param int $id Supplied ID.
	 * @return WP_Comment|WP_Error Comment object if ID is valid, WP_Error otherwise.
	 */
	protected function get_registration( $id ) {
		$id    = (int) $id;
		$error = new WP_Error( 'wpem_rest_registration_invalid_id', __( 'Invalid review ID.', 'wp-event-manager-registrations' ), array( 'status' => 404 ) );
		
		if ( 0 >= $id ) {
			return $error;
		}
		
		$registration = get_post( $id );
		if ( empty( $registration ) ) {
			return $error;
		}
		
		if ( ! empty( $registration->ID ) ) {
			$post = get_post( (int) $registration->ID );
			
			if ( 'event_registration' !== get_post_type( (int) $registration->ID ) ) {
				return new WP_Error( 'wpem_rest_registration_invalid_id', __( 'Invalid registration ID.', 'wp-event-manager-registrations' ), array( 'status' => 404 ) );
			}
		}
		
		return $registration;
	}
	
	/**
	 * Prepends internal property prefix to query parameters to match our response fields.
	 *
	 * @since 3.5.0
	 * @param string $query_param Query parameter.
	 * @return string
	 */
	protected function normalize_query_param( $query_param ) {
		$prefix = 'comment_';
		
		switch ( $query_param ) {
			case 'id':
				$normalized = $prefix . 'ID';
				break;
			case 'product':
				$normalized = $prefix . 'post_ID';
				break;
			case 'include':
				$normalized = 'comment__in';
				break;
			default:
				$normalized = $prefix . $query_param;
				break;
		}
		
		return $normalized;
	}
	
	/**
	 * Checks comment_approved to set comment status for single comment output.
	 *
	 * @since 3.5.0
	 * @param string|int $comment_approved comment status.
	 * @return string Comment status.
	 */
	protected function prepare_status_response( $comment_approved ) {
		switch ( $comment_approved ) {
			case 'hold':
			case '0':
				$status = 'hold';
				break;
			case 'approve':
			case '1':
				$status = 'approved';
				break;
			case 'spam':
			case 'trash':
			default:
				$status = $comment_approved;
				break;
		}
		
		return $status;
	}

	/**
	 * Get the query params and return event fields
	 *
	 * @return array
	 */
	public function get_attendee_fields($request){
		$fields = get_event_registration_form_fields( true );
		return $fields;
	}

	/**
	* wpem_sell_tickets_add_data_to_listing
	* 
	* @param $data, $event, $context
	* @since 1.8.8
	*/
	public function wpem_registrations_add_data_to_listing($data, $event, $context){

		$registration_limit  = get_post_meta($event->ID,'_registration_limit',true);
		$total_registrations = get_event_registration_count( $event->ID );

	
		//get all registration and send to the array
		$data['registrations'] =  array(
										'registraiton_limit' 		=> $registration_limit,
										'total_registrations' 		=> $total_registrations,
										'new_registrations'			=> get_event_registration_status_count( $event->ID, array('new'=>'new') ),
										'confirmed_registrations'	=> get_event_registration_status_count( $event->ID, array('confirmed'=>'confirmed') ),
							            'waiting_registrations'		=> get_event_registration_status_count( $event->ID, array('waiting'=>'waiting') ),
							            'cancelled_registrations' 	=> get_event_registration_status_count( $event->ID, array('cancelled'=>'cancelled') ),
							            'archived_registrations' 	=> get_event_registration_status_count( $event->ID, array('archived'=>'archived') ),
							            'total_checkin'				=> get_total_checkedin_by_event_id($event->ID)
									);

		return $data;
	}

	/**
	* get_attendee_notes
	* 
	* @param $request
	* @since 1.8.8
	*/
	public function get_attendee_notes($request){

		$args = array(
			'post_id' => $request['attendee_id'],
			'approve' => 'approve',
			'type'    => 'event_registration',
			'order'   => 'asc',
		);

		remove_filter( 'comments_clauses', array( 'WP_Event_Manager_Registrations_Dashboard', 'exclude_registration_comments' ), 10, 1 );
		$notes = get_comments( $args );
		add_filter( 'comments_clauses', array( 'WP_Event_Manager_Registrations_Dashboard', 'exclude_registration_comments' ), 10, 1 );

		$data = array();

		if( isset($notes) && !empty($notes) )
		{
			foreach ($notes as $key => $note) {
				$data[$key]['id'] 	= $note->comment_ID;
				$data[$key]['note'] = $note->comment_content;
				$data[$key]['date_created'] = $note->comment_date_gmt;
				$data[$key]['created_by'] = $note->comment_author;
			}
		}
		return $data;
	}

	/**
	* create_attendee_notes
	* 
	* @param $request
	* @since 1.8.8
	*/
	public function create_attendee_notes($request){

		$user                 = get_user_by( 'id', $request['user_id'] );
		$comment_author       = $user->display_name;
		$comment_author_email = $user->user_email;

		$comment_post_ID      = $request['attendee_id'];
		$comment_author_url   = '';
		$comment_content      = $request['note'];
		$comment_agent        = 'WP Event Manager';
		$comment_type         = 'event_registration';
		$comment_parent       = 0;
		$comment_approved     = 1;

		$commentdata          = apply_filters( 'event_registration_note_data', compact( 'comment_post_ID', 'comment_author', 'comment_author_email', 'comment_author_url', 'comment_content', 'comment_agent', 'comment_type', 'comment_parent', 'comment_approved' ), $request['attendee_id'] );
		$comment_id           = wp_insert_comment($commentdata);

		if( isset($comment_id) && !empty($comment_id) )
		{
			$note = get_comment($comment_id);

			$data['id'] 	= $note->comment_ID;
			$data['note'] = $note->comment_content;
			$data['date_created'] = $note->comment_date_gmt;
			$data['created_by'] = $note->comment_author;
		}
		else
		{
			return new WP_Error( 'wpem_rest_registration_invalid_id', __( 'Invalid registration ID.', 'wp-event-manager-registrations' ), array( 'status' => 404 ) );
		}

		return $data;
	}

	/**
	* delete_attendee_notes
	* 
	* @param $request
	* @since 1.8.8
	*/
	public function delete_attendee_notes($request){
		$note_id = absint($request['note_id']) ;

		if ($note_id && $request['force'] == true ) {
			$note           = get_comment( $note_id );
			
			$notes = wp_delete_comment( $note_id,true );

			return array('message' => sprintf( __( 'Successfull delete note %s.', 'wp-event-manager-rest-api' ), $note_id ),
						'data' 		=> array('status' => 200)
			 			);
		}
		else
		{
			return new WP_Error( 'wpem_rest_note_invalid_id', __( 'Invalid note ID.', 'wp-event-manager-registrations' ), array( 'status' => 404 ) );
		}
	}

	/**
	* checkin_attendee
	* 
	* @param $request
	* @since 1.8.8
	*/
	public function checkin_attendee($request){

		if( isset($request['attendee_id']) && $request['force']  && $request['force'] == true ){
			
			$attendee_id 			= absint($request['attendee_id']);
			$checkin_source 		= isset($request['checkin_source']) ? $request['checkin_source'] : '';
			$checkin_device_id 		= isset($request['checkin_device_id']) ? $request['checkin_device_id'] : '';
			$checkin_device_name 	= isset($request['checkin_device_name']) ? $request['checkin_device_name'] : '';

			update_post_meta($attendee_id,'_check_in',1);
			update_post_meta($attendee_id,'_checkin_source',$checkin_source);
			update_post_meta($attendee_id,'_checkin_device_id',$checkin_device_id);
			update_post_meta($attendee_id,'_checkin_device_name',$checkin_device_name);
			update_post_meta($attendee_id,'_checkin_time',current_time( 'mysql' ));
			return array('message' => __('Checkin successfull','wp-event-manager-sell-tickets'),
		'data' 		=> array('status' => 200));
		}
		elseif(isset($request['attendee_id']) && isset($request['force']) && $request['force'] == false)
		{
			$attendee_id = absint($request['attendee_id']);
			update_post_meta($attendee_id,'_check_in',0);
			return array(	'message' 	=> __('Uncheckin successfull','wp-event-manager-sell-tickets'),
							'data' 		=> array('status' => 200)
				);
		}
		else
		{
			return array('message' => __('There was some error while checkin','wp-event-manager-sell-tickets'),
				'data' 		=> array('status' => 401) );	
		}
			
	}	
}

new WPEM_REST_Event_Registrations_Controller();
