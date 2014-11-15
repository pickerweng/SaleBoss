<div class="well">
    <h4 class="Nassim Nassim700"><strong>همیشه جستجو کنید!</strong></h4>
    <div class="row">
        {{Form::open([
        'url'       =>  Request::path(),
        'method'    =>  'get'
        ])}}
        {{Form::hidden('customer_id',Input::get('customer_id'))}}
        {{Form::hidden('creator_id',Input::get('creator_id'))}}
        <div class="col-sm-12">
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">شناسه</label>
                {{Form::text('id',Input::get('id'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">مشتری</label>
                {{Form::text('customer',Input::get('customer'),['class' => 'form-control'])}}
            </div>
            @if(empty($inMyOrders))
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">فروشنده</label>
                {{Form::text('creator',Input::get('creator'),['class' => 'form-control'])}}
            </div>
            @endif
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">وضعیت</label>
                {{Form::select('state_id',$states,Input::get('state_id'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">نوع پنل</label>
                {{Form::select('panel_type',array('' => 'همه') + $opiloConfig['panel_types'],Input::get('panel_type'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">شماره کارت</label>
                {{Form::text('cart_number',Input::get('cart_number'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">شماره خط اختصاصی</label>
                {{Form::text('private_number',Input::get('private_number'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">توضیحات</label>
                {{Form::text('description',Input::get('description'),['class' => 'form-control'])}}
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <label class="control-label Nassim NassimTitle">مرتب سازی بر اساس</label>
                {{Form::select('sort_by',$opiloConfig['order_sortby'],Input::get('sort_by'),['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <div class="checkbox">
                    <label class="control-label Nassim NassimTitle">
                        {{Form::checkbox('asc','1',Input::get('asc'))}}
                        به صورت صعودی مرتب کن
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <div class="checkbox">
                    <label class="control-label Nassim NassimTitle">
                        {{Form::checkbox('accounter_approved','1',Input::get('accounter_approved'))}}
                        تایید شده توسط حسابدار
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <div class="checkbox">
                    <label class="control-label Nassim NassimTitle">
                        {{Form::checkbox('completed','1',Input::get('completed'))}}
                        سفارش های تکمیل شده
                    </label>
                </div>
            </div>
	        <div class="col-sm-12 col-md-3 col-lg-2 form-group">
		        <div class="checkbox">
			        <label  class="text-danger control-label Nassim NassimTitle">
				        {{Form::checkbox('completed','0',(Input::get('completed') === '0' ? true : false) )}}
				        سفارش های تکمیل نشده
			        </label>
		        </div>
	        </div>
            <div class="col-sm-12 col-md-3 col-lg-2 form-group">
                <div class="checkbox">
                    <label class="control-label Nassim NassimTitle">
                        {{Form::checkbox('suspended','1',Input::get('suspended'))}}
                        سفارش های معلق
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="col-sm-12 col-lg-8 col-md-8">
                <p>تعداد نتایج یافت شده: <code>{{$generatedOrders->getTotal()}}</code> (نمایش <code>{{$generatedOrders->getFrom()}}</code> تا <code>{{$generatedOrders->getTo()}}</code>)</p>
            </div>
            <div class="col-sm-12 col-lg-2  col-md-2">
                <a href="{{URL::to(Request::path())}}" class="btn btn-default btn-lg btn-block radius Nassim">ریست کن!</a>
            </div>
            <div class="col-sm-12 col-lg-2  col-md-2">
                {{Form::submit('بگرد!',['class' => 'btn btn-info btn-block btn-lg radius Nassim'])}}
            </div>
        </div>
        {{Form::close()}}
    </div>
</div>