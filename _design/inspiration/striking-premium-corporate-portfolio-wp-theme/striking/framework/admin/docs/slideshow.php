<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>

<h2>SlideShow Options Page</h2>
<p>The fields on <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_slideshow">Strinking->Slider</a> options page determine some of the basics of your slider set.<br/>
Striking contains 3 different slider show types. When you select one type, you should configure the corresponding options.

</p>
<h2>Add Slider Item</h2>
<p>If you want to add a new slider item, follow the steps below:</p>
<ol>
	<li>Click  <a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php?post_type=slideshow"> Slider Items->Add New</a>. </li>
	<li>Set the image of slider item as <strong>Featured Image</strong>.<br />
		Notice that default size of slider is 960x440px.
	</li>
	<li>You can order  slider item into a category. If there haven't or the exist be not the one you want, you can create one yourself. Then after fill the title and the description (only work for Accordion slider).
	</li>
	<li>At last click <strong>Publish</strong> Button, and go to your homepage, you'll see it works.</li>
</ol>
<h2>Add Slideshow to page</h2>
<p>When you create a new page or edit a exist page, you can add slideshow to it by following the step below:</p>
<ol>
	<li>Locate the "Strinking Page General Option" module.</li>
	<li>Set "Header Introduce Type" to "SlideShow".</li>
	<li>Change the "SlideShow Category" to the category you want. This tells WordPress to display this specific category of slider items on your page.</li>
	<li>Set "SlideShow Type".</li>
	<li>Click <strong>Publish</strong> Button.</li>
</ol>