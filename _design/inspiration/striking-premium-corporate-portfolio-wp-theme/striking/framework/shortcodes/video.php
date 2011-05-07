<?php
function theme_shortcode_video($atts){
	if(isset($atts['type'])){
		switch($atts['type']){
			case 'html5':
				return theme_video_html5($atts);
				break;
			case 'flash':
				return theme_video_flash($atts);
				break;
			case 'youtube':
				return theme_video_youtube($atts);
				break;
			case 'vimeo':
				return theme_video_vimeo($atts);
				break;
			case 'dailymotion':
				return theme_video_dailymotion($atts);
				break;
		}
	}
	return '';
}
add_shortcode('video', 'theme_shortcode_video');

function theme_video_html5($atts){
	extract(shortcode_atts(array(
		'mp4' => '',
		'webm' => '',
		'ogg' => '',
		'poster' => '',
		'width' => false,
		'height' => false,
		'download' => false,
		'preload' => false,
		'autoplay' => false,
	), $atts));

	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16);
	if (!$height && !$width){
		$height = theme_get_option('video','html5_height');
		$width = theme_get_option('video','html5_width');
	}
	if (!$download){
		$download = theme_get_option('video','html5_download');
	}else{
		if($download==='true'){
			$download = true;
		}else{
			$download = false;
		}
	}
	if (!$preload){
		$preload = theme_get_option('video','html5_preload');
	}else{
		if($preload==='true'){
			$preload = true;
		}else{
			$preload = false;
		}
	}
	if (!$autoplay){
		$autoplay = theme_get_option('video','html5_autoplay');
	}else{
		if($autoplay==='true'){
			$autoplay = true;
		}else{
			$autoplay = false;
		}
	}
	
	// MP4 Source Supplied
	if ($mp4) {
		$mp4_source = '<source src="'.$mp4.'" type=\'video/mp4; codecs="avc1.42E01E, mp4a.40.2"\'>';
		$mp4_link = '<a href="'.$mp4.'">MP4</a>';
	}

	// WebM Source Supplied
	if ($webm) {
		$webm_source = '<source src="'.$webm.'" type=\'video/webm; codecs="vp8, vorbis"\'>';
		$webm_link = '<a href="'.$webm.'">WebM</a>';
	}

	// Ogg source supplied
	if ($ogg) {
		$ogg_source = '<source src="'.$ogg.'" type=\'video/ogg; codecs="theora, vorbis"\'>';
		$ogg_link = '<a href="'.$ogg.'">Ogg</a>';
	}

	if ($poster) {
		$poster_attribute = 'poster="'.$poster.'"';
		$image_fallback = <<<_end_
			<img src="$poster" width="$width" height="$height" alt="Poster Image" title="No video playback capabilities." />
_end_;
	}
	
	if ($preload) {
		$preload_attribute = 'preload="auto"';
		$flow_player_preload = ',"autoBuffering":true';
	} else {
		$preload_attribute = 'preload="none"';
		$flow_player_preload = ',"autoBuffering":false';
	}

	if ($autoplay) {
		$autoplay_attribute = "autoplay";
		$flow_player_autoplay = ',"autoPlay":true';
	} else {
		$autoplay_attribute = "";
		$flow_player_autoplay = ',"autoPlay":false';
	}

	$uri = THEME_URI;
	
	if($download){
		$download_string = <<<HTML
<p class="vjs-no-video"><strong>Download Video:</strong>
		{$mp4_link}
		{$webm_link}
		{$ogg_link}
</p>
HTML;
	} else {
		$download_string = '';
	}

	$output = <<<HTML
<div class="video_frame video-js-box">
	<video class="video-js" width="{$width}" height="{$height}" {$poster_attribute} controls {$preload_attribute} {$autoplay_attribute}>
		{$mp4_source}
		{$webm_source}
		{$ogg_source}
		<object class="vjs-flash-fallback" width="{$width}" height="{$height}" type="application/x-shockwave-flash"
			data="http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf">
			<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.5.swf" />
			<param name="allowfullscreen" value="true" />
			<param name="wmode" value="opaque" />
			<param name="flashvars" value='config={"clip":{"url":"$mp4" $flow_player_autoplay $flow_player_preload ,"wmode":"opaque"}}' />
			{$image_fallback}
		</object>
	</video>
	{$download_string}
