<a href="{{URL::to('users/' . $item->id . '/edit')}}" class="btn operation-margin btn-xs pull-left btn-info">ویرایش</a>
<a href="{{URL::to('users/' . $item->id)}}" class="btn operation-margin btn-xs pull-left btn-success">مشاهده</a>
<a target="_blank" href="{{URL::to('stats/user/' . $item->id)}}" class="btn operation-margin btn-xs pull-left btn-default">آمار</a>
<a target="_blank" href="{{URL::to('leads/user/' . $item->id)}}" class="btn operation-margin btn-xs pull-left btn-warning">لیدها</a>
<button
	type="button"
	class="btn btn-xs pull-left margin-right btn-danger"
	delete-url="{{URL::to('users/' . $item->id)}}"
	onclick="Common.setDeleteURL(this,'#delete_form')"
	data-toggle="modal"
	data-target="#removeModal">حذف
</button>
