@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/menu_type')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد آیتم</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{Form::open(array(
				'url'		=> 	'admin/menu',
				'method'	=>	'post'
			))}}
			<div class="form-group">
				{{Form::label('item[name]','عنوان منو')}}
				{{Form::text('item[name]',null,array('class' => 'form-control','placeholder' => 'عنوان مناسب برای منو'))}}
			</div>
			<div class="form-group">
				{{Form::label('item[link]','لینک منو')}}
				{{Form::text('item[link]',null,array('class' => 'form-control languageLeft' , 'placeholder' => 'Example: http://google.com'))}}
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					{{Form::checkbox('item[enabled]',true,array('class' => 'form-control'))}} فعال
				</label>
			</div>
			{{Form::label('item[menu_type_id]','نوع منو')}}
			{{Form::select(
					'item[menu_type_id]',
					\Helpers\Common::selectArray($menu_types,array('id','name')),
					( ! empty($for_menu_type) ? $for_menu_type:null),
					array('class' => 'form-control')
				)}}<br>
			<button type="submit" class="btn btn-success">ایجاد</button>
		{{Form::close()}}
	</div>
</div>
@stop
