@extends('admin.layouts.default')
@section('title')
	@parent | لیست لیدهای من
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-list"></i> لیدهای من</li>
@stop

@section('intro')

@stop

@section('content')
	@include('admin.pages.lead.partials._message')
	@include('admin.pages.lead.my_list')
@stop

@section('scripts')
	@parent
	@include('admin.pages.lead.partials._scripts')
@stop

