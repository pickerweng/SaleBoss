@extends('admin.layouts.default')

@section('title')
	@parent | گزارش کاربران
@stop

@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/user')}}"><i class="fa fa-user"></i> کاربران</a></li>
	<li class="active"><i class="fa fa-plus"></i> گزارش کاربران</li>
@stop

@section('content')
<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-clock-o"></i> آخرین فعالیت های کاربری</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<a href="#" class="list-group-item">
						<span class="badge">10 دقیقه پیش</span>
						کاربر جدیدی توسط علی رضا ایجاد شد.
					</a>
					<a href="#" class="list-group-item">
						<span class="badge">15 دقیقه پیش</span>
						کاربر جدیدی توسط رضا ایجاد شد..
					</a>
				</div>
				<div class="text-left">
					<a href="{{URL::to('notifications')}}">مشاهده همه فعالیت ها <i class="fa fa-arrow-circle-left"></i></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">

	</div>

	<div class="col-lg-4">

	</div>
</div>
@stop

@section('intro')
	@include('admin.pages.user.partials._intro')
@stop