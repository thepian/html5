// Function plugin to allow hover menu in ie6
jQuery.fn.navHover = function(){

    jQuery(this).mouseover(function(){
            jQuery(this).addClass('over');
            }).mouseout(function(){
                jQuery(this).removeClass('over');
                });
}

//Function to toggle search dropdown
jQuery.fn.searchToggle = function(){

    jQuery(this).mouseenter(function(){
            jQuery('.ns_search-cat').show();
            });

    jQuery(this).mouseleave(function(){
            jQuery('.ns_search-cat').hide();
            });
}

//Function to toggle login
function loginToggle(){
    jQuery('#ns_login').click(function(){
        if(jQuery(this).hasClass('ns_login-on')){
            jQuery(this).removeClass('ns_login-on');
            jQuery(this).children().removeClass('ns_arrow-up');
            jQuery(this).children().addClass('ns_arrow-down');
        }else{
            jQuery(this).addClass('ns_login-on');
            jQuery(this).children().removeClass('ns_arrow-down');
            jQuery(this).children().addClass('ns_arrow-up');
        }
        jQuery('#ns_box-login').toggle();
    })
}

//Slideshow function
jQuery.fn.slideShow = function(timeOut){

    var jQueryelem = this;
    this.children(':gt(0)').hide();
    setInterval(function(){
        jQueryelem.children().eq(0).fadeOut('slow').next().fadeIn('slow').end().appendTo(jQueryelem);
    }, timeOut || 5000);
} 


function accordion(){
    jQuery('.ns_accordion h3').click(function() {
        jQuery(this).next().slideToggle('fast');
        jQuery(this).toggleClass('selected');
        return false;
    }).next().hide();

    jQuery('.ns_accordion h3').each(function(i){
        i += 1;
        jQuery(this).prepend(i + '. ');
    });
}