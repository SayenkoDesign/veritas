<?php

function _s_get_resources( $ids ) {
	
    // pull curated list or default to recent posts
	
	$args = array(
		'post_type'      => 'post',
 		'post_status'    => 'publish',
		'order'          => 'ASC',
	);
    
    if( empty( $ids ) ) {
        $args['posts_per_page'] = 6;
    }
    else {
       $args['post__in'] = $ids;
	   $args['orderby'] = 'post__in'; 
    }
	
 	$columns =  '';

	// Use $loop, a custom variable we made up, so it doesn't overwrite anything
	$loop = new WP_Query( $args );

	// have_posts() is a wrapper function for $wp_query->have_posts(). Since we
	// don't want to use $wp_query, use our custom variable instead.
	if ( $loop->have_posts() ) : 
	
 		while ( $loop->have_posts() ) : $loop->the_post(); 
			
			$columns .= _s_get_resource_post();
		
		endwhile;
		
	else:
		return false;
	endif;

	wp_reset_postdata();
	
	return sprintf( '<div class="expanded row small-up-1 xxlarge-up-2 collapse grid" data-equalizer data-equalize-on="small">%s</div>', $columns );
	
}

// Get a single post
function _s_get_resource_post() {
    
    $photo = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    if( !empty( $photo ) ) {
        $photo = sprintf( 'style="background-image: url(%s);"', $photo );
    }
    
    $post_categories =  get_the_category_list( '' );
    $title = sprintf( '<h2><a href="%s">%s</a></h2>', get_permalink(), get_the_title() );
    $excerpt = sprintf( '<div class="excerpt">%s</div>', _s_get_the_excerpt( '', '', 20 ) );
    $more = sprintf( '<a href="%s" class="more">%s</a>', get_permalink(), get_svg( 'plus' ) ); 
    
    return sprintf( '<div class="column" data-equalizer-watch><div class="background" %s></div><div class="item"><div class="details">%s%s%s%s</div></div></div>', $photo, $post_categories, $title, $excerpt, $more );
}