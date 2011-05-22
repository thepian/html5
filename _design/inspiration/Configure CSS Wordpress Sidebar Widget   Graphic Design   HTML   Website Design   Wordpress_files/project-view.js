function reportProject()
{
        window.open(base_url+'/report/violation/?objtype=project&encurl='+cur_url+'&objid='+project_id,'','width=600, height=450, left=100,top=100,menu=no, toolbar=no,scrollbars=yes,resizable=yes');
        return false;
}

function help()
{
        window.open(base_url+'/page.php?p=info/project_actions&popup=1','','width=600, height=450, left=100,top=100,menu=no, toolbar=no,scrollbars=yes,resizable=yes');
        return false;
}

function cantBid()
{
        window.open(base_url+'/page.php?p=info/cantbid&popup=1','','width=600, height=450, left=100,top=100,menu=no, toolbar=no,scrollbars=yes,resizable=yes');
        return false;
}

function openPortfolio( argUserId)
{
	window.open(base_url+"/users/portfolio_popup.php?id="+argUserId
	            ,"Portfolio"+argUserId
		    ,"width="
		    + (window.screen.availWidth/2) 
		    +", height="
		    + (window.screen.availHeight/2) 
		    +", left=100,top=100,titlebar=no;menu=no,location=no,toolbar=no,scrollbars=no,resizable=yes");
	return false;
}

var FILTER_SLIDERBAR_SETP = 5;

var default_note = 'Start typing your own private note here'; 
var default_milestone_descr = 'Type the description here(up to 40 characters)';
var unhideBidAlertMsg = "Do you want to make this bid visible again?"; 
var hideBidAlertMsg = "Are you sure you want to hide this bid?"; 
var bidinfo; 
var global_obj; 
var escrow_id; 
var reputationBoxTop = 0; 
var reputationBoxLeft = 0; 
var req_load_reputation; 
var req_search_bids; 
var nonwinbids_filter_obj = {};
var hiddenbids_filter_obj = {};
var filter_obj = nonwinbids_filter_obj;
var preloaded_images = new Array();
function preload_image(image_url) {
    var img = new Image();
    img.src = image_url;
    preloaded_images.push(img);
}

preload_image(base_url+"/img/icons/exclam_small.png");
preload_image(base_url+"/img/icons/exclam_small_over.png");

function show_or_hide_winbids_heading() {
	if((selected_seller_accepted_count + selected_seller_pending_count) > 0) {
		jq('.bidWrap.win-bids').show(); 
		jq('#lbl-awarded-bids').show(); 
	} else  {
		jq('.bidWrap.win-bids').hide();
		jq('#lbl-awarded-bids').hide(); 
	}
}

function filter_bids_view(filter_obj) {
	jq('.'+curr_bids_tag+' .serviceProviderDetails').show();
    jq('.bidders-container.'+curr_bids_tag+' .no-bids-text').remove();
	var i; 
	var cnt_curr_bids = curr_bids.length; 
	for(i=0; i<curr_bids.length; i++) {
		if(curr_bids[i].sponsored_bid) {
			continue; 
		}
		
		if(filter_obj.minBidAmount != null && filter_obj.maxBidAmount != null) {
			if(curr_bids[i].sum < filter_obj.minBidAmount || curr_bids[i].sum > filter_obj.maxBidAmount) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.minDaysToComplete != null && filter_obj.maxDaysToComplete != null) {
			if(curr_bids[i].period < filter_obj.minDaysToComplete || curr_bids[i].period > filter_obj.maxDaysToComplete) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.minTimeOfBid != null && filter_obj.maxTimeOfBid != null) {
			if(curr_bids[i].submitdate_unixtimestamp < filter_obj.minTimeOfBid || curr_bids[i].submitdate_unixtimestamp > filter_obj.maxTimeOfBid) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.minInitialMilestone != null && filter_obj.maxInitialMilestone != null) {
			if(curr_bids[i].milestone_amount < filter_obj.minInitialMilestone || curr_bids[i].milestone_amount > filter_obj.maxInitialMilestone) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.country != null && filter_obj.country.length > 0) {
			if( !gaf_js_in_array(curr_bids[i].flag_name, filter_obj.country) ) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.insignia != null && filter_obj.insignia.length > 0) {
			hasinsignia = false; 
			var j; 
			for(j=0; j< curr_bids[i].user_insignia.length; j++) {
				if( gaf_js_in_array(curr_bids[i].user_insignia[j].title, filter_obj.insignia) )
					hasinsignia = true; 
			}
			if(!hasinsignia) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}	
		}
		if(filter_obj.minStars != null && filter_obj.maxStars != null) {
			if(Math.round(curr_bids[i].seller_rating) < filter_obj.minStars || Math.round(curr_bids[i].seller_rating) > filter_obj.maxStars) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.minScore != null && filter_obj.maxScore != null) {
			if(curr_bids[i].bid_rate < filter_obj.minScore || curr_bids[i].bid_rate > filter_obj.maxScore) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.minCompletedProjects != null && filter_obj.maxCompletedProjects != null) {
			if(curr_bids[i].count_completed_projects < filter_obj.minCompletedProjects || curr_bids[i].count_completed_projects > filter_obj.maxCompletedProjects) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			}
		}
		if(filter_obj.portfolio != null) {
			if(!curr_bids[i].isPortfolioCreated) {
				jq('#bid'+curr_bids[i].id).hide();
				cnt_curr_bids--;
				continue; 
			} 
		}
	}
    if(jq('.'+curr_bids_tag+' .serviceProviderDetails:visible').size() == 0) {
        jq('.bidders-container.'+curr_bids_tag).append('<div class="no-bids-text">No bids match your search criteria</div>');
    }
    
    jq('#cnt-bid-searched-result').html(cnt_curr_bids); 
}

function gaf_js_in_array(needle, haystack) {
	var i; 
	for(i=0; i<haystack.length; i++) {
		if(needle == haystack[i])
			return true; 
	}
	return false; 
}

function build_saved_search_lnk_from_cookie() {
    jq('#div-saved-search').html(''); 
    var cookiesArr = getCookies('_savedsearch_');
    var i;
    if(cookiesArr.length > 0) {
	    for(i=0; i<cookiesArr.length; i++) {
		    jq('#div-saved-search').append(getSavedFilterLnkHmtl(cookiesArr[i]));
	    }
    } else {
    	jq('#div-saved-search').append('<div>No any saved searches yet</div>');
    }
    jq('#div-saved-search').append('<div class="clear"></div>');
}

