<?php

function theme_shortcode_tabs($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
		'history' => false
	), $atts));
	
	if (!preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		
		$output = '<ul class="'.$code.'">';
		
		for($i = 0; $i < count($matches[0]); $i++) {
			if($history=='true'){
				$href= '#'.str_replace(" ", "_", trim($matches[3][$i]['title']));
			}else{
				$href = '#';
			}
			$output .= '<li><a href="'.$href.'">' . $matches[3][$i]['title'] . '</a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="panes">';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		$output .= '</div>';
		
		if($history=='true'){
			$data_history = ' data-history="true"';
		}else{
			$data_history = '';
		}
		
		return '<div class="'.$code.'_container"'.$data_history.'>' . $output . '</div>';
	}
}
add_shortcode('tabs', 'theme_shortcode_tabs');
add_shortcode('mini_tabs', 'theme_shortcode_tabs');

function theme_shortcode_accordions($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'style' => false,
	), $atts));
	
	if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
		}
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$output .= '<div class="tab">' . $matches[3][$i]['title'] . '</div>';
			$output .= '<div class="pane">' . do_shortcode(trim($matches[5][$i])) . '</div>';
		}
		
		return '<div class="accordion">' . $output . '</div>';
	}
}
add_shortcode('accordions', 'theme_shortcode_accordions');

function theme_shortcode_toggle($atts, $content = null, $code) {
	extract(shortcode_atts(array(
		'title' => false
	), $atts));
	return '<div class="toggle"><h4 class="toggle_title">' . $title . '</h4><div class="toggle_content">' . do_shortcode(trim($content)) . '</div></div>';
}
add_shortcode('toggle', 'theme_shortcode_toggle');
