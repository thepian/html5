<?php
$options = array(
	array(
		"name" => __("SlideShow",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("jQuery Nivo Slider Setting",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => __("Height of slider.",'striking_admin'),
			"id" => "nivo_height",
			"min" => "60",
			"max" => "440",
			"step" => "1",
			"unit" => 'px',
			"default" => "440",
			"type" => "range"
		),
		array(
			"name" => __("Transition Effects",'striking_admin'),
			"desc" => __("Select which effect to use on the slideshow.",'striking_admin'),
			"id" => "nivo_effect",
			"default" => 'random',
			"options" => array(
				"random" => 'random',
				"sliceDown" => 'sliceDown',
				"sliceDownLeft" => 'sliceDownLeft',
				"sliceUp" => 'sliceUp',
				"sliceUpLeft" => 'sliceUpLeft',
				"sliceUpDown" => 'sliceUpDown',
				"sliceUpDownLeft" => 'sliceUpDownLeft',
				"fold" => 'fold',
				"fade" => 'fade'
			),
			"type" => "select",
		),
		array(
			"name" => __("Segments",'striking_admin'),
			"desc" => __("Number of segments in which the image will be sliced.",'striking_admin'),
			"id" => "nivo_slices",
			"min" => "1",
			"max" => "30",
			"step" => "1",
			"default" => "10",
			"type" => "range"
		),
		array(
			"name" => __("Animation Speed",'striking_admin'),
			"desc" => __("Define the duration of the animations.",'striking_admin'),
			"id" => "nivo_animSpeed",
			"min" => "200",
			"max" => "3000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "500",
			"type" => "range"
		),
		array(
			"name" => __("Pause Time",'striking_admin'),
			"desc" => __("Define the delay which each slide will have to wait to be played",'striking_admin'),
			"id" => "nivo_pauseTime",
			"min" => "1000",
			"max" => "30000",
			"step" => "500",
			"unit" => 'miliseconds',
			"default" => "3000",
			"type" => "range"
		),
		array(
			"name" => __("Next & Prev Buttons",'striking_admin'),
			"desc" => __("If you want show Next & Prev Buttons on the slider show, turn on the button.",'striking_admin'),
			"id" => "nivo_directionNav",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Hide Next & Prev Buttons",'striking_admin'),
			"desc" => __("If you want hide Next & Prev Buttons until hovering the slider, turn on the button.",'striking_admin'),
			"id" => "nivo_directionNavHide",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Control Navigation",'striking_admin'),
			"desc" => __("If you want show Control Navigation on the slidershow, turn on the button.",'striking_admin'),
			"id" => "nivo_controlNav",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Keyboard Navigation",'striking_admin'),
			"desc" => __("If you want Keyboard Navigation use left & right arrows, turn on the button.",'striking_admin'),
			"id" => "nivo_keyboardNav",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Pause On Hover",'striking_admin'),
			"desc" => __("If you want stop animation while hovering, turn on the button.",'striking_admin'),
			"id" => "nivo_pauseOnHover",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Manual Transitions",'striking_admin'),
			"desc" => __("If you want force manual transitions, turn on the button.",'striking_admin'),
			"id" => "nivo_manualAdvance",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Captions",'striking_admin'),
			"desc" => __("If you want display the title of slider item, turn on the button.",'striking_admin'),
			"id" => "nivo_captions",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Caption Opacity",'striking_admin'),
			"desc" => __("The Opacity of Caption with it's background.",'striking_admin'),
			"id" => "nivo_captionOpacity",
			"min" => "0",
			"max" => "1",
			"step" => "0.1",
			"default" => "0.5",
			"type" => "range"
		),
		array(
			"name" => __("Stop At End",'striking_admin'),
			"desc" => __("If this option is on, the slideshow will stop on the last image.",'striking_admin'),
			"id" => "nivo_stopAtEnd",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("3D Flash Image Rotator Setting",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Mobile Slider Replacement",'striking_admin'),
			"desc" => __("When users using mobile device to view the site, it will use the slider define below instead of using 3d slider. ",'striking_admin'),
			"id" => "3d_mobile",
			"default" => "anything",
			"options" => array(
				"nivo" => __('jQuery Nivo Slider','striking_admin'),
				"kwicks" => __('Accordion Slider','striking_admin'),
				"anything" => __('Anything Slider','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => __("Height of slider.",'striking_admin'),
			"id" => "3d_height",
			"default" => '440',
			"options" => array(
				"150" => '150px',
				"250" => '250px',
				"320" => '320px',
				"400" => '400px',
				"440" => '440px',
			),
			"type" => "select",
		),
		array(
			"name" => __("Segments",'striking_admin'),
			"desc" => __("Number of segments in which the image will be sliced.",'striking_admin'),
			"id" => "3d_segments",
			"min" => "1",
			"max" => "30",
			"step" => "1",
			"default" => "10",
			"type" => "range"
		),
		array(
			"name" => __("Tween Time",'striking_admin'),
			"desc" => __("Number of seconds for each element to be turned.",'striking_admin'),
			"id" => "3d_tweenTime",
			"min" => "0",
			"max" => "3",
			"step" => "0.1",
			"unit" => 'seconds',
			"default" => "1.2",
			"type" => "range"
		),
		array(
			"name" => __("Tween Delay",'striking_admin'),
			"desc" => __("Number of seconds from one element starting to turn to the next element starting.",'striking_admin'),
			"id" => "3d_tweenDelay",
			"min" => "0",
			"max" => "1",
			"step" => "0.1",
			"unit" => 'seconds',
			"default" => "0.1",
			"type" => "range"
		),
		array(
			"name" => __("Tween Type",'striking_admin'),
			"desc" => __("Select which effect to use when transition.",'striking_admin'),
			"id" => "3d_tweenType",
			"default" => 'easeInOutCirc',
			"options" => array(
				"linear" => 'linear',
				"easeInSine" => 'easeInSine',
				"easeOutSine" => 'easeOutSine',
				"easeInOutSine" => 'easeInOutSine',
				"easeInCubic" => 'easeInCubic',
				"easeOutCubic" => 'easeOutCubic',
				"easeInOutCubic" => 'easeInOutCubic',
				"easeOutInCubic" => 'easeOutInCubic',
				"easeInQuint" => 'easeInQuint',
				"easeOutQuint" => 'easeOutQuint',
				"easeInOutQuint" => 'easeInOutQuint',
				"easeOutInQuint" => 'easeOutInQuint',
				"easeInCirc" => 'easeInCirc',
				"easeOutCirc" => 'easeOutCirc',
				"easeInOutCirc" => 'easeInOutCirc',
				"easeOutInCirc" => 'easeOutInCirc',
				"easeInBack" => 'easeInBack',
				"easeOutBack" => 'easeOutBack',
				"easeInOutBack" => 'easeInOutBack',
				"easeOutInBack" => 'easeOutInBack',
				"easeInQuad" => 'easeInQuad',
				"easeOutQuad" => 'easeOutQuad',
				"easeInOutQuad" => 'easeInOutQuad',
				"easeOutInQuad" => 'easeOutInQuad',
				"easeInQuart" => 'easeInQuart',
				"easeOutQuart" => 'easeOutQuart',
				"easeInOutQuart" => 'easeInOutQuart',
				"easeOutInQuart" => 'easeOutInQuart',
				"easeInExpo" => 'easeInExpo',
				"easeOutExpo" => 'easeOutExpo',
				"easeInOutExpo" => 'easeInOutExpo',
				"easeOutInExpo" => 'easeOutInExpo',
				"easeInElastic" => 'easeInElastic',
				"easeOutElastic" => 'easeOutElastic',
				"easeInOutElastic" => 'easeInOutElastic',
				"easeOutInElastic" => 'easeOutInElastic',
				"easeInBounce" => 'easeInBounce',
				"easeOutBounce" => 'easeOutBounce',
				"easeInOutBounce" => 'easeInOutBounce',
				"easeOutInBounce" => 'easeOutInBounce',
			),
			"type" => "select",
		),
		array(
			"name" => __("Z Distance",'striking_admin'),
			"desc" => __("To which extend are the cubes moved on z axis when being tweened. Negative values bring the cube closer to the camera, positive values take it further away.",'striking_admin'),
			"id" => "3d_zDistance",
			"min" => "-200",
			"max" => "700",
			"step" => "50",
			"default" => "0",
			"type" => "range"
		),
		array(
			"name" => __("Expand",'striking_admin'),
			"desc" => __("To which extend are the cubes moved away from each other when tweening.",'striking_admin'),
			"id" => "3d_expand",
			"min" => "0",
			"max" => "100",
			"step" => "5",
			"default" => "20",
			"type" => "range"
		),
		array(
			"name" => __("Inner Color",'striking_admin'),
			"desc" => __("Color of the sides of the elements in hex values",'striking_admin'),
			"id" => "3d_innerColor",
			"default" => "#111111",
			"type" => "color"
		),
		array(
			"name" => __("Shadow Darkness",'striking_admin'),
			"desc" => __("To which extend are the sides shadowed, when the elements are tweening and the sided move towards the background. 100 is black, 0 is no darkening.",'striking_admin'),
			"id" => "3d_shadowDarkness",
			"min" => "0",
			"max" => "100",
			"step" => "10",
			"default" => "100",
			"type" => "range"
		),
		array(
			"name" => __("Autoplay",'striking_admin'),
			"desc" => __("Number of seconds to the next image, when autoplay is on. Set 0, if you don‘t want autoplay.",'striking_admin'),
			"id" => "3d_autoplay",
			"min" => "0",
			"max" => "20",
			"step" => "1",
			"unit" => 'seconds',
			"default" => "5",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Accordion Slider Setting",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => __("Height of Accordion Slider.",'striking_admin'),
			"id" => "kwicks_height",
			"min" => "60",
			"max" => "440",
			"step" => "1",
			"unit" => 'px',
			"default" => "440",
			"type" => "range"
		),
		array(
			"name" => __("AutoPlay",'striking_admin'),
			"desc" => __("If you want slider expand automatically, turn on the button.",'striking_admin'),
			"id" => "kwicks_autoplay",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("AutoPlay Pause Time",'striking_admin'),
			"desc" => __("Define the delay which each slide will have to wait to be played",'striking_admin'),
			"id" => "kwicks_pauseTime",
			"min" => "1000",
			"max" => "10000",
			"step" => "500",
			"unit" => 'miliseconds',
			"default" => "5000",
			"type" => "range"
		),
		array(
			"name" => __("Slider Number",'striking_admin'),
			"desc" => __("Define the number of sliders.",'striking_admin'),
			"id" => "kwicks_number",
			"min" => "2",
			"max" => "8",
			"step" => "1",
			"default" => "4",
			"type" => "range"
		),
		array(
			"name" => __("Max width",'striking_admin'),
			"desc" => __("Define the width of a funlly expanded slider element.",'striking_admin'),
			"id" => "kwicks_max",
			"min" => "240",
			"max" => "960",
			"step" => "10",
			'unit' => 'px',
			"default" => "850",
			"type" => "range"
		),
		array(
			"name" => __("Animation Speed",'striking_admin'),
			"desc" => __("Define the duration of the animations.",'striking_admin'),
			"id" => "kwicks_duration",
			"min" => "0",
			"max" => "3000",
			"step" => "100",
			'unit' => 'milliseconds',
			"default" => "800",
			"type" => "range"
		),
		array(
			"name" => __("Easing Animations",'striking_admin'),
			"desc" => __("Select which easing effect to use.",'striking_admin'),
			"id" => "kwicks_easing",
			"default" => 'linear',
			"options" => array(
				"linear" => 'linear',
				"swing" => 'swing',
				"easeInQuad" => 'easeInQuad',
				"easeOutQuad" => 'easeOutQuad',
				"easeInOutQuad" => 'easeInOutQuad',
				"easeInCubic" => 'easeInCubic',
				"easeOutCubic" => 'easeOutCubic',
				"easeInOutCubic" => 'easeInOutCubic',
				"easeInQuart" => 'easeInQuart',
				"easeOutQuart" => 'easeOutQuart',
				"easeInOutQuart" => 'easeInOutQuart',
				"easeInQuint" => 'easeInQuint',
				"easeOutQuint" => 'easeOutQuint',
				"easeInOutQuint" => 'easeInOutQuint',
				"easeInSine" => 'easeInSine',
				"easeOutSine" => 'easeOutSine',
				"easeInOutSine" => 'easeInOutSine',
				"easeInExpo" => 'easeInExpo',
				"easeOutExpo" => 'easeOutExpo',
				"easeInOutExpo" => 'easeInOutExpo',
				"easeInCirc" => 'easeInCirc',
				"easeOutCirc" => 'easeOutCirc',
				"easeInOutCirc" => 'easeInOutCirc',
				"easeInElastic" => 'easeInElastic',
				"easeOutElastic" => 'easeOutElastic',
				"easeInOutElastic" => 'easeInOutElastic',
				"easeInBack" => 'easeInBack',
				"easeOutBack" => 'easeOutBack',
				"easeInOutBack" => 'easeInOutBack',
				"easeInBounce" => 'easeInBounce',
				"easeOutBounce" => 'easeOutBounce',
				"easeInOutBounce" => 'easeInOutBounce'
			),
			"type" => "select",
		),
		array(
			"name" => __("Title",'striking_admin'),
			"desc" => __("If you want show title of the slider, turn on the button.",'striking_admin'),
			"id" => "kwicks_title",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Title Fade Speed",'striking_admin'),
			"desc" => __("Define the Speed of title fade transition.",'striking_admin'),
			"id" => "kwicks_title_speed",
			"min" => "0",
			"max" => "2000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "500",
			"type" => "range"
		),
		array(
			"name" => __("Title Opacity",'striking_admin'),
			"desc" => __("Define the Opacity of title.",'striking_admin'),
			"id" => "kwicks_title_opacity",
			"min" => "0",
			"max" => "1",
			"step" => "0.1",
			"default" => "0.6",
			"type" => "range"
		),
		array(
			"name" => __("Detail",'striking_admin'),
			"desc" => __("If you want show detail of the slider, turn on the button.",'striking_admin'),
			"id" => "kwicks_detail",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Detail Fade Speed",'striking_admin'),
			"desc" => __("Define the Speed of detail fade transition.",'striking_admin'),
			"id" => "kwicks_detail_speed",
			"min" => "0",
			"max" => "2000",
			"step" => "100",
			'unit' => 'miliseconds',
			"default" => "500",
			"type" => "range"
		),
		array(
			"name" => __("Detail Opacity",'striking_admin'),
			"desc" => __("Define the Opacity of detail.",'striking_admin'),
			"id" => "kwicks_detail_opacity",
			"min" => "0",
			"max" => "1",
			"step" => "0.1",
			"default" => "0.6",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Anything Slider Setting",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => __("Height of slider.",'striking_admin'),
			"id" => "anything_height",
			"min" => "60",
			"max" => "440",
			"step" => "1",
			"unit" => 'px',
			"default" => "440",
			"type" => "range"
		),
		array(
			"name" => __("buildArrows",'striking_admin'),
			"desc" => __("If true, builds the forwards and backwards buttons",'striking_admin'),
			"id" => "anything_buildArrows",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("toggleArrows",'striking_admin'),
			"desc" => __("if true, side navigation arrows will slide out on hovering & hide @ other times",'striking_admin'),
			"id" => "anything_toggleArrows",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("buildNavigation",'striking_admin'),
			"desc" => __("If true, builds a list of anchor links to link to each panel",'striking_admin'),
			"id" => "anything_buildNavigation",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("toggleControls",'striking_admin'),
			"desc" => __("if true, slide in controls (navigation + play/stop button) on hover and slide change, hide @ other times",'striking_admin'),
			"id" => "anything_toggleControls",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("autoPlay",'striking_admin'),
			"desc" => __("If true, the slideshow will starts running automatically.",'striking_admin'),
			"id" => "anything_autoPlay",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("pauseOnHover",'striking_admin'),
			"desc" => __("If true & the slideshow is active, the slideshow will pause on hover",'striking_admin'),
			"id" => "anything_pauseOnHover",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("resumeOnVideoEnd",'striking_admin'),
			"desc" => __("If true & the slideshow is active & a youtube video is playing, the autoplay will pause until the video completes",'striking_admin'),
			"id" => "anything_resumeOnVideoEnd",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("stopAtEnd",'striking_admin'),
			"desc" => __("If true & the slideshow is active, the slideshow will stop on the last page",'striking_admin'),
			"id" => "anything_stopAtEnd",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("playRtl",'striking_admin'),
			"desc" => __("If true, the slideshow will move right-to-left",'striking_admin'),
			"id" => "anything_playRtl",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("delay",'striking_admin'),
			"desc" => __("How long between slideshow transitions in AutoPlay mode",'striking_admin'),
			"id" => "anything_delay",
			"min" => "1000",
			"max" => "30000",
			"step" => "500",
			'unit' => 'miliseconds',
			"default" => "3500",
			"type" => "range"
		),
		array(
			"name" => __("animationTime",'striking_admin'),
			"desc" => __("How long the slideshow transition takes",'striking_admin'),
			"id" => "anything_animationTime",
			"min" => "200",
			"max" => "3000",
			"step" => "100",
			"unit" => 'miliseconds',
			"default" => "500",
			"type" => "range"
		),
		array(
			"name" => __("Easing Animations",'striking_admin'),
			"desc" => __("Select which easing effect to use.",'striking_admin'),
			"id" => "anything_easing",
			"default" => 'swing',
			"options" => array(
				"linear" => 'linear',
				"swing" => 'swing',
				"easeInQuad" => 'easeInQuad',
				"easeOutQuad" => 'easeOutQuad',
				"easeInOutQuad" => 'easeInOutQuad',
				"easeInCubic" => 'easeInCubic',
				"easeOutCubic" => 'easeOutCubic',
				"easeInOutCubic" => 'easeInOutCubic',
				"easeInQuart" => 'easeInQuart',
				"easeOutQuart" => 'easeOutQuart',
				"easeInOutQuart" => 'easeInOutQuart',
				"easeInQuint" => 'easeInQuint',
				"easeOutQuint" => 'easeOutQuint',
				"easeInOutQuint" => 'easeInOutQuint',
				"easeInSine" => 'easeInSine',
				"easeOutSine" => 'easeOutSine',
				"easeInOutSine" => 'easeInOutSine',
				"easeInExpo" => 'easeInExpo',
				"easeOutExpo" => 'easeOutExpo',
				"easeInOutExpo" => 'easeInOutExpo',
				"easeInCirc" => 'easeInCirc',
				"easeOutCirc" => 'easeOutCirc',
				"easeInOutCirc" => 'easeInOutCirc',
				"easeInElastic" => 'easeInElastic',
				"easeOutElastic" => 'easeOutElastic',
				"easeInOutElastic" => 'easeInOutElastic',
				"easeInBack" => 'easeInBack',
				"easeOutBack" => 'easeOutBack',
				"easeInOutBack" => 'easeInOutBack',
				"easeInBounce" => 'easeInBounce',
				"easeOutBounce" => 'easeOutBounce',
				"easeInOutBounce" => 'easeInOutBounce'
			),
			"type" => "select",
		),
		array(
			"name" => __("Caption Opacity",'striking_admin'),
			"desc" => __("The Opacity of Caption with it's background.",'striking_admin'),
			"id" => "anything_captionOpacity",
			"min" => "0",
			"max" => "1",
			"step" => "0.1",
			"default" => "0.8",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	
);
return array(
	'auto' => true,
	'name' => 'slideshow',
	'options' => $options
);