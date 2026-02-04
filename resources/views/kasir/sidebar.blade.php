<aside class="w-64 h-screen bg-white border-r px-4">
    {{-- Logo --}}
    <h1 class="py-5 text-xl font-bold text-purple-700">
        CetakKu
    </h1>

    <nav class="space-y-6 text-sm">

        {{-- MAIN --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Main</p>

            @php $active = 'bg-purple-600 text-white'; @endphp
            @php $normal = 'text-gray-700 hover:bg-gray-100'; @endphp

            <a href="{{ route('kasir.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.dashboard') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/dashboard.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.dashboard') ? 'brightness-0 invert' : '' }}">
                <span>Dasbor</span>
            </a>

            <a href="{{ route('kasir.orders.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.orders*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/orders.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.orders*') ? 'brightness-0 invert' : '' }}">
                <span>Pesanan</span>
            </a>

            <a href="{{ route('kasir.customers.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.customers*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/customers.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.customers*') ? 'brightness-0 invert' : '' }}">
                <span>Pembeli</span>
            </a>
        </div>

        {{-- PRODUCTS --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Products</p>

            <a href="{{ route('kasir.products.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.products*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/products.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.products*') ? 'brightness-0 invert' : '' }}">
                <span>Produk</span>
            </a>

            <a href="{{ route('kasir.categories.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.categories*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/categories.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.categories*') ? 'brightness-0 invert' : '' }}">
                <span>Kategori</span>
            </a>
        </div>

        {{-- OPERATIONS --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Operations</p>

            <a href="{{ route('kasir.jobs.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.jobs*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/jobs.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.jobs*') ? 'brightness-0 invert' : '' }}">
                <span>Pekerjaan</span>
            </a>

            <a href="{{ route('kasir.invoices.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.invoices*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/invoices.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.invoices*') ? 'brightness-0 invert' : '' }}">
                <span>Faktur</span>
            </a>

            <a href="{{ route('kasir.payments.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.payments*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/payments.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.payments*') ? 'brightness-0 invert' : '' }}">
                <span>Pembayaran</span>
            </a>
        </div>

        {{-- SUPPLY --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Supply</p>

            <a href="{{ route('kasir.suppliers.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.suppliers*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/suppliers.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.suppliers*') ? 'brightness-0 invert' : '' }}">
                <span>Pemasok</span>
            </a>

            <a href="{{ route('kasir.materials.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.materials*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/materials.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.materials*') ? 'brightness-0 invert' : '' }}">
                <span>Bahan</span>
            </a>
        </div>

        {{-- FINANCE --}}
        <div>
            <p class="text-xs text-gray-400 uppercase mb-2">Finance</p>

            <a href="{{ route('kasir.receivables.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.receivables*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/receivable.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.receivables*') ? 'brightness-0 invert' : '' }}">
                <span>Piutang</span>
            </a>

            <a href="{{ route('kasir.payables.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.payables*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/payable.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.payables*') ? 'brightness-0 invert' : '' }}">
                <span>Hutang</span>
            </a>

            <a href="{{ route('kasir.revenue.index') }}"
               class="flex items-center gap-3 px-3 py-2 rounded-md
                      {{ request()->routeIs('kasir.revenue*') ? $active : $normal }}">
                <img src="{{ asset('assets/icons/revenue.webp') }}"
                     class="w-4 h-4 {{ request()->routeIs('kasir.revenue*') ? 'brightness-0 invert' : '' }}">
                <span>Omset</span>
            </a>
        </div>

    </nav>
</aside>
