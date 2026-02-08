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
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nama Material</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Kuantitas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Satuan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Pemasok</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Harga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($materials as $material)
                                <tr class="hover:bg-gray-50 transition-colors cursor-pointer"
                                    onclick="window.location='{{ route('kasir.material.show', $material->id) }}'">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $material->name }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        <span
                                            class="{{ $material->qty < 10 ? 'text-red-600 font-semibold' : 'text-gray-700' }}">
                                            {{ $material->qty }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $material->unit->name ?? '-' }}</td>
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
                                    <td class="px-6 py-4 text-sm text-gray-700">
                                        {{ $material->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4" onclick="event.stopPropagation()">
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-edit hover:opacity-75"
                                                data-id="{{ $material->id }}" data-name="{{ $material->name }}"
                                                data-unit-id="{{ $material->unit_id }}" data-qty="{{ $material->qty }}">
                                                <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5"
                                                    alt="Edit">
                                            </button>
                                            <form action="{{ route('kasir.material.destroy', $material->id) }}"
                                                method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="hover:opacity-75">
                                                    <img src="{{ asset('assets/icons/delete.png') }}" class="w-5 h-5"
                                                        alt="Delete">
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
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
                                <label for="add_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Material
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="add_name" name="name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="Masukkan nama material">
                            </div>
                            <div>
                                <label for="add_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Satuan <span
                                        class="text-red-500">*</span></label>
                                <select id="add_unit_id" name="unit_id" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach (\App\Models\Unit::all() as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="add_qty" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas <span
                                        class="text-red-500">*</span></label>
                                <input type="number" id="add_qty" name="qty" required min="0"
                                    step="0.01"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="0">
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-3 mt-6">
                            <button type="button"
                                class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">
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
                                <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Material
                                    <span class="text-red-500">*</span></label>
                                <input type="text" id="edit_name" name="name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                            <div>
                                <label for="edit_unit_id" class="block text-sm font-medium text-gray-700 mb-1">Satuan
                                    <span class="text-red-500">*</span></label>
                                <select id="edit_unit_id" name="unit_id" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                    <option value="">-- Pilih Satuan --</option>
                                    @foreach (\App\Models\Unit::all() as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="edit_qty" class="block text-sm font-medium text-gray-700 mb-1">Kuantitas <span
                                        class="text-red-500">*</span></label>
                                <input type="number" id="edit_qty" name="qty" required min="0"
                                    step="0.01"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                        </div>
                        <div class="flex items-center justify-end gap-3 mt-6">
                            <button type="button"
                                class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">
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

                const modalAdd = document.getElementById('modalAdd');
                const modalEdit = document.getElementById('modalEdit');
                const btnAddMaterial = document.getElementById('btnAddMaterial');
                const formEdit = document.getElementById('formEdit');
                const closeButtons = document.querySelectorAll('.close-modal');
                const btnEdits = document.querySelectorAll('.btn-edit');
                const deleteForms = document.querySelectorAll('.delete-form');

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
                    });
                });

                [modalAdd, modalEdit].forEach(function(modal) {
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
