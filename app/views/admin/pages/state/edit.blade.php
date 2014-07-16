@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش روند کاری {{$state->name}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('states')}}"><i class="fa fa-user"></i> روندهای کار</a></li>
	<li class="active"><i class="fa fa-plus"></i> ویرایش روند کار {{$state->name}}</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-4 col-lg-4 col-md-6 col-md-offset-2">
		<h3 class="text-center">ویرایش گروه کاربری {{$state->title}}</h3>
		@include('admin.pages.state._form')
	</div>
</div>
@stop