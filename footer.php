<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _s
 */
?>

</div><!-- #content -->


<?php

get_template_part( 'template-parts/section', 'footer-cta' );


// Footer functions located inside: theme.php
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="wrap">
		<div class="footer-widgets">
 			  
			<?php
			// Mobile
			printf( '<div class="column row hide-for-large">
					<div class="widget">%s</div><div class="widget">%s</div><div class="widget">%s</div>
					</div>',
					footer_logo(),
					footer_social_icons(),
					footer_contact_details()
			);
			?>
			
			
			<div class="row show-for-large">
		
				<div class="medium-4 columns">
			
 						<div class="widget">
						<?php
 						echo footer_social_icons();
						?>
						</div>
				</div>
				
				
				<div class="medium-4 columns">
			
 						<div class="widget">
						<?php
 						echo footer_logo();
						?>
						</div>
				</div>
				
				
				<div class="medium-4 columns">
			
 						<div class="widget">
						<?php
 						echo footer_contact_details();
						?>
						</div>
				</div>
				
				
				
				
			</div>	
			
			
		</div>			
	
	</div>

 </footer><!-- #colophon -->

<?php

get_template_part( 'template-parts/modal', 'contact' );

?>


<?php wp_footer(); ?>
</body>
</html>
