<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * WP_Event_Manager_Alerts_Shortcodes class.
 */
class WP_Event_Manager_Alerts_Shortcodes {
	private $alert_message = '';
	private $action = '';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp', array( $this, 'shortcode_action_handler' ) );
		add_shortcode( 'event_alerts', array( $this, 'event_alerts' ) );
		$this->action = isset( $_REQUEST['action'] ) ? sanitize_title( $_REQUEST['action'] ) : '';
	}

	/**
	 * Handle actions which need to be run before the shortcode e.g. post actions
	 */
	public function shortcode_action_handler() {
		global $post;
		if ( is_page() && strstr( $post->post_content, '[event_alerts]' ) ) {
			wp_enqueue_style( 'chosen', EVENT_MANAGER_PLUGIN_URL . '/assets/css/chosen.css' );
			$this->event_alerts_handler();
		}
	}

	/**
	 * Handles actions
	 */
	public function event_alerts_handler() {
		if ( ! empty( $_REQUEST['action'] ) && ! empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'event_manager_alert_actions' ) ) {

			try {
				switch ( $this->action ) {
					case 'add_alert' :
					case 'edit' :
						if ( isset( $_POST['submit-event-alert'] ) ) {
							$alert_name      = sanitize_text_field( $_POST['alert_name'] );
							$alert_keyword   = sanitize_text_field( $_POST['alert_keyword'] );
							$alert_location  = sanitize_text_field( $_POST['alert_location'] );
							$alert_frequency = sanitize_text_field( $_POST['alert_frequency'] );

							if ( empty( $alert_name ) ) {
								throw new Exception( __( 'Please name your alert', 'wp-event-manager-alerts' ) );
							}
							if ( $this->action == 'add_alert' ) {
								$alert_data = array(
									'post_title'     => $alert_name,
									'post_status'    => 'publish',
									'post_type'      => 'event_alert',
									'comment_status' => 'closed',
									'post_author'    => get_current_user_id()
								);

								$alert_id = wp_insert_post( $alert_data );
							} else {
								$alert_id = absint( $_REQUEST['alert_id'] );
								$alert    = get_post( $alert_id );

								// Check ownership
								if ( $alert->post_author != get_current_user_id() )
									throw new Exception( __( 'Invalid Alert', 'wp-event-manager-alerts' ) );

								$update_alert = array();
								$update_alert['ID'] = $alert_id;
								$update_alert['post_title'] = $alert_name;
								wp_update_post( $update_alert );
							}
							if ( taxonomy_exists( 'event_listing_category' ) ) {
								$alert_cats = isset( $_POST['alert_cats'] ) ? array_map( 'absint', $_POST['alert_cats'] ) : '';
								wp_set_object_terms( $alert_id, $alert_cats, 'event_listing_category' );
							}
							if ( taxonomy_exists( 'event_listing_tag' ) ) {
							    $alert_tags = isset( $_POST['alert_tags'] ) ? array_map( 'absint', $_POST['alert_tags'] ) : '';
							    wp_set_object_terms( $alert_id, $alert_tags, 'event_listing_tag' );
							}
							if ( taxonomy_exists( 'event_listing_region' ) ) {
								$alert_regions = isset( $_POST['alert_regions'] ) ? array_map( 'absint', $_POST['alert_regions'] ) : '';
								wp_set_object_terms( $alert_id, $alert_regions, 'event_listing_region' );
							}
							if ( taxonomy_exists( 'event_listing_type' ) ) {
							$alert_event_type = isset( $_POST['alert_event_type'] ) ? array_map( 'sanitize_title', $_POST['alert_event_type'] ) : '';
							wp_set_post_terms( $alert_id, $alert_event_type, 'event_listing_type' ,true);
							}  
							update_post_meta( $alert_id, 'alert_frequency', $alert_frequency );
							update_post_meta( $alert_id, 'alert_keyword', $alert_keyword );
							update_post_meta( $alert_id, 'alert_location', $alert_location );

							wp_clear_scheduled_hook( 'event-manager-alert', array( $alert_id ) );

							// Schedule new alert
							switch ( $alert_frequency ) {
								case 'daily' :
									$next = strtotime( '+1 day' );
								break;
								case 'fortnightly' :
									$next = strtotime( '+2 week' );
								break;
								default :
									$next = strtotime( '+1 week' );
								break;
							}
							// Create cron
							wp_schedule_event( $next, $alert_frequency, 'event-manager-alert', array( $alert_id ) );

							wp_redirect( add_query_arg( 'updated', 'true', remove_query_arg( array( 'action', 'alert_id' ) ) ) );
							exit;
						}
					break;
					case 'toggle_status' :
						$alert_id = absint( $_REQUEST['alert_id'] );
						$alert    = get_post( $alert_id );

						// Check ownership
						if ( $alert->post_author != get_current_user_id() )
							throw new Exception( __( 'Invalid Alert', 'wp-event-manager-alerts' ) );

						// Handle cron
						wp_clear_scheduled_hook( 'event-manager-alert', array( $alert_id ) );
						if ( $alert->post_status == 'draft' ) {
							// Schedule new alert
							switch ( $alert->alert_frequency ) {
								case 'daily' :
									$next = strtotime( '+1 day' );
								break;
								case 'fortnightly' :
									$next = strtotime( '+2 week' );
								break;
								default :
									$next = strtotime( '+1 week' );
								break;
							}

							// Create cron
							wp_schedule_event( $next, $alert->alert_frequency, 'event-manager-alert', array( $alert_id ) );
						}
						$update_alert = array();
						$update_alert['ID'] = $alert_id;
						$update_alert['post_status'] = $alert->post_status == 'publish' ? 'draft' : 'publish';
						wp_update_post( $update_alert );

						// Message
						$this->alert_message = '<div class="event-manager-message wpem-alert wpem-alert-success">' . sprintf( __( '%s has been %s', 'wp-event-manager-alerts' ), $alert->post_title, $alert->post_status == 'draft' ? __( 'Enabled', 'wp-event-manager-alerts' ) : __( 'Disabled', 'wp-event-manager-alerts' ) ) . '</div>';
					break;
					case 'delete' :
						$alert_id = absint( $_REQUEST['alert_id'] );
						$alert    = get_post( $alert_id );

						// Check ownership
						if ( $alert->post_author != get_current_user_id() )
							throw new Exception( __( 'Invalid Alert', 'wp-event-manager-alerts' ) );

						// Trash it
						wp_trash_post( $alert_id );

						// Message
						$this->alert_message = '<div class="event-manager-message wpem-alert wpem-alert-danger">' . sprintf( __( 'Your %s have been deleted', 'wp-event-manager-alerts' ), $alert->post_title ) . '</div>';
					break;
					case 'email' :
						$alert_id = absint( $_REQUEST['alert_id'] );
						$alert    = get_post( $alert_id );
						do_action( 'event-manager-alert', $alert_id, true );
						$this->alert_message = '<div class="event-manager-message wpem-alert wpem-alert-success">' . sprintf( __( '%s has been triggered', 'wp-event-manager-alerts' ), $alert->post_title ) . '</div>';
					break;
				}
			} catch ( Exception $e ) {
				$this->alert_message = '<div class="event-manager-error wpem-alert wpem-alert-danger">' . $e->getMessage() . '</div>';
			}
		}
	}

	/**
	 * Shortcode for the alerts page
	 */
	public function event_alerts( $atts ) {
		global $event_manager;
		
		if ( ! is_user_logged_in() ) {
			_e( 'You need to be signed in to manage your alerts.', 'wp-event-manager-alerts' );
			return;
		}

		wp_enqueue_script( 'event-alerts' );

		ob_start();

		if ( ! empty( $_GET['updated'] ) )
			echo '<div class="event-manager-message">' . __( 'Your alerts have been updated', 'wp-event-manager-alerts' ) . '</div>';
		else
			echo $this->alert_message;

		// If doing an action, show conditional content if needed....
		if ( ! empty( $this->action ) ) {

			$alert_id = isset( $_REQUEST['alert_id'] ) ? absint( $_REQUEST['alert_id'] ) : '';

			switch ( $this->action ) {
				case 'add_alert' :
					$this->add_alert();
					return;
				case 'edit' :
					$this->edit_alert( $alert_id );
					return;
				case 'view' :
					$this->view_results( $alert_id );
					return;
			}
		}
		// ....If not show the event dashboard
		$args = array(
			'post_type'           => 'event_alert',
			'post_status'         => array( 'publish', 'draft' ),
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => -1,
			'orderby'             => 'title',
			'order'               => 'asc',
			'author'              => get_current_user_id()
		);
		$alerts = get_posts( $args );
		$user   = wp_get_current_user();
		get_event_manager_template( 'my-alerts.php', array( 'alerts' => $alerts, 'user' => $user ), 'wp-event-manager-alerts', EVENT_MANAGER_ALERTS_PLUGIN_DIR . '/templates/' );
		return ob_get_clean();
	}

	/**
	 * Add alert form
	 */
	public function add_alert() {
		get_event_manager_template( 'alert-form.php', array(
			'alert_id'        => '',
			'alert_name'      => isset( $_REQUEST['alert_name'] ) ? sanitize_text_field( $_REQUEST['alert_name'] ) : '',
			'alert_keyword'   => isset( $_REQUEST['alert_keyword'] ) ? sanitize_text_field( $_REQUEST['alert_keyword'] ) : '',
			'alert_location'  => isset( $_REQUEST['alert_location'] ) ? sanitize_text_field( $_REQUEST['alert_location'] ) : '',
		    'alert_regions'    => isset( $_REQUEST['alert_regions'] ) ? array( sanitize_text_field( $_REQUEST['alert_regions'] ) ) : array(),
			'alert_frequency' => isset( $_REQUEST['alert_frequency'] ) ? sanitize_text_field( $_REQUEST['alert_frequency'] ) : '',
			'alert_cats'      => isset( $_REQUEST['alert_cats'] ) ? array_map( 'absint', $_REQUEST['alert_cats'] ) : array(),
			'alert_tags'      => isset( $_REQUEST['alert_tags'] ) ? array_filter( array_map( 'absint', (array) $_REQUEST['alert_tags'] ) ) : array(),
			'alert_event_type'  => isset( $_REQUEST['alert_event_type'] ) ? array_map( 'sanitize_title', $_REQUEST['alert_event_type'] ) : array()
		), 'wp-event-manager-alerts', EVENT_MANAGER_ALERTS_PLUGIN_DIR . '/templates/' );
	}

	/**
	 * Edit alert form
	 */
	public function edit_alert( $alert_id ) {
		$alert = get_post( $alert_id );

		if ( $alert->post_author != get_current_user_id() )
			return;
			
		get_event_manager_template( 'alert-form.php', array(
			'alert_id'        => $alert_id,
			'alert_name'      => isset( $_POST['alert_name'] ) ? sanitize_text_field( $_POST['alert_name'] ) : $alert->post_title,
			'alert_keyword'   => isset( $_POST['alert_keyword'] ) ? sanitize_text_field( $_POST['alert_keyword'] ) : $alert->alert_keyword,
			'alert_location'  => isset( $_POST['alert_location'] ) ? sanitize_text_field( $_POST['alert_location'] ) : $alert->alert_location,
			'alert_frequency' => isset( $_POST['alert_frequency'] ) ? sanitize_text_field( $_POST['alert_frequency'] ) : $alert->alert_frequency,
			'alert_cats'      => isset( $_POST['alert_cats'] ) ? array_map( 'absint', $_POST['alert_cats'] ) : wp_get_post_terms( $alert_id, 'event_listing_category', array( 'fields' => 'ids' ) ),
			'alert_tags'      => isset( $_POST['alert_tags'] ) ? array_map( 'absint', $_POST['alert_tags'] ) : wp_get_post_terms( $alert_id, 'event_listing_tag', array( 'fields' => 'ids' ) ),
			'alert_event_type'  => isset( $_POST['alert_event_type'] ) ? array_map( 'sanitize_title', $_POST['alert_event_type'] ) : wp_get_post_terms( $alert_id, 'event_listing_type', array( 'fields' => 'ids' ) )
		), 'wp-event-manager-alerts', EVENT_MANAGER_ALERTS_PLUGIN_DIR . '/templates/' );
	}

	/**
	 * View results
	 */
	public function view_results( $alert_id ) {
		$alert = get_post( $alert_id );
		 if (!wp_script_is( 'wp-event-manager-content-event-listing', 'enqueued' )) {
			wp_enqueue_script('wp-event-manager-content-event-listing'); 
		  }
		$events  = WP_Event_Manager_Alerts_Notifier::get_matching_events( $alert, true );
		echo '<p class="wpem-alert wpem-alert-info">'.  sprintf( __( 'Events matching your "%s" alert:', 'wp-event-manager-alerts' ), $alert->post_title ) .'</p>'; ?>
		
        <?php
		if ( $events->have_posts() ) : ?>		    
			<div id="event-listing-view" class="wpem-main wpem-event-listings event_listings  wpem-event-listing-list-view">	

				<?php while ( $events->have_posts() ) : $events->the_post(); ?>

					<?php get_event_manager_template_part( 'content', 'event_listing' ); ?>

				<?php endwhile; ?>

			</div>

		<?php else :
		echo '<p class="wpem-alert wpem-alert-info">'. __( 'No events found', 'wp-event-manager-alerts' ).'</p>' ;
		endif;

		wp_reset_postdata();
	}
}
new WP_Event_Manager_Alerts_Shortcodes();