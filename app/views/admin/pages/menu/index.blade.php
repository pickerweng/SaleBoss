@extends('admin.layouts.default')
@section('content')
<div class="row">
	<div class="col-lg-12">
        @if(!$menuItems->isEmpty())
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>عنوان آیتم</th>
						<th>توضیحات آیتم</th>
						<th class="languageLeft">لینک آیتم</th>
						<th class="text-center">فعال</th>
						<th class="languageLeft">عملیات</th>
					</tr>
				</thead>
				<tbody>
					@foreach($menuItems as $key => $item)
					<tr>
						<td>{{$item->id}}</td>
						<td><a href="{{URL::to($item->link)}}" target="_blank">{{$item->title}}</a></td>
						<td>{{($item->desc?$item->desc:'<code>ندارد</code>')}}</td>
                        <td class="languageLeft">{{$item->link}}</td>
						<td class="text-center"><span class="fa fa-{{($item->disabled?'time error':'check success')}}"></span></td>
						<td class="languageLeft">
							<div class="btn-group">
                                <button 
                                    type="button"
                                    class="btn btn-danger btn-sm"
                                    delete-url="{{URL::to('admin/menu/item/' . $menuType->id . '/' . $item->id)}}"
                                    data-target="#removeModal"
                                    data-toggle="modal"
                                    onclick="Common.setDeleteURL(this,'#delete_form')"
                                >
                                    حذف
                                </button>
                                <a href="{{URL::to('admin/menu/item/' . $menuType->id . '/' . $item->id . '/edit')}}" class="btn btn-sm btn-warning">ویرایش</a>
								<a href="{{URL::to('admin/menu/item/' . $menuType->id . '/' . $item->id)}}" class="btn btn-success btn-sm">مشاهده</a>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
        @include('admin.blocks.delete_modal')

        @else

        <div class="alert alert-info">
             <p>این منو آیتمی ندارد.</p>
        </div>
        @endif
	</div>
</div>
@stop