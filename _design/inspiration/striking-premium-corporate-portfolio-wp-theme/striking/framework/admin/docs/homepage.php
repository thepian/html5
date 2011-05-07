<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>
<h2>Use Default Homepage</h2>
<p>You can edit your homepage in the <strong>Homepage Content Editor</strong> in <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_homepage">Strinking->Homepage</a>. Fill the content you want to display into it or use <strong>Shortcode Generator</strong> to send shortcode into it.
Then Click <strong>Save Changes</strong> Button.</p>

<h3>Homepage Slideshow</h3>
<p>If you want to add slideshow in your homepage, you can follow the step below:</p>
<ol>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_homepage">Strinking->Homepage</a>, locate the <strong>Homepage Slideshow</strong> module.</li>
	<li>Turn off the toggle <strong>Disable Slideshow</strong>.</li>
	<li>Select the type of slideshow category you want from the <strong>SlideShow Category</strong> dropdown.</li>
	<li>Select the type of slideshow you want from the <strong>SlideShow Type</strong> dropdown.</li>
	<li>Click <strong>Save Changes</strong> Button.</li>
</ol>

<h2>Create A Page For Homepage</h2>
<p>Alternately, you can create a page for homepage instead of using default homepage. It's more flexible by using different types of .</p>
<p>Follow the step below:</p>
<ol>
	<li>Click <a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php?post_type=page">Pages -> Add New</a> in your dashboard.</li>
	<li>Title this page "Home" (you can, of course, name it whatever you like).</li>
	<li>Click <strong>Publish</strong> Button.</li>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_homepage">Strinking->Homepage</a> .
	Select "Home" (or the name you crearte to use in the homepage) from the <strong>Home Page</strong> dropdown.
	This tells WordPress to display this page as your homepage.
	</li>	
	<li>Choose the type of homepage's layout in the <strong>Layout</strong> dropdown.</li>
	<li>Click <strong>Save Changes</strong> Button.</li>
</ol>
<p><strong>NOTE</strong>:<br/>
	If you want display slideshow on the homepage, you can choose <strong>Feature Header Type</strong> to <strong>slideshow</strong> in <strong>Page General Options</strong> module.
</p>


