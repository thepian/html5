var isAnimStopped = true;
var isShake = false;
var  b;
var  aut;
var timer=0;
var isSet=0;

var currentLI = 0;
var lengthLI = 0;

var autoPlayTime=21000;
var currentLI_sub = 0;
var lengthLI_sub = 0;
var autsub;
var first_time_flag=0;

var currentLI_sub_s=0;
var lengthLI_sub_s=0;
var autsub_s;
var first_time_flag_s=0;

var pageLoaded = false;

//Constant to display number of categories (in sets) expanded at a time.
var categorySetLength=1;

//Constant decide whether to use category sets or adjacent categories.
var useCategorySets=false;


//Show Service Details on home page

function showServices(){
	
	if ($('#service_web').hasClass('active')) {
			$('.tab_content').hide();
			if (!$.browser.msie) $('#service_web_featured_proj.tab_content').fadeIn();
			else $('#service_web_featured_proj.tab_content').css('display', 'block');
	}
	else if ($('#service_mobile').hasClass('active')) {
			$('.tab_content').hide();
			if (!$.browser.msie) $('#service_mobile_featured_proj.tab_content').fadeIn();
			else $('#service_mobile_featured_proj.tab_content').css('display', 'block');
	}
	else if ($('#service_android').hasClass('active')) {
		$('.tab_content').hide();
		if (!$.browser.msie) $('#service_android_featured_proj.tab_content').fadeIn();
		else $('#service_android_featured_proj.tab_content').css('display', 'block');
	}
	else if ($('#service_mac').hasClass('active')) {
			$('.tab_content').hide();
			if (!$.browser.msie) $('#service_mac_featured_proj.tab_content').fadeIn();
			else $('#service_mac_featured_proj.tab_content').css('display', 'block');
	}
	else if($('#service_ui').hasClass('active')) {
			$('.tab_content').hide();
			if (!$.browser.msie) $('#service_ui_featured_proj.tab_content').fadeIn();
			else $('#service_ui_featured_proj.tab_content').css('display', 'block');
	}
	else if ($('#service_ipad').hasClass('active')) {
			$('.tab_content').hide();
			if (!$.browser.msie) $('#service_ipad_featured_proj.tab_content').fadeIn();
			else $('#service_ipad_featured_proj.tab_content').css('display', 'block');
	}
	else {
			$('#service_ipad_featured_proj, #service_ui_featured_proj, #service_mac_featured_proj, #service_mobile_featured_proj, #service_web_featured_proj, #service_android_featured_proj').hide();
			if (!$.browser.msie) $('#service_iphone_featured_proj.tab_content').fadeIn();
			else $('#service_iphone_featured_proj.tab_content').css('display', 'block');
	}
}

function showCategoryProjects(){
	var catIdClass = '.cat_'+$('#mac_development').val();
	$('#myslider tr td').hide();
	$('.grid-element').hide();
	if(catIdClass == '.cat_1' || catIdClass == '.cat_9' || catIdClass == '.cat_12'){
		$('#myslider tr td').fadeIn(1200);
		$('.grid-element').fadeIn(1200);
	}
	$(catIdClass).fadeIn(1200);
	$('.grid-view>'+catIdClass).fadeIn(1200);
}

function bubbleEffect(){
	var jqNode = $(".subscribe-input");
	if(isShake){ 
			jqNode.animate({top:"-=15px"},250,'easeOutQuad').animate({top:"+=15px"},250,'easeInQuad');
			timer++;			
		}
}

function slideCarousel(elm, sign) {
	var	currentProductId = 0;
	var no = parseInt(elm.css('left'));
	var nofElms = 160 * 5;

	isAnimStopped = false;
	if(sign == '+') { no += nofElms; }
	else { no -= nofElms; }
	if(no > 0) {
		elm.animate({left:"0px"}, 600, 'easeInQuad', function() {
			isAnimStopped = true;
			setSession(no);
		});	
	}else{
		elm.animate({left:no}, 600, 'easeInQuad', function() {
			isAnimStopped = true;
			setSession(no);
		});	
	}		
}

function autoPlay(){
	currentLI++;
	if(currentLI > lengthLI) { currentLI = 1; }
	
	var currTab = $('#service-menu li:nth-child('+currentLI+')').attr('id');
	$('#service-menu li').each(function(){
			$(this).removeClass('active');
		});
	$('#'+currTab).addClass('active');
	
	if (first_time_flag==0) {					
		first_time_flag=1;			
	} else {
		$('ul.home_subcategory_menu').show(); // aaaaaaaaaaaaaaaaaaa
	}
				
	$('#'+currTab+'_sub').fadeIn(1000);
	//$('#'+currTab+'_sub li:first').mouseup();
	//clearTimeout(autsub);
	currentLI_sub = 0;
	lengthLI_sub = $('#'+currTab+'_sub li').length;
	
	//Disabling the sub-tab animation.
	//autoPlaySub();
		
	aut = setTimeout("autoPlay()", autoPlayTime);
	showServices();
}
/*
function autoPlaySub() {
	currentLI_sub++;		
	if(currentLI_sub <= lengthLI_sub) { 	
		var currTab = $('#service-menu li:nth-child('+currentLI+')').attr('id');
		var currSubTab = $('#'+currTab+'_sub li:nth-child('+currentLI_sub+')');		
		currSubTab.mouseup();
			
		autsub=setTimeout("autoPlaySub()",autoPlayTime/lengthLI_sub);		
	}
}

function autoPlaySub_s() {
	currentLI_sub_s++;
	if(currentLI_sub_s > lengthLI_sub_s) { currentLI_sub_s = 1; }
	
	var currTab = $('#subcategory_menu li:nth-child('+currentLI_sub_s+')');
	currTab.mouseup();
				
	autsub_s = setTimeout("autoPlaySub_s()", autoPlayTime);
}

function selectRandomMenu(){
    var randomnumber=Math.floor(Math.random()*3);
    randomnumber += 1;
    $('#service-menu li:nth-child('+randomnumber+')').addClass('active');
    var menuid = $('#service-menu li:nth-child('+randomnumber+')').attr('id');
    $('#'+menuid+'_featured_proj').fadeIn(1200);
}
*/

