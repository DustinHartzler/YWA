jQuery( window ).load( function() {
	jQuery('.slide-nav ul li:first a').addClass('active');
	jQuery('.slide-nav ul li a').click(function(e) {
		e.preventDefault();
		var slide = jQuery( this ).parents( 'li' ).index();
		jQuery('#testimonials .slides').flexslider( slide );
		jQuery( '.slide-nav ul li a' ).removeClass('active');
		jQuery( this ).addClass('active');
	});
	jQuery( "#testimonials .slides" ).flexslider({
		selector: ".testimonials-list > li",
		animation: "fade",
		manualControls: ".slide-nav",
		slideshow: false,
		controlNav: false,
		directionNav: false,
		smoothHeight: true
	});
});