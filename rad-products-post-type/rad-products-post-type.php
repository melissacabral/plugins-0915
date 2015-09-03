<?php 
/*
Plugin Name: Rad Products Post Type
Description: Adds the admin interface for Products 
Author: Melissa Cabral
License: GPLv3
Version 0.1
*/

/**
 * Create post type
 * @since  0.1 
 */
add_action( 'init', 'rad_post_type' );
function rad_post_type(){
	register_post_type( 'product', array(
		'public'		=> true,
		'has_archive'	=> true,
		'label'			=> 'Products',
		'menu_icon'		=> 'dashicons-cart',
		'menu_position'	=> 5,
		'supports'		=> array( 'title', 'editor', 'thumbnail', 'custom-fields', 
								 'excerpt' ),
		'labels'		=> array(
			'add_new_item'		=> 'Add New Product',
			'not_found'			=> 'No Products Found',
			'edit_item'			=> 'Edit Product',
		),
	) );
	//add 'brands' to 'products'
	register_taxonomy( 'brand', 'product', array(
		'hierarchical'	=> true,   //can have parent/child brands. checkbox interface
		'show_admin_column'	=> true,
		'label'			=> 'Brands',
		'labels'		=> array(
			'add_new_item'		=> 'Add New Brand',
			'search_items'		=> 'Search Brands',
			'not_found'			=> 'No Brands Found',
		),
	) );
}

//no close PHP