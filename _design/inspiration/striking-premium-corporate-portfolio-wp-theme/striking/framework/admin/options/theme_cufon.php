<?php
if (! function_exists("theme_cufon_get_fonts")){
	function theme_cufon_get_fonts(){
		$fonts = array();
		foreach(glob(THEME_FONT_DIR."/*.js") as $font_file){
			$file_content = file_get_contents($font_file);
			if(preg_match('/font-family":"(.*?)"/i',$file_content,$match)){
				$fonts[$match[1]] = basename($font_file);
			}
		}
		return $fonts;
	}
}
if(isset($_GET['page']) && $_GET['page']=='theme_cufon'){
	if (! function_exists("theme_cufon_add_script_option")){
		function theme_cufon_add_script_option(){
			wp_enqueue_script( 'cufon-yui', THEME_JS .'/cufon-yui.js');
			wp_enqueue_script( 'ZeroClipboard', THEME_ADMIN_ASSETS_URI .'/js/ZeroClipboard.js');
			$cufon_scripts = "<script type='text/javascript'>\njQuery(document).ready(function($) {\n";
			$count = 1;
			foreach(theme_cufon_get_fonts() as $font_name => $file_name){
				wp_enqueue_script( $font_name, THEME_FONT_URI .'/'.$file_name);
				$cufon_scripts .= stripslashes("Cufon('#preview-$count', { fontFamily: '$font_name' });\n");
				$count ++;
			}
			do_action('admin_print_scripts');
			$cufon_scripts .= "ZeroClipboard.setMoviePath('".THEME_ADMIN_ASSETS_URI."/js/ZeroClipboard.swf');\njQuery('.cufon_font_name').each(function(){\nvar clip = new ZeroClipboard.Client();\nclip.setText(jQuery(this).text());\nclip.glue(this,jQuery(this).parent('.font_name_wrap')[0]);\n});";
			echo $cufon_scripts."});\n</script>";
		}
		add_filter('admin_head', 'theme_cufon_add_script_option');
	}
}
if (! function_exists("theme_cufon_fonts_option")) {
	function theme_cufon_fonts_option($value, $default) {
		echo '<tr colspan="2"><td style="padding:0"><table class="widefat cufon_table" cellspacing="0"><tbody>';
		$count = 1;
		foreach(theme_cufon_get_fonts() as $font_name => $file_name){
			if(is_array($default)){
				$checked = in_array($file_name,$default)?' checked="checked"':'';
			}else{
				$checked = '';
			}
			echo '<tr><td style="width:15%"><div class="font_name_wrap" style="position: relative;"><a class="cufon_font_name" href="#" title="'.$file_name.'">'.$font_name.'</a></div></td><td style="width:10%"><input type="checkbox" name="fonts[]" class="toggle-button" value="'.$file_name.'"'.$checked.'/></td><td><span class="cufon_preview" id="preview-'.$count.'">This is a preview of the <span style="color:  #379BFF;">'.$font_name.'</span> font. Some numbers: 0123456789 &amp; so on..</span></td></tr>';
			$count ++;
		}
		echo '</tbody></table></td></tr>';
	}
}
$options = array(
	array(
		"name" => __("Cufon",'striking_admin'),
		"type" => "title"
	),
	array(
		"name" => __("Cufón General",'striking_admin'),
		"type" => "start"
	),
		array(
			"name" => __("Enable Cufon",'striking_admin'),
			"desc" => "",
			"id" => "enable_cufon",
			"default" => true,
			"type" => "toggle"
		),
		array(
			"name" => __("Cufon Code",'striking_admin'),
			"desc" => __('sample:<p><code>Cufon.replace("h1,h2,h3,h4,h5", {fontFamily : "Vegur"});</code></p><p><code>Cufon.replace("#site_name", {fontFamily : "Vegur", color: \'-linear-gradient(white, black)\'});</code></p><p>For more code tips go to official <a href="http://wiki.github.com/sorccu/cufon/styling">Cufon\'s site</a>','striking_admin'),
			"id" => "code",
			"default" => '',
			"rows" => '8',
			"type" => "textarea"
		),
	array(
		"type" => "end"
	),
	array(
		"name" => sprintf(__('Fonts located in "%s"','striking_admin'),'<code>'.str_replace( WP_CONTENT_DIR, '', THEME_FONT_DIR ).'</code>'),
		"type" => "start"
	),
		array(
			"id" => "fonts",
			"layout" => false,
			"function" => "theme_cufon_fonts_option",
			"default" => array('Segan_300.font.js'),
			"type" => "custom"
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