<div>
    <fieldset>
        <legend>
            <strong>
                اطلاعات سفارش
            </strong>
            @if($order->suspended)
                <label class="label label-danger pull-left">معلق</label>
            @endif
            @if($order->completed)
                <label class="label label-sm label-success pull-left">تکمیل شده</label>
            @endif
            <label class="label label-xs label-info pull-left">{{$order->state->title}}</label>
        </legend>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('panel_type', 'نوع پنل ',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$opiloConfig['panel_types'][$order->panel_type]}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('private_number', 'شماره خط اختصاصی',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$order->private_number}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_price', 'قیمت هر پیامک به تومان',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$order->sms_price}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_quantity', 'تعداد پیامک',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$order->sms_quantity}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_text', 'متن پیامک',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$order->sms_text}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('sms_description', 'توضیحات پیامک',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$order->sms_description}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('payment_type', 'نوع پرداخت',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$opiloConfig['payment_types'][$order->payment_type]}}</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('cart_number', 'شماره کارت',['class' => 'control-label'])}}
                    <p class="form-static-control">{{$order->cart_number}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <label class="control-label">مرحله سفارش</label>
                <p class="form-control-static">{{$order->state->title}}</p>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    {{Form::label('panel_price', 'مبلغ پنل به تومان',['class' => 'control-label'])}}
                    <p class="form-control-static">{{$order->panel_price}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <br>
                    {{Form::label('last_edit', 'آخرین ویرایش',['class' => 'control-label'])}}
                    <p class="form-control-static">
                        این سفارش آخرین بار توسط {{$lastEdited->changer->getIdentifier()}} ویرایش شده.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    {{Form::label('description', 'توضیحات',['class' => 'control-label'])}}
                    <p class="form-control-static">{{$order->description}}</p>
                </div>
            </div>
        </div>
    </fieldset>
</div>