jQuery.noConflict();

this.screenshotPreview = function(){	

	/* CONFIG */

		

		xOffset = 150;

		yOffset = 20;

		

		// these 2 variable determine popup's distance from the cursor

		// you might want to adjust to get the right result

		

	/* END CONFIG */

	jQuery("a.wdfscreenshot").hover(function(e){

		this.t = this.title;

		this.title = "";	

		var c = (this.t != "") ? "<br/>" + this.t : "";

		jQuery("body").append("<p id='wdfscreenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 

		jQuery("#wdfscreenshot")

			.css("top",(e.pageY - xOffset) + "px")

			.css("left",(e.pageX + yOffset) + "px")

			.fadeIn("fast");						

    },

	function(){

		this.title = this.t;	

		jQuery("#wdfscreenshot").remove();

    });	

	jQuery("a.wdfscreenshot").mousemove(function(e){

		jQuery("#wdfscreenshot")

			.css("top",(e.pageY - xOffset) + "px")

			.css("left",(e.pageX + yOffset) + "px");

	});			

};



// starting the script on page load

jQuery(document).ready(function(){

	screenshotPreview();

});