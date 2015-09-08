<?php
/*
Plugin Name: Rad Admin Tweaks
Description:  Adds some customization to the admin, login, and register screens
Author: Melissa Cabral
License: GPLv3
Version: 0.1
*/

/**
 * Customize the CSS of the login screen
 */
function rad_login_css(){
	$logo_url = plugins_url( 'images/logo.png', __FILE__ );
	?>
	<style>
		body{
			background-color: #696763;
		}
		/*logo*/
		.login h1 a{
			background-image: url(<?php echo $logo_url ?>);
			width:auto;
			background-size: auto auto;
		}
		/*button*/
		.login #wp-submit{
			background-color: #6bcbca;
			border: none;
			display: block;
			width:100%;
			margin-top:1em;
			font-size: 1.2em;
		}
		.login #wp-submit:hover,
		.login #wp-submit:focus{
			background-color: #4BC56B;
			outline: none;
		}
	</style>
	<?php
}
add_action( 'login_head', 'rad_login_css' );

/**
 * Change the logo link behavior on the login screen
 */
function rad_login_logo_link(){
	return home_url();  //take us to the home page of the site
}
add_filter( 'login_headerurl', 'rad_login_logo_link'  );

function rad_login_logo_title(){
	return 'Return to ' . get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'rad_login_logo_title' );

/**
 * Remove the WP logo and dropdown menu from the admin bar
 * @link https://codex.wordpress.org/Toolbar 
 * @param $wp_admin_bar = the admin bar object
 */
function rad_remove_node( $wp_admin_bar ){
	$wp_admin_bar->remove_node( 'wp-logo' );

	//add a "help" link
	$wp_admin_bar->add_node( array(
		'id'	=> 'get-help',
		'title'	=> '<span class="ab-icon dashicons dashicons-editor-help"></span> Get Help',
		'href'	=> 'http://wordpress.melissacabral.com',
	) );
}
add_action( 'admin_bar_menu', 'rad_remove_node', 999 );

/**
 * Add favicons to admin and login screens
 */
function rad_admin_favicon(){
	$icon_url = plugins_url( 'images/admin-favicon.ico', __FILE__ );
	?>
	<link rel="shortcut icon" href="<?php echo $icon_url ?>">
	<?php
}
add_action( 'admin_head', 'rad_admin_favicon' );
add_action( 'login_head', 'rad_admin_favicon' );

/**
 * Change the dashboard widgets
 */
function rad_dashboard(){
	//remove "wordpress news"
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	//remove Quick Draft
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );

	//add our own custom dashboard widget
	//							id, title, content callback
	wp_add_dashboard_widget( 'dashboard_rad_help', 'Helpful Information', 
		'rad_widget_content' );
}
add_action( 'wp_dashboard_setup', 'rad_dashboard' );

//callback for widget content
function rad_widget_content(){
	?>
	<h3>Add Images and media: </h3>
	<iframe width="350" height="197" src="https://www.youtube.com/embed/qO8GZNdQ54I" frameborder="0" allowfullscreen></iframe>
	<?php 
}