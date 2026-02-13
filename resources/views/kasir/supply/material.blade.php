@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">
        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Bahan-bahan</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Kelola inventaris bahan baku Anda</p>
        </div>

        {{-- Success/Error Messages --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="text-sm text-gray-600 mb-1">Total Bahan-bahan</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalMaterials }}</div>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="text-sm text-red-600 mb-1">Stok Rendah</div>
                <div class="text-3xl font-bold text-red-600">{{ $lowStock }}</div>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="text-sm text-gray-600 mb-1">Total Pemasok</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalSuppliers }}</div>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="text-sm text-gray-600 mb-1">Tipe Unit</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalUnits }}</div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-gray-900">Semua Material</h3>

                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('kasir.material') }}" class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari ID, pelanggan, atau produk ..."
                                class="w-64 pl-10 pr-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <img src="{{ asset('assets/icons/cari.png') }}"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" alt="Search">
                        </form>

                        {{-- Buy Material Button --}}
                        <button type="button" id="btnBuyMaterial"
                            class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                            <img src="{{ asset('assets/icons/cart.png') }}" class="w-4 h-4 mr-2" alt="Buy">
                            Beli Bahan
                        </button>

                        {{-- Add Button --}}
                        <button type="button" id="btnAddMaterial"
                            class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
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
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kuantitas</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Pemasok</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($materials as $material)
                                @php
                                    $unit = $material->unit;
                                    $qtyInUnit = $unit && $unit->value > 1 ? $material->qty / $unit->value : $material->qty;
                                    $baseQty = $material->qty;
                                @endphp
                                <tr class="hover:bg-gray-50 transition-colors cursor-pointer"
                                    onclick="window.location='{{ route('kasir.material.show', $material->id) }}'">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $material->name }}</td>
                                    <td class="px-6 py-4 text-sm {{ $material->qty < 10 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                        {{ number_format($qtyInUnit, 2, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $unit->name ?? '-' }}
                                        @if($unit && $unit->abbreviation)
                                            ({{ $unit->abbreviation }})
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600">
                                        {{ number_format($baseQty, 0, ',', '.') }} 
                                        {{ $unit && $unit->value > 1 ? 'pcs' : '' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        @if ($material->supplier_material->isNotEmpty())
                                            {{ $material->supplier_material->pluck('supplier.name')->join(', ') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        Rp{{ number_format($material->supplier_material->first()->buy_price ?? 0, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $material->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4" onclick="event.stopPropagation()">
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-edit hover:opacity-75"
                                                data-id="{{ $material->id }}" data-name="{{ $material->name }}"
                                                data-unit-id="{{ $material->unit_id }}" data-qty="{{ $material->qty }}">
                                                <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5" alt="Edit">
                                            </button>
                                            <form action="{{ route('kasir.material.destroy', $material->id) }}" method="POST" class="inline delete-form">
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
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada data material
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($materials->hasPages())
                    <div class="mt-4">
                        {{ $materials->links() }}
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
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Material</h3>
                        <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                            <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                        </button>
                    </div>

                    <form id="formAdd" action="{{ route('kasir.material.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="add_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Material <span class="text-red-500">*</span></label>
                                <input type="text" id="add_name" name="name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="Masukkan nama material">
                            </div>
                            <div>
                                <label for="add_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Satuan <span class="text-red-500">*</span></label>
                                <select id="add_unit_id" name="unit_id" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach (\App\Models\Unit::all() as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }} @if($unit->abbreviation)({{ $unit->abbreviation }})@endif</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="add_qty" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas <span class="text-red-500">*</span></label>
                                <input type="number" id="add_qty" name="qty" required min="0" step="0.01"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-3 mt-6">
                            <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">Simpan</button>
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
                        <h3 class="text-lg font-semibold text-gray-900">Edit Material</h3>
                        <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                            <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                        </button>
                    </div>

                    <form id="formEdit" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Material <span class="text-red-500">*</span></label>
                                <input type="text" id="edit_name" name="name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                            <div>
                                <label for="edit_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Satuan <span class="text-red-500">*</span></label>
                                <select id="edit_unit_id" name="unit_id" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach (\App\Models\Unit::all() as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }} @if($unit->abbreviation)({{ $unit->abbreviation }})@endif</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="edit_qty" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas <span class="text-red-500">*</span></label>
                                <input type="number" id="edit_qty" name="qty" required min="0" step="0.01"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-3 mt-6">
                            <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
                            <button type="submit" class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">Update</button>
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
                        <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                            <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                        </button>
                    </div>

                    <form id="formBuyMaterial" action="{{ route('kasir.material.purchase') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="buy_product_id" class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                                <select id="buy_product_id" name="product_id"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                    <option value="">-- Pilih Produk (Opsional) --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="buy_material_id" class="block text-sm font-medium text-gray-700 mb-1">Material <span class="text-red-500">*</span></label>
                                <select id="buy_material_id" name="material_id" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                    <option value="">-- Pilih Material --</option>
                                    @foreach(\App\Models\Material::with('unit')->get() as $material)
                                        <option value="{{ $material->id }}">{{ $material->name }} ({{ $material->unit->name ?? '-' }})</option>
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
                            <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">Batal</button>
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

                const modalAdd = document.getElementById('modalAdd');
                const modalEdit = document.getElementById('modalEdit');
                const modalBuyMaterial = document.getElementById('modalBuyMaterial');
                const btnAddMaterial = document.getElementById('btnAddMaterial');
                const btnBuyMaterial = document.getElementById('btnBuyMaterial');
                const formEdit = document.getElementById('formEdit');
                const closeButtons = document.querySelectorAll('.close-modal');
                const btnEdits = document.querySelectorAll('.btn-edit');
                const deleteForms = document.querySelectorAll('.delete-form');

                // Buy Material Form Elements
                const buyProductSelect = document.getElementById('buy_product_id');
                const buyMaterialSelect = document.getElementById('buy_material_id');
                const buySupplierSelect = document.getElementById('buy_supplier_id');
                const buyAddressInput = document.getElementById('buy_address');
                const buyPriceInput = document.getElementById('buy_price');

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

                if (btnAddMaterial) {
                    btnAddMaterial.addEventListener('click', function() {
                        showModal(modalAdd);
                        document.getElementById('formAdd').reset();
                    });
                }

                if (btnBuyMaterial) {
                    btnBuyMaterial.addEventListener('click', function() {
                        showModal(modalBuyMaterial);
                        document.getElementById('formBuyMaterial').reset();
                        buySupplierSelect.disabled = true;
                        buyAddressInput.value = '-';
                        buyPriceInput.value = '';
                    });
                }

                // Handle Material Selection
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

                // Handle Product Selection (Auto-select material)
                if (buyProductSelect) {
                    buyProductSelect.addEventListener('change', function() {
                        const productId = this.value;
                        if (!productId) return;

                        fetch(`/kasir/material/by-product/${productId}`)
                            .then(response => response.json())
                            .then(materials => {
                                if (materials.length > 0) {
                                    // Auto select first material
                                    const firstMaterial = materials[0];
                                    buyMaterialSelect.value = firstMaterial.id;
                                    buyMaterialSelect.dispatchEvent(new Event('change'));
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                }

                btnEdits.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const name = this.dataset.name;
                        const unitId = this.dataset.unitId;
                        const qty = this.dataset.qty;

                        formEdit.action = `/kasir/material/${id}`;
                        document.getElementById('edit_name').value = name || '';
                        document.getElementById('edit_unit_id').value = unitId || '';
                        document.getElementById('edit_qty').value = qty || '';

                        showModal(modalEdit);
                    });
                });

                closeButtons.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        hideModal(modalAdd);
                        hideModal(modalEdit);
                        hideModal(modalBuyMaterial);
                    });
                });

                [modalAdd, modalEdit, modalBuyMaterial].forEach(function(modal) {
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
                        hideModal(modalBuyMaterial);
                    }
                });

                deleteForms.forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Yakin ingin menghapus material ini?')) {
                            e.preventDefault();
                        }
                    });
                });

            })();
        </script>
    @endpush
@endsection