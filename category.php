<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); ?>

<?php
// Hero
section_hero();
function section_hero() {
    global $post;
    
    $post_id = get_option('page_for_posts');
    
    $prefix = 'hero';
    $prefix = set_field_prefix( $prefix );
    
    $heading = single_cat_title( '', '' );
     
    $description = category_description();
    
    $background_image	= get_field( sprintf( '%sbackground_image', $prefix ), $post_id );

    $style = '';
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
                                         get_svg( 'arrow-circle' ), __( 'Previous Post', '_s') );
                    
                    $next = sprintf( '%s<span class="%s"></span>', 
                                         get_svg( 'arrow-circle' ), __( 'Next Post', '_s') );
                    
                    the_posts_navigation( array( 'prev_text' => $previous, 'next_text' => $next ) );
                    
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
