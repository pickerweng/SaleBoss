@section('content')
@include('panel.blocks.info')
<div id="login">
	{{Form::open(array(
	'url' => 'auth/register',
	'method' => 'post',
	'id' => 'loginform',
	'class' => 'form-vertical no-padding no-margin'
	))}}
	<div class="lock">
		<i class="icon-lock"></i>
	</div>
	<div class="control-wrap">
		<h4>ثبت نام</h4>
		<div class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					{{Form::text('email',null,['placeholder' => 'ایمیل', 'id' => 'input-username'])}}
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					{{Form::text('first_name',null,['placeholder' => 'نام', 'id' => ''])}}
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					{{Form::text('last_name',null,['placeholder' => 'نام خانوادگی', 'id' => ''])}}
				</div>
			</div>
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i></span>
					{{Form::text('mobile',null,['placeholder' => 'شماره تماس', 'id' => ''])}}
				</div>
			</div>
		</div>
		<br>
		<div class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on"><i class="icon-key"></i></span>
					{{Form::password('password',['placeholder' => 'رمز عبور'])}}
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-key"></i></span>
					{{Form::password('password_confirmation',['placeholder' => 'تایید رمز عبور'])}}
				</div>
				<div class="clearfix space5"></div>
			</div>

		</div>
	</div>
	{{Form::submit('ثبت نام',['id' => 'login-btn', 'class' => 'btn btn-block login-btn'])}}
	</form>
</div>
<div id="login-copyright">
	All rights reserved- SaleBoss Sale CRM
</div>
@stop