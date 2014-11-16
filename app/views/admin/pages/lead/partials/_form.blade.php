<div class="well">
    {{Form::open([
        'method'        =>  'post',
        'url'           =>  'leads',
        'id'            =>  'leads_form'
    ])}}
    <div class="row lead-list">
        <div class="col-sm-12 col-lg-6 col-md-12 lead-item">
            <fieldset>
                <legend><i class="fa fa-plus"></i> ایجاد لید جدید</legend>
                <div class="form-group">
                    <label class="control-label">شماره تلفن</label>
                    {{Form::text('leads[0][phone_number]',null,['class' => 'form-control languageLeft bulkable'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">توضیحات</label>
                    {{Form::text('leads[0][description]',null,['class' => 'form-control bulkable'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">اهمیت</label>
                    {{Form::select( 'leads[0][priority]',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'], 1,['class' => 'form-control languageLeft bulkable'])}}
                </div>
                <div class="form-group">
                    <label class="control-label">
                        {{Form::checkbox('leads[0][shared]','on',true,['class' => 'bulkable'])}}
                        به اشتراک بگذار
                    </label>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            {{Form::submit('ثبت لیدها',['class' => 'btn btn-success btn-lg btn-block'])}}
        </div>
        <div class="col-sm-12 col-md-6">
            <button type="button" class="btn btn-lg btn-block btn-info" id="add_new">+ اضافه کردن آیتم</button>
        </div>
    </div>
    {{Form::close()}}
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var number_of_leads = 1;
        var first_item = $(".lead-list .lead-item");
        $("#add_new").click(function(){
            new_item = $(first_item.clone());
            new_item.find(".bulkable").each(function(){
               var name = $(this).attr('name');
               $(this).attr('name',name.replace("leads[" + "0" + "]","leads[" + number_of_leads + "]"))
            });
            number_of_leads++;
            $(".lead-list").append(new_item.clone());
        });
    });
</script>
