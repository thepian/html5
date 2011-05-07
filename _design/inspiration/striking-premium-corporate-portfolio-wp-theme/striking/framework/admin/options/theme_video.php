<?php 
$options = array(
	array(
		"name" => __("Video Sizes",'striking_admin'),
		"desc" => __("The options listed below determine the dimensions in pixels to use in the shortcode of videos.",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Html5 video",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "html5_width",
			"default" => 630,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "html5_height",
			"default" => 355,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Download Links",'striking_admin'),
			"id" => "html5_download",
			"desc" => __("If you want to support devices that don't support HTML5 or Flash, include links to the video source.",'striking_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Preload",'striking_admin'),
			"id" => "html5_preload",
			"desc" => __("Select this if you want the video to start downloading as soon the user loads the page.",'striking_admin'),
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Autoplay",'striking_admin'),
			"id" => "html5_autoplay",
			"desc" => __("Select this if you want the video to start playing as soon as the page is loaded.",'striking_admin'),
			"default" => false,
			"type" => "toggle"
		),
		
	array(
		"type" => "end"
	),
	array(
		"name" => __("Flash",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "flash_width",
			"default" => 630,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "flash_height",
			"default" => 355,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("YouTube",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "youtube_width",
			"default" => 630,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "youtube_height",
			"default" => 380,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Autohide",'striking_admin'),
			"desc" => __('Set whether the video controls will automatically hide after a video begins playing.','striking_admin'),
			"id" => "youtube_autohide",
			"default" => '2',
			"options" => array(
				"0" => __('Visible','striking_admin'),
				"1" => __('Hide all','striking_admin'),
				"2" => __('Hide video progress bar','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Autoplay",'striking_admin'),
			"desc" => __('Sets whether or not the initial video will autoplay when the player loads','striking_admin'),
			"id" => "youtube_autoplay",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Controls",'striking_admin'),
			"desc" => __('Sets whether or not display the video player controls.','striking_admin'),
			"id" => "youtube_controls",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Disablekb",'striking_admin'),
			"desc" => __('Enable it will disable the player keyboard controls.','striking_admin'),
			"id" => "youtube_disablekb",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Fs",'striking_admin'),
			"desc" => __('Sets whether or not enable the fullscreen button.','striking_admin'),
			"id" => "youtube_fs",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Hd",'striking_admin'),
			"desc" => __('Sets whether or not enable HD version of the video.','striking_admin'),
			"id" => "youtube_hd",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Loop",'striking_admin'),
			"desc" => __('Enable it will will cause the player to play the initial video again and again.','striking_admin'),
			"id" => "youtube_loop",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Rel",'striking_admin'),
			"desc" => __('Sets whether the player should load related videos once playback of the initial video starts.','striking_admin'),
			"id" => "youtube_rel",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("showinfo",'striking_admin'),
			"desc" => __('Enable it will will cause the player to play the initial video again and again.','striking_admin'),
			"id" => "youtube_showinfo",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("showsearch",'striking_admin'),
			"desc" => __('Sets whether or not display search box from displaying when the video is minimized','striking_admin'),
			"id" => "youtube_showsearch",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Vimeo",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "vimeo_width",
			"default" => 630,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "vimeo_height",
			"default" => 355,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Byline",'striking_admin'),
			"desc" => __('Sets whether or not show the byline on the video','striking_admin'),
			"id" => "vimeo_byline",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Title",'striking_admin'),
			"desc" => __('Sets whether or not show the title on the video','striking_admin'),
			"id" => "vimeo_title",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Portrait",'striking_admin'),
			"desc" => __("Sets whether or not show the user's portrai on the video",'striking_admin'),
			"id" => "vimeo_portrait",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Autoplay",'striking_admin'),
			"desc" => __("Sets whether or not automatically start playback of the video.",'striking_admin'),
			"id" => "vimeo_autoplay",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Loop",'striking_admin'),
			"desc" => __('Sets whether or not play the initial video again and again.','striking_admin'),
			"id" => "vimeo_loop",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Dailymotion",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "dailymotion_width",
			"default" => 630,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "dailymotion_height",
			"default" => 355,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Related",'striking_admin'),
			"desc" => __("Sets whether or not loads related videos when the current video begins playback.",'striking_admin'),
			"id" => "dailymotion_related",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Autoplay",'striking_admin'),
			"desc" => __("Sets whether or not automatically start playback of the video.",'striking_admin'),
			"id" => "dailymotion_autoplay",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Chromeless",'striking_admin'),
			"desc" => __("Sets whether or not display controls or not during video playback.",'striking_admin'),
			"id" => "dailymotion_chromeless",
			"default" => false,
			"type" => "toggle"
		),
		
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'video',
	'options' => $options
);