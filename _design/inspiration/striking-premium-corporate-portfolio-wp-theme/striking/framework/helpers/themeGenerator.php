<?php
class themeGenerator {
	function title(){
		global $page, $paged;
		
		/*
		wp_title('',true);
		return;
		*/		
		wp_title( '|', true, 'right' );
		
		// Add the blog name.
		bloginfo( 'name' );
		
		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && is_front_page() )
			echo " | $site_description";
		
		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'striking_front' ), max( $paged, $page ) );
	}

	function wpml_flags(){
		if(function_exists('icl_get_languages')){
			$languages = icl_get_languages('skip_missing=0');
			if(!empty($languages)){
				echo '<div id="language_flags"><ul>';
				foreach($languages as $l){
					echo '<li>';
					if(!$l['active']) echo '<a href="'.$l['url'].'" title="'.$l['native_name'].'">';
					echo '<img src="'.$l['country_flag_url'].'" alt="'.$l['language_code'].'" />';
					if(!$l['active']) echo '</a>';
					echo '</li>';
				}
				echo '</ul></div>';
			}
		}
	}

	function menu(){
		if (theme_get_option('general','enable_nav_menu') && has_nav_menu( 'primary-menu' ) ) {
			wp_nav_menu( array( 
				'theme_location' => 'primary-menu',
				'container' => 'nav',
				'container_id' => 'navigation',
				'container_class' => 'jqueryslidemenu',
				'fallback_cb' => ''
			));
		}else{
			$excluded_pages_with_childs = theme_get_excluded_pages();
			
			$active_class = (is_front_page()) ? 'class="current_page_item"' : '';
			
			$output = '<nav id="navigation" class="jqueryslidemenu">';
			$output .= '<ul id="menu-navigation" class="menu">';
			$output .= '<li ' .$active_class. '><a href="' .get_option('home'). '">'.__('Home','striking_front').'</a></li>';
			$output .= wp_list_pages("sort_column=menu_order&exclude=$excluded_pages_with_childs&title_li=&echo=0&depth=4");
			$output .= '</ul>';
			$output .= '</nav>';
			
			echo $output;
		}
	}
	
	function sidebar($post_id = NULL){
		sidebar_generator('get_sidebar',$post_id);
	}
	
	function footer_sidebar(){
		sidebar_generator('get_footer_sidebar');
	}
	
	function introduce($post_id = NULL) {
		if (is_blog()){
			$blog_page_id = theme_get_option('blog','blog_page');
			$post_id = wpml_get_object_id($blog_page_id,'page');
		}
		if (is_single() || is_page() || (is_front_page() && $post_id != NULL) || (is_home() && $post_id != NULL)){
			$type = get_post_meta($post_id, '_introduce_text_type', true);
			
			if (empty($type))
				$type = 'default';
			
			if (!theme_get_option('general','introduce') && $type=='default'){
				return;
			}
			
			if ($type == 'disable') {
				return;
			}
			
			if ($type == 'slideshow'){
				$stype = get_post_meta($post_id, '_slideshow_type', true);
				$category = get_post_meta($post_id, '_slideshow_category', true);
				$color = get_post_meta($post_id, '_introduce_background_color', true);
				return theme_generator('slideShow',$stype,$category,$color);
			}
			
			if (in_array($type, array('default', 'title', 'title_custom'))) {
				$custom_title = get_post_meta($post_id, '_custom_title', true);
				if(!empty($custom_title)){
					$title = $custom_title;
				}else{
					$title = get_the_title($post_id);
				}
			}
			$blog_page_id = theme_get_option('blog','blog_page');
			$blog_page_id = wpml_get_object_id($blog_page_id,'page');
			if ($type == 'default' && is_singular('post') && $post_id!=$blog_page_id) {
				$show_in_header = theme_get_option('blog','show_in_header');
				if($show_in_header){
					$title = get_the_title($post_id);
					$text = '<div class="entry_meta">';
					$text .= '<time datetime="'.get_the_time('Y-m-d').'">'.get_the_date().'</time>';
					$text .= '<span class="separater">|</span>';
					$text .= '<span class="categories">'.get_the_category_list(',').'</span>'; 
					ob_start();
						edit_post_link( __( 'Edit', 'striking_front' ), '<span class="separater">|</span> <span class="edit-link">', '</span>' );
						global $post;
						if($post->comment_count > 0 || comments_open()):
							echo '<span class="comments">';
							comments_popup_link(__('No Comments','striking_front'), __('1 Comment','striking_front'), __('% Comments','striking_front'));
							echo '</span>';
						endif;
					$text .= ob_get_clean();
					$text .= '</div>';
				}else{
					return $this->introduce($blog_page_id);
				}
			}
			
			if (in_array($type, array('custom', 'title_custom'))) {
				$text = do_shortcode(get_post_meta($post_id, '_custom_introduce_text', true));
			}
		}elseif(!theme_get_option('general','introduce')){
			return;
		}

		if (is_archive()){
			$title = __('Archives','striking_front');
			if(is_category()){
				$text = sprintf(__('Category Archive for: ‘%s’','striking_front'),single_cat_title('',false));
			}elseif(is_tag()){
				$text = sprintf(__('Tag Archives for: ‘%s’','striking_front'),single_tag_title('',false));
			}elseif(is_day()){
				$text = sprintf(__('Daily Archive for: ‘%s’','striking_front'),get_the_time('F jS, Y'));
			}elseif(is_month()){
				$text = sprintf(__('Monthly Archive for: ‘%s’','striking_front'),get_the_time('F, Y'));
			}elseif(is_year()){
				$text = sprintf(__('Yearly Archive for: ‘%s’','striking_front'),get_the_time('Y'));
			}elseif(is_author()){
				if(get_query_var('author_name')){
					$curauth = get_user_by('slug', get_query_var('author_name'));
				} else {
					$curauth = get_userdata(get_query_var('author'));
				}
				$text = sprintf(__('Author Archive for: ‘%s’','striking_front'),$curauth->nickname);
			}elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {
				$text = __('Blog Archives','striking_front');
			}elseif(is_tax()){
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$text = sprintf(__('Archives for: ‘%s’','striking_front'),$term->name);
			}
		}
		
		if (is_404()) {
			$title = __('404 - Not Found','striking_front');
			$text = __("Looks like the page you're looking for isn't here anymore. Try using the search box or sitemap below.",'striking_front');
		}
		
		if (is_search()) {
			$title = __('Search','striking_front');
			$text = sprintf(__('Search Results for: ‘%s’','striking_front'),stripslashes( strip_tags( get_search_query() ) ));
		}
		
		
		
		$color = get_post_meta($post_id, '_introduce_background_color', true);
		if(!empty($color) && $color != "transparent"){
			$color = ' style="background-color:'.$color.'"';
		}else{
			$color = '';
		}
		echo '<div id="feature"'.$color.'>';
		echo '<div class="top_shadow"></div>';
		echo '<div class="inner">';
		if (isset($title)) {
			echo '<h1>' . $title . '</h1>';
		}
		if (isset($text)) {
			echo '<div id="introduce">';
			echo $text;
			echo '</div>';
		}
		echo '</div>';
		echo '<div class="bottom_shadow"></div>';
		echo '</div>';
	}
	
	function breadcrumbs($post_id = NULL) {
		if(!theme_is_enabled(get_post_meta($post_id, '_disable_breadcrumb', true), theme_get_option('general','disable_breadcrumb'))){
			breadcrumbs_plus(array(
				'prefix' => '<section id="breadcrumbs">',
				'suffix' => '</section>',
				'title' => false,
				'home' => __( 'Home', 'striking_front' ),
				'sep' => '&raquo;',
				'front_page' => false,
				'bold' => false,
				'blog' => __( 'Blog', 'striking_front' ),
				'echo' => true
			));
		}
	}
	
	function portfolio_featured_image($layout=''){
		if($layout == 'full'){
			$width = 958;
		}else{
			$width = 628;
		}
		$image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);
		$adaptive_height = theme_get_option('portfolio', 'adaptive_height');
		
		if($adaptive_height){
			$height = floor($width*($image_src_array[2]/$image_src_array[1]));
		}else{
			$height = theme_get_option('portfolio', 'fixed_height');
		}
		$image_src = THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image_src_array[0]).'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1';

		if (has_post_thumbnail()): 
