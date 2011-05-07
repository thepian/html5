<?php 
	/* general settings */
	$logo_bottom = theme_get_option('general','logo_bottom');
	$header_height = theme_get_option('general','header_height');
	
	/* background settings */
	$background = theme_get_option('background');
	if(!empty($background['header_image'])){
		$header_image = <<<CSS
	background-image: url('{$background['header_image']}');
	background-repeat: {$background['header_repeat']};
	background-position: top {$background['header_position_x']};
	background-attachment: scroll
CSS;
	}else{
		$header_image = '';
	}
	if(!empty($background['feature_image'])){
		$feature_image = <<<CSS
	background-image: url('{$background['feature_image']}');
	background-repeat: {$background['feature_repeat']};
	background-position: top {$background['feature_position_x']};
	background-attachment: scroll
CSS;
	}else{
		$feature_image = '';
	}
	if(!empty($background['page_image'])){
		$page_image = <<<CSS
	background-image: url('{$background['page_image']}');
	background-repeat: {$background['page_repeat']};
	background-position: top {$background['page_position_x']};
	background-attachment: scroll
CSS;
		$page_bottom_image = <<<CSS
#page_bottom{
	background-image:none;
}
CSS;
	}else{
		$page_image = '';
		$page_bottom_image = '';
	}
	if(!empty($background['footer_image'])){
		$footer_image = <<<CSS
	background-image: url('{$background['footer_image']}');
	background-repeat: {$background['footer_repeat']};
	background-position: top {$background['footer_position_x']};
	background-attachment: scroll
CSS;
	}else{
		$footer_image = '';
	}
	
	/* font settings */
	$font = theme_get_option('font');

	$font['font_family']=stripslashes($font['font_family']);
	if($font['link_underline']){
		$font['link_underline']='underline';
	}else{
		$font['link_underline']='none';
	}
	
	/* fontface */
	$fontface = theme_get_option('fontface');
	
	$fontface_css = '';
	if($fontface['enable_fontface']){
		if(is_array($fontface['fonts'])){
			foreach ($fontface['fonts'] as $font_str){
				$font_info = explode("|", $font_str);
				$stylesheet = THEME_FONTFACE_DIR.'/'.$font_info[0].'/stylesheet.css';
				if(file_exists($stylesheet)){
					$file_content = file_get_contents($stylesheet);
					if( preg_match("/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$font_info[1]\\1.*?}/is", $file_content, $match) ){
						$fontface_css .= preg_replace("/url\s*\(\s*['|\"]\s*/is","\\0../fontfaces/$font_info[0]/",$match[0])."\n";
					}
				}
			}
		}
		
		$code = stripslashes(theme_get_option('fontface','code'));
		if(trim($code) == '' && isset($font_info[1])){
			$code =  <<<CSS
#site_name, #site_description, 
.kwick_title, .kwick_detail h3, 
#navigation a, 
.portfolio_title, 
.dropcap1, .dropcap2, .dropcap3, .dropcap4, 
h1,h2,h3,h4,h5,h6,
#feature h1, #introduce, 
#footer h3, #copyright{
	font-family: {$font_info[1]};
}
CSS;
		}
		$fontface_css .= $code;
	}
	
	/* color settings */
	$color = theme_get_option('color');
	if($color['page_h1']==''){
		$color['page_h1']=$color['page_header'];
	}
	if($color['page_h2']==''){
		$color['page_h2']=$color['page_header'];
	}
	if($color['page_h3']==''){
		$color['page_h3']=$color['page_header'];
	}
	if($color['page_h4']==''){
		$color['page_h4']=$color['page_header'];
	}
	if($color['page_h5']==''){
		$color['page_h5']=$color['page_header'];
	}
	if($color['page_h6']==''){
		$color['page_h6']=$color['page_header'];
	}
	// menu settings
	$menu_css = '';
	if($color['menu_top_active_background']){
		$menu_css .= <<<CSS
#navigation .menu > .hover > a {
	background-color: {$color['menu_top_active_background']};
	color: {$color['menu_top_active']}
}
CSS;
	}
	if($color['menu_top_current_background']){
		$menu_css .= <<<CSS
#navigation .menu > .current-menu-item > a,#navigation .menu > .current-menu-item > a:visited,
#navigation .menu > .current-menu-ancestor > a {
	background-color: {$color['menu_top_current_background']};
}
#navigation .menu > .current_page_item > a,#navigation .menu > .current_page_item > a:visited,
#navigation .menu > .current_page_ancestor > a {
	background-color: {$color['menu_top_current_background']};
}
CSS;
	}
	$nav_button = theme_get_option('general','nav_button');
	if($nav_button){
		$menu_css .= <<<CSS
#navigation > ul > li {
	height: 60px;
}
#navigation > ul > li > a {
	height:auto;
	line-height: 100%;
	padding: 10px 15px;
	margin: 10px 5px 0 0;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
}
CSS;
	}
	
	foreach($color as $key => $value){
		if($value == ''){
			$color[$key]='transparent';
		}
	}
	
	
	
	/* slideshow settings */
	$nivo_height = theme_get_option('slideshow','nivo_height');
	$nivo_frame_height = $nivo_height - 1;
	$kwicks_height = theme_get_option('slideshow','kwicks_height');
	$kwicks_frame_height = $kwicks_height - 1;
	$anything_height = theme_get_option('slideshow','anything_height');
	$anything_caption_height = $anything_height - 30;
	
	/* blog settings */
	$posts_gap = theme_get_option('blog','posts_gap');
	$blog_left_image_width = theme_get_option('blog', 'left_width');
	$blog_left_image_height = theme_get_option('blog','left_height');
	$blog_left_image_shadow_width = $blog_left_image_width +2;
	$custom_css =  stripslashes(theme_get_option('general','custom_css'));
		
	
	return <<<CSS
