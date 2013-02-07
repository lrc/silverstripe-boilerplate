<!DOCTYPE html>
<html lang="$ContentLocale" class="no-js">
    <head>
		<% base_tag %>
		<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
		<meta name="viewport" content="width=device-width; initial-scale=1.0"/>
		$MetaTags(false)
		<link rel="shortcut icon" href="/favicon.ico" />

		<!-- html5shiv needs to be included before all stylesheets -->
		<!--[if lt IE 9]><script src="themes/default/javascript/html5.js"></script><![endif]-->

		<link rel="stylesheet" type="text/css" href="themes/default/css/style.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="themes/default/css/lte-ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="themes/default/css/lte-ie7.css" /><![endif]-->
		
		<script data-main="themes/default/javascript/main" src="themes/default/javascript/require-jquery.js"></script>
		<script>with(document.documentElement){className=className.replace(/no-js/,'js')}</script>
		
		<% if SiteConfig.GA %>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '{$SiteConfig.GA}']);
			_gaq.push(['_require', 'inpage_linkid', '//www.google-analytics.com/plugins/ga/inpage_linkid.js']);
			_gaq.push(['_trackPageview']);
			_gaq.push(['_trackPageLoadTime']);
			// Note, the asynchronous snippet is split in two as per: https://developers.google.com/analytics/devguides/collection/gajs/#SplitSnippet
		</script>
		<% end_if %>
    </head>
    <body class="{$ClassName}">
		<header class="clearfix">
			<a href="#" id="logo"><img src="themes/default/images/logo.png" alt="Logo"></a>
		</header>

		<nav id="nav-main"><% include Navigation %></nav>

		<div id="body" class="clearfix">$Layout</div><!-- body -->          

		<footer class="clearfix">
			<div>
				&copy; Copyright $Now.Year $SiteConfig.FooterContent				
				<% control FooterMenu %><a href="$Link" title="Go to the $Title.XML page">$MenuTitle.XML</a><% end_control %>
			</div>				
		</footer>
		<% if SiteConfig.GA %>
		<script type="text/javascript">
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<% end_if %>
    </body>
</html>