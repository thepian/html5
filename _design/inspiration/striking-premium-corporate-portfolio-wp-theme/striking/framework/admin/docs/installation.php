<?php if (!defined('THEME_NAME')) exit('No direct script access allowed'); ?>

<h2>Installation of Striking</h2>
<h3>1.  Downloading from Themeforest</h3>

<p align="justify">Download the Striking theme and unzip this download.  Any good quality zip program will do.  &nbsp;Just follow the unzip instructions of your program carefully. &nbsp;Some give you the option of unzipping only a portion, or all, of the files. &nbsp;You want to select "all". &nbsp;Once unzipped, you will find the following folders will be in the unzipped directory:</p>
		<ul>
			<li><strong>striking.zip </strong>&nbsp;- a separate zip of the theme files that you need upload to your wordpress installation.</li>
			<li><strong>resource\psds</strong>&nbsp;- all layered psd sources.</li>
			<li><strong>resource\fonts</strong>&nbsp;- fonts original copy that embedding for cufon use.</li>
			<li><strong>resource\src</strong>&nbsp;- source file use in the theme.</li>
			<li><strong>licensing</strong>&nbsp;- license for the theme.</li>
			<li><strong>documentation</strong>&nbsp;- documentation files for current package.</li>
			<li><strong>demo</strong>&nbsp;- you can import demo site xml data to learn striking fast.</li>
		</ul>
<br />
<img src="<?php echo THEME_ADMIN_ASSETS_URI;?>/document/strikingzipcontentsjpg.jpg" width="593" height="281" alt="zip-contents" />
<h3>2.  Installing on your Host</h3>
<p>Before you install the theme, make sure your installed wordpress version is 3.1 or higher. &nbsp;You also need to have PHP 5 or higher versions in order for Striking to function correctly.</p><br />
<h4> Method 1 - Upload via Wordpress built in Theme Install function</h4>
<p align="justify">Log into your existing wordpress installation - if you just recently installed wordpress on your site, you most likely will have the default "Twenty Ten" theme supplied in all wordpress default installs as the active theme:</p>
<ul>
<li>In the wordpress left hand menu, go to the <em>Appearance</em> menu and select <em>Themes</em>.</li>
<br />
<li>On the <em>Themes</em> page you will see 2 tabs - <em>Manage Themes</em> and <em>Install Themes</em>. &nbsp;Select the <em>Install Themes</em> tab.</li><br />
<li> You will then see immediately below the tabs a navigation menu and one option will be <em>Upload</em>. &nbsp;Click <em>Upload</em> and you will see the ability to browse your computer drive and an instruction  "Install a theme in .zip format" (see picture below).</li>
<br />
<li>Browse your hard drive to where you stored the <b>striking.zip</b> that was part of your master download from Themeforest.  </li>
<br />
<li>Double click on the <b>striking.zip</b> so that it is selected and then click on the <em>Install Now</em> button, and wordpress will automatically install Striking.</li>	
</ul><br />
<br />
<img src="<?php echo THEME_ADMIN_ASSETS_URI;?>/document/WPThemeinstaller.jpg" width="524" height="217" /> <br /><br /><br />
<h4>Method 2 - Upload via FTP</h4>
<p align="justify">You need an ftp program such as Filezilla (free) or CuteFTP Home or CuteFTP Pro (free for 30 days then cost money) both found at <a href="http://www.download.com">www.download.com</a>  &nbsp;CuteFTP Pro has many online editing functions that heavy ftp users and developers often find useful.</p>
<p align="justify"> You will need to first uncompress the striking.zip file you have found in the master zip downloaded from Themeforest. &nbsp;This zip uncompresses into a normal folder <b>striking</b>. &nbsp;This is the only folder you need to transfer via ftp and if you open it, you will see all sorts of folders and files which contain the Striking coding (see picture below). &nbsp;</p><br />
<p align="justify"><img src="<?php echo THEME_ADMIN_ASSETS_URI;?>/document/strikingzip.jpg" width="796" height="937" /></p>
<p align="justify">&nbsp;</p>
<p align="justify">You transfer this folder which contains the above files to the WordPress installation root directory:<br />
  <br />
 /wp-content/themes/ <br /><br />
 by way of your FTP program. &nbsp;Do not upload any of the other folders such such as <b>licensing</b> or <b>resource</b> or <b>documentation</b>. Uploading any of the other folders may cause problems resulting in your Striking theme  working properly.</p>
