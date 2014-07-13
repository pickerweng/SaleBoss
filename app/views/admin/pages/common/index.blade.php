@section('content')
<div class="row">
	<div class="col-sm-12">
		<table class="table table-responsive table-hover">
			<thead>
				<tr>
					@foreach($columns as $key => $column)
						<th {{(! empty($column['class']) ? 'class="' . $column['class']. '"')}}>{{$key}}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach($dynamicItems as $key => $item)
					<tr>
						@foreach($columns as $key => $column)
							<td {{(! empty($column['class']) ? 'class="' . $column['class']. '"')}}>
								{{$item->{$key}}}
							</td>
						@endforeach
					</tr>
					@if(!empty
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop