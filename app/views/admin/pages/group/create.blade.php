@extends('admin.layouts.default')
@section('title')
	@parent | ایجاد گروه کاربری جدید
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('groups')}}"><i class="fa fa-user"></i> گروه های کاربری</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد گروه کاربری جدید</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-4 col-lg-4 col-md-6 col-md-offset-2">
		<h3 class="text-center Nassim">ایجاد گروه کاربری جدید</h3>
		@include('admin.pages.group._form')
	</div>
</div>
@stop