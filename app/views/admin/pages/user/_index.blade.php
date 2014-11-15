@extends('admin.layouts.default')
@section('breadcrumb')
	@parent
	<li class="active"><i class="fa fa-user"></i> کاربران</li>
@stop
@section('content')
<div class="row">
	<div class="col-12">
		<a href="{{URL::to('admin/user/create')}}" class="btn btn-success">ایجاد کاربر جدید</a>
		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<th>#{{Lang::get('strings.id')}}</th>
					<th class="text-center">{{Lang::get('strings.email')}}</th>
					<th class="text-center">{{Lang::get('strings.username')}}</th>
					<th class="text-center">{{Lang::get('strings.name')}}</th>
					<th class="languageLeft">{{Lang::get('strings.operation')}}</th>
				</thead>
				<tbody>
					@foreach($data as $id => $user)
					<tr>
						<td>{{$user->id}}</td>
						<td class="text-center">{{$user->email}}</td>
						<td class="text-center">{{$user->username}}</td>
						<td class="text-center">{{$user->first_name}} {{$user->last_name}}</td>
						<td>
							<a href="{{URL::to('admin/user/' . $user->id . '/edit')}}" class="btn operation-margin btn-xs pull-left btn-info radius Nassim">ویرایش</a>
							<button 
								type="button"
								class="btn btn-xs pull-left margin-right btn-danger radius Nassim"
								delete-url="{{URL::to('admin/user/' . $user->id)}}"
								onclick="Common.setDeleteURL(this,'#delete_form')"
								data-toggle="modal" 
								data-target="#removeModal">حذف</button>
						</td> 
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{$data->links()}}
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop