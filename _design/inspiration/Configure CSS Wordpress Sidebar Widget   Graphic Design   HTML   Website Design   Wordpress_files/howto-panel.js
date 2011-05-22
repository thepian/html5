JQ = jQuery.noConflict();
JQ(document).ready(function(){
	JQ(".trigger").click(function(){
		JQ(".howto-panel").toggle("fast");
		JQ(this).toggleClass("active");
		return false;
	});
	JQ(".trigger").click();
	});
