<?php 
if(is_blog()){
	return require(THEME_DIR . "/template_blog.php");
}
get_header();
global $home_page_id;
$home_page_id = theme_get_option('homepage','home_page');

if($home_page_id){
	$home_page_id = wpml_get_object_id($home_page_id,'page');
	theme_generator('introduce',$home_page_id);
	$home_page_date = &get_page($home_page_id);
	$content = $home_page_date->post_content;
}else{
	theme_generator('slideShow');
	$content = theme_get_option('homepage','content');
}
$layout=theme_get_option('homepage','layout');
?>
<div id="page" class="home">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
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