<br />
<h3>3. Activate Striking as Default Theme</h3>
<p align="justify">After you have completed the upload, activate the theme as you would activate any other theme.  &nbsp;Normally when you get the message the install is complete, you are given a prompt for the option to activate the theme. &nbsp;So go ahead and activate Striking and you are done your installation!</p>
<br />
<h3>4. The Striking Theme Panels</h3>
<p align="justify">Once you have activated Striking, you will see the new <em>Striking</em> panels added below the Wordpress <em>Settings</em> Panels. &nbsp;Expand the Striking panel menu if it is minimized and you will see 16 different supanels (as of Striking Ver 3.0). &nbsp;Now you are ready to start your website development using STRIKING!!</p><br />

<img src="<?php echo THEME_ADMIN_ASSETS_URI;?>/document/StrikingPanels.jpg" width="479" height="484" />
<br /><br /><br />
<h3>5. Problems Installing?</h3>
<p align="justify">On rare occassions Striking does not install properly and you get an error message while attempting the install, or during or after activation of the theme. &nbsp;See the section below on "Installation Errors &amp;Theme Functions Not Working" for some trouble shooting tips.</p>
<br />	
<h2>Installation of the Demo Content Package</h2>
<p align="justify">As a bonus I supply you with a complete demo package. &nbsp;It can assist you in learning striking fast. &nbsp;Below are the steps to installing the demo content:
<ol>
	<li>Locate the <strong>demo_export.xml</strong> file and <strong>options.txt</strong> file in the <strong>demo</strong> folder of the zip package.</li>
	<li>Go to Tool->Import module in your backend, click the <strong>WordPress</strong> option.</li>
	<li>Then add the <strong>demo_export.xml</strong> file to the <strong>Choose a file from your computer</strong> option and click the <strong>upload the file and import</strong> button.</li>
	<li>Go to Striking->Advance in your backend, locate the <strong>Import & Export</strong> module, copy all the code in <strong>options.txt</strong> file to the <strong>Import Striking Options Data</strong> option. &nbsp;Then click the <strong>Save Changes</strong> button.</li>
</ol>
</p>
<h2>How to Update Striking</h2>
<p align="justify">As in performing a new install, there is more then one way to do an update your Striking Theme. </p>
<p align="justify">Most often updates are performed by using an FTP program.  &nbsp;Traditionally, the wordpress default <em>Install Theme</em> function was not applicable to updating premium themes, but if you have installed a free 3rd party plugin called "Easy Theme and Plugin Updater" then you can use the Install Theme wordpress function to update your theme.  &nbsp;Please reference that plugin's instructions for using it to do the theme update.</p>
<p><strong>The most important aspect of updating is that one should always have made a backup of their site and database prior to performing an update.</strong> &nbsp;Updates are very easy to do, but because we are dealing with the internet, and also several different programs attempting to work together, sometimes updates will fail, and "bad things" can happen to your existing site. &nbsp;If you have made a backup, then the problems may be reversible.</p>
<p>Recent versions of Striking (Ver 2.0+) have the ability for you to export your current web content as a wordpress xml file, so it is suggested that you use this feature found in the Advance Panel to create a copy of your site data as well.  So later, should you have a problem, you can use the import function also found in Striking in the Advance panel to import your site.</p>
<p>DON'T WORRY - UPDATES RARELY FAIL, AND WE ARE HERE TO ASSIST. &nbsp;IF YOU MADE A BACKUP, THEN THERE IS UNLIKELY TO BE ANY ISSSUES AT ALL.</p>
<p>Wordpress.org plugins section has many good backup programs to choose from. &nbsp;Choose one that is up to date and is highly rated.</p>
<h3>Update via FTP</h3>
<ol>
	<li>Download the latest version of Striking from Themeforest to your drive. &nbsp;As long as you are a purchaser of Striking, you always are entitled to all upgrades free. &nbsp;So check back every so often to the Striking page on Themeforest. &nbsp;If you see that an upgrade has been released and you have an older version number, log into your account, go to the downloads page of your themeforest account interface, and download Striking again.</li><br />
	<li>Before you unzip the download, you should copy the striking folder to your hard_drive then name it "Striking_old".	</li><br />	
	<li>Unzip the download. &nbsp;As with a new install (see above) you only need the 'striking" folder from the folders unzipped, for the upgrade. &nbsp;You will not be transferring license or resources, etc to your online host.</li><br />
	<li>It is very easy to do an update via ftp. &nbsp;Open your ftp program, and on the drive side, navigate to the "striking" subfolder. &nbsp;On the host side, navigate to your WordPress installation root directory:<br /><br /> /wp-content/themes/ <br /><br />where you have your current version of striking installed.</li><br />
	<li>simply drag over the striking folder from your drive to the themes folder, overwriting the existing striking folder.</li><br />
	<li>Log back into your wordrpess admin and go to your themes panel. You should see the latest version of Striking installed (check the version number). &nbsp;You are done your update!</li>
