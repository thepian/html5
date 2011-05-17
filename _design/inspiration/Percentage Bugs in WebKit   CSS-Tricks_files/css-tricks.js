(function($) {
	
	$.fn.placeholder = function() {
		
		if (this[0] && 'placeholder' in document.createElement('input')) {
			return this;
		};

		function setPlaceholder($elem) {
			if ($elem.val() === '' || $elem.val() === $elem.attr('placeholder')) {
				$elem.addClass('placeholder').val($elem.attr('placeholder'));
			} else {
				$elem.removeClass('placeholder');
			};
		};

		$('form:has([placeholder])').submit(function() {
			$('.placeholder', this).val('');
		});

		$(window).unload(function() {
			$('.placeholder').val('');
		});

		return this.each(function() {
		
			var $input = $(this);
		
			if ($input.is(':password') || !$input.is(':input')) {
				return;
			};
		
			setPlaceholder($input);
		
			$input.focus(function() {
				if ($input.val() === $input.attr('placeholder')) {
					$input.val('').removeClass('placeholder');
				};
			}).blur(function() {
				setPlaceholder($input);
			});
		
		});
		
	};
	
	$(".button:contains('View Demo')").wrapInner("<span></span>").addClass("view-demo-button");
	$(".button:contains('Download Files')").wrapInner("<span></span>").addClass("download-files-button");
	
	$("pre").addClass("prettyprint");
	
	prettyPrint();
	
	$("#comment").keyup(function() {
	
		var $el = $(this);
		
		if ($el.val() != "") {
			$el.css("background-position", "600px 600px");
		}
		
	});
	
	$("#awesome").click(function() {
	
		$("#comment").focus();
	
	});
	
	$(".avatar").each(function() {
	
		var source = $(this).attr("src");
		
		$("<div />", {
		
			"class": "avatar",
			"css": {
				"background": "url(" + source + ")"
			}
		
		}).insertAfter($(this));
		
		$(this).remove();
	
	});
	
	$("#main-rss-link").click(function() {
	
		$("#subscribe-list").slideToggle();
		
		$(this).toggleClass("on");
	
	});
	
	$(".commentmetadata a:nth-child(1)").each(function() {
	
		$(this).html($(this).text().replace(/[^(\d\/)]/g, "").substring(0,10));
	
	});
	
	$("#the-juice").prepend("<div id='cse' />");
	
	$("input").placeholder();
	
	$("header h1 strong").click(function() {
		$(this).removeAttr("style").css({
			"-webkit-animation": "rotate-star 4s 1 alternate ease-in-out"
		});
	});
	
})(jQuery);