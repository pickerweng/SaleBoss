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
		@include('panel.partials.dashboard_stylesheets')
	@show
</head>
<body class="{{$bodyClasses or ''}}" id="{{$bodyIds or ''}}">

	@yield('content')

	@section('scripts')
		@include('panel.partials.dashboard_scripts')
	@show
</body>
</html>