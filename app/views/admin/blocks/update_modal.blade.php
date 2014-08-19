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
    	'method'		=>	'delete',
    	'id'			=>	'update_form',
    	'class'			=>	'update_form'
    ))}}
    	<div class="row">
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			{{Form::text('name',"<%= name %>",['placeholder' => 'نام شخص یا شرکت','class' => 'form-control bulkable resettable', 'size' => '10'])}}
    		</div>
    		<div class="col-lg-6 col-sm-12">
    			{{Form::text('phone',"<%= phone %>",['placeholder' => 'شماره تماس','class' => 'form-control languageLeft bulkable resettable','size' => '10'])}}
    		</div>
    		<div clss="col-lg-6 col-md-6 col-sm-12">
    			{{Form::select('tag',SaleBoss\Models\Tag::getTagList(),"<%= tag %>",['class' => 'form-control stable'])}}
    		</div>
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			{{Form::text('description',"<%= description %>",['placeholder' => 'توضیحات','class' => 'form-control bulkable resettable','size' => '10'])}}
    		</div>
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			{{Form::select( 'priority',array(0,1,2,3,4,5),"<%= priority %>",['class' => 'form-control languageLeft bulkable resettable'])}}
    		</div>
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			{{Form::select('status',$opiloConfig['lead_status'],"<%= status %>",['class' => 'form-control stable'])}}
    		</div>
    		<div class="col-lg-6 col-md-6 col-sm-12">
    			{{Form::text('remind_at',"<%= remind_at %>",['class' => 'form-control resettable', 'placeholder' => 'به یادآوری در چندروز بعد؟','size' => '10'])}}
    		</div>
    	</div>
	{{Form::close()}}
</script>