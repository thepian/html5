<?php
class Theme_admin {
	function init(){
		/* Load functions for admin. */
		$this->functions();
		
		/* Create theme options menu */
		add_action('admin_menu', array(&$this,'menus'));
		
		add_action('admin_notices',  array(&$this,'warnings'));
		
		/* Manage custom post type */
		$this->types();

		/* Create post type meta box. */
		$this->metaboxes();	
		
		add_action('wp_ajax_theme-flush-rewrite-rules', array(&$this,'flush_rewrite_rules'));
	}
	
	/**
	 * Check Whether the current environment is support for the theme.
	 * 
	 * The message will display in admin option page.
	 */
	function warnings(){
		global $wp_version;

		$errors = array();
		if(!theme_check_wp_version()){
			$errors[]='Wordpress version('.$wp_version.') is too low. Please upgrade to 3.1';
		}
		if(!function_exists("imagecreatetruecolor")){
			$errors[]='GD Library Error: imagecreatetruecolor does not exist - please contact your webhost and ask them to install the GD library';
		}
		if(!is_writeable(THEME_CACHE_DIR)){
			$errors[]='The cache folder ('.str_replace( WP_CONTENT_DIR, '', THEME_CACHE_DIR ).') is not writeable.';
		}
		if(!is_writeable(THEME_CACHE_DIR.DIRECTORY_SEPARATOR.'images')){
			$errors[]='The image cache folder ('.str_replace( WP_CONTENT_DIR, '', THEME_CACHE_DIR ).'/images'.') is not writeable.';
		}
		if(!is_writeable(THEME_CACHE_DIR.DIRECTORY_SEPARATOR.'skin.css')){
			$errors[]='The skin style file ('.str_replace( WP_CONTENT_DIR, '', THEME_CACHE_DIR ).'/skin.css'.') is not writeable.';
		}
		
		$str = '';
		if(!empty($errors)){
			$str = '<ul>';
			foreach($errors as $error){
				$str .= '<li>'.$error.'</li>';
			}
			$str .= '</ul>';
			echo "
				<div id='theme-warning' class='error fade'><p><strong>".sprintf(__('%1$s Error Messages'), THEME_NAME)."</strong><br/>".$str."</p></div>
			";
		}
		
	}
	
	function functions(){
		require_once(THEME_ADMIN_FUNCTIONS .'/common.php');
		require_once(THEME_ADMIN_FUNCTIONS .'/head.php');
		//enable option image uploader support
		require_once(THEME_ADMIN_FUNCTIONS .'/option-media-upload.php');
	}
	
	/**
	 * Create theme options menu
	 */
	function menus(){
		add_menu_page(THEME_NAME, THEME_NAME, 'edit_theme_options', 'theme_general', array(&$this,'_load_option_page'),THEME_ADMIN_ASSETS_URI .'/images/striking_hover.png');
		add_submenu_page('theme_general', 'General', 'General', 'edit_theme_options', 'theme_general', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Background', 'Background', 'edit_theme_options', 'theme_background', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Color', 'Color', 'edit_theme_options', 'theme_color', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Font', 'Font', 'edit_theme_options', 'theme_font', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Cufon', 'Cufon', 'edit_theme_options', 'theme_cufon', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Fontface', 'Fontface', 'edit_theme_options', 'theme_fontface', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Slider Show', 'SlideShow', 'edit_theme_options', 'theme_slideshow', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Sidebar', 'Sidebar', 'edit_theme_options', 'theme_sidebar', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Image', 'Image','edit_theme_options', 'theme_image', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Video', 'Video', 'edit_theme_options', 'theme_video', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Homepage', 'Homepage', 'edit_theme_options', 'theme_homepage', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Blog', 'Blog', 'edit_theme_options', 'theme_blog', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Portfolio', 'Portfolio', 'edit_theme_options', 'theme_portfolio', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Footer', 'Footer', 'edit_theme_options', 'theme_footer', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Advance', 'Advance', 'edit_theme_options', 'theme_advance', array(&$this,'_load_option_page'));
		add_submenu_page('theme_general', 'Documentation', 'Documentation', 'edit_theme_options', 'theme_docs', array(&$this,'_load_docs_page'));
	}
	
	/**
	 * call and display the requested options page
 	 */
	function _load_option_page(){
		include_once (THEME_HELPERS . '/optionGenerator.php');
		$page = include(THEME_ADMIN_OPTIONS . "/" . $_GET['page'] . '.php');
	
		if($page['auto']){
			new optionGenerator($page['name'],$page['options']);
		}
	}
	
	/**
	 * call and display the requested options page
 	 */
	function _load_docs_page(){
		include_once (THEME_HELPERS . '/docsGenerator.php');
		$options = include(THEME_ADMIN_OPTIONS . "/" . $_GET['page'] . '.php');
	
		new docsGenerator($options['title'],$options['docs']);
	}
	
	/**
	 * Manage custom post type.
	 */
	function types(){
		require_once (THEME_ADMIN_TYPES . '/portfolio.php');
		require_once (THEME_ADMIN_TYPES . '/slideshow.php');
		//require_once (THEME_ADMIN_TYPES . '/gallery.php');
	}
	
	/**
	 * Create post type metabox.
	 */
	function metaboxes(){
		require_once (THEME_HELPERS . '/metaboxesGenerator.php');
		
		require_once (THEME_ADMIN_METABOXES . '/shortcode.php');
		require_once (THEME_ADMIN_METABOXES . '/page_general.php');
		require_once (THEME_ADMIN_METABOXES . '/slideshow.php');
		require_once (THEME_ADMIN_METABOXES . '/anything_slider.php');
		require_once (THEME_ADMIN_METABOXES . '/portfolio.php');
		require_once (THEME_ADMIN_METABOXES . '/gallery.php');
		require_once (THEME_ADMIN_METABOXES . '/single.php');
	}
	
	function flush_rewrite_rules(){
		flush_rewrite_rules();
		die (1);
	}
}