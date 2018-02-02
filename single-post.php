<?php

get_header(); ?>

<?php
section_hero();
function section_hero() {
	global $post;
    
    $background_image = get_the_post_thumbnail_url( get_the_ID(), 'hero' );
    
    $post_categories =  get_the_category_list( '' );
    
    $heading = sprintf( '<h1>%s</h1>', get_the_title() );
    $description = sprintf( '<p>%s</p>', _s_get_posted_on() );
    
    $post_author = _s_get_post_author( 120 );

 	
	$style = '';
  	$content = '';
    $photo_source = '';
	
	if( !empty( $background_image ) ) {
		$style = sprintf( 'background-image: url(%s);', $background_image );
        
        $photo_source = get_post_field( 'post_content', get_post_thumbnail_id( get_the_ID() ) );
          
        if( !empty( $photo_source ) ) {
            $photo_source = sprintf( '<div class="photo-source">%s</div>', $photo_source );
        }
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
	
	
	$out .= sprintf( '<div class="row"><div class="small-12 columns">%s%s%s%s%s</div></div>', $post_categories, $heading, $description, $post_author, $photo_source );
	
	$out .= _s_structural_wrap( 'close', false );
	$out .= '</div>';
	$out .= '</section>';
	
	echo $out;
		
}
?>

<div class="row">

    <div class="large-8 columns">
    
        <div id="primary" class="content-area">
        
            <main id="main" class="site-main" role="main">
                <?php
                 
                if ( have_posts() ) : ?>
        
                   <?php
                    while ( have_posts() ) :
        
                        the_post();
        
                        get_template_part( 'template-parts/content', 'post' );
        
                    endwhile;
                    
                    $previous = sprintf( '%s<span class="%s"></span>', 
                                         get_svg( 'arrow' ), __( 'Previous Post', '_s') );
                    
                    $next = sprintf( '%s<span class="%s"></span>', 
                                         get_svg( 'arrow' ), __( 'Next Post', '_s') );
                    
                    the_post_navigation( array( 'prev_text' => $previous, 'next_text' => $next ) );
                    
                else :
        
                    get_template_part( 'template-parts/content', 'none' );
        
                endif; ?>
        
            </main>
        
        </div>
    
    </div>
    
    <div class="large-4 columns">
    
        <?php get_sidebar(); ?>
    
    </div>	
   

</div>

<?php
get_footer();
