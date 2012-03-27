<div id="content-panel" class="typography narrow">    
        $Content
</div><!-- end content-panel div -->

<% if LatestNews %>
<div id="news-panel" class="typography">
    <h2>Latest Articles</h2>
    <ul>
	<% control LatestNews %>
        <li><a href="$Link" title="Read full article">$Title</a><br/><span class="date">$Date.Nice</span></li>
        <% end_control %>
    </ul>
</div>
<% end_if %>