$(document).ready(function(){
	$("#cat-design").hide();
	$("#cat-home").hide();
	$("#cat-dlink a").click(function() {
        $(this).toggleClass("sel");
        $("#cat-design").slideToggle();
        $("#cat-home").hide();
        return false; 
   	});
   	$("#cat-hlink a").click(function() {
   		$(this).toggleClass("sel");
   	    $("#cat-home").slideToggle();
   	    $("#cat-design").hide();
   	    return false; 
   	});
});

$(function() {
	
	$.get("http://www.authenticjobs.com/js/jobs_r_v2.js", function(data) {
		
		$.each(data.listings, function(index, element) {
			
			var listing = "<li><a href='" + element.url + "'>(" + element.location + ") ";		
			listing += element.title  + "</a></li>";

			$("ul.jobsinc").append(listing);
			
		});

	}, "jsonp");
	
});