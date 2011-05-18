$(function() {
	$('.ieaa').wrap(
			'<div style="zoom:0.25;"><div style="zoom:1;filter:progid:DXImageTransform.Microsoft.Blur(pixelRadius=2);"><div style="zoom:4;"><'+'/div><'+'/div><'+'/div>'
	);
});

/* -- Homepage Font Fixes -- */
Cufon.replace('.sl-text h2 span', { textShadow: '0 1px 0 #000'});
Cufon.replace('#featured_program .title', { textShadow: '0 1px 0 #000'});
Cufon.replace('.sl-nav span', { textShadow: '0 1px 0 #000'});
Cufon.replace('.schedule-tabs li.title', { textShadow: '0 1px 0 #CDCFD1'});
Cufon.replace('#featured .featured-content h2 strong', { textShadow: '0 1px 0 #5FA2D5'});
Cufon.replace('#home-content h3');
Cufon.replace('.sidebar h3');
Cufon.replace('.ftr-top .ftr-nav li a.parent', { hover: true });
Cufon.replace('.column-left .title');
Cufon.replace('.column-left .title span small');
Cufon.replace('.page-title');

/* -- Blog Page Font Fixes -- */
Cufon.replace('.post h3, .news-item h3 a', { hover: true });
Cufon.replace('.post-pagination a', { textShadow: '0 1px 0 #000', hover: true, hoverables: { span: true }});

/* -- Detail Page Font Fixes -- */
Cufon.replace('.page-title', { textShadow: '0 1px 0 #000000' });
Cufon.replace('.breadcrumb a', { textShadow: '0 1px 0 #000000', hover: true });
Cufon.replace('.cl-content h3, .cl-content h4, .cl-content h5, .cl-content h6');
Cufon.replace('.cl-content h2', { textShadow: '0px -1px 2px #000000'});


/* -- Sorting Page Font Fixes -- */
Cufon.replace('.el-list h3');

/* -- Programming Page Font Fixes -- */
Cufon.replace('.program-list h3 a', { hover: true });



