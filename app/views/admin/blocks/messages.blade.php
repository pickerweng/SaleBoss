	{{-- check if session has message --}}
	@if (Session::has('message'))
		<div class="alert alert-info">
			{{ Session::get('message') }}
		</div>
	@endif
	{{-- check if session has success_message and print it --}}
	@if (Session::has('success_message'))
		<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{{ Session::get('success_message')}}
		</div>
	@endif

	{{-- check if session has error_message and show it --}}
	@if (Session::has('error_message') || $errors->has())
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			@if (Session::has('error_message'))
				{{ Session::get('error_message') }}
			@endif

			@if ($errors->has())
				{{HTML::decode(HTML::ul($errors->all()))}}
			@endif
		</div>
	@endif