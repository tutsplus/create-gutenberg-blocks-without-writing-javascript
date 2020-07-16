<?php
/*
Plugin Name:	Tutsplus Blocks without Javascript
Plugin URI:		https://tutsplus.com
Description:	Plugin to accompany tuts+ tutorial on creating Gutenberg blocks without Javascript.
Version:		5.3
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
function tutsplus_block_callback( $block, $content, $is_preview = false, $post_id=0 ){
	
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

	//HTML to output block
	?>
	<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $title ) ?>">
		
		<div class="cta-container">

			<img src="<?php echo esc_url( $image['url'] );?>" alt="<?php echo esc_attr( $image['alt'] );?>" />
			<h3 class="cta-title"><?php echo $title; ?></h3>
			<p class="cta-text"><a href="<?php echo $link; ?>"><?php echo $text; ?></a></p>
		
		</div>		
				
	</div>
	
	<style type="text/css">
			
			#<?php echo $id; ?> {
				background-color: <?php echo $background; ?>;
				color: <?php echo $color; ?>;
				padding: 0 0 0 2%;
				overflow: auto;
			}
			
			#<?php echo $id; ?> .cta-container h3,
			#<?php echo $id; ?> .cta-container a:link,
			#<?php echo $id; ?> .cta-container a:visited {
				color: <?php echo $color; ?>;
			}
			
			.cta-container {
				clear: none;
			}
			.cta-container img {
				float: right;
				max-width: 200px;
				clear: none;
				margin: 0 0 0 10px;
			}	
			.cta-container h3 {
				clear: none;
				margin-top: 0;
				padding-top: 0.4em;
			}	
			
		</style>

<?php }