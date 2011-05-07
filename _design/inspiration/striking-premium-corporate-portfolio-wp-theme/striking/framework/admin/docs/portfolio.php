<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>


<h2>Portfolio Options Page</h2>
<p>The fields on <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_portfolio">Strinking->Portfolio</a> options page determine some of the basics of your portfolio setting. </p>
<p>You can edit your portfolio greneral in the page  <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_portfolio">Strinking->Portfolio</a>. Including:  <br/>
<strong>Breadcrumbs Parent Page</strong>, <strong>Display Title</strong>, <strong>Display Description</strong>,  <strong>Display More Button</strong>,  <strong>More Button Text</strong>.	
</p>
 
<h3>Some Other Global Configuration Setting</h3>

<p>In the rest of the page, you can edit some global configuration setting:
	<ol>
		<li><strong>Height of Thumbnail</strong><br/>inculding bottoms: One Column,  two Column,  three Column,  four Column.</li>
		<li><strong>Video Lightbox</strong><br/>inculding bottoms: Width,  Height.</li>
		<li><strong>Featured Image</strong><br/>inculding toggles: Featured Image,  Featured Image for Lightbox,  Adaptive Height and the bottom:Fixed Height.</li>
		<li><strong>Single Portfolio Item</strong><br/>inculding bottom:Layout,Previous Next Navigation Order; toggles:Previous & Next Navigation, Document Type Navigation, Enable Comment.</li>
	</ol>
</p>


<h2>Create Portfolio Items</h2>

<p>If you want to add a new portfolio item, follow the steps below:
<ol>
	<li>
		<p>Click <a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php?post_type=portfolio">Portfolio->Add New</a>. </p>
		
	</li>
	<li>		
		<p>Set the thumbnail of portfolio as <strong>Featured Image</strong>.You can go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_portfolio">Strinking->Portfolio</a> to change the set with in <strong>Featured Image</strong> module.</p>
	</li>
	<li>
		<p>Then configure the portfolio item options. Order the breadcrumbs parent page and the layout you want.  You can go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_portfolio">Strinking->Portfolio</a> to change the set with in <strong>Single Portfolio Item</strong> module.</p>
		<p>Determine the type of the portfolio you want to create.<br/>	
		There are six kind of portforlio you can creat. you can select them in the <strong>Portfolio Type</strong> dropdown within the <strong>Portfolio Item Options</strong> module. 
			<ul>
				<li><strong>Image</strong>: It will pop up a lightbox with a image when click the thumbnail of portfolio item.<br/>
				You can assign a full-size images you would like to use for the portfolio lightbox pop-up demonstrate by setting the url in the <strong>Fullsize Image for Lightbox (optional)</strong> or using the <strong>Insert Image</strong> button.If not assigned, it will use featured image instead.
				<li><strong>Gallery</strong>: It will pop up a lightbox with a group of images when click the thumbnail of portfolio item.<br/>
				You can create a gellery with some image you want. Add image by using the <strong>Insert Image</strong> button within the <strong>Portfolio Gallery</strong> module. The oder show in the module is the order show in the gellery.
				</li>
				</li>
				<li><strong>Video</strong>: It will pop up a lightbox with a video when click the thumbnail of portfolio item.<br/>
				You can paste the full url of the Flash(YouTube or Vimeo etc) in the <strong>Video Link for Lightbox</strong>. The default size of video is in the  <strong>Video Lightbox</strong> module within <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_portfolio">Strinking->Portfolio</a>. You can also set a unique size to the video by <strong>Video Width </strong> and <strong>Video Height </strong> options below.
				</li>
				<li><strong>Document</strong>: It will link to the portfolio item page when click the thumbnail of portfolio item.<br/>
				If you choose <strong>Document</strong>, the portfolio will show the content you enter in<strong>Editer</strong>.
				</li>				
				<li><strong>Link</strong>: It will link to anywhere you want when click the thumbnail of portfolio item.<br/>
				When you choose to use link as portfolio, you should order  where the portfolio item linked to. There are four kinds of type you can link to :<strong>Page</strong>, <strong>Categories</strong>, <strong>Post</strong>, or <strong>Link manually</strong>.You should assign the url you want to link to when choosing <strong>Link manually</strong>. Then you should choose the link target in the <strong>Link Target</strong> dropdown.
				</li>
				<li><strong>Lightbox</strong>: It will pop up a lightbox with a website when click the thumbnail of portfolio item.
				If you choose <strong>Lightbox</strong>,  you can specify the full url of the website link in the <strong>Lightbox iframe href</strong>, when you click on the item, it will show the website on the lightbox. You can also input the content that display on the lightbox when the portfolio item type is lightbox in the <strong>Lightbox Content</strong>. You can use shortcode here.
				</li>
			</ul>
		</p>
		<p>
		
		</p>
	</li>
	<li>
	<p>Then fill the title, and add the detail of portfolio to the content editor. You can also add the description to the <strong>Excerpt</strong> textarea for display in the gallery page.
	</p>
	</li>
	<li>
		<p>Once you have done, click <strong>Publish</strong> button.</p>
	</li>
</ol>
</p>

<h4>Set Portfolio Breadcrumbs Parent Page</h4>
<p>
If you want to set portfolio breadcrumbs parent page, you should follow the steps below:
<ol>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_portfolio">Striking->Portfolio</a>. Locate the <strong>Portfolio General</strong> module.</li>
	<li>Choose the page you want to be the parent page of portfolio items on the breadcrumbs in the <strong>Breadcrumbs Parent Page</strong> dropdown. This will used as global configuration.</li>
	<li>when you are edit or create a portfolio, you can set portfolio breadcrumbs parent page either. 
	In the eidt page or add page, Locate the <strong>Portfolio Item Option</strong> module.
	If you can't find it, go to the top of the page, click the <strong>Show on screen</strong> button.Select the matabox to make shure the option  to be showned.</li>
	<li>Choose the page you want to be the parent page of this portfolio item on the breadcrumbs in the <strong>Breadcrumbs Parent Page</strong> dropdown. This will override the global configuration which seted above.</li>
</ol>
</p>


<h2>Add Portfolio Index Page</h2>
<p>Portfolio Index Page: A collection of portfolio items.<br/>
After you add up portfolio items, you'll need a portfolio index page to group them.  Portfolio Index Page: A collection of portfolio items.<br/>
If you want to add a portfolio gallery to your website, follow the steps below:
</p>
<p>
<ol>
	<li>
		<p>Create a new page by going to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/post-new.php.php">Post->Add New</a>. </p>
	</li>
	<li>
		<p>Then change the page template to "Full width".</p>
		
	</li>
	<li>
		<p>Then use <strong>Shortcode Generator</strong> to generate the shortcode for portfolio. You can learn more about <a href="#shortcode">shortcode</a> here.
		
		<p>After configuration, remember click "<strong>Send Shortcode to Editor</strong>" Button.</p>
	</li>
	<li>
		<p>Then <strong>Publish</strong> the page.</p>
	</li>
</ol>
</p>
<h2>Examples of Portfolio</h2>
<h3>Different sets of portfolio items</h3>

 
<h3>To view a individual gallery in a lightbox.</h3>
<p>The default setting of portfolio shortcode will group all the portfolio items in a same lightbox. For gallery type of portfolio item, if we need the lightbox that popupped when click on the thumbnail of portfolio item only show its own gallery images, then we should add 'group="false"' to the portfolio shortcode.</p>
