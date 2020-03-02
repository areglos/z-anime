<!DOCTYPE HTML>
<html>
<head>

	<title>My Page - @yield('title')</title>
	@include('theme.partials.head')
</head>
<body class="front-page">
	<div class="wrapper">
		@include('theme.partials.topbar')

		@include('theme.partials.content')

		@include('theme.partials.footer')

		@yield('page-script')
	</div>
</body>
</html>