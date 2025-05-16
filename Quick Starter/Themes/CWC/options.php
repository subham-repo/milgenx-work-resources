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


	$options[] = array(
		'name' => __('HEADER', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Contact Number', 'options_check'),
		'desc' => __('Please enter Contact Number', 'options_check'),
		'id' => 'contact_num_op',
		'type' => 'text');

	$options[] = array(
		'name' => __('Header Logo', 'options_check'),
		'desc' => __('Please Choose logo', 'options_check'),
		'id' => 'header_logo',
		'type' => 'upload');


	$options[] = array(
		'name' => __('Social Media', 'options_check'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Instruction', 'options_check'),
		'desc' => __('Use shortcode " [mini-social] " to show this section on any page', 'options_check'),
		'id' => 'social_lebel',
		'type' => '');

	$options[] = array(
		'name' => __('Facebook', 'options_check'),
		'desc' => __('Please enter facebook link', 'options_check'),
		'id' => 'facebook_id',
		'type' => 'text');

	$options[] = array(
		'name' => __('Twitter', 'options_check'),
		'desc' => __('Please enter twitter link', 'options_check'),
		'id' => 'twitter_id',
		'type' => 'text');

	$options[] = array(
		'name' => __('Youtube', 'options_check'),
		'desc' => __('Please enter youtube link', 'options_check'),
		'id' => 'youtube_id',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Insta', 'options_check'),
		'desc' => __('Please enter insta url', 'options_check'),
		'id' => 'insta_id',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('linkedin', 'options_check'),
		'desc' => __('Please enter linkedin url', 'options_check'),
		'id' => 'linkedin_id',
		'type' => 'text');

	$options[] = array(
		'name' => __('Pinterest', 'options_check'),
		'desc' => __('Please enter Pinterest url', 'options_check'),
		'id' => 'pinterest_id',
		'type' => 'text');






	$options[] = array(
		'name' => __('Email Information', 'options_check'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Email Id', 'options_check'),
		'desc' => __('Please enter email id', 'options_check'),
		'id' => 'email_id',
		'type' => 'text');

	
	$options[] = array(
		'name' => __('Insurance', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Instruction', 'options_check'),
		'desc' => __('Use shortcode " [verify-insurance] " to show this section on any page', 'options_check'),
		'id' => 'ins_lebel',
		'type' => '');

	$options[] = array(
		'name' => __('heading', 'options_check'),
		'desc' => __('Please enter heading', 'options_check'),
		'id' => 'ins_heading',
		'type' => 'text');

	$options[] = array(
		'name' => __('Insurance companies', 'options_check'),
		'desc' => __('Add isurance companies banner', 'options_check'),
		'id' => 'ins_banner',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Verify Insurance Button Text', 'options_check'),
		'desc' => __('Please enter verify insurance button text', 'options_check'),
		'id' => 'ins_bttext',
		'type' => 'text');

	$options[] = array(
		'name' => __('Verify Insurance Button Link', 'options_check'),
		'desc' => __('Please enter verify insurance button link', 'options_check'),
		'id' => 'ins_btlink',
		'type' => 'text');
	

	$options[] = array(
		'name' => __('Global CTA', 'options_check'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Instruction', 'options_check'),
		'desc' => __('Use shortcode " [global-cta] " to show this section on any page', 'options_check'),
		'id' => 'g_lebel',
		'type' => '');

	$options[] = array(
		'name' => __('heading', 'options_check'),
		'desc' => __('Please enter heading', 'options_check'),
		'id' => 'gcta_heading',
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