</div>

HTML;

	return '[raw]'.$output.'[/raw]';

}

function theme_video_flash($atts) {
	extract(shortcode_atts(array(
		'src' 	=> '',
		'id' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'play'			=> 'false',
		'flashvars' => '',
	), $atts));
	
	if($id!=''){
		$id = ' id="'.$id.'"';
	}
	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16);
	if (!$height && !$width){
		$height = theme_get_option('video','flash_height');
		$width = theme_get_option('video','flash_width');
	}

	$uri = THEME_URI;
	if (!empty($src)){
		return <<<HTML
<div class="video_frame">
<object{$id} width="{$width}" height="{$height}" type="application/x-shockwave-flash" data="{$src}">
	<param name="movie" value="{$src}" />
	<param name="allowFullScreen" value="true" />
	<param name="allowscriptaccess" value="always" />
	<param name="expressInstaller" value="{$uri}/swf/expressInstall.swf"/>
	<param name="play" value="{$play}"/>
	<param name="wmode" value="opaque" />
	<embed src="$src" type="application/x-shockwave-flash" wmode="opaque" allowscriptaccess="always" allowfullscreen="true" width="{$width}" height="{$height}" />
</object>
</div>
HTML;
	}
}

function theme_video_vimeo($atts) {
	extract(shortcode_atts(array(
		'clip_id' 	=> '',
		'width' => false,
		'height' => false,
		'byline'    => false,
		'title'     => false,
		'portrait'  => false,
		'autoplay'  => false,
		'loop'      => false,
	), $atts));

	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16);
	if (!$height && !$width){
		$height = theme_get_option('video','vimeo_height');
		$width = theme_get_option('video','vimeo_width');
	}
	if (!$byline){
		$byline = (theme_get_option('video','vimeo_byline') == true)?1:0;
	}else{
		if($byline==='true'){
			$byline = '1';
		}else{
			$byline = '0';
		}
	}
	if (!$title){
		$title = (theme_get_option('video','vimeo_title') == true)?1:0;
	}else{
		if($title==='true'){
			$title = '1';
		}else{
			$title = '0';
		}
	}
	if (!$portrait){
		$portrait = (theme_get_option('video','vimeo_portrait') == true)?1:0;
	}else{
		if($portrait==='true'){
			$portrait = '1';
		}else{
			$portrait = '0';
		}
	}
	if (!$autoplay){
		$autoplay = (theme_get_option('video','vimeo_autoplay') == true)?1:0;
	}else{
		if($autoplay==='true'){
			$autoplay = '1';
		}else{
			$autoplay = '0';
		}
	}
	if (!$loop){
		$loop = (theme_get_option('video','vimeo_loop') == true)?1:0;
	}else{
		if($loop==='true'){
			$loop = '1';
		}else{
			$loop = '0';
		}
	}

	if (!empty($clip_id) && is_numeric($clip_id)){
		return "<div class='video_frame'><iframe style='height:{$height}px;width:{$width}px' src='http://player.vimeo.com/video/$clip_id?title={$title}&amp;byline={$byline}&amp;portrait={$portrait}&amp;autoplay={$autoplay}&amp;loop={$loop}' width='$width' height='$height' frameborder='0'></iframe></div>";
	}
}

