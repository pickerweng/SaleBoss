@extends('admin.layouts.default')
@section('title')
	@parent | {{$title}}
@stop
@section('breadcrumb')
	@parent
	<li><i class="fa fa-user"></i> سفارش ها</li>
@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('admin.pages.order._search')
    </div>
</div>
@if( ! $generatedOrders->isEmpty())
    <div class="row">
        <div class="col-sm-12">
            @if( ! $generatedOrders->isEmpty() )
                @include('admin.pages.dashboard.partials._my_orders')
            @else
                <p style="font-size: 20px;" class="text-center text-danger"><strong>جسجوی شما نتیجه ای در بر نداشت</strong></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{$generatedOrders->links()}}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 alert alert-info">
                <div class="no-result">
                    <p style="font-size:"><strong>سفارشی وجود ندارد.</strong></p>
                </div>
            </div>
        </div>
    </div>
@endif
@stop