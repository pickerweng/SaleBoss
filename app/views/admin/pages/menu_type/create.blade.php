@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('admin/menu_type')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد منو</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{Form::open(array('url' => 'admin/menu_type','method' => 'post'))}}
			<div class="form-group">
				{{Form::label('item[machine_name]','نام ماشینی منو')}}
				{{Form::text('item[machine_name]',null,array('placeholder' => 'Example: header_menu','class' => 'form-control languageLeft'))}}
			</div>
			<div class="form-group">
				{{Form::label('item[name]','نام منو')}}
				{{Form::text('item[name]',null,array('placeholder' => 'مثال: منوی هدر','class' => 'form-control'))}}
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					{{Form::checkbox('item[active]','itemEnabled',(empty($menu->disabled)?true:false))}} فعال
				</label>
			</div>
			<button type="submit" class="btn btn-success pull-left">ایجاد</button>
		{{Form::close()}}
	</div>

</div>
@stop
