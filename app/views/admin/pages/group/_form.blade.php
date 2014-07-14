{{Form::open([
	'url'        =>  empty($update) ? 'groups' : 'groups/' . $group->id,
	'method'        =>  empty($update) ? 'post' : 'put'
])}}
	<div class="form-group">
		{{Form::label('item[display_name]','نام  گروه')}}
		{{Form::text('item[display_name]',!empty($update) ? $group->display_name : null , ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('item[name]','نام ماشینی گروه')}}
		{{Form::text('item[name]',!empty($update) ? $group->name : null , ['class' => 'form-control languageLeft'])}}
	</div>

	{{Form::submit('ثبت تغییرات',array('class' => 'btn btn-lg btn-success'))}}
{{Form::close()}}