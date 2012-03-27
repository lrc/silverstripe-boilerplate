<div id="page-header">
	<div id="img-banner">
		<% if HeaderImages %>
		<% control HeaderImages %>
		$Image.SetSize(730, 200)
		<% end_control %>
		<% else %>
		<img src="themes/default/images/default-header.jpg" alt="Default page header" width="730" height="200" />
		<% end_if %>
	</div>
</div>