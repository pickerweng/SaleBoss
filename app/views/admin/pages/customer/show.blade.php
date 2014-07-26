@extends('admin.layouts.default')
@section('title')
	@parent | {{$title}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('customers')}}"><i class="fa fa-list"></i> مشتریان</a></li>
	<li class="active"><i class="fa fa-user"></i> مشاهده</li>
@stop
@section('content')
<div class="row">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
            <div class="well">
				@include('admin.pages.customer._show')
            </div>
        </div>
    </div>
</div>
@stop