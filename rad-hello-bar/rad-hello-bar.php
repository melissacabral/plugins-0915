<?php
/*
Plugin Name:  Rad Hello Bar
Description: A simple plugin that adds a promotional banner at the top of the page
Author: Melissa Cabral
Version: 0.1
License: GPLv3 or higher
Plugin URI: http://plugin-site.com
Author URI: http://your-website.com
*/


/**
 * HTML markup that will be added to the bottom of the page
 */
function rad_bar_html(){
	?>
	<!-- Rad Hello Bar Plugin by Melissa Cabral -->
	<div id="rad-hello-bar">
		<span>Happy Wednesday!  Almost over the hump...
			<a href="#">Learn More</a>
		</span>
	</div>
	<?php	
}
add_action( 'wp_footer', 'rad_bar_html' );



/**
 * Attach stylesheet
 */
function rad_bar_styles(){
	//absolute path to stylesheet
	$path = plugins_url( 'css/rad-hello-bar.css', __FILE__ );
	wp_enqueue_style( 'rad-hello-bar-style', $path );
}
add_action( 'wp_enqueue_scripts', 'rad_bar_styles' );
//no close php