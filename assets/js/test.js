//alert('test');



jQuery(function($) {
/*
  jQuery.post(
      ajaxurl, 
      {
          'action': 'add_foobar',
          'data':   'super'
      }, 
      function(response){
          alert('The server responded: ' + response);
      }
  );*/

/*
	var frame = wp.media.frames.frame = wp.media({
		title: 'Select Image',
		button: { text: 'Select' },
    multiple: false,
    frame: 'image',
    metadata: {
      attachment_id: 167,
    }
	});

  frame.open();*/
/*
	var frame = wp.media.frames.frame = wp.media({
		title: 'Select Image',
		button: { text: 'Select' },
    multiple: false,
    library: {

      order: 'ASC',

			// [ 'name', 'author', 'date', 'title', 'modified', 'uploadedTo',
			// 'id', 'post__in', 'menuOrder' ]
			orderby: 'title',

			// mime type. e.g. 'image', 'image/jpeg'
			type: 'image',

			// Searches the attachment title.
			search: null,

			// Attached to a specific post (ID).
			uploadedTo: null
    },
    frame: 'select',
	});

  frame.open();
*/

// Fires after the frame markup has been built, but not appended to the DOM.
	// @see wp.media.view.Modal.attach()
/*
	frame.on( 'ready', function() {} );

	// Fires when the frame's $el is appended to its DOM container.
	// @see media.view.Modal.attach()
	frame.on( 'attach', function() {} );

	// Fires when the modal opens (becomes visible).
	// @see media.view.Modal.open()
	frame.on( 'open', function() {} );

	// Fires when the modal closes via the escape key.
	// @see media.view.Modal.close()
	frame.on( 'escape', function() {} );

	// Fires when the modal closes.
	// @see media.view.Modal.close()
	frame.on( 'close', function() {} );

	// Fires when a user has selected attachment(s) and clicked the select button.
	// @see media.view.MediaFrame.Post.mainInsertToolbar()
	frame.on( 'select', function() {
		var selectionCollection = frame.state().get('selection');
	} );

	// Fires when a state activates.
	frame.on( 'activate', function() {} );

	// Fires when a mode is deactivated on a region.
	frame.on( '{region}:deactivate', function() {} );
	// and a more specific event including the mode.
	frame.on( '{region}:deactivate:{mode}', function() {} );

	// Fires when a region is ready for its view to be created.
	frame.on( '{region}:create', function() {} );
	// and a more specific event including the mode.
	frame.on( '{region}:create:{mode}', function() {} );

	// Fires when a region is ready for its view to be rendered.
	frame.on( '{region}:render', function() {} );
	// and a more specific event including the mode.
	frame.on( '{region}:render:{mode}', function() {} );

	// Fires when a new mode is activated (after it has been rendered) on a region.
	frame.on( '{region}:activate', function() {} );
	// and a more specific event including the mode.
	frame.on( '{region}:activate:{mode}', function() {} );

	// Get an object representing the current state.
	frame.state();

	// Get an object representing the previous state.
	frame.lastState();
*/

/*
	var frame = wp.media.frames.frame = wp.media({
		title: 'Select Image',
		button: { text: 'Select' },
    multiple: false,
    frame: 'edit-attachments',
    controller: {
      gridRouter: {}
    }
	});*/
//console.log('frame:');
//console.log(frame);
//  frame.open();

//  frame.open();

/*
    library: {
        type: 'image',
    },

	if ( 'select' === attributes.frame && MediaFrame.Select ) {
		frame = new MediaFrame.Select( attributes );
	} else if ( 'post' === attributes.frame && MediaFrame.Post ) {
		frame = new MediaFrame.Post( attributes );
	} else if ( 'manage' === attributes.frame && MediaFrame.Manage ) {
		frame = new MediaFrame.Manage( attributes );
	} else if ( 'image' === attributes.frame && MediaFrame.ImageDetails ) {
		frame = new MediaFrame.ImageDetails( attributes );
	} else if ( 'audio' === attributes.frame && MediaFrame.AudioDetails ) {
		frame = new MediaFrame.AudioDetails( attributes );
	} else if ( 'video' === attributes.frame && MediaFrame.VideoDetails ) {
		frame = new MediaFrame.VideoDetails( attributes );
	} else if ( 'edit-attachments' === attributes.frame && MediaFrame.EditAttachments ) {
		frame = new MediaFrame.EditAttachments( attributes );
	}

bemærker jeg mangler wp.media.MediaFrame.Manage
*/


/*
  var frame = new wp.media.view.MediaFrame.Select({
    title: 'Test',
    multiple: false,
    button: {
      text: 'bla'
    }
  });
  frame.open();
*/
// ImageDetails. EditAttachments
/*
  var frame = new wp.media.view.MediaFrame.ImageDetails({
    title: 'Test',
    multiple: false,
    button: {
      text: 'bla'
    }
  });
  frame.open();
*/
//  wp.media.editor.open(167);

//  tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");

});


