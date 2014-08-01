<br>
{{Form::open([
	'url'    =>  'orders/suspend/' . $order->id,
	'method' => 'put'
])}}
	@if(! $order->suspended)
		{{Form::hidden('suspended',true)}}
		{{Form::submit('معلق کردن سفارش',['class' => 'btn pull-left btn-xs btn-default operation-margin'])}}
	@else
		{{Form::hidden('suspended',null)}}
		{{Form::submit('فعال کردن سفارش',['class' => 'btn pull-left btn-xs btn-default operation-margin'])}}
	@endif
{{Form::close()}}