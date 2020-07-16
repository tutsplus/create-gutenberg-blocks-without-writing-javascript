<?php
/*
Plugin Name:	Tutsplus Blocks without Javascript
Plugin URI:		https://tutsplus.com
Description:	Plugin to accompany tuts+ tutorial on creating Gutenberg blocks without Javascript.
Version:		5.1
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
		'keywords'			=>	array( 'cat', 'call to action', 'link' ),
		'enqueue_style'		=>	get_template_directory_uri() . '/template-parts/blocks/cta/cta.css'
	);
	
	acf_register_block_type( $args );
	
}
if( function_exists( 'acf_register_block_type' )) {
	add_action( 'acf/init', 'tutsplus_register_block' );
}

/*******************************************************
	tutsplus_block_callback() - callback function
*******************************************************/
function tutsplus_block_callback( $block, $content, $post_id=0 ){
	
	//create id
	$id='cta-' . $block['id'];
	if( !empty( $block['anchor']) ) {
		$id = $block['anchor'];
	}
	
	//create class attribute
	$className = 'cta';
	if( !empty( $block['className']) ) {
		$className .= ' ' . $block['className'];
	}
	if( !empty( $block['align']) ) {
		$className .= ' align' . $block['align'];
	}
	
	// load values and defaults
	$title		=	get_field( 'cta_title' ) ?: 'Title. ';
	$text		=	get_field( 'cta_body_text' ) ?: 'More information. ';
	$link		=	get_field( 'cta_link' ) ?: '#';
	$background	=	get_field( 'cta_background_color' ) ?: '#000000';
	$color		=	get_field( 'cta_text_color' ) ?: '#FFFFFF';
	$image		=	get_field( 'cta_image' );

}
