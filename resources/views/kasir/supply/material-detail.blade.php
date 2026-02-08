@extends('layouts.app-fullwidth')

@section('page-title', 'Detail Material')

@php
    $breadcrumbs = [
        ['label' => 'Bahan', 'url' => route('kasir.material')],
        ['label' => 'Detail Material']
    ];
@endphp

@section('content')
<div class="max-w-[1600px] mx-auto px-6 py-6 space-y-5">
    {{-- Header --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Material</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Informasi lengkap material dan pemasok</p>
        </div>
        <a href="{{ route('kasir.material') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-[13px] font-medium">
            <img src="{{ asset('assets/icons/back.png') }}" class="w-4 h-4 mr-2" alt="Back">
            Kembali
        </a>
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

    {{-- Material Info Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-base font-semibold text-gray-900 mb-4">Informasi Material</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <div class="text-xs text-gray-600 mb-1">Nama Material</div>
                <div class="text-sm font-semibold text-gray-900">{{ $material->name }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Kuantitas Tersedia</div>
                <div class="text-sm font-semibold {{ $material->qty < 10 ? 'text-red-600' : 'text-gray-900' }}">
                    {{ $material->qty }} {{ $material->unit->name ?? '' }}
                    @if($material->qty < 10)
                        <span class="ml-2 px-2 py-0.5 bg-red-100 text-red-700 text-xs rounded">Stok Rendah</span>
                    @endif
                </div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Satuan</div>
                <div class="text-sm font-semibold text-gray-900">{{ $material->unit->name ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Jumlah Pemasok</div>
                <div class="text-sm font-semibold text-gray-900">{{ $material->supplier_material->count() }} Pemasok</div>
            </div>
        </div>
    </div>

    {{-- Suppliers Table --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Daftar Pemasok</h3>
                    <p class="text-xs text-gray-600 mt-1">Pemasok yang menjual material ini</p>
                </div>
                
                <button type="button" id="btnAddSupplier" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                    <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                    Tambah Pemasok
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Pemasok</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Alamat</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga Beli</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Ditambahkan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($material->supplier_material as $supplierMaterial)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $supplierMaterial->supplier->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $supplierMaterial->supplier->phone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $supplierMaterial->supplier->address ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Rp{{ number_format($supplierMaterial->buy_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $supplierMaterial->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="btn-edit-supplier hover:opacity-75" 
                                            data-supplier-id="{{ $supplierMaterial->supplier_id }}"
                                            data-supplier-name="{{ $supplierMaterial->supplier->name }}"
                                            data-buy-price="{{ $supplierMaterial->buy_price }}">
                                            <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                        </button>
                                        <form action="{{ route('kasir.material.supplier.delete', [$material->id, $supplierMaterial->supplier_id]) }}" method="POST" class="inline delete-form">
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
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada pemasok yang ditambahkan untuk material ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Supplier Modal --}}
<div id="modalAddSupplier" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Pemasok</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formAddSupplier" action="{{ route('kasir.material.supplier.add', $material->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="add_supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Pemasok <span class="text-red-500">*</span></label>
                            <select id="add_supplier_id" name="supplier_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Pemasok --</option>
                                @foreach($availableSuppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }} - {{ $supplier->phone }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="add_buy_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Beli <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">Rp</span>
                                <input type="number" id="add_buy_price" name="buy_price" required min="0" step="0.01"
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

{{-- Edit Supplier Modal --}}
<div id="modalEditSupplier" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Harga Pemasok</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formEditSupplier" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemasok</label>
                            <input type="text" id="edit_supplier_name" readonly 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        </div>
                        <div>
                            <label for="edit_buy_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Beli <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">Rp</span>
                                <input type="number" id="edit_buy_price" name="buy_price" required min="0" step="0.01"
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

@push('scripts')
<script>
(function() {
    'use strict';

    // DOM Elements
    const modalAddSupplier = document.getElementById('modalAddSupplier');
    const modalEditSupplier = document.getElementById('modalEditSupplier');
    const btnAddSupplier = document.getElementById('btnAddSupplier');
    const formEditSupplier = document.getElementById('formEditSupplier');
    const closeButtons = document.querySelectorAll('.close-modal');
    const btnEditSuppliers = document.querySelectorAll('.btn-edit-supplier');
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

    // Open Add Supplier Modal
    if (btnAddSupplier) {
        btnAddSupplier.addEventListener('click', function() {
            showModal(modalAddSupplier);
            document.getElementById('formAddSupplier').reset();
        });
    }

    // Open Edit Supplier Modal
    btnEditSuppliers.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const supplierId = this.dataset.supplierId;
            const supplierName = this.dataset.supplierName;
            const buyPrice = this.dataset.buyPrice;

            formEditSupplier.action = `/kasir/material/{{ $material->id }}/supplier/${supplierId}`;
            document.getElementById('edit_supplier_name').value = supplierName || '';
            document.getElementById('edit_buy_price').value = buyPrice || '';

            showModal(modalEditSupplier);
        });
    });

    // Close Modal Buttons
    closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            hideModal(modalAddSupplier);
            hideModal(modalEditSupplier);
        });
    });

    // Close Modal on Outside Click
    [modalAddSupplier, modalEditSupplier].forEach(function(modal) {
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
            hideModal(modalAddSupplier);
            hideModal(modalEditSupplier);
        }
    });

    // Delete Confirmation
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Yakin ingin menghapus pemasok ini dari material?')) {
                e.preventDefault();
            }
        });
    });

})();
</script>
@endpush
@endsection