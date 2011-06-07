jQuery(function(){
	jQuery.noConflict();

	jQuery('ul.superfish').superfish({
		delay:       200,                            // one second delay on mouseout
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation
		speed:       'fast',                          // faster animation speed
		autoArrows:  true,                           // disable generation of arrow mark-up
		dropShadows: false                            // disable drop shadows
	});

	jQuery('ul.superfish li ul').append('<li class="dropdown-bottom ie6fix"></li>');
	
	if (!((jQuery("#footer-widgets .widget").length) == 0)) {
		jQuery("#footer-widgets .widget").each(function (index, domEle) {
			// domEle == this
			if ((index+1)%3 == 0) jQuery(domEle).after("<div class='clear'></div>");
		});
	};

});