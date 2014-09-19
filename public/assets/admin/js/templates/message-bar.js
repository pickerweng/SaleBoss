<div class="alert alert-danger">
    <ul>
        <% _.each(errors, function(error) { %>
            <li><%= error[0] %></li>
        <% }); %>
    </ul>
</div>