/**
 * Return a category-filtered array of myCarousel_itemList.
 */ 
function getCatArray(curCat) {
	var cnt=0;
	var resetCat=0;
	var selRowNumber=-1;
	if ($.trim(curCat)=='') {		
		curCat = $('#subcategory_menu li.subcategory_menu_active a').html();
		resetCat=1;
	}	
	var mycarousel_itemList_categorized=new Array();	
	if (curCat=='' || curCat==null) {	
	} else {
		for (i=0;i<master_itemList.length;i++) {					
		    if (master_itemList[i].catName.indexOf(curCat)!=-1) {		    	
		    	mycarousel_itemList_categorized[cnt]=master_itemList[i];
		    			    			   
		    	if (master_itemList[i].divClass.indexOf('selected')!=-1) {
		    		selRowNumber=cnt;
		    		if (resetCat==1) {
		    			mycarousel_itemList_categorized[cnt].divClass=mycarousel_itemList_categorized[cnt].divClass.replace('selected','');		    			
		    		}
		    	}
		    	cnt++;
		    }    	
		}
		if (resetCat==1) {
			mycarousel_itemList_categorized[0].divClass=mycarousel_itemList_categorized[0].divClass + ' selected';
		}
	}
	mycarousel_itemList=mycarousel_itemList_categorized;
	return selRowNumber;
}

/**
 * Function to attach backgrounds to the subcategories
 */
function attachbackgrounds_p() {
	$('#subcategory_menu li').each(function(){
		var bg_img=$(this).attr('title');
		$(this).find('a').css('background','url(../images/buttons/'+bg_img+') no-repeat 5px 0');
		$(this).attr('title','');
	});
	/**
	 * Hide excess categories and store actual widths in data.
	 */		
	$('#subcategory_menu li a').each(function(){	
		$(this).data('width',$(this).css('width'));		
	});
	//for (i=0;i<categorySetLength;i++) {
		//$('#subcategory_menu li:eq('+i+') a').addClass('expanded');
	//}
	//if (!$.browser.msie) {
		//$('#subcategory_menu li a').not('.expanded').css('width','1px');
	//}
	//$('#subcategory_menu li a').not('.expanded').css('text-indent','-9999px').parent().addClass('condensed');
}


/**
* Set flanking lis for the hover li
*/

function setFlanks(lid) {
	var id = lid.split('_')[1];	
	if ((id > 4) && (id < 10)) {
		$('#lid_' + (id-1)).addClass('flankl');
		$('#lid_' + (id+1)).addClass('flankr');
	}
}

/**
* Set flanking lis for the hover li
*/

function removeFlanks(lid) {
	var id = lid.split('_')[1];	
	if ((id > 4) && (id < 10)) {
		$('#lid_' + (id-1)).removeClass('flankl');
		$('#lid_' + (id+1)).removeClass('flankr');
	}
}


/**
 * Function to toggle category text (hover effect)
 */
function toggleSubcat(curCat) {
	  	currentCatIndex=$('#subcategory_menu li').index(curCat);	  		
	  	var curLink=$('#subcategory_menu li:eq('+currentCatIndex+') a');
  		//var curLinkBefore=$('#subcategory_menu li:eq('+(currentCatIndex-1)+') a');
	  	//var curLinkAfter=$('#subcategory_menu li:eq('+(currentCatIndex+1)+') a');
	  	
	  	$('#subcategory_menu li').each(function(){
	  		if ($(this).find('a')!=curLink) {	  			
		  		//$(this).find('a').css('text-indent','-9999px');
		  		if (!$.browser.msie) {
		  			$(this).css('width',$(this).data('width'));
		  		}
	  		}
	  	});
	  			  				  
		if (!$.browser.msie) {
  			$('#subcategory_menu li a.expanded').stop().animate({
  				width: '1px'
			},500, function() {
				liAnimating = false;
			});
		}		  	 
	  						  				  	
	  	$('#subcategory_menu li a.expanded').removeClass('expanded').parent().addClass('condensed');
	  	
  		var curWidth=curLink.data('width');
  		//var curBeforeWidth=curLinkBefore.data('width');
	  	//var curAfterWidth=curLinkAfter.data('width');
	  		
  		curLink.css('text-indent','0');
  		curLink.css('opacity','0');
  		//curLinkBefore.css('text-indent','0');
	  	//curLinkAfter.css('text-indent','0');
  		if (!$.browser.msie) {  			
			curLink.stop().animate({
		  		width: curWidth,
		  		opacity: 1
		  	},500, function() {
				liAnimating = false;
			});
  		}  		
	  	curLink.addClass('expanded').parent().removeClass('condensed');
	  	//curLinkBefore.addClass('expanded').parent().removeClass('condensed');
	  	//curLinkAfter.addClass('expanded').parent().removeClass('condensed');
					
}

