@section('content')
<div style="margin-right:50px">
	{{Form::open([
		'url' => 'opilo-orders',
		'method' => 'post'
	])}}
		<h4>اطلاعات کاربر</h4>

		<h4>اطلاعات سفارش</h4>
		{{FormGenerator::generate(($attributes),$options)}}
	{{Form::close()}}
</div>
@stop