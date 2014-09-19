@extends('admin.layouts.default')
@section('title')
	@parent | ایجاد کاربر جدید
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('users')}}"><i class="fa fa-user"></i> کاربران</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-3 col-md-offset-3 col-lg-6 col-md-6" col-md-offset-3>
		<h3 class="text-center">ایجاد کاربر جدید</h3>
		@include('admin.pages.user.partials._form')
	</div>
</div>
@stop