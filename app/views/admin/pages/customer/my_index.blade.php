@extends('admin.layouts.default')
@section('title')
	@parent | لیست مشتریان من
@stop
@section('breadcrumb')
	@parent
	<li><i class="fa fa-user"></i> مشتریان من</li>
@stop
@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('admin.pages.customer._search')
    </div>
</div>
@if( ! $myCustomers->isEmpty())
    <div class="row">
        <div class="col-sm-12">
            @if( ! $myCustomers->isEmpty() )
                @include('admin.pages.customer._customers')
            @else
                <p style="font-size: 20px;" class="text-center text-danger"><strong>جسجوی شما نتیجه ای در بر نداشت</strong></p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            {{$myCustomers->links()}}
        </div>
    </div>
@else
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12 alert alert-info">
                <div class="no-result">
                    <p style="font-size:"><strong>مشتری وجود ندارد.</strong></p>
                </div>
                <div class="">
                    <a href="{{URL::to('customers/create')}}" class="btn pull-left btn-danger">+ ایجاد مشتری جدید</a>
                </div>
            </div>
        </div>
    </div>
@endif
@stop