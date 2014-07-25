<div class="well">
    <h4><strong>همیشه جستجو کنید!</strong></h4>
    <div class="row">
        <div class="col-sm-12">
            {{Form::open(['method' => 'get', 'url' => 'my/customers'])}}
                <div class="col-sm-12 col-md-4 col-lg-3 form-group">
                    {{Form::label('first_name','مشتری که نام او',['class' => 'control-label'])}}
                    {{Form::text('first_name',Input::get('first_name'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 form-group">
                    {{Form::label('last_name','نام خانوادگی او')}}
                    {{Form::text('last_name',Input::get('last_name'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 form-group">
                    {{Form::label('mobile','شماره موبایلش')}}
                    {{Form::text('mobile',Input::get('mobile'),['class' => 'form-control languageLeft'])}}
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 form-group">
                    {{Form::label('tell','شماره تلفنش')}}
                    {{Form::text('tell',Input::get('tell'),['class' => 'form-control languageLeft'])}}
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 form-group">
                    {{Form::label('email','ایمیلش')}}
                    {{Form::text('email',Input::get('email'),['class' => 'form-control languageLeft'])}}
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3 form-group">
                    {{Form::label('id','و شناسه اش')}}
                    {{Form::text('id',Input::get('id'),['class' => 'form-control languageLeft'])}}
                </div>
                <div class="col-sm-12 col-lg-3 col-lg-offset-9 col-md-4 col-md-offset-8">
                    {{Form::submit('بگرد!',['class' => 'btn btn-info btn-block btn-lg'])}}
                </div>

            {{Form::close()}}
        </div>
    </div>
</div>