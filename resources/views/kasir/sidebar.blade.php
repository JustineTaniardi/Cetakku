<aside class="w-52 h-screen bg-white border-r px-3 overflow-hidden flex flex-col">
    <h1 class="py-4 text-lg font-bold text-purple-700">
        CetakKu
    </h1>

    <nav class="space-y-4 text-sm overflow-y-auto flex-1">

        @php
            $active = 'bg-[#370C5A] text-white';
            $normal = 'text-gray-700 hover:bg-[#8F3FCF] hover:text-white';
        @endphp

        {{-- MAIN --}}
        <div>
            <p class="text-[10px] text-gray-400 uppercase mb-1.5 font-medium">Main</p>

            {{-- Dasbor --}}
            <a href="{{ route('kasir.dashboard') }}"
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.dashboard') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/' . (request()->routeIs('kasir.dashboard') ? 'dasbor_selected.png' : 'dasbor.png')) }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Dasbor</span>
            </a>

            {{-- Pesanan --}}
            <a href="{{ route('kasir.order') }}"
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.order') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/pesanan.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Pesanan</span>
            </a>

            {{-- Pembeli --}}
            <a href="{{ route('kasir.customer') }}"
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.customer') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/pembeli.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Pembeli</span>
            </a>
        </div>

        {{-- PRODUCTS --}}
        <div>
            <p class="text-[10px] text-gray-400 uppercase mb-1.5 font-medium">Products</p>

            <a href="{{ route('kasir.product') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.product') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/produk.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Produk</span>
            </a>

            <a href="{{ route('kasir.category') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.category') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/kategori.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Kategori</span>
            </a>
        </div>

        {{-- OPERATIONS --}}
        <div>
            <p class="text-[10px] text-gray-400 uppercase mb-1.5 font-medium">Operations</p>

            <a href="{{ route('kasir.job') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.job') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/pekerjaan.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Pekerjaan</span>
            </a>

            <a href="{{ route('kasir.invoice') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.invoice') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/faktur.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Faktur</span>
            </a>

            <a href="{{ route('kasir.payment') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.payment') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/pembayaran.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Pembayaran</span>
            </a>
        </div>

        {{-- SUPPLY --}}
        <div>
            <p class="text-[10px] text-gray-400 uppercase mb-1.5 font-medium">Supply</p>

            <a href="{{ route('kasir.supplier') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.supplier') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/pemasok.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Pemasok</span>
            </a>

            <a href="{{ route('kasir.material') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.material') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/bahan.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Bahan</span>
            </a>
        </div>

        {{-- FINANCE --}}
        <div>
            <p class="text-[10px] text-gray-400 uppercase mb-1.5 font-medium">Finance</p>

            <a href="{{ route('kasir.receivable') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.receivable') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/piutang.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Piutang</span>
            </a>

            <a href="{{ route('kasir.debt') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.debt') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/hutang.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Hutang</span>
            </a>

            <a href="{{ route('kasir.omset') }}" 
               class="flex items-center gap-2 px-2.5 py-1.5 rounded-md transition {{ request()->routeIs('kasir.omset') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/omset.png') }}" class="w-3.5 h-3.5">
                <span class="text-[13px]">Omset</span>
            </a>
        </div>

    </nav>
</aside>