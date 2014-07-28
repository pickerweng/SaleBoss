<br>
{{Form::open([
	'url'    =>  'orders/suspend/' . $order->id,
	'method' => 'put'
])}}
	@if(! $order->suspended)
		{{Form::hidden('suspended',true)}}
		{{Form::submit('معلق کردن سفارش',['class' => 'btn btn-warning btn-block'])}}
	@else
		{{Form::hidden('suspended',null)}}
		{{Form::submit('فعال کردن سفارش',['class' => 'btn btn-warning btn-block'])}}
	@endif
{{Form::close()}}