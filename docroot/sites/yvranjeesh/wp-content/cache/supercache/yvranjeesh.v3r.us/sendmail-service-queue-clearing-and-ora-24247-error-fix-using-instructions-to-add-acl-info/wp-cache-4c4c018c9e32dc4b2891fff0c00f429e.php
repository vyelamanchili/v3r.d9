<?php die(); ?><!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="http://yvranjeesh.v3r.us/xmlrpc.php">

<title>sendmail service queue clearing and ORA-24247 error fix using instructions to add ACL info. &#8211; Ranjeesh Loves to Share</title>
<link rel='dns-prefetch' href='//fonts.googleapis.com' />
<link rel='dns-prefetch' href='//s.w.org' />
<link rel="alternate" type="application/rss+xml" title="Ranjeesh Loves to Share &raquo; Feed" href="http://yvranjeesh.v3r.us/feed/" />
<link rel="alternate" type="application/rss+xml" title="Ranjeesh Loves to Share &raquo; Comments Feed" href="http://yvranjeesh.v3r.us/comments/feed/" />
<link rel="alternate" type="application/rss+xml" title="Ranjeesh Loves to Share &raquo; sendmail service queue clearing and ORA-24247 error fix using instructions to add ACL info. Comments Feed" href="http://yvranjeesh.v3r.us/sendmail-service-queue-clearing-and-ora-24247-error-fix-using-instructions-to-add-acl-info/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.3\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/2.3\/svg\/","svgExt":".svg","source":{"concatemoji":"http:\/\/yvranjeesh.v3r.us\/wp-includes\/js\/wp-emoji-release.min.js?ver=4.8.3"}};
			!function(a,b,c){function d(a){var b,c,d,e,f=String.fromCharCode;if(!k||!k.fillText)return!1;switch(k.clearRect(0,0,j.width,j.height),k.textBaseline="top",k.font="600 32px Arial",a){case"flag":return k.fillText(f(55356,56826,55356,56819),0,0),b=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,56826,8203,55356,56819),0,0),c=j.toDataURL(),b!==c&&(k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447),0,0),b=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447),0,0),c=j.toDataURL(),b!==c);case"emoji4":return k.fillText(f(55358,56794,8205,9794,65039),0,0),d=j.toDataURL(),k.clearRect(0,0,j.width,j.height),k.fillText(f(55358,56794,8203,9794,65039),0,0),e=j.toDataURL(),d!==e}return!1}function e(a){var c=b.createElement("script");c.src=a,c.defer=c.type="text/javascript",b.getElementsByTagName("head")[0].appendChild(c)}var f,g,h,i,j=b.createElement("canvas"),k=j.getContext&&j.getContext("2d");for(i=Array("flag","emoji4"),c.supports={everything:!0,everythingExceptFlag:!0},h=0;h<i.length;h++)c.supports[i[h]]=d(i[h]),c.supports.everything=c.supports.everything&&c.supports[i[h]],"flag"!==i[h]&&(c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&c.supports[i[h]]);c.supports.everythingExceptFlag=c.supports.everythingExceptFlag&&!c.supports.flag,c.DOMReady=!1,c.readyCallback=function(){c.DOMReady=!0},c.supports.everything||(g=function(){c.readyCallback()},b.addEventListener?(b.addEventListener("DOMContentLoaded",g,!1),a.addEventListener("load",g,!1)):(a.attachEvent("onload",g),b.attachEvent("onreadystatechange",function(){"complete"===b.readyState&&c.readyCallback()})),f=c.source||{},f.concatemoji?e(f.concatemoji):f.wpemoji&&f.twemoji&&(e(f.twemoji),e(f.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
		<style type="text/css">
img.wp-smiley,
img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
<link rel='stylesheet' id='tora-bootstrap-css'  href='http://yvranjeesh.v3r.us/wp-content/themes/tora/css/bootstrap/bootstrap.min.css?ver=1' type='text/css' media='all' />
<link rel='stylesheet' id='cptch_stylesheet-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/captcha/css/front_end_style.css?ver=4.3.6' type='text/css' media='all' />
<link rel='stylesheet' id='dashicons-css'  href='http://yvranjeesh.v3r.us/wp-includes/css/dashicons.min.css?ver=4.8.3' type='text/css' media='all' />
<link rel='stylesheet' id='cptch_desktop_style-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/captcha/css/desktop_style.css?ver=4.3.6' type='text/css' media='all' />
<link rel='stylesheet' id='dslc-fontawesome-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/css/font-awesome.css?ver=1.3.7' type='text/css' media='all' />
<link rel='stylesheet' id='dslc-main-css-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/css/frontend/main.css?ver=1.3.7' type='text/css' media='all' />
<link rel='stylesheet' id='dslc-modules-css-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/css/frontend/modules.css?ver=1.3.7' type='text/css' media='all' />
<link rel='stylesheet' id='dslc-plugins-css-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/css/frontend/plugins.css?ver=1.3.7' type='text/css' media='all' />
<!--[if IE]>
<link rel='stylesheet' id='dslc-css-ie-css'  href='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/css/ie.css?ver=1.3.7' type='text/css' media='all' />
<![endif]-->
<link rel='stylesheet' id='tora-style-css'  href='http://yvranjeesh.v3r.us/wp-content/themes/tora/style.css?ver=4.8.3' type='text/css' media='all' />
<style id='tora-style-inline-css' type='text/css'>
.site-logo { max-height:60px;}
@media only screen and (max-width: 1024px) { .contact-area { display:none;}}
body {font-family: 'Lato', sans-serif;}
h1, h2, h3, h4, h5, h6 {font-family: 'Raleway', sans-serif;}
h1 { font-size:36px; }
h2 { font-size:30px; }
h3 { font-size:24px; }
h4 { font-size:18px; }
h5 { font-size:14px; }
h6 { font-size:12px; }
body { font-size:14px; }
.main-navigation li { font-size:14px; }
#main #dslc-content .dslc-staff-member .dslc-staff-member-social a:hover,.footer-widgets .widget a:hover,.site-footer a:hover,.contact-info .tora-icon,.contact-social a:hover,.entry-meta .tora-icon,.entry-footer .tora-icon,.single-meta .tora-icon,.entry-title a:hover,.slicknav_nav a:hover,.main-navigation a:hover,a,a:hover,a:focus { color:#ed0202;}
.go-top,button,.button:not(.header-button),input[type="button"],input[type="reset"],input[type="submit"],button:hover,.button:not(.header-button):hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.mobile-nav .search-item,.search-item .tora-icon,.widget-area .tora_social_widget li a,.contact-data .tora-icon { background-color:#ed0202;}
.preloader-inner { border-bottom-color:#ed0202;}
.preloader-inner { border-right-color:#ed0202;}
.site-title a { color:#302506;}
.site-description { color:#1C1E21;}
.contact-area { background-color:#22394C;}
.contact-area, .contact-area a { color:#7496AB;}
.site-header { background-color:#ededed;}
.main-navigation a { color:#3E4C53;}
.header-text { color:#fff;}
.left-button { color:#fff;}
.left-button { border-color:#fff;}
.left-button:hover { background-color:#fff;}
.right-button:hover { color:#22394C;}
.right-button { border-color:#22394C;}
.right-button { background-color:#22394C;}
.footer-widgets, .site-footer { background-color:#b2b2b2;}
.site-footer, .site-footer a, .footer-widgets .widget, .footer-widgets .widget a { color:#1e68c9;}

</style>
<link rel='stylesheet' id='tora-body-fonts-css'  href='https://fonts.googleapis.com/css?family=Acme&#038;ver=4.8.3' type='text/css' media='all' />
<link rel='stylesheet' id='tora-headings-fonts-css'  href='https://fonts.googleapis.com/css?family=Vollkorn+SC&#038;ver=4.8.3' type='text/css' media='all' />
<link rel='stylesheet' id='tora-elegant-icons-css'  href='http://yvranjeesh.v3r.us/wp-content/themes/tora/fonts/style.css?ver=4.8.3' type='text/css' media='all' />
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/js/frontend/plugins.js?ver=1.3.7'></script>
<link rel='https://api.w.org/' href='http://yvranjeesh.v3r.us/wp-json/' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://yvranjeesh.v3r.us/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://yvranjeesh.v3r.us/wp-includes/wlwmanifest.xml" /> 
<link rel='prev' title='CA Arc serv backup agent for oracle' href='http://yvranjeesh.v3r.us/ca-arc-serv-backup-agent-for-oracle/' />
<link rel='next' title='Fix to show the hidden content behind the overflow scrollbar in Internet Explorer' href='http://yvranjeesh.v3r.us/fix-to-show-the-hidden-content-behind-the-overflow-scrollbar-in-internet-explorer/' />
<meta name="generator" content="WordPress 4.8.3" />
<link rel="canonical" href="http://yvranjeesh.v3r.us/sendmail-service-queue-clearing-and-ora-24247-error-fix-using-instructions-to-add-acl-info/" />
<link rel='shortlink' href='http://yvranjeesh.v3r.us/?p=39' />
<link rel="alternate" type="application/json+oembed" href="http://yvranjeesh.v3r.us/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fyvranjeesh.v3r.us%2Fsendmail-service-queue-clearing-and-ora-24247-error-fix-using-instructions-to-add-acl-info%2F" />
<link rel="alternate" type="text/xml+oembed" href="http://yvranjeesh.v3r.us/wp-json/oembed/1.0/embed?url=http%3A%2F%2Fyvranjeesh.v3r.us%2Fsendmail-service-queue-clearing-and-ora-24247-error-fix-using-instructions-to-add-acl-info%2F&#038;format=xml" />
<style type="text/css" id="custom-background-css">
body.custom-background { background-color: #dddddd; }
</style>
<style type="text/css">.dslc-modules-section-wrapper, .dslca-add-modules-section { width : 1170px; } .dslc-modules-section:not(.dslc-full) { padding-left: 4%;  padding-right: 4%; } .dslc-modules-section { background-image:disabled;background-repeat:repeat;background-position:left top;background-attachment:scroll;background-size:auto;border-width:0px;border-style:solid;margin-left:0%;margin-right:0%;margin-bottom:0px;padding-bottom:80px;padding-top:80px;padding-left:0%;padding-right:0%; }</style></head>

<body class="post-template-default single single-post postid-39 single-format-standard custom-background tora-sticky-menu">

<div class="preloader">
	<div class="preloader-inner"></div>
</div>

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content">Skip to content</a>

		<header id="masthead" class="site-header clearfix" role="banner">
		<div class="container">
			<div class="site-branding">
				<h1 class="site-title"><a href="http://yvranjeesh.v3r.us/" rel="home">Ranjeesh Loves to Share</a></h1><p class="site-description">Tech, Personal and Deal Blog</p>			</div>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Primary Menu</button>
				<div class="menu-main-menu-container"><ul id="primary-menu" class="menu"><li id="menu-item-810" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-810"><a href="http://yvranjeesh.v3r.us/about/">About Me</a></li>
<li id="menu-item-807" class="menu-item menu-item-type-taxonomy menu-item-object-category current-post-ancestor current-menu-parent current-post-parent menu-item-807"><a title="List of all technical blogs written by me" href="http://yvranjeesh.v3r.us/category/blog/">Tech Blog</a></li>
<li id="menu-item-809" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-809"><a title="Deals posted by me from tumblr" href="http://yvranjeesh.v3r.us/category/interests/deals/">Deals</a></li>
<li class="search-item"><i class="tora-icon dslc-icon-ei-icon_search"></i></li></ul></div>			</nav>
			<nav class="mobile-nav"></nav>
		</div>
	</header><!-- #masthead -->
	<div class="header-clone"></div>
	<div class="header-search"><div class="search-close"><i class="tora-icon dslc-icon-ei-icon_close"></i></div><div class="header-search-inner"><form role="search" method="get" class="search-form" action="http://yvranjeesh.v3r.us/">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
				</label>
				<input type="submit" class="search-submit" value="Search" />
			</form></div></div>
	
	<div id="content" class="site-content">
			<div class="container">
	
	
	<div id="primary" class="content-area ">
		<main id="main" class="site-main" role="main">

		
			

<article id="post-39" class="post-39 post type-post status-publish format-standard hentry category-blog tag-access-control-list tag-acl tag-bulk-mail tag-e-blast tag-eblast tag-mass-email tag-network-access-denied tag-ora-24247 tag-ora-24247-network-access-denied-by-access-control-list-acl tag-oracle tag-oracle-11g tag-script tag-security tag-security-layer clearfix">

	
	<div class="single-meta">
		<span class="posted-on"><span class="tora-icon dslc-icon-ei-icon_clock_alt"></span><a href="http://yvranjeesh.v3r.us/sendmail-service-queue-clearing-and-ora-24247-error-fix-using-instructions-to-add-acl-info/" rel="bookmark"><time class="entry-date published" datetime="2011-01-19T22:43:54+00:00">January 19, 2011</time><time class="updated" datetime="2017-11-12T16:49:27+00:00">November 12, 2017</time></a></span><span class="byline"> <span class="tora-icon dslc-icon-ei-icon_profile"></span><span class="author vcard"><a class="url fn n" href="http://yvranjeesh.v3r.us/author/administrator/">Ranjeesh</a></span></span><span class="cat-links"><span class="tora-icon dslc-icon-ei-icon_archive_alt"></span><a href="http://yvranjeesh.v3r.us/category/blog/" rel="category tag">Blog</a></span>	</div>

	<header class="entry-header">
		<h1 class="entry-title">sendmail service queue clearing and ORA-24247 error fix using instructions to add ACL info.</h1>	</header><!-- .entry-header -->

	<div class="entry-content">
		<div id="dslc-theme-content"><div id="dslc-theme-content-inner"><p>The other day at work we had a request from the client to send an e-blast (mass e-mail) to all the email addresses listed in our database (~55k emails).</p>
<p>In the past this was done using a procedure in the oracle database which used one of our smtp mail servers and oracle UTL_SMTP package. But due to a missing smtp mail server we could not run the procedure. We tried changing the mail server ip from a non-working one to a working one, but this didnt work. We kept getting an error that said</p>
<blockquote><p><strong>ORA-24247 network access denied by access control list (ACL)</strong></p></blockquote>
<p>As this was a time critical task and we did not have time to figure out where the missing server went, I created a PHP script that retrieves the email addresses from the oracle database and sends the message to all of them one by one using the<em> mail</em>() method in PHP. This when tested worked great. I estimated the script runtime to be 4 hours. I started the script at 630 PM and came back next morning and it was still running!</p>
<p>The script had already sent 50 &#8211; 300 messages to each recipient by then. To stop the php script I stopped the PHP page which was running all night. This did NOT stop the script in the backend. To stop the mailing process I went through google and figured out that the <em>mail</em>() process used the <em>sendmail service</em> on the redhat server. So I manually stopped the sendmail service which stopped the mails from sending.</p>
<p>I then asked the network administrator to check if there were any mails in the SMTP server queue. There were 1000s of messages in queue. I requested him to stop all the messages in the queue but the messages with RETRY status could not be stopped. There was a unapplied patch that needed to be run to make this work.Â At leastÂ the mails was not sending the mail but stuck at the queue.</p>
<p>After 3 days when I restarted the sendmail service on the server, it resumed sending the messages to all the recipients in the queue. This increased concerns. I then researched a little bit more and came to know that the sendmail service in redhat has its own mail queue which can be viewed using the <em><strong>mailq</strong></em> command in linux or using the <strong><em>sendmail â€“v -q</em></strong> command. There were 181k messages in queue waiting to be sent. All the queueud messages were stored in the folder <strong><em>/var/spool/mqueue</em></strong>. (<a href="http://www.kpsolution.com/blog/tips/how-to-clear-sendmail-queue/9/">Reference</a>)</p>
<p>To delete all the messages in queue I ran the command <strong><em>rm /var/spool/mqueue</em></strong> but this didnâ€™t work and gave me an error. <strong><em>â€œ/bin/rm: Argument list too longâ€</em></strong> . This was probably due to the limitations of rm command to have a length of arguments as a max of 1024. The alternate command (<a href="http://www.simplehelp.net/2009/02/18/linux-tip-overcoming-the-binrm-argument-list-too-long-error/">reference</a>) to delete all the 181k files is â€œ<strong><em>find . -name &#8216;*&#8217; | xargs rm</em></strong>â€. This deletes all the files in the current directory regardless of the number of files.</p>
<p>This way the spooled messages were cleared from the queue but the problem the database procedure not able to access the mail server still existed. So I went through various google articlesÂ referringÂ to the ORA-24247 error. I came to know that this error was due to an extra security layer in oracle 11g. There is an XML table in Â the oracle 11g database that tells the packages about particular accessible server ips. <a title="Oracle ACL list addition info" href="http://www.oracle-base.com/articles/11g/FineGrainedAccessToNetworkServices_11gR1.php" target="_blank" rel="noopener">This </a>article helped me out in understanding the extra security ACL list information and updating it to serve my purpose.</p>
<p>This way I fixed the oracle script access to the smtp server and solved the mailq problem with the e-blast messaging project. Just shared it to help others fix this problem if the come across it.</p>
</div></div>			</div><!-- .entry-content -->

	<footer class="entry-footer">
		<span class="tags-links"><span class="tora-icon dslc-icon-ei-icon_tags_alt"></span><a href="http://yvranjeesh.v3r.us/tag/access-control-list/" rel="tag">Access Control List</a>, <a href="http://yvranjeesh.v3r.us/tag/acl/" rel="tag">ACL</a>, <a href="http://yvranjeesh.v3r.us/tag/bulk-mail/" rel="tag">bulk mail</a>, <a href="http://yvranjeesh.v3r.us/tag/e-blast/" rel="tag">e-blast</a>, <a href="http://yvranjeesh.v3r.us/tag/eblast/" rel="tag">eblast</a>, <a href="http://yvranjeesh.v3r.us/tag/mass-email/" rel="tag">mass email</a>, <a href="http://yvranjeesh.v3r.us/tag/network-access-denied/" rel="tag">network access denied</a>, <a href="http://yvranjeesh.v3r.us/tag/ora-24247/" rel="tag">ORA-24247</a>, <a href="http://yvranjeesh.v3r.us/tag/ora-24247-network-access-denied-by-access-control-list-acl/" rel="tag">ORA-24247 network access denied by access control list (ACL)</a>, <a href="http://yvranjeesh.v3r.us/tag/oracle/" rel="tag">Oracle</a>, <a href="http://yvranjeesh.v3r.us/tag/oracle-11g/" rel="tag">Oracle 11g</a>, <a href="http://yvranjeesh.v3r.us/tag/script/" rel="tag">script</a>, <a href="http://yvranjeesh.v3r.us/tag/security/" rel="tag">Security</a>, <a href="http://yvranjeesh.v3r.us/tag/security-layer/" rel="tag">Security Layer</a></span>	</footer>

</article><!-- #post-## -->


			
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text">Post navigation</h2>
		<div class="nav-links"><div class="nav-previous"><a href="http://yvranjeesh.v3r.us/ca-arc-serv-backup-agent-for-oracle/" rel="prev">CA Arc serv backup agent for oracle</a></div><div class="nav-next"><a href="http://yvranjeesh.v3r.us/fix-to-show-the-hidden-content-behind-the-overflow-scrollbar-in-internet-explorer/" rel="next">Fix to show the hidden content behind the overflow scrollbar in Internet Explorer</a></div></div>
	</nav>
			
<div id="comments" class="comments-area">

	
	
	
		<div id="respond" class="comment-respond">
		<h3 id="reply-title" class="comment-reply-title">Leave a Reply <small><a rel="nofollow" id="cancel-comment-reply-link" href="/sendmail-service-queue-clearing-and-ora-24247-error-fix-using-instructions-to-add-acl-info/#respond" style="display:none;">Cancel reply</a></small></h3>			<form action="http://yvranjeesh.v3r.us/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate>
				<p class="comment-notes"><span id="email-notes">Your email address will not be published.</span> Required fields are marked <span class="required">*</span></p><p class="comment-form-comment"><label for="comment">Comment</label> <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea></p><p class="comment-form-author"><label for="author">Name <span class="required">*</span></label> <input id="author" name="author" type="text" value="Miptiomy" size="30" maxlength="245" aria-required='true' required='required' /></p>
<p class="comment-form-email"><label for="email">Email <span class="required">*</span></label> <input id="email" name="email" type="email" value="Miptiomy@sengi.top" size="30" maxlength="100" aria-describedby="email-notes" aria-required='true' required='required' /></p>
<p class="comment-form-url"><label for="url">Website</label> <input id="url" name="url" type="url" value="http://noreferer.win/" size="30" maxlength="200" /></p>
<p class="cptch_block"><span class="cptch_wrap cptch_math_actions">

				<label class="cptch_label" for="cptch_input_82"><span class="cptch_span"><img class="cptch_img " src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgAAAAIACAMAAADDpiTIAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAABhQTFRFiYmJ////W1tbr6+vAAAALi4u0dHR7Ozsne8SEgAAB3VJREFUeNrs3eFu2zYAhVGatMj3f+PJ64J1aNFZtmJJvOf71WIrEIcnFMXYYrkruuJbAIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAAAOBbAIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAv7bcDmgB4DRVAAD4eBWA87wGMwAAAAQDaAAAYA0AgBkgFUAHAAAAggEMawAAzADBAG4ARANYAMgGcMivAqwB0gGYAc7zEgAAAAAArAFSATQzAAAABAPoAABgDRAMYJgBAAAgGMANAACsAXIBLGaAbAAVAAAACAZQrAEAMAMEA2gAAAAAANYAqQC6GQAAAIIBDAAAeK627NgdgJP0/A9tu2s+ABt+F+ShmDMCqAAAEHbrDgAAAPz7AvLu3AB4EYDRnhHA878KGEY7G0A32jMC6AAAYCMwGMAAAAAbgcEA7AQDYCMwGMACQDaAaiMQAACCARQ7wQDYCAwG4FcBANgIBACAWADdRiAA9oGCAQwAAPCW0GAANgKzASw2ArMBVAAAsBEIgH2gVAAFAABsBAYDaAAAYCMwGIBfBQBgJxiAjTvBSy2ttd7HGLev3yWsf+69tVIXAK7U2LYRuNTW//ef9J7E4OIAnt8IXMoTY//T/98KADMBeKVeFgDO3befGDa/gWsD+MSBUb0CEA3gMQ0AcNav/kPPhh8FgGgAExO49uv65HlBk64FAAg/bwCALdeBCsC5+viBUQWAbAC3vgBwog44MWy2ywAA4TeE1341xxwZWAA4ScuNAACOqAFwiupRACaaAwAIF3DpF1KOAzDN28wBCBdwaQDtSACT7AkC8LoAAI6uHwpgjoUgAOHLAADCLwKXBjAOBjDDReDSL+F2eAsA2QAaAAe2HA/g+utA+wDhU8DFPxzaTAHRAO732kwB0QBWAt2NQDSAlcAwBUQDWF/FHwiM8Xj4U6l1+arWUrY9MOaP7xIG4KwE1pH/8+Oell0YFADOd0PwGPqnl5FvLiI6AKciMHrZemu2lB67DJzqQw7rD3Opr/7T0I8KeYj2+5tKHYBJJpBXLwQAzFLJ2w4GYIc9pQbAPCuBHrYIAGAPAQDM1IhaBADw6xwwknaDAfjNSjBpFQjAb2pBq0AA9lgGDADmquTcBgCwyxRQAcieAgCYrZj7QAB2uREAIPwa0ADIvgYAEH4f0AHIXgQAEL4IAGC6KgAAAOA2AAAAAHAfCAAAAAAAAAC2ggEAwF0AAAEtAGS37WOi3hAyHwDvCcyuAJDdtvcDLADM1rZPid8BiL4L9NGw8CWAD4eGLwF8PHy6tr0p2AMisncBhkfEZN8DeEjUbG08j8xj4sInAA+KjF4BXPvICADenwAufWDAVQHUb5x2tz4kzOPij/i6b+O7CGx+TGAD4AgAj+/8cobxv/bhoZcGsBLY/Zu//UGx1z437uIA1gvwvq/ghQMDGgBHAth3Gtg+/1/9+OgZADwO7tpnFF45N8rJoScA8PdRkW8beO3QKGcHnwPA42exvfNqXj02zunhpwHwY01YPzr8Fz84dj4Ar50d+8bRsRWAswH4Oj36ybn5vYODrz4BTAvgn0VBq3/8Ca2lvXl8fAHgxAC+LgnrdFBKrctXtZbSWn9z7Ce4B8wA8N8Ru+1aBeBiAPbt8isAANInAADeqd0BSAYwFgCiAUzxfkoAoi8AAIRfAACIvgMAIH0BAED4AgCA4C1AACwAATD+AISPPwDh4w9A+PgDsHn9P9f4AxB7/wdA8v4fANH7/wC4/ANg+gfAjz8AT9/8T/s4vcs+Jm58cvzb/Q7A6b7yjxFoyx2AU37t/SPDX+93AM56IWjffe2f+qf/+gAen+4f37n0m334p3hY9NKGuT8ZwONSsPc88N7zpgA45Fqw20SQM/r3yc4L2AHBaAHX/WkB/HM5ePHhL6OnDf6cAH7MBQ8GTzt4DH3NG/uZAfwEobS2Wuhj7acnBK1/6339LyV25DMACAABIAAEgAAQAAJAAAgAASAAAPAtAEAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAAAPAtAEAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAACAABIAAEgAAQAAJAAAgAASAABIAAEAACQAAIAAEgAASAABAAAkAA6FP9JcAAZpYvOJy8H4MAAAAASUVORK5CYII=" alt="image"/></span>

					<span class="cptch_span">&nbsp;&times;&nbsp;</span>

					<span class="cptch_span">&#102;ive</span>

					<span class="cptch_span">&nbsp;=&nbsp;</span>

					<span class="cptch_span"><input id="cptch_input_82" class="cptch_input cptch_wp_comments" type="text" autocomplete="off" name="cptch_number" value="" maxlength="2" size="2" aria-required="true" required="required" style="margin-bottom:0;display:inline;font-size: 12px;width: 40px;" /></span>

					<input type="hidden" name="cptch_result" value="SEpB" /><input type="hidden" name="cptch_time" value="1514046606" />

					<input type="hidden" name="cptch_form" value="wp_comments" />

				</label><span class="cptch_reload_button_wrap hide-if-no-js">

					<noscript>

						<style type="text/css">

							.hide-if-no-js {

								display: none !important;

							}

						</style>

					</noscript>

					<span class="cptch_reload_button dashicons dashicons-update"></span>

				</span></span></p><p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="Post Comment" /> <input type='hidden' name='comment_post_ID' value='39' id='comment_post_ID' />
<input type='hidden' name='comment_parent' id='comment_parent' value='0' />
</p><p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="c999dbcfa8" /></p><p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="21"/></p>			</form>
			</div><!-- #respond -->
	
</div><!-- #comments -->
		
		</main><!-- #main -->
	</div><!-- #primary -->



<div id="secondary" class="widget-area" role="complementary">
	<aside id="search-2" class="widget widget_search"><form role="search" method="get" class="search-form" action="http://yvranjeesh.v3r.us/">
				<label>
					<span class="screen-reader-text">Search for:</span>
					<input type="search" class="search-field" placeholder="Search &hellip;" value="" name="s" />
				</label>
				<input type="submit" class="search-submit" value="Search" />
			</form></aside>		<aside id="recent-posts-2" class="widget widget_recent_entries">		<h4 class="widget-title">Recent Posts</h4>		<ul>
					<li>
				<a href="http://yvranjeesh.v3r.us/open-link-in-different-chrome-profile-window/">Open link in different chrome profile window</a>
						</li>
					<li>
				<a href="http://yvranjeesh.v3r.us/php-7-0-and-drupal-7-on-ubuntu-16-04-xenial/">PHP 7.0 and Drupal 7 on Ubuntu 16.04 Xenial</a>
						</li>
					<li>
				<a href="http://yvranjeesh.v3r.us/ruby-on-rails-environment-setup-on-windows-10/">Ruby on Rails Environment Setup on Windows 10</a>
						</li>
					<li>
				<a href="http://yvranjeesh.v3r.us/git-prune-for-cleanup/">Git Prune for Cleanup</a>
						</li>
					<li>
				<a href="http://yvranjeesh.v3r.us/git-bfg/">GIT BFG</a>
						</li>
				</ul>
		</aside>		<aside id="meta-2" class="widget widget_meta"><h4 class="widget-title">Meta</h4>			<ul>
						<li><a href="http://yvranjeesh.v3r.us/wp-login.php">Log in</a></li>
			<li><a href="http://yvranjeesh.v3r.us/feed/">Entries <abbr title="Really Simple Syndication">RSS</abbr></a></li>
			<li><a href="http://yvranjeesh.v3r.us/comments/feed/">Comments <abbr title="Really Simple Syndication">RSS</abbr></a></li>
			<li><a href="https://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress.org</a></li>			</ul>
			</aside><aside id="archives-2" class="widget widget_archive"><h4 class="widget-title">Archives</h4>		<label class="screen-reader-text" for="archives-dropdown-2">Archives</label>
		<select id="archives-dropdown-2" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
			
			<option value="">Select Month</option>
				<option value='http://yvranjeesh.v3r.us/2017/10/'> October 2017 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2017/04/'> April 2017 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2016/07/'> July 2016 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2016/01/'> January 2016 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2015/07/'> July 2015 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2015/04/'> April 2015 &nbsp;(2)</option>
	<option value='http://yvranjeesh.v3r.us/2015/03/'> March 2015 &nbsp;(9)</option>
	<option value='http://yvranjeesh.v3r.us/2015/02/'> February 2015 &nbsp;(4)</option>
	<option value='http://yvranjeesh.v3r.us/2015/01/'> January 2015 &nbsp;(9)</option>
	<option value='http://yvranjeesh.v3r.us/2014/12/'> December 2014 &nbsp;(16)</option>
	<option value='http://yvranjeesh.v3r.us/2014/11/'> November 2014 &nbsp;(22)</option>
	<option value='http://yvranjeesh.v3r.us/2014/10/'> October 2014 &nbsp;(12)</option>
	<option value='http://yvranjeesh.v3r.us/2014/09/'> September 2014 &nbsp;(9)</option>
	<option value='http://yvranjeesh.v3r.us/2014/08/'> August 2014 &nbsp;(6)</option>
	<option value='http://yvranjeesh.v3r.us/2014/07/'> July 2014 &nbsp;(14)</option>
	<option value='http://yvranjeesh.v3r.us/2014/06/'> June 2014 &nbsp;(2)</option>
	<option value='http://yvranjeesh.v3r.us/2014/05/'> May 2014 &nbsp;(5)</option>
	<option value='http://yvranjeesh.v3r.us/2014/04/'> April 2014 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2014/03/'> March 2014 &nbsp;(5)</option>
	<option value='http://yvranjeesh.v3r.us/2014/02/'> February 2014 &nbsp;(2)</option>
	<option value='http://yvranjeesh.v3r.us/2014/01/'> January 2014 &nbsp;(5)</option>
	<option value='http://yvranjeesh.v3r.us/2013/12/'> December 2013 &nbsp;(7)</option>
	<option value='http://yvranjeesh.v3r.us/2013/11/'> November 2013 &nbsp;(14)</option>
	<option value='http://yvranjeesh.v3r.us/2013/10/'> October 2013 &nbsp;(2)</option>
	<option value='http://yvranjeesh.v3r.us/2013/09/'> September 2013 &nbsp;(7)</option>
	<option value='http://yvranjeesh.v3r.us/2013/08/'> August 2013 &nbsp;(10)</option>
	<option value='http://yvranjeesh.v3r.us/2013/07/'> July 2013 &nbsp;(7)</option>
	<option value='http://yvranjeesh.v3r.us/2013/06/'> June 2013 &nbsp;(2)</option>
	<option value='http://yvranjeesh.v3r.us/2013/05/'> May 2013 &nbsp;(3)</option>
	<option value='http://yvranjeesh.v3r.us/2013/04/'> April 2013 &nbsp;(7)</option>
	<option value='http://yvranjeesh.v3r.us/2013/03/'> March 2013 &nbsp;(8)</option>
	<option value='http://yvranjeesh.v3r.us/2013/02/'> February 2013 &nbsp;(3)</option>
	<option value='http://yvranjeesh.v3r.us/2013/01/'> January 2013 &nbsp;(7)</option>
	<option value='http://yvranjeesh.v3r.us/2012/12/'> December 2012 &nbsp;(19)</option>
	<option value='http://yvranjeesh.v3r.us/2012/11/'> November 2012 &nbsp;(18)</option>
	<option value='http://yvranjeesh.v3r.us/2011/11/'> November 2011 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2011/02/'> February 2011 &nbsp;(3)</option>
	<option value='http://yvranjeesh.v3r.us/2011/01/'> January 2011 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2010/12/'> December 2010 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2010/11/'> November 2010 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2010/10/'> October 2010 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2010/09/'> September 2010 &nbsp;(2)</option>
	<option value='http://yvranjeesh.v3r.us/2010/01/'> January 2010 &nbsp;(1)</option>
	<option value='http://yvranjeesh.v3r.us/2009/11/'> November 2009 &nbsp;(1)</option>

		</select>
		</aside><aside id="tag_cloud-2" class="widget widget_tag_cloud"><h4 class="widget-title">Keywords</h4><div class="tagcloud"><a href="http://yvranjeesh.v3r.us/tag/3d/" class="tag-cloud-link tag-link-661 tag-link-position-1" style="font-size: 8.5343511450382pt;" aria-label="3d (7 items)">3d</a>
<a href="http://yvranjeesh.v3r.us/tag/4g/" class="tag-cloud-link tag-link-265 tag-link-position-2" style="font-size: 8pt;" aria-label="4g (6 items)">4g</a>
<a href="http://yvranjeesh.v3r.us/tag/1080p/" class="tag-cloud-link tag-link-186 tag-link-position-3" style="font-size: 11.740458015267pt;" aria-label="1080p (15 items)">1080p</a>
<a href="http://yvranjeesh.v3r.us/tag/amazon/" class="tag-cloud-link tag-link-274 tag-link-position-4" style="font-size: 12.381679389313pt;" aria-label="amazon (17 items)">amazon</a>
<a href="http://yvranjeesh.v3r.us/tag/android/" class="tag-cloud-link tag-link-281 tag-link-position-5" style="font-size: 8.5343511450382pt;" aria-label="android (7 items)">android</a>
<a href="http://yvranjeesh.v3r.us/tag/apple/" class="tag-cloud-link tag-link-363 tag-link-position-6" style="font-size: 10.778625954198pt;" aria-label="apple (12 items)">apple</a>
<a href="http://yvranjeesh.v3r.us/tag/bestbuy/" class="tag-cloud-link tag-link-476 tag-link-position-7" style="font-size: 10.030534351145pt;" aria-label="bestbuy (10 items)">bestbuy</a>
<a href="http://yvranjeesh.v3r.us/tag/best-buy/" class="tag-cloud-link tag-link-491 tag-link-position-8" style="font-size: 8.5343511450382pt;" aria-label="Best Buy (7 items)">Best Buy</a>
<a href="http://yvranjeesh.v3r.us/tag/blackfriday/" class="tag-cloud-link tag-link-460 tag-link-position-9" style="font-size: 10.458015267176pt;" aria-label="blackfriday (11 items)">blackfriday</a>
<a href="http://yvranjeesh.v3r.us/tag/black-friday/" class="tag-cloud-link tag-link-459 tag-link-position-10" style="font-size: 10.458015267176pt;" aria-label="black friday (11 items)">black friday</a>
<a href="http://yvranjeesh.v3r.us/tag/bluetooth/" class="tag-cloud-link tag-link-428 tag-link-position-11" style="font-size: 8.5343511450382pt;" aria-label="bluetooth (7 items)">bluetooth</a>
<a href="http://yvranjeesh.v3r.us/tag/bluray/" class="tag-cloud-link tag-link-350 tag-link-position-12" style="font-size: 11.526717557252pt;" aria-label="bluray (14 items)">bluray</a>
<a href="http://yvranjeesh.v3r.us/tag/cheap/" class="tag-cloud-link tag-link-130 tag-link-position-13" style="font-size: 21.786259541985pt;" aria-label="cheap (138 items)">cheap</a>
<a href="http://yvranjeesh.v3r.us/tag/deal/" class="tag-cloud-link tag-link-121 tag-link-position-14" style="font-size: 22pt;" aria-label="deal (143 items)">deal</a>
<a href="http://yvranjeesh.v3r.us/tag/deals/" class="tag-cloud-link tag-link-531 tag-link-position-15" style="font-size: 16.335877862595pt;" aria-label="deals (42 items)">deals</a>
<a href="http://yvranjeesh.v3r.us/tag/dell/" class="tag-cloud-link tag-link-190 tag-link-position-16" style="font-size: 8.5343511450382pt;" aria-label="Dell (7 items)">Dell</a>
<a href="http://yvranjeesh.v3r.us/tag/ebay/" class="tag-cloud-link tag-link-270 tag-link-position-17" style="font-size: 10.778625954198pt;" aria-label="ebay (12 items)">ebay</a>
<a href="http://yvranjeesh.v3r.us/tag/free/" class="tag-cloud-link tag-link-138 tag-link-position-18" style="font-size: 16.229007633588pt;" aria-label="Free (41 items)">Free</a>
<a href="http://yvranjeesh.v3r.us/tag/game/" class="tag-cloud-link tag-link-155 tag-link-position-19" style="font-size: 8pt;" aria-label="game (6 items)">game</a>
<a href="http://yvranjeesh.v3r.us/tag/games/" class="tag-cloud-link tag-link-156 tag-link-position-20" style="font-size: 9.6030534351145pt;" aria-label="games (9 items)">games</a>
<a href="http://yvranjeesh.v3r.us/tag/google/" class="tag-cloud-link tag-link-237 tag-link-position-21" style="font-size: 11.206106870229pt;" aria-label="google (13 items)">google</a>
<a href="http://yvranjeesh.v3r.us/tag/hdd/" class="tag-cloud-link tag-link-163 tag-link-position-22" style="font-size: 10.778625954198pt;" aria-label="hdd (12 items)">hdd</a>
<a href="http://yvranjeesh.v3r.us/tag/hdtv/" class="tag-cloud-link tag-link-185 tag-link-position-23" style="font-size: 13.87786259542pt;" aria-label="hdtv (24 items)">hdtv</a>
<a href="http://yvranjeesh.v3r.us/tag/ipad/" class="tag-cloud-link tag-link-362 tag-link-position-24" style="font-size: 9.6030534351145pt;" aria-label="ipad (9 items)">ipad</a>
<a href="http://yvranjeesh.v3r.us/tag/iphone/" class="tag-cloud-link tag-link-565 tag-link-position-25" style="font-size: 9.0687022900763pt;" aria-label="iphone (8 items)">iphone</a>
<a href="http://yvranjeesh.v3r.us/tag/laptop/" class="tag-cloud-link tag-link-166 tag-link-position-26" style="font-size: 10.458015267176pt;" aria-label="laptop (11 items)">laptop</a>
<a href="http://yvranjeesh.v3r.us/tag/led/" class="tag-cloud-link tag-link-442 tag-link-position-27" style="font-size: 12.809160305344pt;" aria-label="led (19 items)">led</a>
<a href="http://yvranjeesh.v3r.us/tag/lg/" class="tag-cloud-link tag-link-262 tag-link-position-28" style="font-size: 10.030534351145pt;" aria-label="lg (10 items)">lg</a>
<a href="http://yvranjeesh.v3r.us/tag/microsoft/" class="tag-cloud-link tag-link-151 tag-link-position-29" style="font-size: 9.0687022900763pt;" aria-label="microsoft (8 items)">microsoft</a>
<a href="http://yvranjeesh.v3r.us/tag/movie/" class="tag-cloud-link tag-link-375 tag-link-position-30" style="font-size: 8.5343511450382pt;" aria-label="movie (7 items)">movie</a>
<a href="http://yvranjeesh.v3r.us/tag/movies/" class="tag-cloud-link tag-link-338 tag-link-position-31" style="font-size: 11.740458015267pt;" aria-label="movies (15 items)">movies</a>
<a href="http://yvranjeesh.v3r.us/tag/phone/" class="tag-cloud-link tag-link-276 tag-link-position-32" style="font-size: 9.6030534351145pt;" aria-label="phone (9 items)">phone</a>
<a href="http://yvranjeesh.v3r.us/tag/playstation/" class="tag-cloud-link tag-link-657 tag-link-position-33" style="font-size: 8.5343511450382pt;" aria-label="playstation (7 items)">playstation</a>
<a href="http://yvranjeesh.v3r.us/tag/portable/" class="tag-cloud-link tag-link-174 tag-link-position-34" style="font-size: 8pt;" aria-label="portable (6 items)">portable</a>
<a href="http://yvranjeesh.v3r.us/tag/rebate/" class="tag-cloud-link tag-link-169 tag-link-position-35" style="font-size: 8pt;" aria-label="rebate (6 items)">rebate</a>
<a href="http://yvranjeesh.v3r.us/tag/refurbished/" class="tag-cloud-link tag-link-406 tag-link-position-36" style="font-size: 9.6030534351145pt;" aria-label="refurbished (9 items)">refurbished</a>
<a href="http://yvranjeesh.v3r.us/tag/samsung/" class="tag-cloud-link tag-link-184 tag-link-position-37" style="font-size: 8pt;" aria-label="samsung (6 items)">samsung</a>
<a href="http://yvranjeesh.v3r.us/tag/sony/" class="tag-cloud-link tag-link-323 tag-link-position-38" style="font-size: 8pt;" aria-label="sony (6 items)">sony</a>
<a href="http://yvranjeesh.v3r.us/tag/ssd/" class="tag-cloud-link tag-link-160 tag-link-position-39" style="font-size: 9.0687022900763pt;" aria-label="ssd (8 items)">ssd</a>
<a href="http://yvranjeesh.v3r.us/tag/tablet/" class="tag-cloud-link tag-link-271 tag-link-position-40" style="font-size: 10.778625954198pt;" aria-label="tablet (12 items)">tablet</a>
<a href="http://yvranjeesh.v3r.us/tag/tv/" class="tag-cloud-link tag-link-189 tag-link-position-41" style="font-size: 10.030534351145pt;" aria-label="tv (10 items)">tv</a>
<a href="http://yvranjeesh.v3r.us/tag/walmart/" class="tag-cloud-link tag-link-117 tag-link-position-42" style="font-size: 11.206106870229pt;" aria-label="walmart (13 items)">walmart</a>
<a href="http://yvranjeesh.v3r.us/tag/wifi/" class="tag-cloud-link tag-link-267 tag-link-position-43" style="font-size: 8.5343511450382pt;" aria-label="wifi (7 items)">wifi</a>
<a href="http://yvranjeesh.v3r.us/tag/windows/" class="tag-cloud-link tag-link-297 tag-link-position-44" style="font-size: 8.5343511450382pt;" aria-label="windows (7 items)">windows</a>
<a href="http://yvranjeesh.v3r.us/tag/windows8/" class="tag-cloud-link tag-link-299 tag-link-position-45" style="font-size: 8pt;" aria-label="windows8 (6 items)">windows8</a></div>
</aside><aside id="categories-2" class="widget widget_categories"><h4 class="widget-title">Categories</h4>		<ul>
	<li class="cat-item cat-item-1"><a href="http://yvranjeesh.v3r.us/category/blog/" title="This category contains all my blogs.">Blog</a>
</li>
	<li class="cat-item cat-item-1042"><a href="http://yvranjeesh.v3r.us/category/interests/deals/" title="All Deals that are good in my opinion and posted on my tumblr account.">Deals</a>
</li>
		</ul>
</aside><aside id="text-2" class="widget widget_text">			<div class="textwidget">
<script src="//z-na.amazon-adsystem.com/widgets/onejs?MarketPlace=US&adInstanceId=396c6bad-0cff-4683-bb64-2497a17ad3ca"></script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-39340040-3', 'auto');
  ga('send', 'pageview');

</script>
</div>
		</aside></div><!-- #secondary -->
	
		</div>
	</div><!-- #content -->

	
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="inner-footer">
					<nav id="footer-navigation" class="footer-navigation" role="navigation">
			<div id="footer-menu" class="menu"><ul>
<li class="page_item page-item-2"><a href="http://yvranjeesh.v3r.us/about/">About Me</a></li>
</ul></div>
		</nav>
	<a class="go-top"><i class="tora-icon dslc-icon-ei-arrow_triangle-up"></i></a>		<div class="site-info">
			<a href="https://wordpress.org/">Powered by WordPress</a>
			<span class="sep"> | </span>
			Theme: <a href="http://theme.blue/themes/tora" rel="designer">Tora</a>		</div>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<script type='text/javascript'>
/* <![CDATA[ */
var mejsL10n = {"language":"en-US","strings":{"Close":"Close","Fullscreen":"Fullscreen","Turn off Fullscreen":"Turn off Fullscreen","Go Fullscreen":"Go Fullscreen","Download File":"Download File","Download Video":"Download Video","Play":"Play","Pause":"Pause","Captions\/Subtitles":"Captions\/Subtitles","None":"None","Time Slider":"Time Slider","Skip back %1 seconds":"Skip back %1 seconds","Video Player":"Video Player","Audio Player":"Audio Player","Volume Slider":"Volume Slider","Mute Toggle":"Mute Toggle","Unmute":"Unmute","Mute":"Mute","Use Up\/Down Arrow keys to increase or decrease volume.":"Use Up\/Down Arrow keys to increase or decrease volume.","Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds.":"Use Left\/Right Arrow keys to advance one second, Up\/Down arrows to advance ten seconds."}};
var _wpmejsSettings = {"pluginPath":"\/wp-includes\/js\/mediaelement\/"};
/* ]]> */
</script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/mediaelement/mediaelement-and-player.min.js?ver=2.22.0'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/mediaelement/wp-mediaelement.min.js?ver=4.8.3'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/imagesloaded.min.js?ver=3.2.0'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/masonry.min.js?ver=3.3.2'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/jquery/jquery.masonry.min.js?ver=3.1.2b'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var DSLCAjax = {"ajaxurl":"http:\/\/yvranjeesh.v3r.us\/wp-admin\/admin-ajax.php"};
/* ]]> */
</script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/plugins/live-composer-page-builder/js/frontend/main.js?ver=1.3.7'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/themes/tora/js/skip-link-focus-fix.js?ver=20130115'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/comment-reply.min.js?ver=4.8.3'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/themes/tora/js/scripts.js?ver=4.8.3'></script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/themes/tora/js/main.min.js?ver=4.8.3'></script>
<!--[if lt IE 9]>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/themes/tora/js/html5.js?ver=4.8.3'></script>
<![endif]-->
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-includes/js/wp-embed.min.js?ver=4.8.3'></script>
<script async="async" type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/plugins/akismet/_inc/form.js?ver=4.0.1'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var cptch_vars = {"nonce":"7e5749a52e","ajaxurl":"http:\/\/yvranjeesh.v3r.us\/wp-admin\/admin-ajax.php","enlarge":""};
/* ]]> */
</script>
<script type='text/javascript' src='http://yvranjeesh.v3r.us/wp-content/plugins/captcha/js/front_end_script.js?ver=4.8.3'></script>

</body>
</html>
<!-- Dynamic page generated in 0.059 seconds. -->
<!-- Cached page generated by WP-Super-Cache on 2017-12-23 11:30:06 -->
