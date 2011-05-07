<?php
$options = array(
	array(
		"name" => __("Font",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Font General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Font family",'striking_admin'),
			"desc" => '',
			"id" => "font_family",
			"default" => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
			"options" => array(
				'"Arial Black",Gadget,sans-serif' => '"Arial Black",Gadget,sans-serif',
				'Arial,Helvetica,Garuda,sans-serif' => 'Arial,Helvetica,Garuda,sans-serif',
				'Verdana,Geneva,Kalimati,sans-serif' => 'Verdana,Geneva,Kalimati,sans-serif',
				'"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif' => '"Lucida Sans Unicode","Lucida Grande",Garuda,sans-serif',
				'Georgia,"Nimbus Roman No9 L",serif' => 'Georgia,"Nimbus Roman No9 L",serif',
				'"Palatino Linotype","Book Antiqua",Palatino,FreeSerif,serif' => '"Palatino Linotype","Book Antiqua",Palatino,FreeSerif,serif',
				'Tahoma,Geneva,Kalimati,sans-serif' => 'Tahoma,Geneva,Kalimati,sans-serif',
				'"Trebuchet MS",Helvetica,Jamrul,sans-serif' => '"Trebuchet MS",Helvetica,Jamrul,sans-serif',
				'"Times New Roman",Times,FreeSerif,serif' => '"Times New Roman",Times,FreeSerif,serif',
			),
			"type" => "select",
		),
		array(
			"name" => __("Line height",'striking_admin'),
			"desc" => "",
			"id" => "line_height",
			"min" => "12",
			"max" => "30",
			"step" => "1",
			"unit" => 'px',
			"default" => "20",
			"type" => "range"
		),
		array(
			"name" => __("Link Hover Underline",'striking_admin'),
			"desc" => "",
			"id" => "link_underline",
			"default" => false,
			"type" => "toggle"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => __("Font Size Setting",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Logo Text Size",'striking_admin'),
			"desc" => "",
			"id" => "site_name",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "40",
			"type" => "range"
		),
		array(
			"name" => __("Logo Description Size",'striking_admin'),
			"desc" => "",
			"id" => "site_description",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "11",
			"type" => "range"
		),
		array(
			"name" => __("Top Level Menu Text Size",'striking_admin'),
			"desc" => "",
			"id" => "menu_top",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "17",
			"type" => "range"
		),
		array(
			"name" => __("Sub Level Menu Text Size",'striking_admin'),
			"desc" => "",
			"id" => "menu_sub",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "14",
			"type" => "range"
		),
		array(
			"name" => __("Feature Header Title Size",'striking_admin'),
			"desc" => "",
			"id" => "feature_header",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "42",
			"type" => "range"
		),
		array(
			"name" => __("Feature Header Custom Text Size",'striking_admin'),
			"desc" => "",
			"id" => "feature_introduce",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "21",
			"type" => "range"
		),
		array(
			"name" => __("Anything Slider Desc Text Size",'striking_admin'),
			"desc" => "",
			"id" => "anything_desc",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "12",
			"type" => "range"
		),
		array(
			"name" => __("Page Text Size",'striking_admin'),
			"desc" => "",
			"id" => "page",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "12",
			"type" => "range"
		),
		array(
			"name" => sprintf(__("%s Size",'striking_admin'),'H1'),
			"desc" => "",
			"id" => "h1",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "36",
			"type" => "range"
		),
		array(
			"name" => sprintf(__("%s Size",'striking_admin'),'H2'),
			"desc" => "",
			"id" => "h2",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "30",
			"type" => "range"
		),
		array(
			"name" =>  sprintf(__("%s Size",'striking_admin'),'H3'),
			"desc" => "",
			"id" => "h3",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "24",
			"type" => "range"
		),
		array(
			"name" =>  sprintf(__("%s Size",'striking_admin'),'H4'),
			"desc" => "",
			"id" => "h4",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "18",
			"type" => "range"
		),
		array(
			"name" =>  sprintf(__("%s Size",'striking_admin'),'H5'),
			"desc" => "",
			"id" => "h5",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "14",
			"type" => "range"
		),
		array(
			"name" =>  sprintf(__("%s Size",'striking_admin'),'H6'),
			"desc" => "",
			"id" => "h6",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "12",
			"type" => "range"
		),
		array(
			"name" => __("Blog Post Title Size",'striking_admin'),
			"desc" => "",
			"id" => "entry_title",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "36",
			"type" => "range"
		),
		array(
			"name" => __("Portfolio Title Size",'striking_admin'),
			"desc" => "",
			"id" => "portfolio_title",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "24",
			"type" => "range"
		),
		array(
			"name" => __("Sidebar Widget Title",'striking_admin'),
			"desc" => "",
			"id" => "widget_title",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "24",
			"type" => "range"
		),
		array(
			"name" => __("Footer Text Title",'striking_admin'),
			"desc" => "",
			"id" => "footer_text",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "12",
			"type" => "range"
		),
		array(
			"name" => __("Footer Widget Title",'striking_admin'),
			"desc" => "",
			"id" => "footer_title",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "24",
			"type" => "range"
		),
		array(
			"name" => __("Copyright Text Size",'striking_admin'),
			"desc" => "",
			"id" => "copyright",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "14",
			"type" => "range"
		),
		array(
			"name" => __("Footer Menu Text Size",'striking_admin'),
			"desc" => "",
			"id" => "footer_menu",
			"min" => "1",
			"max" => "60",
			"step" => "1",
			"unit" => 'px',
			"default" => "12",
			"type" => "range"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'font',
	'options' => $options
);