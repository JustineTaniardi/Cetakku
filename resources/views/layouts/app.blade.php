<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CetakKu</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include(auth()->user()->role . '.sidebar')

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>

</body>
</html>
