@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/user')}}"><i class="fa fa-user"></i> کاربران</a></li>
	@if(empty($update))
	<li class="active"><i class="fa fa-plus"></i> ایجاد</li>
	@else
	<li class="active"><i class="fa fa-edit"></i> ویرایش</li>
	@endif
@stop
@section('content')
<div class="row">
	<div class="col-lg-6">
		@if(!empty($update))
		{{Form::open(array('url' => 'admin/user/' . $user->id ,'method' => 'put','id' => 'update_user_form'))}}
		@else
		{{Form::open(array('url' => 'admin/user','method' => 'post','id' => 'create_user_form'))}}
		@endif
			<div class="form-group">
				{{Form::label('user[email]','ایمیل کاربر')}}
				{{Form::text(
					'user[email]',
					(!empty($user)?$user->email:false),
					array('placeholder' => 'example@email.com','class' => 'form-control languageLeft')
				)}}
			</div>

			<div class="form-group">
				{{Form::label('user[username]','نام کاربری')}}
				{{Form::text(
					'user[username]',
					(!empty($user)?$user->username:false),
					array('placeholder' => 'username','class' => 'form-control languageLeft')
				)}}
			</div>

			<div class="form-group">
				{{Form::label('user[first_name]','نام')}}
				{{Form::text(
					'user[first_name]',
					(!empty($user)?$user->first_name:false),
					array('placeholder' => 'رضا','class' => 'form-control')
				)}}
			</div>

			<div class="form-group">
				{{Form::label('user[last_name]','نام خانوادگی')}}
				{{Form::text(
					'user[last_name]',
					(!empty($user)?$user->last_name:false),
					array('placeholder' => 'فدایی','class' => 'form-control')
				)}}
			</div>

			<div class="form-group">
				{{Form::label('user[password]','رمز عبور (حداقل 6 کارکتر)')}}
				{{Form::password(
					'user[password]',
					array('placeholder' => 'password','class' => 'form-control languageLeft')
				)}}
				{{Form::label('user[password_confirmation]','تایید رمز عبور')}}
				{{Form::password(
					'user[password_confirmation]',
					array('class' => 'form-control languageLeft')
				)}}
			</div>

			<div class="checkbox">
				<label>
					کاربر فعال {{Form::checkbox('user[active]','1',(!empty($user)?$user->active:false))}}
				</label>
			</div>

			{{Form::label('user[roles][]','نقش های کاربری')}}
			{{Form::select(
				'user[roles][]',
				\Helpers\Common::selectArray($roles,array('id','name')),
				(!empty($user)?\Helpers\Common::selectEnabledList($user->roles,'id'):null),
				array('multiple' => true,'class'	=> 'form-control')
			)}}

			<div class="btn-group pull-left" style="margin-top:20px;">
				<a href="{{URL::to('admin/user')}}" class="btn btn-warning">{{Lang::get('strings.cancel')}}</a>
				<button type="submit" class="btn btn-success form-submit"><?php print (!empty($update)?Lang::get('strings.edit'):Lang::get('strings.create'))?></button>
			</div>

		{{Form::close()}}
	</div>
</div>
@stop