$(document).ready(function() {
    //Slide Main Banner
    $('.slc-slider').cycle({
        fx:      'fade',
        timeout:  7000,
        prev:    '.prev',
        next:    '.next'
        //cleartype: 1
    });

    // Slide Featured
    $('.slides-feat').cycle({
        fx:      'scrollHorz',
        timeout:  0,
        prev:    '.feat_prev',
        next:    '.feat_next',
        pager:   '.slidernav-feat',
        pagerAnchorBuilder: pagerFactory
    });

    // Slider Recent
    $('.slides-recent').cycle({
        fx:      'scrollHorz',
        timeout:  0,
        prev:    '.prev2',
        next:    '.next2',
        pager:   '.slidernav-recent',
        pagerAnchorBuilder: pagerFactory
    });

    function pagerFactory(idx, slide) {
       // var s = idx > 2 ? ' style="display:none"' : '';
        return '<li><a href="#">'+(idx+1)+'</a></li>';
    };

    $('.emptyonclick').emptyonclick();
    $('.schedule-tabs').idTabs("day0");
    $('.featTabs').idTabs("feat");
	$('.cb-video').colorbox({iframe:true, innerWidth:480, innerHeight:300, scrolling: false});
	$('.featimg').colorbox({scrolling: false});

    var curl = jQuery.url.attr("directory");
    var len = curl.length;
    var curl2 = curl.substr(0, len-1);
    $('.categories ul li a[href='+curl2+']').parent('li').addClass('selected');

    // Navigation Parent Dropdown Fix
    $('#nav ul').parent().mouseover(function() {
        $(this).addClass('nav_dropdown');
    }).mouseout(function() {
        $(this).removeClass('nav_dropdown');
    });

    // Time Zone Changer
    $('.filter-data ul a').live('click', function(e) {
    	var selected_tz = this.id;
// This is just me messing around to see if I can fix the time zone stuff, to get rid of a bunch of validation errors:
//		fixed_string = selected_tz.replace(/\-/g, '/');

    	if (get_cookie('hdnet_tz') != null) {
    		delete_cookie('hdnet_tz');
    	}
    	set_cookie('hdnet_tz', selected_tz); // 'selected_tz' should be 'fixed_string' if I decide to try to fix this.
    	window.location.reload();

		if(e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
    });

    // Channel Finder
    $("#nav li a:contains('Subscribe'), .ftr-nav li a:contains('Subscribe'), .chan_find").click(function(e) {
    	open_colorbox();

    	if(e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
    });
/*    $('#menu-item-53').click(function(e) {
    	open_colorbox();

    	if(e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
    })
    $('.chan_find').click(function(e) {
    	open_colorbox();

    	if(e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
    });;*/
    $('.channelfinder-widget form').submit(function() {
    	var zip_code = $('#zip').val();
    	open_colorbox(zip_code);

    	return false;
    });
    function open_colorbox(zip) {
    	var post_str = '';
    	if (zip != undefined)
    		post_str = '?zipcode=' + zip;
    	$.colorbox({
    		href: 'http://hdnet.viewerlink.tv/' + post_str,
    		iframe: true,
    		width: '900px',
    		height: '500px',
    		scrolling: true
    	});
    }

    // Search Results Pagination
    var result_cnt = $('#sched_programs').children('li').size();
    var items_pp = 10;
    $('.el-pagination').pagination(result_cnt, { items_per_page: items_pp, callback: pageselectCallback });
    function pageselectCallback(page_index, jq) {
    	var child_cnt = 1;
    	var multiplier = page_index + 1;
    	$('#sched_programs').children('li').hide().each(function() {
    		var min = (multiplier * items_pp) - (items_pp - 1);
    		var max = multiplier * items_pp;
    		if (child_cnt >= min && child_cnt <= max) {
    			$(this).show();
    		}
    		child_cnt++;
    	});

        return false;
    }

    $('#menu-item-344 a, #menu-item-345 a, #menu-item-346 a, #menu-item-347 > a').attr('target', '_blank');

    // Transripts Reader
    $('.trans_reader').live('click', function(e) {
        var link = $(this).attr('href');
        $.colorbox({
            href: link,
            iframe: true,
            initialWidth: '450px',
            initialHeight: '100px',
            width: '900px',
            height: '90%',
            scrolling: true,
            onLoad: function() {
                $(this).css('background-color', '#FFF');
            },
            onComplete: function() {
                $(this).css('background-color', '#FFF');
            }
        });

    	if(e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
    });

    itemsPerPage = 10;
    if ($('.limit_5').length != 0) {
        itemsPerPage = parseInt($('.limit_5').attr('rel'));
    }
    paginatorStyle = 3;
    paginatorPosition = 'bottom';
    $('#sched_programs').not('.no_pag').pagination();
    
    var paginated = true;
    $('.view_all a').live('click', function(e) {
        if (paginated) {
            $('#sched_programs').depagination();
            $(this).text('View Limited');
            paginated = false;
        } else {
            $('#sched_programs').pagination();
            $(this).text('Show All');
            paginated = true;
        }

    	if(e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
    });
    
    $("a span.prev, a span.prev2, a span.feat_prev, a span.next, a span.next2, a span.feat_next").click(function(e){
		e.preventDefault();
	});

    if ($(".fp_img").length > 0) {
        $(".fp_img").tooltip({ effect: 'slide' });
    }
    
    $("#featured_program ul li").live('mouseover mouseout', function(e) {
        if (e.type == 'mouseover') {
            $(this).css('color', '#FFF');
            return false;
        } else if (e.type == 'mouseout') {
            $(this).css('color', '#5E6269');
            return false;
        }
    });
});

function set_cookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function get_cookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function delete_cookie(name) {
	set_cookie(name,"",-1);
}
function openmoviewindow(link, width, height) {
    var tru_width = width + 10;
    var tru_height = height - 45;
    $.colorbox({
		href: 'http://www.hd.net/' + link,
		iframe: false,
		width: tru_width + 'px',
		height: tru_height + 'px',
		scrolling: false
	});
	
}
