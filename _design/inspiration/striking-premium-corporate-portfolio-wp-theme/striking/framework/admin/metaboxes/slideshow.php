<?php
$config = array(
	'title' => __('SlideShow Item Options','striking_admin'),
	'id' => 'slideshow',
	'pages' => array('slideshow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		"name" => __("Description (optional)",'striking_admin'),
		"desc" => __("The description of the slider item.",'striking_admin'),
		"id" => "_description",
		"default" => "",
		"rows" => "2",
		"type" => "textarea"
	),
	array(
		"name" => __("URL (optional)",'striking_admin'),
		"desc" => __("The url that the slider item linked to.",'striking_admin'),
		"id" => "_link_to",
		"default" => "",
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
);
new metaboxesGenerator($config,$options);