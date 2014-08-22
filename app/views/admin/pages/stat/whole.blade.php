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
        <div class="col-lg-12">
            <div class="well">
                    {{Form::open([
                        'method'    => 'get',
                        'url'       =>  Request::path(),
                        'class'     =>  'form-inline'
                    ])}}
                    <p>نمایش آمارها تا {{Form::text('period',Input::get('period'),['class' => 'form-control', 'size' => '5'])}}  روز قبل <button type="submit" class="btn btn-info">بروز رسانی</button></button></p>
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

