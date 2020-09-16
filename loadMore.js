//This code can be placed in your main scripts file, but ideally it's only loaded where it's needed. So, this should be enquied on the archive/template that utilizes laod more buttons. 
(function( root, $, undefined ) {
	"use strict";

	$(function () {
    //Make sure the .class below matches your load more button's class
    $(document).on('click', '.load-more-posts', function() {
      let button = $(this),
      data = {
        action: "loadmore",
        query: unique_loadmore_params.posts, // that's how we get params from wp_localize_script() function
        page: unique_loadmore_params.current_page,
        post_type : unique_loadmore_params.post_type
      };
      $.ajax({
        url : unique_loadmore_params.ajaxurl, // AJAX handler
        data : data,
        type : 'POST',
        beforeSend : function ( xhr ) {
          // change the button text, you can also add a spinner animation here
          button.text('Loading...');
        },
        success : function( data ){
          if( data ) {
            //change the button back whatever was there originally (or something new)
            button.text( 'Load More' );
            //Change the #id below to the id of the imediate parent container for your posts.
            $('#posts-container').append(data); // insert new posts
            unique_loadmore_params.current_page++;

          } else {
            // if no data, remove the button
            button.remove();
          }
        }
      });
    });

  })
})
