<% include EmailHeader %>

<h1 style="color: #005A88;font-weight: normal;">$Subject</h1>
<table>
	<% if $Name %><tr><td>Name</td><td>$Name</td></tr><% end_if %>
	<% if $Phone %><tr><td>Phone</td><td>$Phone</td></tr><% end_if %>
	<% if $Email %><tr><td>Email</td><td>$Email</td></tr><% end_if %>
</table>
<p>$Message</p>

<% include EmailFooter %>