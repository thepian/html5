<?php
$blog_page = theme_get_option('blog','blog_page');
if($blog_page == $post->ID){
	return require(THEME_DIR . "/template_blog.php");
}
$layout = get_post_meta($post->ID, '_layout', true);
if(empty($layout) || $layout == 'default'){
	$layout=theme_get_option('blog','single_layout');
}
$featured_image_type = theme_get_option('blog', 'single_featured_image_type');
?>
<?php  get_header(); ?>
<?php theme_generator('introduce',$post->ID);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
			<?php theme_generator('breadcrumbs',$post->ID);?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="entry content entry_<?php echo $featured_image_type;?>">
				<header>
<?php 

if(theme_is_enabled(get_post_meta($post->ID, '_featured_image', true), theme_get_option('blog','featured_image'))):
		echo theme_generator('blog_featured_image',$featured_image_type,$layout);
endif; ?>
<?php if(!theme_get_option('blog','show_in_header')):?>
					<div class="entry_info">
						<h1><a href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", 'striking_front'), get_the_title() ); ?>"><?php the_title(); ?></a></h1>
						<div class="entry_meta">
<?php echo theme_generator('blog_meta'); ?>
						</div>
					</div>
<?php endif;?>
				</header>
				<?php the_content(); ?>
				
				<footer>
					<?php edit_post_link(__('Edit', 'striking_front'),'<p class="entry_edit">','</p>'); ?>
					<?php if(theme_get_option('blog','author')):theme_generator('blog_author_info');endif;?>
					<?php if(theme_get_option('blog','related_popular')):?>
					<div class="related_popular_wrap">
						<div class="one_half">
							<?php theme_generator('blog_related_posts');?>
						</div>
						<div class="one_half last">
							<?php theme_generator('blog_popular_posts');?>
						</div>
						<div class="clearboth"></div>
					</div>
					<?php endif;?>
					<?php if(theme_get_option('blog','entry_navigation')):?>
					<nav class="entry_navigation">
						<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'striking_front' ) . '</span> %title' ); ?></div>
						<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'striking_front' ) . '</span>' ); ?></div>
					</nav>
					<?php endif;?>
				</footer>
				<div class="clearboth"></div>
			</article>
<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop.?>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
	<div id="page_bottom"></div>
</div>
<?php get_footer(); ?>
