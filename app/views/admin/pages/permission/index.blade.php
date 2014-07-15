@extends('admin.layouts.default')
@section('title')
	@parent | لیست دسترسی ها
@stop
@section('breadcrumb')
	@parent
	<li><i class="fa fa-ey"></i>لیست دسترسی ها</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-6 col-md-offset-3">
		<h3 class="text-center">لیست دسترسی ها</h3>
		<div class="table-responsive">
			{{Form::open([
				'method'    =>  'post',
				'url'       =>  'permissions'
			])}}
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>شناسه</th>
						<th>نام دسترسی</th>
						@foreach($groups as $group)
							<th class="text-center">{{$group->display_name}}</th>
						@endforeach
					</tr>
				</thead>
				<tbody>
					@foreach($list as $key => $item)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{Lang::get('permissions.' . $item)}}</td>
						@foreach($groups as $group)
							<td class="text-center">
								{{Form::checkbox(
									"item[{$group->id}][{$item}]",
									! empty($defaults[$group->id][$item]) ? $defaults[$group->id][$item] : false,
									! empty($defaults[$group->id][$item]) ? $defaults[$group->id][$item] : false
								)}}
							</td>
						@endforeach
					</tr>
					@endforeach
				</tbody>
			</table>
			{{Form::submit('ثبت تغییرات',array('class' => 'btn btn-lg btn-success'))}}
		</div>
	</div>
</div>
@stop