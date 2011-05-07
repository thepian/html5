<?php
/*-----------------------------------------------------------------------------------*/
/* Register Custom Post Types - Portfolios */
/*-----------------------------------------------------------------------------------*/
function register_portfolio_post_type(){
	// Rewriting Permalink Slug
	$permalink_slug = trim(theme_get_option('portfolio','permalink_slug'));
	if ( empty($permalink_slug) ) {
		$permalink_slug = 'portfolio';
	}
	register_post_type('portfolio', array(
		'labels' => array(
			'name' => _x('Portfolio items', 'post type general name', 'striking_admin' ),
			'singular_name' => _x('Portfolio Item', 'post type singular name', 'striking_admin' ),
			'add_new' => _x('Add New', 'portfolio', 'striking_admin' ),
			'add_new_item' => __('Add New Portfolio Item', 'striking_admin' ),
			'edit_item' => __('Edit Portfolio Item', 'striking_admin' ),
			'new_item' => __('New Portfolio Item', 'striking_admin' ),
			'view_item' => __('View Portfolio Item', 'striking_admin' ),
			'search_items' => __('Search Portfolio Items', 'striking_admin' ),
			'not_found' =>  __('No portfolio item found', 'striking_admin' ),
			'not_found_in_trash' => __('No portfolio items found in Trash', 'striking_admin' ), 
			'parent_item_colon' => '',
			'menu_name' => __('Portfolio items', 'striking_admin' ),
		),
		'singular_label' => __('portfolio', 'striking_admin' ),
		'public' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		//'menu_position' => 20,
		'capability_type' => 'page',
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes'),
		'has_archive' => false,
		'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>false ),
		'query_var' => false,
		'can_export' => true,
		'show_in_nav_menus' => true,
	));

	//register taxonomy for portfolio
	register_taxonomy('portfolio_category','portfolio',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => _x( 'Portfolio Categories', 'taxonomy general name', 'striking_admin' ),
			'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'striking_admin' ),
			'search_items' =>  __( 'Search Categories', 'striking_admin' ),
			'popular_items' => __( 'Popular Categories', 'striking_admin' ),
			'all_items' => __( 'All Categories', 'striking_admin' ),
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => __( 'Edit Portfolio Category', 'striking_admin' ), 
			'update_item' => __( 'Update Portfolio Category', 'striking_admin' ),
			'add_new_item' => __( 'Add New Portfolio Category', 'striking_admin' ),
			'new_item_name' => __( 'New Portfolio Category Name', 'striking_admin' ),
			'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'striking_admin' ),
			'add_or_remove_items' => __( 'Add or remove portfolio category', 'striking_admin' ),
			'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'striking_admin' ),
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
add_action('init','register_portfolio_post_type',0);

function portfolio_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'portfolio' ) {
		global $wp_query;
		$wp_query->is_home = false;
	}
	if ( get_query_var( 'taxonomy' ) == 'portfolio_category' ) {
		global $wp_query;
		$wp_query->is_404 = true;
		$wp_query->is_tax = false;
		$wp_query->is_archive = false;
	}
}
add_action( 'template_redirect', 'portfolio_context_fixer' );