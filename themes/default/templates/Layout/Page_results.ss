<div id="content" class="typography wide">
	<h1 class="page-title">$Title</h1>
	$SearchForm
	<% if Results %>
    <% control Results %>
	<article>
		<h1><a href="$Link" title="Read more about $Title.XML"><% if MenuTitle %>$MenuTitle<% else %>$Title<% end_if %></a></h1>
		<p>$Content.LimitWordCount</p>
		<a class="more" href="$Link" title="Read more about &quot;{$Title}&quot;">Read more about &quot;{$Title}&quot;...</a>
	</article>
	<% end_control %>
    <% else %>
    <p>Sorry, your search query did not return any results.</p>
    <% end_if %>

    <% if Results.MoreThanOnePage %>
    <div id="PageNumbers">
        <% if Results.NotLastPage %>
        <a class="next" href="$Results.NextLink" title="View the next page">Next</a>
        <% end_if %>
        <% if Results.NotFirstPage %>
        <a class="prev" href="$Results.PrevLink" title="View the previous page">Prev</a>
        <% end_if %>
        <span>
            <% control Results.Pages %>
                <% if CurrentBool %>
                $PageNum
                <% else %>
                <a href="$Link" title="View page number $PageNum">$PageNum</a>
                <% end_if %>
            <% end_control %>
        </span>
        <p>Page $Results.CurrentPage of $Results.TotalPages</p>
    </div>
    <% end_if %>
</div>