body {
	font-family: {$font['font_family']};
	line-height: {$font['line_height']}px;
}
{$fontface_css}
#header {
	height: {$header_height}px;
	background-color: {$color['header_bg']};
{$header_image}
}
#site_name {
	color: {$color['site_name']};
	font-size: {$font['site_name']}px;
}
#site_description {
	color: {$color['site_description']};
	font-size: {$font['site_description']}px;
}
#logo, #logo_text {
	bottom: {$logo_bottom}px;
}
{$menu_css}
#navigation ul li a, #navigation ul li a:visited {
	font-size: {$font['menu_top']}px;
	color: {$color['menu_top']};
}
#navigation .menu > .current-menu-item > a,#navigation .menu > .current-menu-item > a:visited,
#navigation .menu > .current-menu-ancestor > a {
	color: {$color['menu_top_current']};
}
#navigation .menu > .current_page_item > a,#navigation .menu > .current_page_item > a:visited,
#navigation .menu > .current_page_ancestor > a {
	color: {$color['menu_top_current']};
}
#navigation ul li a:hover, #navigation ul li a:active {
	color: {$color['menu_top_active']};
}
#navigation ul ul li a, #navigation ul ul li a:visited {
	font-size: {$font['menu_sub']}px;
	color: {$color['menu_sub']};
}
#navigation ul ul li a:hover, #navigation ul ul li a:active {
	color: {$color['menu_sub_active']};
}
#navigation ul li ul {
	background-color: {$color['menu_sub_background']};
}
#navigation ul li ul li a:hover, #navigation ul ul li a:hover {
	background-color: {$color['menu_sub_hover_background']};
}
a:hover {
	text-decoration:{$font['link_underline']};
}
#feature {
	background-color: {$color['feature_bg']};
{$feature_image}
}
#feature h1 {
	font-size: {$font['feature_header']}px;
	color: {$color['feature_header']};
}
#introduce {
	font-size: {$font['feature_introduce']}px;
	color: {$color['feature_introduce']};
}
#introduce a {
	color: {$color['feature_introduce']};
}
#page {
	background-color: {$color['page_bg']};
{$page_image}
	color: {$color['page']};
	font-size: {$font['page']}px;
}
{$page_bottom_image}
ul.mini_tabs li.current, ul.mini_tabs li.current a {
	background-color: {$color['page_bg']};
}
.divider.top a {
	background-color: {$color['page_bg']};
}
#page h1,#page h2,#page h3,#page h4,#page h5,#page h6{
	color: {$color['page_header']};
}
#page h1 {
	color: {$color['page_h1']};
}
#page h2 {
	color: {$color['page_h2']};
}
#page h3 {
	color: {$color['page_h3']};
}
#page h4 {
	color: {$color['page_h4']};
}
#page h5 {
	color: {$color['page_h5']};
}
#page h6 {
	color: {$color['page_h6']};
}
#page a, #page a:visited {
	color: {$color['page_link']};
}
#page a:hover, #page a:active {
	color: {$color['page_link_active']};
}
#page h1 a,#page h1 a:visited,#page h1 a:hover,#page h1 a:active {
	color: {$color['page_h1']};
}
#page h2 a,#page h2 a:visited,#page h2 a:hover,#page h2 a:active {
	color: {$color['page_h2']};
}
#page h3 a,#page h3 a:visited,#page h3 a:hover,#page h3 a:active {
	color: {$color['page_h3']};
}
#page h4 a,#page h4 a:visited,#page h4 a:hover,#page h4 a:active {
	color: {$color['page_h4']};
}
#page h5 a,#page h5 a:visited,#page h5 a:hover,#page h5 a:active {
	color: {$color['page_h5']};
}
#page h6 a,#page h6 a:visited,#page h6 a:hover,#page h6 a:active {
	color: {$color['page_h6']};
}
#page .portfolios.sortable header a {
	background-color:{$color['portfolio_header_bg']};
	color:{$color['portfolio_header_text']};
}
#page .portfolios.sortable header a.current, #page .portfolios.sortable header a:hover {
	background-color:{$color['portfolio_header_active_bg']};
	color:{$color['portfolio_header_active_text']};
}
#sidebar .widget a, #sidebar .widget a:visited {
	color: {$color['sidebar_link']};
}
#sidebar .widget a:hover, #sidebar .widget a:active {
	color: {$color['sidebar_link_active']};
}
#sidebar .widgettitle {
	color: {$color['widget_title']};
	font-size: {$font['widget_title']}px;
}
#breadcrumbs {
	color: {$color['breadcrumbs']};
}
#breadcrumbs a, #breadcrumbs a:visited {
	color: {$color['breadcrumbs_link']};
}
#breadcrumbs a:hover, #breadcrumbs a:active {
	color: {$color['breadcrumbs_active']};
}
.portfolio_title {
	font-size: {$font['portfolio_title']}px;
	color: {$color['portfolio_title']};
}
#footer {
	background-color:{$color['footer_bg']};
	color: {$color['footer_text']};
	font-size: {$font['footer_text']}px;
{$footer_image}
}
#footer .widget a, #footer .widget a:visited{
	color: {$color['footer_link']};
}
#footer .widget a:active, #footer .widget a:hover{
	color: {$color['footer_link_active']};
}
#footer h3.widgettitle {
	color: {$color['footer_title']};
	font-size: {$font['footer_title']}px;
}
#footer_bottom {
	background-color:{$color['sub_footer_bg']};
}
#copyright {
	color: {$color['copyright']};
	font-size: {$font['copyright']}px;
}
#footer_menu a {
	font-size: {$font['footer_menu']}px;
}
#footer_menu a, #footer_menu a:visited{
	color: {$color['footer_menu']};
}
#footer_menu a:hover, #footer_menu a:active {
	color: {$color['footer_menu_active']};
}
#footer_bottom a, #footer_bottom a:visited{
	color: {$color['footer_menu']};
}
#footer_bottom a:hover, #footer_bottom a:active {
	color: {$color['footer_menu_active']};
}
.divider, .divider_line, .commentlist li,.entry .entry_meta,#sidebar .widget li,#sidebar .widget_pages ul ul,#about_the_author .author_content {
	border-color: {$color['divider_line']};
}
h1 {
	font-size: {$font['h1']}px;
}
h2 {
	font-size: {$font['h2']}px;
}
h3 {
	font-size: {$font['h3']}px;
}
h4 {
	font-size: {$font['h4']}px;
}
h5 {
	font-size: {$font['h5']}px;
}
h6 {
	font-size: {$font['h6']}px;
}
#nivo_slider_wrap, #nivo_slider_loading, #nivo_slider {
	height: {$nivo_height}px;
}
#nivo_slider_frame {
	height: {$nivo_frame_height}px;
}
.nivo-caption {
	background-color: {$color['nivo_caption_bg']};
}
.nivo-caption p {
	color: {$color['nivo_caption_text']};
}
#kwicks li {
	height: {$kwicks_height}px;
}
.kwick_frame,.kwick_last_frame {
	height: {$kwicks_frame_height}px;
}
ul.anythingBase li.panel {
	background-color: {$color['anything_bg']};
}
#anything_slider_wrap, #anything_slider_loading {
	height: {$anything_height}px;
}
#anything_slider p {
	font-size: {$font['anything_desc']}px;
}
.caption_left, .caption_right {
	height: {$anything_caption_height}px;
}
.entry {
	margin-bottom: {$posts_gap}px;
}
.entry_title {
	font-size: {$font['entry_title']}px;
}
.entry_left .entry_image .image_frame {
	width: {$blog_left_image_width}px;
	height: {$blog_left_image_height}px;
}
.entry_left .entry_image, .entry_left .entry_image .image_shadow {
	width: {$blog_left_image_shadow_width}px;
}
#page ul.tabs li a {
	background-color: {$color['tab_bg']};
	color: {$color['tab_text']};
}
#page ul.tabs li a.current {
	background-color: {$color['tab_current_bg']};
	color: {$color['tab_current_text']}; 
}
#page ul.mini_tabs li a {
	background-color: {$color['minitab_bg']};
	color: {$color['minitab_text']};
}
#page ul.mini_tabs li a.current {
	background-color: {$color['minitab_current_bg']};
	color: {$color['minitab_current_text']}; 
}
.accordion .tab {
	background-color: {$color['accordion_bg']};
	color: {$color['accordion_text']};
}
.accordion .tab.current {
	background-color: {$color['accordion_current_bg']};
	color: {$color['accordion_current_text']};
}

{$custom_css}
CSS;
?>