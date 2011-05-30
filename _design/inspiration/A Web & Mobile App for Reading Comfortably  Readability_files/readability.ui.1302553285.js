/*
 * Readability.UI.Js
 *
 * @Authors: Chris Dary <chrisd@arc90.com>, Philip Forget <philipf@arc90.com>, Daniel Lacy <daniell@arc90.com>
*/
var readability = typeof(readability) === 'undefined' ? {} : readability;

readability.UI = {
	_dropdowns: [],
	_dropdownLinks: [],

	DropDown: function(link_selector, dropdown_selector){
		var dropdownLink = $(link_selector),
		    dropdown     = $(dropdown_selector);

		$.merge(readability.UI._dropdowns, dropdown.get());
		$.merge(readability.UI._dropdownLinks, dropdownLink.get());

        /* Hide or Show the dropdown content and set aria-expanded property. */
		dropdownLink.bind('click', function(event) {
			event.preventDefault();

				if(dropdown.is(':visible')){
					readability.UI.hideDropdowns();
                }
				else {
					readability.UI.hideDropdowns();
					dropdownLink.parent().toggleClass('active', !dropdown.is(':visible'));
					dropdown.toggle();
				}

		    if (dropdown.attr('aria-expanded')) {
		        dropdown.attr('aria-expanded', 'false');
		    }
		    else {
		        dropdown.attr('aria-expanded','true');
		    }
		});

		return {
			// Return public methods
		};
	},
	
	hideDropdowns: function() {
        $(readability.UI._dropdowns).hide();
		$(readability.UI._dropdownLinks).parent().removeClass('active');
		return true;
	},

    // Displays a message that overlays the element calling the warning.
	displayWarning: function(container_id, message) {
	    var container   = $("#article-" + container_id),
	        height      = container.innerHeight(),
	        width       = container.innerWidth();

	    container.css('position','relative').append('<div class="warning">' + message + '</div>');
	    container.find('.warning').css({
	        'height': height,
	        'width' : width
	    }).fadeIn();
	},

	_init: $(function(){
		/**
		 * Toggle a dropdown menu associated with this link.
		 * Determined by ID. I.E. a link will have the id "dropdownLink-rdb-appearance", which
		 * Associated to the dropdown with the id "rdb-appearance".
		**/
		$('.hasDropdown').each(function() {
			if(!$(this).hasClass('no-mobile') || 
			   !(/iphone/.test(navigator.userAgent.toLowerCase()) || /android/.test(navigator.userAgent.toLowerCase()))) {
				var dropdownName = this.href.split(/#/)[1];
				readability.UI.DropDown(this, '#dropdown-' + dropdownName);
			}
		});

		$(window).resize(function() {
			// TODO: This is causing the mobile appearance dropdown to shit the bed
			//readability.UI.hideDropdowns();
		});

		$(document).bind('click touchstart', function(e) {
			var clickIsInDropdown = $(e.target).is('.hasDropdown') ||
									$(e.target).parents('.hasDropdown').length > 0 ||
									$(e.target).closest('.dropdown').length > 0;
			if(!clickIsInDropdown) {
				readability.UI.hideDropdowns();
			}
		});
    })
};
