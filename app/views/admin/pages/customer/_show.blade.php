<fieldset>
	<legend><strong>اطلاعات اولیه</strong></legend>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[first_name]', 'نام',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->first_name}}</p>
		</div>
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[last_name]', 'نام خانوادگی',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->last_name}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[email]', 'ایمیل',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->email}}</p>
		</div>
		<div class="col-md-6 col-sm-12">
			<label class="control-label">نام سازنده</label>
			<p class="form-control-static">{{Sentry::getUser()->getIdentifier()}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[tell]', 'شماره تلفن',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->tell}}</p>
		</div>
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[mobile]', 'شماره موبایل',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->mobile}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			{{Form::label('user[address]', 'آدرس',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->address}}</p>
		</div>
	</div>
</fieldset>
<br>
<fieldset>
	<legend><strong>اطلاعات تاریخ</strong></legend>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[created_at]', 'تاریخ ایجاد',['class' => 'control-label'])}}
			<p class="form-static-control">
				{{$customer->jalaliDate('created_at')}} ( {{$customer->jalaliAgoDate('created_at')}} )
			</p>
		</div>
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[updated_at]', 'تاریخ بروز رسانی',['class' => 'control-label'])}}
			<p class="form-static-control">
				{{$customer->jalaliDate('updated_at')}} ( {{$customer->jalaliAgoDate('updated_at')}} )
			</p>
		</div>
	</div>
</fieldset>
<br>
<fieldset>
	<legend><strong>اطلاعات تکمیلی</strong></legend>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[national_code]', 'شماره ملی',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->national_code}}</p>
		</div>
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[job]', 'شغل',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->job}}</p>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[connection_way]', 'نحوه آشنایی با ما',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->connection_way}}</p>
		</div>
		<div class="col-md-6 col-sm-12">
			{{Form::label('user[description]', 'توضیحات',['class' => 'control-label'])}}
			<p class="form-static-control">{{$customer->description}}</p>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-md-4 col-sm-12">
			<a href="{{URL::to('customers/' . $customer->id . '/edit')}}" class="btn btn-lg btn-block btn-info to-order-submit">ویرایش کاربر</a>
		</div>
		<div class="col-md-4 col-sm-12">
			<a href="{{URL::to('orders/create/' . $customer->id)}}" class="btn btn-lg btn-block btn-success to-order-submit">ایجاد سفارش جدید برای کاربر</a>
		</div>
		<div class="col-md-4 col-sm-12">
			<a href="{{URL::to('customers/' . $customer->id . '/orders')}}" class="btn btn-lg btn-block btn-warning to-order-submit">مشاهده سفارش های کاربر</a>
		</div>
	</div>
</fieldset>