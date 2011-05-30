/**
 * Readability.global.js - Actions to run on every page of Readability.
 *
**/

// Browser detection
$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase());
$.browser.ipad = /ipad/.test(navigator.userAgent.toLowerCase()); 
$.browser.iphone = /iphone/.test(navigator.userAgent.toLowerCase());
$.browser.firefox4 = /firefox\/4/.test(navigator.userAgent.toLowerCase());
$.browser.android = /android/.test(navigator.userAgent.toLowerCase());
$.browser.actual_safari = $.browser.safari && !$.browser.chrome;

// OS detection
$.os = {};
$.os.windows = /win/.test(navigator.platform.toLowerCase());

$(function() {

	/* Helper methods that add classes that can be useful */
	$('ul li:first-child').addClass('first');
	$('ul li:last-child').addClass('last');


	// Any links, like the bookmarklet itself, that should have their default actions overridden
	$('.rdb-no-link').click(function (e){ e.preventDefault(); });

	if($.os.windows) {
		$('body').addClass('windows');
	}

	if($.browser.firefox4) {
		$('body').addClass('firefox4');
    }
	else if($.browser.mozilla) {
		$('body').addClass('firefox');
	}
	else if($.browser.chrome) {
		$('body').addClass('chrome');
	}
	else if($.browser.msie) {
		$('body').addClass('msie');
	}
	else if($.browser.android) {
		$('body').addClass('android');
	}
	else if($.browser.iphone) {
		$('body').addClass('iphone');
	}
	else if($.browser.ipad) {
		$('body').addClass('ipad');
	}
	else if($.browser.webkit) {
		$('body').addClass('safari');
	}
	else {
		$('body').addClass('unknown-browser');
	}
	if($.browser.iphone || $.browser.android) {
	  $('#login-link').click(function() {
		window.location = "/login";
	  });
	}
	/**
	 * HTML5 Placeholder Deprecation JS.
	 * Automatically support the placeholder attribute in browsers that don't support it.
	**/
	if (!('placeholder' in document.createElement('input'))) {
		var showPlaceholder = function () {
			var $this        = $(this),
				 placeholder = $this.attr('placeholder');

			if ($this.val() === '' && placeholder) {
				$this.val(placeholder).addClass('placeholderActive');
			}
		};

		var hidePlaceholder = function () {
			var $this        = $(this),
				 placeholder = $this.attr('placeholder');

			if (placeholder && $this.val() == placeholder) {
				$this.val('').removeClass('placeholderActive');
			}
		};

		// Look for forms with inputs and/or textareas with a placeholder attribute in them
		$('form').submit(function () {
			// Clear the placeholder values so they don't get submitted
			$('.placeholderActive', this).val('');
		});

		// Clear placeholder values upon page reload
		$(window).unload(function () {
			$('.placeholderActive').val('');
		});

		$(':input').each(showPlaceholder).blur(showPlaceholder).focus(hidePlaceholder);
	}

	if($('body').data('page-cached')) {
		/* Update the CSRF token when the login box is opened */
		$('#login-link').click( function () {
			$.get('/ajax/csrf_token/', function (responseObj) {
				$('#login-form').find('input[name="csrfmiddlewaretoken"]').val(responseObj.token);
			}, 'json');
		});
	}
	
	$('#login-link').click( function () {
		$('#login-form input[name="username"]').focus();
	});

	$('#marketing #screenshots img').hover(function () {
		$(this).fadeTo("fast", 1);
	}, function() {
		$(this).fadeTo("fast", .7);
	});
	
	if(!$.browser.msie) {
		$('#rdb-article-tools a').hover(function () {
			$(this).fadeTo("fast", 1);
		}, function() {
			$(this).fadeTo("fast", .7);
		});
	}

	$('a#sidebar-hide-link').hover(function () {
		$(this).fadeTo("fast", 1);
	}, function() {
		$(this).fadeTo("fast", .7);
	});

	$('.item-share a').hover(function () {
		$(this).fadeTo("fast", 1);
	}, function() {
		$(this).fadeTo("fast", .55);
	});
	
	$('.expanded-view .article-favorite').hover(function () {
		$(this).fadeTo("fast", 1);
	}, function() {
		$(this).fadeTo("fast", .55);
	});

	$('#article a#logo').hover(function () {
		$(this).fadeTo("fast", 1);
	}, function () {
		$(this).fadeTo("fast", .8);
	});

	if($.browser.msie) {
        // IE Form submission bug
        $('input').keydown(function(e){
            if (e.keyCode == 13) {
                $(this).parents('form').submit();
                return false;
            }
        });
    }

    
});
