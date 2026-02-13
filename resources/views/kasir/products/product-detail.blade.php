@extends('layouts.app-fullwidth')

@section('page-title', 'Detail Produk')

@php
    $breadcrumbs = [
        ['label' => 'Produk', 'url' => route('kasir.product')],
        ['label' => 'Detail Produk']
    ];
@endphp

@section('content')
<div class="max-w-[1600px] mx-auto px-6 py-6 space-y-5">
    {{-- Header --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Produk</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Informasi lengkap produk dan material yang digunakan</p>
        </div>
        <a href="{{ route('kasir.product') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-[13px] font-medium">
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

    {{-- Product Info Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <h3 class="text-base font-semibold text-gray-900 mb-4">Informasi Produk</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <div class="text-xs text-gray-600 mb-1">Nama Produk</div>
                <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Kategori</div>
                <div class="text-sm font-semibold text-gray-900">{{ $product->category->name ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Satuan</div>
                <div class="text-sm font-semibold text-gray-900">{{ $product->unit->name ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs text-secondary mb-1">Harga Jual</div>
                <div class="text-sm font-semibold text-secondary">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- Materials Table --}}
    <div class="bg-white rounded-lg border border-gray-200">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-semibold text-gray-900">Komposisi Material</h3>
                    <p class="text-xs text-gray-600 mt-1">Material yang digunakan untuk membuat produk ini</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <button type="button" id="btnBuyMaterial" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                        <img src="{{ asset('assets/icons/cart.png') }}" class="w-4 h-4 mr-2" alt="Buy">
                        Beli bahan
                    </button>
                    
                    <button type="button" id="btnAddMaterial" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                        <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                        Tambah Material
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama Material</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kuantitas Dibutuhkan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stock Tersedia</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($product->product_material as $productMaterial)
                            @php
                                $material = $productMaterial->material;
                                $unit = $material->unit;
                                $qtyInUnit = $unit && $unit->value > 1 ? $material->qty / $unit->value : $material->qty;
                                $neededInUnit = $unit && $unit->value > 1 ? $productMaterial->quantity_needed / $unit->value : $productMaterial->quantity_needed;
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $material->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $unit->name ?? '-' }}
                                    @if($unit && $unit->abbreviation)
                                        ({{ $unit->abbreviation }})
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                                    {{ number_format($neededInUnit, 2, ',', '.') }} {{ $unit->name ?? '' }}
                                    @if($unit && $unit->value > 1)
                                        <span class="text-xs text-gray-500">/ {{ number_format($productMaterial->quantity_needed, 0, ',', '.') }} pcs</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm {{ $material->qty < 10 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                    {{ number_format($qtyInUnit, 2, ',', '.') }} {{ $unit->name ?? '' }}
                                    @if($unit && $unit->value > 1)
                                        <span class="text-xs text-gray-500">/ {{ number_format($material->qty, 0, ',', '.') }} pcs</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($material->qty >= $productMaterial->quantity_needed)
                                        <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-md">Cukup</span>
                                    @elseif($material->qty > 0)
                                        <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-md">Kurang</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-md">Habis</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">{{ $productMaterial->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <button type="button" class="btn-edit-material hover:opacity-75" 
                                            data-material-id="{{ $productMaterial->material_id }}"
                                            data-material-name="{{ $material->name }}"
                                            data-quantity-needed="{{ $productMaterial->quantity_needed }}">
                                            <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                        </button>
                                        <form action="{{ route('kasir.product.material.delete', [$product->id, $productMaterial->material_id]) }}" method="POST" class="inline delete-form">
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
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                    Belum ada material yang ditambahkan untuk produk ini
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
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Material</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formAddMaterial" action="{{ route('kasir.product.material.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="add_material_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Material <span class="text-red-500">*</span></label>
                            <select id="add_material_id" name="material_id" required 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Material --</option>
                                @foreach($availableMaterials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->unit->name ?? '-' }}) - Stok: {{ number_format($material->qty, 2, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="add_quantity_needed" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas Dibutuhkan <span class="text-red-500">*</span></label>
                            <input type="number" id="add_quantity_needed" name="quantity_needed" required min="0" step="0.01"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                placeholder="0">
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
                    <h3 class="text-lg font-semibold text-gray-900">Edit Kuantitas Material</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formEditMaterial" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Material</label>
                            <input type="text" id="edit_material_name" readonly 
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        </div>
                        <div>
                            <label for="edit_quantity_needed" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas Dibutuhkan <span class="text-red-500">*</span></label>
                            <input type="number" id="edit_quantity_needed" name="quantity_needed" required min="0" step="0.01"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
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

{{-- Buy Material Modal --}}
<div id="modalBuyMaterial" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-lg transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Beli bahan</h3>
                        <p class="text-xs text-gray-600 mt-0.5">Beli bahan langsung dari pemasok</p>
                    </div>
                    <button type="button" class="close-modal-buy text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>

                <form id="formBuyMaterial" action="{{ route('kasir.material.purchase') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="space-y-4">
                        <div>
                            <label for="buy_product_name" class="block text-sm font-medium text-gray-700 mb-1">Produk <span class="text-red-500">*</span></label>
                            <input type="text" id="buy_product_name" value="{{ $product->name }}" readonly
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                        </div>

                        <div>
                            <label for="buy_material_id" class="block text-sm font-medium text-gray-700 mb-1">Material <span class="text-red-500">*</span></label>
                            <select id="buy_material_id" name="material_id" required
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">-- Pilih Material --</option>
                                @foreach($product->product_material as $pm)
                                    <option value="{{ $pm->material->id }}">{{ $pm->material->name }} ({{ $pm->material->unit->name ?? '-' }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="buy_supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemasok <span class="text-red-500">*</span></label>
                            <select id="buy_supplier_id" name="supplier_id" required disabled
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent bg-gray-50">
                                <option value="">-- Pilih Pemasok --</option>
                            </select>
                        </div>

                        <div>
                            <label for="buy_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <input type="text" id="buy_address" readonly disabled
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50"
                                placeholder="-">
                        </div>

                        <div>
                            <label for="buy_qty" class="block text-sm font-medium text-gray-700 mb-1">Jumlah <span class="text-red-500">*</span></label>
                            <input type="number" id="buy_qty" name="qty" required min="0" step="0.01"
                                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                placeholder="0">
                        </div>

                        <div>
                            <label for="buy_price" class="block text-sm font-medium text-gray-700 mb-1">Harga <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-500">Rp</span>
                                <input type="number" id="buy_price" name="price" required min="0" step="0.01"
                                    class="w-full pl-10 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 mt-6">
                        <button type="button" class="close-modal-buy px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
                        <button type="submit" class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">Beli Sekarang</button>
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
    const modalBuyMaterial = document.getElementById('modalBuyMaterial');
    const btnAddMaterial = document.getElementById('btnAddMaterial');
    const btnBuyMaterial = document.getElementById('btnBuyMaterial');
    const formEditMaterial = document.getElementById('formEditMaterial');
    const closeButtons = document.querySelectorAll('.close-modal');
    const closeButtonsBuy = document.querySelectorAll('.close-modal-buy');
    const btnEditMaterials = document.querySelectorAll('.btn-edit-material');
    const deleteForms = document.querySelectorAll('.delete-form');

    // Buy Material Form Elements
    const buyMaterialSelect = document.getElementById('buy_material_id');
    const buySupplierSelect = document.getElementById('buy_supplier_id');
    const buyAddressInput = document.getElementById('buy_address');
    const buyPriceInput = document.getElementById('buy_price');

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

    // Open Buy Material Modal
    if (btnBuyMaterial) {
        btnBuyMaterial.addEventListener('click', function() {
            showModal(modalBuyMaterial);
            document.getElementById('formBuyMaterial').reset();
            buySupplierSelect.disabled = true;
            buyAddressInput.value = '-';
            buyPriceInput.value = '';
        });
    }

    // Handle Material Selection in Buy Modal
    if (buyMaterialSelect) {
        buyMaterialSelect.addEventListener('change', function() {
            const materialId = this.value;
            if (!materialId) {
                buySupplierSelect.disabled = true;
                buySupplierSelect.innerHTML = '<option value="">-- Pilih Pemasok --</option>';
                buyAddressInput.value = '-';
                buyPriceInput.value = '';
                return;
            }

            // Fetch suppliers for this material
            fetch(`/kasir/material/${materialId}/suppliers`)
                .then(response => response.json())
                .then(data => {
                    buySupplierSelect.innerHTML = '<option value="">-- Pilih Pemasok --</option>';
                    data.forEach(supplier => {
                        const option = document.createElement('option');
                        option.value = supplier.id;
                        option.textContent = supplier.name;
                        option.dataset.address = supplier.address || '-';
                        option.dataset.price = supplier.buy_price || 0;
                        buySupplierSelect.appendChild(option);
                    });
                    buySupplierSelect.disabled = false;
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat pemasok!');
                });
        });
    }

    // Handle Supplier Selection
    if (buySupplierSelect) {
        buySupplierSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                buyAddressInput.value = selectedOption.dataset.address || '-';
                buyPriceInput.value = selectedOption.dataset.price || 0;
            } else {
                buyAddressInput.value = '-';
                buyPriceInput.value = '';
            }
        });
    }

    // Open Edit Material Modal
    btnEditMaterials.forEach(function(btn) {
        btn.addEventListener('click', function() {
            const materialId = this.dataset.materialId;
            const materialName = this.dataset.materialName;
            const quantityNeeded = this.dataset.quantityNeeded;

            formEditMaterial.action = `/kasir/product/{{ $product->id }}/material/${materialId}`;
            document.getElementById('edit_material_name').value = materialName || '';
            document.getElementById('edit_quantity_needed').value = quantityNeeded || '';

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

    closeButtonsBuy.forEach(function(btn) {
        btn.addEventListener('click', function() {
            hideModal(modalBuyMaterial);
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

    if (modalBuyMaterial) {
        modalBuyMaterial.addEventListener('click', function(e) {
            if (e.target === this) {
                hideModal(this);
            }
        });
    }

    // Close Modal on ESC Key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideModal(modalAddMaterial);
            hideModal(modalEditMaterial);
            hideModal(modalBuyMaterial);
        }
    });

    // Delete Confirmation
    deleteForms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Yakin ingin menghapus material ini dari produk?')) {
                e.preventDefault();
            }
        });
    });

})();
</script>
@endpush
@endsection