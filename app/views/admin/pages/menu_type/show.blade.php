@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/menu_types')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-list"></i> مشاهده آیتم های منو</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-12">
		<div class="table-responsive">
			<a href="{{URL::to('admin/menu/create?menu_type=' . $menu_type->id)}}" class="btn btn-success">
				<i class="fa fa-plus"></i> ایجاد آیتم برای منو
			</a>
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th># شناسه</th>
						<th class="text-center">نام</th>
						<th class="text-center">لینک</th>
						<th class="text-center">فعال</th>
						<th class="text-center">نوع منو</th>
						<th class="languageLeft">عملیات</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $menu_type->menues()->get() as $menu_item)
					<tr>
						<td>{{$menu_item->id}}</td>
						<td class="text-center">
							<a target="_blank" href="{{URL::to($menu_item->link)}}">
								{{$menu_item->name}}
							</a>
						</td>
						<td class="text-center">{{$menu_item->link}}</td>
						<td class="text-center">
							<span class="fa fa-{{(!empty($menu_item->enabled)?'check success':'times error')}}"></span>
						</td>
						<td class="text-center">{{$menu_type->machine_name}}</td>
						<td class="languageLeft">
							<a href="{{URL::to('admin/menu/' . $menu_item->id . '/edit')}}" class="btn btn-xs btn-info">ویرایش</a>
							<button
								type="button"  
								class="btn btn-xs btn-danger" 
								delete-url="{{URL::to('admin/menu/' . $menu_item->id)}}" 
								onclick="Common.setDeleteURL(this,'#delete_form')" 
								data-toggle="modal" 
								data-target="#removeModal" 
							> حذف </button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop