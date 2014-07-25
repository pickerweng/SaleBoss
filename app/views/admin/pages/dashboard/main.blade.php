@extends('admin.layouts.default')
@section('breadcrumb')
	<li class="active"><i class="fa fa-dashboard"></i> داشبورد</li>
@stop
@section('content')
<div class="row" style="margin-bottom:15px;">
	@if(Sentry::getUser()->hasAnyAccess(['orders.create']))
	<div class="col-lg-6 col-md-6 col-sm-6">
		<a href="{{URL::to('orders/create')}}" class="btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i>     ایجاد سفارش جدید</a>
	</div>
	@endif
	@if( Sentry::getUser()->hasAnyAccess(['customers.create']) )
	<div class="col-lg-6 col-md-6 col-sm-6">
		<a href="{{URL::to('customers/create')}}" class="btn btn-info btn-lg btn-block"><i class="fa fa-plus"></i>     ایجاد مشتری جدید</a>
	</div>
	@endif
</div>
<div class="row">
	@if(Sentry::getUser()->hasAnyAccess(['graphs.order_graph']))
	<div class="col-lg-12">
		@include('admin.pages.dashboard.partials._orders_graph')
	</div>
	@endif

	@if ( ! empty($userQueue))
	<div class="col-sm-12 col-md-6 col-lg-4">
			@include('admin.pages.dashboard.partials._user_queue')
	</div>
	@endif

	@if (! $generatedUsers->isEmpty())
	<div class="col-sm-12 col-md-6 col-lg-4">
		@include('admin.pages.dashboard.partials._my_generated_users')
	</div>
	@endif

	@if (! $generatedOrders->isEmpty())
	<div class="col-sm-12 col-md-6 col-lg-4">
		@include('admin.pages.dashboard.partials._my_orders')
	</div>
	@endif
	<div class="col-sm-12 col-md-6 col-lg-12">
		@include('admin.pages.dashboard.partials._my_graph')
	</div>

	<div class="col-sm-12 col-md-6 col-lg-12">
		@include('admin.pages.dashboard.partials._last_users')
	</div>
	<div class="col-sm-12 col-md-6 col-lg-12">
		@include('admin.pages.dashboard.partials._open_orders')
	</div>
</div>
@stop