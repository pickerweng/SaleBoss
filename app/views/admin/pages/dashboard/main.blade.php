@extends('admin.layouts.default')
@section('breadcrumb')
	<li class="active"><i class="fa fa-dashboard"></i> داشبورد</li>
@stop
@section('content')
<div class="row" style="margin-bottom:15px;">
	@if(Sentry::getUser()->hasAnyAccess(['customers.create']))
	<div class="col-lg-4 col-md-3 col-sm-6">
		<a href="{{URL::to('my/customers')}}" class="btn btn-success btn-lg btn-block"><i class="fa fa-list"></i>     لیست مشتری های من</a>
	</div>
	@endif
	@if( Sentry::getUser()->hasAnyAccess(['customers.create']) )
	<div class="col-lg-4 col-md-3 col-sm-6">
		<a href="{{URL::to('customers/create')}}" class="btn btn-info btn-lg btn-block"><i class="fa fa-plus"></i>     ایجاد مشتری جدید</a>
	</div>
	@endif
    @if ( Sentry::getUser()->hasAnyAccess(['orders.own_create']) )
        <div class="col-lg-4 col-md-3 col-sm-6">
            <a href="{{URL::to('my/orders')}}" class="btn btn-info btn-warning btn-lg btn-block"><i class="fa fa-list"></i> لیست سفارش های من</a>
        </div>
    @endif
</div>
<div class="row">
	@if(Sentry::getUser()->hasAnyAccess(['graphs.order_graph']))
	<div class="col-lg-12">
		@include('admin.pages.dashboard.partials._orders_graph')
	</div>
	@endif
	<!--
	@if(Sentry::getUser()->hasAnyAccess(['graphs.own_chart_status_graph']))
	<div class="col-lg-4 col-md-6 col-sm-12">
		@include('admin.pages.lead.partials._status_chart')
	</div>
	@endif
	-->
	<div class="col-sm-12">
	    @include('admin.pages.dashboard.partials._my_leads')
	</div>
	@if (! $generatedUsers->isEmpty())
	<div class="col-sm-12 col-md-6 col-lg-6">
		@include('admin.pages.dashboard.partials._my_generated_users')
	</div>
	@endif

	@if (! $generatedOrders->isEmpty())
	<div class="col-sm-12 col-md-6 col-lg-6">
		@include('admin.pages.dashboard.partials._my_orders')
	</div>
	@endif

    @if(! $userQueue->isEmpty() )
        <div class="col-sm-12 col-md-6 col-lg-6">
            @include('admin.pages.dashboard.partials._user_queue')
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

@section('scripts')
	@parent
	@include('admin.pages.lead.partials._scripts')
@stop

@section('footer')
    @include('admin.blocks.delete_modal')
    @include('admin.blocks.update_modal')
    @parent
@stop
