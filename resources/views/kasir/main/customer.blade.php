@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">
        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pembeli</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Kelola database semua pembelimu</p>
        </div>

        {{-- Table Section --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-gray-900">Semua Pembeli</h3>

                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('kasir.customer') }}" class="relative">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari ID, pelanggan, atau produk ..."
                                class="w-64 pl-10 pr-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <img src="{{ asset('assets/icons/cari.png') }}"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" alt="Search">
                        </form>

                        {{-- Add Button --}}
                        <button type="button" id="btnAddCustomer"
                            class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                            <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                            Tambah Pembeli
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Telepon</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Alamat</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($customers as $customer)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $customer->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->phone_number }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->address ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $customer->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-edit hover:opacity-75"
                                                data-id="{{ $customer->id }}" data-name="{{ $customer->name }}"
                                                data-phone="{{ $customer->phone_number }}"
                                                data-address="{{ $customer->address }}">
                                                <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5"
                                                    alt="Edit">
                                            </button>
                                            <form action="{{ route('kasir.customer.destroy', $customer->id) }}"
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
                                        Belum ada data pembeli
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($customers->hasPages())
                    <div class="mt-4">
                        {{ $customers->links() }}
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
                        <h3 class="text-lg font-semibold text-gray-900">Tambah Pembeli</h3>
                        <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="formAdd" action="{{ route('kasir.customer.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="add_name" class="block text-sm font-medium text-gray-700 mb-1">Nama <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="add_name" name="name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="Masukkan nama pembeli">
                            </div>
                            <div>
                                <label for="add_phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="add_phone" name="phone_number" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="Masukkan nomor telepon">
                            </div>
                            <div>
                                <label for="add_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea id="add_address" name="address" rows="3"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                    placeholder="Masukkan alamat (opsional)"></textarea>
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
                        <h3 class="text-lg font-semibold text-gray-900">Edit Pembeli</h3>
                        <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <form id="formEdit" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-1">Nama <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="edit_name" name="name" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                            <div>
                                <label for="edit_phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon <span
                                        class="text-red-500">*</span></label>
                                <input type="text" id="edit_phone" name="phone_number" required
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            </div>
                            <div>
                                <label for="edit_address"
                                    class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea id="edit_address" name="address" rows="3"
                                    class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"></textarea>
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

                // DOM Elements
                const modalAdd = document.getElementById('modalAdd');
                const modalEdit = document.getElementById('modalEdit');
                const btnAddCustomer = document.getElementById('btnAddCustomer');
                const formEdit = document.getElementById('formEdit');
                const closeButtons = document.querySelectorAll('.close-modal');
                const btnEdits = document.querySelectorAll('.btn-edit');
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

                // Open Add Modal
                if (btnAddCustomer) {
                    btnAddCustomer.addEventListener('click', function() {
                        showModal(modalAdd);
                        document.getElementById('formAdd').reset();
                    });
                }

                // Open Edit Modal
                btnEdits.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        const id = this.dataset.id;
                        const name = this.dataset.name;
                        const phone = this.dataset.phone;
                        const address = this.dataset.address;

                        formEdit.action = `/kasir/customer/${id}`;
                        document.getElementById('edit_name').value = name || '';
                        document.getElementById('edit_phone').value = phone || '';
                        document.getElementById('edit_address').value = address || '';

                        showModal(modalEdit);
                    });
                });

                // Close Modal Buttons
                closeButtons.forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        hideModal(modalAdd);
                        hideModal(modalEdit);
                    });
                });

                // Close Modal on Outside Click
                [modalAdd, modalEdit].forEach(function(modal) {
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
                        hideModal(modalAdd);
                        hideModal(modalEdit);
                    }
                });

                // Delete Confirmation
                deleteForms.forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Yakin ingin menghapus pembeli ini?')) {
                            e.preventDefault();
                        }
                    });
                });

            })();
        </script>
    @endpush
@endsection
