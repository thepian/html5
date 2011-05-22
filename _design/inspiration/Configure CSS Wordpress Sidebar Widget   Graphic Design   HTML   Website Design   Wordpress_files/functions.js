// JavaScript Document
function onResultsRowClick(target){
	document.location = target;
}
function showHideLoginArea(){
	if(document.getElementById('userTypeReturning').checked){
		document.getElementById('userTypeReturningDiv').style.display = '';
		document.getElementById('userTypeNewDiv').style.display = 'none';
	}else{
		document.getElementById('userTypeReturningDiv').style.display = 'none';
		document.getElementById('userTypeNewDiv').style.display = '';
	}
}

function jobTypeCheck(jobSelectLimit){
	
	if(!jobSelectLimit) {
		jobSelectLimit = 5;
	}
	
	var checkedCount = 0;
	var left = 0;
	var rowClass;
	var totalOptions = document.getElementById('jobTypeTotalOptions').value;

	for(i=0;i<=totalOptions;i++){
		if(document.getElementById('jobType_'+i)){
			if(document.getElementById('jobType_'+i).checked == true){
				checkedCount++;
				rowClass = "selected";
			}else{
				rowClass = "normal";
			}
		}
		if(document.getElementById('jobRow_'+i)){
			document.getElementById('jobRow_'+i).className = rowClass;
		}
	}

	left = jobSelectLimit - checkedCount;
	
	document.getElementById('jobTypeCountLeft').innerHTML = left;

	if (left <= 0) {
		for (i=0;i<=totalOptions;i++) {
			if(document.getElementById('jobType_'+i)){
				if (document.getElementById('jobType_'+i).checked == false) {
					document.getElementById('jobType_'+i).disabled=true;
				}
			}
		}
	} else {
		for (i=0;i<=totalOptions;i++) {
			if(document.getElementById('jobType_'+i)){
					document.getElementById('jobType_'+i).disabled=false;
			}
		}
	}
}

function textCounter() {
	var field = document.getElementById('description');
	if (field && field.value) {
		if (field.value.length > 65534)
			// too long, cut out the extra character
			field.value = field.value.substring(0, 65534);
		else {
			// update characters counter
			document.getElementById('textlen').innerHTML = 65534 - field.value.length;
			// check might have to toggle warning display
			if (65534 - field.value.length < 100)
				document.getElementById("text_warning").style.display="";
			else
				document.getElementById("text_warning").style.display="none";
		}
	}
	document.getElementById("text_warning").style.display="none";
}


function showhideJobCat(id){
	showhide(id);
	if(document.getElementById(id).style.display=='none') {
		document.getElementById(id+'_heading').className = "jobCatTitle_closed";
	}else{
		document.getElementById(id+'_heading').className = "jobCatTitle_open";
	}
}

function getUserLink(id, username) {
	return '<a style="color:#0094CC;text-decoration:underline;" target="_blank" href="../users/'+id+'.html">'+username+'</a>'; 
}

function getProjectLink(id, name) {
	return '<a style="color:#0094CC;text-decoration:underline;" target="_blank" href="../projects/'+id+'.html">'+name+'</a>'; 
}

function getAjaxLoadingHTML() {
	return '<img src="../img/ajax-loader.gif" />'; 
}
function getHummingBirdLoadingHTML(bg_color) {
	bg_color = bg_color || '#ffffff'; 
	return '<div style="clear:both;text-align:center;vertical-align:middle;width:100%;padding:15px 0px;background-color:'+bg_color+'"><img src="/img/loading_white_matte.gif" /></div>'; 
}
function loading_html() {
	return '<div style="clear:both;text-align:center;vertical-align:middle;width:100%;padding:15px 0px;"><img src="/img/ajax-loader.gif" /></div>'; 
}

function setCookie(c_name,value,expiredays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +value+((expiredays==null) ? "" : ";expires="+exdate.toUTCString()) + "; path=/";
}

function setCookieToBrowser(cookieName, cookieValue, expiredays, path, domain) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie = cookieName + "=" + escape(cookieValue) +
		( ( exdate ) ? ";expires=" + exdate.toUTCString() : "" ) +
	( ( path ) ? ";path=" + path : "" ) +
	( ( domain ) ? ";domain=" + domain : "" );
}

function getCookie(c_name) {
	if (document.cookie.length>0) {
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1) {
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
				return document.cookie.substring(c_start,c_end);
		}
	}
	return "";
}

function getCookieNameLikes(part_name) {
	if (document.cookie.length>0) {
		var cookieNameArr = []; 
		name_start=document.cookie.indexOf(part_name, 0);
		while (name_start != -1) {
			name_end = document.cookie.indexOf("=", name_start + part_name.length + 1);
			if(name_end == -1)
				break;
			cookieNameArr.push( document.cookie.substring(name_start, name_end).replace('_savedsearch_','') );
			name_start=document.cookie.indexOf(part_name, name_end); 
		}
		return cookieNameArr; 
	}
	return "";
}

