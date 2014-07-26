<div>
    {{Form::open([
        'url' => "orders/sale/{$customer->id}",
        'method' => 'POST',
        'class' => 'pretty-form order-form'
    ])}}
        <fieldset>
            <legend><strong>اطلاعات سفارش</strong></legend>
            <div class="row">
                <div class="col-md-6 col-sm-12">
		            <div class="form-group">
			            {{Form::label('order[panel_type]', 'نوع پنل ',['class' => 'control-label'])}}
			            {{Form::select('order[panel_type]',$opiloConfig['panel_types'] ,null,['class' => 'form-control'])}}
		            </div>
	            </div>
	            <div class="col-md-6 col-sm-12">
		            <div class="form-group">
			            {{Form::label('order[private_number]', 'شماره خط اختصاصی',['class' => 'control-label'])}}
			            {{Form::text('order[private_number]',null,['class' => 'form-control languageLeft'])}}
		            </div>
	            </div>
            </div>
	        <div class="row">
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[sms_price]', 'قیمت هر پیامک',['class' => 'control-label'])}}
				        {{Form::text('order[sms_price]',null,['class' => 'form-control languageLeft'])}}
			        </div>
		        </div>
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[sms_quantity]', 'تعداد پیامک',['class' => 'control-label'])}}
				        {{Form::text('order[sms_quantity]',null,['class' => 'form-control languageLeft'])}}
			        </div>
		        </div>
	        </div>
	        <div class="row">
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[sms_text]', 'متن پیامک',['class' => 'control-label'])}}
				        {{Form::textarea('order[sms_text]',null,['class' => 'form-control'])}}
			        </div>
		        </div>
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[sms_description]', 'توضیحات پیامک',['class' => 'control-label'])}}
				        {{Form::textarea('order[sms_description]',null,['class' => 'form-control'])}}
			        </div>
		        </div>
	        </div>
	        <div class="row">
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[payment_type]', 'نوع پرداخت',['class' => 'control-label'])}}
				        {{Form::select('order[payment_type]',$opiloConfig['payment_types'],null ,['class' => 'form-control'])}}
			        </div>
		        </div>
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[cart_number]', 'شماره کارت',['class' => 'control-label'])}}
				        {{Form::text('order[cart_number]',null ,['class' => 'form-control languageLeft'])}}
			        </div>
		        </div>
	        </div>
	        <div class="row">
		        <div class="col-md-6 col-sm-12">
					<label class="control-label">مرحله بعدی سفارش</label>
			        <p class="form-control-static">صف حسابدار</p>
		        </div>
		        <div class="col-md-6 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[panel_price]', 'مبلغ پنل',['class' => 'control-label'])}}
				        {{Form::text('order[panel_price]',null ,['class' => 'form-control languageLeft'])}}
			        </div>
		        </div>
	        </div>
	        <div class="row">
		        <div class="col-md-12 col-sm-12">
			        <div class="form-group">
				        {{Form::label('order[description]', 'توضیحات',['class' => 'control-label'])}}
				        {{Form::textarea('order[description]',null ,['class' => 'form-control'])}}
			        </div>
		        </div>
	        </div>
	        <div class="row">
		        <div class="col-sm-12">
			        <button type="submit" class="btn btn-lg btn-block btn-info">ثبت سفارش و ارسال به حسابدار</button>
		        </div>
	        </div>
        </fieldset>
    {{Form::close()}}
</div>