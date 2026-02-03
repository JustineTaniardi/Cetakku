<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CetakKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-contain bg-center h-screen overflow-hidden"
    style="background-image: url('{{ asset('images/login_bg.jpg') }}'); 
            background-size: cover; background-position: center;">
    <div class="h-screen flex flex-col lg:flex-row">
        <!-- Left Section - Background Image (Layer 1) -->
        <div class="hidden lg:flex lg:w-3/5 relative">
            
            <!-- Title -->
            <div class="absolute bottom-8 md:bottom-16 left-8 md:left-16 max-w-3xl md:max-w-4xl">
                <h1 class="font-inter text-white text-3xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6 md:mb-6">
                    Kerja Rapi, Kinerja Efisien,<br>
                    Maksimalkan Hasil.
                </h1>
                <p class="text-white text-sm md:text-lg lg:text-xl leading-relaxed">
                    Masuk untuk mengelola pekerjaan. Akses cepat ke<br>
                    sistem manajemen digital printing perusahaan.
                </p>
            </div>
        </div>
        <!-- Right Section - Login Form (Layer 2) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center md:p-8 lg:p-12 lg:mr-0">
            <div class="w-full max-w-sm md:max-w-md lg:max-w-2xl bg-white rounded-xl md:rounded-1xl px-12 md:px-12 py-12 md:py-16 lg:py-20 lg:px-20 shadow-xl relative">
            <!-- Kembali Button -->
            <div class="absolute top-6 right-5 md:top-8 md:right-8 lg:top-10 lg:right-16">
                    <a href="/"
                        class="inline-flex items-center gap-2
                                bg-purple-900 hover:bg-purple-800
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

                <h2 class="text-3xl md:text-4xl lg:text-6xl font-bold text-gray-900 mb-2 mt-12">Masukkan Akun.</h2>
                <p class="text-gray-600 text-sm md:text-base mb-6 md:mb-8">Akses cepat ke sistem digital printing perusahaan.</p>
                
                <form class="space-y-4 md:space-y-5 py-12">
                    <!-- Username -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Username</label>
                        <input type="text" placeholder="Masukkan nama pengguna" 
                            class="w-full px-3 md:px-4 py-2 md:py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-xs md:text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" id="passwordInput" placeholder="Masukkan kata sandi" 
                                class="w-full px-3 md:px-4 py-2 md:py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition pr-10">
                            <button type="button"  class="absolute right-3 top-2.5 md:top-3.5 text-gray-400 hover:text-gray-600 transition">
                            </button>
                        </div>
                    </div>
                    <br>
                    <!-- Login Button -->
                    <button type="submit" class="w-full bg-purple-900 hover:bg-purple-800 text-white font-semibold md:py-3.5 py-3 text-sm md:text-base rounded-lg transition duration-200">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>