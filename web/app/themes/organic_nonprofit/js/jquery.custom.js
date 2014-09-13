( function( $ ) {

	function removeNoJsClass() {
		$( 'html:first' ).removeClass( 'no-js' );
	}

	/* Superfish the menu drops ---------------------*/
	function superfishSetup() {
		$('.menu').superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: true,
			autoArrows:  true,
			dropShadows: false
		});
	}

	/* Flexslider ---------------------*/
	function flexSliderSetup() {
		if( $().flexslider) {
			var slider = $('.flexslider');
			slider.fitVids().flexslider({
		    	slideshowSpeed		: slider.attr('data-speed'),
		    	animationDuration	: 600,
		    	animation			: 'slide',
		    	video				: false,
		    	useCSS				: false,
		    	prevText			: '<i class="fa fa-angle-left"></i>',
		    	nextText			: '<i class="fa fa-angle-right"></i>',
		    	touch				: false,
		    	animationLoop		: true,
		    	smoothHeight		: true,
		    	
		    	start: function(slider) {
		    	    slider.removeClass('loading');
		    	}
			});	
		}
	}
	
	/* Equalize Content Height ---------------------*/
	function equalHeight(group) {
		$('.featured-pages').imagesLoaded( function() {
			tallest = 0;
			group.each(function() {
				thisHeight = $(this).height();
				if (thisHeight > tallest) {
					tallest = thisHeight;
				}
			});
			group.height(tallest);
		});
	}
		
	function modifyPosts() {
		
		/* Insert Line Break Before More Links ---------------------*/
		$('<br />').insertBefore('.more-link');
		
		/* Hide Comments When No Comments Activated ---------------------*/
		$('.nocomments').parent().css('display', 'none');
		
		/* Fit Vids ---------------------*/
		$('.feature-vid').fitVids();
		
		/* jQuery UI Tabs ---------------------*/
		$(function() {
			$( ".organic-tabs" ).tabs();
		});
		
		/* jQuery UI Accordion ---------------------*/
		$(function() {
			$( ".organic-accordion" ).accordion({
				collapsible: true,
				heightStyle: "content"
			});
		});
		
		/* Close Message Box ---------------------*/
		$('.organic-box a.close').click(function() {
			$(this).parent().stop().fadeOut('slow', function() {
			});
		});
		
		/* Toggle Box ---------------------*/
		$('.toggle-trigger').click(function() {
			$(this).toggleClass("active").next().fadeToggle("slow");
		});
	}
	
	$( document )
	.ready( removeNoJsClass )
	.ready( superfishSetup )
	.ready( modifyPosts )
	.on( 'post-load', modifyPosts );
	
	$( window )
	.load( flexSliderSetup )
	.load( equalHeight($('.text-holder')) );
	
})( jQuery );