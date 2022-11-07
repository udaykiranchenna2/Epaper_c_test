<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">

    <!-- Scripts -->
    @routes
    @vite('resources/js/app.js')
    {{-- @vite(asset('dist/css/app.css')) --}}
    @inertiaHead
</head>

<body class="font-sans antialiased py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
    @inertia
</body>

</html>
