<?php
function theme_shortcode_portfolio($atts, $content = null, $code) {
	global $wp_filter;
	$the_content_filter_backup = $wp_filter['the_content'];
	extract(shortcode_atts(array(
		'column' => 4,
		'cat' => '',
		'max' => -1,
		'title' => '',
		'desc' => '',
		'more' => '',
		'moretext' => '',
		'height' => '',
		'nopaging' => 'false',
		'sortable' => 'false',
		'group' => 'true',
		'lightboxtitle' => 'portfolio', //portfolio,image,none
		'advancedesc'=>'false',
		'ids' => '',
	), $atts));
	switch($column){
		case 1:
			$column_class = 'one_column';
			$size = array(600, (int)theme_get_option('portfolio','1_column_height'));
			break;
		case 2:
			$column_class = 'two_columns';
			$size = array(450, (int)theme_get_option('portfolio','2_columns_height'));
			break;
		case 3:
			$column_class = 'three_columns';
			$size = array(292, (int)theme_get_option('portfolio','3_columns_height'));
			break;
		case 4:
		default:
			$column_class = 'four_columns';
			$size = array(217, (int)theme_get_option('portfolio','4_columns_height'));
	}
	if($height){
		$size[1] = $height;
	}
	$rel_group = 'portfolio_'.rand(1,1000); //for lightbox group
	if ($sortable != 'false') {
		//print scripts for sortable
		wp_print_scripts('jquery-quicksand');
		wp_print_scripts('jquery-easing');
		
		$output = '<section class="portfolios sortable">';
		$output .= '<header class="sort_by_cat">';
		$output .= '<span>'.__('Show:','striking_front').'</span>';
		$output .= '<a class="current" data-value="all" href="#">'.__('All','striking_front').'</a>';
		$terms = array();
		if ($cat != '') {
			foreach(explode(',', $cat) as $term_slug) {
				$terms[] = get_term_by('slug', $term_slug, 'portfolio_category');
			}
		} else {
			$terms = get_terms('portfolio_category', 'hide_empty=1');
		}
		foreach($terms as $term) {
			$output .= '<a data-value="' . $term->slug . '" href="#">' . $term->name . '</a>';
		}
		
		$output .= '</header>';
		$nopaging = 'true';
	} else {
		$output = '<section class="portfolios">';
	}
	$output .= '<ul class="portfolio_' . $column_class . '">';

	if ($nopaging == 'false') {
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query = array(
			'post_type' => 'portfolio', 
			'posts_per_page' => $max, 
			'taxonomy' => 'portfolio_category', 
			'term' => $cat, 
			'paged' => $paged,
			'orderby'=>'menu_order', 
			'order'=>'ASC'
		);
	} else {
		$query = array(
			'post_type' => 'portfolio', 
			'showposts' => $max,
			'taxonomy' => 'portfolio_category', 
			'term' => $cat,
			'orderby'=>'menu_order', 
			'order'=>'ASC'
		);
	}
	if($ids){
		$query['post__in'] = explode(',',$ids);
	}
	query_posts($query);
	$i = 1;
	//deprecated
	if($title == ''){
		if(theme_get_option('portfolio','display_title') || $column == 1){
			$title = 'true';
		}
	}
	if($desc == ''){
		if(theme_get_option('portfolio','display_excerpt') || $column == 1){
			$desc = 'true';
		}
	}
	
	switch($more){
		case '':
			if( theme_get_option('portfolio','display_more_button') ){
				$more = true;
			}
			break;
		case 'false':
			$more = false;
			break;
		case 'true':
		default:
			$more = true;
			break;
	}
	while(have_posts()) {
		the_post();
		$terms = get_the_terms(get_the_id(), 'portfolio_category');
		$terms_slug = array();
		if (is_array($terms)) {
			foreach($terms as $term) {
				$terms_slug[] = $term->slug;
			}
		}
		
		if (($i % $column) == 0 && $column != 1) {
			$output .= '<li data-id="'.get_the_id().'" data-type="' . implode(',', $terms_slug) . '">';
		} else {
			$output .= '<li data-id="'.get_the_id().'" data-type="' . implode(',', $terms_slug) . '">';
		}
		$i++;
		
		if (has_post_thumbnail()) {
			$image_id = get_post_thumbnail_id(get_the_id());
			$image = wp_get_attachment_image_src($image_id, 'full', true);
			
			$type = get_post_meta(get_the_id(), '_type', true);
			$width = '';
			$height = '';
			$iframe = '';
			$inline = '';
			if($type == 'image'){
				$href =  get_post_meta(get_the_id(), '_image', true);
				if(empty($href)){
					$href = $image[0];
				}
				$icon = 'zoom';
				$lightbox = ' lightbox';
				if($group == 'true'){
					$rel = ' rel="'.$rel_group.'"';
				}else{
					$rel = '';
				}
			}elseif($type == 'video'){
				$href =  get_post_meta(get_the_id(), '_video', true);
				if(empty($href)){
					$href = $image[0];
				}
				$video_width = get_post_meta(get_the_id(), '_video_width', true);
				$video_height = get_post_meta(get_the_id(), '_video_height', true);
				if($video_width==''){
					$video_width = theme_get_option('portfolio','video_width');
				}
				if($video_height==''){
					$video_height = theme_get_option('portfolio','video_height');
				}
				$width = ' data-width="'.$video_width.'"';
				$height = ' data-height="'.$video_height.'"';
				
				$icon = 'play';
				$lightbox = ' lightbox';
				if($group == 'true'){
					$rel = ' rel="'.$rel_group.'"';
				}else{
					$rel = '';
				}
			}elseif($type == 'lightbox'){
				$href =  get_post_meta(get_the_id(), '_lightbox_href', true);
				if(empty($href)){
					$inline_id = 'portfolio_inline_'.get_the_id();
					$href = '#';
					$inline = ' data-inline="true" data-href="#'.$inline_id.'"';
					$output .= '<div class="hidden"><div id="'.$inline_id.'">';
					$output .= do_shortcode(get_post_meta(get_the_id(), '_lightbox_content', true));
					$output .= '</div></div>';
				}else{
					$iframe = ' data-iframe="true"';
				}
				$lightbox_width = get_post_meta(get_the_id(), '_lightbox_width', true);
				$lightbox_height = get_post_meta(get_the_id(), '_lightbox_height', true);
				if($lightbox_width==''){
					$lightbox_width = theme_get_option('portfolio','lightbox_width');
				}
				if($lightbox_height==''){
					$lightbox_height = theme_get_option('portfolio','lightbox_height');
				}
				$width = ' data-width="'.$lightbox_width.'"';
				$height = ' data-height="'.$lightbox_height.'"';
				
				$icon = 'zoom';
				$lightbox = ' fancyLightbox';
				if($group == 'true'){
					$rel = ' rel="'.$rel_group.'"';
				}else{
					$rel = '';
				}
			}elseif($type == 'link'){
				$link = get_post_meta(get_the_ID(), '_link', true);
				$href = theme_get_superlink($link);
				$link_target = get_post_meta(get_the_ID(), '_link_target', true);
				$link_target = $link_target?$link_target:'_self';
				$icon = 'link';
				$lightbox = '';
				$rel = '';
			}elseif($type == 'gallery'){
				$image_ids_str = get_post_meta(get_the_id(), '_image_ids', true);
				$image_ids = array();
				if(!empty($image_ids_str)){
					$image_ids = explode(',',str_replace('image-','',$image_ids_str));
					$image_id = array_shift($image_ids);
					if($lightboxtitle=='portfolio'){
						$image_title = get_the_title();
					}elseif($lightboxtitle=='image'){
						//$attachment = get_post( $image_id );
						//$image_title = $attachment->post_excerpt;//Caption
						//$image_title = $attachment->post_content;;//Description
						$image_title = get_the_title($image_id);
					}else{
						$image_title = '';
					}
					$image_src = wp_get_attachment_image_src($image_id,'full');
					$href = $image_src[0];
				}else{
					$href =  get_post_meta(get_the_id(), '_image', true);
					if(empty($href)){
						$href = $image[0];
					}
					if($lightboxtitle=='portfolio'){
						$image_title = get_the_title();
					}else{
						$image_title = '';
					}
				}
				$icon = 'zoom';
				$lightbox = ' lightbox';
				if($group == 'true'){
					$rel = ' rel="'.$rel_group.'"';
				}else{
					$rel = ' rel="gallery-'.get_the_ID().'"';
				}
			}else{
				$href = get_permalink();
				$icon = 'doc';
				$lightbox = '';
				$rel = '';
			}
			
			if($type!=='gallery'){
				if($lightboxtitle=='portfolio'){
						$image_title = get_the_title();
				}elseif($lightboxtitle=='image'){
						$image_title = get_the_title($image_id);
				}else{
						$image_title = '';
				}
			}
			$override_icon = get_post_meta(get_the_ID(), '_icon', true);
			if($override_icon && $override_icon != 'default'){
				$icon = $override_icon;
			}
			
			$output .= '<div class="image_styled portfolio_image">';
			$output .= '<span class="image_frame" style="height:'.$size[1].'px">';
			$output .= '<a class="image_icon_'.$icon.$lightbox.'" '.(isset($link_target)?'target="'.$link_target.'" ':'').' title="'. $image_title .'" href="' . $href . '"'.$rel.$width.$height.$inline.$iframe.'>';
			
			$output .= '<img src="' . THEME_INCLUDES . '/timthumb.php?src=' . get_image_src($image[0]) . '&amp;h=' . $size[1] . '&amp;w=' . $size[0] . '&amp;zc=1' . '" title="' . get_the_title() . '" alt="' . get_the_title() . '" />';
			$output .= '</a>';
			$output .= '</span>';
			$output .= '<img src="' . THEME_IMAGES . '/image_shadow.png" class="image_shadow">';
			$output .= '</div>';
		}
		
		$output .= '<div class="portfolio_details">';
		
		if($title == 'true'){
			$output .= '<div class="portfolio_title">' . get_the_title() . '</div>';
		}
		
		if($desc == 'true'){
			if($advancedesc == 'true'){
				remove_filter('get_the_excerpt', 'wp_trim_excerpt');
				$output .= '<div class="portfolio_desc">' . do_shortcode(wpautop(get_the_excerpt())) . '</div>';
			}else{
				$output .= '<div class="portfolio_desc">' . get_the_excerpt() . '</div>';
			}
			
		}
		if(theme_is_enabled(get_post_meta(get_the_id(), '_more', true), $more)){
			$more_link = theme_get_superlink(get_post_meta(get_the_id(), '_more_link', true), get_permalink());
			$more_link_target = get_post_meta(get_the_ID(), '_more_link_target', true);
			$more_link_target = $more_link_target?$more_link_target:'_self';
			if($moretext !== ''){
				$output .= '<div class="portfolio_more_button"><a href="'.$more_link.'" target="'.$more_link_target.'"><span>'.$moretext.'</span></a></div>';
			} else{
				$output .= '<div class="portfolio_more_button"><a href="'.$more_link.'" target="'.$more_link_target.'"><span>'.wpml_t(THEME_NAME , 'Portfolio More Button Text',theme_get_option('portfolio','more_button_text')).'</span></a></div>';
			}
		}
		if($type == 'gallery'&&!empty($image_ids)){
			$output .= '<div class="hidden">';
			foreach($image_ids as $image_id){
				if($lightboxtitle=='portfolio'){
					$image_title = get_the_title();
				}elseif($lightboxtitle=='image'){
					//$attachment = get_post( $image_id );
					//$image_title = $attachment->post_excerpt;//Caption
					//$image_title = $attachment->post_content;;//Desc
					$image_title = get_the_title($image_id);
				}else{
					$image_title = '';
				}
				$image_src = wp_get_attachment_image_src($image_id,'full');
				$output .= '<a class="lightbox" href="'.$image_src[0].'" title="'. $image_title .'" rel="'.(($group=='true')?$rel_group:'gallery-'.get_the_ID()).'">gallery-'.get_the_ID().'</a>';
			}
			$output .= '</div>';
		}
		$output .= '</div>';
		$output .= '</li>';
	}
	$output .= '</ul>';
	if ($nopaging == 'false') {
		ob_start();
		theme_portfolio_pagenavi('', '', $paged);
		$output .= ob_get_clean();
	}
	$output .= '</section>';
	wp_reset_query();
	$wp_filter['the_content'] = $the_content_filter_backup;
	return $output;
}
add_shortcode('portfolio', 'theme_shortcode_portfolio');

function theme_portfolio_pagenavi($before = '', $after = '', $paged) {
	global $wpdb, $wp_query;
	
	if (is_single())
		return;
	
	$pagenavi_options = array(
		//'pages_text' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%','striking_front'),
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','striking_front'),
		'last_text' => __('Last &raquo;','striking_front'),
		'next_text' => __('&raquo;','striking_front'),
		'prev_text' => __('&laquo;','striking_front'),
		'dotright_text' => __('...','striking_front'),
		'dotleft_text' => __('...','striking_front'),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = intval($wp_query->max_num_pages);
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . clean_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . clean_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				previous_posts_link($pagenavi_options['prev_text']);
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . clean_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . clean_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
				if ($end_page < $max_page) {
					if (! empty($pagenavi_options['dotright_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="' . clean_url(get_pagenum_link($max_page)) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
				}
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . clean_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . clean_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}