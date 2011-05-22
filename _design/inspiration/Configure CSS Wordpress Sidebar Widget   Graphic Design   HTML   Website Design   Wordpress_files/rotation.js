(function () {
	var getRandomInt = function(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;  
	}

	var rotate = function (dom) {
		var elements = jQuery(dom).find('.rotation_item');
		elements.hide();

		var number_of_items = elements.length;
		var display_item_id = getRandomInt(0, number_of_items - 1);
		jQuery(elements[display_item_id]).show();
	};

	jQuery(document).ready(function () {
		var rotation_items = jQuery('.rotation_items');
		for (var i = 0; i < rotation_items.length; i++) {
			rotate(rotation_items[i]);
		}
	});
})();
