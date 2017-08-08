<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

<?php
section_hero();
function section_hero() {
    global $post;
    
    $prefix = 'hero';
    $prefix = set_field_prefix( $prefix );

    $heading 		= get_field( sprintf( '%stitle', $prefix ) );
    $description	= get_field( sprintf( '%sdescription', $prefix ) );
    
    $background_image = get_post_meta( get_the_ID(), sprintf( '%sbackground_image', $prefix ), true );
    
    $style = '';
    $buttons = get_field( 'hero_buttons' );
    $content = '';
    $photo_source = '';
    
    if( !empty( $background_image ) ) {
        $attachment_id = $background_image;
        $size = 'hero';
        $background = wp_get_attachment_image_src( $attachment_id, $size );
        $style = sprintf( 'background-image: url(%s);', $background[0] );
        
        $photo_source = get_post_field( 'post_content', $attachment_id );
          
        if( !empty( $photo_source ) ) {
            $photo_source = sprintf( '<div class="photo-source">%s</div>', $photo_source );
        }
        
    }
    
            
    if( !empty( $heading ) ) {
        $content .= sprintf( '<h1>%s</h1>', $heading );
    }
    
    if( !empty( $description ) ) {
        $description = _s_wrap_text( $description, "\n" );
        $content .= sprintf( '<p>%s</p>', $description );
    }
    
    // CTA
    if( !empty( $buttons ) ) {
        $content .= '<ul>';
        foreach( $buttons as $button ) {
            $button = pb_get_cta_button( $button, '', 'button' );
            $content .= sprintf( '<li>%s</li>', $button );
        }
        $content .= '</ul>';
    }

    $args = array(
        'html5'   => '<section %s>',
        'context' => 'section',
        'attr' => array( 'id' => 'hero', 'class' => 'section hero', 'style' => $style ),
        'echo' => false
    );
    
    $out = _s_markup( $args );
    $out .= '<div class="flex">';
    $out .= _s_structural_wrap( 'open', false );
    
    
    $out .= sprintf( '<div class="row"><div class="small-12 columns">%s%s</div></div>', $content, $photo_source );
    
    $out .= _s_structural_wrap( 'close', false );
    $out .= '</div>';
    $out .= '</section>';
    
    echo $out;
        
}
?>
<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
  		
        <?php
        section_services();
        function section_services() {
            
            $prefix = 'services';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
            
            $photo  = get_field( sprintf( '%sphoto', $prefix ) );
            $image  = _s_get_acf_image( $photo );
            
            $list = _kr_get_list_items( array( 'prefix' => $prefix ) );
            
            if( !empty( $list ) ) {
                $list = sprintf( '<ul>%s</ul>', $list );
            }
            
            $attr = array( 'id' => 'services', 'class' => 'section services' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
    
                 printf( '<div class="entry-content first">%s</div>', $editor );	
    
                printf( '<div class="entry-content last">%s<div>%s</div></div>', $image, $list );
                
                echo '</div>';
    
            _s_section_close();	   
        }



        section_why_us();
        function section_why_us() {
            
            $prefix = 'why';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
            
            $photo  = get_field( sprintf( '%sphoto', $prefix ) );
            $image  = _s_get_acf_image( $photo, 'why-us' );
            
            $list = _kr_get_list_items( array( 'prefix' => $prefix, 'title_tag' => 'h4' ) );
            
            if( !empty( $list ) ) {
                $list = sprintf( '<ul>%s</ul>', $list );
            }
            
            $attr = array( 'id' => 'why-us', 'class' => 'section why-us' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
                
                echo $image;
    
                printf( '<div class="white-box"><div class="entry-content">%s%s</div></div>', $editor, $list );	
    
                echo '</div>';
    
            _s_section_close();	   
        }


        section_special_offer();
        function section_special_offer() {
            
            $show_on_page = get_field( 'show_on_page' );
            
             if( ! $show_on_page ) {
                return;   
            }
            
            $prefix = 'offer';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
            
            $photo  = get_field( sprintf( '%sphoto', $prefix ) );
            $image  = _s_get_acf_image( $photo, 'special-offer' );
            
            $button = get_field( sprintf( '%sbutton', $prefix ) );
              
            if( !empty( $button ) ) {
                $button = sprintf( '<p>%s</p>', pb_get_cta_button( $button, array( 'class' => 'btn-primary' ) ) );
            }
            
            $attr = array( 'id' => 'special-offer', 'class' => 'section special-offer' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
                
                echo $image;
    
                printf( '<div class="white-box"><div class="entry-content">%s%s</div></div>', $editor, $button );	
    
                echo '</div>';
    
            _s_section_close();	   
        }
 
		// Case Studies
		get_template_part( 'template-parts/section', 'case-studies' );
	  
	  
	    // Testimonials
		get_template_part( 'template-parts/section', 'testimonials' );
		
		?>
		
	</main>
</div>
<?php
get_footer();
