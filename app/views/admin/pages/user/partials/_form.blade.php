<div class="well">
    {{Form::open([
        'url' => empty($update) ? 'users' : "users/{$user->id}" ,
        'method' => empty($update) ? 'post' : 'put',
        'class' => 'pretty-form customer-form'
    ])}}
        <fieldset>
            <legend class="Nassim"><strong>اطلاعات اولیه</strong></legend>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[first_name]', 'نام',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::text('item[first_name]',empty($update) ? null : $user->first_name,['class' => 'form-control' , 'placeholder' => 'مثال: علی'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[last_name]', 'نام خانوادگی',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::text('item[last_name]',empty($update) ? null : $user->last_name,['class' => 'form-control' , 'placeholder' => 'مثال: محمدی'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[email]', 'ایمیل',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::text('item[email]',empty($update) ? null : $user->email,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: ali.mohammadi@yahoo.com'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    <label class="control-label Nassim NassimTitle">نام سازنده</label>
                    <p class="form-control-static">{{Sentry::getUser()->getIdentifier()}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[tell]', 'شماره تلفن',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::text('item[tell]',empty($update) ? null : $user->tell,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 22327800'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[mobile]', 'شماره موبایل',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::text('item[mobile]',empty($update) ? null : $user->mobile,['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 09124052061'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[password]', 'پسورد',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::password('item[password]',['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 123546!@#'])}}
                </div>
                <div class="col-md-6 col-sm-12">
                    {{Form::label('item[password_confirmation]', 'تایید پسورد',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::password('item[password_confirmation]',['class' => 'form-control languageLeft' , 'placeholder' => 'Example: 123546!@#'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    {{Form::label('user[address]', 'آدرس',['class' => 'control-label Nassim NassimTitle'])}}
                    {{Form::text('user[address]',empty($update) ? null :$user->address,['class' => 'form-control', 'placeholder' => 'مثال: تهران بزرگراه رسالت غرب به شرق بعد از پل بزرگراه صیاد شیرازی نبش ...'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12"">
                    <br>
                    {{Form::label('item[roles]','انتخاب نقش کاربری')}}
                    {{Form::select('item[roles]',$groups,(empty($update) ? null : $current_groups),['multiple' => true,'class' => 'form-control'])}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br>
                    @if(empty($update))
                        <button type="submit" class="btn btn-lg btn-success btn-block Nassim radius"><i class="fa fa-plus"></i> ایجاد کاربر جدید</button>
                    @else
                        <button type="submit" class="btn btn-lg btn-success btn-block Nassim radius"><i class="fa fa-edit"></i> ویرایش کاربر</button>
                    @endif
                </div>
            </div>
        </fieldset>
    {{Form::close()}}
</div>