@if($errors->has() || Session::has('error_message'))
<ul class="alert alert-danger alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	@if($errors->has())
	@foreach($errors->all() as $error)
	<li style="font-size:12px;">{{$error}}</li>
	@endforeach
	@endif
	@if(Session::has('error_message'))
	<li style="font-size:12px;">{{Session::get('error_message')}}</li>
	@endif
</ul>
@endif
@if(Session::has('success_message'))
<ul class="alert alert-success alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<p>{{Session::get('success_message')}}</p>
</ul>
@endif