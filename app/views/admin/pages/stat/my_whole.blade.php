@extends('admin.layouts.default')
@section('title')
	@parent | آمار سیستم کاربر  {{$user->id}}
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
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-12">
            <p class="text-center">نمایش آمار مربوط به {{$user->getIdentifier()}}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        	@include('admin.pages.stat.partials._my_whole')
        </div>
    </div>
@stop

