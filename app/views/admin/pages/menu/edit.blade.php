@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/menu_type')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-edit"></i> ویرایش آیتم</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{Form::open(array(
				'url'		=> 	'admin/menu/' . $menu_item->id,
				'method'	=>	'put'
			))}}
			<div class="form-group">
				{{Form::label('item[name]','عنوان منو')}}
				{{Form::text('item[name]',$menu_item->name,array('class' => 'form-control','placeholder' => 'عنوان مناسب برای منو'))}}
			</div>
			<div class="form-group">
				{{Form::label('item[link]','لینک منو')}}
				{{Form::text('item[link]',$menu_item->link,array('class' => 'form-control languageLeft' , 'placeholder' => 'Example: http://google.com'))}}
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					{{Form::checkbox('item[enabled]',$menu_item->enabled,array('class' => 'form-control'))}} فعال
				</label>
			</div>
			{{Form::label('item[menu_type_id]','نوع منو')}}
			{{Form::select(
					'item[menu_type_id]',
					\Helpers\Common::selectArray($menu_types,array('id','name')),
					$menu_item->menu_type_id,
					array('class' => 'form-control parent-select')
				)}}<br>
			<button type="submit" class="btn btn-success">ویرایش</button>
		{{Form::close()}}
	</div>
</div>
@stop
