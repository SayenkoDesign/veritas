<?php

function _s_blog_template_redirect( $template ) {
	if ( is_author() || is_search() ) 
		$template = get_query_template( 'home' );	
	return $template;
}
add_filter( 'template_include', '_s_blog_template_redirect' );	


function _s_add_blog_class( $classes ) {
  
  if ( is_category() || is_author() || is_search() ) {
      $classes[] = 'blog';
  }
   return $classes;
}
add_filter( 'body_class', '_s_add_blog_class' );


// Posts

function _s_get_post_author( $size = 80 ) {
    
    $author_id = get_the_author_meta('ID');
    $display_name = get_the_author_meta('display_name');
    $author_image = '';
    if( $avatar = get_avatar( $author_id, $size ) ) {
         $author_url = get_author_posts_url( $author_id ); 
         return sprintf( '<div class="post-author"><a href="%s">%s<p>%s</p></a></div>',$author_url, $avatar, $display_name );
    }
    
    return '';
        
}



function footer_logo() {
	$footer_logo = get_svg( 'logo-mark' );
	$site_url = home_url();
	return sprintf('<div class="footer-logo"><a href="%s" title="%s">%s</a></div>', $site_url, get_bloginfo( 'name' ), $footer_logo );	
}

function footer_social_icons() {
	
	$social_profiles = array( 
						'vk' => 'https://www.vk.com',
						'facebook' => 'https://www.facebook.com'
					);
	
	return _s_get_social_icons( $social_profiles );
}

 
function footer_contact_details() {
	
	$company = get_field( 'footer', 'options' );	
	$copyright = sprintf( '&copy; %s Veritas.  %s.', date( 'Y' ), __( 'All rights reserved', '_s' ) );
	$website = sprintf( '<a href="%1$s">%2$s</a> by <a href="%1$s">Sayenko Design</a>', 'https://www.sayenkodesign.com', __( 'Seattle Web Design', '_s' ) );
	
	return sprintf( '<div class="contact-details">%s<p>%s<br />%s</p></div>', $company, $copyright, $website );
	
}


/**
 * Custom Body Class
 *
 * Add additional body classes to pages for targeting.
 *
 * @param array $classes
 * @return array
 */
function _s_add_custom_body_class( $classes ) {
	
	$body_class = '';
	
 	if( wp_is_mobile() ) {
		$body_class = 'mobile';
	}
	
	
	
	// If exists add body class
	if( !empty( $body_class ) ) {
		$classes[] = $body_class;
	}
	
	return $classes;
}
add_filter( 'body_class', '_s_add_custom_body_class' );