<?php
if (! function_exists("theme_blog_page_process")) {
	function theme_blog_page_process($option,$value) {
		if(!empty($value)){
			update_option( 'page_for_posts', $value );
		}
		return $value;
	}
}

$options = array(
	array(
		"name" => __("Blog",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Blog General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Blog Page",'striking_admin'),
			"desc" => __("The page you choose here will display the blog",'striking_admin'),
			"id" => "blog_page",
			"page" => 0,
			"default" => 0,
			"prompt" => __("None",'striking_admin'),
			"type" => "select",
			"process" => "theme_blog_page_process"
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
			"name" => __("Featured Image Type",'striking_admin'),
			"desc" => "",
			"id" => "featured_image_type",
			"default" => 'full',
			"options" => array(
				"full" => __('Full Width','striking_admin'),
				"left" => __('Left Float','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Display Full Blog Posts",'striking_admin'),
			"desc" => __("This option determinate whether to display full blog posts in index page.",'striking_admin'),
			"id" => "display_full",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Exclude Categories",'striking_admin'),
			"desc" => __("The blog Page usually displays all Categorys, since sometimes you want to exclude some of these categories you can exclude multiple categories here:",'striking_admin'),
			"id" => "exclude_categorys",
			"default" => array(),
			"target" => "cat",
			"prompt" => __("Choose category..",'striking_admin'),
			"type" => "multidropdown"
		),
		array(
			"name" => __("Gap Between Posts",'striking_admin'),
			"desc" => "",
			"id" => "posts_gap",
			"min" => "0",
			"max" => "200",
			"step" => "1",
			"unit" => 'px',
			"default" => "80",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Single Blog",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Layout",'striking_admin'),
			"desc" => "",
			"id" => "single_layout",
			"default" => 'right',
			"options" => array(
				"full" => __('Full Width','striking_admin'),
				"right" => __('Right Sidebar','striking_admin'),
				"left" => __('Left Sidebar','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Featured Image",'striking_admin'),
			"desc" => __("If this option is on, Featured Image will appear in Single Blog page.",'striking_admin'),
			"id" => "featured_image",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Featured Image Type",'striking_admin'),
			"desc" => "",
			"id" => "single_featured_image_type",
			"default" => 'full',
			"options" => array(
				"full" => __('Full Width','striking_admin'),
				"left" => __('Left Float','striking_admin'),
			),
			"type" => "select",
		),
		array(
			"name" => __("Featured Image for Lightbox",'striking_admin'),
			"desc" => __("If this option is on, the full image will open in the lightbox when click on Featured Image of Blog Single Post page.",'striking_admin'),
			"id" => "featured_image_lightbox",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Show in Header Area",'striking_admin'),
			"desc" => __("if this option is on, blog title and blog meta info will show in header introduce text area.",'striking_admin'),
			"id" => "show_in_header",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("About Author Box",'striking_admin'),
			"desc" => "",
			"id" => "author",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Related & Popular Post Module",'striking_admin'),
			"desc" => "",
			"id" => "related_popular",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Previous & Next Navigation",'striking_admin'),
			"desc" => "",
			"id" => "entry_navigation",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Meta informations",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Category",'striking_admin'),
			"desc" => "",
			"id" => "meta_category",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Tags",'striking_admin'),
			"desc" => "",
			"id" => "meta_tags",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Author",'striking_admin'),
			"desc" => "",
			"id" => "meta_author",
			"default" => false,
			"type" => "toggle"
		),
		array(
			"name" => __("Date",'striking_admin'),
			"desc" => "",
			"id" => "meta_date",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Comment",'striking_admin'),
			"desc" => "",
			"id" => "meta_comment",
			"default" => true,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Full Width Featured Image",'striking_admin'),
		"type" => "start"
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
		"name" => __("Left Float Featured Image",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Width",'striking_admin'),
			"id" => "left_width",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "200",
			"type" => "range"
		),
		array(
			"name" => __("Height",'striking_admin'),
			"id" => "left_height",
			"min" => "1",
			"max" => "600",
			"step" => "1",
			"unit" => 'px',
			"default" => "200",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'blog',
	'options' => $options
);