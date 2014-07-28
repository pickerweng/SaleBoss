@extends('admin.layouts.default')
@section('title')
	@parent | {{$title}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('orders')}}"><i class="fa fa-list"></i> سفارش ها</a></li>
	<li class="active"><i class="fa fa-user"></i> مشاهده</li>
@stop
@section('content')
<div class="row">
        <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <div class="well">
				@include('admin.pages.order._show')

                @if(Sentry::getUser()->hasAnyAccess(['orders.accounter_approve']))
	                @if($order->completed)
	                    این سفارش تکمیل شده است
	                @elseif($order->state->priority == 2)
	                    <h3 class="text-center">تایید حسابداری</h3>
	                    @include('admin.pages.order._accounter_form')
	                @endif
                @endif
				<br>
	            @if(Sentry::getUser()->hasAnyAccess(['orders.support']))
	                @if($order->state->priority == 3)
	                    <h3 class="text-center">تایید پشتیبانی</h3>
	                    @include('admin.pages.order._support_form')
	                @endif
	            @endif

				@if(Sentry::getUser()->hasAnyAccess(['orders.suspend']))
	                @include('admin.pages.order._suspend_form')
	            @endif
                <br>
                <button class="btn btn-info btn-block" data-toggle="modal" data-target="#customerSummary">مشاهده مشتری</button>
            </div>
        </div>
</div>
<div class="modal fade" id="customerSummary" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">مشاهده مشتری {{$customer->name()}}</h4>
            </div>
            <div class="modal-body">
                <div class="well">
                    @include('admin.pages.customer._show')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
@stop