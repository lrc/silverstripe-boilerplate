<% include PageHeader %>
<% include SideBar %>
<div id="content-panel">
	<% include BreadCrumbs %>
	<h1 class="page-title">$Title</h1>
	$Content
	<ul>
		<% control SiteMap %>
		<li class="$LinkingMode">
			<a href="$Link" title="Go to the $Title.XML page">$MenuTitle.XML</a>
			<% if Children %>
			<ul>
				<% control Children %>
				<li class="$LinkingMode">
					<a href="$Link" title="Go to the $Title.XML page">$MenuTitle.XML</a>
					<% if Children %>
					<ul>
						<% control Children %>
						<li class="$LinkingMode"><a href="$Link" title="Go to the $Title.XML page">$MenuTitle.XML</a></li>
						<% end_control %>
					</ul>
					<% end_if %>
				</li>
				<% end_control %>
			</ul>
			<% end_if %>
		</li>
		<% end_control %>
	</ul>
</div>