<div>
    {{Form::open([
    'url' => "orders/sale/{$order->id}",
    'method' => 'put',
    'class' => 'pretty-form order-form'
    ])}}
    <fieldset>
        <legend><strong>اطلاعات سفارش</strong></legend>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('panel_type', 'نوع پنل ',['class' => 'control-label'])}}
                    {{Form::select('panel_type',$opiloConfig['panel_types'] ,$order->panel_type,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('private_number', 'شماره خط اختصاصی',['class' => 'control-label'])}}
                    {{Form::text('private_number',$order->private_number,['class' => 'form-control languageLeft'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_price', '(تومان)قیمت هر پیامک',['class' => 'control-label'])}}
                    {{Form::text('sms_price',$order->sms_price,['class' => 'form-control languageLeft'])}}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_quantity', 'تعداد پیامک',['class' => 'control-label'])}}
                    {{Form::text('sms_quantity',$order->sms_quantity,['class' => 'form-control languageLeft'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_text', 'متن پیامک',['class' => 'control-label'])}}
                    {{Form::textarea('sms_text',$order->sms_text,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_description', 'توضیحات پیامک',['class' => 'control-label'])}}
                    {{Form::textarea('sms_description',$order->sms_description,['class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('payment_type', 'نوع پرداخت',['class' => 'control-label'])}}
                    {{Form::select('payment_type',$opiloConfig['payment_types'],$order->payment_type ,['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('cart_number', 'شماره کارت',['class' => 'control-label'])}}
                    {{Form::text('cart_number',$order->cart_number ,['class' => 'form-control languageLeft'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label class="control-label">مرحله بعدی سفارش</label>
                <p class="form-control-static">
                    @if(! empty($order->accounter_approved))
                        صف پشتیبانی
                    @else
                        صف حسابداری
                    @endif
                </p>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('panel_price', 'مبلغ پنل به تومان',['class' => 'control-label'])}}
                    {{Form::text('panel_price',$order->panel_price ,['class' => 'form-control languageLeft'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    {{Form::label('description', 'توضیحات',['class' => 'control-label'])}}
                    {{Form::textarea('description',$order->description ,['class' => 'form-control'])}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    {{Form::label('last_edit', 'آخرین ویرایش',['class' => 'control-label'])}}
                    <p class="form-control-static">
                        این سفارش آخرین بار توسط {{$lastEdited->changer->getIdentifier()}} ویرایش شده.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                @if($order->accounter_approved)
                    <button type="submit" class="btn btn-lg btn-block btn-info">ثبت سفارش و ارسال به پشتیبانی</button>
                @else
                    <button type="submit" class="btn btn-lg btn-block btn-info">ثبت سفارش و ارسال به حسابدار</button>
                @endif
            </div>
        </div>
    </fieldset>
    {{Form::close()}}
</div>