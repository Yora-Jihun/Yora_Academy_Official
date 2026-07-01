<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $doc->title ?? 'Documentation' }} - Yora Academy</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="{{ $doc->description ?? 'Public documentation' }}">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <style>
        .tree-item.active {
            background: #F5F6FF;
            color: #5B5FEF;
        }
        .tree-item.active svg {
            stroke: #5B5FEF;
        }
    </style>
</head>
<body class="min-h-screen bg-white font-sans antialiased">
    <div class="flex h-screen">
        @include('livewire.docs.partials.public-sidebar', ['active' => $active ?? 'explore', 'doc' => $doc])
        <div class="flex-1 flex flex-col min-w-0 md:ml-[280px]">
            @include('livewire.docs.partials.public-navbar')
            <div class="flex flex-1 min-h-0">
                @include('livewire.docs.partials.public-explorer', ['doc' => $doc, 'currentPage' => $currentPage ?? null])
                <main class="flex-1 flex min-h-0">
                    @hasSection('content')
                        @yield('content')
                    @else
                        {{ $slot }}
                    @endif
                </main>
                @include('livewire.docs.partials.public-properties', ['doc' => $doc, 'currentPage' => $currentPage ?? null])
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>