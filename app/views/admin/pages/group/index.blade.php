@extends('admin.layouts.default')
@section('title')
	@parent | لیست گروه ها
@stop
@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-plus"></i> لیست گروه های کاربری</li>
@stop
@section('content')
<div class="row">
	<h4 class="text-center" style="margin-top: 10px">لیست گروه های کاربری</h4><br>
	<a class="btn btn-info" href="{{URL::to('groups/create')}}">+ ایجاد گروه کاربری</a>
	<div class="col-md-6 col-md-offset-3 col-sm-12">
		<div class="table-responsive">
			<table class="table table-hover table-bordered table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th class="languageLeft">نام</th>
						<th>نام فارسی</th>
						<th class="languageLeft">عملیات</th>
					</tr>
				</thead>
				<tbody>
					@foreach($groups as $group)
						<tr>
							<td>{{$group->id}}</td>
							<td class="languageLeft">{{$group->name}}</td>
							<td>{{$group->display_name}}</td>
							<td>@include('admin.pages.group._operation')</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop