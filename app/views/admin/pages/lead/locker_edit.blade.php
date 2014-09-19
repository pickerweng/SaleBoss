@extends('admin.layouts.default')
@section('title')
	@parent | {{$title}}
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('leads')}}"><i class="fa fa-list"></i> لیدها</a></li>
	<li class="active"><i class="fa fa-edit"></i> بروزرسانی لید</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-4 col-lg-offset-4 col-sm-12 col-md-4 col-md-offset-4">
        @include('admin.pages.lead.partials._locker_edit_form')
	</div>
</div>
@stop