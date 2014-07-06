<!DOCTYPE html>
<!--[if IE 8]>
<html lang="fa" class="ie8">
<![endif]-->
<!--[if IE 9]>
<html lang="fa" class="ie9">
<![endif]-->
<!--[if !IE]><!-->
<html lang="fa">
<!--<![endif]-->
<head>
	<meta charset="utf-8"/>
	<title>{{$title or 'پنل فروش'}}</title>

	@section('stylesheets')
		@include('panel.partials.stylesheets')
	@show
</head>
<body class="{{$bodyClasses or ''}}" id="{{$bodyIds or ''}}">
	@include('panel.partials.guest_header')
	@yield('content')
	@section('scripts')
		@include('panel.partials.scripts')
	@show
</body>
</html>