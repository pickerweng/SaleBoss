<div class="well">
    {{Form::open([
        'url' => "me/edit",
        'method' => 'put',
        'class' => 'pretty-form customer-form'
    ])}}
        <fieldset>
            <legend><strong>اطلاعات کاربری من</strong></legend>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[first_name]', 'نام',['class' => 'control-label'])}}
                    {{Form::text('item[first_name]',$user->first_name,['class' => 'form-control' , 'placeholder' => 'مثال: علی'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[last_name]', 'نام خانوادگی',['class' => 'control-label'])}}
                    {{Form::text('item[last_name]',$user->last_name,['class' => 'form-control' , 'placeholder' => 'مثال: محمدی'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[email]', 'ایمیل',['class' => 'control-label'])}}
                    {{Form::text('item[email]',$user->email,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: ali.mohammadi@yahoo.com'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="control-label">نام سازنده</label>
                    <p class="form-control-static">
                        @if (! is_null($user->creator_id))
                        {{$user->creator->getIdentifier()}}
                        @else
                        توسط سیستم
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[tell]', 'شماره تلفن',['class' => 'control-label'])}}
                    {{Form::text('item[tell]',$user->tell,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 22327800'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[mobile]', 'شماره موبایل',['class' => 'control-label'])}}
                    {{Form::text('item[mobile]',$user->mobile,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 09124052061'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    {{Form::label('item[password]', 'پسورد جدید',['class' => 'control-label'])}}
                    {{Form::password('item[password]',['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 123546!@#'])}}
                </div>
                <div class="col-md-4 col-sm-12">
                    {{Form::label('item[password_confirmation]', 'تایید پسورد جدید',['class' => 'control-label'])}}
                    {{Form::password('item[password_confirmation]',['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 123546!@#'])}}
                </div>
                <div class="col-md-4 col-sm-12">
                    {{Form::label('item[old_password]', 'پسورد قدیمی',['class' => 'control-label'])}}
                    {{Form::password('item[old_password]',['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 123546!@#'])}}
                    <p class="help-block">پسورد قدیمی برای تغییر پسورد نیازه</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{Form::label('user[address]', 'آدرس',['class' => 'control-label'])}}
                    {{Form::text('user[address]',empty($update) ? null :$user->address,['class' => 'form-control', 'placeholder' => 'مثال: تهران بزرگراه رسالت غرب به شرق بعد از پل بزرگراه صیاد شیرازی نبش ...'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    <button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-edit"></i> ثبت تغییرات</button>
                </div>
            </div>
        </fieldset>
    {{Form::close()}}
</div>