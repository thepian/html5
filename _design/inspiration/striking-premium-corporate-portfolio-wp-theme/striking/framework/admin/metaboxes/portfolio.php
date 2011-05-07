<?php
wp_enqueue_script('theme-portfolio-metabox', THEME_ADMIN_ASSETS_URI . '/js/portfolio.js');

$config = array(
	'title' => __('Portfolio Item Options','striking_admin'),
	'id' => 'portfolio',
	'pages' => array('portfolio'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		"name" => __("Breadcrumbs Parent Page",'striking_admin'),
		"desc" => __("If set will enable portfolio items breadcrumbs. The page you choose here will be the parent page of portfolio items on the breadcrumbs.",'striking_admin'),
		"id" => "_breadcrumbs_page",
		"page" => 0,
		"default" => 0,
		"prompt" => __("Default",'striking_admin'),
		"type" => "select",
	),
	array(
		"name" => __("Layout",'striking_admin'),
		"desc" => __("It will override the global portfolio item layout setting."),
		"id" => "_layout",
		"default" => 'default',
		"options" => array(
			"default" => __('Default','striking_admin'),
			"full" => __('Full Width','striking_admin'),
			"right" => __('Right Sidebar','striking_admin'),
			"left" => __('Left Sidebar','striking_admin'),
		),
		"type" => "select",
	),
	array(
		"name" => __("Portfolio Type",'striking_admin'),
		"desc" => sprintf(__("%s supports image and video for demonstrating the portfolio in the Lightbox. If the type is document, the thumbnail image is link to page of portfolio",'striking_admin'),THEME_NAME),
		"id" => "_type",
		"default" => 'image',
		"options" => array(
			"image" => __('Image','striking_admin'),
			"gallery" => __('Gallery','striking_admin'),
			"video" => __('Video','striking_admin'),
			"doc" => __('Document','striking_admin'),
			"link" => __('Link','striking_admin'),
			"lightbox" => __('Lightbox','striking_admin'),
		),
		"type" => "select",
	),
	array(
		"type" => "group_start",
		"group" => "portfolio_image",
	),
	array(
		"name" => __("Fullsize Image for Lightbox (optional)",'striking_admin'),
		"desc" => __("The fullsize images you would like to use for the portfolio lightbox pop-up demonstrate.If not assigned, it will use featured image instead.",'striking_admin'),
		"id" => "_image",
		"button" => "Insert Image",
		"default" => '',
		"type" => "Upload",
	),
	array(
		"type" => "group_end",
	),
	array(
		"type" => "group_start",
		"group" => "portfolio_video",
	),
	array(
		"name" => __("Video Link for Lightbox",'striking_admin'),
		"desc" => __("Paste the full url of the Flash(YouTube or Vimeo etc).Only necessary when the lightbox type is video.",'striking_admin'),
		"size" => 30,
		"id" => "_video",
		"default" => '',
		"class" => 'full',
		"type" => "text",
	),
	array(
		"name" => __("Video Width",'striking_admin'),
		"desc" => __("If you specify a number below, this will override the global configuration.",'striking_admin'),
		"id" => "_video_width",
		"default" => '',
		"type" => "text"
	),
	array(
		"name" => __("Video Height",'striking_admin'),
		"desc" => __("If you specify a number below, this will override the global configuration.",'striking_admin'),
		"id" => "_video_height",
		"default" => '',
		"type" => "text"
	),
	array(
		"type" => "group_end",
	),
	array(
		"type" => "group_start",
		"group" => "portfolio_lightbox",
	),
	array(
		"name" => __("Lightbox iframe href",'striking_admin'),
		"desc" => __("If you specify the full url of the website link below, when you click on the item, it will show the website on the lightbox.",'striking_admin'),
		"id" => '_lightbox_href',
		"size" => 30,
		"default" => '',
		"class" => 'full',
		"type" => "text",
	),
	array(
		"name" => __("Lightbox Content",'striking_admin'),
		"desc" => __("The content that display on the lightbox when the portfolio item type is lightbox. You can use shortcode here.",'striking_admin'),
		"id" => "_lightbox_content",
		"default" => '',
		"type" => "textarea",
	),
	array(
		"name" => __("Lightbox Width",'striking_admin'),
		"desc" => __("If you specify a number below, this will override the global configuration.",'striking_admin'),
		"id" => "_lightbox_width",
		"default" => '',
		"type" => "text"
	),
	array(
		"name" => __("Lightbox Height",'striking_admin'),
		"desc" => __("If you specify a number below, this will override the global configuration.",'striking_admin'),
		"id" => "_lightbox_height",
		"default" => '',
		"type" => "text"
	),
	array(
		"type" => "group_end",
	),
	array(
		"type" => "group_start",
		"group" => "portfolio_link",
	),
	array(
		"name" => __("Link for Portfolio item",'striking_admin'),
		"desc" => __("The url that the portfolio item linked to. It only available if Portfolio type set to Link.",'striking_admin'),
		"id" => "_link",
		"default" => "",
		"shows" => array('page','cat','post','manually'),
		"type" => "superlink"	
	),
	array(
		"name" => __("Link Target",'striking_admin'),
		"id" => "_link_target",
		"default" => '_self',
		"options" => array(
			"_blank" => __('Load in a new window','striking_admin'),
			"_self" => __('Load in the same frame as it was clicked','striking_admin'),
			"_parent" => __('Load in the parent frameset','striking_admin'),
			"_top" => __('Load in the full body of the window','striking_admin'),
		),
		"type" => "select",
	),
	array(
		"type" => "group_end",
	),
	array(
		"name" => __("Thumbnail Icon",'striking_admin'),
		"desc" => __("It will override portfolio type's defualt icon setting.",'striking_admin'),
		"id" => "_icon",
		"default" => 'default',
		"options" => array(
			"default" => __('Default','striking_admin'),
			"zoom" => __('Image','striking_admin'),
			"play" => __('Video','striking_admin'),
			"doc" => __('Document','striking_admin'),
			"link" => __('Link','striking_admin'),
		),
		"type" => "select",
	),
	array(
		"name" => __("Enable Read More",'striking_admin'),
		"desc" => __("if this is on, the read more button will show.",'striking_admin'),
		"id" => "_more",
		"default" => "",
		"type" => "tritoggle"
	),
	array(
		"name" => __("Link for Read More",'striking_admin'),
		"id" => "_more_link",
		"default" => "",
		"shows" => array('page','cat','post','manually'),
		"type" => "superlink"
	),
	array(
		"name" => __("Link Target for Read More",'striking_admin'),
		"id" => "_more_link_target",
		"default" => '_self',
		"options" => array(
			"_blank" => __('Load in a new window','striking_admin'),
			"_self" => __('Load in the same frame as it was clicked','striking_admin'),
			"_parent" => __('Load in the parent frameset','striking_admin'),
			"_top" => __('Load in the full body of the window','striking_admin'),
		),
		"type" => "select",
	),
);
new metaboxesGenerator($config,$options);