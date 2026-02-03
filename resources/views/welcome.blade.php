<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CetakKu - Manajemen Operasional UMKM Percetakan</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <style>
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

    <header class="fixed inset-x-0 top-0 z-50 bg-primary">
    <nav aria-label="Global" class="flex items-center justify-between p-6 lg:px-8">
      <div class="flex lg:flex-1">
        <a href="#" class="-m-1.5 py-1.5 px-2.5">
          <span class="sr-only">CetakKu</span>
          <img src="{{ asset('images/logo cetakku (ungu).png') }}" alt="" class="h-8 w-auto" />
        </a>
      </div>
      <div class="flex lg:hidden">
        <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-tertiary-2">
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      <div class="text-md hidden lg:flex lg:gap-x-14">
        <a href="#" class="font-semibold text-secondary hover:underline">Beranda</a>
        <a href="#feature" class="font-semibold text-secondary hover:underline">Fitur</a>
        <a href="#testimonial" class="font-semibold text-secondary hover:underline">Testimoni</a>
        <a href="#faq" class="font-semibold text-secondary hover:underline">FAQ</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="/login" class="text-sm md:text-base font-medium text-primary border py-1.5 px-4 rounded-md border-none bg-secondary">Masuk</a>
      </div>
    </nav>
    <el-dialog>
      <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
        <div tabindex="0" class="fixed inset-0 focus:outline-none">
          <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-50 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
            <div class="flex items-center justify-between">
              <a href="#" class="-m-1.5 p-1.5">
                <span class="sr-only">CetakKu</span>
                <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="CetakKu Logo" class="h-8 w-auto" />
              </a>
              <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-tertiary-2">
                <span class="sr-only">Close menu</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                  <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </button>
            </div>
            <div class="mt-6 flow-root">
              <div class="-my-6 divide-y divide-white/10">
                <div class="space-y-2 py-6">
                  <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-secondary hover:bg-secondary/5">Beranda</a>
                  <a href="#feature" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-secondary hover:bg-secondary/5">Fitur</a>
                  <a href="#testimonial" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-secondary hover:bg-secondary/5">Testimoni</a>
                  <a href="#faq" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-secondary hover:bg-secondary/5">FAQ</a>
                </div>
                <div class="py-6">
                  <a href="/login" class="-mx-3 block px-3 py-2.5 text-base/7 font-semibold hover:bg-secondary/5 text-primary border rounded-md border-none bg-secondary">Masuk</a>
                </div>
              </div>
            </div>
          </el-dialog-panel>
        </div>
      </dialog>
    </el-dialog>
  </header>

  <main class="overflow-x-hidden">
    {{-- HERO SECTION --}}
    <section class="relative min-h-screen bg-secondary/5 flex items-center">
      {{-- DECORATION CIRCLES --}}
      <div class="absolute -top-15 sm:top-0 -left-10 sm:left-0 w-32 h-32 -translate-x-12 translate-y-20 bg-secondary rounded-full"></div>
      <div class="absolute left-0 bottom-32 w-40 h-40 -translate-x-10 bg-secondary rounded-full opacity-30"></div>
      <div class="absolute left-72 top-40 w-48 h-48 bg-secondary rounded-full opacity-10"></div>
      <div class="absolute left-85 sm:left-120 md:left-180 lg:left-140 xl:left-130 bottom-15 lg:bottom-50 w-24 h-24 bg-secondary rounded-full"></div>

      {{-- CONTENT WRAPPER --}}
      <div class="relative w-full max-w-7xl mx-auto px-6 flex items-center justify-between">
        {{-- TEXT --}}
        <div class="max-w-xl max-lg:mx-auto text-center lg:text-left">
        <h1 class="text-3xl sm:text-4xl font-bold tracking-wide leading-tight mb-4">
          Kelola Operasional
          Percetakan Jadi
          <span class="text-tertiary-1">Lebih Mudah</span>
        </h1>

        <p class="text-sm md:text-base leading-8 mb-6 text-tertiary-2 ">
          Aplikasi Manajemen Operasional UMKM Percetakan adalah solusi berbasis web yang membantu
          mengelola order, produksi, dan keuangan percetakan dalam satu sistem yang terintegrasi.
          Dirancang khusus untuk UMKM percetakan agar proses kerja lebih rapi, cepat, dan minim kesalahan.
        </p>

        <a href="/login" class="inline-block text-sm md:text-base text-primary py-3 px-8 rounded bg-secondary">Gabung Sekarang</a>
        </div>

        {{-- BIG CIRCLE IMAGE --}}
        <div class="relative hidden lg:block">
          <div class="w-200 h-200 rounded-full overflow-hidden absolute -right-80 -bottom-65 translate-x-32 translate-y-32">
            <img src="{{ asset('images/Rai.png') }}" class="w-full h-full object-cover" alt="Hero Image">
          </div>
        </div>
      </div>
    </section>

  {{-- FEATURE SECTION --}}
  <section class="pt-30" id="feature">
    <div class="max-w-7xl mx-auto px-6 w-full justify-center text-center">
      <h2 class="text-3xl sm:text-4xl font-bold tracking-wide leading-tight mb-1"><span class="text-tertiary-1">Kenapa harus</span> pakai CetakKu?</h2>
      <p class="text-sm md:text-base leading-8 mb-6 text-secondary font-medium">CetakKu adalah solusi yang dirancang khusus untuk UMKM percetakan, membantu mengelola order, produksi, dan keuangan yang mudah digunakan dan efisien</p>
    </div>
    <div class="max-w-7xl mx-auto px-6 relative">
      <!-- Carousel -->
      <div class="carousel-container grid grid-flow-col auto-cols-[85%] sm:auto-cols-[45%] lg:auto-cols-[30%] gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory scrollbar-hide">

        <!-- Card -->
        <div class="snap-start bg-primary border border-tertiary-3 rounded-xl p-8 text-center">
          <div class="flex justify-center">
            <div class="w-32 h-32 flex items-center justify-center">
              <svg class="w-32 h-32 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path fill="#370C5A" fill-rule="evenodd" d="M42.667 85.332h426.666v341.333H42.667zm192 256h42.666v21.333h-42.666zm106.666-64h-42.666v85.333h42.666zm21.334-42.667h42.666v128h-42.666zm64-106.666H85.333v42.666h341.334zm-192 160c0 41.237-33.43 74.666-74.667 74.667s-74.7-33.429-74.7-74.7c0-41.288 33.5-75 75-75s75 33.712 75 75m-51.89 -99a59 59 0 0 0 -8 -8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.8-.8l-.9 .9a59 59 0 0 0 -9 -9a59 59 0 0 -1 -9 -9a59 59 0 0 -1 -9 -9a59 59 0 0 -1 -9 -9a59 59 0 0 -1 -9 -9a59 59 0 #FFDABE" clip-rule="evenodd"/></svg>
            </div>
          </div>
          <h3 class="font-semibold text-md lg:text-lg mb-1">
            Dashboard Monitoring
          </h3>
          <p class="text-tertiary-2 text-sm leading-relaxed">
            Pantau aktivitas order dan kondisi usaha secara real-time
          </p>
        </div>

        <!-- Card -->
        <div class="snap-start bg-primary border border-tertiary-3 rounded-xl p-8 text-center">
          <div class="flex justify-center">
            <div class="w-32 h-32 flex items-center justify-center">
              <svg class="w-32 h-32 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path fill="#370C5A" d="M1 17.2q0-.85.438-1.562T2.6 14.55q1.55-.775 3.15-1.162T9 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T17 17.2v.8q0 .825-.587 1.413T15 20H3q-.825 0-1.412-.587T1 18zM18.45 20q.275-.45.413-.962T19 18v-1q0-1.1-.612-2.113T16.65 13.15q1.275.15 2.4.513t2.1.887q.9.5 1.375 1.112T23 17v1q0 .825-.587 1.413T21 20zM9 12q-1.65 0-2.825-1.175T5 8t1.175-2.825T9 4t2.825 1.175T13 8t-1.175 2.825T9 12m10-4q0 1.65-1.175 2.825T15 12q-.275 0-.7-.062t-.7-.138q.675-.8 1.038-1.775T15 8t-.362-2.025T13.6 4.2q.35-.125.7-.163T15 4q1.65 0 2.825 1.175T19 8"/></svg>
            </div>
          </div>
          <h3 class="font-semibold text-md lg:text-lg mb-1">
            Manajemen Pengguna
          </h3>
          <p class="text-tertiary-2 text-sm leading-relaxed">
            Atur peran admin, kasir, dan pekerja mesin sesuai kebutuhan operasional
          </p>
        </div>

        <!-- Card -->
        <div class="snap-start bg-primary border border-tertiary-3 rounded-xl p-8 text-center">
          <div class="flex justify-center">
            <div class="w-32 h-32 flex items-center justify-center">
              <svg class="w-32 h-32 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24"><path fill="#370C5A" d="M8 3.5A1.5 1.5 0 0 1 9.5 2h5A1.5 1.5 0 0 1 16 3.5v1A1.5 1.5 0 0 1 14.5 6h-5A1.5 1.5 0 0 1 8 4.5z"/><path fill="#370C5A" fill-rule="evenodd" d="M6.5 4.037c-1.258.07-2.052.27-2.621.84C3 5.756 3 7.17 3 9.998v6c0 2.829 0 4.243.879 5.122c.878.878 2.293.878 5.121.878h6c2.828 0 4.243 0 5.121-.878c.879-.88.879-2.293.879-5.122v-6c0-2.828 0-4.242-.879-5.121c-.569-.57-1.363-.77-2.621-.84V4.5a3 3 0 0 1-3 3h-5a3 3 0 0 1-3-3zM6.25 10.5A.75.75 0 0 1 7 9.75h10a.75.75 0 0 1 0 1.5H7a.75.75 0 0 1-.75-.75m1 3.5a.75.75 0 0 1 .75-.75h8a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m1 3.5a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75" clip-rule="evenodd"/></svg>
            </div>
          </div>
          <h3 class="font-semibold text-md lg:text-lg mb-1">
            Manajemen Order
          </h3>
          <p class="text-tertiary-2 text-sm leading-relaxed">
            Kelola order percetakan secara rapi dan terstruktur
          </p>
        </div>

        <!-- Card -->
        <div class="snap-start bg-primary border border-tertiary-3 rounded-xl p-8 text-center">
          <div class="flex justify-center">
            <div class="w-32 h-32 flex items-center justify-center mb-1">
              <svg class="w-32 h-32 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path fill="#370C5A" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85c-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28c77.418-.07 144.315-53.144 162.787-126.849c1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24"/></svg>
            </div>
          </div>
          <h3 class="font-semibold text-md lg:text-lg mb-1">
            Alur Kerja Produksi
          </h3>
          <p class="text-tertiary-2 text-sm leading-relaxed">
            Order dari kasir langsung diteruskan ke pekerja mesin tanpa miskomunikasi
          </p>
        </div>

        <!-- Card -->
        <div class="snap-start bg-primary border border-tertiary-3 rounded-xl p-8 text-center">
          <div class="flex justify-center">
            <div class="w-32 h-32 flex items-center justify-center mb-0.5">
              <svg class="w-32 h-32 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#370C5A" fill-rule="evenodd" d="M14.25 2.5a.25.25 0 0 0-.25-.25H7A2.75 2.75 0 0 0 4.25 5v14A2.75 2.75 0 0 0 7 21.75h10A2.75 2.75 0 0 0 19.75 19V9.147a.25.25 0 0 0-.25-.25H15a.75.75 0 0 1-.75-.75zm.75 9.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5zm0 4a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5z" clip-rule="evenodd"/><path fill="#370C5A" d="M15.75 2.824c0-.184.193-.301.336-.186q.182.147.323.342l3.013 4.197c.068.096-.006.22-.124.22H16a.25.25 0 0 1-.25-.25z"/></svg>
            </div>
          </div>
          <h3 class="font-semibold text-md lg:text-lg mb-1">
            Transaksi & Invoice
          </h3>
          <p class="text-tertiary-2 text-sm leading-relaxed">
            Kelola transaksi, status pembayaran, dan invoice dengan aman dan mudah
          </p>
        </div>

        <!-- Card -->
        <div class="snap-start bg-primary border border-tertiary-3 rounded-xl p-8 text-center">
          <div class="flex justify-center">
            <div class="w-32 h-32 flex items-center justify-center mb-0.5">
              <svg class="w-32 h-32 flex items-center justify-center" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#370C5A" d="M17 3.34A10 10 0 1 1 2 12l.005-.324A10 10 0 0 1 17 3.34M12 6a1 1 0 0 0-1 1a3 3 0 1 0 0 6v2a1.02 1.02 0 0 1-.866-.398l-.068-.101a1 1 0 0 0-1.732.998a3 3 0 0 0 2.505 1.5H11a1 1 0 0 0 .883.994L12 18a1 1 0 0 0 1-1l.176-.005A3 3 0 0 0 13 11V9c.358-.012.671.14.866.398l.068.101a1 1 0 0 0 1.732-.998A3 3 0 0 0 13.161 7H13a1 1 0 0 0-1-1m1 7a1 1 0 0 1 0 2zm-2-4v2a1 1 0 0 1 0-2"/></svg>
            </div>
          </div>
          <h3 class="font-semibold text-md lg:text-lg mb-1">
            Pengelolaan Keuangan
          </h3>
          <p class="text-tertiary-2 text-sm leading-relaxed">
            Kelola pendapatan, pengeluaran, serta hutang dan piutang secara tertata
          </p>
        </div>

      </div>

      <!-- Arrow Buttons -->
      <button class="hidden lg:flex absolute right-0 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-secondary text-primary items-center justify-center hover:cursor-pointer" id="carousel-right-btn" onclick="document.querySelector('.carousel-container').scrollBy({ left: 300, behavior: 'smooth' })">
        →
      </button>
      <button class="hidden lg:flex absolute left-0 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-secondary text-primary items-center justify-center hover:cursor-pointer" id="carousel-left-btn" onclick="document.querySelector('.carousel-container').scrollBy({ left: -300, behavior: 'smooth' })">
        ←
      </button>

    </div>

  </section>

  {{-- TESTIMONIAL SECTION --}}
  <section id="testimonial" class="pt-30">
    <div class="max-w-7xl mx-auto px-6 w-full justify-center text-center">
      <span class="text-secondary text-xl tracking-[5px] font-semibold">Testimoni</span>
      <h1 class="text-3xl sm:text-4xl font-bold tracking-wide leading-tight">Apa yang <span class="text-tertiary-1">pengguna kami katakan</span></h1>
    </div>

    <div class="max-w-7xl mx-auto px-6 pt-25">
      <div class="grid gap-y-24 gap-8 sm:grid-cols-2 lg:grid-cols-3">

    <!-- Card -->
    <div class="relative bg-primary rounded-xl border border-tertiary-3 p-6 pt-12 lg:pt-22 text-center">
      <div class="absolute bg-primary w-45 h-30 lg:w-55 lg:h-40 -top-20 left-1/2 -translate-x-1/2">
        <img src="{{ asset('images/cp2 girl.jpg') }}" alt="Ani Suriani" class="w-30 h-30 lg:w-38 lg:h-38 rounded-full object-cover absolute items-center justify-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" />
      </div>
      <h3 class="text-lg lg:text-xl font-bold">Ani Suriani</h3>
      <p class="text-tertiary-1 font-medium text-md">Admin percetakan E</p>
      <p class="text-tertiary-2 mt-1 text-sm leading-relaxed">
        Input order cepat dan jelas. Pencatatan jadi lebih rapi dan minim kesalahan.
      </p>
    </div>

    <!-- Card -->
    <div class="relative bg-primary rounded-xl border border-tertiary-3 p-6 pt-12 lg:pt-22 text-center">
      <div class="absolute bg-primary w-45 h-30 lg:w-55 lg:h-40 -top-20 left-1/2 -translate-x-1/2">
        <img src="{{ asset('images/cp2 boy.jpg') }}" alt="Budi Santoso" class="w-30 h-30 lg:w-38 lg:h-38 rounded-full object-cover absolute items-center justify-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" />
      </div>
      <h3 class="text-lg lg:text-xl font-bold">Budi Santoso</h3>
      <p class="text-tertiary-1 font-medium text-md">Admin percetakan A</p>
      <p class="text-tertiary-2 mt-1 text-sm leading-relaxed">
        Semua data order dan laporan tersimpan rapi. Pengelolaan usaha jadi lebih mudah dan terkontrol.
      </p>
    </div>

    <!-- Card -->
    <div class="relative bg-primary rounded-xl border border-tertiary-3 p-6 pt-12 lg:pt-22 text-center">
      <div class="absolute bg-primary w-45 h-30 lg:w-55 lg:h-40 -top-20 left-1/2 -translate-x-1/2">
        <img src="{{ asset('images/girl.jpg') }}" alt="Siti Aisyah" class="w-30 h-30 lg:w-38 lg:h-38 rounded-full object-cover absolute items-center justify-center top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" />
      </div>
      <h3 class="text-lg lg:text-xl font-bold">Siti Aisyah</h3>
      <p class="text-tertiary-1 font-medium text-md">Admin percetakan F</p>
      <p class="text-tertiary-2 mt-1 text-sm leading-relaxed">
        Detail order mudah dilihat. Pekerjaan jadi lebih terarah dan efisien.
      </p>
    </div>
      </div>
    </div>
  </section>

  {{-- FAQ SECTION --}}
  <section class="py-30" id="faq">
    <div class="max-w-7xl bg-secondary/5 mx-auto p-10 w-full justify-between rounded-xl grid gap-12 sm:grid-cols-2">
      {{-- Left Section --}}
      <div class="max-w-lg">
        <h2 class="text-3xl sm:text-4xl font-bold tracking-wide leading-tight mb-1">Frequently <span class="text-tertiary-4">Asked Question</span></h2>
        <p class="text-sm md:text-base leading-8 mb-6 text-tertiary-1 font-medium">Bingung? Kami Punya Jawabannya</p>
        <img src="{{ asset('images/faq image.png') }}" alt="FAQ Image" class="w-full h-auto"/>
      </div>

      {{-- Right Section --}}
      <div class="max-w-xl mx-auto space-y-4">

        <!-- Item -->
        <div class="border border-tertiary-3 rounded-xl bg-primary max-w-md">
          <button class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-sm md:text-md lg:text-base" onclick="toggleAccordion(1)">
            <span>Apa itu Aplikasi Manajemen Operasional UMKM Percetakan?</span>
            <svg id="icon-1" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="content-1" class="px-5 pb-4 hidden text-tertiary-2 text-sm">
            Aplikasi berbasis web yang membantu mengelola order, produksi, pelanggan, dan keuangan percetakan secara terintegrasi.
          </div>
        </div>

        <!-- Item -->
        <div class="border border-tertiary-3 rounded-xl bg-primary max-w-md">
          <button class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-sm md:text-md lg:text-base" onclick="toggleAccordion(2)">
            <span>Siapa saja yang dapat menggunakan aplikasi ini?</span>
            <svg id="icon-2" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="content-2" class="px-5 pb-4 hidden text-tertiary-2 text-sm">
            Pemilik UMKM percetakan, admin, kasir, hingga bagian produksi.
          </div>
        </div>

        <!-- Item -->
        <div class="border border-tertiary-3 rounded-xl bg-primary max-w-md">
          <button class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-sm md:text-md lg:text-base" onclick="toggleAccordion(3)">
            <span>Apakah aplikasi ini sulit digunakan?</span>
            <svg id="icon-3" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="content-3" class="px-5 pb-4 hidden text-tertiary-2 text-sm">
            Tidak. Aplikasi dirancang user-friendly dan mudah dipahami.
          </div>
        </div>

        <!-- Item -->
        <div class="border border-tertiary-3 rounded-xl bg-primary max-w-md">
          <button class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-sm md:text-md lg:text-base" onclick="toggleAccordion(4)">
            <span>Apakah data transaksi dan pelanggan aman?</span>
            <svg id="icon-4" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="content-4" class="px-5 pb-4 hidden text-tertiary-2 text-sm">
            Kami mengutamakan keamanan data dengan enkripsi dan sistem proteksi terkini.
          </div>
        </div>

        <!-- Item -->
        <div class="border border-tertiary-3 rounded-xl bg-primary max-w-md">
          <button class="w-full flex justify-between items-center px-5 py-4 text-left font-semibold text-sm md:text-md lg:text-base" onclick="toggleAccordion(5)">
            <span>Apakah status order bisa dipantau?</span>
            <svg id="icon-5" class="w-5 h-5 transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="content-5" class="px-5 pb-4 hidden text-tertiary-2 text-sm">
            Ya, status order dapat dipantau secara real-time dari dashboard.
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- FOOTER SECTION --}}
  <footer class="bg-violet-900 text-primary text-sm md:text-base pb-10">
    <div class="flex lg:items-center mx-10 justify-between py-6 lg:px-8 max-w-7xl lg:mx-auto flex-col lg:flex-row gap-6 xl:gap-10">

      {{-- Left Section --}}
      <div>
        <a href="#" class="inline-block">
          <img src="{{ asset('images/logo cetakku.png') }}" alt="" class="h-10 lg:h-12 w-auto" />
        </a>
        <p class="md:pt-1.5 pb-3 font-md">Kelola percetakan lebih mudah.</p>
        
        {{-- Social Media Logo --}}
        <div class="flex gap-3">

          <a href="https://www.facebook.com" target="_blank" class="w-10 h-10 rounded-full bg-primary items-center justify-center flex hover:cursor-pointer hover:scale-105 hover:shadow transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#370C5A" d="M9.198 21.5h4v-8.01h3.604l.396-3.98h-4V7.5a1 1 0 0 1 1-1h3v-4h-3a5 5 0 0 0-5 5v2.01h-2l-.396 3.98h2.396z"/></svg>
          </a>
          <a href="https://www.instagram.com" target="_blank" class="w-10 h-10 rounded-full bg-primary items-center justify-center flex hover:cursor-pointer hover:scale-105 hover:shadow transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#370C5A" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3"/></svg>
          </a>
          <a href="https://www.whatsapp.com" target="_blank" class="w-10 h-10 rounded-full bg-primary items-center justify-center flex hover:cursor-pointer hover:scale-105 hover:shadow transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#370C5A" d="M19.05 4.91A9.82 9.82 0 0 0 12.04 2c-5.46 0-9.91 4.45-9.91 9.91c0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21c5.46 0 9.91-4.45 9.91-9.91c0-2.65-1.03-5.14-2.9-7.01m-7.01 15.24c-1.48 0-2.93-.4-4.2-1.15l-.3-.18l-3.12.82l.83-3.04l-.2-.31a8.26 8.26 0 0 1-1.26-4.38c0-4.54 3.7-8.24 8.24-8.24c2.2 0 4.27.86 5.82 2.42a8.18 8.18 0 0 1 2.41 5.83c.02 4.54-3.68 8.23-8.22 8.23m4.52-6.16c-.25-.12-1.47-.72-1.69-.81c-.23-.08-.39-.12-.56.12c-.17.25-.64.81-.78.97c-.14.17-.29.19-.54.06c-.25-.12-1.05-.39-1.99-1.23c-.74-.66-1.23-1.47-1.38-1.72c-.14-.25-.02-.38.11-.51c.11-.11.25-.29.37-.43s.17-.25.25-.41c.08-.17.04-.31-.02-.43s-.56-1.34-.76-1.84c-.2-.48-.41-.42-.56-.43h-.48c-.17 0-.43.06-.66.31c-.22.25-.86.85-.86 2.07s.89 2.4 1.01 2.56c.12.17 1.75 2.67 4.23 3.74c.59.26 1.05.41 1.41.52c.59.19 1.13.16 1.56.1c.48-.07 1.47-.6 1.67-1.18c.21-.58.21-1.07.14-1.18s-.22-.16-.47-.28"/></svg>
          </a>
          <a href="https://www.x.com" target="_blank" class="w-10 h-10 rounded-full bg-primary items-center justify-center flex hover:cursor-pointer hover:scale-105 hover:shadow transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><path fill="#370C5A" d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z"/></svg>
          </a>
        </div>
      </div>

       {{-- Right Section --}}
      <div class="flex flex-col gap-4 lg:flex-row lg:gap-20">
          <div>
            <span class="font-bold block pb-2">About Us</span>
            <a href="#" class="pb-2 block hover:underline ">Beranda</a>
            <a href="#feature" class="pb-2 block hover:underline">Fitur</a>
            <a href="#faq" class="pb-2 block hover:underline">FAQ</a>
            <a href="/login" class="pb-2 block hover:underline">Masuk</a>
          </div>
          <div>
            <span class="font-bold block pb-2">Contact Us</span>
            <p class="pb-2">Email: digitalprinting@email.com</p>
            <p class="pb-2">Phone: 0812-3456-7890</p>
          </div>
      </div>
    </div>

    <div class="text-center">
      <hr class="w-4/5 mx-auto pb-6" />
      <span class="">&copy; 2026 CetakKu. All rights reserved.</span>
    </div>
  </footer>
        
  <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

  <script>
    // Close mobile menu when clicking on navigation links
    function closeMobileMenu() {
      const closeButton = document.querySelector('button[commandfor="mobile-menu"][command="close"]');
      if (closeButton) {
        closeButton.click();
      }
    }

    // Add click listeners to mobile menu links
    document.addEventListener('DOMContentLoaded', function() {
      const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
      mobileMenuLinks.forEach(link => {
        link.addEventListener('click', closeMobileMenu);
      });
    });

    // Carousel arrow button visibility handler
    const carousel = document.querySelector('.carousel-container');
    const leftBtn = document.getElementById('carousel-left-btn');
    const rightBtn = document.getElementById('carousel-right-btn');

    function updateArrowButtons() {
      const scrollLeft = carousel.scrollLeft;
      const scrollWidth = carousel.scrollWidth;
      const clientWidth = carousel.clientWidth;
      const isDesktop = window.matchMedia('(min-width: 1024px)').matches;

      if (scrollLeft > 0 && isDesktop) {
        leftBtn.classList.remove('hidden');
        leftBtn.classList.add('lg:flex', 'opacity-100');
        leftBtn.classList.remove('opacity-50');
        leftBtn.disabled = false;
      } else {
        leftBtn.classList.add('hidden');
        leftBtn.classList.remove('lg:flex');
        leftBtn.disabled = true;
      }

      if (isDesktop && scrollLeft + clientWidth >= scrollWidth - 10) {
        rightBtn.classList.add('hidden');
        rightBtn.classList.remove('lg:flex');
      } else if (isDesktop) {
        rightBtn.classList.add('lg:flex');
      }
    }

    carousel.addEventListener('load', updateArrowButtons);
    carousel.addEventListener('scroll', updateArrowButtons);
    window.addEventListener('resize', updateArrowButtons);
    setTimeout(updateArrowButtons, 100);

    // FAQ Accordion Toggle
    function toggleAccordion(id) {
      const content = document.getElementById(`content-${id}`);
      const icon = document.getElementById(`icon-${id}`);

      // Close all other accordion items
      for (let i = 1; i <= 5; i++) {
        if (i !== id) {
          const otherContent = document.getElementById(`content-${i}`);
          const otherIcon = document.getElementById(`icon-${i}`);
          otherContent.classList.add("hidden");
          otherIcon.classList.remove("rotate-180");
        }
      }

      // Toggle the clicked item
      content.classList.toggle("hidden");
      icon.classList.toggle("rotate-180");
    }
  </script>
</body>
</html>
