<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Documentation - Yora Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="Explore public documentation from the community">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
</head>
<body class="min-h-screen bg-white font-sans antialiased">
    <div class="flex flex-col h-screen">
        @include('livewire.docs.partials.public-navbar')
        <main class="flex-1 flex min-h-0">
            @hasSection('content')
                @yield('content')
            @else
                {{ $slot }}
            @endif
        </main>
    </div>
    @livewireScripts
</body>
</html>