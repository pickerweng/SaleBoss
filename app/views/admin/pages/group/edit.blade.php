@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش گروه کاربری {{$group->display_name}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('groups')}}"><i class="fa fa-user"></i> گروه های کاربری</a></li>
	<li class="active"><i class="fa fa-plus"></i> ویرایش گروه کاربری {{$group->display_name}}</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-4 col-lg-4 col-md-6 col-md-offset-2">
		<h3 class="text-center Nassim">ویرایش گروه کاربری {{$group->display_name}}</h3>
		@include('admin.pages.group._form')
	</div>
</div>
@stop