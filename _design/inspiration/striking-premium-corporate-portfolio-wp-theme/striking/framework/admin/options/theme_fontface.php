<?php
if(isset($_GET['page']) && $_GET['page']=='theme_fontface'){
	if (! function_exists("theme_fontface_getfonts")){
		function theme_fontface_getfonts(){
			$fonts = array();
			$dirs = array_filter(glob(THEME_FONTFACE_DIR.'/*'), 'is_dir');
			
			foreach($dirs as $dir){
				$stylesheet = $dir.'/stylesheet.css';
				if(file_exists($stylesheet)){
					$file_content = file_get_contents($stylesheet);
					if( preg_match_all("/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs) ){
						foreach($matchs[0] as $index => $css){
							$font_folder = basename($dir);
							$fonts[$font_folder.'|'.$matchs[2][$index]] = array(
								'folder' => $font_folder,
								'name' => $matchs[2][$index],
								'css' => $css,
							);
						}
						
					}
				}
			}
			return $fonts;
		}
	}
	
	if (! function_exists("theme_fontface_add_head")){
		function theme_fontface_add_head(){
			$fonts = theme_fontface_getfonts();
			
			$count = 1;
			$style = "<style type='text/css'>\n";
			foreach($fonts as $value => $font){
				wp_enqueue_style('font|'.$value , THEME_FONTFACE_URI . '/'.$font['folder'].'/stylesheet.css');
				$style .= "#preview-".$count."{\n\tfont-family:".$font['name'].";\n}\n";
				$count ++;
			}
			
			$style .= "</style>";
			echo $style;
			
			wp_enqueue_script( 'ZeroClipboard', THEME_ADMIN_ASSETS_URI .'/js/ZeroClipboard.js');
			do_action('admin_print_scripts');
			do_action('admin_print_styles');
			$scripts = "<script type='text/javascript'>\njQuery(document).ready(function($) {\n";
			$scripts .= "ZeroClipboard.setMoviePath('".THEME_ADMIN_ASSETS_URI."/js/ZeroClipboard.swf');\njQuery('.fontface_font_name').each(function(){\nvar clip = new ZeroClipboard.Client();\nclip.setText(jQuery(this).text());\nclip.glue(this,jQuery(this).parent('.font_name_wrap')[0]);\n});";
			echo $scripts."});\n</script>";
		}
		add_filter('admin_head', 'theme_fontface_add_head');
	}
}
if (! function_exists("theme_fontface_fonts_option")) {
	function theme_fontface_fonts_option($value, $default) {
		$fonts = theme_fontface_getfonts();
		echo '<tr colspan="2"><td style="padding:0"><table class="widefat fontface_table" cellspacing="0"><tbody>';
		$count = 1;
		foreach($fonts as $value => $font){
			if(is_array($default)){
				$checked = in_array($value,$default)?' checked="checked"':'';
			}else{
				$checked = '';
			}
			
			echo '<tr><td style="width:15%"><div class="font_name_wrap" style="position: relative;"><a class="fontface_font_name" href="#" title="'.$font['name'].'">'.$font['name'].'</a></div></td><td style="width:10%"><input type="checkbox" name="fonts[]" class="toggle-button" value="'.$value.'"'.$checked.'/></td><td><span class="fontface_preview" id="preview-'.$count.'">This is a preview of the <span style="color:  #379BFF;">'.$font['name'].'</span> font. Some numbers: 0123456789 &amp; so on..</span></td></tr>';
			$count ++;
		}
		echo '</tbody></table></td></tr>';
	}
}
$options = array(
	array(
		"name" => __("@font-face",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("@font-face General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Enable @font-face",'striking_admin'),
			"desc" => "",
			"id" => "enable_fontface",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("@font-face Custom CSS",'striking_admin'),
			"desc" => __('sample:<p><code>h1,h2,h3,h4,h5 { font-family:ColaborateLightRegular; }</code></p>','striking_admin'),
			"id" => "code",
			"default" => '',
			"rows" => '8',
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => sprintf(__('Fonts located in "%s"','striking_admin'),'<code>'.str_replace( WP_CONTENT_DIR, '', THEME_FONTFACE_DIR ).'</code>'),
		"type" => "start"
	),
		array(
			"id" => "fonts",
			"layout" => false,
			"function" => "theme_fontface_fonts_option",
			"default" => '',
			"type" => "custom"
		),
	array(
		"type" => "end"
	),
);
return array(
	'auto' => true,
	'name' => 'fontface',
	'options' => $options
);