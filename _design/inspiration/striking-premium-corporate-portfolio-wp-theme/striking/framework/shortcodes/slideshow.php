<?php

function theme_shortcode_slideshow($atts, $content = null){
	if(isset($atts['type'])){
		switch($atts['type']){
			case 'nivo':
				return theme_slideshow_nivo($atts, $content);
				break;
		}
	}
	return '';
}
add_shortcode('slideshow', 'theme_shortcode_slideshow');

function theme_slideshow_nivo($atts, $content = null){
	extract(shortcode_atts(array(
		'number' => 5,
		'width' => '630',
		'height' => '300',
		'category' => false,
		'effect' => 'random',
		'slices' => '10',
		'animspeed' => '500',
		'pausetime' => '3000',
		'controlnav' => 'false',
		'pauseonhover' => 'false',
	), $atts));

	$id = rand(1,1000);
	wp_print_scripts('jquery-nivo');
	
	if($controlnav==='true'){
		$controlnav = 'true';
	}else{
		$controlnav = 'false';
	}
	if($pauseonhover==='true'){
		$pauseonhover = 'true';
	}else{
		$pauseonhover = 'false';
	}
	if($content==''){
		if($category===false){
			$category='';
		}
		$size[0]=$width;
		$size[1]=$height;
		$images = theme_generator('slideShow_getImages',$category,$number,$size);
		
		foreach($images as $image) {
			//$title = $captions?$image['title']:'';
			$title = '';
			//if($image['link'] != ''){
				//$content .= '<a href="'.$image['link'].'" target="'.$image['target'].'"><img src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1' . '" title="'.$title.'" /></a>';
			//}else{
				$content .= '<img src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1' . '" title="'.$title.'" />';
			//}
		}
	}

	return <<<HTML
[raw]
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#nivoslider_{$id}').nivoSlider({
        effect:'{$effect}',
        slices:{$slices}, 
        boxCols: 8,
        boxRows: 4,
        animSpeed:'{$animspeed}',
        pauseTime:'{$pausetime}',
        startSlide:0, 
        directionNav:false,
        directionNavHide:true, 
        controlNav:{$controlnav}, 
        controlNavThumbs:false, 
        keyboardNav:false,
        pauseOnHover:{$pauseonhover}, 
        manualAdvance:false, 
        captionOpacity:0.8
    });
});
</script>
<style type="text/css">
#nivoslider_{$id} {
	width: {$width}px;
	height: {$height}px;
}
</style>	
<div id="nivoslider_{$id}" class="nivoslider_wrap">
{$content}
</div>
[/raw]
HTML;

}