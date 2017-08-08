<?php

/**
*  Creates ACF Options Page(s)
*/


if( function_exists('acf_add_options_sub_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme Settings',
		'menu_title' 	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-settings',
		'capability' 	=> 'edit_posts',
 		'redirect' 	=> false
	));
    
 	 acf_add_options_page(array(
		'page_title' 	=> 'Error 404 Page Settings',
		'menu_title' 	=> 'Error 404 Page Settings',
        'menu_slug' 	=> 'theme-settings-404',
        'parent' 		=> 'theme-settings',
		'capability' => 'edit_posts',
 		'redirect' 	=> false
	));
 
    /*
	 acf_add_options_sub_page(array(
		'title'      => 'Case Study Settings',
		'parent'     => 'edit.php?post_type=case_study',
        'menu_slug' 	=> 'case-study-settings',
		'capability' => 'edit_posts'
	));
    */

}


/**
 * Hide Advanced Custom Fields to Users
 */
//add_filter('acf/settings/show_admin', 'remove_acf_menu');
function remove_acf_menu( $show ){
    // provide a list of usernames who can edit custom field definitions here
    $admins = array( 'admin', 'kyle' );

    // get the current user
    $current_user = wp_get_current_user();

	return in_array( $current_user->user_login, $admins );
}


function _s_get_acf_image( $attachment_id, $size = 'large', $background = FALSE ) {

	if( ! absint( $attachment_id ) )
		return FALSE;

	if( wp_is_mobile() ) {
 		$size = 'large';
	}

	if( $background ) {
		$background = wp_get_attachment_image_src( $attachment_id, $size );
		return $background[0];
	}

	return wp_get_attachment_image( $attachment_id, $size );

}


function _s_get_acf_oembed( $iframe ) {


	// use preg_match to find iframe src
	preg_match('/src="(.+?)"/', $iframe, $matches);
	$src = $matches[1];


	// add extra params to iframe src
	$params = array(
		'controls'    => 1,
		'hd'        => 1,
		'autohide'    => 1,
		'rel' => 0
	);

	$new_src = add_query_arg($params, $src);

	$iframe = str_replace($src, $new_src, $iframe);


	// add extra attributes to iframe html
	$attributes = 'frameborder="0"';

	$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

	$iframe = sprintf( '<div class="embed-container">%s</div>', $iframe );


	// echo $iframe
	return $iframe;
}