function popUp(URL) {
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=570,height=500,left = 630,top = 175');");
}

liAnimating = false;


$(document).ready(function(){
	
//	$.preloadCssImages();

	$('.right').css({position:"relative",top:"0px",right:"0px"});
	
	
	$('#service-menu li').livequery(function(){
		
		$(this).click(function() {
			
			if (!$.browser.msie) {			
				$('#service-menu li').each(function(){
					$(this).removeClass('active');
					$(this).find('a').stop().animate({opacity: 1});
					$(this).find('span').stop().animate({opacity: 0});
				});
				$(this).addClass('active');
				$(this).find('span').stop().animate({opacity: 1});
				$(this).find('a').stop().animate({opacity: 1});
				var mainId   = $(this).attr('id');
				$('div.proj').hide();
				var imgdiv = $('#'+mainId+'_projs div[title=all]').find('div.left');
				var imgsrc = imgdiv.find('span.imgsrc').html();
				if (imgsrc != '' && imgsrc != null) {
					if ($(imgdiv).find('a span.ajax_loader').attr('title') != "Loading")
					{
						$(imgdiv).find('a').append('<span class="ajax_loader" title="Loading"></span>');					
						var imgalt=imgdiv.find('span.imgalt').html();
						var imgtitle=imgdiv.find('span.imgtitle').html();			
						var prjimg=new Image();			
						$(prjimg).load(function(){				
							$(this).hide();
							//imgdiv.find('a').append(this);			
							//imgdiv.find('span').remove();
							$(this).fadeIn('fast');				
						});
						$(prjimg).attr('src',imgsrc);
						$(prjimg).attr('alt',imgalt);
						$(prjimg).attr('title',imgtitle);
					}
				}
				$('#'+mainId+'_projs div[title=all]').fadeIn(500);
			}
			else {
				$('#service-menu li').each(function(){
					//alert(this.id);
					//$(this).removeClass('active');
					$('#'+this.id).removeClass('active');
					//$(this).find('span').stop().animate({opacity: 0});
					//$(this).find('a').stop().animate({opacity: 1});
					//$(this).find('a').css({'visibility':'visible'});
					//$(this).find('span').css({'visibility':'hidden'});
				});
				//alert($('.active').attr('id'));
				$(this).addClass('active');
				//$(this).find('span').css({'visibility':'visible'});
				//$(this).find('a').css({'visibility':'visible'});

				var mainId   = $(this).attr('id');
				$('div.proj').css("display", "none");	
				var imgdiv = $('#'+mainId+'_projs div[title=all]').find('div.left');
				var imgsrc = imgdiv.find('span.imgsrc').html();
				if (imgsrc != '' && imgsrc != null) {
					if ($(imgdiv).find('a span.ajax_loader').attr('title') != "Loading")
					{
						$(imgdiv).find('a').append('<span class="ajax_loader" title="Loading"></span>');					
						var imgalt=imgdiv.find('span.imgalt').html();
						var imgtitle=imgdiv.find('span.imgtitle').html();			
						var prjimg=new Image();			
						$(prjimg).load(function(){				
							$(this).css("display", "none");	
							//imgdiv.find('a').append(this);			
							//imgdiv.find('span').remove();
							$(this).css("display", "block");		
						});
						$(prjimg).attr('src',imgsrc);
						$(prjimg).attr('alt',imgalt);
						$(prjimg).attr('title',imgtitle);
					}
				}
				$('#'+mainId+'_projs div[title=all]').css("display", "block");
			}		
			
			showServices();
			clearTimeout(aut);
		});

		/*$(this).find('a').hover(
			function() {
				$(this).animate({backgroundPosition: '0 -421px'});
			},
			function() {
				$(this).animate({backgroundPosition: '0 -70px'});
			}
		);*/
	
	});

	
	$('li.proj_icon').livequery('click', function(){
		$('div.proj').hide();
		$(this).parent().parent().addClass('active');
		var id = $(this).attr('id');
		var imgdiv = $('#service_'+id).find('div.left');
		var imgsrc = imgdiv.find('span.imgsrc').html();
		if (imgsrc != '' && imgsrc != null) {
			if ($(imgdiv).find('a span.ajax_loader').attr('title') != "Loading")
			{
				$(imgdiv).find('a').append('<span class="ajax_loader" title="Loading"></span>');					
				var imgalt=imgdiv.find('span.imgalt').html();
				var imgtitle=imgdiv.find('span.imgtitle').html();			
				var prjimg=new Image();			
				$(prjimg).load(function(){				
					$(this).hide();
					imgdiv.find('a').append(this);			
					imgdiv.find('span').remove();
					$(this).fadeIn('fast');				
				});
				$(prjimg).attr('src',imgsrc);
				$(prjimg).attr('alt',imgalt);
				$(prjimg).attr('title',imgtitle);
			}
		}
		$('#service_'+id).fadeIn(500);
		return false;
	});


	$('.home_subcategory_menu li').livequery('mouseup',function(){
		
		$('.home_subcategory_menu li').each(function(){
			$(this).removeClass('active');
		});
		$(this).addClass('active');

		var currSubTabCat = $(this).find('a').html();		
		var currTab=$(this).parent().attr('id').split('_sub');
		var featured_proj = currTab[0]+'_featured_proj';
		$('.content-inner>div').hide();
		
		/**
		 * Toggle categories code used to be here.
		 */
		
		/**
		 * Load images dynamically.
		 */
		var imgdiv = $('div[id*=' + featured_proj + '][title="'+currSubTabCat+'"] div.left');
		var imgsrc=imgdiv.find('span.imgsrc').html();		
		if (imgsrc!=''&&imgsrc!=null) {
			//Don't load twice
			if ($(imgdiv).find('a span.ajax_loader').attr('title')!="Loading")
			{
				$(imgdiv).find('a').append('<span class="ajax_loader" title="Loading"></span>');					
				var imgalt=imgdiv.find('span.imgalt').html();
				var imgtitle=imgdiv.find('span.imgtitle').html();			
				var prjimg=new Image();			
				$(prjimg).load(function(){				
					$(this).hide();
					imgdiv.find('a').append(this);			
					imgdiv.find('span').remove();
					$(this).fadeIn('fast');				
				});
				$(prjimg).attr('src',imgsrc);
				$(prjimg).attr('alt',imgalt);
				$(prjimg).attr('title',imgtitle);
			}
		}
		$('div[id*=' + featured_proj + '][title="'+currSubTabCat+'"]').fadeIn(500);		
	});
	
	$('.jcarousel-item').click(function(){
		var projId = $(this).attr('id');
		projId = '#'+projId+'_div';
		$('#project_container>div').hide();
		$(projId).fadeIn(1200);
	});

	//jQuery.TTcombo();
	//jQuery.TTcomboSer();
	

	 $('#msg_subject li').livequery('click',function(){
	 	$('#content_title').html($(this).attr("title"));
	 	var msgid = $(this).attr('id');
	 	var title = $(this).attr('title');
	 	$('#cont_input').val(title);
	 	$('#cont').val(title);
	 	$('.combo_list_item li').removeClass('selected');
	 	$('#cont_input_'+msgid).addClass('selected');
	 	//hideCallBack();
	 });
	 
	$('#contact_reset').click(function(){
		$('div#main_form :input').val('');
		$('#cont_input').val('Choose a subject');		
	});

	$('#career_reset').click(function(){
		$('div#main_form :input').val('');
		$('#cont_input').val('Choose a job');
		return false;
	});

	$("#subsc_email_id").livequery('click', function() {
		
		$('#err').html('');
		$('#subscribe').css({background: "none"});
	    var menu = $('#' + $(this).attr('id').replace('_id', '_input'));
	    if (!menu.is("visible")) {
            $("#subsc_email_input").fadeOut("fast");
            menu.fadeIn("fast");
            isShake = true;
			bubbleEffect();       	   
	    } else {
	    	isShake = false;
	    	menu.fadeOut("fast");
	    }
		return false;
    });
    
    $('#subsc_email_input').livequery('click', function(e) {
    	if($.browser.msie){
    		window.event.cancelBubble = true;
    	}else{
    		e.stopPropagation();
    	}
    });
   
	$('.subscribe-input').livequery('click',function(){
		$(this).fadeIn('fast');
    });

	$(document).bind('click',function() {
        $(".subscribe-input").fadeOut("fast");
    });

	$('#grid_icon').click(function(){
		$('#gal_view').hide();
		$('.grid-view').fadeIn(1200);
		$(this).hide();
		$('#gal_icon').fadeIn(1200);
		$('#icon_text').html('Gallery View');
		if ($('#projectspage').hasClass('container')) {
			$('#subcategory_menu li.subcategory_menu_active').mouseup();
		}				
	});


	$('#gal_icon').click(function(){
		$('.grid-view').hide();
		$('#gal_view').fadeIn(1200);
		$('.launchgallery').css({opacity:"1",filter:"alpha(opacity=100)"});
		$(this).hide();
		$('#grid_icon').fadeIn(1200);
		$('#icon_text').html('Grid View');
		$('#gal_view').css({height:"auto",overflow:""});
		$('.thumbs').css({height:"150px",overflow:""});							      
		if(isSet==0){						
			setCarousel();
			isSet=1;
		}
		if ($('#projectspage').hasClass('container')) {
			getCatArray();    
			myCarousel.reset();		
			clearTimeout(autsub_s);		
			var prjid=$('ul#mycarousel div[id*=proj_]:first').attr('id').slice(5);
			$('ul#mycarousel div[id*=proj_]').removeClass('selected');
			$('ul#mycarousel div[id*=proj_]:first').addClass('selected');				
			getProject(prjid);
		}
	});
/*
	 $('#callback_btn').click(function(){
	 	$('#success_msg_contact').addClass('hide');
	 	$('#content_title').html('Request a Callback');
	 	showCallBack();
	 });
	 $('.close-icon').click(function(){
	 	$('#content_title').html('Contact us');
	 	hideCallBack();
	 });
*/	 		
	// If we are not on home page, load Google Analytics code dynamicallt
	if ($('#jsincludes').length > 0) {
		//setTimeout(function() { $.getScript(scriptLocation+'includes.js'); }, 100);

		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");

		var gac = document.createElement('script');
		gac.type = 'text/javascript';
		gac.src = gaJsHost + 'google-analytics.com/ga.js';

		document.getElementById('jsincludes').appendChild(gac);

		try { var pageTracker = _gat._getTracker("UA-1489692-1"); pageTracker._trackPageview(); } catch(err) {}

	}

	var timer;
  	/*$(".get-menu, #sub-menu, #about_sub_menu").hover(
		function(){
  			if($(this).hasClass('get-menu')){
  				return;
  			}
			$("#header_main_menu li").removeClass('hover');
  			if($(this).hasClass('active')){
  				$(this).addClass('hover');
	  	  		$(this).fadeIn(500);
  			} else {  				
  				$(this).hide();
  				$(this).addClass('hover');
  			}
  			clearTimeout(timer);  					  	  
  		},
  		function(e) {	  			  		
  			if($(this).hasClass('get-menu')) {
  				e.stopPropagation();
  				//clearTimeout(a)
  				return;
  			} else {
  				var id = $(this).attr('id');
  				timer = setTimeout(function() {$('#'+id).removeClass('hover'); }, 1100);		  		
  			}
  		}
  	);*/
	
	/*$("#header_main_menu li").hover(
		function(){
			$(this).removeClass('hover');
  			if($(this).hasClass('active')){
  				$(this).addClass('hover');
	  	  		$(this).find('.fleximenu').fadeIn(500);
  			} else {
  				$(this).addClass('hover');
  				$(this).find('.fleximenu').fadeIn(500);
  			}
  		},
  		function(){	  			  		
			$(this).find('.fleximenu').fadeOut(500);
			$(this).removeClass('hover');
  		}
  	);*/
	
	//$("#header_main_menu li.t_menu").append("<span></span>");
	
	/*$("#header_main_menu li.t_menu a").hover(
			function () {
				$(this).next().stop().animate({
					opacity: 1
				}, 400);
			},
			function () {
				$(this).next().stop().animate({
					opacity: 0
				}, 400);
			}
		);*/
		
	
	$("#header_main_menu li.t_menu").hover(
		function(){
			var li = $(this);
			var fade = $('> .fleximenu', this);
			var fadebg = $('> .menu-selection', this);
			if ($(this).hasClass('active')){
				if (!$.browser.msie) {
					if (fade.is(':animated')) {
						fade.stop().fadeTo(400, 1, function(){li.addClass('hover'); fade.fadeIn(500);});
					} else {
						fade.fadeIn(200);
						$(this).addClass('hover');
					}
				}
				else {
					fade.css('display', 'block');
					$(this).addClass('hover');
				}
			}else{
				if (!$.browser.msie) {
					if (fade.is(':animated') || fadebg.is(':animated')) {
						fade.stop().fadeTo(100, 1, function(){li.addClass('hover'); fade.fadeIn(100);});
						fadebg.stop().fadeTo(100, 1, function(){li.addClass('hover'); fadebg.fadeIn(100);});
					} else {
						fade.fadeIn(100);
						fadebg.fadeIn(100);
						$(this).addClass('hover');
					}
				}
				else {
					fade.css('display', 'block');
					fadebg.css('display', 'block');
					$(this).addClass('hover');
				}
			}
  		},
  		function(){
  			var fade = $('> .fleximenu', this);
  			var fadebg = $('> .menu-selection', this);
  			if ($(this).hasClass('active')){
  				if (!$.browser.msie) {
		  			if (fade.is(':animated')) {
		  				fade.stop().fadeTo(100, 0, function(){fade.removeAttr("style");});
		  			} else {
		  				fade.fadeOut(100);
		  			}
					$(this).removeClass('hover');
	  			}
	  			else {
	  				fade.fadeOut(100);
	  				$(this).removeClass('hover');
	  			}
  			}else{
	  			if (!$.browser.msie) {
		  			if (fade.is(':animated') || fadebg.is(':animated')) {
		  				fade.stop().fadeTo(100, 0, function(){fade.removeAttr("style");});
		  				fadebg.stop().fadeTo(100, 0, function(){fadebg.removeAttr("style");});
		  			} else {
		  				fade.fadeOut(100);
		  				fadebg.fadeOut(100);
		  			}
					$(this).removeClass('hover');
	  			}
	  			else {
	  				fade.fadeOut(100);
	  				fadebg.fadeOut(100);
	  				$(this).removeClass('hover');
	  			}
  			}
  		}
  	);
	
	
	//$(".fleximenu li span.header_submenu").hover(
	$(".fleximenu li").hover(
		function(){
			$(this).addClass('hs_hover');
  			if($(this).hasClass('active') || $(this).hasClass('hs_hover')){
	  	  		$(this).find('.get-menu').fadeIn(500);
  			} 
  		},
  		function(){	  			  		
			var li = $(this);
			li.find('.get-menu').fadeOut(1500, function(){
				$(this).removeAttr("style");
				li.removeClass('hs_hover');
			});
  		}
  	);
	
	$(".get-quote").hover(
		function(){
			var fade = $('#quote-nav');
			if (fade.is(':animated')) {
				fade.stop().fadeTo(500, 1);
			} else {
				fade.fadeIn(500);
			}
  		},
  		function(){
  			var fade = $('#quote-nav');
  			if (fade.is(':animated')) {
  				fade.stop().fadeTo(500, 0, function(){fade.removeAttr("style");});
  			} else {
  				fade.fadeOut(500);
  			}
  		}
	);

  	/*$('.wrap').mouseup(function() {
  		$('.get-menu, #sub-menu, #about_sub_menu').removeClass('hover');
  		$('.get-menu').removeClass('showmenu');
  		$('.fleximenu-cont ul li').removeClass('hs_hover');
  		$(".quote-nav-cont").hide();
  	});
  	
  	$('#about_sub_menu').mouseenter(function() {
  		$('.get-menu, #sub-menu').removeClass('hover');
  		$('.get-menu').removeClass('showmenu');
  		$('.fleximenu-cont ul li').removeClass('hs_hover');
  	});
  	*/
  	  	
	// set opacity to nill on page load
	$("span.anim").css("opacity","0");
	
	// on mouse over
	$(".grid-element img").hover(
		function () {
			$(this).parent().parent().find("span.anim").stop().animate({
				opacity: 1
			}, 'fast');
		},
		function () {
			$(this).parent().parent().find("span.anim").stop().animate({
			opacity: 0
		}, 'slow');
	});
	
	// on mouse over
	
										
															
	/** Handles mouseover of subcategories  **/
	
	$('#subcategory_menu li').hover(function() {
		
			if (liAnimating) { return; }
		   liAnimating = true;
					
	  }, function() {
			if (liAnimating) { return; }
		    $(this).removeClass('subcategory_menu_hover');
		    
	});
	  
	$('#subcategory_menu li').mouseup(function(ev) {			  				  	    	  
		  $('#subcategory_menu li').removeClass('subcategory_menu_active');
		  $("#subcategory_menu li .subcat_l, #subcategory_menu li .subcat_r").remove();       
		  
		  if (!pageLoaded) {
			  $(this).addClass('subcategory_menu_active');
			  pageLoaded = true;
		  }
		  
		  $(this).append("<span class='subcat_l'></span><span class='subcat_r'></span>");		  		  	
		  
		  var catTitle=$(this).find('a').find('span').html();  // span added for slider in services page
		  if ($.trim($('div.inner-av div:visible').text())=='Grid View') {
			getCatArray();    				
			myCarousel.reset();
			
			//If same project is being displayed no need to re-load.
			if($('ul#mycarousel div[id*=proj_][class*=selected] a img').attr('title')==$('#project_container .right h2').html()) {						
			} else {										
				var prjid=$('ul#mycarousel div[id*=proj_]:first').attr('id').slice(5);
				$('ul#mycarousel div[id*=proj_]').removeClass('selected');
				$('ul#mycarousel div[id*=proj_]:first').addClass('selected');				
				getProject(prjid);				
			}										  					
		  }	else {
		  	if (first_time_flag_s==0) {					  		
		  		
		  		if (catTitle=='all') {
		  		} else {
		  		$('div[id*=row_][class*=project]').not('[title*="'+ catTitle +'"]').hide();	
		  		}
		  		
				first_time_flag_s=1;
			} else {			
				$('div[id*=row_][class*=project]').hide();
				//$('div[id*=row_][class*=project][title*="'+ catTitle +'"]').fadeIn(1000); dhaval
				
				if (catTitle=='all') {
					$('div[id*=row_][class*=project]').fadeIn(1000);
					} else {
					$('div[id*=row_][class*=project][title*="'+ catTitle +'"]').fadeIn(1000);
				}
			}							  
		  }			  
	
		  if (ev.which==1) {
		  	clearTimeout(autsub_s);
		  }
	});
		
	//$('#subcategory_menu li a').click(function() {
	//	return false;
	//});
	
	/*
	 * If on the service page.
	 */	
	if ($('#projectspage').hasClass('container')) {
		
		/*
		 * Filter projects according to categories.
		 */
		if ($.trim($('div.inner-nav div:visible').text())=='Grid View') {		
			for (i=0;i<mycarousel_itemList.length;i++)
			{
				if (mycarousel_itemList[i].divClass.indexOf('selected')!=-1) break;			
			}
			if ($.trim($('#selected_category').html())=='') {
				var currentCat=mycarousel_itemList[i].catName;
			} else {
				var currentCat=$.trim($('#selected_category').html());
			}					
			$('#subcategory_menu li a').each(function(){			
				if (currentCat.indexOf($(this).html())!=-1) {							
					$('#subcategory_menu li').removeClass('subcategory_menu_active');
				  	$("#subcategory_menu li .subcat_l, #subcategory_menu li .subcat_r").remove();       
				  	$(this).parent().addClass('subcategory_menu_active');
				  	$(this).parent().append("<span class='subcat_l'></span><span class='subcat_r'></span>");			  				  			  	
			  		var scrTo=getCatArray(currentCat);
			  		myCarousel.reset();
			  		myCarousel.scroll(scrTo+1,0);
			  		return false;
				}
			});
		} else if ($.trim($('div.inner-nav div:visible').text())=='Gallery View') {	
			var curSelCat=$('#current_category').html();			
			if (curSelCat==''||curSelCat==null) {			
				lengthLI_sub_s = $('#subcategory_menu li').length;
				//Autoplay disabled.
				//autoPlaySub_s();
				$('#subcategory_menu li:first').mouseup();				
			} else {					
				$('#subcategory_menu li.subcat_'+curSelCat).mouseup();
				toggleSubcat($('#subcategory_menu li.subcat_'+curSelCat));					
			}
		}
			
	}
/*
	$('.home_subcategory li a span, #subcategory_menu li a span').hide();
	$('#service_iphone li:eq(0) a span, #service_mac_sub li:eq(0) a span, #service_tech_sub li:eq(0) a span, #service_web_sub li:eq(0) a span, #service_ui_sub li:eq(0) a span').show();
	
	$('.slidermenu li').hover(
			function(){
				var w = parseInt($(this).width());
				if (w == 140) { return; };
				$('.slidermenu li a span').hide();
				$(this).find('span').fadeIn(700);		
			},
			function(){
				$(this).find('span').show();
			}
	);
	
	$('#service_iphone_sub li').hover(
			function(){
				var w = parseInt($(this).width());
				if (w == 140) { return; };
				$('#service_iphone_sub li a span').hide();
				$(this).find('span').fadeIn(600);		
			},
			function(){
				$(this).find('span').show();
			}
	);
	
	$('#service_mac_sub li').hover(
			function(){
				var w = parseInt($(this).width());
				if (w == 140) { return; };
				$('#service_mac_sub li a span').hide();
				$(this).find('span').fadeIn(600);		
			},
			function(){
				$(this).find('span').show();
			}
	);
	
	$('#service_tech_sub li').hover(
			function(){
				var w = parseInt($(this).width());
				if (w == 140) { return; };
				$('#service_tech_sub li a span').hide();
				$(this).find('span').fadeIn(600);		
			},
			function(){
				$(this).find('span').show();
			}
	);
	
	$('#service_web li').hover(
			function(){
				var w = parseInt($(this).width());
				if (w == 140) { return; };
				$('#service_web li a span').hide();
				$(this).find('span').fadeIn(600);		
			},
			function(){
				$(this).find('span').show();
			}
	);
	
	$('#service_ui li').hover(
			function(){
				var w = parseInt($(this).width());
				if (w == 140) { return; };
				$('#service_ui li a span').hide();
				$(this).find('span').fadeIn(600);		
			},
			function(){
				$(this).find('span').show();
			}
	);
	
	*/
	 
	/*
	 * to show & hide the Quote Menu
	 */
	/*var t;

	$('.show_quotes, #quote-nav').hover(
			function () {
			$('.quote-nav-cont').show();
			clearTimeout(t)
			},
			function () {
				t = setTimeout(function() { $(".quote-nav-cont").hide(); }, 1100);
			}
	);	
	*/
	
	/*
	 * Home services sub menu show/hide
	 */
	/*$(".header_submenu").click(function(){
		clearTimeout(lastitem)
		$('.get-menu').removeClass('showmenu');
		$(this).next().addClass('showmenu');
	});
	*/
	/*
	$('.get-menu, #sub-menu ul').mouseleave(function(){
		$('.get-menu').removeClass('showmenu');
	});
*/
	/*$(".fleximenu ul li").livequery('mouseover', function(){
		var id = $(this).find('span').attr('id');
		setTimeout(function() { $("#"+id).trigger('click'); }, 1100);
		clearTimeout(lastitem)
	});*/
	
	/*$(".fleximenu ul li").livequery('mouseout', function(){
		var id = $(this).find('span').attr('id');
		setTimeout(function() { $("#"+id).next().removeClass('showmenu'); }, 1100);
	});

	*/
	/*
	 * hover state for services menu arrow 
	 */	
	$(".header_submenu").addClass('hs_active');
	var lastitem;
	$(".fleximenu-cont ul li").hover(
			function(){
				$(".fleximenu-cont ul li").removeClass('hs_hover');
				$(this).addClass('hs_hover');
			},
			function(){
				if ($(this).hasClass('last')){
					lastitem = setTimeout(function() {$(".fleximenu-cont ul li:last-child").removeClass('hs_hover'); }, 1100);
				}else{
					$(this).removeClass('hs_hover');
				}
			}
	);
	
	// live chat hover state	
	$("#sb_footer a img").hover(
			function () {
				if($(this).attr("src")=="http://www.sourcebits.com/images/buttons/onlinechat.png"){
					$(this).attr({src: "http://www.sourcebits.com/images/buttons/onlinechat-vr.png"});
				}
				else
				{
					$(this).attr({src: "http://www.sourcebits.com/images/buttons/offlinechat-vr.png"});
				}
			},
			function () {
				if($(this).attr("src")=="http://www.sourcebits.com/images/buttons/onlinechat-vr.png"){
					$(this).attr({src: "http://www.sourcebits.com/images/buttons/onlinechat.png"});
				}
				else
				{
					$(this).attr({src: "http://www.sourcebits.com/images/buttons/offlinechat.png"});
				}
			}
		);	
	
	//Service HOME Animated Menu
	
	$("#service-menu li a").hover(
		function() {
			if(!$(this).parent().hasClass("active")){
				if (!$.browser.msie) {			
					$(this).stop().animate({opacity: 1}, 800);
					$(this).next().stop().animate({opacity: 1});
				}
				else {
					$(this).css("display", "block");
					$(this).next().css("display", "block");
				}
			}
		}, function() {
			if(!$(this).parent().hasClass("active")){
				if ($(this).is(":visible")){
					if (!$.browser.msie) {	
						$(this).stop().animate({opacity: 1});
						$(this).next().stop().animate({opacity: 0}, 800);
					}
					else {
						$(this).css("display", "block");
						$(this).next().css("display", "none");
					}
				}
			}
		}
	);

	$("#service-menu li span").mouseout(function() {		
		if(!$(this).parent().hasClass("active")){
			if (!$.browser.msie) {	
				$(this).stop().animate({opacity: 0});
				$(this).prev().stop().animate({opacity: 1});
			}
			else {
				$(this).css("display", "none");
				$(this).prev().css("display", "block");
			}
		}
	});
	
	
	// Services page Animated Menu
	
	$(".leftnav .category-menu ul li a, .leftnav .sub-category-menu ul li a").hover(
		function () {
			if (!$.browser.msie) {	
				$(this).prev().stop().animate({
					opacity: 1
				}, 400);
			}else{
				$(this).parent().addClass('iehover');
			}
		},
		function () {
			if (!$.browser.msie) {	
				$(this).prev().stop().animate({
					opacity: 0
				}, 400);
			}else{
				$(this).parent().removeClass('iehover');
			}
		}
	);
	
	$(".leftnav .category-menu ul li a, .leftnav .sub-category-menu ul li a").click(
			function () {
				$('.leftnav .category-menu ul li').removeClass('active');
				$(this).parent().addClass('active');
			}
		);
	
	// Coverflow fade Overlay
	$('.map_india, .map_us').click(function(){
		//$('#overlay').fadeIn(1200);
	});
	
	// career page
	$('.job_title, .job_details').hide();
	$('#list_job li').removeClass('active');
	$('#list_job li').click(function(event) {
        var job_id = event.target.id;
        $('#list_job li').removeClass('active');
		$(this).addClass('active');
		$('#job_description').html($('#'+job_id+'_description').html());
		$('#job_title').html($('#'+job_id+'_title').html());
	});
	
	$(".filestyle").parent().addClass("button-choose-file").css({"background-position" : "right top", "margin-top" : "5px"});
	$(".filestyle").hover(function(){
		$(".button-choose-file").css({"background-position" : "right -24px"});
	}, function(){
		$(".button-choose-file").css({"background-position" : "right top"});
	});
	
	
	
	/* Provider Support Code Starts -- DO NOT DELETE*/
	
	/*var sto = setTimeout(function() {
		$('#providesupport').append("<div id='cipI7l' style='z-index:100;position:absolute'></div><div id='scpI7l' style='display:inline'></div><div id='sdpI7l' style='display:none'></div><div style='display:inline'><a href='http://www.providesupport.com?messenger=sourcebits'>Customer Service</a></div></noscript>");
		var sepI7l = document.createElement('script');
		sepI7l.type='text/javascript';
		var sepI7ls=(location.protocol.indexOf('https')==0?'https':'http')+'://image.providesupport.com/js/sourcebits/safe-standard.js?ps_h=pI7l\u0026ps_t='+new Date().getTime()+'\u0026online-image=http%3A//www.sourcebits.com/images/buttons/onlinechat.png\u0026offline-image=http%3A//www.sourcebits.com/images/buttons/offlinechat.png';
		setTimeout(function() {
			sepI7l.src=sepI7ls;document.getElementById('sdpI7l').appendChild(sepI7l);	
		},1);
	}, 1000);
	*/
	/* Provider Support Code Ends */
	
	/*var internal_link = location.host;
	//alert (internal_link);
	//var internal_link = 'http://www.sourcebits.com';
	//alert($('a').length);
	$('a').each(function() {
		var url = $(this).attr('href');
		var url_length = url.indexOf('sourcebits.com');
		//url.split('.',)
		//alert(url);
		//var link_domain_name = 'http://www.sourcebits.com';
		if(url_length == -1 ){
			$(this).attr('rel' , 'nofollow');
		}
	});*/
	
	
	
	
	// Background change request
	
	
	/*	$("select#bg_change").change(function () {
          var str = "";
          $("select#bg_change option:selected").each(function () {
                str += $(this).attr('value');
              });
          $("body").removeClass();  
          $("body").addClass(str);
          
        })
        change();
	 */
		// remove last breadcrum bg
		function removebreadcrumbbg(){
			if ($.browser.msie) {
			$('.breadcrumb li:last-child').css('background', 'none');
			
			}
		}
		
		removebreadcrumbbg();
		
		
			$('#play_video').click(function(){
				$(this).append('<iframe src="http://player.vimeo.com/video/13446780?title=0&amp;byline=0&amp;autoplay=1&amp;portrait=0&amp;color=ffffff" width="492" height="277" frameborder="0"></iframe>');
			});
			
			$('#testimonial_video').click(function(){
			    $(this).find('#testimonial_video_holder').append('<iframe src="http://player.vimeo.com/video/20050729?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff&amp;autoplay=1" width="360" height="480" frameborder="0"></iframe>');
			});
			
		// remove reflection on 1st bigger image
			var img_count = $('#project_container_href img').length;
			var img_width = $('#project_container_href img').width();
			if(img_count > 1 && img_width > 280){
				$('#project_container_href img:last-child').addClass('ref');
			}else{
				$('#project_container_href img').addClass('ref');
			}

		// replace target='_blank'
			$('a.new-window').click(function(){
		        window.open(this.href);
		        return false;
		    });

			
});