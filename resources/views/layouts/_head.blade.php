	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="@yield('favicon', asset('storage/favicon.png'))">
		@vite(['resources/js/app.js'])
		<script src="https://ssstuart.net/js/IIIcons.js" defer></script>
		<script src="https://ssstuart.net/js/WWWidget.js" defer></script>

		<title>@yield('title', config('app.name'))</title>
		<meta name="author" content="SSStuart">
		<meta name="description" content="@yield('description')">
		<meta property="og:description" content="@yield('description')">
		<meta property="og:title" content="@yield('title', config('app.name'))">
		<meta property="og:url" content="{{ url()->current() }}" >
		<meta property="og:type" content="website">
		<meta property="twitter:site" content="@yield('title', config('app.name'))">
    	<meta name="theme-color" content="#c285a6">
		@stack('header_additional')

		<meta name="csrf-token" content="{{ csrf_token() }}">

		@vite(['resources/css/app.css'])
		@stack('styles')
	</head>