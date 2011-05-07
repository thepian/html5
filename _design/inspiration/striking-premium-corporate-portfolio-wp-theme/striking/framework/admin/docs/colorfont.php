<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>
<h2>Color</h2>
<p>In <strong>Strinking</strong>, and edit the coler of each part of the page in the <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_color">Strinking->Color</a> page. Including: </p>
<ul>
	<li><strong>General Setting</strong></li>
	<li><strong>Header Setting</strong></li>
	<li><strong>Feature Setting</strong></li>
	<li><strong>Page Setting</strong></li>
	<li><strong>Footer Setting</strong></li>
</ul>
<p>You can choose the coloer you want in the options, then click <strong>Save Changes</strong> Button. </p>

<h2>Font</h2>
<p>Yhere are two kinds of font setting you can choose, one is cufon, another is fontface.</p>
<h3>Font General</h3>
<p>You can go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_font">Strinking->Font</a>, 
you can set the <strong>Font family</strong>, <strong>Line height</strong>, <strong>Link Hover Underline</strong>; and each size of the part of page.
</p>

<h3>Cofun</h3>
<h4>Use Cofun</h4>
<p><strong>Striking</strong> support "Cofun" font replacing script on your website. Click <a href="http://github.com/sorccu/cufon/wiki/About" target="_blank">here</a> to see more information about this script and what it does.</p>
<p>And <strong>Striking</strong> contains some creative fonts which had converted for cufon use under '<strong>/wp-content/themes/striking/fonts</strong>' folder. The page will list these fonts on the screen. </p>
<p>If you want to use the "Cofun" font, go to <a href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=theme_cufon">Strinking->Cofun</a>, Turn on the <strong>Enable Cufon</strong> toggle.</p>
<p>You can choose one font you prefer, turn on it's toggle button and turn off the other's. After "<strong>Save Changes</strong>", you will see the replacing effect.</p>
<p>If you want to replace the elements what you prefer or use more than one fonts, you should fill cufon replace scripts into "<strong>Cufon code</strong>" option textarea, and turn on the toggle button of fonts you used in the scripts. Learn more about cufon's usage <a href="http://github.com/sorccu/cufon/wiki/Usage" target="_blank">here</a>.</p>
<p>The following is the list of elements which you can replace with. </p>
<ul>
	<li>#site_name, #site_description</li>
	<li>#navigation a</li>
	<li>.kwick_title, .kwick_detail h3</li>
	<li>#feature h1, #introduce</li>
	<li>#introduce .entry_meta</li>
	<li>h1, h2, h3, h4, h5, h6</li>
	<li>.entry h1</li>
	<li>.portfolio_title</li>
	<li>blockquote, .dropcap1, .dropcap2, .dropcap3, .dropcap4</li>
	<li>#sidebar .widgettitle</li>
	<li>#footer .widgettitle</li>
	<li>#copyright</li>
	<li>#footer_menu a</li>
</ul>
<h4>Cufon Generate</h4>
<p>If you want use your own font with cufon replacement, please follow the steps below:</p>
<ol>
	<li>Go to <a href="http://cufon.shoqolate.com/generate/" target="_blank">http://cufon.shoqolate.com/generate</a></li>
	<li class="center"><img alt="Cufon Generate" src="assets/images/cufon_generate.png"></li>
	<li>upload the generated .font.js file to '/wp-content/themes/striking/fonts' folder through your FTP Client.</li>
	
	<li>Refresh the <span class="panel_title">Striking</span> -&gt; <span class="panel_title">Font</span> Options page, you will see the font on it. </li>
</ol>

<h3>Fontface</h3>
<h4>About Fontface</h4>
<P>@font-face is a CSS rule which allows you to show a font on a Web page even if that font is not installed on the users' computer. </p>
<p>This means that designers and developers can begin moving away from Web-safe fonts that users have pre-installed on their computer such as Arial, Times New Roman, Verdana and Trebuchet.</p>
<p>Current design trends demand that titles, logos and headings use non Web-safe fonts. This means that to use fonts which are not installed on the users computer we must use methods such as hiding the title, and replacing it with a background image of that title in the special font. 
Using @font-face means we can "do away" with hiding titles and using numerous time-consuming images per title and instead have a single font file on the server. 
Saving time and bandwidth. </p>
<p>Internet Explorer supports @font-face, and has done for <em>years</em>. Firefox 3.5 recently supported it and was the last of the major browsers to support it.</p>
<p>According to the latest statistics from NetMarketShare we can achieve a minimum of 92% support.</p>
<p>More info from: <a href="http://webfonts.info/wiki/index.php?title=%40font-face_browser_support">http://webfonts.info/wiki/index.php?title=%40font-face_browser_support</a> and <a href="http://marketshare.hitslink.com/browser-market-share.aspx?qprid=2">http://marketshare.hitslink.com/browser-market-share.aspx?qprid=2</a></p>
<p>This is a more than safe level of browser support in my opinion when you consider most if not <em>all</em> of Internet Explorer users are included, and most, if not all modern Web browsers. A lot of the remaining 8% may also be mobile users. the iPhone supports it, as will the iPad.</p>

<h4>To Use Fontface</h4>
<p>When you want to use fontface, you should follow the step below:</p>
<ol>
	<li>Go to <a href="<?php echo get_option('siteurl'); ?>/admin.php?page=theme_cufon">Strinking->Fontface</a>. </li>
	<li>Turn on the <strong>Enable Cufon</strong> toggle.</li>
	<li>You can choose one font you prefer, turn on it's toggle  and turn off the other's. After "<strong>Save Changes</strong>".</li>
	<li><p>If you want to use various fonts, you can turn on their toggle. Then your should order where to use them by the code filled into  "<strong>@font-face Custom CSS</strong>" option textarea.<br/>
	For example, If you you want the font to appear in the H1 and H2, you can add the code below:</p>
	
	<pre><code>h1,h2 {
	font-family: DeliciousRoman, Helvetica, Arial, sans-serif; 
}</code></pre>
	</li>
	<li>Click <strong>Save Changes</strong> button. </li>
</ol>
<h4>Add Fontface Font</h4>

<ol>
	<li>Go to: <a href="http://www.fontsquirrel.com/">http://www.fontsquirrel.com/</a> and choose a font</li>
	<li>Download the @font-face kit <a href="http://www.fontsquirrel.com/fontface">http://www.fontsquirrel.com/fontface</a> or generate a kit <a href="http://www.fontsquirrel.com/fontface/generator">http://www.fontsquirrel.com/fontface/generator</a> (preferred)</li>
	<li>Add the unzip the download file to <code>wp-content\themes\striking\fontfaces</code> folder, then you may find it in <a href="<?php echo get_option('siteurl'); ?>/admin.php?page=theme_cufon">Strinking->Fontface</a>.</li>
</ol>



