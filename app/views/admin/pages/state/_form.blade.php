{{Form::open([
	'url'        =>  empty($update) ? 'states' : 'states/' . $state->id,
	'method'        =>  empty($update) ? 'post' : 'put'
])}}
	<div class="form-group">
		{{Form::label('item[title]','نام مرحله')}}
		{{Form::text('item[title]',!empty($update) ? $state->title : null , ['class' => 'form-control'])}}
	</div>

	<div class="form-group">
		{{Form::label('item[priority]','شماره مرحله')}}
		{{Form::text('item[priority]',!empty($update) ? $state->priority: null , ['class' => 'form-control languageLeft'])}}
	</div>

	{{Form::submit('ثبت',array('class' => 'btn btn-md btn-success Nassim radius'))}}
{{Form::close()}}