{{$order['title']}}<br>
@foreach($order['entity_values'] as $value)
	{{$value['value']}} :: {{$value['attribute']['display_name']}} <br>
@endforeach