function update_filter_ui(filter_obj) {
    jq('#div-current-search').html('<input id="search-query-string" type="hidden" value="">');
    reset_filter_ui(); 
    if(filter_obj.minBidAmount != null && filter_obj.maxBidAmount != null) {
        jq('#div-current-search').append(filter_ui_search_item('BidAmount', 'Bid Amount', proj_currency_sign + filter_obj.minBidAmount + ' - ' + proj_currency_sign + filter_obj.maxBidAmount));
        update_slider_ui('bid-amount', filter_obj.minBidAmount, filter_obj.maxBidAmount);
        expandSingle(jq('.section.bid-amount'));
    }
    if(filter_obj.minDaysToComplete != null && filter_obj.maxDaysToComplete != null) {
        jq('#div-current-search').append(filter_ui_search_item('DaysToComplete', 'Days To Complete', filter_obj.minDaysToComplete + ' - ' + filter_obj.maxDaysToComplete));
        update_slider_ui('days-to-complete', filter_obj.minDaysToComplete, filter_obj.maxDaysToComplete);
        expandSingle(jq('.section.days-to-complete'));
    }
    if(filter_obj.minTimeOfBid != null && filter_obj.maxTimeOfBid != null) {
        jq('#div-current-search').append(filter_ui_search_item('TimeOfBid', 'Time Of Bid', lib_datetime_relative_date_v2(filter_obj.minTimeOfBid) + ' - ' + lib_datetime_relative_date_v2(filter_obj.maxTimeOfBid)));
        update_slider_ui('time-of-bid', filter_obj.minTimeOfBid, filter_obj.maxTimeOfBid);
        expandSingle(jq('.section.time-of-bid'));
    }
    if(filter_obj.minInitialMilestone != null && filter_obj.maxInitialMilestone != null) {
        jq('#div-current-search').append(filter_ui_search_item('InitialMilestone', 'Initial Milestone', proj_currency_sign+filter_obj.minInitialMilestone + ' - ' + proj_currency_sign+filter_obj.maxInitialMilestone));
        update_slider_ui('initial-milestone', filter_obj.minInitialMilestone, filter_obj.maxInitialMilestone);
        expandSingle(jq('.section.initial-milestone'));
    }
    if(filter_obj.country != null && filter_obj.country.length > 0) {
        jq('#div-current-search').append(filter_ui_search_item('country', 'Country', filter_obj.country.join(', ') ));
        for(var i=0; i < filter_obj.country.length; i++) {
            jq('.bids-filter-country[info='+filter_obj.country[i]+']').attr('checked',true);
        }
        expandSingle(jq('.section.country'));
    }
    if(filter_obj.insignia != null && filter_obj.insignia.length > 0) {
        jq('#div-current-search').append(filter_ui_search_item('insignia', 'Badges', filter_obj.insignia.join(', ') ));
        for(var j=0; j < filter_obj.insignia.length; j++) {
            jq('.bids-filter-insignia[info='+filter_obj.insignia[j]+']').attr('checked',true);
        }
        expandSingle(jq('.section.insignia'));
    }
    if(filter_obj.minStars != null && filter_obj.maxStars != null) {
        jq('#div-current-search').append(filter_ui_search_item('Stars', 'Rating', filter_obj.minStars + ' - ' + filter_obj.maxStars));
        update_slider_ui('stars', filter_obj.minStars, filter_obj.maxStars);
        expandSingle(jq('.section.stars'));
    }
    if(filter_obj.minScore != null && filter_obj.maxScore != null) {
        jq('#div-current-search').append(filter_ui_search_item('Score', 'My Score', filter_obj.minScore + ' - ' + filter_obj.maxScore));
        update_slider_ui('score', filter_obj.minScore, filter_obj.maxScore);
        expandSingle(jq('.section.score'));
    }
    if(filter_obj.minCompletedProjects != null && filter_obj.maxCompletedProjects != null) {
        jq('#div-current-search').append(filter_ui_search_item('CompletedProjects', 'Reviews', filter_obj.minCompletedProjects + ' - ' + filter_obj.maxCompletedProjects));
        update_slider_ui('completed-projects', filter_obj.minCompletedProjects, filter_obj.maxCompletedProjects);
        expandSingle(jq('.section.completed-projects'));
    }
    if(filter_obj.portfolio != null) {
        jq('#div-current-search').append(filter_ui_search_item('portfolio', 'Portfolio', 'Has Portfolio'));
        jq('.lnk-portfolio').css('color','#888888').css('cursor','text');
        expandSingle(jq('.section.portfolio'));
    }
    jq('#div-current-search').append('<div class="clear"></div>');
    if(!isObjectEmpty(filter_obj)) {
        jq('<div></div>').addClass('horizontal-line').css('width','auto').insertAfter('#div-current-search .clear');
        jq('<div></div>').addClass('save-or-new-search').html('<a id="lnk-save-search">Save Search</a><a id="lnk-new-search">Reset</a>').insertAfter('#div-current-search .horizontal-line');
    }
    
	//show or hide top-left part ...
	if( (!isObjectEmpty(filter_obj) || curr_bids.length == 0) && jq('#current-search-head').css('background-color') == 'rgb(1, 146, 203)' ) {
		jq('#div-current-search').show(); 
	} else {
		jq('#div-current-search').hide(); 
	}
	
	jq('#cnt-bid-searched-result').html(jq('.bidders-container.'+curr_bids_tag+' .serviceProviderDetails:visible').length); 
}

function filter_ui_search_item(attr_param, text, value) {
    return '<div class="search-item" param="'+attr_param+'">' +
                '<div class="search-item-left"><b>'+text+': </b>'+value +'</div><a class="remove remove-filter"></a>'+
           '</div>';
}

function update_slider_ui(slider_id, minValue, maxValue) {
	var minBoundary = parseInt(eval('min'+formatString(slider_id))); 
	var maxBoundary = parseInt(eval('max'+formatString(slider_id))); 
	minValue = Math.max(minValue, minBoundary); 
	maxValue = Math.min(maxValue, maxBoundary); 
    jq('#slider-'+slider_id).slider("option", "values", [minValue, maxValue]);
    jq('#'+slider_id+'-min').html(slider_id == 'time-of-bid' ? lib_datetime_relative_date_v2(minValue) : minValue);
	jq('#'+slider_id+'-max').html(slider_id == 'time-of-bid' ? lib_datetime_relative_date_v2(maxValue) : maxValue);
}

function reset_slider_ui(slider_id) {
    var minBoundary = parseInt(eval('min'+formatString(slider_id)));
    var maxBoundary = parseInt(eval('max'+formatString(slider_id)));
    if(minBoundary == maxBoundary) {
    	jq('.section.'+slider_id).hide(); 
    	return 0; 
    }
    
    jq('.section.'+slider_id).show(); 
    jq('#slider-'+slider_id).slider("option", "min", minBoundary);
    jq('#slider-'+slider_id).slider("option", "max", maxBoundary);
	jq('#slider-'+slider_id).slider("option", "values", [minBoundary, maxBoundary]); 
    update_slider_ui(slider_id, minBoundary, maxBoundary);
    return 1; 
}

