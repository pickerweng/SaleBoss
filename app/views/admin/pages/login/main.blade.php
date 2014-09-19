@extends('admin.layouts.guest')
@section('content')
<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
    <div class="panel panel-info" style="border:5px solid white;" >
        <div class="panel-heading">
            <div class="panel-title">ورود</div>
            <!--<div style="float:right; font-size: 80%; position: relative; top:-15px;text-align:left;float:left;"><a href="#">فراموشی رمز عبور</a></div>-->
        </div>
        <div style="padding-top:30px" class="panel-body" >
            @include('admin.blocks.messages')
            <form id="loginform" class="form-horizontal" method="post" action="{{URL::to('auth/login')}}" role="form">
                @if(Input::get('redirect'))
                    {{Form::hidden('redirect',Input::get('redirect'))}}
                @endif
                <div style="margin-bottom: 25px" class="input-group {{($errors->has('identifier')?'has-error':'')}}">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input id="login-username" type="text" class="form-control dir-ltr text-left" name="identifier" value="" placeholder="ایمیل">
                </div>
                <div style="margin-bottom: 25px" class="input-group {{($errors->has('password')?'has-error':'')}}">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input id="login-password" type="password" class="form-control dir-ltr text-left" name="password" placeholder="پسورد">
                </div>
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1">مرا به خاطر بیار
                        </label>
                    </div>
                </div>
                <div style="margin-top:10px" class="form-group">
                    <div class="col-sm-12 controls">
                        <button id="btn-login" type="submit" class="btn btn-success btn-block">ورود  </button>
                    </div>
                </div>
                <p class="authors" style="text-align:center;">
                    طراحی و توسعه توسط <a href="http://opilo.com" target="_blank">اپیلو</a></p>
            </form>
        </div>
    </div>
</div>
@stop