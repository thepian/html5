jQuery.fn.slideNews = function(settings) {
    settings = jQuery.extend({
        headline: "Shopping Cart",
        newsWidth: 74,
        newsSpeed: "normal"
    }, settings);
    return this.each(function(i){     
        thisParent = jQuery(this).parent();   
    
        if (parseInt(jQuery(".container",thisParent).css("left")) == 0) {
            jQuery(".prev",thisParent).css("visibility","hidden");
            }
        if ((parseInt(jQuery(".container",thisParent).css("left")) + parseInt(jQuery(".container",thisParent).css("width"))) <= (settings.newsWidth * dropshop_items)) {
          jQuery(".next",thisParent).css("visibility","hidden");
          }
          else
            {
            jQuery(".next",this).css("visibility","visible");
            }
        itemLength = jQuery(".item",this).length;
        newsContainerWidth = itemLength * settings.newsWidth;
        
        
        animating = false;
        jQuery(".next",this).click(function() {
            thisParent = jQuery(this).parent();
            if (animating == false) {
                animating = true;
                animateLeft = parseInt(jQuery(".container",thisParent).css("left")) - (settings.newsWidth * 1);
                //  alert(parseInt(jQuery(".container",thisParent).css("width")));
                if (animateLeft + parseInt(jQuery(".container",thisParent).css("width")) > 0) {
                    jQuery(".prev",thisParent).css("visibility","visible");
                    jQuery(".container",thisParent).animate({left: animateLeft}, settings.newsSpeed, function() {
                        jQuery(this).css("left",animateLeft);
                        if(parseInt(jQuery(".container",thisParent).css("left")) + parseInt(jQuery(".container",thisParent).css("width")) <= ((settings.newsWidth * dropshop_items) + (settings.newsWidth / 4 ))) {
                          jQuery(".next",thisParent).css("visibility","hidden");
                          }
                        if(parseInt(jQuery(".container",thisParent).css("left")) == 0) {
                          jQuery(".prev",thisParent).css("visibility","hidden");
                          }
                        animating = false;
                    });
                } else {
                    animating = false;
                }
                return false;
            }
        });
        jQuery(".prev",this).click(function() {
            thisParent = jQuery(this).parent();
            if (animating == false) {
                animating = true;
                animateLeft = parseInt(jQuery(".container",thisParent).css("left")) + (settings.newsWidth * 1);
                if ((animateLeft + parseInt(jQuery(".container",thisParent).css("width"))) <= parseInt(jQuery(".container",thisParent).css("width"))) {
                    jQuery(".next",thisParent).css("visibility","visible");
                    jQuery(".container",thisParent).animate({left: animateLeft}, settings.newsSpeed, function() {
                        jQuery(this).css("left",animateLeft);
                        if (parseInt(jQuery(".container",thisParent).css("left")) == 0) {
                            jQuery(".prev",thisParent).css("visibility","hidden");
                        }
                        if (parseInt(jQuery(".container",thisParent).css("left")) + parseInt(jQuery(".container",thisParent).css("width")) <= ((settings.newsWidth * dropshop_items) + (settings.newsWidth / 4 ))) {
                            jQuery(".next",thisParent).css("visibility","hidden");
                        }
                        animating = false;
                    });
                } else {
                    animating = false;
                }
                return false;
            }
        });
    });
};