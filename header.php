<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo THEME_FAVICONS;?>/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_FAVICONS;?>/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_FAVICONS;?>/favicon-16x16.png">
<link rel="manifest" href="<?php echo THEME_FAVICONS;?>/manifest.json">
<link rel="mask-icon" href="<?php echo THEME_FAVICONS;?>/safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_s' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrap">
			<div class="row first">
				<div class="small-12 xlarge-6 columns header-widget">
					<?php if ( is_active_sidebar( 'header' ) ) : ?>
 							<?php dynamic_sidebar( 'header' ); ?>
 					<?php endif; ?>
				</div>
				<div class="small-12 xlarge-6 columns header-contact show-for-xlarge">
					<?php
                    $phone_number = get_field( 'phone_number', 'option' );
                    $tel = _s_convert_phone_to_tel( $phone_number );
                    if( !empty( $phone_number ) ) {
                        printf( '<a href="%s" class="phone-number">%s</a>', $tel, $phone_number );
                    }
					printf( '<a data-open="contact" class="btn-primary">%s</a>', __( 'Get Started', '_s' ) );
                    ?> 
				</div>
			</div>
		</div>
		<div class="wrap">
			<div class="column row last">
                <?php
                if( !empty( $phone_number ) ) {
                    
				    printf( '<a href="%s" class="phone-number hide-for-xlarge">
						<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40"><title>  Phone Icon</title><desc>  Created with sketchtool.</desc><defs><polyline points="0 0 51 0 51 45 0 45"/></defs><g fill="none"><g transform="translate(-27 -52)translate(21 50)"><mask fill="white"><use xlink:href="#path-1"/></mask><path d="M45 32.4L45 34.1C44.5 37.9 40.7 40.9 36 41 32.7 41 28.7 39.2 25.5 37.6 16.9 33.1 8.9 23.4 7 13.3L7 11C8.1 6.7 9.8 2.9 15.4 3 16.7 4.3 17.3 5.7 18.3 7.4 19 8.6 20.8 11 20.7 12.2 20.6 14.9 16.2 15.4 16 17.7 15.9 19 17.7 21.4 18.5 22.5 19.4 23.9 20.6 25.4 21.7 26.5 22.9 27.7 28.3 32.3 30.5 32 32.5 31.8 33.4 27.4 35.8 27.3 36.8 27.2 39 28.7 40.4 29.5 42.3 30.6 44.1 31.6 45 32.4" mask="url(#mask-2)" style="stroke-width:2;stroke:#252B33"/></g></g></svg>
						<span>%s</span>
					</a>', $tel, $phone_number );
                }
                 ?>
 				<div class="site-branding">
					<div class="site-title">
					<?php
                    $language_code = 'en' != ICL_LANGUAGE_CODE ? sprintf( '-%s', ICL_LANGUAGE_CODE ) : '' ;
					$site_url = home_url();
					printf('<div class="show-for-xlarge"><a href="%s" title="%s">%s</a></div>',  
							$site_url, get_bloginfo( 'name' ), get_svg( sprintf( 'logo-white%s', $language_code ) ) );
							
					printf( '<div class="hide-for-xlarge"><a href="%s" title="%s">%s</a></div>', 
							$site_url, get_bloginfo( 'name' ), get_svg( 'logo-mark' ) );
  					?>
					</div>
				</div><!-- .site-branding -->
					<nav id="site-navigation" class="nav-primary" role="navigation">
						<?php
							// Desktop Menu
							$args = array(
								'theme_location' => 'primary',
								'menu' => 'Primary Menu',
								'container' => 'false',
								'container_class' => '',
								'container_id' => '',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'menu',
								'before' => '',
								'after' => '',
								'link_before' => '',
								'link_after' => '',
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth' => 0
							);
							wp_nav_menu($args);
						?>
				</nav><!-- #site-navigation -->
			</div>
		</div><!-- wrap -->
	</header><!-- #masthead -->

	

<div id="page" class="site-container">

	<div id="content" class="site-content">
