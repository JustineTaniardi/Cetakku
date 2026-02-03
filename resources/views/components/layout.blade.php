    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetakku</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="">
    <div class="flex min-h-screen">

        {{-- SIDEBAR (kiri) --}}
        <x-sidebar" />

        {{-- AREA KANAN --}}
        <div class="flex-1 flex flex-col">

            {{-- NAVBAR (atas) --}}
            <x-navbar" />

            {{-- CONTENT --}}
            <main class="flex-1 p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</body>
</html>