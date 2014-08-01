<div class="well">
    <h4><strong>همیشه جستجو کنید!</strong></h4>
    <div class="row">
        {{Form::open([
        'url'       =>  Request::path(),
        'method'    =>  'get'
        ])}}
        {{Form::hidden('customer_id',Input::get('customer_id'))}}
        {{Form::hidden('creator_id',Input::get('creator_id'))}}
        <div class="col-sm-12">
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">شناسه</label>
                {{Form::text('id',Input::get('id'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">مشتری</label>
                {{Form::text('customer',Input::get('customer'),['class' => 'form-control'])}}
            </div>
            @if(empty($inMyOrders))
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">فروشنده</label>
                {{Form::text('creator',Input::get('creator'),['class' => 'form-control'])}}
            </div>
            @endif
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">وضعیت</label>
                {{Form::select('state_id',$states,Input::get('state_id'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">نوع پنل</label>
                {{Form::select('panel_type',array('' => 'همه') + $opiloConfig['panel_types'],Input::get('panel_type'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">شماره کارت</label>
                {{Form::text('cart_number',Input::get('cart_number'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">شماره خط اختصاصی</label>
                {{Form::text('private_number',Input::get('private_number'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">توضیحات</label>
                {{Form::text('description',Input::get('description'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label">مرتب سازی بر اساس</label>
                {{Form::select('sort_by',$opiloConfig['order_sortby'],Input::get('sort_by'),['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-sm-12">
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
                        {{Form::checkbox('accounter_approved','1',Input::get('accounter_approved'))}}
                        تایید شده توسط حسابدار
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <div class="checkbox">
                    <label class="control-label">
                        {{Form::checkbox('completed','1',Input::get('completed'))}}
                        سفارش های تکمیل شده
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <div class="checkbox">
                    <label class="control-label">
                        {{Form::checkbox('suspended','1',Input::get('suspended'))}}
                        سفارش های معلق
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <p>تعداد نتایج یافت شده: <code>{{$generatedOrders->getTotal()}}</code> (نمایش <code>{{$generatedOrders->getFrom()}}</code> تا <code>{{$generatedOrders->getTo()}}</code>)</p>
            </div>
            <div class="col-sm-12 col-lg-3  col-md-3">
                <a href="{{URL::to(Request::path())}}" class="btn btn-default btn-lg btn-block">ریست کن!</a>
            </div>
            <div class="col-sm-12 col-lg-3  col-md-3">
                {{Form::submit('بگرد!',['class' => 'btn btn-info btn-block btn-lg'])}}
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>