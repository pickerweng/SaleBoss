<a href="{{URL::to('groups/' . $group->id . '/edit')}}" class="btn operation-margin btn-xs pull-left btn-info">ویرایش</a>
<button
	type="button"
	class="btn btn-xs pull-left margin-right btn-danger"
	delete-url="{{URL::to('groups/' . $group->id)}}"
	onclick="Common.setDeleteURL(this,'#delete_form')"
	data-toggle="modal"
	data-target="#removeModal">حذف
</button>

