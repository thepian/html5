<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>
<h2>Import & Export</h2>
<p>
When you want to update the theme, you should export te setting you changed before. <br/>
<ol>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_advance">Strinking->Adevance</a>.</li>
	<li>Locate the <strong>Import & Export</strong> module.</li>
	<li>Copy the code from the <strong>Export Striking Options Data</strong> metabox. You can save it anywhere you want.</li>
	<li>Upload your theme.</li>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_advance">Strinking->Adevance</a>, in the <strong>Import & Export</strong> module.
	Copy the code you saved to <strong>Import Striking Options Data</strong> metabox.
	</li>
	<li>Click <strong>Save Changes</strong> Button.</li>
</ol>
</p>

<h2>JavaScript & CSS Optimizer</h2>
<p>If you want to speed up your the loading for your pages, one of the best ways is to reduce the number of HTTP requests to the server. 
Every JavaScript file, CSS file, and image requires its own HTTP request and thus slows down loading time. 
The JavaScript & CSS Optimizer will consolidate multiple CSS and JavaScript files.
By useing JavaScript & CSS Optimizer, you can reduce the number of HTTP requests and increase the performance of your site.
When including external JavaScript files, placing them at the bottom of the page, just before the closing <html> element, ensures that your clients¡¯ browsers are able to download the maximum number of components, decreasing load times and improving performance.
</p>
<p>You should go to  <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_advance">Strinking->Adevance</a>,
locate the <strong>JavaScript & CSS Optimizer</strong> module, and turn on the <strong>Combine Js</strong> , <strong>Combine CSS</strong> or <strong>Move Js To Bottom</strong> toggle.</p>
<p>Notice that, there may be some conflict between JS. So if your page have something wrong after you trun on the toggle, you should turn off it. 
</p>