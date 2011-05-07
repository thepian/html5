<?php 
$config = array(
	'title' => __('Blog Single Options','striking_admin'),
	'id' => 'single',
	'pages' => array('post'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$options = array(
	array(
		"name" => __("Layout",'striking_admin'),
		"desc" => __("It will override the global blog single layout setting."),
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
		"name" => __("Featured Image",'striking_admin'),
		"desc" => __("Whether to dispaly Featured Image in Single Blog page. This will override the global configuration",'striking_admin'),
		"id" => "_featured_image",
		"default" => '',
		"type" => "tritoggle",
	),
);
new metaboxesGenerator($config,$options);