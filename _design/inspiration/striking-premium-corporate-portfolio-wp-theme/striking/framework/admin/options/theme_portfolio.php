<?php
if (! function_exists("theme_rewrite_flush_rules")) {
	function theme_rewrite_flush_rules($option,$value) {
		if(theme_get_option('portfolio','permalink_slug') != $value){
			theme_ajax_flush_rewrite_rules();
		}
		
		return $value;
	}
	
	function theme_ajax_flush_rewrite_rules() {
?>
<script type="text/javascript" >
jQuery(document).ready(function($) {
	var data = {
		action: 'theme-flush-rewrite-rules'
	};
	jQuery.post(ajaxurl, data, function(response) {
		
	});
});
</script>
<?php
	}
}

$options = array(
	array(
		"name" => __("Portfolio",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Portfolio General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Breadcrumbs Parent Page",'striking_admin'),
			"desc" => __("If set will enable portfolio item breadcrumbs. The page you choose here will be the parent page of portfolio items on the breadcrumbs. This will override the global configuration.",'striking_admin'),
			"id" => "breadcrumbs_page",
			"page" => 0,
			"default" => 0,
			"prompt" => __("None",'striking_admin'),
			"type" => "select",
		),
		array(
			"name" => __("Display Title",'striking_admin'),
			"desc" => "",
			"id" => "display_title",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Display Description",'striking_admin'),
			"desc" => "",
			"id" => "display_excerpt",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Display More Button",'striking_admin'),
			"desc" => "",
			"id" => "display_more_button",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("More Button Text",'striking_admin'),
			"desc" => "",
			"size" => 30,
			"id" => "more_button_text",
			"default" => 'Read More »',
			"type" => "text",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Portfolio Rewrite URL",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Permalink Slug",'striking_admin'),
			"desc" => "Permalink Slug is used for build URLs of portfolio. If this value is empty, it will use 'portfolio' for build URL.",
			"size" => 30,
			"id" => "permalink_slug",
			"default" => '',
			"process" => 'theme_rewrite_flush_rules',
			"type" => "text",
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Height of Thumbnail",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("One Column",'striking_admin'),
			"desc" => sprintf(__("%s in width",'striking_admin'),'600px'),
			"id" => "1_column_height",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "350",
			"type" => "range"
		),
		array(
			"name" => __("Two Columns",'striking_admin'),
			"desc" => sprintf(__("%s in width",'striking_admin'),'450px'),
			"id" => "2_columns_height",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "250",
			"type" => "range"
		),
		array(
			"name" => __("Three Columns",'striking_admin'),
			"desc" => sprintf(__("%s in width",'striking_admin'),'292px'),
			"id" => "3_columns_height",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "180",
			"type" => "range"
		),
		array(
			"name" => __("Four Columns",'striking_admin'),
			"desc" => sprintf(__("%s in width",'striking_admin'),'217px'),
			"id" => "4_columns_height",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "150",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Video Type's Lightbox Dimension",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "video_width",
			"default" => 640,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "video_height",
			"default" => 390,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Lightbox Type's Lightbox Dimension",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"desc" => "",
			"id" => "lightbox_width",
			"default" => 640,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"desc" => "",
			"id" => "lightbox_height",
			"default" => 390,
			"min" => 0,
			"max" => 960,
			"unit" => 'px',
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Featured Image",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Featured Image",'striking_admin'),
			"desc" => __("If this option is on, Featured Image will appear in Portfolio Item page.",'striking_admin'),
			"id" => "featured_image",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Featured Image for Lightbox",'striking_admin'),
			"desc" => __("If this option is on, the full image will open in the lightbox when click on Featured Image of Portfolio Item page.",'striking_admin'),
			"id" => "featured_image_lightbox",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Adaptive Height",'striking_admin'),
			"desc" => __("If this option is on, the height of the featured image depand on the scale of the image.",'striking_admin'),
			"id" => "adaptive_height",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Fixed Height",'striking_admin'),
			"desc" => __("If the option above is off, it will take effect.",'striking_admin'),
			"id" => "fixed_height",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "250",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Single Portfolio Item",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Layout",'striking_admin'),
			"desc" => "",
			"id" => "layout",
			"default" => 'right',
			"options" => array(
				"full" => __('Full Width','striking_admin'),
				"right" => __('Right Sidebar','striking_admin'),
				"left" => __('Left Sidebar','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Previous & Next Navigation",'striking_admin'),
			"desc" => "",
			"id" => "single_navigation",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Previous & Next Navigation Order",'striking_admin'),
			"desc" => "",
			"id" => "single_navigation_order",
			"default" => 'post_data',
			"options" => array(
				"post_data" => __('Post Data','striking_admin'),
				"menu_order" => __('Menu Order','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Document Type Navigation",'striking_admin'),
			"desc" => "If this option is on, the Previous & Next Navigation will only apply to Document type of Portfolio",
			"id" => "single_doc_navigation",
			"default" => true,
			"type" => "toggle"
		),
		
		array(
			"name" => __("Enable Comment",'striking_admin'),
			"desc" => "",
			"id" => "enable_comment",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'portfolio',
	'options' => $options
);