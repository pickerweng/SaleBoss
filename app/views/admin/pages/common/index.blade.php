@extends('admin.layouts.default')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<table class="table table-responsive table-hover">
			<thead>
				<tr>
					@foreach($columns as $key => $column)
						<th>{{CommonPresenter::key($key)}}</th>
					@endforeach
					@if(!empty($operationColumn))
						<th class="languageLeft">
							عملیات
						</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($dynamicItems as $key => $item)
					<tr>
						@foreach($columns as $key => $column)
							<td>
								{{CommonPresenter::decide($column,$item->$key)}}
							</td>
						@endforeach
						@if(!empty($operationColumn))
							<td class="languageLeft">
								{{View::make($operationColumn, ['item' => $item])->render()}}
							</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop