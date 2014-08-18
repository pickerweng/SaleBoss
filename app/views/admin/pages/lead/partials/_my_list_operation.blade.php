<button
	type="button"
	class="btn btn-xs pull-left margin-right btn-danger"
	delete-url="{{URL::to('me/leads/' . $lead->id)}}"
	onclick="Common.setDeleteURL(this,'#delete_form')"
	data-toggle="modal"
	data-target="#removeModal"><i class="fa fa-times"></i>
</button>

