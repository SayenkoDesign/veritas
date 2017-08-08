<?php
/*
Template Name: About
*/

get_header(); ?>

<?php
// Hero
get_template_part( 'template-parts/section', 'hero' );
   

?>

 
 <div id="primary" class="content-area">

    <main id="main" class="site-main" role="main">
        <?php
        
        section_team();
        function section_team() {
            
            $prefix = 'team';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
             
            $attr = array( 'id' => 'team', 'class' => 'section team' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
    
                 printf( '<div class="entry-content">%s</div>', $editor );	
    
                 echo '</div>';
    
            _s_section_close();	   
        }
        
       
       
       
        section_people();
        function section_people() {
            
            $loop = new WP_Query( array(
                'post_type' => 'people',
                'order' => 'ASC',
                'orderby' => 'menu_order',
                'posts_per_page' => -1,
            ) );
            
            $items = '';
            
            if ( $loop->have_posts() ) : 
                                
                 while ( $loop->have_posts() ) : $loop->the_post();
                         
                     $items .= sprintf( '<div class="column">%s</div>',  _person_item() );	
                            
        
                endwhile; 
                
             endif;
            
            // Reset things, for good measure
            $loop = null;
            wp_reset_postdata();
            
            if( empty( $items ) ) {
                return false;
            }
            
            $attr = array( 'id' => 'people', 'class' => 'section people' );
            
            _s_section_open( $attr );
            
                print( '<div class="row small-up-1 large-up-3">' );
                
                echo $items;
                
                echo '</div>';
            
            _s_section_close();	
                
        }
       
        
        function _person_item() {
            global $post;
            
            $more = sprintf( '<a data-open="section-%s-reveal" class="more">%s</a>', get_the_ID(), get_svg( 'plus' ) );
            
            $vk = get_field( 'vk_url' );
             if( !empty( $vk ) ) {
                $vk = sprintf( '<a href="%s" class="vk">%s</a>', $vk, get_svg( 'vk' ) );
            }
            
            $position = get_field( 'position' );
            if( !empty( $position ) ) {
                $position = sprintf( '<p>%s</p>', $position );
            }
            
            $heading = sprintf( '<a data-open="section-%s-reveal"><h2>%s</h2>%s</a>', get_the_ID(), get_the_title(), $position);
            
            $photo = get_field( 'photo' );
            $photo = _s_get_acf_image( $photo );
            $image = sprintf( '<div class="photo">%s%s</div>', $photo, $vk );
            
            $thumbnail = get_the_post_thumbnail( get_the_ID(), 'medium' );
            
            
            $content = sprintf( '<div class="entry-content">%s</div>', apply_filters( 'pb_the_content', get_the_content() ) );
            
            $close = '<button class="close-button" data-close aria-label="Close" type="button"><span aria-hidden="true">&times;</span></button>';
            
            $title = sprintf( '<header>%s%s</header>', the_title( '<h4>', '</h4>', false ), $position );
            
            $reveal = sprintf( '<div id="section-%s-reveal" class="person reveal" data-reveal data-animation-in="hinge-in-from-middle-y fast" data-animation-out="hinge-out-from-middle-y fast">%s<article>%s%s%s</article></div>', get_the_ID(), $close, $image, $title, $content );
            
            return sprintf( '<div class="item"><div>%s</div>%s%s</div>%s%s', 
                           $more, $vk, $thumbnail, $heading, $reveal );	
        }
        
       
         
        section_philosophy();
        function section_philosophy() {
            
            $prefix = 'philosophy';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
             
            $attr = array( 'id' => 'philosophy', 'class' => 'section philosophy' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
    
                 printf( '<div class="entry-content">%s</div>', $editor );	
    
                 echo '</div>';
    
            _s_section_close();	   
        }
        
        
        
        section_why();
        function section_why() {
            
            $prefix = 'why';
            $prefix = set_field_prefix( $prefix );
                        
            $editor = get_field( sprintf( '%seditor', $prefix ) );
            
            if( empty( $editor ) ) {
                return false;
            }
            
            $photo  = get_field( sprintf( '%sphoto', $prefix ) );
            $image  = _s_get_acf_image( $photo, 'why-us' );
            
            $attr = array( 'id' => 'why-us', 'class' => 'section why-us' );
                    
            _s_section_open( $attr );
            
                print( '<div class="column row">' );
                
                echo $image;
    
                printf( '<div class="white-box"><div class="entry-content">%s</div></div>', $editor );	
    
                echo '</div>';
    
            _s_section_close();	   
        }
       
        ?>

    </main>

</div>
  
 
<?php
get_footer();
