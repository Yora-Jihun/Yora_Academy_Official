<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Settings')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="Settings - Yora Academy">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
</head>
<body class="min-h-screen bg-white font-sans antialiased">
    <div class="flex h-screen">
        @php
            $routeName = request()->route()->getName();
            $activePage = match($routeName) {
                'security-settings' => 'security-settings',
                'profile-settings' => 'profile-settings',
                default => 'settings'
            };
        @endphp
        @include('livewire.docs.partials.sidebar', ['active' => $activePage])
        <div class="flex-1 flex flex-col min-w-0 md:ml-[250px]">
            @include('livewire.docs.partials.headnavbar')
            <main class="flex-1 p-4 md:p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
    @livewireScripts
</body>
</html>