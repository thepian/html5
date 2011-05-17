this.screenshotPreview = function(){	
	/* CONFIG */
		
		xOffset = 37;
		yOffset = 22;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		//var c = (this.t != "") ? "<br/>" + this.t : "";
		//$("body").append("<p id='screenshot'><img src='"+ this.rel +"' alt='url preview' />"+ c +"</p>");								 
		$("body").append("<div id='screenshot'><span></span><img src='"+ this.rel +"' alt='loading image' /></div>");								 
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("a.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};



$(document).ready(function(){

	screenshotPreview();

	$('h1').prepend("<span></span>");
	
	$(".set_list .item").hover(function() {
		$(this).parents("li").find(".details").show();
	}, function() {
		$(this).parents("li").find(".details").hide();
	});

	$(".set_list .details").hover(function() {
		$(this).show();
	}, function() {
		$(this).hide();
	});

	$("#menu ul").css({display: "none"}); // Opera Fix
	$("#menu li").hover(function(){
		$(this).find('ul:first').css({visibility: "visible",display: "none"}).show();
		$(this).addClass("current");
		},function(){
			$(this).find('ul:first').css({visibility: "hidden"});
			$(this).removeClass("current");
		});

	$("#dock_list").jCarouselLite({
		btnNext: "#dock .next",
		btnPrev: "#dock .prev",
		visible: 5,
		circular: false,
		mouseWheel: true,
		vertical: true,
		speed: 300
	});    

	$(".feat_list").jCarouselLite({
		btnNext: ".feat_prods .next",
		btnPrev: ".feat_prods .prev",
		visible: 4,
		speed: 300
	});
	
	$('ul.tabnav .tab_btn a').click(function() {
		var curChildIndex = $(this).parent().prevAll().length + 1;
		$(this).parent().parent().children('.current').removeClass('current');
		$(this).parent().addClass('current');
		$(this).parent().parent().next('.tabcontainer').children('.current').fadeOut('fast',function() {
			$(this).removeClass('current');
			$(this).parent().children('div:nth-child('+curChildIndex+')').fadeIn('normal',function() {
				$(this).addClass('current');
			});
		});
		return false;								
	});
	

}); //close doc ready