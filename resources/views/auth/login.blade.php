<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CetakKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-center h-screen overflow-hidden"
    style="background-image: url('{{ asset('images/login_bg.jpg') }}'); 
            background-size: cover; background-position: center;">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Section - Background Image (Layer 1) -->
        <div class="hidden lg:flex lg:w-3/5 relative">
            
            <!-- Title -->
            <div class="absolute bottom-8 md:bottom-16 left-8 md:left-16 md:max-w-3xl">
                <h1 class="font-inter text-white text-2xl lg:text-5xl font-bold leading-tight mb-6 md:mb-6">
                    Kerja Rapi, Kinerja Efisien,<br>
                    Maksimalkan Hasil.
                </h1>
                <p class="text-white text-sm md:text-lg lg:text-lg leading-relaxed">
                    Masuk untuk mengelola pekerjaan. Akses cepat ke<br>
                    sistem manajemen digital printing perusahaan.
                </p>
            </div>
        </div>
        <!-- Right Section - Login Form (Layer 2) -->
    <div class="w-full lg:w-[45%] flex items-center justify-center p-6 md:p-10 lg:p-12">
        <div class="w-full
                max-w-sm md:max-w-md lg:max-w-3xl
                min-h-105 md:min-h-120 lg:min-h-150
                bg-white rounded-xl
                px-6 md:px-10 lg:px-16
                py-10 md:py-12
                shadow-xl relative">
            <!-- Kembali Button -->
            <div class="absolute top-8 md:top-8 lg:top-12 right-5 md:right-10 lg:right-14">
                    <a href="/"
                        class="inline-flex items-center gap-2
                                bg-purple-950 hover:bg-purple-800
                                text-white font-medium
                                text-xs md:text-sm
                                px-4 py-2
                                rounded-lg
                                transition">
                Kembali
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                </a>
            </div>
                <h2 class="text-2xl md:text-3xl font-bold mt-24 mb-2">Masukkan Akun.</h2>
                <p class="text-sm md:text-base text-gray-600">Akses cepat ke sistem digital printing perusahaan.</p>
                <form class="space-y-2 md:space-y-2 py-12" method="POST" action="/login">
                    @csrf
                    <!-- Username -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2" for="email">Email</label>
                        <input type="text" placeholder="Masukkan nama pengguna" name="email" id="email"
                            class="w-full px-3 md:px-4 py-2 md:py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition">
                    </div>
                    <!-- Password -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2" for="password">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" 
                                class="w-full px-3 md:px-4 py-2 md:py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition pr-10">
                            
                        </div>
                    </div>
                    <!-- Login Button -->
                    <button type="submit" class="w-full bg-purple-950 hover:bg-purple-800 text-white font-semibold md:py-3.5 py-3 text-sm md:text-base rounded-lg transition duration-200 mt-4">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>