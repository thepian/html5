<?php 
$post_id = get_queried_object_id();
if(is_blog()){
	return require(THEME_DIR . "/template_blog.php");
}elseif(empty($post_id) || $post_id != get_option( 'page_for_posts' )){
	return require(THEME_DIR . "/front-page.php");
}
$layout=theme_get_option('blog','layout');
$blog_page_date = &get_page($post_id);
$content = $blog_page_date->post_content;
?>
<?php get_header(); ?>
<?php theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
			<?php theme_generator('breadcrumbs',$post_id);?>
			<div class="content">
				<?php echo apply_filters('the_content', stripslashes( $content ));?>
				<div class="clearboth"></div>
			</div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
	<div id="page_bottom"></div>
</div>
<?php get_footer(); ?>