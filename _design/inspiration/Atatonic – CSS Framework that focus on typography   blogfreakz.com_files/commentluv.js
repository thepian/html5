// commentluv.js 2.8
(function($) {
	$(document).ready(function(){
		// get form object that is parent of textarea named "comment"
		var formObj = $("#cl_post_title").parents("form");

		// set url, email, comment and author field objects
		var urlObj = cl_settings['urlObj'] = $("input[name='" + cl_settings['url'] + "']",formObj);
		var comObj = cl_settings['comObj'] = $("textarea[name='" + cl_settings['comment'] + "']",formObj);
		var autObj = cl_settings['autObj'] = $("input[name='" + cl_settings['name'] + "']",formObj);
		var emaObj = cl_settings['emaObj'] = $("input[name='" + cl_settings['email'] + "']",formObj);
		// use image or text
		if(cl_settings['badge_text'] == ''){
			cl_settings['badge']='<img src="' + cl_settings['badge'] + '" border=0 alt="' + cl_settings['show_text'] +'"/>';
		} else {
			cl_settings['badge']=cl_settings['badge_text']
		}
		// set the event listener for the comment text area focus
		$(comObj).focus(function(){
			$('#lastposts').hide();
			cl_dostuff();
		});
		// set the event listener for the show more image
		$("#showmorespan").hover(function(){
			// hide drop down box for click outside
			$(document.body).click(function(){
				$('#lastposts').hide();
			});
			$("#lastposts").slideDown(1000);
		});
		// set the event listener for change of url
		$(urlObj).change(function(){
			$(comObj).focus(function(){
				cl_dostuff();
			});
		});
		// set the event listener for the click action
		$('.cluv a').click(function(){
			var url=$(this).attr('href');
			// set link to open in a new window
			$(this).attr("target","_blank");
			var addit= "?type=click&url=" + url + "&callback=?";
			var clurl=cl_settings['api_url'] + addit;
			// call api, don't worry about returned data
			$.getJSON(clurl);
			return true;
		});
		// set the event listener for the click of the checkbox
		$('#doluv').click(function(){
			$('#lastposts').hide();
			if($(this).is(":checked")){
				// was unchecked, now is checked
				$('#mylastpost').fadeTo("fast",1);
				cl_dostuff();
			} else {
				// was checked, user unchecked it so empty hidden fields in form
				$('#cl_post').val("");
				$('input[name="cl_type"]').val("");
				$('input[name="request_id"]').val("");
				$('input[name="choice_id"]').val("");
				$('#mylastpost').fadeTo("slow",0.3);
			}
		});
		// set hover event for heart tip
		if(cl_settings['heart_tip'] == "on"){
			$('.heart_tip_box').hoverIntent({over:heart_big,out: do_nowt,interval : 50,timeout: 50});
		}
		// set click on anywhere closes info box 
		$(document).click(heart_small);
		function heart_big(){
			$("body").append('<span id="heart_tip_big" style="position:absolute; z-index: 101; background-color: ' + cl_settings['infoback'] + '; width: 62px;"><img src="' + cl_settings['images'] + 'loader.gif" alt="Loading" width="62" height="13" /></span>');
			// find where to put left edge of info box (in case at right hand side of screen
			//opera Netscape 6 Netscape 4x Mozilla
			if (window.innerWidth || window.innerHeight){
				docwidth = window.innerWidth;
				docheight = window.innerHeight;
			}
			//IE Mozilla
			if (document.body.clientWidth || document.body.clientHeight){
				docwidth = document.body.clientWidth;
				docheight = document.body.clientHeight;
			}
			var hasarea = docwidth - getAbsoluteLeft(this);
			if(hasarea > 350){
				var xpos = getAbsoluteLeft(this);
			} else {
				var xpos = getAbsoluteLeft(this) - 300;
			}
			if(xpos > (docwidth - 350)){
				xpos = xpos - 320;
			}
			var ypos = getAbsoluteTop(this);
			$('#heart_tip_big').css({'left':xpos + "px", 'top' :ypos + "px" });
			$('#heart_tip_big').hoverIntent({over:do_nowt,out: heart_small, interval : 50, timeout: 350});
			var linkspan = $(this).parents(".cluv");
			var link = $(linkspan).find("a:first").attr("href");
			// get member id from last class of image
			var memberid = $('img',this).attr('class').split(' ').slice(-1);
			if(memberid != ''){
				memberid = '&memberid='+memberid;
			}
			var url = cl_settings['api_url'] + "?type=info&refer=" + cl_settings['refer'] + '&version='+ cl_settings['cl_version'] + memberid + '&callback=?' + "&url=" + link ;
			do_info(url);
		}
		function heart_small(){
			$("body").find("#heart_tip_big").remove();
		}
		function do_nowt(){
			return;
		}


	});

	function getAbsoluteLeft(objectId) {
		// Get an object left position from the upper left viewport corner
		o = objectId;
		oLeft = o.offsetLeft            // Get left position from the parent object
		while(o.offsetParent!=null) {   // Parse the parent hierarchy up to the document element
			oParent = o.offsetParent    // Get parent object reference
			oLeft += oParent.offsetLeft // Add parent left position
			o = oParent
		}
		return oLeft
	}
	function getAbsoluteTop(objectId) {
		// Get an object top position from the upper left viewport corner
		o = objectId;
		oTop = o.offsetTop            // Get top position from the parent object
		while(o.offsetParent!=null) { // Parse the parent hierarchy up to the document element
			oParent = o.offsetParent  // Get parent object reference
			oTop += oParent.offsetTop // Add parent top position
			o = oParent
		}
		return oTop
	}

	function do_info(url){
		$.getJSON(url,function(data){
			$('#heart_tip_big').css("width","350px");
			$('#heart_tip_big').addClass("finalbig");
			var title = data.items[0].title;
			$('#heart_tip_big img').remove();
			$('#heart_tip_big').html(title);
		});
	}
	// *** functions
	// the dostuff function. Fires when comment text area gets focus
	function cl_dostuff(){
		// only fire if checkbox is checked
		if($('#doluv').is(":checked")){
			var check=$(cl_settings['urlObj']).val().toLowerCase();
			// and there is a url provided
			if(!check) { return; }
			if(check.indexOf('http://') < 0) { return;}
			$('#mylastpost img').attr("src",cl_settings['images'] + "loader.gif");
			var url=cl_settings['api_url'] + "?type=request&refer=" + cl_settings['refer'] + "&url="+check+"&version="+ cl_settings['cl_version'] +"&callback=?";
			// do the ajax call
			$.getJSON(url,function(data){
				$('#showmore').show();
				$('#lastposts').empty();
				// get if is a member and other meta data
				var ismember = data.meta[0].ismember;
				if(ismember < 2){
					// uncomment below to only show luv to registered comluv users.
					//$('#mylastpost').html('Only registered comluv users can receive luv');
					//return;
				}
				$('#cl_memberid').val(ismember);
				cl_settings['request_id'] = data.meta[0].request_id;
				cl_settings['alert_message'] = data.meta[0].alert_message;
				// add the returned data to select box (or div)
				$('#lastposts').append(cl_settings['select_text'] + '<br/>');
				$.each(data.items, function(j,item){
					//get image type for this item
					var imageurl = '<img class="cl_type_icon" src="' + cl_settings['images'] + data.items[j]['type'] + '.gif"' + ' alt="' + data.items[j]['type'] + '" border=0 />';
					// construct vars for clchoose function
					var titlestr = data.items[j]['title'];
					// replace single and double quotes with backslash versions (to prevent the onclick=".. from getting split)
					titlestr = titlestr.replace(/\'/g,"\\\'");
					titlestr = titlestr.replace(/\"/g,"\\\'");
					$('#lastposts').append("<span onClick=\"clchoose('" + data.items[j]['type'] + "','" + data.items[j].url + "','" + titlestr + "'," + j + "," + data.meta[0].request_id + ");\"  class=\"choosepost\">" + imageurl + data.items[j]['title'] + "</span>");
				});
				cl_settings['typeimage'] = '<img class="cl_type_icon" src="' + cl_settings['images'] + data.items[0]['type'] + '.gif"' + ' alt="' + data.items[0]['type'] + '" border=0 />';
				$('#mylastpost').html(cl_settings['typeimage'] + ' <a href="' + data.items[0].url +'" title="' + data.items[0]['type'] + '"> ' + data.items[0]['title'] + '</a>').fadeIn(1000);
				$('input[name="request_id"]').val(cl_settings['request_id']);
				$('input[name="choice_id"]').val("0");
				$('input[name="cl_type"]').val(data.items[0]['type']);
				//$('#cl_post').val('<a href="' + data.items[0].url + '">' + data.items[0]['title'] + '</a>');
				$('#cl_post_url').val(data.items[0].url);
				$('#cl_post_title').val(data.items[0]['title']);
			});
			// disable focus event
			$("textarea[name='" + cl_settings['comment'] + "']").unbind();
		}
	}

})(jQuery);

// functions called with onclick (outside scope of above block)
function clchoose(ptype,purl,pstr,pid,preq){
(function($) {
	if(purl == "0"){
		return;
	}
	// set hidden fields in form to hold values for identifying this choice
	$('input[name="choice_id"]').val(pid);
	$('input[name="request_id"]').val(preq);
	$('input[name="cl_type"]').val(ptype);
	$('#mylastpost a').attr("href",purl).text(pstr);
	$('input[name="cl_post_title"]').val( pstr );
	$('input[name="cl_post_url"]').val(purl);
	$('#mylastpost img').attr({src: cl_settings['images'] + ptype + '.gif',alt: ptype});
	if($('#luv').is(":checked")){
		$('input[name="cl_post"]').val('<a href="' + purl + '">' + pstr + '</a>');
	}
})(jQuery);
}

function cl_infolink_click(clickurl){
	(function($){
			// set link to open in a new window
			$('a[href="' + clickurl + '"]').attr("target","_blank");
			var addit= "?type=click&url=" + clickurl + "&callback=?";
			var clurl=cl_settings['api_url'] + addit;
			// call api, don't worry about returned data
			$.getJSON(clurl);
			return true;
	})(jQuery);
}