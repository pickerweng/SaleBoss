@extends('panel.layouts.guest')
@section('content')
@if($errors->has() || Session::has('error_message'))
	<ul class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		@if($errors->has())
			@foreach($errors->all() as $error)
				<li style="font-size:12px;">{{$error}}</li>
			@endforeach
		@endif
		@if(Session::has('error_message'))
			<li style="font-size:12px;">{{Session::get('error_message')}}</li>
		@endif
	</ul>
@endif
<div id="login">
		{{Form::open(array(
			'url' => 'auth/login',
			'method' => 'post',
			'id' => 'loginform',
			'class' => 'form-vertical no-padding no-margin'
		))}}
		<div class="lock">
			<i class="icon-lock"></i>
		</div>
		<div class="control-wrap">
			<h4>ورود کاربر</h4>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-user"></i></span>
						{{Form::text('identifier',null,['placeholder' => 'شناسه کاربری', 'id' => 'input-username'])}}
					</div>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<div class="input-prepend">
						<span class="add-on"><i class="icon-key"></i></span>
						{{Form::password('password',['placeholder' => 'رمز عبور'])}}
					</div>
					<div class="mtop10">
						<div class="block-hint pull-left small">
							<label>
								{{Form::checkbox('remember_me',null)}} مرا بخاطر بسپار
							</label>
						</div>
					</div>

					<div class="clearfix space5"></div>
				</div>

			</div>
		</div>
		{{Form::submit('ورود',['id' => 'login-btn', 'class' => 'btn btn-block login-btn'])}}
	</form>
</div>
<div id="login-copyright">
	All rights reserved- SaleBoss Sale CRM
</div>
@stop