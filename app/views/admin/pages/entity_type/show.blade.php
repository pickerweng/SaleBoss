@extends('admin.layouts.default')
@section('title')
	@parent | مشاهده فیلدهای {{$type->display_name}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('entity_types')}}">انواع محتوا</a></li>
	<li><a href="{{URL::to('entity_types/' . $type->id)}}">{{$type->display_name}}</a></li>
	<li class="active"> مشاهده فیلدهای {{$type->display_name}}</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12">
		<h3 class="text-center">مشاهده فیلدهای {{$type->display_name}}</h3>
		@if (! $attributes->isEmpty())
		<div class="table-responsive">
			<table class="table table-responsive table-hover table-striped">
				<thead>
					<tr>
						<th># شناسه</th>
						<th>نام</td>
						<th class="languageLeft">نام ماشینی</th>
						<th class="languageLeft">نوع</th>
						<th class="languageLeft">عملیات</th>
					</tr>
				</thead>
				<tbody>
					@foreach($attributes as $attribute)
						<tr>
							<td>{{$attribute->id}}</td>
							<td>{{$attribute->display_name}}</td>
							<td class="languageLeft">{{$attribute->machine_name}}</td>
							<td class="languageLeft">{{$attribute->form_type}}</td>
							<td class="languageLeft">
								@include('admin.pages.entity_type._field_operation')
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<div class="alert alert-info row">
			<div calss="col-sm-12">
				<p>{{$type->display_name}} هنوز دارای فیلدی نمیباشد , فیلدها به صورت پویا ایجاد میشوند و میتوانید با توجه به سیستم کاری خود آنها را ایجاد نمایید.</p>
			</div>
			<div class="col-sm-12">
				<a href="{{URL::to('entity_types/' . $type->id . '/addfilds')}}" class="btn btn-danger pull-left">+ ایجاد فیلد</a>
			</div>
		</div>
		@endif
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop