<?php
/*
Template Name: Services
*/

get_header(); ?>

<?php
// Hero
get_template_part( 'template-parts/section', 'hero' );
   
sub_page_menu();
function sub_page_menu() {
    
    global $post;
    
    /*
    we need to find the top level page ID
    */
    
    if ($post->post_parent)	{
        $ancestors=get_post_ancestors($post->ID);
        $root=count($ancestors)-1;
        $parent = $ancestors[$root];
    } else {
        $parent = $post->ID;
    }

    
    $pages = wp_list_pages( array( 'title_li' => '', 'child_of' => $parent, 'echo' => false ) );
    
        
    if( empty( $pages ) )
        return false;
        
    $pages = sprintf( '<ul>%s</ul>', $pages );
    
    $args = array(
        'html5'   => '<nav %s>',
        'context' => 'nav',
        'attr' => array( 'id' => 'nav-sub-menu', 'class' => 'nav-sub-menu' ),
        'echo' => false
    );
    
    $out = _s_markup( $args );
    
    $out .= '<div class="row small-collapse medium-uncollapse"><div class="small-12 columns">';
    
    $out .= sprintf( '<div class="hide-for-medium"><button class="button terms" type="button" data-toggle="terms-dropdown"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20">
<path fill="#fff" d="M17 7v-2h-14v2h14zM17 11v-2h-14v2h14zM17 15v-2h-14v2h14z"></path>
</svg> <span class="screen-reader-text">%s</span></button><div class="dropdown-pane terms" id="terms-dropdown" data-toggler=".expanded">%s</div></div>', __( 'Menu', '_s' ), $pages );
    
    $out .= sprintf( '<div class="show-for-medium">%s</div>', $pages );
           
    $out .= '</nav>';
    
    $out .= '</div>';
    
    echo $out;
 }
?>

 
 <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">
        <?php
        
        section_intro();
        function section_intro() {
           
            $prefix = 'intro';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
            
            $photo  = get_field( sprintf( '%sphoto', $prefix ) );
            $image  = _s_get_acf_image( $photo, 'large' );
            
            $button = get_field( sprintf( '%sbutton', $prefix ) );
              
            if( !empty( $button ) ) {
                $button = sprintf( '<p>%s</p>', pb_get_cta_button( $button, array( 'class' => 'btn-primary' ) ) );
            }
            
            $attr = array( 'id' => 'intro', 'class' => 'section intro' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row clear">' );
                
                echo $image;
    
                printf( '<div class="entry-content">%s%s</div>', $editor, $button );	
    
                echo '</div>';
    
            _s_section_close();	   
        }
        
        
        
        section_resources();
        function section_resources() {
            
            $prefix = 'resources';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            
            $attr = array( 'class' => 'section resources' );
            _s_section_open( $attr );
            
            $ids = get_field( 'resource_posts' );
            
            $resource_posts = _s_get_resources( $ids );
            
            printf( '<div class="column row"><div class="entry-content">%s</div></div>', $editor );	
            
            echo $resource_posts;
            
            _s_section_close();
            
            
        }
       
       
        section_pricing();
        function section_pricing() {
            
            $prefix = 'pricing';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
            
            $button = get_field( sprintf( '%sbutton', $prefix ) );
              
            if( !empty( $button ) ) {
                $button = sprintf( '<p>%s</p>', pb_get_cta_button( $button, array( 'class' => 'btn-primary' ) ) );
            }
             
            $attr = array( 'id' => 'pricing', 'class' => 'section pricing' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
    
                 printf( '<div class="entry-content">%s%s</div>', $editor, $button );	
    
                 echo '</div>';
    
            _s_section_close();	   
        }
        
       
        // Case Studies
	    get_template_part( 'template-parts/section', 'case-studies' );
        
        
        // FAQ
        section_faq();
        function section_faq() {
                    
            global $post;
        
            $prefix = 'faq';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
                        
            // Create accordion
            $accordion = '';
            $accordion_content = array();
            
            $args = array(
                'post_type'      => 'faq',
                'post_status'    => 'publish',
                'order'          => 'ASC',
                'orderby'        => 'menu_order',
                'posts_per_page' => -1
            );
           
            // Use $loop, a custom variable we made up, so it doesn't overwrite anything
            $loop = new WP_Query( $args );
        
            // have_posts() is a wrapper function for $wp_query->have_posts(). Since we
            // don't want to use $wp_query, use our custom variable instead.
            if ( $loop->have_posts() ) : 
            
                while ( $loop->have_posts() ) : $loop->the_post(); 
                    
                    $accordion_content[] = _s_get_accordion_content( $loop->current_post );
                
                endwhile;
                
             endif;
        
            wp_reset_postdata();
            
            if( !empty( $accordion_content ) ) {
                
                // lets split into two columns
                $columns = c2c_array_partition( $accordion_content, 2 );
                
                foreach( $columns as $column ) {
                     $accordion .= sprintf( '<div class="column"><ul class="accordion" data-accordion="faq" data-allow-all-closed="true">%s</ul></div>', implode( '', $column ) );
                }
                
                
            }
            
            
            $attr = array( 'class' => 'section faq' );
            _s_section_open( $attr );
            
                printf( '<div class="column row"><div class="entry-content">%s</div></div>', $editor );
                
                printf( '<div class="row small-up-1 large-up-2">%s</div>',  $accordion );
                  
            _s_section_close();	
        }
        
        function _s_get_accordion_content( $index = 0 ) {
            //$is_active = 0 == $index ? ' is-active' : '';
            $is_active = '';
            $accordion_title = sprintf( '<a href="#" class="accordion-title"><h4>%s</h4></a>', get_the_title() );
            $accordion_content = apply_filters( 'the_content', get_the_content() );
            return sprintf( '<li class="accordion-item%s" data-accordion-item>%s
            <div class="accordion-content" data-tab-content>%s</div></li>', $is_active, $accordion_title, $accordion_content );
        }
            
           
	  
	    // Testimonials
		get_template_part( 'template-parts/section', 'testimonials' );
       
        
       
        ?>

    </main>

</div>
  
 
<?php
get_footer();
