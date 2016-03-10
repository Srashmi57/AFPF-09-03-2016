jQuery( document ).ready(function($) {
	"use strict";

	// $('img', 'div.flexslider').on('load', function() {
		// var $img = $(this),
		// imgHeight = $img.outerHeight();
		// $img.parent().height(imgHeight);
	// });
	
    /* ---------------------------------------------------------------------- */
	/*	Bootstrap Tabs
	/* ---------------------------------------------------------------------- */
	
    $('#myTab a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    })
    
    $('#myTab1 a').click(function (e) {
      e.preventDefault();
      $(this).tab('show');
    })
	
	/* ---------------------------------------------------------------------- */
	/*	For HTML Validation
	/* ---------------------------------------------------------------------- */
	
	$('a[data-rel]').each(function () {
        $(this).attr('rel', $(this).data('rel'));
    });


	
	/* ---------------------------------------------------------------------- */
	/*	FlexSlider
	/* ---------------------------------------------------------------------- */
	
	// if($('.flexslider').length){		
		// $('.flexslider').flexslider({
			// animation: "fade"
		// });
	// }	
	if($('.slides').length){
		$('.slides').bxSlider({
			auto:true});
	}
	
	$(".bx-viewport").css("height","474px");
	
	
	/* ---------------------------------------------------------------------- */
	/*	Menu Toggle on Responsive
	/* ---------------------------------------------------------------------- */
	
	MenuToggle();
	jQuery(window) .resize(function(event) {
		/* Act on the event */
		MenuToggle()
	});
    jQuery("#menus  li.sub-icon > a") .bind("click",function(){
      jQuery(this) .next() .slideToggle(200);
      return false;
	});
	
    jQuery( ".cs-click-menu" ).click(function() {
        jQuery(this) .next() .slideToggle(200);
			var css	= jQuery("#rightmenus") .css('display');
			if(css=="block")
			{
				 jQuery("#rightmenus") .css('display','none');
			}
			else
			{
				jQuery("#rightmenus") .css('display','block');
			}

	});
	
	
	
	  
});



/* ---------------------------------------------------------------------- */
/*	Menu Toggle Function
/* ---------------------------------------------------------------------- */

function MenuToggle() {
	
	var a = jQuery(window).width();
	var b = 1000
	if (a <= b) {
		jQuery("#menus ul") .parent('li') .addClass('sub-icon');
		jQuery("#menus ul") .hide();
	} else {
			jQuery("#menus ul,#menus") .show();
			
	}
}

/* ---------------------------------------------------------------------- */
/*	Sticky Script
/* ---------------------------------------------------------------------- */

jQuery(function($) {
	
	$(document).ready( function() {
		"use strict";

		/* ---------------------------------------------------------------------- */
		/*	Menu Script
		/* ---------------------------------------------------------------------- */

		$('.navigation').stickUp({
			
			parts: {
			  0:'home',
			  1:'about us',
			  2: 'category'
			},
			itemClass: 'menuItem',
			itemHover: 'active',
			topMargin: 'auto'
		});
		
	
	});
});