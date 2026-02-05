<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CetakKu</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    @include(auth()->user()->role->name . '.sidebar')

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 flex flex-col overflow-hidden bg-white">
        
        {{-- HEADER --}}
        <header class="bg-white border-b border-gray-200 px-6 py-3.5">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <span>{{ ucfirst(auth()->user()->role->name) }}</span>
                <span class="text-gray-400">></span>
                <span class="text-gray-900 font-medium">@yield('page-title', 'Dashboard')</span>
            </div>
        </header>

        {{-- CONTENT --}}
        <main class="flex-1 overflow-y-auto bg-white p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>