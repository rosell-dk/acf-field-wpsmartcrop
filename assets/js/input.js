(function($){
	
	
	function initialize_field( $el ) {

/*
      var frame = new wp.media.view.MediaFrame.ImageDetails({
        title: 'Test',
        multiple: false,
        button: {
          text: 'bla'
        },
        attachment_id: 167
      });
      frame.open();
*/
/*
			var frame = wp.media.frames.frame = wp.media({
				title: 'Select Image',
				button: { text: 'Select' },
        multiple: false,
        library: {
            type: 'image',
        },
        frame: 'edit-attachments'
			});
      frame.open();
*/



/*
      var frame = new wp.media.view.Attachment({
        title: 'Test',
        multiple: false,
        button: {
          text: 'bla'
        },
        attachment_id: 167
      });
      frame.open();
*/
//wp.media.view.MediaFrame.ImageDetails

    function updateFocalCoords(top, left) {
      if (arguments.length == 0) {
        left = $el.find('.focal-left').val();
        top = $el.find('.focal-top').val();
      }
      left = parseFloat(left);
      top = parseFloat(top);

      $horizontal.css('top', top + '%');
      $el.find('.focal-top').val(top);

      $vertical.css('left', left + '%');
      $el.find('.focal-left').val(left);

      $coordsInfo.text('(' + Math.floor(left + 0.5) + '%, ' + Math.floor(top + 0.5) + '%)');
      window.setTimeout(function() {
        $coordsInfo.css('left', $vertical.position().left + 6 + 'px');
        $coordsInfo.css('top', $horizontal.position().top + 6 + 'px');
      }, 1);
    }

    function updateButtons() {
      var imageId = $el.find('.the-image-id').val();
      if (imageId == '') {
        $el.find('.no-image-selected').show();
        $el.find('.image-selected').hide();
        $el.find('.the-image-wrap').hide();
      }
      else {
        $el.find('.image-selected').show();
        $el.find('.no-image-selected').hide();
        $el.find('.the-image-wrap').show();
      }
    }

    $horizontal = $('<div></div>').addClass('horizontal');
    $vertical = $('<div></div>').addClass('vertical');
    $coordsInfo = $('<div></div>').addClass('focal-coords-info');

    $el.find('.the-image-wrap').append($horizontal).append($vertical).append($coordsInfo);

    updateFocalCoords();
    updateButtons();

    $(window).on('resize', function() {
      updateFocalCoords($el.find('.focal-top').val(), $el.find('.focal-left').val());
    });

		$el.find('.the-image').on('click', function(ev) {
      var left = Math.floor(ev.offsetX / $(this).width() * 1000) / 10;
      var top = Math.floor(ev.offsetY / $(this).height() * 1000) / 10;
      updateFocalCoords(top, left);
    });

		$el.find('.remove-image').on('click', function() {
		  // Update image
      $el.find('.the-image').attr('src', '');

      // Update image_id (hidden input)
      $el.find('.the-image-id').val('');

      updateButtons();
    });

		var frame;		
		$el.find('.add-image').on('click', function() {
			if ( frame ) {
				frame.open();
				return;
			}
			frame = wp.media.frames.frame = wp.media({
				title: 'Select Image',
				button: { text: 'Select' },
        multiple: false,
        library: {
          type: 'image',
        },
			});

			frame.on('select', function() {
        var attachment 	= frame.state().get('selection').first().toJSON();


        // Perhaps we can get the attachment meta data like this: ?
        // https://wordpress.stackexchange.com/questions/181000/get-attachment-image-info-in-js
        console.log(frame);
        console.log(frame.state());
        console.log(attachment);

			  // Update image
        $el.find('.the-image').attr('src', attachment.sizes['full'].url);

        // Update image_id (hidden input)
        $el.find('.the-image-id').val(attachment.id);

        updateFocalCoords(50, 50);
        updateButtons();
			});

			frame.open();
		});
	}
	
	
	if( typeof acf.add_action !== 'undefined' ) {
	
		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/
		
		acf.add_action('ready append', function( $el ){
			
			// search $el for fields of type 'wpsmartcrop'
			acf.get_fields({ type : 'wpsmartcrop'}, $el).each(function(){
				
				initialize_field( $(this) );
				
			});
			
		});
		
		
	} else {
		
		
		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM. 
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/
		
		$(document).on('acf/setup_fields', function(e, postbox){
			
			$(postbox).find('.field[data-field_type="wpsmartcrop"]').each(function(){
				
				initialize_field( $(this) );
				
			});
		
		});
	
	
	}


})(jQuery);
