<% if IncludeFormTag %>
<form $FormAttributes class="clearfix">
<% end_if %>
	<% if Message %>
	<p id="{$FormName}_error" class="message $MessageType">$Message</p>
	<% end_if %>


	<% control Fields %>
	<% if IsComposite %>
	<div class="row text">
		<% control FieldSet %>
		<div id="$Name" class="column-{$Pos}<% if Message %> error<% end_if %>">
			<label class="left" for="$ID">$Title</label>
			$Field
		</div>
		<% end_control %>
	</div>
	<% else_if Dataless %>
	$Field
	<% else_if IsHidden %>
	$Field
	<% else %>
	<% if IsCheckbox %>
	<div id="$Name" class="row text checkbox<% if Message %> error<% end_if %>">
		$Field <label class="left" for="$ID">$Title</label>
	</div>
	<% else %>
	<div id="$Name" class="row text<% if Message %> error<% end_if %>">
		<label class="left" for="$ID">$Title</label>
		$Field
	</div>
	<% end_if %>
	<% end_if %>
	<% end_control %>

	<% if Actions %>
	<div class="Actions">
		<span class="required-row">* Required rows</span>
		<% if SiteConfig.PrivacyPolicy %>
		<a href="$SiteConfig.PrivacyPolicy.Link" title="Privacy Policy" class="privacy-policy">Privacy Policy</a>
		<% end_if %>
		<% control Actions %>$Field<% end_control %>
	</div>


	<% end_if %>
<% if IncludeFormTag %>
</form>
<% end_if %>
