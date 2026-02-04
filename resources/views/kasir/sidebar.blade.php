<aside class="w-64 h-screen bg-white border-r px-4">
    <h1 class="py-5 text-xl font-bold text-purple-700">
        CetakKu
    </h1>

    <nav class="space-y-6 text-sm">

        @php
            $active = 'bg-purple-600 text-white';
            $normal = 'text-gray-700 hover:bg-gray-100';
        @endphp

        {{-- MAIN --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Main</p>

            {{-- Dasbor (ACTIVE) --}}
            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-md {{ $active }}">
                <img src="{{ asset('assets/icons/dasbor_selected.png') }}" class="w-4 h-4">
                <span>Dasbor</span>
            </a>

            {{-- Pesanan --}}
            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/pesanan.png') }}" class="w-4 h-4">
                <span>Pesanan</span>
            </a>

            {{-- Pembeli --}}
            <a href="#"
               class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/pembeli.png') }}" class="w-4 h-4">
                <span>Pembeli</span>
            </a>
        </div>

        {{-- PRODUCTS --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Products</p>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/produk.png') }}" class="w-4 h-4">
                <span>Produk</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/kategori.png') }}" class="w-4 h-4">
                <span>Kategori</span>
            </a>
        </div>

        {{-- OPERATIONS --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Operations</p>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/pekerjaan.png') }}" class="w-4 h-4">
                <span>Pekerjaan</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/faktur.png') }}" class="w-4 h-4">
                <span>Faktur</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/pembayaran.png') }}" class="w-4 h-4">
                <span>Pembayaran</span>
            </a>
        </div>

        {{-- SUPPLY --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Supply</p>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/pemasok.png') }}" class="w-4 h-4">
                <span>Pemasok</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/bahan.png') }}" class="w-4 h-4">
                <span>Bahan</span>
            </a>
        </div>

        {{-- FINANCE --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Finance</p>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/piutang.png') }}" class="w-4 h-4">
                <span>Piutang</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/hutang.png') }}" class="w-4 h-4">
                <span>Hutang</span>
            </a>

            <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-md {{ $normal }}">
                <img src="{{ asset('assets/icons/omset.png') }}" class="w-4 h-4">
                <span>Omset</span>
            </a>
        </div>

    </nav>
</aside>
