
(function( $ ) {
    'use strict';


    $(function(){

         // Let's set up some variables for the image upload and removing the image     
         var frame,
             imgUploadButton = $( '#upload_login_logo_button' ),    
             imgContainer = $( '#upload_logo_preview' ),
             imgIdInput = $( '#login_logo_id' ),
             imgPreview = $('#upload_logo_preview'),        
             imgDelButton = $('#freehand_cbf-delete_logo_button'),
             // Color Pickers Inputs
             colorPickerInputs = $( '.freehand-cbf-color-picker' );

         // WordPress specific plugins - color picker and image upload
         $( '.freehand-cbf-color-picker' ).wpColorPicker();

        // wp.media add Image
         imgUploadButton.on( 'click', function( event ){

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( frame ) {
              frame.open();
              return;
            }

            // Create a new media frame
            frame = wp.media({
              title: 'Select or Upload Media for your Login Logo',
              button: {
                text: 'Use as my Login page Logo'
              },
              multiple: false  // Set to true to allow multiple files to be selected
            });
            // When an image is selected in the media frame...
            frame.on( 'select', function() {

              // Get media attachment details from the frame state
              var attachment = frame.state().get('selection').first().toJSON();                

              // Send the attachment URL to our custom image input field.
              imgPreview.find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

              // Send the attachment id to our hidden input
              imgIdInput.val( attachment.id );

              // Unhide the remove image link
              imgPreview.removeClass( 'hidden' );
            });

            // Finally, open the modal on click
            frame.open();
        });

        // Erase image url and age preview
        imgDelButton.on('click', function(e){
            e.preventDefault();
            imgIdInput.val('');
            imgPreview.find( 'img' ).attr( 'src', '' );
            imgPreview.addClass('hidden');
        });

    }); // End of DOM Ready

})( jQuery );

