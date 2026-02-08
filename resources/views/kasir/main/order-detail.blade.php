@extends('layouts.app-fullwidth')

@section('page-title', 'Detail Pesanan')

@php
    $breadcrumbs = [
        ['label' => 'Pesanan', 'url' => route('kasir.order')],
        ['label' => 'Detail Pesanan']
    ];
@endphp

@section('content')
<div class="max-w-[1600px] mx-auto px-6 py-6 space-y-5">
    {{-- Header --}}
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Pesanan</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Informasi lengkap pesanan #{{ $order->order_number }}</p>
        </div>
        <div class="flex items-center gap-3">
            <button type="button" id="btnPrintInvoice" class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                <img src="{{ asset('assets/icons/print.png') }}" class="w-4 h-4 mr-2" alt="Print">
                Print Invoice
            </button>
            <a href="{{ route('kasir.order') }}" class="inline-flex items-center px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors text-[13px] font-medium">
                <img src="{{ asset('assets/icons/back.png') }}" class="w-4 h-4 mr-2" alt="Back">
                Kembali
            </a>
        </div>
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

    {{-- Order Info Card --}}
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-semibold text-gray-900">Informasi Pesanan</h3>
            <div class="flex items-center gap-2">
                @if($order->status_order == 'done')
                    <span class="px-3 py-1.5 bg-green-100 text-green-700 text-sm font-medium rounded-md">Selesai</span>
                @elseif($order->status_order == 'process')
                    <span class="px-3 py-1.5 bg-blue-100 text-blue-700 text-sm font-medium rounded-md">Proses</span>
                @elseif($order->status_order == 'pending')
                    <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-md">Menunggu</span>
                @else
                    <span class="px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-md">Dibatalkan</span>
                @endif

                @if($order->payment_status == 'lunas')
                    <span class="px-3 py-1.5 bg-green-100 text-green-700 text-sm font-medium rounded-md">Lunas</span>
                @elseif($order->payment_status == 'piutang')
                    <span class="px-3 py-1.5 bg-blue-100 text-blue-700 text-sm font-medium rounded-md">Piutang</span>
                @elseif($order->payment_status == 'sebagian')
                    <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-md">Sebagian</span>
                @else
                    <span class="px-3 py-1.5 bg-red-100 text-red-700 text-sm font-medium rounded-md">Dibatalkan</span>
                @endif
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div>
                <div class="text-xs text-gray-600 mb-1">Nomor Pesanan</div>
                <div class="text-sm font-semibold text-gray-900">{{ $order->order_number }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Nama Pelanggan</div>
                <div class="text-sm font-semibold text-gray-900">{{ $order->customer->name }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Telepon</div>
                <div class="text-sm font-semibold text-gray-900">{{ $order->customer->phone_number }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Alamat</div>
                <div class="text-sm font-semibold text-gray-900">{{ $order->customer->address ?? '-' }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Tanggal Pemesanan</div>
                <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Deadline</div>
                <div class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($order->deadline)->format('d M Y') }}</div>
            </div>
            <div>
                <div class="text-xs text-gray-600 mb-1">Kasir</div>
                <div class="text-sm font-semibold text-gray-900">{{ $order->user->name }}</div>
            </div>
            <div>
                <div class="text-xs text-secondary mb-1">Total Harga</div>
                <div class="text-sm font-semibold text-secondary">Rp{{ number_format($order->total_price, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex items-center justify-end gap-3">
        <button type="button" id="btnUpdateStatus" class="px-5 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            Update Status Produksi
        </button>
        <button type="button" id="btnUpdatePayment" class="px-5 py-2 text-sm bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
            Update Status Pembayaran
        </button>
    </div>
</div>

{{-- Update Status Modal --}}
<div id="modalUpdateStatus" class="hidden fixed inset-0 bg-gray-900/40 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Update Status Produksi</h3>
                    <button type="button" class="close-modal text-gray-400 hover:text-gray-600">
                        <img src="{{ asset('assets/icons/close.png') }}" class="w-6 h-6" alt="Close">
                    </button>
                </div>
                
                <form id="formUpdateStatus">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="status_order" class="block text-sm font-medium text-gray-700 mb-1">
                            Status Produksi <span class="text-red-500">*</span>
                        </label>
                        <select id="status_order" name="status_order" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <option value="pending" {{ $order->status_order == 'pending' ? 'selected' : '' }}>Menunggu</option>
                            <option value="process" {{ $order->status_order == 'process' ? 'selected' : '' }}>Proses</option>
                            <option value="done" {{ $order->status_order == 'done' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancel" {{ $order->status_order == 'cancel' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
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
@endsection
