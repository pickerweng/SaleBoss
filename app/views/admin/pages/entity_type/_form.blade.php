{{Form::open([
	'url'           =>  empty($update) ? 'entity_types' : 'entity_types/' . $entityType->id,
	'method'        =>  empty($update) ? 'post' : 'put'
])}}
	<div class="form-group">
		{{Form::label('item[display_name]','نام')}}
		{{Form::text('item[display_name]',!empty($update) ? $entityType->display_name : null , ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('item[machine_name]','نام ماشینی')}}
		{{Form::text('item[machine_name]',!empty($update) ? $entityType->machine_name : null , ['class' => 'form-control languageLeft' ,'disabled' => true])}}
	</div>

	{{Form::submit('ثبت',array('class' => 'btn btn-lg btn-success'))}}
{{Form::close()}}