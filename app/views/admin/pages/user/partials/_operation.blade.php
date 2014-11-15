<a href="{{URL::to('users/' . $item->id . '/edit')}}" class="btn operation-margin btn-xs pull-left btn-info Nassim radius marginRight">ویرایش</a>
<a href="{{URL::to('users/' . $item->id)}}" class="btn operation-margin btn-xs pull-left btn-success Nassim radius marginRight">مشاهده</a>
<a target="_blank" href="{{URL::to('stats/user/' . $item->id)}}" class="btn operation-margin btn-xs pull-left btn-default Nassim radius marginRight">آمار</a>
<a target="_blank" href="{{URL::to('leads/user/' . $item->id)}}" class="btn operation-margin btn-xs pull-left btn-warning Nassim radius marginRight">لیدها</a>
<button
	type="button"
	class="btn btn-xs pull-left margin-right btn-danger Nassim radius marginRight"
	delete-url="{{URL::to('users/' . $item->id)}}"
	onclick="Common.setDeleteURL(this,'#delete_form')"
	data-toggle="modal"
	data-target="#removeModal">حذف
</button>
