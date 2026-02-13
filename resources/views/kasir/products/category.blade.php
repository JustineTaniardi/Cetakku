@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kategori & Satuan</h1>
        <p class="text-[13px] text-gray-600 mt-0.5">Kelolah kategori kategori dan jenis satuan.</p>
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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Kategori Section --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-gray-900">Kategori</h3>
                    
                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('kasir.category') }}" class="relative">
                            <input type="hidden" name="search_unit" value="{{ request('search_unit') }}">
                            <input 
                                type="text" 
                                name="search_category" 
                                value="{{ request('search_category') }}"
                                placeholder="Cari Kategori..." 
                                class="w-48 pl-10 pr-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                            >
                            <img src="{{ asset('assets/icons/cari.png') }}" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" alt="Search">
                        </form>

                        {{-- Add Button --}}
                        <button type="button" id="btnAddCategory" class="inline-flex items-center px-4 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                            <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                            Tambah Kategori
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($categories as $category)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $category->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $category->product_count }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-edit-category hover:opacity-75" 
                                                data-id="{{ $category->id }}"
                                                data-name="{{ $category->name }}">
                                                <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                            </button>
                                            <form action="{{ route('kasir.category.destroy', $category->id) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:opacity-75">
                                                    <img src="{{ asset('assets/icons/delete.png') }}" class="w-5 h-5" alt="Delete">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-8 text-center text-gray-500 text-sm">
                                        Belum ada kategori
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Jenis Satuan Section --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-gray-900">Jenis Satuan</h3>
                    
                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('kasir.category') }}" class="relative">
                            <input type="hidden" name="search_category" value="{{ request('search_category') }}">
                            <input 
                                type="text" 
                                name="search_unit" 
                                value="{{ request('search_unit') }}"
                                placeholder="Cari Satuan..." 
                                class="w-48 pl-10 pr-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                            >
                            <img src="{{ asset('assets/icons/cari.png') }}" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" alt="Search">
                        </form>

                        {{-- Add Button --}}
                        <button type="button" id="btnAddUnit" class="inline-flex items-center px-4 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                            <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                            Tambah Satuan
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Satuan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Simbol</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nilai</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($units as $unit)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-3 text-sm text-gray-900">{{ $unit->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $unit->abbreviation ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $unit->value }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $unit->product_count }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-edit-unit hover:opacity-75" 
                                                data-id="{{ $unit->id }}"
                                                data-name="{{ $unit->name }}"
                                                data-abbreviation="{{ $unit->abbreviation }}"
                                                data-value="{{ $unit->value }}">
                                                <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                            </button>
                                            <form action="{{ route('kasir.unit.destroy', $unit->id) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:opacity-75">
                                                    <img src="{{ asset('assets/icons/delete.png') }}" class="w-5 h-5" alt="Delete">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-500 text-sm">
                                        Belum ada satuan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Add Category Modal --}}
