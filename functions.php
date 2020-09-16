<?php
//Put this code into functions.php

wp_register_script('unique-load-more', get_template_directory_uri() . '/loadMore.js', array('jquery'), THEME_VERSION, true);
wp_enqueue_script('unique-load-more');


wp_localize_script( 'unique-load-more', 'unique_loadmore_params', array(
	'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
	'current_page' => get_query_var( 'paged' ) ? get_query_var('paged') : 1,
	'post_type' => get_query_var( 'post_type' )
));



function unique_loadmore_ajax_handler(){
	// prepare our arguments for the query
  $args = array();
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$args['post_status'] = 'publish';
  $args['post_type'] = ($_POST['post_type']);
	// it is always better to use WP_Query but not here
	query_posts( $args );

	if( have_posts() ) :
		// run the loop
		while( have_posts() ): the_post();
			get_template_part( 'loop' );
		endwhile;

	endif;
	die; // here we exit the script and even no wp_reset_query() required!
}


add_action('wp_ajax_loadmore', 'unique_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'unique_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
