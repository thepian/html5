<?php
if (! function_exists("theme_advance_import_option")) {
	function theme_advance_import_option($value, $default) {
		$rows = isset($value['rows']) ? $value['rows'] : '5';
		echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
		echo $default;
		echo '</textarea><br />';
		echo '</td></tr>';
	}
}
if (! function_exists("theme_advance_export_option")) {
	function theme_advance_export_option($value, $default) {
		global $theme_options;
		$rows = isset($value['rows']) ? $value['rows'] : '5';
		echo '<textarea id="'.$value['id'].'" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
		echo base64_encode(serialize($theme_options));
		echo '</textarea><br />';
		echo '</td></tr>';
	}
}
if (! function_exists("theme_advance_export_process")) {
	function theme_advance_export_process($option,$data) {
		return '';
	}
}
if (! function_exists("theme_advance_import_process")) {
	function theme_advance_import_process($option,$data) {
		if($data != ''){
			
			$options_array = unserialize( base64_decode( $data ) );
			if(is_array($options_array)){
				foreach($options_array as $name => $options){
					update_option(THEME_SLUG . '_' . $name, $options);
				}
			}
		}
		return '';
	}
}
$options = array(
	array(
		"name" => __("Advance",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Meta Box display Settings",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Page General Options",'striking_admin'),
			"id" => "page_general",
			"default" => array('post','page','portfolio'),
			"target" => 'post_types',
			"type" => "checkboxs",
		),
		array(
			"name" => __("Shortcode Generator",'striking_admin'),
			"id" => "shortcode",
			"default" => array('page','post','portfolio','slideshow'),
			"target" => 'post_types',
			"type" => "checkboxs",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Import & Export",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => sprintf(__("Import %s Options Data",'striking_admin'),THEME_NAME),
			"id" => "import",
			"desc" => __('To import the values of your theme options copy and paste what appears to be a random string of alpha numeric characters into this textarea and press the "Save Changes" button below.','striking_admin'),
			"function" => "theme_advance_import_option",
			"process" => "theme_advance_import_process",
			"type" => "custom"
		),
		array(
			"name" => sprintf(__("Export %s Options Data",'striking_admin'),THEME_NAME),
			"id" => "export",
			"desc" => __("Export your saved Theme Options data by highlighting this text and doing a copy/paste into a blank .txt file.",'striking_admin'),
			"function" => "theme_advance_export_option",
			"process" => "theme_advance_export_process",
			"type" => "custom"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("JavaScript & CSS Optimizer",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Combine Js",'striking_admin'),
			"id" => "combine_js",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Combine CSS",'striking_admin'),
			"id" => "combine_css",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Move Js To Bottom",'striking_admin'),
			"id" => "move_bottom",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'advance',
	'options' => $options
);