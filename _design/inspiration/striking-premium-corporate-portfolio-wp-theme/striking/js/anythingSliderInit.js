jQuery(document).ready(function() {
	jQuery('#anything_slider').preloader({
		imgSelector:'img.slideimage',
		gradualDelay:false,
		afterShowAll:function(){
			jQuery('#anything_slider_wrap').css('overflow','visible');
			var slider = jQuery(this);
			slider.anythingSlider({
				height:slideShow['height'],
				hashTags:false,
				buildArrows:slideShow['buildArrows'],
				toggleArrows:slideShow['toggleArrows'],
				buildNavigation:slideShow['buildNavigation'],
				toggleControls:slideShow['toggleControls'],
				autoPlay:slideShow['autoPlay'],
				startStopped:false,
				pauseOnHover:slideShow['pauseOnHover'],
				resumeOnVideoEnd:slideShow['resumeOnVideoEnd'],
				stopAtEnd:slideShow['stopAtEnd'],
				playRtl:slideShow['playRtl'],
				delay:slideShow['delay'],
				animationTime:slideShow['animationTime'],
				easing:slideShow['easing'],
				onSlideInit:function(){
					base = slider.data('AnythingSlider');
					if(base.$currentPage.hasClass('stoped')){
						base.startStop(false);
					}else{
						base.startStop(base.options.autoPlay);
					}
				}
			});
			
			if(slider.find('li.panel:eq(1)').hasClass('stoped')){
				slider.data('AnythingSlider').startStop(false);
			}
			slider.find('li.panel.click_stoped').click(function(){
				slider.data('AnythingSlider').startStop(false);
			});
			slider.find('.anything_caption').css({ opacity: slideShow['captionOpacity'] });		
			
			jQuery('#anything_slider_loading').animate({opacity:0}, 1000,function(){jQuery(this).remove();});
		},
		beforeShowAll:function(){
			jQuery('<div id="anything_slider_loading"></div>').insertBefore(this);
			jQuery(this).show();
		}
	})
});