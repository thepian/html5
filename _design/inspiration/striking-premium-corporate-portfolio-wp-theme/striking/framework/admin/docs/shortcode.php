<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>
<h2>Shortcode Generator</h2>

<p><strong>Striking</strong> comes with over 60 custom shortcodes that allow you to add custom styles to your post or page content.</p>
<p>You can easily use Shortcodes by Shortcode Generator.</p>
<p>Simply select the style you would like to use then click <strong>Send Shortcode to Editor</strong> to insert the shortcode into the WYSIWYG editor. </p>


<h2>Shortcode Item</h2>

<h3>Columns & Layout</h3>
<p>You can simply use layout shortcode to create multiple columns. Or you can use column shortcodes to create colums respectively.</p>
<h4>Example</h4>
<div class="one_half">
	<pre><code>[one_half]The content you want display[/one_half]</pre></code>
</div>
<div class="one_half last">
	<pre><code>[one_half_last]The content you want display[/one_half_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_third">
<pre><code>[one_third]The content you want display[/one_third]</pre></code>
</div>
<div class="one_third">
<pre><code>[one_third]The content you want display[/one_third]</pre></code>
</div>
<div class="one_third last">
<pre><code>[one_third_last]The content you want display[/one_third_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_third">
<pre><code>[one_third]The content you want display[/one_third]</pre></code>
</div>
<div class="two_third last">
<pre><code>[two_third_last]The content you want display[two_third_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_fourth">
<pre><code>[one_fourth]The content you want display[/one_fourth]</pre></code>
</div>
<div class="one_fourth">
<pre><code>[one_fourth]The content you want display[/one_fourth]</pre></code>
</div>
<div class="one_fourth">
<pre><code>[one_fourth]The content you want display[/one_fourth]</pre></code>
</div>
<div class="one_fourth last">
<pre><code>[one_fourth_last]The content you want display[/one_fourth_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_fourth">
<pre><code>[one_fourth]The content you want display[/one_fourth]</pre></code>
</div>
<div class="three_fourth last">
<pre><code>[three_fourth_last]The content you want display[/three_fourth_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_fifth">
<pre><code>[one_fifth]The content you want display[/one_fifth]</pre></code>
</div>
<div class="one_fifth">
<pre><code>[one_fifth]The content you want display[/one_fifth]</pre></code>
</div>
<div class="one_fifth">
<pre><code>[one_fifth]The content you want display[/one_fifth]</pre></code>
</div>
<div class="one_fifth">
<pre><code>[one_fifth]The content you want display[/one_fifth]</pre></code>
</div>
<div class="one_fifth last">
<pre><code>[one_fifth_last]The content you want display[/one_fifth_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_fifth">
<pre><code>[one_fifth]The content you want display[/one_fifth]</pre></code>
</div>
<div class="four_fifth last">
<pre><code>[four_fifth_last]The content you want display[/four_fifth_last]</pre></code>
</div>
<div class="clear"></div>
<div class="two_fifth">
<pre><code>[two_fifth]The content you want display[/two_fifth]</pre></code>
</div>
<div class="three_fifth last">
<pre><code>[three_fifth_last]The content you want display[/three_fifth_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_sixth">
<pre><code>[one_sixth]The content you want display[/one_sixth]</pre></code>
</div>
<div class="one_sixth">
<pre><code>[one_sixth]The content you want display[/one_sixth]</pre></code>
</div>
<div class="one_sixth">
<pre><code>[one_sixth]The content you want display[/one_sixth]</pre></code>
</div>
<div class="one_sixth">
<pre><code>[one_sixth]The content you want display[/one_sixth]</pre></code>
</div>
<div class="one_sixth">
<pre><code>[one_sixth]The content you want display[/one_sixth]</pre></code>
</div>
<div class="one_sixth last">
<pre><code>[one_sixth_last]The content you want display[/one_sixth_last]</pre></code>
</div>
<div class="clear"></div>
<div class="one_sixth">
<pre><code>[one_sixth]The content you want display[/one_sixth]</pre></code>
</div>
<div class="five_sixth last">
<pre><code>[five_sixth_last]The content you want display[/five_sixth_last]</pre></code>
</div>
<div class="clear"></div>


<h3>Typography</h3>
<p>Striking contain some typography shortcodes to use.</p>

<h4>Example</h4>
<h5>dropcap</h5>
<p><strong>Notice</strong> that you can't use 2 dropcap in same line.</p>
<pre><code >[dropcap1]Y[/dropcap1]ou paragraph.
[dropcap2]Y[/dropcap2]ou paragraph.
[dropcap3]Y[/dropcap3]ou paragraph.
[dropcap4]Y[/dropcap4]ou paragraph.</code></pre>

<h5>blockquote</h5>
<pre><code >[blockquote align="left"]
the blockquote you want align left
[/blockquote]

[blockquote align="right"]
the blockquote you want align right
[/blockquote]

[blockquote cite="user"]
the blockquote text with user name
[/blockquote]</code></pre>
<h5>Pre & code</h5>
<pre><code >[pre]
.highlight {
background: #FFFF99;
}
[/pre]</code></pre>

<h5>styled list</h5>
<pre><code>[list style="list1" color="gray"]
&lt;ul&gt;
	&lt;li&gt;your list item&lt;/li&gt;
	&lt;li&gt;your list item&lt;/li&gt;
	&lt;li&gt;your list item&lt;/li&gt;
&lt;/ul&gt;
[/list]</code></pre>
<h5>icon text & link</h5>
<pre><code >[icon style="user" color="gray"]user[/icon]</code></pre>
<h5>Highlight</h5>
<pre><code >[highlight]your text with yellow highlight[/highlight]

[highlight type="dark"]your text with dark highlight[/highlight]</code></pre>

<h3>Buttons</h3>

<h4>Parameters</h4>
<ul>
<li><strong>id</strong> (id attribute) (optional)</li>
<li><strong>size</strong>: small,medium,large (optional)</li>
<li><strong>class</strong>  (class attribute) (optional)</li>
<li><strong>color</strong> (optional)</li>
<li><strong>bgColor</strong> (optional)</li>
<li><strong>textColor</strong> (optional)</li>
<li><strong>align</strong>:center (optional)</li>
<li><strong>full</strong> (set full width):true,false (optional)</li>
<li><strong>link</strong> (link to follow when clicked) (optional)</li>
</ul>

<h4>Samples</h4>
<h5>Buttons With Different Size</h5>
<pre><code>[button size="small"]Small[/button]
[button size="medium"]Medium[/button]
[button size="large"]Large[/button]
</code></pre>

<h5>Buttons With Color Scheme</h5>
<pre><code>[button size="medium" color="black"]Black[/button]
</code></pre>


<h5>Buttons With Special Color</h5>
<pre><code>[button bgColor="#769600"]#769600[/button]
[button color="white" textColor="#769600"]#769600[/button]
</code></pre>



<h5>Buttons With Roll Over Color</h5>
<pre><code>[button size="large" bgColor="#004f78" hoverBgColor="#930097"]Roll Over Button[/button]
</code></pre>



<h3>Styled Boxes</h3>
<h4>Example</h4>
<h5>Framed Box</h5>
<pre><code>[framed_box]your content[/framed_box]</code></pre>
<h5>Message Box</h5>
<pre><code>[info]your info message[/info]

[success]your success message[/success]

[error]your error message title[/error]
[error_msg]
&lt;ol&gt;
	&lt;li&gt;message1&lt;/li&gt;
	&lt;li&gt;message2&lt;/li&gt;
&lt;/ol&gt;
[/error_msg]

[notice]your notice message[/notice]</code></pre>
<h5>Note Box</h5>
<pre><code >[note title="Note:"]
This is a paragraph in note box.
[/note]

[note title="Note:" align="right" width="250"]
This is a paragraph in note box.
[/note]</code></pre>

<h3>Tables</h3>
<h4>Example</h4>
<pre><code class>[styled_table]
&lt;table&gt;
	&lt;thead&gt;
		&lt;tr&gt;
			&lt;th scope="col"&gt;<strong>Company</strong>&lt;/th&gt;
			&lt;th scope="col"&gt;Header 1&lt;/th&gt;
			&lt;th scope="col"&gt;Header 2&lt;/th&gt;
			&lt;th scope="col"&gt;Header 3&lt;/th&gt;
			&lt;th scope="col"&gt;Header 4&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/thead&gt;
	&lt;tfoot&gt;
		&lt;tr&gt;
			&lt;td colspan="5"&gt;<em>The foot text for this table</em>&lt;/td&gt;
		&lt;/tr&gt;
	&lt;/tfoot&gt;
	&lt;tr>
		&lt;td&gt;Company 1&lt;/td&gt;
		&lt;td&gt;Division&lt;/td&gt;
		&lt;td&gt;Division&lt;/td&gt;
		&lt;td&gt;Division&lt;/td&gt;
		&lt;td&gt;Division&lt;/td&gt;
	&lt;/tr&gt;
&lt;/table&gt;
[/styled_table]</code></pre>


<h3>Tab</h3>
<h4>Example</h4>
<h5>Framed tab</h5>
<pre><code>[tabs]
	[tab title="title 1"]
		contents
	[/tab]
	[tab title="title 2"]
		contents
	[/tab]
[/tabs]</code></pre>
<h5>Mini tab</h5><pre><code>[mini_tabs]
	[tab title="title 1"]
		contents
	[/tab]
	[tab title="title 2"]
		contents
	[/tab]
[/mini_tabs]</code></pre>


<h3>Accordion</h3>
<h4>Example</h4>
<pre><code>[accordions]
	[accordion title="title 1"]
		contents
	[/accordion]
	[accordion title="title 2"]
		contents
	[/accordion]
[/accordions]</code></pre>

<h3>Toggle</h3>
<p>You can use shortcode to create toggle by define the title and content of it. </p>
<h4>Example</h4>
<pre><code>[toggle title="title"]
	contents
[/toggle]</code></pre></p>

<h3>divider</h3>
<p>You can use shortcode to add divider line to editer.</p>
<pre><code>[divider_top]

[divider_line]
	
[divider_padding]
	
[divider]
	
[clearboth]
</code></pre>


<h3>Image</h3>
<p>You can add image to the page whith shortcode.you can add just only add it or add it with lightbox or piture frame.
<h4>Parameters</h4>
<ul>
<li><strong>size</strong>: small,medium,large (optional)</li>
<li><strong>link</strong> (optional)</li>
<li><strong>icon</strong>: zoom,play,doc (optional)</li>
<li><strong>lightbox</strong>: true,false (optional)</li>
<li><strong>title</strong> (optional)</li>
<li><strong>align</strong>: left,right,center (optional)</li>
<li><strong>group</strong> (group for lightbox) (optional)</li>
<li><strong>width</strong> (optional)</li>
<li><strong>height</strong> (optional)</li>
</ul>
</p>
<h4>Example</h4>

<h5>Image With Different Size</h5>
<pre><code>[image size="small"]your image src[/image]
[image size="medium"]your image src[/image]
[image size="large"]your image src[/image]</code></pre>

<h5>Image With Different Icon</h5>
<pre><code>[image icon="zoom"]
	your image src
[/image]
[image icon="doc"]
	your image src
[/image]
[image icon="play"]
	your image src
[/image]
[image icon="link"]
	your image src
[/image]</code></pre>

<h5>Image With Lightbox Support</h5>
<pre><code>[image icon="zoom" lightbox="true" title="Your Image Title"]your image src[/image]</code></pre>

<h5>Image With Video</h5>
<pre><code>[image title="Your Video Title" icon="play" lightbox="true" link="http://vimeo.com/15068747"]your image src[/image]</code></pre>

<h5>Picture Frame</h5>
<pre><code>[picture_frame title="your picture title"]your picture src[/picture_frame]</code></pre>


<h3>Iframe</h3>
<h4>Example</h4>
<pre><code>[iframe src="http://google.com" width="100%" height="500px"]</code></pre>

<h3>Google map</h3>
<p>You can use shortcode to add goole map. This is some setting you should define:
	<ul class="list1">
	<li><strong>width</strong></li>
	<li><strong>height</strong></li>
	<li><strong>address:</strong> Address on which the viewport will be centered.</li>
	<li><strong>latitude:</strong> Point on which the viewport will be centered. If not given and no markers are defined the viewport defaults to world view.</li>
	<li><strong>longitude:</strong> Same as above but for longitude...</li>
	<li><strong>zoom:</strong> Zoom value from 1 to 19 where 19 is the greatest and 1 the smallest.</li>
	<li><strong>html:</strong> Content that will be shown within the info window for this marker.</li>
	<li><strong>popup:</strong> If true the info window for this marker will be shown when the map finished loading. If "html" is empty this option will be ignored.</li>
	<li><strong>controls:</strong> A simple array of string values representing the function names (without "()") to add controls. Please refer to the <a href="http://code.google.com/intl/en-US/apis/maps/documentation/javascript/v2/reference.html#GControlImpl">Google Maps API</a> for possible values. If empty the default map controls will be applied.</li>
	<li><strong>scrollwheel:</strong> Set to false to disable zooming with your mouses scrollwheel. If "controls" is not set this option will be ignored (because default map controls are applied).</li>
	<li><strong>maptype:</strong> Predefined variable for setting the map type. Please refer to the<br>
	<a href="http://code.google.com/intl/en-US/apis/maps/documentation/javascript/v2/introduction.html#MapTypes">Google Maps API</a> for possible values.</li>
	<li><strong>marker:</strong> Set to false to disable display a marker in the viewport.</li>
	</ul>
</p>
<h4>Example</h4>
<h5>Simple map with marker</h5>
Displays a simple map with controls and adds one marker. The viewport gets centered automatically.
<pre><code>[gmap latitude="47.660937" longitude="9.569803"]</code></pre>
<h5>Different map type</h5>
Changes the map type to physical view.
<pre><code>[gmap maptype="G_PHYSICAL_MAP" marker="false"]</code></pre>
<h5>Map without controls</h5>
<pre><code>[gmap controls="false" scrollwheel="false" marker="false"]</code></pre>
<h5>Map with marker and info window</h5>
<pre><code>[gmap latitude="47.660937" longitude="9.569803" 
html="Tettnang, Germany" popup="true" zoom="10"]</code></pre>
<h5>Map with address</h5>
<pre><code>[gmap address="Tettnang, Germany" html="Tettnang, Germany" zoom="10"]</code></pre>


<h3>Widgets</h3>
<p>There are six kind of widgets you can create by shortcode generator.
	<ul>
		<li><strong>Contact Form</strong>:<p>Enter in the email address where you would like the contact form submission to be sent. And fill out the <strong>Success Text</strong>'s textarea for the text rendering after submission.</p>
		<p>Note: After set-up, you should send a test message to yourself to see if things are working. The <strong>Contact Form</strong> use <a href="http://codex.wordpress.org/Function_Reference/wp_mail" target="_blank">wp_mail</a> function to send mails. If it doesn't work, please check with your host to make sure SMTP and smtp_port have been set in php.ini. Or you can install a Plugin for Wordpress to enable SMTP configuration. For example, <a target="_blank" href="http://wordpress.org/extend/plugins/configure-smtp/">Configure SMTP</a> is worked well for me.</p>		
		</li>
		<li><strong>Twitter</strong></li>
		<li><strong>Flickr</strong></li>
		<li><strong>Contact Info</strong></li>
		<li><strong>Popular Posts</strong></li>
		<li><strong>Recent Posts</strong></li>
	</ul>
</p>
<h4>Example</h4>

<h5>Contact Form</h5><pre><code>[contactform email="admin@example.com"]Thank you![/contactform]</code></pre>
<h5>Twitter</h5><pre><code>[twitter username="smashingmag" count="4"]</code></pre>
<h5>Flickr</h5><pre><code>[flickr id="Your Flickr Id" count="4" display="random"]</code></pre>
<h5>Contact Info</h5><pre><code>[contact_info phone="(+40) 111 222 333" email="admin@example.com" address="the Street , # 9" city="city" state="state" zip="10000" name="yourname"]</code></pre>
<h5>Popular Posts</h5><pre><code>[one_half]
[popular_posts count="4" thumbnail="true" extra="desc" desc_length="80"]
[/one_half]

[one_half_last]
[popular_posts count="6" thumbnail="false" extra="time"]
[/one_half_last]</code></pre>
<h5>Recent Posts</h5><pre><code>[one_half]
[recent_posts count="4" thumbnail="true" extra="desc" desc_length="80"]
[/one_half]

[one_half_last]
[recent_posts count="6" thumbnail="false" extra="time"]
[/one_half_last]</code></pre>
</p>

<h3>Video</h3>
<h4>Example</h4>

<h5>Html5 Video</h5>
<pre><code>[video type="html5" preload="true"
poster="http://video-js.zencoder.com/oceans-clip.png" 
mp4="http://video-js.zencoder.com/oceans-clip.mp4" 
webm="http://video-js.zencoder.com/oceans-clip.webm" 
ogg="http://video-js.zencoder.com/oceans-clip.ogv"]</code></pre>
<h5>flash</h5>
<pre><code>[video type="flash" src="http://www.youtube.com/v/sdUUx5FdySs" play="false"]</code></pre>
<h5>youtube</h5>
<pre><code>[video type="youtube" clip_id="cL-ejzlRSsE"]</code></pre>
<h5>vimeo</h5>
<pre><code>[video type="vimeo" clip_id="15068747"]</code></pre>
<h5>dailymotion</h5>
<pre><code>[video type="dailymotion" clip_id="xf3fk2"]</code></pre>


<h3>Lightbox</h3>
<h4>Parameters</h4>
<ul>
<li><strong>href</strong></li>
<li><strong>title</strong></li>
<li><strong>group</strong> (group for a gallery)</li>
<li><strong>width</strong>: (optional)</li>
<li><strong>height</strong> (optional)</li>
<li><strong>iframe</strong>: true,false</li>
<li><strong>photo</strong> (forces Lightbox to display a link as a photo)</li>
</ul>

<h4>Example</h4>

<h5>Lightbox for text</h5>
<pre><code>[lightbox  title="Title" href="http://kaptinlin.com/themes/striking/files/2010/09/hamed_389212454.jpg"]Single Image[/lightbox]
[lightbox group="portfolio" href="http://kaptinlin.com/themes/striking/files/2010/09/visualpanic_2365154805.jpg"]Grouped Photo 1[/lightbox]
[lightbox group="portfolio" href="http://kaptinlin.com/themes/striking/files/2010/09/ajari_3742651903.jpg"]Grouped Photo 2[/lightbox]
[lightbox group="portfolio" href="http://kaptinlin.com/themes/striking/files/2010/09/visualpanic_2243122277.jpg"]Grouped Photo 3[/lightbox]</code></pre>


<h5>Lightbox for Elements</h5>
<pre><code>[lightbox title="Trigger by image" href="http://kaptinlin.com/themes/striking/files/2010/09/visualpanic_3652931425.jpg"]&lt;img src="http://kaptinlin.com/themes/striking/files/2010/10/magic_wand.png" alt=""/&gt;[/lightbox]

[lightbox title="Trigger by button" href="http://kaptinlin.com/themes/striking/files/2010/09/visualpanic_4592108613.jpg"][button size="medium" bgColor="#0062c3"]Lightbox[/button][/lightbox]</code></pre>


<h5>Lightbox with iframe</h5>
<pre><code>[lightbox title="Google" href="http://google.com" iframe="true"]Outside Webpage (Iframe)[/lightbox]</code></pre>

<h5>Lightbox with video</h5>
<pre><code>[lightbox title="Lightbox with video" href="#vimeo_lightbox" inline="true" width="630" height="355"]Lightbox with video[/lightbox]
&lt;div&gt;    
	&lt;div&gt;
		[video type="vimeo" clip_id="15103655" width="630" height="355"]
	&lt;/div&gt;
&lt;/div&gt;</code></pre>

<h3>Goole Chat</h3>
<h4>Example</h4>
<h5>3d-pie chat</h5><pre><code>[chart
data="70,25,20.01,4.99"
labels="Reffering+sites|Google|Yahoo|Other"
colors="058DC7,50B432,ED561B,EDEF00"
bg="bg,s,ffffff"
size="630x250"
title="3D Pie Chart Title"
type="pie"]</code></pre>
<h5>line chat</h5><pre><code>[chart
data="70,25,20.01,4.99"
labels="2010|2011|2012|2013"
colors="058DC7,50B432,ED561B,EDEF00"
bg="bg,s,ffffff"
size="630x250"
title="Line Chart Title"
type="line"]

[chart 
data="0,25,50,75,100|2,33,43,17,25|0,25,50,75,100|0,20,25,40,75"
labels="Begin|25|50|75|End"
colors="058DC7,50B432"
bg="bg,s,ffffff"
size="630x250"
title="Line Chart Title 2"
type="xyline"]</code></pre>
<h5>scatter chat</h5><pre><code>[chart
data="0,10,20,30,40,50,60,70,80,90,100|50,52,56,63,70,80,92,85,75,60,43"
labels="1|2|3|4|5|6|7|8|9|10"
colors="058DC7"
bg="bg,s,ffffff"
size="630x250"
title="Scatter Chart Title"
type="scatter"]</code></pre>
<h5>2d-pie chat</h5><pre><code>[chart
data="70,25,20.01,4.99"
labels="Reffering+sites|Google|Yahoo|Other"
colors="058DC7,50B432,ED561B,EDEF00"
bg="bg,s,ffffff"
size="630x250"
title="Pie Chart Title"
type="pie2d"]</code></pre>
<h5>gom chat</h5><pre><code>[chart
data="40"
labels="Forty"
colors="058DC7,50B432,ED561B,EDEF00"
bg="bg,s,F7F9FA"
size="630x250"
title="Gom Chart Title"
type="gom"]</code></pre>
<h5>venn chat</h5><pre><code>[chart 
data="100,80,60,30,30,30,10" 
colors="FF6342,ADDE63,63C6DE"
bg="bg,s,F7F9FA" 
size="630x250" 
title="Venn Chart Title" 
advanced="&chdl=A|B|C"
type="venn"]</code></pre>



<h3>Blog</h3>
<h4>Parameters</h4>
<ul>
<li><strong>count</strong> (number of posts to show per page)</li>
<li><strong>category</strong> (specific category to show) (optional)</li>
<li><strong>posts</strong>  (specific posts to show) (optional)</li>
<li><strong>image</strong> (whether to display featured image): true,false</li>
<li><strong>meta</strong> (whether to display meta information): true,false</li>
<li><strong>full </strong> (whether to display all content of the post): true,false</li>
<li><strong>nopaging</strong> (whether to disable pagination): true,false</li>
</ul>
<h4>Example</h4>
<h5>Blog with Image & Meta & Paging</h5>
<pre><code>[blog count="3" nopaging="false"]</code></pre>
<h5>Blog with Image</h5>
<pre><code>[blog count="1" meta="false"]</code></pre>
<h5>Blog with Meta</h5>
<pre><code>[blog count="1" image="false"]</code></pre>
<h5>Blog without Image & Meta</h5>
<pre><code>[blog count="1" image="false" meta="false"]</code></pre>
<h5>Blog with Specific Category</h5>
<pre><code>[blog count="1" cat="4,5" image="false"]</code></pre>
<h5>Blog with Specific Post</h5>
<pre><code>[blog count="1" posts="1" image="false"]</code></pre>


<h3>Site Map</h3>

<h4>Example</h4>
<h5>All Pages</h5><pre><code>[sitemap type="pages" number="0"]</code></pre>
<h5>Pages With Number</h5><pre><code>[sitemap type="pages" number="10"]</code></pre>
<h5>Pages With Depth</h5><pre><code>[sitemap type="pages" depth="1"]</code></pre>
<h5>Category Without Feed</h5><pre><code>[sitemap type="categories" show_feed="false"]</code></pre>
<h5>Category Without Count</h5><pre><code>[sitemap type="categories" show_count="false"]</code></pre>
<h5>Posts With Number</h5><pre><code>[sitemap type="posts" number="3"]</code></pre>
<h5>Posts Without Comment</h5><pre><code>[sitemap type="posts" show_comment="false"]</code></pre>
<h5>Posts With Specific Posts</h5><pre><code>[sitemap type="posts" posts="98,1,224" cat="6"]</code></pre>
<h5>Posts  With Specific Category</h5><pre><code>[sitemap type="posts" cat="6"]</code></pre>
<h5>Portfolios  With Specific Category</h5><pre><code>[sitemap type="portfolios" cat="document"]</code></pre>
<h5>Portfolios  With Specific Comment</h5><pre><code>[sitemap type="portfolios" show_comment="true"]</code></pre>