function reset_filter_ui() {
    // reset filter ui boundary data first ....
    reset_filter_boundary_data(curr_bids);
    var visible_basic_tab = 0;
    var visible_adv_tab = 0; 
    visible_basic_tab += reset_slider_ui('bid-amount');
    visible_basic_tab += reset_slider_ui('days-to-complete');
    visible_adv_tab += reset_slider_ui('time-of-bid');
    visible_basic_tab += reset_slider_ui('initial-milestone');
    visible_basic_tab += reset_slider_ui('completed-projects');
    visible_basic_tab += reset_slider_ui('stars'); 
    visible_basic_tab += reset_slider_ui('score'); 
    visible_adv_tab += reset_filter_countries_ui();
    visible_adv_tab += reset_filter_insignias_ui();
    visible_adv_tab += reset_filter_portfolio_ui();
    if(visible_basic_tab == 0) {
    	jq('#bid-filter-body .expand:eq(0)').hide();
    } else {
    	jq('#bid-filter-body .expand:eq(0)').show();
    }
    if(visible_adv_tab == 0) {
    	jq('#bid-filter-body .expand:eq(1)').hide();
    } else {
    	jq('#bid-filter-body .expand:eq(1)').show();
    }
    if(curr_bids.length == 0) {
    	reset_filter_obj();
    	jq('#div-current-search').html('<div>No'+(curr_bids_tag=='nonwinbids'?'':' hidden')+' bids to search</div>').show(); 
    }
}

function reset_filter_countries_ui() {
    if(isObjectEmpty(filter_boundary_countries)) {
        jq('.section.country').hide();
        return 0;
    }
    jq('.section.country').show(); 

    var cnt_all = 0, key; 
    for(key in filter_boundary_countries) {
        cnt_all += filter_boundary_countries[key]; 
    }
    var country_sec_html = '<div class="bids-filter-margin-left"> \
                                <input type="checkbox" class="bids-filter-country-all" style="float:left;"> \
                                <div class="bids-filter-rhs-div"> \
                                    <a id="lnk-select-all-country">All</a> <span class="total">('+cnt_all+')</span> \
                                </div> \
                            </div>';
    for(key in filter_boundary_countries) {
        country_sec_html += '<div class="bids-filter-margin-left"> \
                                <input type="checkbox" class="bids-filter-country" style="float:left;" info="'+key+'">\
                                <div class="bids-filter-rhs-div">\
                                    <a class="lnk-country lnk-single-choice" param="country" info="'+key+'">'+key+'</a> <span class="total">('+filter_boundary_countries[key]+')</span>\
                                </div> \
                             </div>';
    }
    country_sec_html += '<div class="clear"></div> \
                         <div class="pos-abs-right-bottom"> \
                            <a id="btn-go-country" class="btn-GO gaf-button-blue btn-10p5px-bold"><span>GO</span></a> \
                        </div>';
    jq('.section.country .s-wrap').html(country_sec_html);

    jq('.bids-filter-country-all').attr('checked',false);
    jq('.bids-filter-country').each(function(){
        jq(this).attr('checked',false);
    });
    return 1; 
}

function reset_filter_insignias_ui() {
    if(isObjectEmpty(filter_boundary_insignias)) {
        jq('.section.insignia').hide();
        return 0;
    }
    jq('.section.insignia').show(); 

    var cnt_all = 0, key;
    for(key in filter_boundary_insignias) {
        cnt_all += filter_boundary_insignias[key];
    }
    var insignia_sec_html = '<div class="bids-filter-margin-left"> \
                                <input type="checkbox" class="bids-filter-insignia-all" style="float:left;">\
                                <div class="bids-filter-rhs-div"> \
                                    <a id="lnk-select-all-insignia">All</a> <span class="total">('+cnt_all+')</span> \
                                </div> \
                             </div>';
    for(key in filter_boundary_insignias) {
        insignia_sec_html += '<div class="bids-filter-margin-left"> \
                                <input type="checkbox" class="bids-filter-insignia" style="float:left;" info="'+key+'"> \
                                <div class="bids-filter-rhs-div"> \
                                    <a class="lnk-insignia lnk-single-choice" param="insignia" info="'+key+'">'+key+'</a> <span class="total">('+filter_boundary_insignias[key]+')</span> \
                                </div> \
                              </div>';
    }

    insignia_sec_html += '<div class="clear"></div> \
                            <div class="pos-abs-right-bottom"> \
                            <a id="btn-go-insignia" class="btn-GO gaf-button-blue btn-10p5px-bold"><span>GO</span></a> \
                          </div>';
    jq('.section.insignia .s-wrap').html(insignia_sec_html);

    jq('.bids-filter-insignia-all').attr('checked',false);
    jq('.bids-filter-insignia').each(function(){
        jq(this).attr('checked',false);
    });
    return 1; 
}

function reset_filter_portfolio_ui() {
	if(filter_boundary_portfolio == 0 || filter_boundary_portfolio == null) {
		jq('.section.portfolio').hide();
		return 0; 
	}
	jq('.section.portfolio').show(); 
    jq('.section.portfolio .bids-filter-link .total').html('('+filter_boundary_portfolio+')');
    jq('.lnk-portfolio').css('color','#009DD8').css('cursor','pointer');
    return 1; 
}

