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
		'url'		=> 	'menu/' . $menu_item->id,
		'method'	=>	'post'
		))}}
		<div class="form-group">
			{{Form::label('item[title]','عنوان منو')}}
			{{Form::text('item[title]',$menu_item->title,array('class' => 'form-control','placeholder' => 'عنوان مناسب برای منو'))}}
		</div>
		<div class="form-group">
			{{Form::label('item[uri]','لینک منو')}}
			{{Form::text('item[uri]',$menu_item->uri,array('class' => 'form-control languageLeft' , 'placeholder' => 'Example: http://google.com'))}}
		</div>
		<div class="form-group">
			<label class="checkbox-inline">
				{{Form::checkbox('item[disabled]',false,array('class' => 'form-control'))}} فعال
			</label>
		</div>
		<div class="form-group">
			{{Form::label('item[ids]','نوع منو')}}<br>
			{{Form::select('item[ids]', MenuBuilder::select(),$default_value,array('class' => 'form-control'))}}
		</div>
		<br>
		<button type="submit" class="btn btn-success">ایجاد</button>
		{{Form::close()}}
	</div>
</div>
@stop