</ol>
<p>Many often worry that upgrading by ftp overwrite will cause one to lose the existing content they have input into their site. &nbsp;This is not the case.  &nbsp;Your content, formatting and images you have uploaded are not effected, nor is any custom css you have input into the custom css box in the striking general panel.</p>

<p>However, if you have made any custom modifications to your php files - for example you have have hardcoded changes to a file, you will lose those modifications in the update method above. &nbsp;You should definitely save each php or css file you have "hard" modified, so that you can reinstall them after the global program update. </p>
<br />
<h2>Trouble Shooting Tips</h2>
<ul>
	<li>
		<strong>Does your server have the GD library compiled with its version of PHP?</strong>
		<p>Striking use <a href="http://code.google.com/p/timthumb/" target="_blank">TimThumb</a> for image resizing. &nbsp;It requires the GD library to be installed. &nbsp;If your thumbnails are not working, check with your host to make sure that you have it.</p>
	</li>
	<li>
		<strong>Does your cache folder have the correct permissions?</strong>
		<p> All files and folders on a website have what is called CHMOD permissions.  &nbsp;CHMOD = Change Mode, and refers to the unix command that determines how much access is permitted to a file or folder.  &nbsp;You can find out more about how Wordpress deals with permissions at <a href="http://codex.wordpress.org/Changing_File_Permissions">http://codex.wordpress.org/Changing_File_Permissions</a></p>
		<p>Sometimes when you are installing or updating wordpress, the new wordpress install may set/reset file permissions resulting in you having difficulties with images / slider  operation / changing colors, etc.  &nbsp;You should know that how your server host has set up its server security also is an equally important factor.  &nbsp;Every host sets up their servers differently, and this also can cause some functions not to work correctly until you have modified the default permissions.</p>
		<p>Finally, to change to certain "open" permissions, you will likely have to use the control panel file manager supplied by your host, rather then an ftp program (many ftp programs have a function that allows one to modify permissions).  &nbsp;Most hosts configure server security so that open file permissions such as 777, 767, and sometimes even 757 need to be done from a host level, in order to prevent a non-site administrator from hacking the site security.  &nbsp;You may think that you have changed a permission to 777 via ftp (it will often say successfully changed), but if the problem persists, likely the change is not "hardcoded" on the host side. &nbsp;Permissions can be a complex issue, and you should not hesitate to speak with your host customer service if you are running into issues.</p>
		<p>You need to give your image cache folder (/themes/striking/cache/) with CHMOD 777 permissions. </p>
	</li>
	<li>
		<strong>Does the file "timthumb.php" have the correct permissions?</strong>
		<p>Make sure the file (/themes/striking/includes/timthumb.php) has the correct permissions needed for your server. &nbsp;In most cases this is "644" but it may vary depending on where you are hosted. If 644 does not work, try 755 or 777.</p>
	</li>
	<li>
		<strong>Does your server have mod_security settings that are impeding the scripts functionality?</strong>
		<p>Some servers may have mod_security settings that will stop the timthumb scripts from working. You should always contact your host if you are having problems to make sure they do not have settings enabled that would stop the script from working.</p>
	</li>
</ul>