jq = jQuery.noConflict();
jq(document).ready(function() {
	jq('#cnt-bid-searched-result').html(nonwinbids.length); 
	build_saved_search_lnk_from_cookie();
	if(is_buyer)
		reset_filter_ui(); 

	jq('.lnk-report-violation-bid').live('click',function() {
		bidinfo = jq(this).attr('bidinfo'); 
		jq('#popup-bid-violation').dialog('open');
		jq('button').blur();
	}); 
	jq('.one-time-click').live('click', function() {
		jq(this).parent().remove(); 
	});  

	/* Search section */
	jq('.drop').click(function() {
		if(jq(this).next('.s-wrap').is(':visible')) {
			jq(this).removeClass('blue-minus-sign').addClass('blue-plus-sign').next('.s-wrap').hide(); 
		} else {
			jq(this).removeClass('blue-plus-sign').addClass('blue-minus-sign').next('.s-wrap').show();
		}
	}); 
	
	jq('.expand .title').click(function() {
		if(jq(this).next('.expand-sub').is(':visible')) {
			jq(this).removeClass('white-arrow-down').addClass('white-arrow-right').next('.expand-sub').hide();
		} else {
			jq(this).removeClass('white-arrow-right').addClass('white-arrow-down').next('.expand-sub').show();
		}
	}); 

	jq('#current-search-head').click(function() {
		show_current_search();
	}); 
	jq('#saved-search-head').click(function() {
		show_saved_search();
	}); 
	jq('#tab-visiblebids').click(function() {
		show_visiblebids();
	}); 
	jq('#tab-hiddenbids').click(function() {
		show_hiddenbids();
	}); 

	jq('a.remove-filter').live('click', function() {
        var param = jq(this).parent().attr('param');
        // update filter_obj
		delete filter_obj["min"+param];
		delete filter_obj["max"+param];
		delete filter_obj[param];
        update_filter_ui(filter_obj); 
		ajaxLoadBids(); 
	}); 

	jq('#lnk-save-search').live('click',function() {
		jq('#popup-save-search').dialog('open');
		jq('button').blur();
	});
	jq('a.remove-cookie').live('click', function() {
		var cookie_name = jq(this).prev().html();
		setCookie('_savedsearch_'+escape(cookie_name), 'DUMMY', -10);
		build_saved_search_lnk_from_cookie();
	});
	jq('.saved-search-item .do-search').live('click', function() {
        restore_filter_obj_from_string(jq(this).attr('filter_obj_serialized'));
        update_filter_ui(filter_obj);
		filter_bids_view(filter_obj);
        show_current_search(); 
	}); 
		  
	jq('#lnk-new-search').live('click',function() {
		reset_filter_obj();
		jq('#search-query-string').val(''); 
		jq('#div-current-search .search-item').each(function(){
			jq(this).remove(); 
		}); 
		jq('#div-current-search .horizontal-line').remove(); 
		jq('#div-current-search .save-or-new-search').remove(); 
		// resotre link to clickable for stars, score, and protfolio
		jq('.lnk-single-choice[param=stars]').each(function(){ 
			jq(this).css('color','#009DD8').css('cursor','pointer');
		});
		jq('.lnk-single-choice[param=score]').each(function(){
			jq(this).css('color','#009DD8').css('cursor','pointer');
		});
		jq('.lnk-single-choice[param=portfolio]').each(function(){
			jq(this).css('color','#009DD8').css('cursor','pointer');
		});
		jq('#div-current-search').hide();
        jq('.bids-filter-country-all').attr('checked', false);
        jq('.bids-filter-country').each(function(){
            jq(this).attr('checked', false);
        });
        jq('.bids-filter-insignia-all').attr('checked', false);
        jq('.bids-filter-insignia').each(function(){
            jq(this).attr('checked', false);
        });
        resetSlider('slider-bid-amount');
        resetSlider('slider-days-to-complete');
        resetSlider('slider-time-of-bid');
        resetSlider('slider-initial-milestone');
        resetSlider('slider-completed-projects');
		ajaxLoadBids(); 
	}); 
	/*** disable 5-stars rating 
	jq('.smtext').live('mouseover',function(e) {
		if(reputationBoxTop == 0)
			reputationBoxTop = e.pageY; 
		if(reputationBoxLeft == 0)
			reputationBoxLeft = e.pageX; 
		jq('.hvr-lft').addClass('current'); 
		jq('.hvr-rgt').removeClass('current'); 
		jq('.hvr-review').show().css('top', parseInt(parseInt(reputationBoxTop) - 380) + 'px').css('left', parseInt(parseInt(reputationBoxLeft) - 50) + 'px'); 

		user_id = jq(this).parents('.serviceProviderDetails').children('.bidder-userid').val(); 
		//var user_id = jq(this).parents('div.serviceProviderDetails').children('input.bidder-userid').val(); 
		//var rep = getReputationInfoByUserId(user_id);
		//loadHummingbirdsAndNumCompIncompProj(rep); 

		loadReputation(project_id, user_id); 
		
	}).live('mouseleave',function() {
		jq('.hvr-review').hide(); 
		reputationBoxTop = 0; 
		reputationBoxLeft = 0; 
	});  

	jq('.hvr-review').mouseover(function() {
		jq(this).show(); 
	}).mouseleave(function() {
		jq(this).hide(); 
	});

	jq('.hvr-lft').live('click', function() {
		jq(this).addClass('current'); 
		jq('.hvr-rgt').removeClass('current');
		jq('.l3m').hide(); 
		jq('.eh').show(); 
	});  
	jq('.hvr-rgt').live('click', function() {
		jq(this).addClass('current'); 
		jq('.hvr-lft').removeClass('current'); 
		jq('.eh').hide(); 
		jq('.l3m').show(); 
	});
	*/

    // order the bids
    jq('.bids-heading').click(function(){
        sortBids(jq(this));
        updateNoBidsText();
    }); 

    // show / hide bidders message
    jq('.msg font.cursor.lnk-more').live('click',function(){
        jq(this).next().removeClass('hide'); 
        jq(this).hide(); 
        jq(this).prev().hide(); 
    }); 
    jq('.msg font.cursor.lnk-less').live('click',function(){
        jq(this).parent().addClass('hide'); 
        jq(this).parent().prev().show().prev().show(); 
    });
     jq('*[title]').monnaTip();

	jq('.bar-transaction .request-release-milestone').click(function() {
			if(prev_ajax_req_lock == 1)
				return false; 
			if(jq(this).html() == 'requested')
				return false; 
			var trans_id = jq(this).parents('.bar-transaction').attr('escrow_id'); 
			prev_ajax_req_lock = 1; 
			onRequestReleaseMilestone(trans_id); 
	}); 
	jq('.hoverable').live('mouseenter', function() {
		jq('#'+jq(this).attr('bidinfo')+' .generic_hover.'+jq(this).attr('hover_type')).css('display', 'inline'); 
    }).live('mouseleave', function(){
		jq('#'+jq(this).attr('bidinfo')+' .generic_hover.'+jq(this).attr('hover_type')).hide(); 
    }); 
}); 

function show_current_search() {
	jq('#current-search-head').css('background-color','#0192CB');
	jq('#saved-search-head').css('background-color','#888888');
    if(jq('#div-current-search .search-item').length > 0 || curr_bids.length == 0) {
        jq('#div-current-search').show();
    }
	jq('#div-saved-search').hide();
}
function show_saved_search() {
	jq('#saved-search-head').css('background-color','#0192CB');
	jq('#current-search-head').css('background-color','#888888');
	jq('#div-current-search').hide();
	jq('#div-saved-search').show();
}
function show_visiblebids() {
	jq('#tab-visiblebids').css('background-color','#0192CB');
	jq('#tab-hiddenbids').css('background-color','#888888');
	jq('.bidWrap.nonwinbids').show();
	jq('.bidWrap.hiddenbids').hide();
    filter_obj = nonwinbids_filter_obj;
    curr_bids = nonwinbids;
    curr_bids_tag = 'nonwinbids';
    update_filter_ui(filter_obj);
    jq('#cnt-bid-searched-result').html(jq('.bidders-container.'+curr_bids_tag+' .serviceProviderDetails:visible').length)
}
function show_hiddenbids() {
	jq('#tab-hiddenbids').css('background-color','#0192CB');
	jq('#tab-visiblebids').css('background-color','#888888');
	jq('.bidWrap.nonwinbids').hide();
	jq('.bidWrap.hiddenbids').show();
    filter_obj = hiddenbids_filter_obj;
    curr_bids = hiddenbids;
    curr_bids_tag = 'hiddenbids';
    update_filter_ui(filter_obj);
    jq('#cnt-bid-searched-result').html(jq('.bidders-container.'+curr_bids_tag+' .serviceProviderDetails:visible').length)
}
function show_current_search_visiblebids_if_necessary() {
	if (!jq('#div-current-search').is(':visible'))
		show_current_search();
}
function expand(obj_array) {
	if(obj_array) {
		for(i=0; i<obj_array.length; i++) {
			expandSingle(obj_array[i]); 
		}
	}
}
function expandSingle(obj) {
	if(obj) {
		obj.children('.drop').addClass('blue-minus-sign').removeClass('blue-plus-sign'); 
		obj.children('.s-wrap').show();
	} 
}
function collapse(obj_array) {
	if(obj_array) {
		for(i=0; i<obj_array.length; i++) {
			collapseSingle(obj_array[i]); 
		}
	}
}
function collapseSingle(obj) {
	if(obj) {
		obj.children('.drop').addClass('blue-plus-sign').removeClass('blue-minus-sign'); 
		obj.children('.s-wrap').hide();
	} 
}

