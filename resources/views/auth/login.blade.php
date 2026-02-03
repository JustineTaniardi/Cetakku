<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CetakKu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cover bg-center min-h-screen"
    style="background-image: url('{{ asset('build/assets/img/login_bg.jpg') }}'); 
            background-size: cover; background-position: center; background-attachment: fixed;">
    
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Section - Background Image (Layer 1) -->
        <div class="hidden lg:flex lg:w-6/10 relative">
            
            <!-- Title -->
            <div class="absolute bottom-8 md:bottom-16 left-8 md:left-18 max-w-3xl md:max-w-4xl shadow-2xl">
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
        <div class="w-full lg:w-5/10 flex items-center justify-center p-4 md:p-8 lg:p-12 mr-3 lg:mr-0">
            <div class="w-full max-w-sm md:max-w-md lg:max-w-2xl bg-white rounded-xl md:rounded-1xl px-12 md:px-12 py-20 md:py-16 lg:py-54 lg:px-20 shadow-xl relative">
            <!-- Kembali Button -->
            <div class="absolute top-12 right-5 md:top-8 md:right-8 lg:top-18 lg:right-18">
                <button class="text-gray-700 hover:text-gray-900 font-medium text-xs md:text-sm flex items-center gap-1">
                Kembali
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                </button>
            </div>

                <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-2">Masukkan Akun.</h2>
                <p class="text-gray-600 text-sm md:text-base mb-6 md:mb-8">Akses cepat ke sistem digital printing perusahaan.</p>
                
                <form class="space-y-4 md:space-y-5">
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
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-2.5 md:top-3.5 text-gray-400 hover:text-gray-600 transition">
                                <svg id="eyeIcon" class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-2 md:gap-0">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                            <span class="text-xs md:text-sm text-gray-600">Ingat akun saya</span>
                        </label>
                        <a href="#" class="text-xs md:text-sm text-purple-600 hover:text-purple-700 font-medium">Lupa kata sandi?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full bg-purple-900 hover:bg-purple-800 text-white font-semibold py-2 md:py-3 text-sm md:text-base rounded-lg transition duration-200">
                        Masuk
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-xs md:text-sm">
                            <span class="px-2 bg-white text-gray-500">atau lanjutkan dengan</span>
                        </div>
                    </div>

                    <!-- Google Login -->
                    <button type="button" class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2 md:py-3 text-sm md:text-base hover:bg-gray-50 transition">
                        <svg class="w-4 h-4 md:w-5 md:h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="text-gray-700 font-medium">Masuk dengan Google</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('passwordInput');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/><path d="M12 14c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>';
            }
        }
    </script>
</body>
</html>