function getCookies(part_name) {
	var namesArr = getCookieNameLikes(part_name);
	var i; 
	var cookiesArr = [];
	for(i=0; i<namesArr.length; i++) {
		var cookie = {};
		cookie.name = namesArr[i];
		cookie.value = getCookie(namesArr[i]);
		cookiesArr.push(cookie);
	}
	return cookiesArr;
}

function isObjectEmpty(obj) {
    for(var key in obj)
        return false;
    return true;
}

function isInputInt(i) {
	if(/^[1-9][0-9]*$/.test(i)) {
		return true; 
	}
	return false; 
}

function is_float_format(i) {
	if( /^\d+$/.test(i) || /^\d+\.\d+$/.test(i) ) {
		return true; 
	}
	return false; 
}

function isInputAmount(i) {
	if( /^[0-9]{1,5}\.?[0-9]{0,2}$/.test(i) ) {
		return true;
	}
	return false; 
}

function ordinal_num(num) {
	if(num == 1) {
		return '1st'; 
	} else if(num == 2) {
		return '2nd'; 
	} else if(num == 3) {
		return '3rd'; 
	} else { 
		return num+'th';
	}
}

function format_money(amount) {
	if( !/^\d+(\.)?\d*$/.test(amount) ) {
		return 'wrong format'; 
	}
	var op = new Number(amount); 
	op = op.toFixed(2); 
    return op; 
	//return /\.00/.test(op) ? parseInt(op).toString() : op;  
}

String.prototype.insertAt = function(index, str) {
	var start = this.substring(0, index); 
	var end = this.substring(index); 
	return start+str+end;
} 

/* AUTO INCREASE LANDING PAGE COUNTER */
function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function rpt(rptC, spd, incAmt) {
	var pccomp = jQuery(rptC).text();
	var count = pccomp.replace( /[^0-9]/g,"");
	var rN = Math.ceil(Math.random() * parseInt(spd));
	var newCount = parseInt(count) + parseInt(incAmt); 
    var newAmt2 = addCommas(newCount);
	jQuery(rptC).text(newAmt2); 
    setTimeout(function () {
			rpt(rptC, spd, incAmt); 
			}, rN); 


}
/* END AUTO INCREASE LANDING PAGE COUNTER */

/* showhide.js part */
function showhide(id1) {
	if(document.getElementById(id1).style.display=='none') {
		document.getElementById(id1).style.display='block';
	} else {
		document.getElementById(id1).style.display='none';
	}
}
 
function showdiv(id1) {
	if(document.getElementById(id1))
	document.getElementById(id1).style.display='block';
}
 
function hidediv(id1) {
	if(document.getElementById(id1))
	document.getElementById(id1).style.display='none';
}
 
function ShowHideSelectDeps(field_id) {
  var elem = "field_"+field_id;
  var show = document.getElementById(elem).options[document.getElementById(elem).options.selectedIndex].value;
  var possible_options = document.getElementById(elem).options.length-1;
  for(x=0; x<possible_options; x++) {
    if(x != show | show == "") {
      hidediv(elem+"_option"+x);
    } else {
      showdiv(elem+"_option"+x);
    }
  }
}
 
function ShowHideRadioDeps(field_id, show, dep_field, total_options) {
  var elem = "field_"+field_id;
  for(x=0; x<total_options; x++) {
    if(x != show) {
      hidediv(elem+"_radio"+x);
    } else {
      showdiv(elem+"_radio"+x);
      if(document.getElementById(dep_field)) {
        document.getElementById(dep_field).focus()
	document.getElementById(dep_field).value = document.getElementById(dep_field).value;
      }
    }
  }
}
/* end showhide.js part */ 

/* format part */
function format_int(num, separator) {
	return format_float(num, 0, separator); 
}

function format_float(num, fracDigits, separator) {
	if(!is_float_format(num)) {
		return 'wrong format: '+num; 
	}
	
	num = new Number(num); 
	num = num.toFixed(fracDigits); 
	
	if(!separator) {
		return num; 
	} else {
		var dotpos = num.length; 
		if(fracDigits > 0) {
			dotpos = num.indexOf('.'); 
		}
		
		var out = ''; 
		for(var i=num.length-1; i>=0; i--) {
			
			out = out.insertAt(0, num.charAt(i)); 
			if(dotpos != null && i >= dotpos) {
				continue; 
			}
			
			if( (dotpos-i)%3 == 0 && i != 0 ) {
				out = out.insertAt(0, separator); 
			}
		}
		
		return out; 
	}
}

function format_num_in_mil(num) {
	num = new Number(num); 
	num = num/1000000; 
	
	var out = num.toFixed(1) == parseInt(num).toFixed(1) ? parseInt(num) : num.toFixed(1); 
	return out + ' million'; 
}
/* end of format part */

/**
  * Prepare phone verification error
  */
function preparePhoneVerification(msg) {
	if(/To verify/.test(msg)) {
		return "You must verify your account to perform this action.";
	}
	return msg;
}

function returnProtocol() {
	return window.location.protocol;
}
