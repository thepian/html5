/*
 
Author: Yves Van Broekhoven
Date: 2009-25-11
 
Fueled by jQuery
 
*/
 
// Note: No conflict function
 
// This function must be called after including the jQuery javascript file, but before including any other conflicting library,
// and also before actually that other conflicting library gets used, in case jQuery is included last. noConflict can be called at
// the end of the jQuery.js file to globally disable the $() jQuery alias. jQuery.noConflict returns a reference to jQuery, so it
// can be used to override the $() alias of the jQuery object.
// Use jQuery via jQuery(...)
//jQuery.noConflict();
 
jQuery(document).ready(function(){
    
    /* Lifestream
    -----------------------------------------------------*/
    try { lifestream() } catch(e) { /*console.log(e)*/ }
    
});

function lifestream()
{
    // Let's define these max counts here because we need them also in the filter functions
    var lsVisibleCount    = 9;
    var lsTwitterCount    = 2;
    var lsLastfmCount     = 1;
    var lsDeliciousCount  = 1;
    var lsFlickrCount     = 5;
    
    // Define some DOM elements, so we don't have to search them each time
    var lifestream          = $('ul#ls_lifestream');
    var lifestream_items;
    var filters             = new Array();
    var filter_btn          = $('#streamfilter a');
    var filter_active_class = 'active';
    var filter_all_text     = '<span class="indent">You filtered out all streams.</span>';
    var filter_cookie       = readCookie('lifestream_filters');
    
    $('body').lifestream({
        feed:                   'http://pipes.yahoo.com/pipes/pipe.run?_id=77bf2881775b3269dd051b5e47a594ed&_render=json&_callback=?',
        lsTwitterCount:         lsTwitterCount,
        lsLastfmCount:          lsLastfmCount,
        lsDeliciousCount:       lsDeliciousCount,
        lsFlickrCount:          lsFlickrCount,
        lsVisibleCount:         lsVisibleCount,
        twitterUsername:        'vpieters'
    }, function(){
        // Initialize lifestream items
        lifestream_items    = $('ul#ls_lifestream li');
        // Initialize filter
        if (filter_cookie) {
            filters = filter_cookie.split(',');
            filter_btn.each(function(){
                var type    = $(this).attr('rel');
                var active  = true;
                $.each(filters, function(index, value){
                    if (type == value) {
                        active = false;
                    }
                });
                if (active) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });
        } else {
            filter_btn.addClass('active');
        }
        
    });
    
    filter_btn.click(function(){
        var btn     = $(this);
        var type    = btn.attr('rel');
        var active  = btn.hasClass(filter_active_class);
        var counter = 1;
        if (active) {
            addFilter(type);
            lifestream.find('.' + type + ':visible').fadeOut(100);
            btn.removeClass(filter_active_class);
        } else {
           removeFilter(type);
           btn.addClass(filter_active_class);
        }
        lifestream_items.each(function(){
            if (counter > lsVisibleCount) return false;
            var item = $(this);
            if (!filterItem(item)) {
                item.fadeIn(100);
                counter++;
            }
        });
        createCookie('lifestream_filters', filters, 365)
        return false;
    });
    
    function addFilter(type)
    {
        var new_filter  = true;
        for (var i = 0; i < filters.length; i++) {
            if (filters[i] == type) new_filter = false;
        }
        if (new_filter) filters.push(type);
        if (filters.length >= filter_btn.length) {
            lifestream.parent().prepend('<p>' + filter_all_text + '</p>');
        }
    }
    
    function removeFilter(type)
    {
        var length  = filters.length;
        for (var i = 0; i < length; i++) {
            if (filters[i] == type) {
                filters.remove(i);
            }
        }
        lifestream.prev('p').remove();
    }

    function filterItem(item)
    {
        var filtered = false;
        $.each(filters, function(i, n){
            if (item.hasClass(n)) {
                filtered = true;
            }
        });
        if (filtered) {
            return true;
        } else {
            return false;
        }
    }
}

// Array Remove - By John Resig (MIT Licensed)
Array.prototype.remove = function(from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};