?>
	<div class="image_styled entry_image">
		<span class="image_frame" style="height:<?php echo $height;?>px;width:<?php echo $width;?>px">
<?php if(is_single()):
		if(theme_get_option('portfolio', 'featured_image_lightbox')):?>
			<a class="image_icon_zoom lightbox" href="<?php echo $image_src_array[0] ?>" title="">
				<img src="<?php echo $image_src;?>" alt="<?php the_title();?>" />
				<span class="image_overlay"></span>
			</a>
		<?php else:?>
				<img src="<?php echo $image_src;?>" alt="<?php the_title();?>" />
				<span class="image_overlay"></span>
		<?php endif;?>		
<?php else:?>
			<a class="image_icon_doc" href="<?php echo get_permalink() ?>" title="">
				<img src="<?php echo $image_src;?>" alt="<?php the_title();?>" />
				<span class="image_overlay"></span>
			</a>
<?php endif;?>
		</span>
		<img src="<?php echo THEME_IMAGES;?>/image_shadow.png" class="image_shadow" style="width:<?php echo ($width+2);?>px">
	</div>
<?php
		endif;
	}

	function blog_featured_image($type='full',$layout='',$height=''){
		$image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true);
		if($layout == 'full'){
			$width = 958;
		}elseif(is_numeric($layout)){
			$width = $layout-2;
		}else{
			$width = 628;
		}
		if($type=='left'){
			$width = theme_get_option('blog', 'left_width');
			$height = theme_get_option('blog', 'left_height');
		}else{
			if(empty($height)){
				$adaptive_height = theme_get_option('blog', 'adaptive_height');
				if($adaptive_height){
					$height = floor($width*($image_src_array[2]/$image_src_array[1]));
				}else{
					$height = theme_get_option('blog', 'fixed_height');
				}
			}
		}
		
		$image_src = THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image_src_array[0]).'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1';
		$output = '';
		if (has_post_thumbnail()){
			$output .= '<div class="image_styled entry_image">';
			$output .= '<span class="image_frame" style="height:'.$height.'px;width:'.$width.'">';
			if(is_single()){
				if(theme_get_option('blog', 'featured_image_lightbox')){
					$output .= '<a class="image_icon_zoom lightbox" href="'.$image_src_array[0].'" title="">';
					$output .= '<img src="'.$image_src.'" alt="'.get_the_title().'" />';
					$output .= '<span class="image_overlay"></span>';
					$output .= '</a>';
				} else {
					$output .= '<img src="'.$image_src.'" alt="'.get_the_title().'" />';
					$output .= '<span class="image_overlay"></span>';
				}
			} else {
				$output .= '<a class="image_icon_doc" href="'.get_permalink().'" title="">';
				$output .= '<img src="'.$image_src.'" alt="'.get_the_title().'" />';
				$output .= '<span class="image_overlay"></span>';
				$output .= '</a>';
			}
			$output .= '</span>';
			$output .= '<img src="'.THEME_IMAGES.'/image_shadow.png" class="image_shadow" style="width:'.($width+2).'px">';
			$output .= '</div>';
		}
		return $output;
	}
	
	function blog_meta()
	{
 		global $post;
		$output = '';
		if (theme_get_option('blog','meta_category')){
			$output .= '<span class="categories">'.__('Posted in: ', 'striking_front').  get_the_category_list(', ').'</span>';
			$output .= '<span class="separater">|</span>';
		}
		if (theme_get_option('blog','meta_tags')){
			$output .= get_the_tag_list('<span class="tags">'.__('Tags: ', 'striking_front'),', ','</span> <span class="separater">|</span>'); 
		}
		if (theme_get_option('blog','meta_author')){
			$output .= '<span class="author">'.__('By: ', 'striking_front').  get_the_author_link().'</span>';
			$output .= '<span class="separater">|</span>';
		}
		if (theme_get_option('blog','meta_date')){
			$output .= '<time datetime="'.get_the_time('Y-m-d').'"><a href="'.get_month_link(get_the_time('Y'), get_the_time('m')).'">'.get_the_date().'</a></time>';
		}
			$output .= get_edit_post_link( __( 'Edit', 'striking_front' ), '<span class="separater">|</span> <span class="edit-link">', '</span>' );
		if(theme_get_option('blog','meta_comment') && ($post->comment_count > 0 || comments_open())){
			ob_start();
			comments_popup_link(__('No Comments','striking_front'), __('1 Comment','striking_front'), __('% Comments','striking_front'),'');
			$output .= '<span class="comments">'.ob_get_clean().'</span>';
		}
		return $output;
	}

	function blog_author_info()
	{
?>
<section id="about_the_author">
	<h3><?php _e('About the author','striking_front');?></h3>
	<div class="author_content">
		<div class="gravatar"><?php echo get_avatar( get_the_author_meta('user_email'), '60' ); ?></div>
		<div class="author_info">
			<div class="author_name"><?php the_author_posts_link(); ?></div>
			<p class="author_desc"><?php the_author_description(); ?></p>
		</div>
		<div class="clearboth"></div>
	</div>
</section>
<?php 
	}

	function blog_popular_posts()
	{
		$r = new WP_Query(array(
			'showposts' => 3, 
			'nopaging' => 0, 
			'orderby'=> 'comment_count', 
			'post_status' => 'publish', 
			'caller_get_posts' => 1
		));
		$output = '';
		if ($r->have_posts()){
			$output .= '<h3>'.__('Popular Posts','striking_front').'</h3>';
			$output .= '<section class="popular_posts_wrap">';
			$output .= '<ul class="posts_list">';
			while ($r->have_posts()){
				$r->the_post();
				$output .= '<li>';
				$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
				if (has_post_thumbnail() ){
					$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
				}else{
					$output .= '<img src="'.THEME_IMAGES.'/widget_posts_thumbnail.png" width="65" height="65" title="'.get_the_title().'" alt="'. get_the_title().'"/>';
				}
				$output .= '</a>';
				$output .= '<div class="post_extra_info">';
				$output .= '<a class="post_title" href="'.get_permalink().'" title="'.get_the_title().'" rel="bookmark">'.get_the_title().'</a>';
				$output .= '<time datetime="'.get_the_time('Y-m-d').'">'.get_the_date().'</time>';
				$output .= '</div>';
				$output .= '<div class="clearboth"></div>';
				$output .= '</li>';
			}
			$output .= '</ul>';
			$output .= '</section>';
		}

		wp_reset_postdata();
		echo $output;
	}

	function blog_related_posts()
	{
		global $post;
		$backup = $post;  
		$tags = wp_get_post_tags($post->ID);
        $tagIDs = array();
        $related_post_found = false;
        $output = '';
		if ($tags) {
			$tagcount = count($tags);
			for ($i = 0; $i < $tagcount; $i++) {
				$tagIDs[$i] = $tags[$i]->term_id;
			}
			$r = new WP_Query(array(
				'tag__in' => $tagIDs,
				'post__not_in' => array($post->ID),
				'showposts'=>3,
				'caller_get_posts'=>1
			));
			if ($r->have_posts()){
				$related_post_found = true;
				$output .= '<h3>'.__('Related Posts','striking_front').'</h3>';
				$output .= '<section class="related_posts_wrap">';
				$output .= '<ul class="posts_list">';
				while ($r->have_posts()){
					$r->the_post();
					$output .= '<li>';
					$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
					if (has_post_thumbnail() ){
						$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
					}else{
						$output .= '<img src="'.THEME_IMAGES.'/widget_posts_thumbnail.png" width="65" height="65" title="'.get_the_title().'" alt="'. get_the_title().'"/>';
					}
					$output .= '</a>';
					$output .= '<div class="post_extra_info">';
					$output .= '<a class="post_title" href="'.get_permalink().'" title="'.get_the_title().'" rel="bookmark">'.get_the_title().'</a>';
					$output .= '<time datetime="'.get_the_time('Y-m-d').'">'.get_the_date().'</time>';
					$output .= '</div>';
					$output .= '<div class="clearboth"></div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '</section>';
			}
			$post = $backup;
		}
		if(!$related_post_found){
			$r = new WP_Query(array(
				'showposts' => 3, 
				'nopaging' => 0, 
				'post_status' => 'publish', 
				'caller_get_posts' => 1
			));
			if ($r->have_posts()){
				$output .= '<h3>'.__('Recent Posts','striking_front').'</h3>';
				$output .= '<section class="recent_posts_wrap">';
				$output .= '<ul class="posts_list">';
				while ($r->have_posts()){
					$r->the_post();
					$output .= '<li>';
					$output .= '<a class="thumbnail" href="'.get_permalink().'" title="'.get_the_title().'">';
					if (has_post_thumbnail() ){
						$output .= get_the_post_thumbnail(get_the_ID(),array(65,65),array('title'=>get_the_title(),'alt'=>get_the_title()));
					}else{
						$output .= '<img src="'.THEME_IMAGES.'/widget_posts_thumbnail.png" width="65" height="65" title="'.get_the_title().'" alt="'. get_the_title().'"/>';
					}
					$output .= '</a>';
					$output .= '<div class="post_extra_info">';
					$output .= '<a class="post_title" href="'.get_permalink().'" title="'.get_the_title().'" rel="bookmark">'.get_the_title().'</a>';
					$output .= '<time datetime="'.get_the_time('Y-m-d').'">'.get_the_date().'</time>';
					$output .= '</div>';
					$output .= '<div class="clearboth"></div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '</section>';
			}
		}
		wp_reset_postdata();

		echo $output;
	}

	function slideShow($type = false, $category = false, $color = '') {
		if($type === false){
			if (theme_get_option('homepage', 'disable_slideshow')) {
				return;
			}
			$type = theme_get_option('homepage', 'slideshow_type');
		}
		if($type == "3d"){
			require_once (THEME_PLUGINS . '/Browser.php');
			$browser = new Browser();
			if($browser->isMobile()){
				$type = theme_get_option('slideshow','3d_mobile');
			}
		}
		
		switch($type){
			case 'nivo':
				$this->slideShow_nivo($category,$color);
				break;
			case '3d':
				$this->slideShow_3d($category,$color);
				break;
			case 'kwicks':
				$this->slideShow_kwicks($category,$color);
				break;
			case 'anything':
				$this->slideShow_anything($category,$color);
				break;
		}
	}

	function slideShowHeader() {
		$type = false;
		
		if( is_front_page() || (is_home() && !get_option('page_on_front') && get_queried_object_id()== 0 )){
			$page= theme_get_option('homepage','home_page');
			if($page){
				if('slideshow' == get_post_meta($page, '_introduce_text_type', true)){
					$type = get_post_meta($page,'_slideshow_type', true);
				}
			}else{
				if (theme_get_option('homepage', 'disable_slideshow')) {
					return;
				}
				$type = theme_get_option('homepage', 'slideshow_type');
			}
		}elseif( is_single() || is_page() || (is_home() && get_queried_object_id()== get_option('page_for_posts'))){
			$post_id = get_queried_object_id();
			
			$introduce_type = get_post_meta($post_id, '_introduce_text_type', true);
			if('slideshow' == $introduce_type){
				$type = get_post_meta($post_id,'_slideshow_type', true);
			}
			$blog_page_id = theme_get_option('blog','blog_page');
			if('default' == $introduce_type && $post_id!=$blog_page_id){
				$show_in_header = theme_get_option('blog','show_in_header');
				if(!$show_in_header){
					$introduce_type = get_post_meta($blog_page_id, '_introduce_text_type', true);
					if('slideshow' == $introduce_type){
						$type = get_post_meta($blog_page_id,'_slideshow_type', true);
					}
				}
			}
		}
		if($type == "3d"){
			require_once (THEME_PLUGINS . '/Browser.php');
			$browser = new Browser();
			if($browser->isMobile()){
				$type = theme_get_option('slideshow','3d_mobile');
			}
		}
		
		switch($type){
			case 'nivo':
				$this->slideShowHeader_nivo();
				break;
			case '3d':
				$this->slideShowHeader_3d();
				break;
			case 'kwicks':
				$this->slideShowHeader_kwicks();
				break;
			case 'anything':
				$this->slideShowHeader_anything();
				break;
		}
	}
	function slideShowHeader_nivo() {
		$move_bottom = theme_get_option('advance','move_bottom');
		wp_enqueue_script('jquery-nivo');
		wp_enqueue_script('nivo-init', THEME_JS . '/nivoSliderInit.js',array('jquery'),false,$move_bottom);
	}
	function slideShowHeader_3d() {
		
	}
	function slideShowHeader_kwicks() {
		$move_bottom = theme_get_option('advance','move_bottom');
		wp_enqueue_script('jquery-easing');
		wp_enqueue_script('jquery-kwicks');
		wp_enqueue_script('kwicks-init', THEME_JS . '/kwicksSliderInit.js',array('jquery'),false,$move_bottom);
	}
	function slideShowHeader_anything() {
		$move_bottom = theme_get_option('advance','move_bottom');
		wp_enqueue_script('jquery-easing');
		wp_enqueue_script('jquery-anything');
		wp_enqueue_script('anything-init', THEME_JS . '/anythingSliderInit.js',array('jquery'),false,$move_bottom);
	}
	
	function slideShow_getImages($category=false,$number='-1',$size=array(960,440)){
		if($category === false){
			$category = theme_get_option('homepage', 'slideshow_category');
		}
		
		$loop = new WP_Query( array( 'post_type' => 'slideshow', 'showposts'=>$number, 'orderby'=>'menu_order', 'order'=>'ASC','taxonomy' => 'slideshow_category','term'=>$category) );
		$images = array();
		while ( $loop->have_posts() ) : $loop->the_post();
			$link_to = get_post_meta(get_the_ID(), '_link_to', true);
			$link = theme_get_superlink($link_to);
			
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src($image_id,$size, true);
			$link_target = get_post_meta(get_the_ID(), '_link_target', true);
			$link_target = $link_target?$link_target:'_self';
			$images[] = array(
				'id' => get_the_ID(),
				'title' => get_the_title(),
				'desc'  => get_post_meta(get_the_ID(), '_description', true),
				'src' => $image_url[0],
				'link' => $link,
				'target' => $link_target
 			);
		endwhile;
		wp_reset_query();
		return $images;
	}
	
	function slideShow_nivo($category=false,$color='') {
		if(!empty($color) && $color != "transparent"){
			$color = ' style="background-color:'.$color.'"';
		}else{
			$color = '';
		}
		echo <<<HTML

<div id="feature" class="nivo"{$color}>
	<div class="top_shadow"></div>
	<div class="inner">
		<div id="nivo_slider_wrap">
			<div id="nivo_slider">
HTML;
		
		$images = $this->slideShow_getImages($category,'-1','full');
		$height = theme_get_option('slideshow','nivo_height');
		$captions = theme_get_option('slideshow', 'nivo_captions');
		
		foreach($images as $image) {
			$title = $captions?$image['title']:'';
			if($image['link'] != ''){
				echo '<a href="'.$image['link'].'" target="'.$image['target'].'"><img src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w=960&amp;zc=1' . '" title="'.$title.'" /></a>';
			}else{
				echo '<img src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w=960&amp;zc=1' . '" title="'.$title.'" />';
			}
			
		}
		echo <<<HTML

			</div>
		</div>
	</div>
	<div class="bottom_shadow"></div>
</div>
HTML;

		$options = array(
			'effect' => theme_get_option('slideshow', 'nivo_effect'), 
			'slices' => theme_get_option('slideshow', 'nivo_slices'), 
			'animSpeed' => theme_get_option('slideshow', 'nivo_animSpeed'), 
			'pauseTime' => theme_get_option('slideshow', 'nivo_pauseTime'), 
			'directionNav' => theme_get_option('slideshow', 'nivo_directionNav'), 
			'directionNavHide' => theme_get_option('slideshow', 'nivo_directionNavHide'), 
			'controlNav' => theme_get_option('slideshow', 'nivo_controlNav'), 
			'keyboardNav' => theme_get_option('slideshow', 'nivo_keyboardNav'), 
			'pauseOnHover' => theme_get_option('slideshow', 'nivo_pauseOnHover'), 
			'manualAdvance' => theme_get_option('slideshow', 'nivo_manualAdvance'),
			'captions' => theme_get_option('slideshow', 'nivo_captions'),
			'captionOpacity' => theme_get_option('slideshow', 'nivo_captionOpacity'),
			'stopAtEnd' => theme_get_option('slideshow', 'nivo_stopAtEnd'),
		);
		
		echo "\n<script type=\"text/javascript\">\n";
		echo "var slideShow = []; \n";
		foreach($options as $key => $value) {
			if (is_bool($value)) {
				$value = $value ? "true" : "false";
			} elseif($value!="true"&&$value!="false") {
				$value = "'" . $value . "'";
			}
			echo "slideShow['" . $key . "'] = " . $value . "; \n";
		}
		echo "</script>\n";
	}
	function slideShow_3d($category=false,$color='') {
		if(!empty($color) && $color != "transparent"){
			$color = ' style="background-color:'.$color.'"';
		}else{
			$color = '';
		}
		$height = theme_get_option('slideshow', '3d_height');
		$wrap_height = $height+70;
		$uri = THEME_URI;
		$uploads = wp_upload_dir();
		if($category === false){
			$category = theme_get_option('homepage', 'slideshow_category');
		}
		$category = $category?'?category='.$category:'';
		
		$noflash = __('You need to <a href="http://www.adobe.com/products/flashplayer/" target="_blank">upgrade your Flash Player</a> to version 10 or newer.','striking_front');
		$output = <<<HTML

<div id="feature" class="3d"{$color}>
	<div class="top_shadow"></div>
	<div id="piecemaker">
		<div class="inner">
			<div id="introduce">{$noflash}</div>
		</div>
	</div>
	<div class="bottom_shadow"></div>
</div>
<script type="text/javascript">
	jQuery(document).ready(
		function() {
			jQuery('#piecemaker').flash({
				swf:"{$uri}/piecemaker/piecemaker_{$height}.swf",
				wmode:"transparent",
				height: {$wrap_height},
				width:'100%',
				hasVersion:10,
				menu:false,
				AllowScriptAccess:'always',
				expressInstaller: "{$uri}/swf/expressInstall.swf",
				flashvars: {
					xmlSource: "{$uri}/piecemaker/piecemakerXML.php{$category}",
					cssSource: "{$uri}/piecemaker/piecemakerCSS.css",
					imageSource: "{$uploads['baseurl']}"
				}
			});
		}
	);

</script>
HTML;
		echo $output;
	}
	
	function slideShow_kwicks($category=false,$color='') {
		if(!empty($color) && $color != "transparent"){
			$color = ' style="background-color:'.$color.'"';
		}else{
			$color = '';
		}
		$options = array(
			'autoplay' => theme_get_option('slideshow', 'kwicks_autoplay'),
			'pauseTime' => theme_get_option('slideshow', 'kwicks_pauseTime'),
			'number' => theme_get_option('slideshow', 'kwicks_number'),
			'max' => theme_get_option('slideshow', 'kwicks_max'),
			'duration' => theme_get_option('slideshow', 'kwicks_duration'),
			'easing' => theme_get_option('slideshow', 'kwicks_easing'),
			'title' => theme_get_option('slideshow', 'kwicks_title'),
			'title_speed' => theme_get_option('slideshow', 'kwicks_title_speed'),
			'title_opacity' => theme_get_option('slideshow', 'kwicks_title_opacity'),
			'detail' => theme_get_option('slideshow', 'kwicks_detail'),
			'detail_speed' => theme_get_option('slideshow', 'kwicks_detail_speed'),
			'detail_opacity' => theme_get_option('slideshow', 'kwicks_detail_opacity')
		);
		$height = theme_get_option('slideshow','kwicks_height');
		$number = theme_get_option('slideshow', 'kwicks_number');
		$number = $number ? $number : 4;
		echo <<<HTML

<div id="feature" class="kwicks_slider"{$color}>
	<div class="top_shadow"></div>
		<div class="inner">
			
HTML;
		echo '<ul id="kwicks" class="kwicks-number-'.$number.'">';
		$images = $this->slideShow_getImages($category,$number,'full');
		foreach($images as $image) {
			if($image['link'] != ''){
				$link = $image['link'];
			}else{
				$link = '#';
			}
			echo "\n<li>";
			echo '<a href="'.$link.'" target="'.$image['target'].'"><img src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w='. $options['max'] . '&amp;zc=1" alt="" /></a>';
			echo '<div class="kwick_title">' . $image['title'] . '</div>';
			echo '<div class="kwick_detail"><h3>' . $image['title'] . '</h3><p>' . $image['desc'] . '</p></div>';
			echo "</li>";
		}
echo <<<HTML

			</ul>
			<div id="kwicks_shadow"></div>
		</div>
	<div class="bottom_shadow"></div>
</div>
HTML;
		
		echo "\n<script type=\"text/javascript\">\n";
		echo "var slideShow = []; \n";
		foreach($options as $key => $value) {
			if (is_bool($value)) {
				$value = $value ? "true" : "false";
			} else if (is_numeric($value)) {
			
			} else {
				$value = "'" . $value . "'";
			}
			echo "slideShow['" . $key . "'] = " . $value . "; \n";
		}
		echo "</script>\n";
	}

	function slideShow_anything($category=false,$color) {
		if(!empty($color) && $color != "transparent"){
			$color = ' style="background-color:'.$color.'"';
		}else{
			$color = '';
		}
		echo <<<HTML

<div id="feature" class="anything"{$color}>
	<div class="top_shadow"></div>
	<div class="inner">
		<div id="anything_slider_wrap">
			<ul id="anything_slider">
HTML;
		
		$images = $this->slideShow_getImages($category,'-1','full');
		$height = theme_get_option('slideshow','anything_height');
		
		foreach($images as $image) {
			$bg = get_post_meta($image['id'], '_anything_bg', true);
			if($bg != ''){
				$bg = ' style="background-color:'.$bg.'"';
			}
			if(theme_is_enabled(get_post_meta($image['id'], '_anything_stop', true))){
				$stop = ' stoped';
			}else{
				$stop = '';
			}
			if(theme_is_enabled(get_post_meta($image['id'], '_anything_click_stop', true))){
				$click_stop = ' click_stoped';
			}else{
				$click_stop = '';
			}
			echo "\n<li class='panel".$stop.$click_stop."'".$bg.">\n";
		
			switch(get_post_meta($image['id'], '_anything_type', true)){
				case 'sidebar':
					echo '<div class="anything_sidebar_'.get_post_meta($image['id'], '_sidebar_position', true).'">';
					echo '<div class="anything_sidebar_content">';
					$page_data = get_page( $image['id'] );
					$content = $page_data->post_content; 
					echo apply_filters('the_content', stripslashes( $content ));
					echo '</div>';
					echo '<div class="anything_sidebar_image">';
					if($image['link'] != ''){
						echo '<a href="'.$image['link'].'" target="'.$image['target'].'"><img class="slideimage" src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w=660&amp;zc=1" alt="" /></a>';
					}else{
						echo '<img class="slideimage" src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w=660&amp;zc=1" alt="" />';
					}
					echo '</div>';
					echo '</div>';
					break;
				case 'html':
					$page_data = get_page( $image['id'] );
					$content = $page_data->post_content; 
					echo apply_filters('the_content', stripslashes( $content ));
					break;
				case 'image':
				default:
					$caption_position = get_post_meta($image['id'], '_image_caption_position', true);
					
					if($image['link'] != ''){
						if($caption_position != '' && $caption_position !='disable'){
							echo '<a href="'.$image['link'].'" target="'.$image['target'].'" class="anything_caption caption_'.$caption_position.'">';
							echo '<h3>'.$image['title'].'</h3>';
							if($image['desc']) echo '<p>'.$image['desc'].'</p>';
							echo '</a>';
						}
						echo '<a href="'.$image['link'].'" target="'.$image['target'].'"><img class="slideimage" src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w=960&amp;zc=1" alt="" /></a>';
					}else{
						if($caption_position != '' && $caption_position !='disable'){
							echo '<div class="anything_caption caption_'.$caption_position.'">';
							echo '<h3>'.$image['title'].'</h3>';
							if($image['desc']) echo '<p>'.$image['desc'].'</p>';
							echo '</div>';
						}
						echo '<img class="slideimage" src="' . THEME_INCLUDES.'/timthumb.php?src='.get_image_src($image['src']).'&amp;h='.$height.'&amp;w=960&amp;zc=1" alt="" />';
					}
					break;
			}
			echo "\n</li>\n";
		}
		echo <<<HTML

			</ul>
		</div>
		<div id="anything_shadow"></div>
	</div>
	<div class="bottom_shadow"></div>
</div>
HTML;

		$options = array(
			'height' => theme_get_option('slideshow', 'anything_height'), 
			'buildArrows' => theme_get_option('slideshow', 'anything_buildArrows'), 
			'toggleArrows' => theme_get_option('slideshow', 'anything_toggleArrows'), 
			'buildNavigation' => theme_get_option('slideshow', 'anything_buildNavigation'), 
			'toggleControls' => theme_get_option('slideshow', 'anything_toggleControls'), 
			'autoPlay' => theme_get_option('slideshow', 'anything_autoPlay'), 
			'pauseOnHover' => theme_get_option('slideshow', 'anything_pauseOnHover'), 
			'resumeOnVideoEnd' => theme_get_option('slideshow', 'anything_resumeOnVideoEnd'),
			'stopAtEnd' => theme_get_option('slideshow', 'anything_stopAtEnd'),
			'playRtl' => theme_get_option('slideshow', 'anything_playRtl'),
			'delay' => theme_get_option('slideshow', 'anything_delay'),
			'animationTime' => theme_get_option('slideshow', 'anything_animationTime'),
			'easing' => theme_get_option('slideshow', 'anything_easing'),
			'captionOpacity' => theme_get_option('slideshow', 'anything_captionOpacity'),
		);
		
		echo "\n<script type=\"text/javascript\">\n";
		echo "var slideShow = []; \n";
		foreach($options as $key => $value) {
			if (is_bool($value)) {
				$value = $value ? "true" : "false";
			} elseif($value!="true"&&$value!="false") {
				$value = "'" . $value . "'";
			}
			echo "slideShow['" . $key . "'] = " . $value . "; \n";
		}
		echo "</script>\n";
	}
}
function theme_generator($function){
	global $_themeGenerator;
	$_themeGenerator = new themeGenerator;
	$args = array_slice( func_get_args(), 1 );
	return call_user_func_array(array( &$_themeGenerator, $function ), $args );
}
