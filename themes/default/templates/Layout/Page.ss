<% include BreadCrumbs %>

<div id="img-banner">
	<% control HeaderImages %>
	<% if Link %><a href="$Link"><% end_if %>
	<% if Top.IsHome %>$Image.SetSize(980, 50)<% else %>$Image.SetSize(980, 50)<% end_if %>
	<% if Link %></a><% end_if %>
	<% end_control %>
</div>

<% include SideBar %>

<div id="content-panel" class="typography">
	<article>
		<h1 class="page-title">$Title</h1>
		$Content
		$Form
	</article>
</div><!-- end content-panel div -->