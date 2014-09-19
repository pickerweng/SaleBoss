@extends('admin.layouts.default')
@section('title')
	@parent | روند کار
@stop
@section('breadcrumb')
	@parent
	<li><i class="fa fa-ey"></i>روند کار</li>
@stop
@section('content')
<div class="row">
	<div class="col-sm-12 col-md-6 col-md-offset-3">
		<h3 class="text-center">روندکار</h3>
		@if(!$states->isEmpty())
		<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>#مرحله </th>
						<th>نام مرحله</th>
						<th class="languageLeft">عملیات</th>
					</tr>
				</thead>
				<tbody>
					@foreach($states as $state)
					<tr>
							<td>{{$state->priority}}</td>
							<td>{{$state->title}}</td>
							<td>
								@include('admin.pages.state._operation')
							</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<div class="alert alert-info row">
			<div class="col-sm-12">
				<p>
					شما هنوز روندکاری ایجاد نکرده اید. پس از ایجاد روندکار قادر خواهید بود سفارش را در مرحله های مختلفی قرار دهید و هر یک از آن مراحل را به کاربران یا گروهای از کاربران محول نمایید.
				</p>
			</div>
			<div class="col-sm-12">
				<a href="{{URL::to('states/create')}}" class="btn btn-danger pull-left">+ ایجاد روندکار جدید</a>
			</div>
		</div>
		@endif
	</div>
</div>
@include('admin.blocks.delete_modal')
@stop