<?php

/*
Plugin Name: Advanced Custom Fields: WP SmartCrop
Plugin URI: https://www.bitwise-it.dk/
Description: An ACF image field with cropping based on a focal point. - For responsive images
Version: 1.0.0
Author: Bjørn Rosell
Author URI: https://www.bitwise-it.dk/contact
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// https://wordpress.stackexchange.com/questions/108143/updating-custom-post-meta-with-ajax
// https://codex.wordpress.org/AJAX_in_Plugins
// https://codex.wordpress.org/Plugin_API/Action_Reference/wp_ajax_(action)
/*
add_action( 'wp_ajax_add_foobar', 'add_foobar' );
function add_foobar() {
//  echo 'Hello' . $_POST['data'];
  $image_id = 167;
  echo get_post_meta( $image_id, '_wpsmartcrop_image_focus', true )['left'];

  wp_die();
//	die( "Hello World" );
}*/

add_action( 'wp_enqueue_scripts', function() {
//  wp_enqueue_media();
//		wp_register_script( 'acf-test', "/wp-content/plugins/acf-field-wpsmartcrop/assets/js/test.js", array(), '9' );
//		wp_enqueue_script('acf-test');
});

add_action( 'admin_enqueue_scripts', function() {
/*
  wp_enqueue_media();
	wp_enqueue_script( 'media-grid' );
	wp_enqueue_script( 'media' );
	wp_localize_script( 'media-grid', '_wpMediaGridSettings', array(
		'adminUrl' => parse_url( self_admin_url(), PHP_URL_PATH ),
		'queryVars' => (object) $vars
	) );*/

//  wp_register_script( 'acf-test2', "/wp-content/plugins/acf-field-wpsmartcrop/assets/js/test.js", array('media-editor', 'media-grid', 'media-audiovideo', 'mce-view', 'media'), '8' );

//  wp_register_script( 'acf-test2', "/wp-content/plugins/acf-field-wpsmartcrop/assets/js/test.js", array(), '8' );
//	wp_enqueue_script('acf-test2');


// media-editorhandle:media-audiovideohandle:mce-viewhandle:image-edithandle:media-gridhandle:media
//	wp_enqueue_script('acf-test2');

});



// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_plugin_wpsmartcrop') ) :

class acf_plugin_wpsmartcrop {
	
	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
		
		// vars
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'		=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);
		
		
		// set text domain
		// https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
		load_plugin_textdomain( 'acf-wpsmartcrop', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' ); 
		
		
		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field_types')); // v5
		add_action('acf/register_fields', 		array($this, 'include_field_types')); // v4
		
	}
	
	
	/*
	*  include_field_types
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	n/a
	*/
	
	function include_field_types( $version = false ) {
		
		// support empty $version
		if( !$version ) $version = 4;
		
		
		// include
		include_once('fields/acf-wpsmartcrop-v' . $version . '.php');
		
	}
	
}


// initialize
new acf_plugin_wpsmartcrop();


// class_exists check
endif;
	
?>