function reportBidViolation() {
	hidden_reason = jq('#bid-violation-reason').val();
	jq('#popup-bid-violation').dialog('close'); 
	bid_id = parseInt(bidinfo.substring(3)); 
	//if(confirm("Are you sure you want to report this bid as a violation?")) {
		jq('#'+bidinfo).hide(); 
		jq('#'+bidinfo).after(jq('<div></div>').addClass('loading').html('<img src="'+base_url+'/img/ajax-loader.gif">'));

		if(is_buyer) {
			data = {bid_id: bid_id, pr_id: project_id, hide_reason: jq('#bid-violation-reason').val(), url: cur_url}; 
			url = base_url + '/ajax/bid/editbid.php'; 
		} else {
			data = {objid: bid_id, encurl: cur_url, objtype: 'bid', reason: jq('#bid-violation-reason').val()}; 
			url = base_url + '/ajax/violation/submit.php'; 
		}
		
		jq.ajax({
			type: 'post',
			data: data, 
			dataType: 'json', 
			url: url,
			success: function(response){
				jq('#'+bidinfo).next().remove(); 
				jq('#'+bidinfo).show(); 
				if(response.status == "success") {
					jq('#popup-bid-violation').dialog('close'); 
					if(is_buyer) {
						jq('#'+bidinfo).appendTo('.bidders-container.hiddenbids');
						jq('#'+bidinfo+' .lnk-hide-unhide-bid').html('Unhide Bid');
						move_json_obj_bid(bidinfo, 'hide'); 
						updateHiddenBidCount();
                        updateNoBidsText();
                       	update_filter_ui(filter_obj);
						realSort('hiddenbids', hiddenbids_sort[0], hiddenbids_sort[1]); 
					}
				} else {
					alert(response.msg); 
				} 
			}
		}); 
	//}
}

function saveBidsSearch() {
	//qs = jq('#search-query-string').val();
	//qs = qs.replace('?','');
	//qs = qs.replace('#bids','');
	
	//var url = window.location.href;
	//url = url.replace(/\?.*/, '');
	//url = url + '?' + qs + '#bids';

	jq('.saved-search-item > a').each(function() {
		if(jq(this).html() == jq('#tbx-current-search-name').val())
			jq(this).parent().remove();  
	});

	cookie_value = encodeURIComponent( JSON.stringify(filter_obj) );
	setCookie("_savedsearch_"+escape(jq('#tbx-current-search-name').val()), cookie_value, 730);
	build_saved_search_lnk_from_cookie(); 
	
	//jq('#div-saved-search div.clear').remove();
	//jq('#div-saved-search').append(jq('<div></div>').addClass('saved-search-item').append(jq('<a></a>').css('float','left').attr('href',url).html(jq('#tbx-current-search-name').val())).append(jq('<a></a>').addClass('remove').addClass('remove-cookie')));
	//jq('#div-saved-search').append(jq('<div></div>').addClass('clear'));
	jq('#popup-save-search').dialog('close');
}

function lib_datetime_relative_date_v2(time) {
	if (time < 0)
		return false;
	var diff = ( now_unixtimestamp - time);
	if (diff > 0) {
		if(diff < 60  ){
			return diff + " second" + (diff != 1 ? 's' : '') + " ago ";
		}else if(diff < 3600){
			diff = parseInt(diff/60 );
			return diff + " minute" + (diff != 1 ? 's' : '') + " ago ";
		}else if(diff < 86400){
			diff = parseInt(diff/3600 );
			return diff + " hour" + (diff != 1 ? 's' : '') + " ago ";
		}else if(diff < 86400 * 7){
			diff = parseInt(diff/86400 );
			return (diff != 1 ? diff + " days ago" : "yesterday");
		}else if(diff < 86400 * 7 * 4.3){
			diff = parseInt(diff/86400/7 );
			return (diff != 1 ? diff + " weeks ago" : "last week");
		}else if(diff < 86400 * 365){
			diff = parseInt(diff/86400/30 );
			return diff + " month" + (diff != 1 ? 's' : '') + " ago ";
		}else if(diff < 86400 * 365 * 8){
			diff = parseInt(diff/86400/365 );
			return "over " + diff + " year" + (diff != 1 ? 's' : '') + " ago ";
		}
	}
}

function removeQueryString(url, param) {
	var pattern = "&?" + param + "=[^&]*"
	var r = new RegExp(pattern, "g"); 
	url = url.replace(r, '');
	/*
	while(url.charAt(url.length-1) == '&') {
		url = url.substring(0, url.length-1); 
	}
	*/
	if(url.charAt(url.length-1) == '?') {
		url = url.substring(0, url.length-1); 
	}
	url = url.replace(/\?&/g, '?'); 
	return url;  
}

