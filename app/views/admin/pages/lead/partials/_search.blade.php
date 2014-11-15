<div class="well">
    <h4 class="NassimTitle Nassim">همیشه جستجو کنید!</h4>
    <div class="row">
        {{Form::open([
            'url'       =>  Request::path(),
            'method'    =>  'get'
        ])}}
            {{Form::hidden('locker_id',Input::get('locker_id'))}}
            <div class="col-sm-12">
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <label class="control-label">شناسه</label>
                    {{Form::text('id',Input::get('id'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <label class="control-label">کاربر</label>
                    {{Form::text('locker',Input::get('locker'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <label class="control-label">اهمیت</label>
                    {{Form::select('priority',array('' => 'همه',0,1,2,3,4,5),Input::get('priority'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <label class="control-label">وضعیت</label>
                    {{Form::select('status',['' => 'همه'] +$opiloConfig['lead_status'],Input::get('status'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <label class="control-label">توضیحات</label>
                    {{Form::text('description',Input::get('description'),['class' => 'form-control'])}}
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <label class="control-label">مرتب سازی بر اساس</label>
                    {{Form::select('sort_by',$opiloConfig['lead_sortby'],Input::get('sort_by'),['class' => 'form-control'])}}
                </div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <div class="checkbox">
                        <label class="control-label">
                            {{Form::checkbox('my_locked_leads','1',Input::get('my_locked_leads'))}}
                            فقط لیدهای من
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <div class="checkbox">
                        <label class="control-label">
                            {{Form::checkbox('my_created_leads','1',Input::get('my_created_leads'))}}
                           	فقط لیدهای ایجاد شده توسط من
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <div class="checkbox">
                        <label class="control-label">
                            {{Form::checkbox('asc','1',Input::get('asc'))}}
                            به صورت صعودی مرتب کن
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                    <div class="checkbox">
                        <label class="control-label">
                            {{Form::checkbox('has_remind_at','1',Input::get('has_remind_at'))}}
                            فقط آنهایی که تاریخ به یادآوردی دارند
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-12 col-lg-9 col-md-8">
                    <p>تعداد تایج یافت شده : <code>{{$list->getTotal()}}</code> (نمایش <code>{{$list->getFrom()}}</code> تا <code>{{$list->getTo()}}</code>)</p>
                </div>
                <div class="col-sm-12 col-lg-3  col-md-4">
                    {{Form::submit('بگرد!',['class' => 'btn btn-info btn-block btn-lg'])}}
                </div>
            </div>
        {{Form::close()}}
    </div>
</div>