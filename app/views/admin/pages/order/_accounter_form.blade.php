<div class="row">
        {{Form::open([
            'method'    =>  'put',
            'url'       =>  'orders/accounter_approve/' . $order->id,
            'class'     =>  'order-approve-form'
        ])}}
        {{Form::hidden('accounter_approved',null,array('class' => 'approve-order-hidden'))}}
        <div class="col-md-12 col-lg-6">
            <button type="button" class="btn btn-success btn-lg btn-block accounter-action-button approve-button" data-toggle="modal" data-target="#orderDesc">
                <i class="fa fa-check"></i> تایید و ارسال به پشتیبانی
            </button>
        </div>
        <div class="col-lg-6 col-md-12">
            <button type="button" class="btn btn-danger btn-block btn-lg accounter-action-button deport-button" data-toggle="modal" data-target="#orderDesc">
                <i class="fa fa-error"></i> عدم تایید و بازگشت به فروش
            </button>
        </div>
        <div class="modal fade" id="orderDesc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">بستن</span></button>
                        <h4 class="modal-title" id="myModalLabel">توضیحات حسابدار</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            {{Form::textarea('description',$order->description,array('class' => 'form-control'))}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-info pull-left submit-order">تایید</button>
                    </div>
                </div>
            </div>
        </div>
        {{Form::close()}}

    <script type="text/javascript">
        $(document).ready(function(){

	        // Approve order
            $('.approve-button').click(function(){
                $('.approve-order-hidden').val('1');
            });

	        // Deport order
	        $('.deport-button').click(function(){
		        $('.approve-order-hidden').removeAttr('value');
	        });

	        // Submit order by modal button
	        $('.submit-order').click(function(){
		        $('form.order-approve-form').submit();
	        });
        });
    </script>
</div>
