<% if Menu(2) %>
<div id="section-panel">
    <nav id="nav-section">
        <ul>
            <% control Menu(2) %>
            <li class="$LinkingMode">
                    <a href="$Link" title="Go to the $Title.XML page">$MenuTitle.XML</a>
                    <% if Children && isSection %>
                    <ul>
                        <% control Children %>
                        <li class="$LinkingMode">
                                <a href="$Link" title="Go to the $Title.XML page">$MenuTitle.XML</a>
                                <% if Children && isSection %>
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
    </nav>
</div><!-- end section-panel div -->
<% end_if %>
