$(function() {

	var 	numAll		= 0,
			numBuried 	= 0,
			numFeatured = 0;

	$(".commentlist li").each(function() {

		$el = $(this);

		if ($el.hasClass("buried")) {
			$el.hide();
			numBuried++;
		} else if ($el.hasClass("featured")) {
			numFeatured++;
		}

		numAll++;

	});

	$("#happy-comments").append(numFeatured)
	$("#sad-comments").append(numBuried).click(function() {

		$("li.buried").slideToggle();

	});

});