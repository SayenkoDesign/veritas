<?php

/*
Testimonials
		
*/
	
section_testimonials();
function section_testimonials() {
    
    
    $loop = new WP_Query( array(
        'post_type' => 'testimonial',
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'posts_per_page' => -1,
    ) );
    
    $items = '';
    
    
    if ( $loop->have_posts() ) : 
        
        while ( $loop->have_posts() ) : $loop->the_post();
        
            $items .= _testimonial_item();	

        endwhile; 
                    
        
    endif;
    
    // Reset things, for good measure
    $loop = null;
    wp_reset_postdata();
    
    if( empty( $items ) ) {
        return false;
    }
    
     
    $args = array(
        'html5'   => '<section %s>',
        'context' => 'section',
        'attr' => array( 'id' => 'testimonials', 'class' => 'section testimonials' ),
    );
    
    _s_markup( $args );
    echo '<div class="flex">';
    echo _s_structural_wrap( 'open', false );
    
        print( '<div class="row">' );
        
        print( '<div class="column">' );
        
        $title = sprintf( '<h3>%s</h3>', __( 'Testimonials', '_s' ) );
        
        $subtitle = sprintf( '<h2>%s</h2>', __( 'Read what clients are saying...', '_s' ) );
        
        printf( '<header class="entry-header">%s%s</header>', $title, $subtitle );	
        
        printf( '<div class="slick-testimonials">%s</div>', $items );
        
        echo '</div>';
        
    echo _s_structural_wrap( 'close', false );
    echo '</div>';
    echo '</section>';
    
    _s_section_close();	
    
}


// Get individual testimonial
function _testimonial_item() {
    
    $quote_content = sprintf( '<div class="quote-content">%s</div>', apply_filters('the_content', get_the_content() ) );
    
    $quote_name = the_title( '<p class="quote-name">- ', '</p>', false );
    
    return sprintf( '<div class="testimonial">%s%s</div>', $quote_content, $quote_name );
}