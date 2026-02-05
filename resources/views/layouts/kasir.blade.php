<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CetakKu - Kasir')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @include('components.kasir.sidebar')

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Header --}}
            <x-kasir.header 
                :title="$pageTitle ?? 'Dashboard'" 
                :breadcrumbs="$breadcrumbs ?? []" 
            />

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto bg-gray-50">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>