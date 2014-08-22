<!--Update Modal -->
<div class="modal slide-down" id="updateModal" tabindex="-1" style="overflow-y:hidden;" role="dialog" aria-labelledby="updateModel" aria-hidden="true">
  <div class="modal-dialog .modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">بروز رسانی </h4>
      </div>
      <div class="modal-body">
      	<p></p>
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-warning pull-left" onclick="Common.submitUpdateForm('#update_form')">بروز رسانی</button>
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">بستن</button>
      </div>
    </div>
  </div>
</div>

<script type="text/template" class="lead-update-modal-form">
	{{Form::open(array(
    	'url'			=>	"#",
    	'method'		=>	'put',
    	'id'			=>	'update_form',
    	'class'			=>	'update_form'
    ))}}
    	<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label class="control-label">نام یا شماره شرکت</label>
				<input name="name" type="text" class="form-control bulkable resettable" placeholder="نام شخص یا شرکت" value="<%= name %>">
			</div>
			<div class="col-lg-6 col-sm-12">
				<label class="control-label">شماره تماس</label>
				<input name="phone" type="text" class="form-control languageLeft bulkable resettable" value="<%= phone %>">
			</div>
		</div>
		<br>
		<div class="row">
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			<label class="control-label">زمینه فعالیت</label>
    			<%= tags %>
    		</div>
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			<label class="control-label">توضیحات</label>
    			<input name="description" type="text" class="form-control bulkable resettable" value="<%= description %>">
    		</div>
		</div>
		<br>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label class="control-label">اهمیت</label>
					<%= priorities %>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<label class="control-label">وضعیت</label>
				<%= statuses %>
			</div>
		</div>
		<br>
		<div class="row">
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			<label class="control-label">تاریخ به یاد آوری</label>
    			<input name="remind_at" class="form-control" type="text" placeholder="به یاد آوری در چند روز بعد؟">
    		</div>
		</div>
		<br>
	{{Form::close()}}
</script>
