<!DOCTYPE html>
<html lang="$ContentLocale">
    <head>
		<% base_tag %>
		<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
		$MetaTags(false)
		<link rel="shortcut icon" href="/favicon.ico" />

		<!-- html5shiv needs to be included before all stylesheets -->
		<!--[if lt IE 9]>
			$StackJS(header_javascript_html5shiv)
		<![endif]-->

		$StackCSS(theme_styles)
		$StackJS(header_javascript)
    </head>
    <body class="{$ClassName} {$Action} root-{$RootAncestor.URLSegment}">
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
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', '{$SiteConfig.GA}']);
			_gaq.push(['_trackPageview']);
			_gaq.push(['_trackPageLoadTime']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<% end_if %>
		$StackJS(footer_javascript)
    </body>
</html>