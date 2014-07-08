@section('content')
@include('panel.blocks.info')
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