@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/menu_type')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-edit"></i> ویرایش منو</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{Form::open(array('url' => 'admin/menu_type/' . $menu_type->id,'method' => 'put'))}}
			<div class="form-group">
				{{Form::label('item[machine_name]','نام ماشینی منو')}}
				{{Form::text('item[machine_name]',$menu_type->machine_name,array('placeholder' => 'Example: header_menu','class' => 'form-control languageLeft'))}}
			</div>
			<div class="form-group">
				{{Form::label('item[name]','نام منو')}}
				{{Form::text('item[name]',$menu_type->name,array('placeholder' => 'مثال: منوی هدر','class' => 'form-control'))}}
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					{{Form::checkbox('item[enabled]','itemEnabled',(empty($menu_type->disabled)?true:false))}} فعال
				</label>
			</div>
			<div class="btn-group pull-left">
				<a href="{{URL::to('admin/menu_type')}}" class="btn btn-default">بازگشت</a>
				<button type="submit" class="btn btn-success">ویرایش</button>
			</div>
		{{Form::close()}}
	</div>

</div>
@stop
