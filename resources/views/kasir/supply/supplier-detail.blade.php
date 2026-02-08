@extends('layouts.app-fullwidth')

@section('page-title', 'Detail Pemasok')

@php
    $breadcrumbs = [
        ['label' => 'Pemasok', 'url' => route('kasir.supplier')],
        ['label' => 'Detail Pemasok']
    ];
@endphp

@section('content')
<div class="max-w-[1600px] mx-auto px-6 py-6 space-y-5">
    {{-- Header --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pemasok</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Informasi lengkap pemasok dan bahan yang dijual</p>
        </div>
        <a href="{{ route('kasir.supplier') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-[13px] font-medium">
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

    {{-- Supplier Info Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-base font-semibold text-gray-900 mb-4">Informasi Pemasok</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <div class="text-xs text-gray-600 mb-1">Nama Pemasok</div>
                <div class="text-sm font-semibold text-gray-900">{{ $supplier->name }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Nomor Telepon</div>
                <div class="text-sm font-semibold text-gray-900">{{ $supplier->phone }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Alamat</div>
                <div class="text-sm font-semibold text-gray-900">{{ $supplier->address ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs text-red-600 mb-1">Total Utang</div>
                <div class="text-sm font-semibold text-red-600">Rp{{ number_format($totalDebt, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- Materials Table --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Daftar Bahan yang Dijual</h3>
                    <p class="text-xs text-gray-600 mt-1">Total {{ $supplier->supplier_material->count() }} bahan</p>
                </div>
                
                <button type="button" id="btnAddMaterial" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                    <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                    Tambah Bahan
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Bahan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga Beli</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Ditambahkan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($supplier->supplier_material as $supplierMaterial)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $supplierMaterial->material->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $supplierMaterial->material->unit->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">Rp{{ number_format($supplierMaterial->buy_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $supplierMaterial->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="btn-edit-material hover:opacity-75" 
                                            data-material-id="{{ $supplierMaterial->material_id }}"
                                            data-material-name="{{ $supplierMaterial->material->name }}"
                                            data-buy-price="{{ $supplierMaterial->buy_price }}">
                                            <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                        </button>
                                        <form action="{{ route('kasir.supplier.material.delete', [$supplier->id, $supplierMaterial->material_id]) }}" method="POST" class="inline delete-form">
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
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada bahan yang ditambahkan untuk pemasok ini
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Add Material Modal --}}
<div id="modalAddMaterial" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Bahan</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-4 h-4" alt="Close">
                    </button>
                </div>
                
                <form id="formAddMaterial" action="{{ route('kasir.supplier.material.add', $supplier->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="add_material_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Bahan <span class="text-red-500">*</span></label>
                            <select id="add_material_id" name="material_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Bahan --</option>
                                @foreach($availableMaterials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->unit->name ?? '-' }})</option>
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

{{-- Edit Material Modal --}}
<div id="modalEditMaterial" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Harga Bahan</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formEditMaterial" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Bahan</label>
                            <input type="text" id="edit_material_name" readonly 
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
    const modalAddMaterial = document.getElementById('modalAddMaterial');
    const modalEditMaterial = document.getElementById('modalEditMaterial');
    const btnAddMaterial = document.getElementById('btnAddMaterial');
    const formEditMaterial = document.getElementById('formEditMaterial');
    const closeButtons = document.querySelectorAll('.close-modal');
    const btnEditMaterials = document.querySelectorAll('.btn-edit-material');
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

    // Open Add Material Modal
    if (btnAddMaterial) {
        btnAddMaterial.addEventListener('click', function() {
            showModal(modalAddMaterial);
            document.getElementById('formAddMaterial').reset();
        });
    }

    // Open Edit Material Modal
    btnEditMaterials.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const materialId = this.dataset.materialId;
            const materialName = this.dataset.materialName;
            const buyPrice = this.dataset.buyPrice;

            formEditMaterial.action = `/kasir/supplier/{{ $supplier->id }}/material/${materialId}`;
            document.getElementById('edit_material_name').value = materialName || '';
            document.getElementById('edit_buy_price').value = buyPrice || '';

            showModal(modalEditMaterial);
        });
    });

    // Close Modal Buttons
    closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            hideModal(modalAddMaterial);
            hideModal(modalEditMaterial);
        });
    });

    // Close Modal on Outside Click
    [modalAddMaterial, modalEditMaterial].forEach(function(modal) {
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
            hideModal(modalAddMaterial);
            hideModal(modalEditMaterial);
        }
    });

    // Delete Confirmation
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Yakin ingin menghapus bahan ini dari pemasok?')) {
                e.preventDefault();
            }
        });
    });

})();
</script>
@endpush
@endsection