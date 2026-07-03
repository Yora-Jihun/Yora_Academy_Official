<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(isset($doc) && $doc){{ $doc->title }} - Yora Academy @else Documentation - Yora Academy @endif</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <meta name="description" content="@if(isset($doc) && $doc){{ $doc->description ?? 'Public documentation' }}@else Public documentation @endif">
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
    {{ $slot }}
    @livewireScripts
</body>
</html>