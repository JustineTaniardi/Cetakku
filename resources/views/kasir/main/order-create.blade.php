@extends('layouts.app-fullwidth')

@section('page-title', 'Tambah Pesanan')

@php
    $breadcrumbs = [
        ['label' => 'Pesanan', 'url' => route('kasir.order')],
        ['label' => 'Tambah Pesanan']
    ];
@endphp

@section('content')
<div class="max-w-[1600px] mx-auto px-6 py-6 space-y-5">
    {{-- Header --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Buat Pesanan Baru</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Masukan informasi pesanan dan pelanggan.</p>
        </div>
        <button type="button" id="btnPrintInvoice" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
            <img src="{{ asset('assets/icons/print.png') }}" class="w-4 h-4 mr-2" alt="Print">
            Print Invoice
        </button>
    </div>

    {{-- Error Messages --}}
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kasir.order.store') }}" method="POST" id="orderForm">
        @csrf
        
        {{-- Customer & Order Info --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-5">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Left Column --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pelanggan <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <select name="customer_id" id="customer_id" required 
                                class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                <option value="">Pilih nama pelanggan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" 
                                        data-address="{{ $customer->address }}"
                                        data-phone="{{ $customer->phone_number }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="button" id="btnAddCustomer" class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-sm font-medium whitespace-nowrap">
                                Tambah Pelanggan
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="customer_address" id="customer_address" rows="2" readonly
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50">{{ old('customer_address') }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                        <input type="text" name="customer_phone" id="customer_phone" readonly
                            value="{{ old('customer_phone') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Orderan</label>
                        <input type="text" name="order_number" value="{{ $orderNumber }}" readonly
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg bg-gray-50">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Produk</label>
                        <select id="product_select" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" 
                                    data-name="{{ $product->name }}"
                                    data-category="{{ $product->category->name ?? '-' }}"
                                    data-unit="{{ $product->unit->name ?? '-' }}"
                                    data-price="{{ $product->price }}">
                                    {{ $product->name }} - {{ $product->category->name ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pemesanan <span class="text-red-500">*</span></label>
                        <input type="date" name="order_date" id="order_date" required
                            value="{{ old('order_date', date('Y-m-d')) }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deadline <span class="text-red-500">*</span></label>
                        <input type="date" name="deadline" id="deadline" required
                            value="{{ old('deadline') }}"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        {{-- Products Table --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full" id="productsTable">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Produk</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Banyak</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Satuan</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Harga</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Total Harga</th>
                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody" class="divide-y divide-gray-200">
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center text-gray-500 text-sm">
                                    Belum ada produk ditambahkan
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex items-center justify-end gap-3 mt-5">
            <a href="{{ route('kasir.order') }}" class="px-6 py-2.5 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                Kembali [ESC]
            </a>
            <button type="submit" class="px-6 py-2.5 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">
                Simpan
            </button>
        </div>
    </form>
</div>

{{-- Add Customer Modal --}}
<div id="modalAddCustomer" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Tambah Pelanggan Baru</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <label for="new_customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama <span class="text-red-500">*</span></label>
                        <input type="text" id="new_customer_name" required 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Masukkan nama pelanggan">
                    </div>
                    <div>
                        <label for="new_customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon <span class="text-red-500">*</span></label>
                        <input type="text" id="new_customer_phone" required 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Masukkan nomor telepon">
                    </div>
                    <div>
                        <label for="new_customer_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea id="new_customer_address" rows="3" 
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Masukkan alamat (opsional)"></textarea>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 mt-6">
                    <button type="button" class="close-modal px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors">
                        Batal
                    </button>
                    <button type="button" id="btnSaveCustomer" class="px-4 py-2 text-sm bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    'use strict';

    const modalAddCustomer = document.getElementById('modalAddCustomer');
    const btnAddCustomer = document.getElementById('btnAddCustomer');
    const btnSaveCustomer = document.getElementById('btnSaveCustomer');
    const closeButtons = document.querySelectorAll('.close-modal');
    const customerSelect = document.getElementById('customer_id');
    const productSelect = document.getElementById('product_select');
    const productsTableBody = document.getElementById('productsTableBody');
    
    let products = [];

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

    // Customer Select Change
    if (customerSelect) {
        customerSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            if (selected.value) {
                document.getElementById('customer_address').value = selected.dataset.address || '-';
                document.getElementById('customer_phone').value = selected.dataset.phone || '-';
            } else {
                document.getElementById('customer_address').value = '';
                document.getElementById('customer_phone').value = '';
            }
        });
    }

    // Add Customer Modal
    if (btnAddCustomer) {
        btnAddCustomer.addEventListener('click', function() {
            showModal(modalAddCustomer);
            document.getElementById('new_customer_name').value = '';
            document.getElementById('new_customer_phone').value = '';
            document.getElementById('new_customer_address').value = '';
        });
    }

    // Save New Customer (AJAX)
    if (btnSaveCustomer) {
        btnSaveCustomer.addEventListener('click', function() {
            const name = document.getElementById('new_customer_name').value;
            const phone = document.getElementById('new_customer_phone').value;
            const address = document.getElementById('new_customer_address').value;

            if (!name || !phone) {
                alert('Nama dan telepon wajib diisi!');
                return;
            }

            // Send AJAX request
            fetch('{{ route("kasir.customer.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ name, phone_number: phone, address })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add to select
                    const option = new Option(data.customer.name, data.customer.id, true, true);
                    option.dataset.address = data.customer.address || '';
                    option.dataset.phone = data.customer.phone_number || '';
                    customerSelect.add(option);
                    
                    // Update address and phone
                    document.getElementById('customer_address').value = data.customer.address || '-';
                    document.getElementById('customer_phone').value = data.customer.phone_number || '-';
                    
                    hideModal(modalAddCustomer);
                } else {
                    alert('Gagal menambahkan pelanggan!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan!');
            });
        });
    }

    // Add Product
    if (productSelect) {
        productSelect.addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            if (!selected.value) return;

            const productId = selected.value;
            const productName = selected.dataset.name;
            const category = selected.dataset.category;
            const unit = selected.dataset.unit;
            const price = parseFloat(selected.dataset.price);

            // Check if already added
            if (products.find(p => p.product_id === productId)) {
                alert('Produk sudah ditambahkan!');
                this.value = '';
                return;
            }

            products.push({
                product_id: productId,
                name: productName,
                category: category,
                unit: unit,
                qty: 1,
                price: price
            });

            renderProducts();
            this.value = '';
        });
    }

    // Render Products Table
    function renderProducts() {
        if (products.length === 0) {
            productsTableBody.innerHTML = `
                <tr>
                    <td colspan="7" class="px-4 py-12 text-center text-gray-500 text-sm">
                        Belum ada produk ditambahkan
                    </td>
                </tr>
            `;
            return;
        }

        let html = '';
        products.forEach((product, index) => {
            const total = product.qty * product.price;
            html += `
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm text-gray-900">
                        ${product.name}
                        <input type="hidden" name="products[${index}][product_id]" value="${product.product_id}">
                        <input type="hidden" name="products[${index}][note]" value="">
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700">${product.category}</td>
                    <td class="px-4 py-3">
                        <input type="number" name="products[${index}][qty]" value="${product.qty}" min="1" step="1"
                            class="qty-input w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-secondary focus:border-transparent"
                            data-index="${index}">
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-700">${product.unit}</td>
                    <td class="px-4 py-3">
                        <div class="relative">
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-xs text-gray-500">Rp</span>
                            <input type="number" name="products[${index}][price]" value="${product.price}" min="0" step="0.01"
                                class="price-input w-32 pl-7 pr-2 py-1 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-secondary focus:border-transparent"
                                data-index="${index}">
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 font-semibold total-price">Rp${formatNumber(total)}</td>
                    <td class="px-4 py-3 text-center">
                        <button type="button" class="remove-product hover:opacity-75" data-index="${index}">
                            <img src="{{ asset('assets/icons/delete.png') }}" class="w-5 h-5 mx-auto" alt="Delete">
                        </button>
                    </td>
                </tr>
            `;
        });

        productsTableBody.innerHTML = html;

        // Add event listeners
        document.querySelectorAll('.qty-input, .price-input').forEach(input => {
            input.addEventListener('input', updateProduct);
        });

        document.querySelectorAll('.remove-product').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = parseInt(this.dataset.index);
                products.splice(index, 1);
                renderProducts();
            });
        });
    }

    // Update Product
    function updateProduct(e) {
        const index = parseInt(e.target.dataset.index);
        const isQty = e.target.classList.contains('qty-input');
        const value = parseFloat(e.target.value) || 0;

        if (isQty) {
            products[index].qty = value;
        } else {
            products[index].price = value;
        }

        // Update total price
        const row = e.target.closest('tr');
        const total = products[index].qty * products[index].price;
        row.querySelector('.total-price').textContent = 'Rp' + formatNumber(total);
    }

    // Format Number
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Close Modal
    closeButtons.forEach(function(btn) {
        btn.addEventListener('click', function() {
            hideModal(modalAddCustomer);
        });
    });

    if (modalAddCustomer) {
        modalAddCustomer.addEventListener('click', function(e) {
            if (e.target === this) {
                hideModal(this);
            }
        });
    }

    // ESC Key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideModal(modalAddCustomer);
            // Navigate back
            if (!modalAddCustomer.classList.contains('hidden')) return;
            window.location.href = '{{ route("kasir.order") }}';
        }
    });

    // Form Validation
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        if (products.length === 0) {
            e.preventDefault();
            alert('Tambahkan minimal 1 produk!');
            return false;
        }

        if (!document.getElementById('customer_id').value) {
            e.preventDefault();
            alert('Pilih pelanggan terlebih dahulu!');
            return false;
        }
    });

    // Print Invoice (Placeholder)
    document.getElementById('btnPrintInvoice').addEventListener('click', function() {
        alert('Fitur print invoice akan segera hadir!');
    });

})();
</script>
@endpush
@endsection