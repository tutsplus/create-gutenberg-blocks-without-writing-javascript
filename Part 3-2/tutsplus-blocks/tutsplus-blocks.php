<?php
/*
Plugin Name:	Tutsplus Blocks without Javascript
Plugin URI:		https://tutsplus.com
Description:	Plugin to accompany tuts+ tutorial on creating Gutenberg blocks without Javascript.
Version:		3.2
Author: 		Rachel McCollin
Author URI:		https://rachelmccollin.com
TextDomain:		tutsplus
License:		GPLv2
*/

/*******************************************************
	tutsplus_register_block() - registers our block
*******************************************************/
function tutsplus_register_block() {
	
	$args = array(
		'name'				=>	'tutsplus_cta',
		'title'				=>	__( 'Call to Action', 'tutsplus' ),
		'description'		=>	__( 'A call to action box with a title, image, text and a link', 'tutsplus' ),
		'render_callback'	=>	'tutsplus_block_callback',
		'category'			=>	'formatting',
		'icon'				=>	'admin_links',
		'keywords'			=>	array( 'cat', 'call to action', 'link' )
	);
	
	acf_register_block_type( $args );
	
}
if( function_exists( 'acf_register_block_type' )) {
	add_action( 'acf/init', 'tutsplus_register_block' );
}
