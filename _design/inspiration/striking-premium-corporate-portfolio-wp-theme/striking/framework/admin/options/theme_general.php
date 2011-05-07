<?php
$options = array(
	array(
		"name" => __("General",'striking_admin'),
		"type" => "title",
	),
	array(
		"name" => __("Header General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Header Height",'striking_admin'),
			"desc" => "",
			"id" => "header_height",
			"min" => "60",
			"max" => "300",
			"step" => "1",
			"unit" => 'px',
			"default" => "90",
			"type" => "range"
		),
		array(
			"name" => __("Display Custom Logo",'striking_admin'),
			"desc" => sprintf(__('If this option is on, you should fill the text field below. Or you should define "Site Title" in <a href="%s/wp-admin/options-general.php">Settings->General</a> instead of a logo
image.','striking_admin'),get_option('siteurl')),
			"id" => "display_logo",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Custom Logo",'striking_admin'),
			"desc" =>__( "Paste the full URL (include <code>http://</code>) of your custom logo here or you can insert the image through the button.",'striking_admin'),
			"id" => "logo",
			"default" => "",
			"type" => "upload"
		),
		array(
			"name" => __("Display Site Description",'striking_admin'),
			"desc" => sprintf(__('If you disable custom logo, you can choose whether to display <a href="%s/wp-admin/options-general.php">Tagline</a> after Site Title.','striking_admin'),get_option('siteurl')),
			"id" => "display_site_desc",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Logo Bottom",'striking_admin'),
			"desc" => "",
			"id" => "logo_bottom",
			"min" => "-50",
			"max" => "50",
			"step" => "1",
			"unit" => 'px',
			"default" => "20",
			"type" => "range"
		),
		array(
			"name" => __("Header Widget Area",'striking_admin'),
			"desc" => "",
			"id" => "top_area_type",
			"default" => 'none',
			"options" => array(
				"html" => __('Html','striking_admin'),
				"wpml_flags" => __('Wpml Flags','striking_admin'),
				"widget" => __('Widget Area','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Header Widget Area Html Code",'striking_admin'),
			"desc" => '',
			"id" => "top_area_html",
			"default" => "",
			'rows' => '3',
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Navigation Menu",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Navigation Button Style",'striking_admin'),
			"desc" => __("If this option is on, you will see button effect when you hover the navigation items.",'striking_admin'),
			"id" => "nav_button",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Wordpress Built-in Menu",'striking_admin'),
			"desc" => sprintf(__("If this option is on, you can control over your sites menu with WordPress’s new Navigation Menus feature. See here: <a href=\"%s/wp-admin/nav-menus.php\">%s/wp-admin/nav-menus.php</a>",'striking_admin'),get_option('siteurl'),get_option('siteurl')),
			"id" => "enable_nav_menu",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Exclude Pages From Menu",'striking_admin'),
			"desc" => __("If Wordpress Built-in Menu is off, we will show all pages except pages selected below in the menu.",'striking_admin'),
			"id" => "excluded_pages",
			"default" => array(),
			"page" => '0',
			"prompt" => __("Choose page..",'striking_admin'),
			"type" => "multidropdown",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Page General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Custom Favicon",'striking_admin'),
			"desc" => __("Paste the full URL (include <code>http://</code>) of your custom favicon here, or you can insert the icon through the button.",'striking_admin'),
			"id" => "custom_favicon",
			"default" => '',
			"button" => 'Insert Icon',
			"type" => 'upload',
		),
		array(
			"name" => __("Feature Header",'striking_admin'),
			"desc" => __("If this option is off, you'll globally disable your website's Feature header.",'striking_admin'),
			"id" => "introduce",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Disable Breadcrumbs",'striking_admin'),
			"desc" => __("If this option is on, you'll globally disable your website's breadcrumb navigation.",'striking_admin'),
			"id" => "disable_breadcrumb",
			"default" => true,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),	
	array(
		"name" => __("Google Analytics Code",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Google Analytics Position",'striking_admin'),
			"id" => "analytics_position",
			"default" => 'bottom',
			"options" => array(
				"header" => __('Header','striking_admin'),
				"bottom" => __('Bottom','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Google Analytics Code",'striking_admin'),
			"desc" => __("Paste your <a href='http://www.google.com/analytics/' target='_blank'>analytics code</a> here, it will get applied to each page.",'striking_admin'),
			"id" => "analytics",
			"default" => "",
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),
	
	array(
		"name" => __("Google Map",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Enable Google Map",'striking_admin'),
			"desc" => __("If you want to use google map shortcode, please turn on the toggle. It will load the require scripts for integrating google map support.",'striking_admin'),
			"id" => "enable_gmap",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Google Maps API Key",'striking_admin'),
			"desc" => __("Paste your Google Maps API Key here. If you don't have one, please sign up for a <a href='http://code.google.com/intl/en-US/apis/maps/signup.html'>Google Maps API key</a>.",'striking_admin'),
			"id" => "gmap_api_key",
			"default" => "",
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),

	array(
		"name" => __("Custom CSS",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Custom CSS",'striking_admin'),
			"desc" => '',
			"id" => "custom_css",
			"default" => "",
			'rows' => '10',
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'general',
	'options' => $options
);