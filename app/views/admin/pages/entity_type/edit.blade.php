@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش {{$entityType->display_name}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('entity_types')}}"><i class="fa fa-user"></i> انواع محتوا</a></li>
	<li class="active"><i class="fa fa-plus"></i> ویرایش {{$entityType->display_name}}</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-4 col-lg-4 col-md-6 col-md-offset-2">
		<h3 class="text-center">ویرایش  {{$entityType->display_name}}</h3>
		@include('admin.pages.entity_type._form')
	</div>
</div>
@stop