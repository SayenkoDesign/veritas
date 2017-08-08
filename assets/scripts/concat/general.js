(function (document, window, $) {

	'use strict';

	// Load Foundation
	$(document).foundation();

	// touch events for main menu
	$( '.nav-primary li:has(ul)' ).doubleTapToGo();

	// Responsive video embeds
	var $all_oembed_videos = $("iframe[src*='youtube'], iframe[src*='vimeo']");

	$all_oembed_videos.each(function() {

		var _this = $(this);

		if (_this.parent('.embed-container').length === 0) {
		  _this.wrap('<div class="embed-container"></div>');
		}

		_this.removeAttr('height').removeAttr('width');

 	});


	// Replace all SVG images with inline SVG (use as needed so you can set hover fills)

        $('img.svg').each(function(){
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

		$.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's ID to the new SVG
			if(typeof imgID !== 'undefined') {
				$svg = $svg.attr('id', imgID);
			}
			// Add replaced image's classes to the new SVG
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');

	});



	// Open external links in new window (exclue mail and foobox)

	$('a').not('svg a, [href*="mailto:"], [href*="tel:"], [class*="foobox"]').each(function () {
		var isInternalLink = new RegExp('/' + window.location.host + '/');
		if ( ! isInternalLink.test(this.href) ) {
			$(this).attr('target', '_blank');
		}
	});
	

    // Scroll up show header

	var $site_header =  $('.site-header');

	// clone header
	var $fixed_header_cloned = $site_header.clone()
							   .prop('id', 'masthead-fixed' )
							   .attr('aria-hidden','true')
							   .addClass('fixed')
							   .insertBefore('#masthead');


	var sticky =  $('.site-header.fixed');

	var header_height = $site_header.height();
	var lastScrollTop = 0;

	$(window).scroll(function() {

		var scroll = $(window).scrollTop();

		if (scroll > 400 ) {

		} else {
			sticky.removeClass("show");
			return;
		}

	   var st = $(this).scrollTop();
	   if (st > lastScrollTop){
		   // downscroll code
		   sticky.removeClass("show");
	   } else {
		  // upscroll code
		  sticky.addClass("show");
	   }
	   lastScrollTop = st;

	});

	// We've localized the default logo inside scripts.php
	$('.site-header.fixed').find('.site-title a').html( theme_vars.logo );

 	// Case Studies
    
    //$( '.case-studies .case-study a' ).doubleTapToGo();
  
	$('.slick-case-studies').slick({
		dots: false,
		//centerMode: true,
		slidesToShow: 3,
		arrows: true,
		nextArrow: '<div class="arrow-right"><span>Next</span></div>',
  		prevArrow: '<div class="arrow-left"><span>Previous</span></div>',
		responsive: [
			{
			  breakpoint: 980,
			  settings: {
				//centerMode: true,
				slidesToShow: 2
			  }
			},
			{
			  breakpoint: 640,
			  settings: {
						//centerMode: true,
				slidesToShow: 1
			  }
			}
		]
	});
	
	
    // Testimonials

	$('.slick-testimonials').slick({
        slidesToShow: 1,
		dots: true,
		arrows: true,
		nextArrow: '<div class="arrow-right">' + theme_vars.arrow_circle +  '<span>Next</span></div>',
  		prevArrow: '<div class="arrow-left">' + theme_vars.arrow_circle +  '<span>Previous</span></div>',
	});
    
    // only call masonry if ie10> && parent container exists
    if (Modernizr.dataset && $('.masonry-layout').length ) {
    
        var macy = Macy({
            container: '.masonry-layout',
            //trueOrder: false,
            waitForImages: false,
            margin: 12,
            columns: 3,
            breakAt: {
                980: 2,
                600: 1
            }
        });
    
    }
    
    // Theme specific - disable parent menu items, and click on mobile
    $('.site-header:not(fixed) .nav-primary .menu-item-has-children > a').on("click", function(event){
         
         event.preventDefault();
         
         if ($(window).width() < 980) {
             $(this).next('.sub-menu-toggle').trigger("click");
          }
         
    });

        

}(document, window, jQuery));

