<div class="well">
    {{Form::open([
        'method'        =>  'put',
        'url'           =>  'leads/locker/' . $lead->id,
    ])}}
    <div class="row">
        <div class="col-sm-12">
            <fieldset>
                <legend><i class="fa fa-plus"></i> بروز رسانی لید{{$lead->phone_number}}</legend>
                <div class="alert alert-warning">
                    <p>این لید توسط شما قفل شده است.</p>
                </div>
                <div class="form-group">
                    <label class="control-label">شماره تلفن</label>
                    <p class="form-control-static"><b>{{$lead->phone_number}}</b></p>
                </div>
                <div class="form-group">
                    <label class="control-label">توضیحات</label>
                    {{Form::text('description',$lead->description,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">چند روز بعد به یاد آور؟ مثال: 25</label>
                    {{Form::text('remind_at',$lead->jalaliAgoDate('remind_at'),['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">وضعیت لید</label>
                    {{Form::select('status',$opiloConfig['lead_status'],$lead->status,['class' => 'form-control'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">اهمیت</label>
                    <?php for($i=1;$i<= ($lead->priority +1);$i++) { ;?>
                        <i class="fa fa-star" style="color: orange"></i>
                    <?php } ;?>
                </div>
            </fieldset>
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn-block btn btn-lg btn-success">ویرایش</button> <br>
            {{Form::close()}}
            @if(! is_null($lead->locker_id))
                {{Form::open([
                    'url'       =>  'leads/locker/' . $lead->id,
                    'method'    =>  'delete'
                ])}}
                    <button type="submit" class="btn btn-warning btn-lg btn-block">آزاد کردن</button><br>
                {{Form::close()}}
            @endif
        </div>
    </div>
</div>
