@extends('admin.layouts.default')
@section('breadcrumb')
	<li class="active"><i class="fa fa-dashboard"></i> داشبورد</li>
@stop
@section('content')
<div class="row">

	@if(empty($allOrders))
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