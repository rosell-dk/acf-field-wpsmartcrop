<?php


// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;


// check if class already exists
if( !class_exists('acf_field_wpsmartcrop') ) :


class acf_field_wpsmartcrop extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct( $settings ) {
		
		$this->name = 'wpsmartcrop';
		$this->label = __('Image with focal point cropping (WP SmartCrop)', 'acf-wpsmartcrop');
		$this->category = 'content';
		
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
//			'font_size'	=> 14,
		);
		
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*  var message = acf._e('wpsmartcrop', 'error');
		*/
		
		$this->l10n = array(
			'error'	=> __('Error! Please enter a higher value', 'acf-wpsmartcrop'),
      'add_image' => __('Add image', 'acf-wpsmartcrop'),
		);
		
		
		/*
		*  settings (array) Store plugin settings (url, path, version) as a reference for later use with assets
		*/
		
		$this->settings = $settings;
		

    // Filters and actions
//		add_filter( 'wp_prepare_attachment_for_js' , array($this, 'wp_prepare_attachment_for_js'), 10, 3);
//		add_action( 'edit_attachment' , array( $this, 'edit_attachment'  ) );

		// do not delete!
    	parent::__construct();
    	
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/
		/*
		acf_render_field_setting( $field, array(
			'label'			=> __('Font Size','acf-wpsmartcrop'),
			'instructions'	=> __('Customise the input font size','acf-wpsmartcrop'),
			'type'			=> 'number',
			'name'			=> 'font_size',
			'prepend'		=> 'px',
		));*/

	}
	
	
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field (array) the $field being rendered
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field (array) the $field being edited
	*  @return	n/a
	*/
	
	function render_field( $field ) {
		

		// Merge defaults
		$field = array_merge($this->defaults, $field);
		
		// Get image id
		$image_id = (isset($field['value']['image_id'])) ? $field['value']['image_id'] : '';

		// Get focal left (in percentage)
		$focal_left = (isset($field['value']['focal_left'])) ? $field['value']['focal_left'] : '50';
		$focal_top = (isset($field['value']['focal_top'])) ? $field['value']['focal_top'] : '50';

    $src = '';
		if ($image_id) {			
			$src = wp_get_attachment_image_src($image_id, 'large')[0];
//      print_r($src);
		}

    // My answers on stackexchange:
		// https://wordpress.stackexchange.com/questions/270008/wp-media-edit-attachment-screen/278839#278839

    // My question on wpsmartcrop:
    // https://github.com/wpsmartcrop/wpsmartcrop/issues/4

//print_r(get_post_meta( $image_id, '_wpsmartcrop_image_focus', true ));
		
    echo '<div class="acf-wpsmartcrop">';

    echo '<div class="the-image-wrap"><img class="the-image" src="' . $src . '" /></div>';
		echo '<input class="the-image-id" type="hidden" name="' . esc_attr($field['name']) . '[image_id]" value="' . esc_attr($image_id) . '" />';
		echo '<input class="focal-left" type="hidden" name="' . esc_attr($field['name']) . '[focal_left]" value="' . esc_attr($focal_left) . '" />';
		echo '<input class="focal-top" type="hidden" name="' . esc_attr($field['name']) . '[focal_top]" value="' . esc_attr($focal_top) . '" />';

    echo '<div class="no-image-selected">';
    echo '<span>' . __('No image seleced','acf-wpsmartcrop') . '</span>';
    echo '<input type="button" class="button add-image" value="' . __('Select Image','acf-wpsmartcrop') . '" />';
    echo '</div>';
    echo '<div class="image-selected">';
    echo '<input type="button" class="button remove-image" value="' . __('Remove Image','acf-wpsmartcrop') . '" />';
    echo '<input type="button" class="button add-image" value="' . __('Change Image','acf-wpsmartcrop') . '" />';
    echo '</div>';

//    echo '<input type="button" class="change-focal-point" value="' . __('Change focal point','acf-wpsmartcrop') . '" />';

//    echo get_media_item(167);
// https://wordpress.stackexchange.com/questions/270008/wp-media-edit-attachment-screen
    echo '</div>';

		/*echo '<pre>';
		print_r( $field );
		echo '</pre>';*/
		
	}
	

  function edit_attachment() {
  }
  function wp_prepare_attachment_for_js($response, $attachment, $meta) {
//		$wpsmartcrop_enabled = get_post_meta( $attachment['ID'], '_wpsmartcrop_enabled', true );

//				$old_focus   = get_post_meta( $attachment_id, '_wpsmartcrop_image_focus', true );

//    $response['aa_wpsmartcrop_enabled'] = $wpsmartcrop_enabled;
    $response['aa_meta'] = $meta;
    $response['aa_attachment'] = $attachment;
    return $response;
  }
		
	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function input_admin_enqueue_scripts() {
		
		// vars
		$url = $this->settings['url'];
		$version = $this->settings['version'];
		
  	// script-loader.php says: "To enqueue media-views or media-editor, call wp_enqueue_media()"

    wp_enqueue_media();
		
		// register & include JS
		wp_register_script( 'acf-input-wpsmartcrop', "{$url}assets/js/input.js", array('acf-input'), $version );
		wp_enqueue_script('acf-input-wpsmartcrop');
		
		wp_register_script( 'acf-wp-smartcrop-crosshair', "{$url}assets/js/wp-smartcrop-crosshair.js", array('acf-input'), $version );
		wp_enqueue_script('acf-wp-smartcrop-crosshair');
		
		// register & include CSS
		wp_register_style( 'acf-input-wpsmartcrop', "{$url}assets/css/input.css", array('acf-input'), $version );
		wp_enqueue_style('acf-input-wpsmartcrop');

    // Include wpsmartcrop CSS
		wp_register_style( 'acf-wpsmartcrop', "{$url}assets/css/wp-smartcrop.css", array('acf-input', 'media-editor'), $version );
		wp_enqueue_style('acf-wpsmartcrop');

//		wp_enqueue_script('media-editor');

		
	}
	
	
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_head() {
	
		
		
	}
	
	*/
	
	
	/*
   	*  input_form_data()
   	*
   	*  This function is called once on the 'input' page between the head and footer
   	*  There are 2 situations where ACF did not load during the 'acf/input_admin_enqueue_scripts' and 
   	*  'acf/input_admin_head' actions because ACF did not know it was going to be used. These situations are
   	*  seen on comments / user edit forms on the front end. This function will always be called, and includes
   	*  $args that related to the current screen such as $args['post_id']
   	*
   	*  @type	function
   	*  @date	6/03/2014
   	*  @since	5.0.0
   	*
   	*  @param	$args (array)
   	*  @return	n/a
   	*/
   	
   	/*
   	
   	function input_form_data( $args ) {
	   	
		
	
   	}
   	
   	*/
	
	
	/*
	*  input_admin_footer()
	*
	*  This action is called in the admin_footer action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*
	*  @type	action (admin_footer)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
		
	function input_admin_footer() {
	
		
		
	}
	
	*/
	
	
	/*
	*  field_group_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is edited.
	*  Use this action to add CSS + JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_enqueue_scripts)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_enqueue_scripts() {
		
	}
	
	*/

	
	/*
	*  field_group_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is edited.
	*  Use this action to add CSS and JavaScript to assist your render_field_options() action.
	*
	*  @type	action (admin_head)
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	n/a
	*  @return	n/a
	*/

	/*
	
	function field_group_admin_head() {
	
	}
	
	*/


	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	/*
	
	function load_value( $value, $post_id, $field ) {
		
		return $value;
		
	}
	
	*/
	
	
	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	
	
	function update_value( $value, $post_id, $field ) {
//    throw new Exception(print_r($value));
    if (isset($value['image_id'])) {
      $image_id = $value['image_id'];
      update_post_meta( 
        $image_id, 
        '_wpsmartcrop_image_focus', 
        array(
          'left' => $value['focal_left'],
          'top' => $value['focal_top']
        )
      );
      update_post_meta( 
        $image_id, 
        '_wpsmartcrop_enabled', 
        TRUE
      );

      // Regenerate thumbnails

		  $fullsizepath = get_attached_file( $image_id );
		  if ( false === $fullsizepath || ! file_exists( $fullsizepath ) ) {
        // original image missing
        return;
      }

		  @set_time_limit( 900 ); // 5 minutes per image should be PLENTY
		  $metadata = wp_generate_attachment_metadata( $image_id, $fullsizepath );
		  if ( is_wp_error( $metadata ) ) {
			  // $metadata->get_error_message();
        return;
      }
		  if ( empty( $metadata ) ) {
			  // Unknown failure reason...
        return;
      }
		  wp_update_attachment_metadata( $image_id, $metadata );

    }



		return $value;
	}
	
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
		
	/*
	
	function format_value( $value, $post_id, $field ) {
		
		// bail early if no value
		if( empty($value) ) {
		
			return $value;
			
		}
		
		
		// apply setting
		if( $field['font_size'] > 12 ) { 
			
			// format the value
			// $value = 'something';
		
		}
		
		
		// return
		return $value;
	}
	
	*/
	
	
	/*
	*  validate_value()
	*
	*  This filter is used to perform validation on the value prior to saving.
	*  All values are validated regardless of the field's required setting. This allows you to validate and return
	*  messages to the user if the value is not correct
	*
	*  @type	filter
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$valid (boolean) validation status based on the value and the field's required setting
	*  @param	$value (mixed) the $_POST value
	*  @param	$field (array) the field array holding all the field options
	*  @param	$input (string) the corresponding input name for $_POST value
	*  @return	$valid
	*/
	
	/*
	
	function validate_value( $valid, $value, $field, $input ){
		
		// Basic usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = false;
		}
		
		
		// Advanced usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = __('The value is too little!','acf-wpsmartcrop'),
		}
		
		
		// return
		return $valid;
		
	}
	
	*/
	
	
	/*
	*  delete_value()
	*
	*  This action is fired after a value has been deleted from the db.
	*  Please note that saving a blank value is treated as an update, not a delete
	*
	*  @type	action
	*  @date	6/03/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (mixed) the $post_id from which the value was deleted
	*  @param	$key (string) the $meta_key which the value was deleted
	*  @return	n/a
	*/
	
	/*
	
	function delete_value( $post_id, $key ) {
		
		
		
	}
	
	*/
	
	
	/*
	*  load_field()
	*
	*  This filter is applied to the $field after it is loaded from the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0	
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function load_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  update_field()
	*
	*  This filter is applied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @date	23/01/2013
	*  @since	3.6.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	$field
	*/
	
	/*
	
	function update_field( $field ) {
		
		return $field;
		
	}	
	
	*/
	
	
	/*
	*  delete_field()
	*
	*  This action is fired after a field is deleted from the database
	*
	*  @type	action
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$field (array) the field array holding all the field options
	*  @return	n/a
	*/
	
	/*
	
	function delete_field( $field ) {
		
		
		
	}	
	
	*/
	
	
}


// initialize
new acf_field_wpsmartcrop( $this->settings );


// class_exists check
endif;





?>
