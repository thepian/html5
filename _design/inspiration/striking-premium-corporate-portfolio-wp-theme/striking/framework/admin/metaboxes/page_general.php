<?php
$config = array(
	'title' => sprintf(__('%s Page General Options','striking_admin'),THEME_NAME),
	'id' => 'page_general',
	'pages' => theme_get_option('advance','page_general'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
function get_sidebar_options(){
	$sidebars = theme_get_option('sidebar','sidebars');
	if(!empty($sidebars)){
		$sidebars_array = explode(',',$sidebars);
		
		$options = array();
		foreach ($sidebars_array as $sidebar){
			$options[$sidebar] = $sidebar;
		}
		return $options;
	}else{
		return array();
	}
}
$options = array(
	array(
		"name" => __("Feature Header Type",'striking_admin'),
		"desc" => __("Here you can override the general feature header on a post by post basis.",'striking_admin'),
		"id" => "_introduce_text_type",
		"options" => array(
			"default" => "Default",
			"title" => "Title only",
			"custom" => "Custom text only",
			"title_custom" => "Title & custom text",
			"slideshow" => "SlideShow",
			"disable" => "Disable",
		),
		"default" => "default",
		"type" => "radio"
	),
	array(
		"name" => __("Feature Header Custom Title",'striking_admin'),
		"desc" => __('If any text you enter here will override your default feature header title.','striking_admin'),
		"id" => "_custom_title",
		"default" => "",
		"class" => 'full',
		"type" => "text"		
	),
	array(
		"name" => __("Feature Header Custom Text",'striking_admin'),
		"desc" => __('If the "custom text" option is selected above any text you enter here will override your general feautre header text .','striking_admin'),
		"id" => "_custom_introduce_text",
		"rows" => "2",
		"default" => "",
		"type" => "textarea"
	),
	array(
			"name" => __("SlideShow Category",'striking_admin'),
			"desc" => __("Select which slidershow Category to use. It only available when the type of  feature header is slideshow",'striking_admin'),
			"id" => "_slideshow_category",
			"target" => "slideshow_category",
			"default" => "",
			"prompt" => __("All",'striking_admin'),
			"type" => "select",
	),
	array(
			"name" => __("SlideShow Type",'striking_admin'),
			"desc" => __("Select which slidershow type to use.",'striking_admin'),
			"id" => "_slideshow_type",
			"default" => 'nivo',
			"options" => array(
				"nivo" => __('jQuery Nivo Slider','striking_admin'),
				"3d" => __('3D Flash Image Rotator','striking_admin'),
				"kwicks" => __('Accordion Slider','striking_admin'),
				"anything" => __('Anything Slider','striking_admin'),
			),
			"type" => "select",
	),
	array(
		"name" => __("Feature Header Background Color",'striking_admin'),
		"desc" => __("If you specify a color below, this will override the global configuration. Set transparent to disable this.",'striking_admin'),
		"id" => "_introduce_background_color",
		"default" => "",
		"type" => "color"		
	),
	array(
		"name" => __("Footer Background Color",'striking_admin'),
		"desc" => __("If you specify a color below, this will override the global configuration. Set transparent to disable this.",'striking_admin'),
		"id" => "_footer_background_color",
		"default" => "",
		"type" => "color"		
	),
	array(
		"name" => __("Disable Breadcrumbs",'striking_admin'),
		"desc" => __('Here you can disable breadcrumbs on a post by post basis. Alternatively you can globally disable breadcrumbs under the "General Settings" tab in your theme\'s option panel.','striking_admin'),
		"id" => "_disable_breadcrumb",
		"label" => "Check to disable breadcrumbs on this post",
		"default" => "",
		"type" => "tritoggle"
	),
	array(
		"name" => __("Custom Sidebar",'striking_admin'),
		"desc" => __("Select the custom sidebar that you'd like to be displayed on this.<br />Note: you will need to first create a custom sidebar in your themes option panel before it will show up here.",'striking_admin'),
		"id" => "_sidebar",
		"prompt" => __("Choose one..",'striking_admin'),
		"default" => '',
		"options" => get_sidebar_options(),
		"type" => "select",
	),
);

new metaboxesGenerator($config,$options);