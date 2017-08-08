<?php


/**
 * CTA Button
 * Create a formatted anchor for an ACF button
 * If using clone field check for prefix
 * @param array  $btn_args
 * @param array  $attr
 * @param string $prefix
 * @return string anchor
 */
function pb_get_cta_button( $btn_args = array(), $attr = array(), $prefix = '' ) {
	
	$prefix = set_field_prefix( $prefix );
	
	$button_text = $btn_args[ $prefix . 'text' ];
	$button_link = $btn_args[ $prefix . 'link' ];
	$choose_page = $btn_args[ $prefix . 'page' ];
	$url         = $btn_args[ $prefix . 'url' ];
	$link_target = $btn_args[ $prefix . 'target' ];
	$target = '';
	
	// Link type
	if ( $button_link == 'Page' ) {
		if ( ! empty( $choose_page ) ) {
			$link = sprintf( 'href="%s"', $choose_page );
		}
		
	} elseif ( $button_link == 'Absolute URL' ) {
		if ( ! empty( $url ) ) {
			$link = sprintf( 'href="%s"', $url );
		}
		// Link target
		if ( $link_target == 'New Tab' ) {
			$target = ' target="_blank"';
		}
	} else {
		$link   = '';
		$target = sprintf( 'data-open="%s"', 'contact' );
	}
	
	if ( empty( $button_text ) && empty( $link ) ) {
		return false;
	}
	
    	
	if ( ! empty( $attr ) ) {
		$attr = _s_attr( '', $attr );
	}
	
	return sprintf( '<a %s %s %s><span>%s</span></a>', $attr, $link, $target, $button_text );
}


function pb_get_cta_link( $button, $class = "link"  ) {
	
	$button_text =  $button['button_text'];
	$button_link =  $button['button_link'];
	$choose_page =  $button['choose_page'];
	$url 		 =  $button['url'];
	$link_target =  $button['link_target'];
	
	$link = '';
		   
	if ( $button_link == 'Page' ) { 
		$link = $choose_page;
	} elseif ( $button_link == 'Absolute URL' ) {
		$link = $url;
	} 

	if ( $button_link == 'Absolute URL' && $link_target == 'New Tab') {
		$target= ' target="_blank"';
	} else {
		$target = '';
	};
	
	if( empty( $button_text ) && empty( $link ) ) {
		return false;	
	}

	return sprintf('<a class="%s" href="%s" %s><span>%s</span></a>', $class, $link, $target, $button_text );
}