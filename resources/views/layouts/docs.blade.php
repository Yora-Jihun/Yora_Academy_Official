<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yora Academy')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="Yora Academy - Create and manage beautiful documentation">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    @stack('styles')
</head>
<body class="min-h-screen bg-white font-sans antialiased">
    {{ $slot }}
    @livewireScripts
</body>
</html>