@extends('admin.layouts.default')
@section('title')
	@parent | لیست لیدهای من
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-list"></i>لیدهای من</li>
@stop

@section('intro')

@stop

@section('content')
	<div class="row">
		<div class="lead-store-messages col-lg-12">

        </div>
	</div>
	@include('admin.pages.lead.my_list')
@stop

@section('scripts')
	@parent
	<script src="{{asset('assets/admin/js/underscore-min.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/admin/js/saleboss.js')}}" type="text/javascript"></script>
	<script src="{{asset('assets/admin/js/leads.js')}}" type="text/javascript"></script>
	<script type="text/javascript">
		var baseUrl = "{{URL::to('/')}}";
	</script>
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
	<script type="text/template" class="lead-row-template">
		<tr class="injected">
			<td># <%= id %></td>
			<td class="text-center"><%= name %></td>
			<td class="text-center"><%= phones[0].number %></td>
			<td class="text-center"><%= tags[0].name %></td>
			<td><%= description %></td>
			<td class="text-center">
				<% for(p=1; p <= ( Number(priority) + 1); p++){ %>
					<i class="fa fa-star"></i>
				<% }  %>
			</td>
			<td>
				<span class="label label-<%= getStatusClass(status) %>"><%= translated_status %></span>
			</td>
			<td><%= remind_at %></td>
			<td>
				<button
						type="button"
						class="btn btn-xs pull-left margin-right btn-danger"
						delete-url="<%= baseUrl %>/me/leads/<%= id %>"
						onclick="Common.setDeleteURL(this,'#delete_form')"
						data-toggle="modal"
						data-target="#removeModal"><i class="fa fa-times"></i>
				</button>
             </td>
		</tr>
	</script>
@stop

