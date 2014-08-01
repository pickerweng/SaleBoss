<div class="well">
    {{Form::open([
        'method'        =>  'post',
        'url'           =>  'leads',
    ])}}
    <div class="row">
        @if(! is_null($lead->locker_id))
        @endif
        <div class="col-sm-12">
            <fieldset>
                <legend><i class="fa fa-plus"></i> ویرایش لید {{$lead->phone_number}}</legend>
                <?php if(! is_null($lead->locker_id)) : ?>
                <div class="alert alert-warning">
                    <p>این لید توسط <a target="_blank" href="{{URL::to('users/'. $lead->locker->id)}}">{{$lead->locker->getIdentifier()}}</a> قفل شده است.</p>
                </div>
                <?php endif;?>
                <div class="form-group">
                    <label class="control-label">شماره تلفن</label>
                    {{Form::text('phone_number',$lead->phone_number,['class' => 'form-control languageLeft bulkable'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">توضیحات</label>
                    {{Form::text('description',$lead->description,['class' => 'form-control bulkable'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">اهمیت</label>
                    {{Form::select( 'priority',array(0,1,2,3,4,5),$lead->priority,['class' => 'form-control languageLeft bulkable'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">
                        {{Form::checkbox('shared','on',$lead->shared,['class' => 'bulkable'])}}
                        به اشتراک بگذار
                    </label>
                </div>
            </fieldset>
        </div>
        <div class="col-sm-12">
            <button type="submit" class="btn-block btn btn-lg btn-success">ویرایش</button> <br>
            @if(! is_null($lead->locker_id))
                {{Form::open([
                    'url'       =>  'leads/' . $lead->id,
                    'method'    =>  'put'
                ])}}
                    <button type="submit" class="btn btn-warning btn-lg btn-block">آزاد کردن</button><br>
                {{Form::close()}}
            @endif
            {{Form::open([
                'url'       =>  'loads/' . $lead->id,
                'method'    =>  'delete'
            ])}}
                <button type="submit" class="btn btn-danger btn-lg btn-block">حذف لید</button><br>
            {{Form::close()}}
        </div>
    </div>
    {{Form::close()}}
</div>
