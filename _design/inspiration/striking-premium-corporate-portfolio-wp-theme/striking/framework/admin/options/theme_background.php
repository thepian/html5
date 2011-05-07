<?php
$options = array(
	array(
		"name" => __("Background",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Header Background",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Custom Image",'striking_admin'),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your custom image here or you can insert the image through the button.",'striking_admin'),
			"id" => "header_image",
			"default" => "",
			"type" => "upload"
		),
		array(
			"name" => __("Position",'striking_admin'),
			"desc" => "",
			"id" => "header_position_x",
			"default" => 'center',
			"options" => array(
				"left" => __('Left','striking_admin'),
				"center" => __('Center','striking_admin'),
				"right" => __('Right','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Repeat",'striking_admin'),
			"desc" => "",
			"id" => "header_repeat",
			"default" => 'no-repeat',
			"options" => array(
				"no-repeat" => __('No Repeat','striking_admin'),
				"repeat" => __('Tile','striking_admin'),
				"repeat-x" => __('Tile Horizontally','striking_admin'),
				"repeat-y" => __('Tile Vertically','striking_admin'),
			),
			"type" => "select",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Feature Header Background",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Custom Image",'striking_admin'),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your custom image here or you can insert the image through the button.",'striking_admin'),
			"id" => "feature_image",
			"default" => "",
			"type" => "upload"
		),
		array(
			"name" => __("Position",'striking_admin'),
			"desc" => "",
			"id" => "feature_position_x",
			"default" => 'center',
			"options" => array(
				"left" => __('Left','striking_admin'),
				"center" => __('Center','striking_admin'),
				"right" => __('Right','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Repeat",'striking_admin'),
			"desc" => "",
			"id" => "feature_repeat",
			"default" => 'no-repeat',
			"options" => array(
				"no-repeat" => __('No Repeat','striking_admin'),
				"repeat" => __('Tile','striking_admin'),
				"repeat-x" => __('Tile Horizontally','striking_admin'),
				"repeat-y" => __('Tile Vertically','striking_admin'),
			),
			"type" => "select",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Page Background",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Custom Image",'striking_admin'),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your custom image here or you can insert the image through the button.",'striking_admin'),
			"id" => "page_image",
			"default" => "",
			"type" => "upload"
		),
		array(
			"name" => __("Position",'striking_admin'),
			"desc" => "",
			"id" => "page_position_x",
			"default" => 'center',
			"options" => array(
				"left" => __('Left','striking_admin'),
				"center" => __('Center','striking_admin'),
				"right" => __('Right','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Repeat",'striking_admin'),
			"desc" => "",
			"id" => "page_repeat",
			"default" => 'no-repeat',
			"options" => array(
				"no-repeat" => __('No Repeat','striking_admin'),
				"repeat" => __('Tile','striking_admin'),
				"repeat-x" => __('Tile Horizontally','striking_admin'),
				"repeat-y" => __('Tile Vertically','striking_admin'),
			),
			"type" => "select",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Footer Background",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Custom Image",'striking_admin'),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your custom image here or you can insert the image through the button.",'striking_admin'),
			"id" => "footer_image",
			"default" => "",
			"type" => "upload"
		),
		array(
			"name" => __("Position",'striking_admin'),
			"desc" => "",
			"id" => "footer_position_x",
			"default" => 'center',
			"options" => array(
				"left" => __('Left','striking_admin'),
				"center" => __('Center','striking_admin'),
				"right" => __('Right','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Repeat",'striking_admin'),
			"desc" => "",
			"id" => "footer_repeat",
			"default" => 'no-repeat',
			"options" => array(
				"no-repeat" => __('No Repeat','striking_admin'),
				"repeat" => __('Tile','striking_admin'),
				"repeat-x" => __('Tile Horizontally','striking_admin'),
				"repeat-y" => __('Tile Vertically','striking_admin'),
			),
			"type" => "select",
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'background',
	'options' => $options
);