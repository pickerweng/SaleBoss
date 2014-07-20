@extends('admin.layouts.default')
@section('title')
	@parent | ویرایش نوع منو
@show
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('menu_type')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-edit"></i> ویرایش منو</li>
@show
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{Form::open(array('url' => 'menu_type/' . $menuType->id,'method' => 'put'))}}
			<div class="form-group">
				{{Form::label('item[machine_name]','نام ماشینی منو')}}
				{{Form::text('item[machine_name]',$menuType->machine_name,array('placeholder' => 'Example: header_menu','class' => 'form-control languageLeft'))}}
			</div>
			<div class="form-group">
				{{Form::label('item[display_name]','نام منو')}}
				{{Form::text('item[display_name]',$menuType->display_name,array('placeholder' => 'مثال: منوی هدر','class' => 'form-control'))}}
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					{{Form::checkbox('item[enabled]','itemEnabled',(empty($menuType->disabled)?true:false))}} فعال
				</label>
			</div>
			<div class="btn-group pull-left">
				<a href="{{URL::to('menu_type')}}" class="btn btn-default">بازگشت</a>
				<button type="submit" class="btn btn-success">ویرایش</button>
			</div>
		{{Form::close()}}
	</div>

</div>
@stop
