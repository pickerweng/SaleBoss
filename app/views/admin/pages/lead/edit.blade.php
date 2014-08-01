@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش لید {{$lead->phone_number}}
@stop
@section('breadcrumb')
	@parent
	<li class="active"><a href="{{URL::to('leads')}}"><i class="fa fa-list"></i> لیدها</a></li>
    <li class="active"><i class="fa fa-edit"></i> ویرایش</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-6 col-md-offset-6 col-lg-4 col-lg-offset-4">
        @include('admin.pages.lead.partials._edit_form')
	</div>
</div>
@stop