function theme_video_youtube($atts, $content=null) {
	extract(shortcode_atts(array(
		'clip_id' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'autohide'  => false,
		'autoplay'  => false,
		'controls'  => false,
		'disablekb' => false,
		'fs'        => false,
		'hd'        => false,
		'loop'      => false,
		'rel'       => false,
		'showsearch'=> false,
		'showinfo'  => false,
	), $atts));
	
	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16) + 25;
	if (!$height && !$width){
		$height = theme_get_option('video','youtube_height');
		$width = theme_get_option('video','youtube_width');
	}
	if (!$autohide){
		$autohide = theme_get_option('video','youtube_autohide');
	}
	if (!$autoplay){
		$autoplay = (theme_get_option('video','youtube_autoplay') == true)?1:0;
	}else{
		if($autoplay==='true'){
			$autoplay = '1';
		}else{
			$autoplay = '0';
		}
	}
	if (!$controls){
		$controls = (theme_get_option('video','youtube_controls') == true)?1:0;
	}else{
		if($controls==='true'){
			$controls = '1';
		}else{
			$controls = '0';
		}
	}
	if (!$disablekb){
		$disablekb = (theme_get_option('video','youtube_disablekb') == true)?1:0;
	}else{
		if($disablekb==='true'){
			$disablekb = '1';
		}else{
			$disablekb = '0';
		}
	}
	if (!$fs){
		$fs = (theme_get_option('video','youtube_fs') == true)?1:0;
	}else{
		if($fs==='true'){
			$fs = '1';
		}else{
			$fs = '0';
		}
	}
	if (!$hd){
		$hd = (theme_get_option('video','youtube_hd') == true)?1:0;
	}else{
		if($hd==='true'){
			$hd = '1';
		}else{
			$hd = '0';
		}
	}
	if (!$loop){
		$loop = (theme_get_option('video','youtube_loop') == true)?1:0;
	}else{
		if($loop==='true'){
			$loop = '1';
		}else{
			$loop = '0';
		}
	}
	if (!$rel){
		$rel = (theme_get_option('video','youtube_rel') == true)?1:0;
	}else{
		if($rel==='true'){
			$rel = '1';
		}else{
			$rel = '0';
		}
	}
	if (!$showinfo){
		$showinfo = (theme_get_option('video','youtube_showinfo') == true)?1:0;
	}else{
		if($showinfo==='true'){
			$showinfo = '1';
		}else{
			$showinfo = '0';
		}
	}
	if (!$showsearch){
		$showsearch = (theme_get_option('video','$youtube_showsearch') == true)?1:0;
	}else{
		if($showsearch==='true'){
			$showsearch = '1';
		}else{
			$showsearch = '0';
		}
	}

	if (!empty($clip_id)){
		return "<div class='video_frame'><iframe style='height:{$height}px;width:{$width}px' src='http://www.youtube.com/embed/{$clip_id}?autohide={$autohide}&amp;autoplay={$autoplay}&amp;controls={$controls}&amp;disablekb={$disablekb}&amp;fs={$fs}&amp;hd={$hd}&amp;loop={$loop}&amp;rel={$rel}&amp;showinfo={$showinfo}&amp;showsearch={$showsearch}&amp;wmode=transparent' width='{$width}' height='{$height}' frameborder='0'></iframe></div>";
	}
}

function theme_video_dailymotion($atts, $content=null) {
	extract(shortcode_atts(array(
		'clip_id' 	=> '',
		'width' 	=> false,
		'height' 	=> false,
		'related'   => false,
		'autoplay'  => false,
		'chromeless'=> false,
	), $atts));
	
	if ($height && !$width) $width = intval($height * 16 / 9);
	if (!$height && $width) $height = intval($width * 9 / 16);
	if (!$height && !$width){
		$height = theme_get_option('video','dailymotion_height');
		$width = theme_get_option('video','dailymotion_width');
	}
	if (!$related){
		$related = (theme_get_option('video','dailymotion_related') == true)?1:0;
	}else{
		if($related==='true'){
			$related = '1';
		}else{
			$related = '0';
		}
	}
	if (!$autoplay){
		$autoplay = (theme_get_option('video','dailymotion_autoplay') == true)?1:0;
	}else{
		if($autoplay==='true'){
			$autoplay = '1';
		}else{
			$autoplay = '0';
		}
	}
	if (!$chromeless){
		$chromeless = (theme_get_option('video','dailymotion_chromeless') == true)?1:0;
	}else{
		if($chromeless==='true'){
			$chromeless = '1';
		}else{
			$chromeless = '0';
		}
	}
//&additionalInfos=0
//&hideInfos=0
	if (!empty($clip_id)){
		return "<div class='video_frame'><iframe style='height:{$height}px;width:{$width}px' src='http://www.dailymotion.com/embed/video/$clip_id?width=$width&amp;autoPlay={$autoplay}&amp;related={$related}&amp;chromeless={$chromeless}&amp;theme=none&amp;foreground=%23F7FFFD&amp;highlight=%23FFC300&amp;background=%23171D1B&amp;iframe=1&amp;wmode=transparent' width='$width' height='$height' frameborder='0'></iframe></div>";
	}
}