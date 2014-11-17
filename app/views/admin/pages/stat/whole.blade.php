@extends('admin.layouts.default')
@section('title')
	@parent | آمار سیستم
@stop

@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-chart"></i> آمار سیستم</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12" style="padding-right: 30px;">
            <div class="well">
                    {{Form::open([
                        'method'    => 'get',
                        'url'       =>  Request::path(),
                        'class'     =>  'form-inline'
                    ])}}
                    <p>نمایش آمارها از {{Form::text('from',Input::get('period'),['class' => 'form-control', 'size' => '10', 'id' => 'time'])}}  تا {{Form::text('to',Input::get('period'),['class' => 'form-control', 'size' => '10', 'id' => 'time2'])}} <button type="submit" class="btn btn-info radius Nassim btn-sm">بروز رسانی</button></button></p>
                    {{Form::close()}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        	@include('admin.pages.stat.partials._whole')
        </div>
    </div>

@stop

@section('stylesheets')
	@parent
	<link type="text/css" rel="stylesheet" href="{{asset('assets/css/pdp.css')}}" />
@stop

@section('scripts')
	@parent
	<script type="text/javascript" src="{{asset('assets/admin/js/persianDatepicker.min.js')}}"></script>
	    <script type="text/javascript">
    		$(function() {
				$("#time, #time2").persianDatepicker({
				  cellWidth:30,
				  formatDate: "YYYY-0M-DD",
				  cellHeight:30
			  });
			});
        </script>
@stop
