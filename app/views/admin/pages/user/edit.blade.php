@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش کاربر{{ $user->id}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/user')}}"><i class="fa fa-user"></i> کاربران</a></li>
	<li class="active"><i class="fa fa-plus"></i> ویرایش کاربر {{$user->id}}</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-3 col-lg-6 col-md-6">
		<h3 class="text-center">ویرایش کاربر{{$user->id}}</h3>
		@include('admin.pages.user.partials._form')
		@include('admin.blocks.delete_modal')
	</div>
</div>
@stop