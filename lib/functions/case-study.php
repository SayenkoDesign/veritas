<?php


function _s_case_study_template_redirect( $template ) {
    if ( is_tax( 'case_study_cat' ) ) {
		$template_found = locate_template( 'archive-case_study.php' );
        
        if( !empty( $template_found ) ) {
            $template = $template_found;
        }
    }
	return $template;
}
add_filter( 'template_include', '_s_case_study_template_redirect' );


function _case_study_item( $index = 0 ) {
    global $post;
    $more = sprintf( '<a href="%s" class="more">%s</a>', get_permalink(), get_svg( 'plus' ) );
    $thumbnail = get_the_post_thumbnail( get_the_ID(), 'case-study-thumbnail' );
    $title = the_title( '<h4>', '</h4>', false );
    
    $cats = _s_case_study_terms(); // do we want to remove this on the archives?
    
    // add single class to every third item
    $count = $index + 1;
    $class = ( $count % 3 == 0 ) ? ' single' : '' ;
    
    return sprintf( '<div class="item%s">%s<div>%s<div>%s%s</div></div></div>', 
                           $class, $thumbnail, $more, the_title( '<h2>', '</h2>', false ), $cats );
    
   
}



function _s_case_study_terms() {
 	
	$taxonomy     = 'case_study_cat';
	$orderby      = 'name'; 
	$show_count   = 0;      // 1 for yes, 0 for no
	$pad_counts   = 0;      // 1 for yes, 0 for no
	$hierarchical = 1;      // 1 for yes, 0 for no
	$title        = '';

	$args = array(
	  'echo'		 => FALSE,
	  'hide_empty'   => FALSE, 
	  'taxonomy'     => $taxonomy,
	  'orderby'      => $orderby,
	  'show_count'   => $show_count,
	  'pad_counts'   => $pad_counts,
	  'hierarchical' => $hierarchical,
	  'title_li'     => $title
	);
    
     
	return sprintf('<ul>%s</ul>', wp_list_categories( $args ) );
	
}



function _case_study_term_list() {
    
    global $post;
    
    $terms = get_the_terms( get_the_ID(), 'case_study_cat' );
                         
    if ( $terms && ! is_wp_error( $terms ) ) {
     
        $list = array();
     
        foreach ( $terms as $term ) {
            $list[] = $term->name;
        }
                             
        return join( ', ', $list );   
    }
}



