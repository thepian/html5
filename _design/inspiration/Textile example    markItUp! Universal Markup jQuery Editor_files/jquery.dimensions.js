<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<base href="http://markitup.jaysalvat.com/" />

<title>markItUp! Universal Markup Editor</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="alternate" type="application/rss+xml" title="markItUp! Updates" href="http://feeds.feedburner.com/jaysalvat/markitup" />
<link type="text/css" rel="stylesheet" href="../_css/reset.css" />
<link type="text/css" rel="stylesheet" href="../_css/style.css" />
<!--[if lt IE 7]>
<link type="text/css" rel="stylesheet" href="../_css/style-ie6.css" />
<![endif ]-->
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">_uacct = "UA-111088-7"; urchinTracker();</script>
</head>
<body id="homepage">
<script type="text/javascript" src="../_scripts/jquery.pack.js"></script>
<script type="text/javascript" src="../_scripts/app.js"></script>

<div id="container">
	<div id="superheader">
				<div class="wrapper">
			<h6><a href="http://www.jaysalvat.com">www.jaysalvat.com</a></h6>
		</div>
	</div>
	
	<div id="header">
				<div class="wrapper">
			<div><a href="http://markitup.jaysalvat.com">markItUp!</a></div>
			<p>Universal markUp editor</p>
			<div id="beta">Stable version</div>
		</div>
	</div>                    

  <div id="content">


    <div>
		<h1>404 error! Damn! We are sorry!</h1>
		<h2>The page you were trying to reach does not exist.</h2>
		<h3>Take a look to the links below:</h3>
				
		<div class="info">	
		  <ul>
			<li><strong><a href="../home">Homepage:</a></strong> What is markItUp!?</li>
			<li><strong><a href="../documentations">Documentation:</a></strong> Full documentation</li>
			<li><strong><a href="../examples">Examples:</a></strong> MarkItUp! in action</li>
			<li><strong><a href="../downloads">Downloads:</a></strong> Code, add-ons, sets, parsers and links</li>
		  </ul>
		</div>

		<small><b>markItUp!</b> is a JavaScript plugin built on the jQuery library. It allows you to turn any textarea into a markup editor.  
		Html, Textile, Wiki Syntax, Markdown, BBcode or even your own Markup system can be easily implemented. <b>markItUp!</b> is not meant to be a &ldquo;Full-Features-Out-of-the-Box&rdquo;-editor.  Instead it is a very lightweight, customizable and flexible engine made  to meet the developer's needs in their CMSes, blogs, forums or websites.  <b>markItUp!</b> is not a WYSIWYG editor, and it never will be.<br />
		<img class="banner" src="../_images/intro.png" alt="markItUp!" /></small>


		<p style="font-size:150px; font-weight:bold;">&lt;404/></p>
   	</div>

  </div>
  
  <div id="sidebar">
		<div class="menu">
		<h4>Where to go</h4>
		<ul>
			<li class="homepage"><a title="Homepage" class="" href="../home/">Homepage</a></li>
			<li class="documentation"><a  title="Doc" class="" href="../documentation/">Documentation</a></li>
			<li class="examples"><a title="Examples" class="" href="../examples/">Examples</a></li>
			<li class="downloads"><a title="Downloads" class="" href="../downloads/">Downloads</a></li>
		</ul>
	</div>

		<script type="text/javascript">
	$(function() {
		jQuery.getJSON("http://github.com/api/v1/json/markitup/1.x/commit/master?callback=?", function(data) {
			var date = data.commit.committed_date.replace(/(T(.*))$/g, '');
			$('.github').text('Last commit: '+date);
		}, 'json');
	});
	</script>
	<div class="download">
		<h4>Download  the latest</h4>
		<h5><a href="../downloads/">markItUp! pack 1.1.10</a></h5>
		<small>Feb, 20 2011</small>
		<a class="button" href="..//downloads/download.php?id=releases/latest"><b>markItUp! pack 1.1.10</b><br /> Download now!</a>
		<div id="github">Fork the code on <a href="http://github.com/markitup/1.x">Github</a>.<span class="github"></span></div>
	</div>
    
    		<div class="news">
			<h4>What's new ?</h4>
			<h5><a href="/downloads/">markItUp! 1.1.10 update</a></h5>
			<small>Feb, 20 2011</small>
			<p>markItUp! 1.1.10 is released with <em>ajaxSetup</em> fixes.</p>  
			<h5><a href="/downloads/">markItUp! 1.1.9 update</a></h5>
			<small>Oct, 04 2010</small>
			<p>markItUp! 1.1.9 is released with IE9 fixes (Welcome IE9!).</p>  
			<h5><a href="/downloads/">markItUp! 1.1.8 update</a></h5>
			<small>Apr, 27 2010</small>
			<p>markItUp! 1.1.8 is out! Thanks for your contributions on <a href="http://github.com/markitup/1.x/">Github</a>.</p>  
			<p><a class="feed" href="http://feeds.feedburner.com/jaysalvat/markitup">Rss feed</a></p>
		</div>

    		<div class="download">
			<h4>Buy me a beer!</h4>
			<p>Support the project! Making a donation will motivate me to keep this project going and allow for further development.</p>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<table class="donate">
					<tr>
						<td style="padding:2px"><strong>Amount</strong></td>
						<td style="padding:2px"><input type="text" name="amount" value="5.00" size="6" style="text-align:right;" /></td>
						<td style="padding:2px">
						<select name="currency_code">
						<option value="EUR">&euro;</option>
						<option value="USD">$</option>
						</select>
						</td>
						<td><input type="submit" name="submit" value="Support the project" /></td>
					</tr>
				</table>
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="business" value="jay.salvat@gmail.com" />
				<input type="hidden" name="item_name" value="markItUp" />
				<input type="hidden" name="item_number" value="MARKITUP-DONATE" />
				<input type="hidden" name="no_shipping" value="1" />
				<input type="hidden" name="no_note" value="1" />
				<input type="hidden" name="tax" value="0" />
				<input type="hidden" name="bn" value="PP-DonationsBF" />
				<input type="hidden" name="lc" value="US" />
			</form>
		</div>
  </div>
  
  <div id="footer">
			<div class="wrapper" id="contact">
			<p>&copy; <a href="http://markitup.jaysalvat.com"><strong>markItUp!</strong></a> and <a href="http://www.jaysalvat.com">Jay Salvat</a></p>
			<ul>
				<li><a href="../home/">Homepage</a></li>
				<li><a href="../documentation/">Documentation</a></li>
				<li><a href="../examples/">Examples</a></li>
				<li><a href="../downloads/">Downloads</a></li>
				<li><a href="#jay.salvat|gmail.com" class="mailto">Contact me!</a></li>
			</ul> 

			<div id="contactWarning">
				<h5>Important note:</h5>
				<p>Feel free to contact me for feedbacks, bug reports and suggestions!</p>
				<p>But sorry, due to a huge lack of time, <b>help and answers to technical questions will be provided to <em>donators only</em></b>. Thanks!</p>

				<ul>
					<li><a class="ok" href="#">I understand!</a></li>
					<li><a class="close" href="#">Close</a></li>
				</ul>
			</div>
		</div>
  </div>
</div>
</body>
</html>
