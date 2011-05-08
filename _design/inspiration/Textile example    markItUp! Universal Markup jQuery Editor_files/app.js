$(function() {
	$(".menu a").append("<em></em>");
	$(".menu a").hover(function() {
	  $("em", this).text($(this).attr("title"));
	  $("em", this).animate({opacity: "show", left: "+20"}, "slow");
	  $(this).animate({left: "+20"}, "fast");
	}, function() {
	  $("em", this).animate({opacity: "hide", left: "-20"}, "slow");
	  $(this).animate({left: "0"}, "fast");
	});	
	
	$(".mailto").click(function(e)	{
		var mailLink = this;
		var bulle = $("#contactWarning");
		$(bulle).show();
		$(".ok", bulle).click(function(e) {
			a = $(mailLink).attr("href");
			a = a.replace("#", "").replace("|", "@");
			document.location = "ma"+"il"+"to:"+a+"?subject=[markItUp!] ";
			e.preventDefault;
			return false;
		});
		$(".close", bulle).click(function(e) {
			$(bulle).hide();	
			return false;
		});
		e.preventDefault;
		return false;
	});

    $('#corner img').hover(function() { 
        $(this).stop().animate({ width:'200px', height:'200px' }); 
    }, function() { 
        $(this).stop().animate({ width:'80px', height:'80px' }); 
    }); 
});