@extends('admin.layouts.default')
@section('title')
	@parent | لیست محتوا
@stop
@section('breadcrumb')
	@parent
	<li class="active"> انواع محتوا</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h3 class="text-center">مشاهده انواع محتوا</h3>
		@if (! $entityTypes->isEmpty())
		<div class="table-responsive">
			<table class="table table-responsive table-hover table-striped">
				<thead>
					<tr>
						<th># شناسه</th>
						<th>نام</td>
						<th class="languageLeft">نام ماشینی</th>
						<th class="languageLeft">عملیات</th>
					</tr>
				</thead>
				<tbody>
					@foreach($entityTypes as $type)
						<tr>
							<td>{{$type->id}}</td>
							<td>{{$type->display_name}}</td>
							<td class="languageLeft">{{$type->machine_name}}</td>
							<td class="languageLeft">
								@include("admin.pages.entity_type._operation")
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<div class="alert alert-danger">
			<div calss="col-sm-12">
				<p>سیستم شما دارای نوع محتوا نمیباشد.</p>
			</div>
		</div>
		@endif
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop