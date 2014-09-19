@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش سفارش {{$order->id}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('my/orders')}}"><i class="fa fa-list"></i> سفارش های من</a></li>
	<li class="active"><i class="fa fa-edit"></i>ویرایش</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
		<div class="well">
			<div class="row">
				<div class="col-sm-12 col-md-3 col-md-offset-9">
					<button class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#customerSummary">مشاهده مشتری</button>
				</div>
				<div class="col-lg-12">
					@include('admin.pages.order._sale_edit_form')
				</div>
			</div>
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