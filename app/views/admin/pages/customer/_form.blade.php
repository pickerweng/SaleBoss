<div class="well">
    {{Form::open([
        'url' => empty($update) ? 'customers' : "customers/{$customer->id}" ,
        'method' => empty($update) ? 'post' : 'put',
        'class' => 'pretty-form customer-form'
    ])}}
        @if(empty($update))
            {{Form::hidden('to_orders',null,['class' => 'to-order'])}}
        @endif
        <fieldset>
            <legend><strong>اطلاعات اولیه</strong></legend>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[first_name]', 'نام',['class' => 'control-label'])}}
                    {{Form::text('user[first_name]',empty($update) ? null : $customer->first_name,['class' => 'form-control' , 'placeholder' => 'مثال: علی'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[last_name]', 'نام خانوادگی',['class' => 'control-label'])}}
                    {{Form::text('user[last_name]',empty($update) ? null : $customer->last_name,['class' => 'form-control' , 'placeholder' => 'مثال: محمدی'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[email]', 'ایمیل',['class' => 'control-label'])}}
                    {{Form::text('user[email]',empty($update) ? null : $customer->email,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: ali.mohammadi@yahoo.com'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="control-label">نام سازنده</label>
                    <p class="form-control-static">
	                    @if(empty($customer->creator_id))
	                        {{Sentry::getUser()->getIdentifier()}}
	                    @else
	                        {{$customer->creator->getIdentifier()}}
	                    @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('u
	                ser[tell]', 'شماره تلفن',['class' => 'control-label'])}}
                    {{Form::text('user[tell]',empty($update) ? null : $customer->tell,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 22327800'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[mobile]', 'شماره موبایل',['class' => 'control-label'])}}
                    {{Form::text('user[mobile]',empty($update) ? null : $customer->mobile,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 09124052061'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{Form::label('user[address]', 'آدرس',['class' => 'control-label'])}}
                    {{Form::text('user[address]',empty($update) ? null : $customer->address,['class' => 'form-control', 'placeholder' => 'مثال: تهران بزرگراه رسالت غرب به شرق بعد از پل بزرگراه صیاد شیرازی نبش ...'])}}
                </div>
            </div>
        </fieldset>
        <br>
        <br>
        <fieldset>
            <legend><strong>اطلاعات تکمیلی</strong></legend>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[national_code]', 'شماره ملی',['class' => 'control-label'])}}
                    {{Form::text('user[national_code]',empty($update) ? null : $customer->national_code,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 0015617329'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[job]', 'شغل',['class' => 'control-label'])}}
                    {{Form::text('user[job]',empty($update) ? null : $customer->job,['class' => 'form-control' , 'placeholder' => 'مثال: املاکی'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[connection_way]', 'نحوه آشنایی با ما',['class' => 'control-label'])}}
                    {{Form::select('user[connection_way]',Config::get('connection_types'),null,['class' => 'form-control'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('user[description]', 'توضیحات',['class' => 'control-label'])}}
                    {{Form::textarea('user[description]',empty($update) ? null : $customer->description,['class' => 'form-control'])}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    @if(empty($update))
                        <button type="button" class="btn btn-lg btn-block btn-info to-order-submit">+ ثبت نام مشتری و ایجاد سفارش</button>
                    @else
                        <!--a href="{{URL::to('customer/' . $customer->id . '/orders')}}" class="btn btn-lg btn-block btn-info to-order-submit">مشاهده سفارش های مشتری</a-->
                    @endif
                </div>
                <div class="col-md-6 col-sm-12">
                    <button type="submit" class="btn btn-lg btn-block btn-warning customer-form-submit">
                        @if(empty($update))
                            + ثبت نام مشتری و ایجاد مشتری دیگر
                        @else
                            ثبت تغییرات
                        @endif
                    </button>
                </div>
            </div>
        </fieldset>
    {{Form::close()}}
</div>