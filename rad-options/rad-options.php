<?php 
/*
Plugin Name: Rad Options
Author: Melissa Cabral
Description:  Adds a "Company Info" settings page to admin
License: GPLv3
Version: 0.1
*/

/**
 * Add a page in admin under "settings"
 */
add_action( 'admin_menu', 'rad_options_page' );
function rad_options_page(){
	//      $page_title, $menu_title, $capability, $menu_slug, $function
	add_options_page( 'Company Information', 'Company Info', 'manage_options', 
		'company-info', 'rad_options_content' );
}

//callback for content
function rad_options_content(){
	//security check before including a file for the content
	if( current_user_can( 'manage_options' ) ){
		//includes need Filepaths, so plugins_url() won't work here
		require( plugin_dir_path( __FILE__ ) . 'includes/content.php' );
	}else{
		wp_die('You do not have permission to view this page');
	}
}

/**
 * Whitelist the settings so they are allowed in the DB
 */
add_action( 'admin_init', 'rad_options_settings' );
function rad_options_settings(){
					// $option_group, $option_name, $sanitize_callback
	register_setting( 'rad_options_group', 'rad_options' , 'rad_options_sanitize' );
}

/**
 * callback for sanitizing each input
 * @param $input = array of dirty data from the form
 */
function rad_options_sanitize($input){
	//go through each field and clean them
	$input['phone'] = wp_filter_nohtml_kses( $input['phone'] );
	$input['email'] = wp_filter_nohtml_kses( $input['email'] );

	//allow some tags in address
	$allowed_tags = array(
		'br'	=> 		array(),
		'p'		=> 		array(),
	);

	$input['address'] = wp_kses( $input['address'], $allowed_tags );

	//send the clean data back to WP for storage
	return $input;
}