<div id="modalAddCategory" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Kategori</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formAddCategory" action="{{ route('kasir.category.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="add_category_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" id="add_category_name" name="name" required 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Masukkan nama kategori">
                    </div>
                    <div class="flex items-center justify-end gap-3">
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

{{-- Edit Category Modal --}}
<div id="modalEditCategory" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Kategori</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formEditCategory" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_category_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori <span class="text-red-500">*</span></label>
                        <input type="text" id="edit_category_name" name="name" required 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    <div class="flex items-center justify-end gap-3">
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

{{-- Add Unit Modal --}}
<div id="modalAddUnit" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Satuan</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formAddUnit" action="{{ route('kasir.unit.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="add_unit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Satuan <span class="text-red-500">*</span></label>
                            <input type="text" id="add_unit_name" name="name" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                placeholder="Contoh: Lusin, Rim, Box">
                        </div>
                        <div>
                            <label for="add_unit_abbreviation" class="block text-sm font-medium text-gray-700 mb-1">Simbol/Singkatan</label>
                            <input type="text" id="add_unit_abbreviation" name="abbreviation"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                placeholder="Contoh: dz, rm, box (opsional)">
                        </div>
                        <div>
                            <label for="add_unit_value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Konversi <span class="text-red-500">*</span></label>
                            <input type="number" id="add_unit_value" name="value" required min="1" value="1"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                placeholder="Contoh: 12 untuk lusin, 500 untuk rim">
                            <p class="text-xs text-gray-500 mt-1">Nilai konversi ke unit dasar. Contoh: 1 lusin = 12 pcs</p>
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

{{-- Edit Unit Modal --}}
<div id="modalEditUnit" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Satuan</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formEditUnit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="edit_unit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Satuan <span class="text-red-500">*</span></label>
                            <input type="text" id="edit_unit_name" name="name" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>
                        <div>
                            <label for="edit_unit_abbreviation" class="block text-sm font-medium text-gray-700 mb-1">Simbol/Singkatan</label>
                            <input type="text" id="edit_unit_abbreviation" name="abbreviation"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </div>
                        <div>
                            <label for="edit_unit_value" class="block text-sm font-medium text-gray-700 mb-1">Nilai Konversi <span class="text-red-500">*</span></label>
                            <input type="number" id="edit_unit_value" name="value" required min="1"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Nilai konversi ke unit dasar. Contoh: 1 lusin = 12 pcs</p>
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

@push('scripts')
<script>
(function() {
    'use strict';

    // DOM Elements
    const modalAddCategory = document.getElementById('modalAddCategory');
    const modalEditCategory = document.getElementById('modalEditCategory');
    const modalAddUnit = document.getElementById('modalAddUnit');
    const modalEditUnit = document.getElementById('modalEditUnit');
    
    const btnAddCategory = document.getElementById('btnAddCategory');
    const btnAddUnit = document.getElementById('btnAddUnit');
    
    const formEditCategory = document.getElementById('formEditCategory');
    const formEditUnit = document.getElementById('formEditUnit');
    
    const closeButtons = document.querySelectorAll('.close-modal');
    const btnEditCategories = document.querySelectorAll('.btn-edit-category');
    const btnEditUnits = document.querySelectorAll('.btn-edit-unit');
    const deleteForms = document.querySelectorAll('.delete-form');

    // Helper Functions
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

    // Open Add Category Modal
    if (btnAddCategory) {
        btnAddCategory.addEventListener('click', function() {
            showModal(modalAddCategory);
            document.getElementById('formAddCategory').reset();
        });
    }

    // Open Add Unit Modal
    if (btnAddUnit) {
        btnAddUnit.addEventListener('click', function() {
            showModal(modalAddUnit);
            document.getElementById('formAddUnit').reset();
        });
    }

    // Open Edit Category Modal
    btnEditCategories.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;

            formEditCategory.action = `/kasir/category/${id}`;
            document.getElementById('edit_category_name').value = name || '';

            showModal(modalEditCategory);
        });
    });

    // Open Edit Unit Modal
    btnEditUnits.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const abbreviation = this.dataset.abbreviation;
            const value = this.dataset.value;

            formEditUnit.action = `/kasir/unit/${id}`;
            document.getElementById('edit_unit_name').value = name || '';
            document.getElementById('edit_unit_abbreviation').value = abbreviation || '';
            document.getElementById('edit_unit_value').value = value || 1;

            showModal(modalEditUnit);
        });
    });

    // Close Modal Buttons
    closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            hideModal(modalAddCategory);
            hideModal(modalEditCategory);
            hideModal(modalAddUnit);
            hideModal(modalEditUnit);
        });
    });

    // Close Modal on Outside Click
    [modalAddCategory, modalEditCategory, modalAddUnit, modalEditUnit].forEach(function(modal) {
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    hideModal(this);
                }
            });
        }
    });

    // Close Modal on ESC Key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideModal(modalAddCategory);
            hideModal(modalEditCategory);
            hideModal(modalAddUnit);
            hideModal(modalEditUnit);
        }
    });

    // Delete Confirmation
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Yakin ingin menghapus data ini?')) {
                e.preventDefault();
            }
        });
    });

})();
</script>
@endpush
@endsection