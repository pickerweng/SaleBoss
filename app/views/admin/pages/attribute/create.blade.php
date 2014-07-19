@extends('admin.layouts.default')
@section('title')
	@parent | ایجاد فیلد برای {{$type->display_name}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('entity_types')}}"> انواع محتوا</a></li>
	<li><a href="{{URL::to('entity_types/' . $type->id)}}"> فیلدهای {{$type->display_name}}</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد فیلد</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-4 col-lg-4 col-md-6 col-md-offset-2">
		<h3 class="text-center">ایجاد فیلد برای {{$type->display_name}}</h3>
		@include('admin.pages.attribute._form')
	</div>
</div>
@stop