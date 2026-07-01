<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yora Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="Yora Academy - Create and manage beautiful documentation">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
</head>
<body class="min-h-screen bg-white font-sans antialiased">
    <div class="flex h-screen">
        @include('livewire.docs.partials.sidebar', ['active' => $active ?? 'docs'])
        <div class="flex-1 flex flex-col min-w-0 md:ml-[250px]">
            @include('livewire.docs.partials.headnavbar')
            <div class="flex flex-1 min-h-0">
                @include('livewire.docs.partials.explorer')
                <main class="flex-1 flex min-h-0">
                    @hasSection('content')
                        @yield('content')
                    @else
                        {{ $slot }}
                    @endif
                </main>
                @include('livewire.docs.partials.properties')
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>