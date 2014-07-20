{{Form::open([
	'url'           =>  'orders',
	'method'        =>  'post'
])}}
	{{FormGenerator::generate($attributes, $formOptions)}}
{{Form::close()}}