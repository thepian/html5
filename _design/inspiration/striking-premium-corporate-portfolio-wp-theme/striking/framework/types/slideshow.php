<?php
/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Gallerys */
/*-----------------------------------------------------------------------------------*/
function register_slideshow_post_type(){
	register_post_type('slideshow', array(
		'labels' => array(
			'name' => _x('Slider Items', 'post type general name', 'striking_admin'),
			'singular_name' => _x('Slider Item', 'post type singular name', 'striking_admin'),
			'add_new' => _x('Add New', 'slideshow', 'striking_admin'),
			'add_new_item' => __('Add New Slider Item', 'striking_admin'),
			'edit_item' => __('Edit Slider Item', 'striking_admin'),
			'new_item' => __('New Slider Item', 'striking_admin'),
			'view_item' => __('View Slider Item', 'striking_admin'),
			'search_items' => __('Search Slider Items', 'striking_admin'),
			'not_found' =>  __('No slider item found', 'striking_admin'),
			'not_found_in_trash' => __('No slider items found in Trash', 'striking_admin'), 
			'parent_item_colon' => '',
			'menu_name' => __('Slider Items', 'striking_admin' ),
		),
		'singular_label' => __('slideshow', 'striking_admin'),
		'public' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		//'menu_position' => 20,
		'capability_type' => 'page',
		'hierarchical' => false,
		'supports' => array('title','editor', 'thumbnail' , 'page-attributes'),
		'has_archive' => false,
		'rewrite' => false,
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => false,
	));
	
	//register taxonomy for portfolio
	register_taxonomy('slideshow_category','slideshow',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Slider Categories', 'taxonomy general name', 'striking_admin' ),
			'singular_name' => _x( 'Slideshow Category', 'taxonomy singular name', 'striking_admin' ),
			'search_items' =>  __( 'Search Categories', 'striking_admin' ),
			'popular_items' => __( 'Popular Categories', 'striking_admin' ),
			'all_items' => __( 'All Categories', 'striking_admin' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Slideshow Category', 'striking_admin' ), 
			'update_item' => __( 'Update Slideshow Category', 'striking_admin' ),
			'add_new_item' => __( 'Add New Slideshow Category', 'striking_admin' ),
			'new_item_name' => __( 'New Slideshow Category Name', 'striking_admin' ),
			'separate_items_with_commas' => __( 'Separate Slideshow category with commas', 'striking_admin' ),
			'add_or_remove_items' => __( 'Add or remove slideshow category', 'striking_admin' ),
			'choose_from_most_used' => __( 'Choose from the most used slideshow category', 'striking_admin' ),
			'menu_name' => __( 'Categories', 'striking_admin' ),
		),
		'public' => true,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_tagcloud' => false,
		'query_var' => false,
		'rewrite' => false,
	));
}
add_action('init','register_slideshow_post_type',0);

function slideshow_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'slideshow' ) {
		global $wp_query;
		$wp_query->is_home = false;
		$wp_query->is_404 = true;
		$wp_query->is_single = false;
		$wp_query->is_singular = false;
	}
}
add_action( 'template_redirect', 'slideshow_context_fixer' );