<?php
/**
 * WP_Event_Submit_Sell_Tickets_Form class.
 */

class WP_Event_Manager_Registration_Form_Fields {
		
	/**
	 * Constructor.
	 */
	public function __construct() {
		
		// Add filters
		add_filter( 'submit_event_form_fields', array( $this, 'init_fields') );
		//add_filter( 'submit_event_form_validate_fields',array($this,'validate_registrations_fields') , 10, 3 );
	}
	
	/**
	 * init_fields function.
	 * This function add the form fields to the submit event form
	 */
	public function init_fields($fields) {
		$fields['event']['registration_limit'] =  array(
														'label'       => __( 'Registration Limit', 'wp-event-manager-registrations' ),
														'type'        => 'number',
														'min'    	  => 0,
														'required'    => false,
														'placeholder' => __('Enter number of avaialble seat','wp-event-manager-registrations' ),
														'priority'    => 22,
												   );
		return $fields;
	}
	
	/**
	 * validate form fields
	 * @param $validate , $fields , $values
	 * @throws Exception
	 * @return boolean
	 */
	public function validate_registrations_fields( $validate , $fields , $values)
	{}
	
}

new WP_Event_Manager_Registration_Form_Fields();
?>
