<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => __('One', 'options_check'),
		'two' => __('Two', 'options_check'),
		'three' => __('Three', 'options_check'),
		'four' => __('Four', 'options_check'),
		'five' => __('Five', 'options_check')
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => __('French Toast', 'options_check'),
		'two' => __('Pancake', 'options_check'),
		'three' => __('Omelette', 'options_check'),
		'four' => __('Crepe', 'options_check'),
		'five' => __('Waffle', 'options_check')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

/*========================Basic Settings===============================*/

	$options[] = array(
		'name' => __('Basic Settings', 'options_check'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Favicon Icon', 'options_check'),
		'desc' => __('Upload a file( png, ico, jpg, gif or bmp ) from your computer (maximum size:30KB, Width X Height : 32 x 32 )', 'options_check'),
		'id' => 'fav_icon',
		'type' => 'upload');	
		
	$options[] = array(
		'name' => __('Upload Logo', 'options_check'),
		'desc' => __('Upload a file( png, ico, jpg, gif or bmp ) from your computer (maximum size:30KB, Width X Height : 170 x 60 )', 'options_check'),
		'id' => 'upload_logo',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Telephone', 'options_check'),
		'desc' => __('Please enter the telephone number', 'options_check'),
		'id' => 'tel_no',
		'type' => 'text');

	$options[] = array(
		'name' => __('Email', 'options_check'),
		'desc' => __('Please enter the Email Address', 'options_check'),
		'id' => 'email_ad',
		'type' => 'text');
		
			
/*===========================Socail icons==========================================*/	

	$options[] = array(
		'name' => __('Socail icons', 'options_check'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Social Icons', 'options_check'),
		'desc' => __('Please enter URL Below mention fields', 'options_check'),
		);
		
	$options[] = array(
		'name' => __('Facebook URL', 'options_check'),
		'desc' => __('Please enter the Facebook page link', 'options_check'),
		'id' => 'facebook_url',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Twitter URL', 'options_check'),
		'desc' => __('Please enter the Twitter page link', 'options_check'),
		'id' => 'twitter_url',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Pinterest', 'options_check'),
		'desc' => __('Please enter the Pinterest page link', 'options_check'),
		'id' => 'pinterest_url',
		'type' => 'text');
		
	$options[] = array(
		'name' => __('Instagram URL', 'options_check'),
		'desc' => __('Please enter the Instagram page link', 'options_check'),
		'id' => 'insta_url',
		'type' => 'text');		
    	
/*===========================Footer-options_check=========================================*/	

	$options[] = array(
		'name' => __('Footer', 'options_check'),
		'type' => 'heading');	
		
	$options[] = array(
		'name' => __('Footer logo img', 'options_check'),
		'id' => 'foot_logo_img',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Achievements img', 'options_check'),
		'id' => 'achieve_img',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('Watch Us Text', 'options_check'),
		'desc' => __('Enter Watch Us Text', 'options_check'),	
		'id' => 'watch_abc10_text',
		'type' => 'text',
		 );

	$options[] = array(
		'name' => __('ABC 10 Link', 'options_check'),
		'id' => 'watch_abc10_link',
		'type' => 'text');		 
		
	$options[] = array(
		'name' => __('ABC 10', 'options_check'),
		'id' => 'watch_abc10_img',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Payments card img', 'options_check'),
		'id' => 'payment_img',
		'type' => 'upload');

	$options[] = array(
	'name' => __('Footer bottom logos img', 'options_check'),
	'id' => 'foot_bottom_img',
	'type' => 'upload');

	$options[] = array(
		'name' => __('Copyright', 'options_check'),
		'desc' => __('Enter Copyright Description Below Whatever you want to add.', 'options_check'),	
		'id' => 'copyright',
		'type' => 'text'
		 );	
/*=================================Contact Information=====================================*/
	$options[] = array(
		'name' => __('Contact Information', 'options_check'),
		'type' => 'heading');		
		
	$options[] = array(
		'name' => __('Contact Address', 'options_check'),
		'desc' => __('Enter Contact Address Here', 'options_check'),
		'id' => 'footer_contact_address',
		'type' => 'text');	

	$options[] = array(
		'name' => __('Contact Email', 'options_check'),
		'desc' => __('Enter Contact Email Here', 'options_check'),
		'id' => 'contact_email',
		'type' => 'text');	

	$options[] = array(
		'name' => __('Cell Number', 'options_check'),
		'desc' => __('Enter Cell Number Here', 'options_check'),
		'id' => 'cell_number',
		'type' => 'text');	
		
	$options[] = array(
		'name' => __('Send us message link', 'options_check'),
		'desc' => __('Enter send us message link Here', 'options_check'),
		'id' => 'send_us_message_link',
		'type' => 'text');		
	

/*===========================Free Kitchen==========================================*/	
$options[] = array(
		'name' => __('Free Kitchen', 'options_check'),
		'type' => 'heading');	

$options[] = array(
		'name' => __('Heading', 'options_check'),
		'desc' => __('Enter Heading Here', 'options_check'),
		'id' => 'free_head',
		'type' => 'text');	

$options[] = array(
		'name' => __('Content', 'options_check'),
		'desc' => __('Enter Content Here', 'options_check'),
		'id' => 'free_contents',
		'type' => 'textarea');
$options[] = array(
		'name' => __('Button Text', 'options_check'),
		'desc' => __('Enter Button Text Here', 'options_check'),
		'id' => 'free_btn_txt',
		'type' => 'text');
$options[] = array(
		'name' => __('Button Link', 'options_check'),
		'desc' => __('Enter Button Link Here', 'options_check'),
		'id' => 'free_btn_lnk',
		'type' => 'text');
$options[] = array(
		'name' => __('Free Kitchen Image', 'options_check'),
		'id' => 'freekit_img',
		'type' => 'upload');


/*===========================Lets Get Started==========================================*/	
$options[] = array(
		'name' => __('Lets Get Started', 'options_check'),
		'type' => 'heading');	

$options[] = array(
		'name' => __('Heading', 'options_check'),
		'desc' => __('Enter Heading Here', 'options_check'),
		'id' => 'lets_head',
		'type' => 'text');	

$options[] = array(
		'name' => __('Sub Heading', 'options_check'),
		'desc' => __('Enter Sub Heading Here', 'options_check'),
		'id' => 'lets_head1',
		'type' => 'text');	

$options[] = array(
		'name' => __('Brief Description ', 'options_check'),
		'desc' => __('Enter Brief Description Here', 'options_check'),
		'id' => 'lets_brief',
		'type' => 'text');	
$options[] = array(
		'name' => __('Lets Get Started fabuwood', 'options_check'),
		'type' => 'heading');	

$options[] = array(
		'name' => __('Heading', 'options_check'),
		'desc' => __('Enter Heading Here', 'options_check'),
		'id' => 'lets_head_fabuwood',
		'type' => 'text');	

$options[] = array(
		'name' => __('Sub Heading', 'options_check'),
		'desc' => __('Enter Sub Heading Here', 'options_check'),
		'id' => 'lets_head1_fabuwood',
		'type' => 'text');	

$options[] = array(
		'name' => __('Brief Description ', 'options_check'),
		'desc' => __('Enter Brief Description Here', 'options_check'),
		'id' => 'lets_brief_fabuwood',
		'type' => 'text');	


/*=========View All Cabinet Lines on cabinet category page=================*/	
$options[] = array(
		'name' => __('View All Cabinet Lines', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('View Cabinet Lines Image', 'options_check'),
		'desc' => __('Upload Cabinet Lines Image', 'options_check'),
		'id' => 'view_cabinet_lines_image',
		'type' => 'upload');	

$options[] = array(
		'name' => __('View Cabinet Lines Button', 'options_check'),
		'desc' => __('Add Cabinet Lines Button', 'options_check'),
		'id' => 'view_cabinet_lines_button_name',
		'type' => 'text');	

$options[] = array(
		'name' => __('View Cabinet Lines Button Link', 'options_check'),
		'desc' => __('Add Cabinet Lines Button Link', 'options_check'),
		'id' => 'view_cabinet_lines_button_link',
		'type' => 'text');
		
/*=========order free door samples on cabinet category page=================*/	
$options[] = array(
		'name' => __('Order Free Door Samples', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('Order Free Door Samples Image', 'options_check'),
		'desc' => __('Upload Order Free Door Samples Image', 'options_check'),
		'id' => 'order_free_door_samples_image',
		'type' => 'upload');	

$options[] = array(
		'name' => __('Order Free Door Samples Button', 'options_check'),
		'desc' => __('Add Order Free Door Samples Button', 'options_check'),
		'id' => 'order_free_door_samples_button_name',
		'type' => 'text');	

$options[] = array(
		'name' => __('Order Free Door Samples Button Link', 'options_check'),
		'desc' => __('Add Order Free Door Samples Button Link', 'options_check'),
		'id' => 'order_free_door_samples_button_link',
		'type' => 'text');
		
/*=========Get a free kitchen design on cabinet category page=================*/	
$options[] = array(
		'name' => __('Get Free Kitchen Design', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('Get Free Kitchen Design Image', 'options_check'),
		'desc' => __('Upload Get Free Kitchen Design Image', 'options_check'),
		'id' => 'get_free_kitchen_design_image',
		'type' => 'upload');	

$options[] = array(
		'name' => __('Get Free Kitchen Design Button', 'options_check'),
		'desc' => __('Add Get Free Kitchen Design Button', 'options_check'),
		'id' => 'get_free_kitchen_design_button_name',
		'type' => 'text');	

$options[] = array(
		'name' => __('Get Free Kitchen DesignButton Link', 'options_check'),
		'desc' => __('Add Get Free Kitchen Design Button Link', 'options_check'),
		'id' => 'get_free_kitchen_design_button_link',
		'type' => 'text');
		
/*========= Virtual Showroom Bottom 3 Part =================*/	
$options[] = array(
		'name' => __('Virtual Showroom Bottom Part', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('Virtual Showroom Bottom Part 1st Row', 'options_check'),
		'type' => 'sub_heading');
		
$options[] = array(
		'name' => __('Virtual Showroom Cabinet Options & Pricing', 'options_check'),
		'desc' => __('Virtual Showroom Cabinet Options and Pricing Data', 'options_check'),
		'id' => 'virtual_cabinet_options_pricing_data',
		'type' => 'editor');	
		
$options[] = array(
		'name' => __('Button Name', 'options_check'),
		'desc' => __('Virtual Showroom Cabinet Options and Pricing Button Name', 'options_check'),
		'id' => 'virtual_cabinet_options_pricing_data_button_name',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Button Link', 'options_check'),
		'desc' => __('Virtual Showroom Cabinet Options and Pricing Button Link', 'options_check'),
		'id' => 'virtual_cabinet_options_pricing_data_button_link',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Virtual Showroom Bottom Part 2nd Row', 'options_check'),
		'type' => 'sub_heading');

$options[] = array(
		'name' => __('Virtual Showroom Get Free Samples', 'options_check'),
		'desc' => __('Virtual Showroom Get Free Order Samples', 'options_check'),
		'id' => 'virtual_get_free_order_samples',
		'type' => 'editor');
		
$options[] = array(
		'name' => __('Button Name', 'options_check'),
		'desc' => __('Virtual Showroom Get Free Order Samples Button Name', 'options_check'),
		'id' => 'virtual_get_free_order_samples_button_name',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Button Link', 'options_check'),
		'desc' => __('Virtual Showroom Get Free Order Samples Button Link', 'options_check'),
		'id' => 'virtual_get_free_order_samples_button_link',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Virtual Showroom Bottom Part 3rd Row', 'options_check'),
		'type' => 'sub_heading');

$options[] = array(
		'name' => __('Virtual Showroom Get Started', 'options_check'),
		'desc' => __('Virtual Showroom Get Started Data', 'options_check'),
		'id' => 'virtual_cabinet_get_started',
		'type' => 'editor');
		
$options[] = array(
		'name' => __('Button Name', 'options_check'),
		'desc' => __('Virtual Showroom Get Started Button Name', 'options_check'),
		'id' => 'virtual_cabinet_get_started_button_name',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Button Link', 'options_check'),
		'desc' => __('Virtual Showroom Get Started Button Link', 'options_check'),
		'id' => 'virtual_cabinet_get_started_button_link',
		'type' => 'text');
		

/*========= Get Started Steps Manage from backend for get started and kitchen =========*/	
$options[] = array(
		'name' => __('Cabinet Steps', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('Cabinet Step 1', 'options_check'),
		'desc' => __('Add Cabinet Step 1 Information', 'options_check'),
		'id' => 'walsh_get_started_cabinet_step_1',
		'type' => 'editor');
		
$options[] = array(
		'name' => __('Cabinet Step 2', 'options_check'),
		'desc' => __('Add Cabinet Step 2 Information', 'options_check'),
		'id' => 'walsh_get_started_cabinet_step_2',
		'type' => 'editor');

$options[] = array(
		'name' => __('Cabinet Step 3', 'options_check'),
		'desc' => __('Add Cabinet Step 3 Information', 'options_check'),
		'id' => 'walsh_get_started_cabinet_step_3',
		'type' => 'editor');
		
$options[] = array(
		'name' => __('Cabinet Step Main Content', 'options_check'),
		'desc' => __('Add Cabinet Step Main Content Like get started heading and content', 'options_check'),
		'id' => 'walsh_get_started_cabinet_main_content',
		'type' => 'editor');

$options[] = array(
		'name' => __('Cabinet Step Additonal Information', 'options_check'),
		'desc' => __('Add Cabinet Step Additional information like number of free door samples, paid etc', 'options_check'),
		'id' => 'walsh_get_started_cabinet_additional_information',
		'type' => 'editor');

$options[] = array(
		'name' => __('Cabinet Step Return Cart Text', 'options_check'),
		'desc' => __('Add Cabinet Return to cart text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_return_cart_text',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Cabinet Step More Info Text', 'options_check'),
		'desc' => __('Add Cabinet more info text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_more_info_text',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Cabinet Step Door Sample Text', 'options_check'),
		'desc' => __('Add Cabinet door sample text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_door_sample_text',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Cabinet Step Get Sample Button Text', 'options_check'),
		'desc' => __('Add Cabinet get sample button text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_get_sample_text',
		'type' => 'text');	

$options[] = array(
		'name' => __('Cabinet Step Get Sample Ordered Button Text', 'options_check'),
		'desc' => __('Add Cabinet get sample ordered button text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_get_sample_done_text',
		'type' => 'text');	

$options[] = array(
		'name' => __('Cabinet Step After Get Sample Ordered View Cart Text', 'options_check'),
		'desc' => __('Add Cabinet after get sample ordered view cart text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_get_sample_popup_view_cart_text',
		'type' => 'text');		
	
$options[] = array(
		'name' => __('Cabinet Step Fist Three Free Text', 'options_check'),
		'desc' => __('Add Cabinet first three free text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_first_three_free_text',
		'type' => 'text');
	
$options[] = array(
		'name' => __('Cabinet Step Cabinet Sepecifications Text', 'options_check'),
		'desc' => __('Add Cabinet specifications text on popup', 'options_check'),
		'id' => 'walsh_get_started_cabinet_specifications_text',
		'type' => 'text');

$options[] = array(
		'name' => __('Cabinet Step Checkout Popup Text', 'options_check'),
		'desc' => __('Add Cabinet Checkout popup text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_popup_checkout_text',
		'type' => 'text');

$options[] = array(
		'name' => __('Cabinet Step Resources Text', 'options_check'),
		'desc' => __('Add Cabinet Resources text', 'options_check'),
		'id' => 'walsh_get_started_cabinet_resources_text',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Cabinet Step PDF Download Area', 'options_check'),
		'desc' => __('Add Cabinet PDF download area', 'options_check'),
		'id' => 'walsh_get_started_cabinet_download_pdf',
		'type' => 'editor');
	
$options[] = array(
		'name' => __('Cabinet Step How to Measure Area', 'options_check'),
		'desc' => __('Add Cabinet how to measure area', 'options_check'),
		'id' => 'walsh_get_started_cabinet_measure_area',
		'type' => 'editor');
		
$options[] = array(
		'name' => __('Cabinet Step Gravity Form', 'options_check'),
		'desc' => __('Add Gravity form to cabinet step 3', 'options_check'),
		'id' => 'walsh_get_started_cabinet_add_gform',
		'type' => 'editor');
		
$options[] = array(
		'name' => __('Cabinet Step After Order Placement', 'options_check'),
		'desc' => __('Add Success message in popup after free order door sample checkout', 'options_check'),
		'id' => 'walsh_get_started_cabinet_checkout_success',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Cabinet Get Started Page URL', 'options_check'),
		'desc' => __('Add Cabinet Get Started Page URL', 'options_check'),
		'id' => 'walsh_get_started_cabinet_url',
		'type' => 'text');

/*========= Order free sample popup dynamic content =========*/	
$options[] = array(
		'name' => __('Order Free Sample Popup Content', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('Popup content to display for order free sample', 'options_check'),
		'desc' => __('Add popup content to display for free order sample', 'options_check'),
		'id' => 'walsh_order_free_sample_popup_content',
		'type' => 'editor');
		
		
/*========= Cabinet Product Steps heading on visualizer =========*/	
$options[] = array(
		'name' => __('Cabinet Proudcts Steps Heading', 'options_check'),
		'type' => 'heading');	
		 
$options[] = array(
		'name' => __('Cabinet Product Step1 Head', 'options_check'),
		'desc' => __('Add Cabinet product step1 heading for visualizer', 'options_check'),
		'id' => 'walsh_cabinet_proudct_step_1_head',
		'type' => 'textarea');

$options[] = array(
		'name' => __('Cabinet Product Step2 Head', 'options_check'),
		'desc' => __('Add Cabinet product step2 heading for visualizer', 'options_check'),
		'id' => 'walsh_cabinet_proudct_step_2_head',
		'type' => 'textarea');
		
$options[] = array(
		'name' => __('Cabinet Product Step3 Head', 'options_check'),
		'desc' => __('Add Cabinet product step3 heading for visualizer', 'options_check'),
		'id' => 'walsh_cabinet_proudct_step_3_head',
		'type' => 'textarea');
		

/*========= Cabinet Product Popup Steps heading on visualizer =========*/	
$options[] = array(
		'name' => __('Cabinet Proudcts Popup Steps Heaing', 'options_check'),
		'type' => 'heading');	
		
$options[] = array(
		'name' => __('Cabinet Product Popup Step1 Head', 'options_check'),
		'desc' => __('Add Cabinet product Popup step1 heading for visualizer', 'options_check'),
		'id' => 'walsh_cabinet_proudct_popup_step_1_head',
		'type' => 'text');

$options[] = array(
		'name' => __('Cabinet Product Popup Step2 Head', 'options_check'),
		'desc' => __('Add Cabinet product Popup step2 heading for visualizer', 'options_check'),
		'id' => 'walsh_cabinet_proudct_popup_step_2_head',
		'type' => 'text');
		
$options[] = array(
		'name' => __('Cabinet Product Popup Step3 Head', 'options_check'),
		'desc' => __('Add Cabinet product Popup step3 heading for visualizer', 'options_check'),
		'id' => 'walsh_cabinet_proudct_popup_step_3_head',
		'type' => 'text');
		
	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress,wplink' )
	);

	/* $options[] = array(
		'name' => __('Default Text Editor', 'options_check'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_check' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );

	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'media_buttons' => true
	);

	$options[] = array(
		'name' => __('Additional Text Editor', 'options_check'),
		'desc' => sprintf( __( 'This editor includes media button.', 'options_check' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor_media',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
 */
	return $options;
}
