<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CetakKu - @yield('page-title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-gray-50">

<div class="min-h-screen">
    
    {{-- HEADER --}}
    <header class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('kasir.dashboard') }}" class="hover:text-secondary font-medium">CetakKu</a>
            @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
                @foreach($breadcrumbs as $breadcrumb)
                    <span class="text-gray-400">›</span>
                    @if(isset($breadcrumb['url']))
                        <a href="{{ $breadcrumb['url'] }}" class="hover:text-secondary">{{ $breadcrumb['label'] }}</a>
                    @else
                        <span class="text-gray-900 font-medium">{{ $breadcrumb['label'] }}</span>
                    @endif
                @endforeach
            @endif
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="bg-gray-50">
        @yield('content')
    </main>

</div>

@stack('scripts')
</body>
</html>