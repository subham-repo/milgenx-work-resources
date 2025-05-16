<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'astra-theme-css' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

add_action( 'admin_menu', 'registerd_store_list_menu' );
 
function registerd_store_list_menu(){
	add_menu_page(
		'Registered Stores', // page <title>Title</title>
		'Registered Stores', // link text
		'manage_options', // user capabilities
		'registered-stores', // page slug
		'registerd_store_list', // this function prints the page content
		'dashicons-images-alt2', // icon (from Dashicons for example)
		5 // menu position
	);
}

function registerd_store_list(){ ?>
	<h2>List Of Registered Stores</h2>
	<?php
        $store_list = get_field('registered_store_detail', 'option');
        set_query_var( 'store_list', $store_list );
        get_template_part("template-snippets/domain-list-snippet");
}

function acf_options_route(){
  return get_field('registered_store_detail', 'option');
}

add_action("rest_api_init", function () {
  register_rest_route("options", "/registered_store_detail", [
    "methods" => "GET",
    "callback" => "acf_options_route",
  ]);
});

//Load jQuery
wp_enqueue_script('jquery');

//Define AJAX URL
function myplugin_ajaxurl() {

   echo '<script type="text/javascript">
           var ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');


function register_shopify_store() {

    $customer_id    = $_REQUEST['customer_id'];
    $customer_email = $_REQUEST['customer_email'];
    $customer_name  = $_REQUEST['customer_name'];
    $theme_name     = $_REQUEST['theme_name'];
    $shopify_domain = $_REQUEST['shopify_domain'];
    
    // construct an array for the repeater value
    $value = array(
      // each row is a nested array
      // row 1
        // each row contains field key => value pairs for the fields
        'customer_id'   => $customer_id,
        'shopify_domain'   => $shopify_domain,
        'customer_email'   => $customer_email,
        'customer_name'   => $customer_name,
        'theme_name'   => $theme_name
      
      // etc for each row
    );
    // update the repeater
    add_row('registered_store_detail', $value, 'options');
    
    $store_list = get_field('registered_store_detail', 'option');
    $customer_store_list = array();
    $current_user = wp_get_current_user();
    $current_customer_id = $current_user->ID;
    $index = 1;
    foreach ($store_list as $store_list_data) {
        $rowIndex = $index;
        $indexedRow = array_merge([$index], $store_list_data);
        $customerID = $store_list_data['customer_id'];
        if($current_customer_id == $customerID){
            $customer_store_list[] = $indexedRow;
        }
        $index++;
    }
    set_query_var( 'store_list', $customer_store_list );
    set_query_var( 'showCustomerData', true );
    get_template_part("template-snippets/domain-list-snippet");

    // Always die in functions echoing AJAX content
   die();
}

// This bit is a special action hook that works with the WordPress AJAX functionality.
add_action( 'wp_ajax_register_shopify_store', 'register_shopify_store' );
add_action( 'wp_ajax_nopriv_register_shopify_store', 'register_shopify_store' );

function remove_shopify_store() {

    // update the repeater
    delete_row('registered_store_detail', $_REQUEST['index'], 'options');
    
    $store_list = get_field('registered_store_detail', 'option');
    $customer_store_list = array();
    $current_user = wp_get_current_user();
    $current_customer_id = $current_user->ID;
    $index = 1;
    foreach ($store_list as $store_list_data) {
        $rowIndex = $index;
        $indexedRow = array_merge([$index], $store_list_data);
        $customerID = $store_list_data['customer_id'];
        if($current_customer_id == $customerID){
            $customer_store_list[] = $indexedRow;
        }
        $index++;
    }
    set_query_var( 'store_list', $customer_store_list );
    set_query_var( 'showCustomerData', true );
    get_template_part("template-snippets/domain-list-snippet");

    // Always die in functions echoing AJAX content
   die();
}

// This bit is a special action hook that works with the WordPress AJAX functionality.
add_action( 'wp_ajax_remove_shopify_store', 'remove_shopify_store' );
add_action( 'wp_ajax_nopriv_remove_shopify_store', 'remove_shopify_store' );