function replaceQueryString(url, param, value) {
	url = removeQueryString(url, param); 
	if(!url.match(/\?/))
		url += '?'; 
	url = url.replace(/#bids$/g, '');
	url = url + (url.charAt(url.length-1) == '?' ? "" : "&") + param + "=" + value + '#bids'; 
	return url; 
}

function formatString(str) {
	var arr = str.split('-');
	var return_str = '';  
	for(i=0; i<arr.length; i++) 
		return_str = return_str + arr[i].charAt(0).toUpperCase() + arr[i].slice(1);
	return return_str; 
}

function formatTitle(str) {
	var arr = str.split('-');
	var return_str = '';  
	for(i=0; i<arr.length; i++) 
		return_str = return_str + arr[i].charAt(0).toUpperCase() + arr[i].slice(1) + ' ';
	return jQuery.trim(return_str); 
}

function updateCurrentSearchSection(obj) {

	var qs = jq('#search-query-string').val(); 

	if(obj.hasClass('remove-filter')) {
		var param = obj.parent().attr('param'); 
		obj.parent().remove(); 

		if(jq('#div-current-search .search-item').length == 0) {
			jq('#div-current-search .horizontal-line').remove(); 
			jq('#div-current-search .save-or-new-search').remove();
            jq('#div-current-search').hide();
		}

		if(param == 'stars' || param == 'score' || param == 'portfolio') {
			jq('.lnk-single-choice[param='+param+']').each(function(){
				jq(this).css('color','#009DD8').css('cursor','pointer');
			});
		} else if(param == 'country' || param == 'insignia') {
			jq('.bids-filter-'+param).each(function(){
				jq(this).attr('checked',false); 
			});
            jq('.bids-filter-'+param+'-all').attr('checked', false);
		} else if(param == "BidAmount") {
            resetSlider('slider-bid-amount');
        } else if(param == "DaysToComplete") {
            resetSlider('slider-days-to-complete');
        } else if(param == "TimeOfBid") {
            resetSlider('slider-time-of-bid');
        } else if(param == "InitialMilestone") {
            resetSlider('slider-initial-milestone');
        } else if(param == "CompletedProjects") {
            resetSlider('slider-completed-projects');
        }

		qs = removeQueryString(qs, 'min'+param); 
		qs = removeQueryString(qs, 'max'+param); 
		qs = removeQueryString(qs, param); 
		// update filter_obj 
		delete filter_obj["min"+param];  
		delete filter_obj["max"+param]; 
		delete filter_obj[param]; 
	}
	//qs = qs.replace('?', ''); 
	//qs = qs.replace('#bids', ''); 
	jq('#search-query-string').val(qs); 
}

function slide_trigger_search(str, val0, val1) {
	var prefix = '';
	if(str == 'bid-amount' || str == 'initial-milestone')
		prefix = proj_currency_sign;
	var formated_str = formatString(str);
	var title = formatTitle(str);
	if(str == 'stars')
		title = 'Rating'; 
	else if (str == 'score')
		title = 'My Score';
	else if (str == 'completed-projects')
		title = 'Reviews'; 
	//var val0 = jq('#slider-'+str).slider("values", 0);
	//var val1 = jq('#slider-'+str).slider("values", 1);
	// update query string
	//qs = replaceQueryString(qs, "min"+formated_str, val0);
	//qs = replaceQueryString(qs, "max"+formated_str, val1);
	// update filter_obj
	filter_obj["min"+formated_str] = val0;
	filter_obj["max"+formated_str] = val1;
	ajaxLoadBids();
}

function loadHummingbirdsAndNumCompIncompProj(rep) {
	loadHummingBird(rep[0][0], rep[1][0], "quality"); 
	loadHummingBird(rep[0][1], rep[1][1], "communication"); 
	loadHummingBird(rep[0][2], rep[1][2], "expertise"); 
	loadHummingBird(rep[0][3], rep[1][3], "professionalism"); 
	loadHummingBird(rep[0][4], rep[1][4], "hire_again"); 
	updateNumCompletedIncompletedProjects(rep); 
}

function loadHummingBird(val1, val2, className) {
	i = 1; 
	jq('.eh .hvr-birds.'+className+' .bird').each(function() {
		jq(this).removeClass('full-star').removeClass('half-star').removeClass('no-star'); 
		if(Math.floor(val1) >= i)
			jq(this).addClass('full-star');
		else if(Math.floor(val1) < i && Math.round(val1) >= i)
			jq(this).addClass('half-star'); 
		else
			jq(this).addClass('no-star'); 
		i++; 
	}); 
	i = 1; 
	jq('.l3m .hvr-birds.'+className+' .bird').each(function() {
		jq(this).removeClass('full-star').removeClass('half-star').removeClass('no-star'); 
		if(Math.floor(val2) >= i)
			jq(this).addClass('full-star');
		else if(Math.floor(val2) < i && Math.round(val2) >= i)
			jq(this).addClass('half-star'); 
		else 
			jq(this).addClass('no-star');
		i++; 
	}); 
}

function updateNumCompletedIncompletedProjects(rep) {
	// last 3 months
	total = parseInt(rep[1][5] + rep[1][6]); 
	jq('.l3m .cnt-projects-total').html(total); 
	jq('.l3m .cnt-projects-incompleted').html(rep[1][6]);
	rate = parseInt(rep[1][5] * 100 / total);  
	jq('.l3m .projects-completion-rate').html(total == 0 ? 'n/a' : rate + '%'); 
	// entire history
	total = parseInt(rep[0][5] + rep[0][6]); 
	jq('.eh .cnt-projects-total').html(total); 
	jq('.eh .cnt-projects-incompleted').html(rep[0][6]);
	rate = parseInt(rep[0][5] * 100 / total);  
	jq('.eh .projects-completion-rate').html(total == 0 ? 'n/a' : rate + '%'); 
}

function get_bid_rate_stars(rate) {
	var s = ""; 
	for(i=1; i<=5; i++) {
		if(parseInt(rate) >= i)
			s += "<div class='clicked-stars-rating'></div>";
		else
			s += "<div class='default-stars-rating'></div>";
	}
	return s; 
	
}

function loadReputation(proj_id, user_id) {
	if(req_load_reputation)
		return true; 
	jq('.hvr-main').html(jq('<div></div>').addClass('container-reputation-loading').html('<img src="'+base_url+'/img/ajax-loader.gif">'));
	req_load_reputation = jq.ajax({
								url: base_url+'/ajax/reputation-on-hover-content.php?proj_id='+proj_id+'&user_id='+user_id, 
								success: function(r) {
									jq('.hvr-main').html(r); 
									req_load_reputation = null; 
								}
							});
	
}

function ajaxLoadBids() {
	//qs = jq('#search-query-string').val(); 
	//qs = qs.replace('?',''); 
	//qs = qs.replace('#bids',''); 
	
	//var url = window.location.href; 
	//url = url.replace(/\?.*/, ''); 
	//url = url + '?' + qs + '&isAjaxCall=1';
	//if(jq('.bidders-container.nonwinbids').is(':visible'))
		//url = url + '&category=nonwinbids&ord='+nonwinbids_sort[0]+'&so='+nonwinbids_sort[1]; 
	//if(jq('.bidders-container.hiddenbids').is(':visible'))
		//url = url + '&category=nonwinbids&ord='+hiddenbids_sort[0]+'&so='+hiddenbids_sort[1]; 

	//bidsSec = jq('.bidWrap.nonwinbids .bidders-container'); 
	//countrySec = jq('.section.country .s-wrap'); 
	//insigniaSec = jq('.section.insignia .s-wrap'); 
	
	filter_bids_view(filter_obj); 
	
	return true; 
	
	//bidsSec.html('<div style="width:630px;height:728px;text-align:center;padding-top:300px;"><img src="'+base_url+'/img/ajax-loader.gif"></div>');
	//countrySec.html('<div style="width:220px;height:170px;text-align:center;padding-top:70px;"><img src="'+base_url+'/img/ajax-loader.gif"></div>'); 
	//insigniaSec.html('<div style="width:220px;height:85px;text-align:center;padding-top:35px;"><img src="'+base_url+'/img/ajax-loader.gif"></div>'); 


/*	
	if(req_search_bids)
		req_search_bids.abort(); 
	req_search_bids = jq.ajax({
		url: url, 
		dataType: 'json', 
		success: function(response) {
			bidsSec.html(response.nonwinbids); 
			countrySec.html(response.country); 
			insigniaSec.html(response.insignia);
		} 
	});
*/ 
}

/*
 * bids can be ordered by username / pmb / bid amount / time of bid / ranking 
 */
function sortBids(obj) {
	updateIcon(obj);
	var ord;  
	var so; 
	if(obj.attr('category') == 'nonwinbids') {
		ord = nonwinbids_sort[0]; 
		so = nonwinbids_sort[1];
	}
	if(obj.attr('category') == 'winbids') {
		ord = winbids_sort[0]; 
		so = winbids_sort[1];
	}
	if(obj.attr('category') == 'hiddenbids') {
		ord = hiddenbids_sort[0]; 
		so = hiddenbids_sort[1];
	}
	realSort(obj.attr('category'), ord, so);  
}

var global_var_ord; 
var global_var_so; 

function realSort(ca, ord, so) {
	global_var_ord = ord; 
	global_var_so = so; 
	var bids = winbids; 
	if(ca == 'winbids')
		bids = winbids;
	else if (ca == 'nonwinbids')
		bids = nonwinbids; 
	else 
		bids = hiddenbids; 
	
	if(bids.length > 1) {
		bids.sort(cmpBidObj); 
	
		var str = '';
		for (var i = 0; i < bids.length; i++) {
			var container = jq('<div />');
			container.append(jq('#bid'+bids[i].id));
			str = str + container.html();
		}
	
		jq('.bidders-container.' + ca).html(str);
	}
}

function cmpBidObj(a, b) {
	if ( a['sponsored_bid'] && !b['sponsored_bid'] ) {
		return b['ord_ranking'] - a['ord_ranking_sb'];
	} else if ( !a['sponsored_bid'] && b['sponsored_bid'] ) {
		return b['ord_ranking_sb'] - a['ord_ranking']; 
	} else if ( a['sponsored_bid'] && b['sponsored_bid'] ) {
		return b['ord_ranking_sb'] - a['ord_ranking_sb']; 
	} else {
	
		if (global_var_so == 'desc') {
			if(global_var_ord == 'username') {
				return b['ord_'+global_var_ord] > a['ord_'+global_var_ord] ? -1 : 1;
			}
			return b['ord_'+global_var_ord] - a['ord_'+global_var_ord];
		} else {
			if(global_var_ord == 'username') {
				return a['ord_'+global_var_ord] > b['ord_'+global_var_ord] ? -1 : 1;
			}
			return a['ord_'+global_var_ord] - b['ord_'+global_var_ord]; 
		}
	}
}

function sortNumber(a, b) {
	return parseFloat(a) - parseFloat(b); 
}

function updateIcon(obj) {
	var so;
	var ord = obj.attr('ord');

	bidHead = obj.parent().parent(); 
	
	if(obj.find('img.arr').length != 0) {
	    src = obj.find('img.arr').attr('src');
	    bidHead.find('img.arr').remove();
	    if( src.indexOf('arr_desc') != -1 ) {
	        so = 'asc'; 
	        jq('<img>').addClass('arr png').css('height','18px').css('width','16px').attr('src', base_url+'/img/arr_asc.png').insertAfter(obj.children('span'));
	    } else { 
	        so = 'desc'; 
	        jq('<img>').addClass('arr png').css('height','18px').css('width','16px').attr('src', base_url+'/img/arr_desc.png').insertAfter(obj.children('span'));
	    }
	} else {
        var pre_sorted_head = bidHead.find('img.arr').parent();
        bidHead.find('img.arr').remove();
        jq('<img>').addClass('sort-indicator png').attr('src', base_url+'/img/icons/btn_up_down.png').insertAfter(pre_sorted_head.children('span'));
        
		obj.find('img.sort-indicator').remove();
        so = 'desc';
        jq('<img>').addClass('arr png').css('height','18px').css('width','16px').attr('src', base_url+'/img/arr_desc.png').insertAfter(obj.children('span'));
	}
    
	if(obj.attr('category') == 'nonwinbids')
		nonwinbids_sort = [ord, so]; 
	if (obj.attr('category') == 'winbids')
		winbids_sort = [ord, so]; 
	if (obj.attr('category') == 'hiddenbids')
		hiddenbids_sort = [ord, so]; 
}

/*
 * js generate view part
 */
function getSavedFilterLnkHmtl(json_obj) {
	var html = '<div class="saved-search-item">'+
			'<a class="do-search" style="float:left;" filter_obj_serialized="'+json_obj.value+'">'+unescape(json_obj.name)+'</a>'+
			'<a class="remove remove-cookie"></a>'+
		    '</div>';
	return html;
}

function reset_filter_boundary_data(bids_array) {
	minBidAmount = maxBidAmount = 0; 
	minDaysToComplete = maxDaysToComplete = 0; 
	minTimeOfBid = maxTimeOfBid = 0; 
	minInitialMilestone = maxInitialMilestone = 0; 
	minCompletedProjects = maxCompletedProjects = 0; 
	minStars = maxStars = 0; 
	minScore = maxScore = 0; 
	filter_boundary_countries = {}; 
	filter_boundary_insignias = {}; 
	filter_boundary_portfolio = 0; 
	
    var bid_amount = [];
    var days_to_complete = [];
    var time_of_bid = [];
    var initial_milestone = [];
    var completed_projects = [];
    var countries = {};
    var insignias = {};
    var seller_rating = [];
    var bid_rate = [];
    var cnt_portfolio = 0;
    for(var i=0; i<bids_array.length; i++) {
        bid_amount.push(bids_array[i].sum);
        days_to_complete.push(bids_array[i].period);
        time_of_bid.push(bids_array[i].submitdate_unixtimestamp);
        initial_milestone.push(bids_array[i].milestone_amount);
        completed_projects.push(bids_array[i].count_completed_projects);
        seller_rating.push( Math.round(bids_array[i].seller_rating) ); 
        bid_rate.push( parseInt(bids_array[i].bid_rate) ); 
        if( countries.hasOwnProperty(bids_array[i].flag_name) )
            countries[bids_array[i].flag_name]++;
        else
            countries[bids_array[i].flag_name]=1;
        for(var j=0; j<bids_array[i].user_insignia.length; j++) {
            if( insignias.hasOwnProperty(bids_array[i].user_insignia[j].title) )
                insignias[bids_array[i].user_insignia[j].title]++;
            else
                insignias[bids_array[i].user_insignia[j].title]=1;
        }
        if(bids_array[i].isPortfolioCreated)
            cnt_portfolio++;

    }
    if(bids_array.length > 0) {
	    bid_amount.sort(sortNumAsc);
	    days_to_complete.sort(sortNumAsc);
	    time_of_bid.sort(sortNumAsc);
	    initial_milestone.sort(sortNumAsc);
	    completed_projects.sort(sortNumAsc);
	    seller_rating.sort(sortNumAsc); 
	    bid_rate.sort(sortNumAsc); 
	    minBidAmount = Math.floor(bid_amount[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    maxBidAmount = Math.ceil(bid_amount[bid_amount.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    minDaysToComplete = Math.floor(days_to_complete[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    maxDaysToComplete = Math.ceil(days_to_complete[days_to_complete.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    minTimeOfBid = Math.floor(time_of_bid[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    maxTimeOfBid = Math.ceil(time_of_bid[time_of_bid.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    minInitialMilestone = Math.floor(initial_milestone[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    maxInitialMilestone = Math.ceil(initial_milestone[initial_milestone.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    minCompletedProjects = Math.floor(completed_projects[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    maxCompletedProjects = Math.ceil(completed_projects[completed_projects.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP;
	    minStars = Math.floor(seller_rating[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP; 
	    maxStars = Math.ceil(seller_rating[seller_rating.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP; 
	    minScore = Math.floor(bid_rate[0]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP; 
	    maxScore = Math.ceil(bid_rate[bid_rate.length-1]/FILTER_SLIDERBAR_SETP) * FILTER_SLIDERBAR_SETP; 
	    filter_boundary_countries = sortObject(countries);
	    filter_boundary_insignias = sortObject(insignias);
	    filter_boundary_portfolio = cnt_portfolio;
    }
}

function sortNumAsc(a,b) {
    return a-b;
}

function sortObject(obj) {
    var sortedObj = {}, key, tmp_arr = [];
    for (key in obj) {
        if(obj.hasOwnProperty(key))
            tmp_arr.push(key);
    }
    tmp_arr.sort();
    for(key = 0; key < tmp_arr.length; key++) {
        sortedObj[tmp_arr[key]] = obj[tmp_arr[key]];
    }
    return sortedObj;
}

function updateNoBidsText() {
    var nonwinbidsNumber = jq('.bidders-container.nonwinbids .serviceProviderDetails').size();
    var hiddenbidsNumber = jq('.bidders-container.hiddenbids .serviceProviderDetails').size();
    
    if(nonwinbidsNumber == 0) 
        jq('.bidders-container.nonwinbids').html('<div class="no-bids-text">There are no bids yet</div>');
    else
        jq('.bidders-container.nonwinbids .no-bids-text').remove();
    if(hiddenbidsNumber == 0)
        jq('.bidders-container.hiddenbids').html('<div class="no-bids-text">There are no hidden bids</div>');
    else
        jq('.bidders-container.hiddenbids .no-bids-text').remove();
}

function restore_filter_obj_from_string(str) {
    reset_filter_obj(); 
    var obj = JSON.parse( decodeURIComponent(str) );
    for(var key in obj)
        filter_obj[key] = obj[key];
}

function reset_filter_obj() {
    for(var key in filter_obj) {
        delete filter_obj[key];
    }
}

function onRequestReleaseMilestone(trans_id) {
	jq.ajax({
		url: base_url+'/ajax/payment/on-request-release-milestone.php?id='+trans_id,
		dataType: 'json', 
		success: function(response) {
				if(response.status == 'success')
					jq('.bar-transaction[escrow_id='+trans_id+'] .request-release-milestone').css('cursor','text').html('requested'); 
				else 
					alert(response.msg);
				prev_ajax_req_lock = 0;
		}
	});
}

function update_bids_obj_by_sb(sb_obj) {
	if( winbids.length > 0 ) {
		for(var i=0; i<winbids.length; i++) {
			if( sb_obj[winbids[i].user_id] ) {
				winbids[i].ord_ranking_sb = sb_obj[winbids[i].user_id].ranking_weight; 
				if( sb_obj[winbids[i].user_id].status == 'active' ) {
					winbids[i].sponsored_bid = true; 
					addSBStyle(jq('#bid'+winbids[i].id)); 
				} else { 
					winbids[i].sponsored_bid = false;
					removeSBStyle(jq('#bid'+winbids[i].id)); 
				}
			} else {
				winbids[i].sponsored_bid = false;
				removeSBStyle(jq('#bid'+winbids[i].id)); 
			}
		}
	}
	if( nonwinbids.length > 0 ) {
		for(var i=0; i<nonwinbids.length; i++) {
			if( sb_obj[nonwinbids[i].user_id] ) {
				nonwinbids[i].ord_ranking_sb = sb_obj[nonwinbids[i].user_id].ranking_weight; 
				if( sb_obj[nonwinbids[i].user_id].status == 'active' ) {
					nonwinbids[i].sponsored_bid = true; 
					addSBStyle(jq('#bid'+nonwinbids[i].id)); 
				} else { 
					nonwinbids[i].sponsored_bid = false;
					removeSBStyle(jq('#bid'+nonwinbids[i].id)); 
				}
			} else {
				nonwinbids[i].sponsored_bid = false; 
				removeSBStyle(jq('#bid'+nonwinbids[i].id)); 
			}
		}
	}
}

function addSBStyle(obj) {
	if( obj.hasClass('sponsored-bid') || obj.hasClass('highlighted-sponsored-bid') ) {
		return true; 
	} else {
		if ( obj.hasClass('highlightBid') ) {
			obj.removeClass('highlightBid').addClass('highlighted-sponsored-bid'); 
		} else { 
			obj.addClass('sponsored-bid');
		}
	}
	var bidinfo = obj.attr('id'); 
	if ( jq('#'+bidinfo+' .sponsored-bid-txt-label').length <= 0 ) {
		jq('#'+bidinfo+' .brsec.top3').append('<div class="sponsored-bid-txt-label">Sponsored Bid</div>');
	}
}

function removeSBStyle(obj) {
	if( obj.hasClass('sponsored-bid') ) {
		obj.removeClass('sponsored-bid'); 
	} else if( obj.hasClass('highlighted-sponsored-bid') ) {
		obj.removeClass('highlighted-sponsored-bid').addClass('highlightBid');
	}
	var bidinfo = obj.attr('id'); 
	if ( jq('#'+bidinfo+' .sponsored-bid-txt-label').length > 0 ) {
		jq('#'+bidinfo+' .sponsored-bid-txt-label').remove(); 
	}
}
