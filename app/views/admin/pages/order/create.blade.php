@extends('admin.layouts.default')
@section('title')
	@parent | ایجاد سفارش جدید
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('orders')}}"> سفارش های اپیلو</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد سفارش جدید</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-lg-offset-4 col-lg-4 col-md-6 col-md-offset-2">
		<h3 class="text-center">ایجاد سفارش جدید</h3>
		@include('admin.pages.order._form')
	</div>
</div>
@stop