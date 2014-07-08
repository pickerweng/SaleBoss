{{$orders['title']}}<br>
@foreach($orders['entity_values'] as $value)
	{{$value['value']}} :: {{$value['attribute']['display_name']}} <br>
@endforeach