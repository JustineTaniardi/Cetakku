@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Produk</h1>
        <p class="text-[13px] text-gray-600 mt-0.5">Kelolah katalog dan harga produkmu.</p>
    </div>

    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="text-sm text-gray-600 mb-1">Total Produk</div>
            <div class="text-3xl font-bold text-gray-900">{{ $totalProducts }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="text-sm text-gray-600 mb-1">Kategori</div>
            <div class="text-3xl font-bold text-gray-900">{{ $totalCategories }}</div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="text-sm text-secondary mb-1">Rentang Harga</div>
            <div class="text-3xl font-bold text-secondary">
                Rp{{ number_format($priceRange->min_price ?? 0, 0, ',', '.') }} - Rp{{ number_format($priceRange->max_price ?? 0, 0, ',', '.') }}
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-base font-semibold text-gray-900">Semua Produk</h3>
                
                <div class="flex items-center gap-3">
                    {{-- Search --}}
                    <form method="GET" action="{{ route('kasir.product') }}" class="relative">
                        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Cari Produk..." 
                            class="w-48 pl-10 pr-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                        >
                        <img src="{{ asset('assets/icons/cari.png') }}" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" alt="Search">
                    </form>

                    {{-- Category Filter --}}
                    <form method="GET" action="{{ route('kasir.product') }}" class="relative">
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        <select name="category_id" onchange="this.form.submit()"
                            class="w-40 px-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent appearance-none bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <img src="{{ asset('assets/icons/dropdown.png') }}" class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-2.5 pointer-events-none" alt="Dropdown">
                    </form>

                    {{-- Add Button --}}
                    <button type="button" id="btnAddProduct" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                        <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                        Tambah Produk
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pembaruan Terakhir</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors cursor-pointer" onclick="window.location='{{ route('kasir.product.show', $product->id) }}'">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->unit->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $product->updated_at->format('d M Y') }}</td>
                                <td class="px-6 py-4" onclick="event.stopPropagation()">
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="btn-edit hover:opacity-75" 
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-category-id="{{ $product->category_id }}"
                                            data-unit-id="{{ $product->unit_id }}"
                                            data-price="{{ $product->price }}">
                                            <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                        </button>
                                        <button type="button" class="btn-delete hover:opacity-75" 
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}">
                                            <img src="{{ asset('assets/icons/delete.png') }}" class="w-5 h-5" alt="Delete">
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada data produk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="mt-4">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div id="modalAdd" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Produk</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-4 h-4" alt="Close">
                    </button>
                </div>
                
                <form id="formAdd" action="{{ route('kasir.product.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="add_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" id="add_name" name="name" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                placeholder="Masukkan nama produk">
                        </div>
                        <div>
                            <label for="add_category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                            <select id="add_category_id" name="category_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="add_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Satuan <span class="text-red-500">*</span></label>
                            <select id="add_unit_id" name="unit_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Satuan --</option>
                                @foreach(\App\Models\Unit::all() as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="add_price" class="block text-sm font-medium text-gray-700 mb-1">Harga <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">Rp</span>
                                <input type="number" id="add_price" name="price" required min="0" step="0.01"
                                    class="w-full pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div id="modalEdit" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Produk</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-4 h-4" alt="Close">
                    </button>
                </div>
                
                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_name" name="name" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>
                        <div>
                            <label for="edit_category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                            <select id="edit_category_id" name="category_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="edit_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Satuan <span class="text-red-500">*</span></label>
                            <select id="edit_unit_id" name="unit_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Satuan --</option>
                                @foreach(\App\Models\Unit::all() as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="edit_price" class="block text-sm font-medium text-gray-700 mb-1">Harga <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">Rp</span>
                                <input type="number" id="edit_price" name="price" required min="0" step="0.01"
                                    class="w-full pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="modalDelete" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-4 h-4" alt="Close">
                    </button>
                </div>
                
                <p class="text-sm text-gray-600 mb-6">
                    Apakah Anda yakin ingin menghapus produk "<span id="deleteProductName" class="font-semibold text-gray-900"></span>"?
                </p>

                <form id="formDelete" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex items-center justify-end gap-3">
                        <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    'use strict';

    const modalAdd = document.getElementById('modalAdd');
    const modalEdit = document.getElementById('modalEdit');
    const modalDelete = document.getElementById('modalDelete');
    const btnAddProduct = document.getElementById('btnAddProduct');
    const formEdit = document.getElementById('formEdit');
    const formDelete = document.getElementById('formDelete');
    const closeButtons = document.querySelectorAll('.close-modal');
    const btnEdits = document.querySelectorAll('.btn-edit');
    const btnDeletes = document.querySelectorAll('.btn-delete');

    function showModal(modal) {
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function hideModal(modal) {
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    }

    if (btnAddProduct) {
        btnAddProduct.addEventListener('click', function() {
            showModal(modalAdd);
            document.getElementById('formAdd').reset();
        });
    }

    btnEdits.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const categoryId = this.dataset.categoryId;
            const unitId = this.dataset.unitId;
            const price = this.dataset.price;

            formEdit.action = `/kasir/product/${id}`;
            document.getElementById('edit_name').value = name || '';
            document.getElementById('edit_category_id').value = categoryId || '';
            document.getElementById('edit_unit_id').value = unitId || '';
            document.getElementById('edit_price').value = price || '';

            showModal(modalEdit);
        });
    });

    btnDeletes.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;

            formDelete.action = `/kasir/product/${id}`;
            document.getElementById('deleteProductName').textContent = name;

            showModal(modalDelete);
        });
    });

    closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            hideModal(modalAdd);
            hideModal(modalEdit);
            hideModal(modalDelete);
        });
    });

    [modalAdd, modalEdit, modalDelete].forEach(function(modal) {
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideModal(this);
                }
            });
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideModal(modalAdd);
            hideModal(modalEdit);
            hideModal(modalDelete);
        }
    });

})();
</script>
@endpush
@endsection