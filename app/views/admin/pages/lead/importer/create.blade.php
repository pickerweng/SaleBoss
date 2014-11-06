@extends('admin.layouts.default')
@section('title')
	@parent | آپلود لید
@stop
@section('breadcrumb')
	@parent
	<li class="active"><a href="{{URL::to('leads')}}"><i class="fa fa-list"></i> لیدها</a></li>
    <li class="active"><i class="fa fa-plus"></i>آپلود لید</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-8 col-lg-offset-2">
        <div class="well">
            <div class="row">
                {{Form::open([
                    'method'    =>  'post',
                    'url'       =>  'leads/bulk',
                    'files'     =>  'true'
                ])}}
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            {{Form::file('file')}}
                        </div>
                        <div class="col-lg-3">
                            {{Form::select('user_id',SaleBoss\Models\User::getUserList(),0,['class' => 'form-control stable'])}}
                            انتخاب کاربر در داخل فایل {{Form::checkbox('user_local', true);}}
                        </div>
                    </div>
                        <p class="help-block">حجم فایل باید کمتر از 4000 کیلوبایت باشد و تنها فرمت های xls, xlsx وcsv قابل قبول هستند.</p>
                    </div>
                    <div class="col-lg-12">
                        <br>
                        {{Form::submit('ارسال',['class' => 'btn btn-success'])}}
                    </div>
                {{Form::close()}}
            </div>
        </div>
	</div>
</div>
@stop