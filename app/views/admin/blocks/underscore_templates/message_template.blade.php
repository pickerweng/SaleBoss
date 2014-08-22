<script class="message-template" type="text/template">
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul>
			<% _.each(errors, function(error) { %>
				<li><%= error[0] %></li>
			<% }); %>
		</ul>
	</div>
</script>
<script class="success-template" type="text/template">
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<ul>
			<li>لید شماره <%= id %> با موفقیت ایجاد شد.</li>
		</ul>
	</div>
</script>
