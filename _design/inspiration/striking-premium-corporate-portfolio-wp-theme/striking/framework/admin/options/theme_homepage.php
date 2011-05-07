<?php
if (! function_exists("theme_home_page_process")) {
	function theme_home_page_process($option,$value) {
		update_option( 'page_on_front', $value );
		if(!empty($value)){
			update_option( 'show_on_front', 'page' );
		}else{
			if(!get_option('page_for_posts')){
				update_option( 'show_on_front', 'posts' );
			}
		}
		return $value;
	}
}

if (! function_exists("theme_homepage_shortcode_generator")){
	function theme_homepage_shortcode_generator(){
		require_once (THEME_HELPERS . '/homepageShortcodesGenerator.php');
		$shortcodes = include(THEME_ADMIN_METABOXES . '/shortcode_options.php');

		echo '<tr colspan="2"><td>';
		echo '<table cellspacing="0" class="widefat homepage-shortcode"><thead><tr><th scope="row">'.__('Shortcode Generator','striking_admin').'</th></tr></thead><tbody><tr><td>';
		
		new homepageShortcodesGenerator($shortcodes);

		echo '</td></tr></tbody></table>';
		echo '</td></tr>';
	}
}
$options = array(
	array(
		"name" => __("Homepage",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Homepage General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Home Page",'striking_admin'),
			"desc" => __("The page you choose here will display in the homepage. You do not needed to specify a page for homepage unless you want multi-language support.",'striking_admin'),
			"id" => "home_page",
			"page" => 0,
			"default" => 0,
			"prompt" => __("None",'striking_admin'),
			"type" => "select",
			"process" => "theme_home_page_process"
		),
		array(
			"name" => __("Layout",'striking_admin'),
			"desc" => "",
			"id" => "layout",
			"default" => 'full',
			"options" => array(
				"full" => __('Full Width','striking_admin'),
				"right" => __('Right Sidebar','striking_admin'),
				"left" => __('Left Sidebar','striking_admin'),
			),
			"type" => "select",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Homepage SlideShow",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Disable SlideShow",'striking_admin'),
			"desc" => __("If you do not want a home page slideshow, turn on the button.",'striking_admin'),
			"id" => "disable_slideshow",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("SlideShow Category",'striking_admin'),
			"desc" => __("Select which slidershow Category to use on the home page.",'striking_admin'),
			"id" => "slideshow_category",
			"target" => "slideshow_category",
			"default" => "",
			"prompt" => __("All",'striking_admin'),
			"type" => "select",
		),
		array(
			"name" => __("SlideShow Type",'striking_admin'),
			"desc" => __("Select which slidershow type to use on the home page.",'striking_admin'),
			"id" => "slideshow_type",
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
		"type" => "end"
	),
	array(
		"name" => __("Homepage Content Editor",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Homepage Content Editor",'striking_admin'),
			"desc" => __("The text you enter here will display on the homepage",'striking_admin'),
			"id" => "content",
			"default" => "",
			"type" => "editor"
		),
		array(
			"id" => __("shortcode_generator",'striking_admin'),
			"layout" => false,
			"function" => "theme_homepage_shortcode_generator",
			"default" => false,
			"type" => "custom"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'homepage',
	'options' => $options
);