<?php
function theme_shortcode_iframe($atts, $content = null) {
	extract(shortcode_atts(array(
		'width' => false,
		'height' => false,
		'src' => '',
	), $atts));
	
	$width = $width?' width="'.$width.'"':'';
	$height = $height?' height="'.$height.'"':'';
	
	return '[raw]<iframe src="'.$src.'"'.$width.$height.' seamless="seamless"></iframe>[/raw]';
}

add_shortcode('iframe','theme_shortcode_iframe');