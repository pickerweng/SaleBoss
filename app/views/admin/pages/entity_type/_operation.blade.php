<a href="{{URL::to('entity_types/' . $type->id . '/edit')}}" class="btn operation-margin btn-xs pull-left btn-info">ویرایش</a>
<a href="{{URL::to('entity_types/' . $type->id . '/fields')}}" class="btn operation-margin btn-xs pull-left btn-info">مشاهده فیلدها</a>
<button
	type="button"
	class="btn btn-xs pull-left margin-right btn-danger"
	delete-url="{{URL::to('entity_types/' . $type->id)}}"
	onclick="Common.setDeleteURL(this,'#delete_form')"
	data-toggle="modal"
	data-target="#removeModal">حذف
</button>

