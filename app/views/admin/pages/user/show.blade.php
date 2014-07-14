@extends('admin.layouts.default')

@section('title')
	@parent | مشاهده کاربر {{ $user->id}}
@stop

@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/user')}}"><i class="fa fa-user"></i> کاربران</a></li>
	<li class="active"><i class="fa fa-plus"></i>مشاهده کاربر {{$user->id}}</li>
@stop

@section('content')
<div class="row">
	<div class="col-sm-12">
		<h3 class="text-center">مشاهده{{$user->id}}</h3>
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#info" role="tab" data-toggle="tab">اطلاعات کاربر</a></li>
			<li><a href="#activity" role="tab" data-toggle="tab">فعالیت کاربر</a></li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane active" id="info">
				@include('admin.pages.user.partials._info')
			</div>
			<div class="tab-pane" id="activity">
				@include('admin.pages.user.partials._activity')
			</div>
		</div>
	</div>
</div>
@stop

@section('intro')
	@include('admin.pages.user.partials._intro')
@stop