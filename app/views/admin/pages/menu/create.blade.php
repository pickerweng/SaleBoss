@extends('admin.layouts.default')
@section('title')
	@parent |  ایجاد آیتم منو
@stop
@section('breadcrumb')
	@parent
	<li><a href="{{URL::to('menu_type')}}"><i class="fa fa-picture-o"></i> منوها</a></li>
	<li class="active"><i class="fa fa-plus"></i> ایجاد آیتم</li>
@stop
@section('content')
<div class="row">
	<div class="col-lg-6 col-md-12">
		{{Form::open(array(
				'url'		=> 	'menu',
				'method'	=>	'post'
			))}}
			<div class="form-group">
				{{Form::label('item[title]','عنوان منو', ['class' => 'control-label Nassim NassimTitle Nassim700'])}}
				{{Form::text('item[title]',null,array('class' => 'form-control','placeholder' => 'عنوان مناسب برای منو'))}}
			</div>
			<div class="form-group">
				{{Form::label('item[uri]','لینک منو', ['class' => 'control-label Nassim NassimTitle Nassim700'])}}
				{{Form::text('item[uri]',null,array('class' => 'form-control languageLeft' , 'placeholder' => 'Example: http://google.com'))}}
			</div>
			<div class="form-group">
				<label class="checkbox-inline">
					{{Form::checkbox('item[disabled]',true,array('class' => 'form-control'))}} فعال
				</label>
			</div>
			<div class="form-group">
				{{Form::label('item[ids]','نوع منو', ['class' => 'control-label Nassim NassimTitle Nassim700'])}}<br>
				{{Form::select('item[ids]', MenuBuilder::select(),null,array('class' => 'form-control'))}}
			</div>
			<br>
			<button type="submit" class="btn btn-success Nassim radius">ایجاد</button>
		{{Form::close()}}
	</div>
</div>
@stop
