<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>

<h2>Ganeral Options Page</h2>
<p>The fields on <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php">Strinking->General</a> options page determine some of the basics of your theme setup.</p>

<h3>Header General</h3>
<h4>Logo</h4>	
<p>	If you want to use custom logo, you should turn on the toggle "Display Custom Logo" and paste the full URL (include http://) of your custom logo here or you can insert the image through the button.
	If you want to use text field as logo,you can turn off the toggle "Display Custom Logo" and go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php">Setting->general</a> to configure it in "Site Title".<br/>
	You must click the Save Changes button for new settings to take effect.
</p>
<h4>Site Description</h4>
<p>
	If you disable custom logo, you can choose whether to display Tagline after Site Title by turn on or off the toggle "Display Site Description". Then go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php">Setting->general</a> to edit it.
</p>
<h4>Top Area</h4>
<p>
	If you want some thing display at the right top corner of the page,you should choose the top area type. 
	If it's Html, you can add the codes you want below.If it's wegit area,you can edit it in <a href="<?php echo get_option('siteurl'); ?>/wp-admin/widgets.php.php">Appearance->Wedgets</a>.
</p>

<h3>Navigation Menu</h3>
<H4>Use Default Menu</H4>
<p>If you want to create a menu base on the page hierarchy. you can follow the steps below:</p>
<ol>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php">Strinking->General</a>.</li>
	<li>Turn off the <strong>Wordpress Built-in Menu</strong> toggle in <strong>Navigation Menu</strong> module.</li>
	<li>Arrange your pages in hierarchies by using <strong>Page Attributes</strong> module to set page parents and to change the order of your pages.</li>
	<li>Choose the exclude pages from menu in the option <strong>Exclude Pages From Menu</strong></li>
</ol>

<h4>Use Wordpress Built-in Menu</h4>
<p>Since version 3.0, wordpress introduce a custom menus system that you can create the menu more flexible. It allows you to:</p>
<ul>
	<li>Change the order of pages</li>
	<li>Nest pages to create sub-menus</li>
	<li>Display posts on multiple pages by creating category pages</li>
	<li>Add posts, tag pages, and custom links to your navigation menu</li>
</ul>
<p>Follow the steps below:</p>
<ol>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/options-general.php">Strinking->General</a>.</li>
	<li>turn on the <strong>Wordpress Built-in Menu</strong> toggle in <strong>Navigation Menu</strong> module.</li>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/nav-menus.php">Appearance->Menu</a>, click on the <strong>+</strong> tab, give the menu a name, and click <strong>Create Menu</strong>.</li>
	<li> Next, add menu items from the appropriate boxes. You'll be able to edit the information for each menu item, and can drag and drop to put them in order. You can also drag a menu item a little to the right to make it a submenu, to create menus with hierarchy. Drop the item into its new nested placement when the dotted rectangle target shifts over, also a little to the right.</li>
	<li> Don't forget to click Save when you're finished.</li>	
	<li>Then, Locate the <strong>Theme Locations</strong>. If you can't find it, go to the top of the page, click the <strong>Show on screen</strong> button.Select the matabox to make shure the option  to be showned. </li>
	<li>Select the menu you want to show in the <strong>Striking Navigation</strong>dropdown and <strong>Striking Footer Menu </strong>dropdown. If you don't want to show menu there, you can choose vacuity.</li>
</ol>

<h4>For More Informations:</h4>
<p>
<a target="_blank" href="http://en.support.wordpress.com/menus/">Support for Custom Menus</a><br>
<a target="_blank" href="http://codex.wordpress.org/Appearance_Menus_SubPanel">Documentation on Menus</a>


</p>