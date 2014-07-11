@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-picture-o"></i> منوها</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-9 col-md-12">
	@if(!$menu_types->isEmpty())
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th> نام منو </th>
						<th class="text-center">فعال</th>
						<th class="languageLeft">نام ماشینی منو</th>
						<th class="languageLeft">عملیالت</th>
					</tr>
				</thead>
				<tbody>
				@foreach($menu_types as $key => $type)
					<tr>
						<td>{{$type->id}}</td>
						<td>{{$type->name}}</td>
						<td class="text-center">
							<span class="fa fa-{{(empty($type->disabled)?'check success':'times error')}}"></span>
						</td>
						<td class="languageLeft">{{$type->machine_name}}</td>
						<td class="languageLeft">

								<div class="btn-group">
									<button
										type="button"  
										class="btn btn-sm btn-danger" 
										delete-url="{{URL::to('admin/menu_type/' . $type->id)}}" 
										onclick="Common.setDeleteURL(this,'#delete_form')" 
										data-toggle="modal" 
										data-target="#removeModal" 
									>
									 حذف
									</button>
									<a href="{{URL::to('admin/menu_type/' . $type->id . '/edit')}}" class="btn btn-sm btn-warning">ویرایش</a>
									<a href="{{URL::to('admin/menu_type/' . $type->id)}}" class="btn btn-sm btn-success">مشاهده آیتم ها</a>
								</div>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
		@include('admin.blocks.delete_modal')
	@else
		<div class="alert alert-info emptyResultSet">
			<p>هنوز منویی ایجاد نکرده اید</p>
		</div>
	@endif
	</div>
</div>
@stop