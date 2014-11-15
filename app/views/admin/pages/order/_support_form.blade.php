<div class="row hidden-print">
	{{Form::open([
	'method'    =>  'put',
	'url'       =>  'orders/support_approve/' . $order->id,
	'class'     =>  'order-approve-form'
	])}}
	{{Form::hidden('completed',null,array('class' => 'approve-order-hidden'))}}
    {{Form::hidden('to_accounter',null,array('class' => 'to-accounter-hidden'))}}
	<div class="col-lg-4 col-md-6 col-sm-12">
		<button type="button" class="btn btn-success btn-block btn-lg accounter-action-button approve-button radius Nassim" data-toggle="modal" data-target="#orderDesc">
			<i class="fa fa-check"></i> تایید نهایی
		</button><br>
	</div>
	<div class="col-lg-4 col-md-6 col-sm-12">
		<button type="button" class="btn btn-default btn-block btn-lg accounter-action-button to-accounter-deport-button radius Nassim" data-toggle="modal" data-target="#orderDesc">
			<i class="fa fa-error"></i> بازگشت به حسابداری
		</button><br>
	</div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <button type="button" class="btn btn-danger btn-block btn-lg accounter-action-button deport-button radius Nassim" data-toggle="modal" data-target="#orderDesc">
            <i class="fa fa-error"></i> عدم تایید بازگشت به فروش
        </button><br>
    </div>
	<div class="modal fade" id="orderDesc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">بستن</span></button>
					<h4 class="modal-title" id="myModalLabel">توضیحات پشتیبانی</h4>
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
				$('.to-accounter-hidden').removeAttr('value');
                $('.approve-order-hidden').removeAttr('value');
			});

            // Set return to accounter
            $('.to-accounter-deport-button').click(function(){
                $('.to-accounter-hidden').val('1');
                $('.approve-order-hidden').removeAttr('value');
            })

			// Submit order by modal button
			$('.submit-order').click(function(){
				$('form.order-approve-form').submit();
			});
		});
	</script>
</div>
