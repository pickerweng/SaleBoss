@extends('admin.layouts.default')
@section('title')
@parent | لیست مشتریان من
@stop
@section('breadcrumb')
@parent
<li><i class="fa fa-user"></i> مشتریان من</li>
@stop
@section('content')
@if( ! $generatedOrders->isEmpty() || ! empty(Input::all()))
<!--div class="row">
    <div class="col-sm-12">
        @include('admin.pages.customer._search')
    </div>
</div-->
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
                <p style="font-size:"><strong>شما هنوز سفارشی ایجاد نکرده اید..</strong></p>
            </div>
            <div class="">
                <a href="{{URL::to('customers/create')}}" class="btn pull-left btn-danger">+ ایجاد سفارش جدید</a>
            </div>
        </div>
    </div>
</div>
@endif
@stop