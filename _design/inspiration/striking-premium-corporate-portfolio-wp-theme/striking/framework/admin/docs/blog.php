<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>
<h2>Blog Optins Page</h2>
<p>If you want to display your blog, you should create a blank page with the name of your choice first. Then go to  <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_blog">Strinking->Blog</a>, assign the Blog Page option with the page you created.</p>
<h3>Create Blog Page</h3>
<ol>
	<li>Click <strong>Pages->Add New</strong> in your Dashboard.</li>
	<li>Title this page "post"(Or "Blog" if you want sitename.com/blog)</li>
	<li>You don't need to type any content, because it will not be displayed. Publish the page.</li>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/awp-admin/admin.php?page=theme_blog">Strinking->Blog</a> .
	Select <strong>Post</strong>(Or "blog") from the dropdown menu <strong>Blog Page</strong>.
	This tells WordPress to display this page as your blog page.</li>	
	<li>Choose the type of blog page's layout in the dropdown <strong>Layout</strong>.</li>
	<li>Choose the type of featured image in the dropdown <strong>Featured Image Type</strong>.</li>
	<li>Choosewhether to display full blog posts in index page by using the toggle <strong>Display Full Blog Posts</strong>.</li>
	<li>Choose which Categories of bolg to be excluded in the dropdown <strong>Exclude Categories</strong>.</li>
	<li>Choose the gap between posts.</li>
	<li>Click <strong>Save Changes</strong> Button.</li>
</ol>

<h2>Some Other Global Blog Setting</h2>

<h3>Single Blog</h3>
<p>You can change some sets for he single blog:</p>
<ol>
	<li><strong>Layout</strong></li>
	<li><strong>Featured Image</strong>: If this option is on, Featured Image will appear in Single Blog page.</li>
	<li><strong>Featured Image Type</strong></li>
	<li><strong>Featured Image for Lightbox</strong>: If this option is on, the full image will open in the lightbox when click on Featured Image of Blog Single Post page.</li>
	<li><strong>Show in Header Area</strong>: if this option is on, blog title and blog meta info will show in header introduce text area.</li>
	<li><strong>About Author Box</strong></li>
	<li><strong>Related & Popular Post Module</strong></li>
	<li><strong>Previous & Next Navigation</strong></li>
</ol>

<h3>Meta informations</h3>
<p>This module contain five botton, determining whether to show <strong>Category</strong>, <strong>Tags</strong>, <strong>Author</strong>, <strong>Date</strong>, <strong>Comment</strong>.</p>

<h3>Full Width Featured Image</h3>
<p>In this module, you can set the with of featured image. You can choose to use adaptive height or order a fixed height</p>

<h3>Left Float Featured Image</h3>
<p>You can order the size of left float featured image, including the width and the height.</p>


	



