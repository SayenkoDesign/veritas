<?php
/*
Template Name: Contact
*/

get_header(); ?>

<?php
// Hero
get_template_part( 'template-parts/section', 'hero' );
?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
	<?php
    function contact_details() {
        // lib/functions/theme.php
        $footer = get_field( 'footer', 'option' );
        $out = sprintf( '<h3>%s</h3>%s', __( 'Veritas Legal Services', '_s' ), $footer );
        $phone_number = get_field( 'phone_number', 'option' );
        if( !empty( $phone_number ) ) {
            $out .= sprintf( '<p><a href="tel:%1$s" class="phone-number">%1$s</a></p>', $phone_number );
        }
       
        return sprintf( '<div class="contact-details">%s</div>', $out );
    }
    
    function contact_map() {
       $map = get_field( 'map' );
       if( !empty( $map ) ) {
           return sprintf( '<div class="contact-map">%s</div>', $map );
       }
        
    }
    
    
 	// Default
	section_default();
	function section_default() {
				
		global $post;
		
		$attr = array( 'class' => 'section default' );
		
		_s_section_open( $attr );		
		
		print( '<div class="row">' );
		
			echo '<div class="small-12 large-4 columns">';
			
            printf( '<div class="show-for-large">%s</div>', contact_details() );
            
            printf( '<div class="show-for-large">%s</div>', contact_map() );
            
            echo '</div>';   
			
			echo '<div class="small-12 large-7 columns">';
			while ( have_posts() ) :
	
				the_post();
                
                echo '<div class="entry-content">';
				
				the_content();
                
                echo '</div>';
                
                printf( '<div class="hide-for-large">%s</div>', contact_details() );
            
                printf( '<div class="hide-for-large">%s</div>', contact_map() );
					
			endwhile;
			echo '</div>';
		
		print( '</div>' );
		_s_section_close();	
	}
	?>
	</main>


</div>

<?php
get_footer();
