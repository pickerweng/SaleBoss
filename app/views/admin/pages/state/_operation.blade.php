<a href="{{URL::to('states/' . $state->id . '/edit')}}" class="btn radius Nassim marginRight operation-margin btn-xs pull-left btn-info">ویرایش</a>
<button
	type="button"
	class="btn btn-xs pull-left margin-right btn-danger radius Nassim marginRight"
	delete-url="{{URL::to('states/' . $state->id)}}"
	onclick="Common.setDeleteURL(this,'#delete_form')"
	data-toggle="modal"
	data-target="#removeModal">حذف
</button>

