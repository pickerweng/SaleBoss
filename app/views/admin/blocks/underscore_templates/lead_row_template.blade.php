<script type="text/template" class="lead-row-template">
	<tr class="injected">
		<td># <%= id %></td>
		<td class="text-center"><%= name %></td>
		<td class="text-center"><%= phones[0].number %></td>
		<td class="text-center"><%= tags[0].name %></td>
		<td><%= description %></td>
		<td class="text-center">
			<% for(p = 1; p <= ( Number(priority)); p++){ %>
				<i class="fa fa-star" style="color:#CC9900;"></i>
			<% }  %>
		</td>
		<td>
			<span class="label arrowed label-<%= getStatusClass(status) %>"><%= translated_status %></span>
		</td>
		<td><%= remind_at %></td>
		<td>
			<button
					type="button"
					class="btn btn-xs pull-left margin-right btn-danger operation-margin"
					delete-url="<%= baseUrl %>/me/leads/<%= id %>"
					onclick="Common.setDeleteURL(this,'#delete_form')"
					data-toggle="modal"
					data-target="#removeModal"><i class="fa fa-times"></i>
			</button>
			<button
            	type="button"
            	class="btn btn-xs pull-left btn-warning operation-margin"
            	id="<%= id %>"
            	name="<%= name %>"
            	tag="<%= tags[0].id %>"
            	phone="<%= phones[0].number %>"
            	status="<%= status %>"
            	remind_at="<%= remind_at %>"
            	description="<%= description %>"
            	priority="<%= priority %>"
            	update-url="<%= baseUrl %>/me/leads/<%= id %>"
            	onclick="Common.setUpdateURL(this, '#update_form',leadUpdateClosure(this))"
            	data-toggle="modal"
            	data-target="#updateModal">
            	<i class="fa fa-pencil-square-o"></i>
            </button>
         </td>
	</tr>
</script>
