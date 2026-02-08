@extends('layouts.app')

@section('content')
    <div class="p-6 space-y-6">
        {{-- Header --}}
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pesanan</h1>
            <p class="text-[13px] text-gray-600 mt-0.5">Mengelola dan melacak semua pesanan pelanggan.</p>
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

        {{-- Table Section --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-base font-semibold text-gray-900">Daftar Pesanan</h3>

                    <div class="flex items-center gap-3">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('kasir.order') }}" class="relative">
                            <input type="hidden" name="status_order" value="{{ request('status_order') }}">
                            <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">
                            <input type="hidden" name="deadline" value="{{ request('deadline') }}">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari ID, pelanggan, atau produk ..."
                                class="w-64 pl-10 pr-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                            <img src="{{ asset('assets/icons/cari.png') }}"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4" alt="Search">
                        </form>

                        {{-- Status Order Filter --}}
                        <form method="GET" action="{{ route('kasir.order') }}" class="relative">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">
                            <input type="hidden" name="deadline" value="{{ request('deadline') }}">
                            <select name="status_order" onchange="this.form.submit()"
                                class="w-44 px-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent appearance-none bg-white">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status_order') == 'pending' ? 'selected' : '' }}>
                                    Menunggu</option>
                                <option value="process" {{ request('status_order') == 'process' ? 'selected' : '' }}>Proses
                                </option>
                                <option value="done" {{ request('status_order') == 'done' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="cancel" {{ request('status_order') == 'cancel' ? 'selected' : '' }}>
                                    Dibatalkan</option>
                            </select>

                            <img src="{{ asset('assets/icons/dropdown.png') }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-2.5 pointer-events-none"
                                alt="Dropdown">
                        </form>

                        {{-- Payment Status Filter --}}
                        <form method="GET" action="{{ route('kasir.order') }}" class="relative">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="status_order" value="{{ request('status_order') }}">
                            <input type="hidden" name="deadline" value="{{ request('deadline') }}">
                            <select name="payment_status" onchange="this.form.submit()"
                                class="w-44 px-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent appearance-none bg-white">
                                <option value="">Semua Pembayaran</option>
                                <option value="lunas" {{ request('payment_status') == 'lunas' ? 'selected' : '' }}>Lunas
                                </option>
                                <option value="piutang" {{ request('payment_status') == 'piutang' ? 'selected' : '' }}>
                                    Piutang</option>
                            </select>
                            <img src="{{ asset('assets/icons/dropdown.png') }}"
                                class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-2.5 pointer-events-none"
                                alt="Dropdown">
                        </form>

                        {{-- Deadline Filter --}}
                        <form method="GET" action="{{ route('kasir.order') }}" class="relative">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="status_order" value="{{ request('status_order') }}">
                            <input type="hidden" name="payment_status" value="{{ request('payment_status') }}">
                            <input type="date" name="deadline" value="{{ request('deadline') }}"
                                onchange="this.form.submit()"
                                class="w-36 px-4 py-2 text-[13px] border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                        </form>

                        {{-- Add Button --}}
                        <a href="{{ route('kasir.order.create') }}"
                            class="inline-flex items-center px-5 py-2 bg-secondary text-white rounded-lg hover:bg-[#4a0f75] transition-colors text-[13px] font-medium">
                            <img src="{{ asset('assets/icons/tambah.png') }}" class="w-4 h-4 mr-2" alt="Add">
                            Tambah Pesanan
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">ID Pesanan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Total Harga
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status Bayar
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Status
                                    Produksi</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Deadline</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50 cursor-pointer"
                                    onclick="window.location='{{ route('kasir.order.show', $order->id) }}'">
                                    <td class="px-6 py-4 text-sm font-medium">{{ $order->order_number }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $order->customer->name }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $order->order_item->first()->product->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">{{ $order->order_item->sum('qty') }}</td>
                                    <td class="px-6 py-4 text-sm">
                                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($order->payment_status == 'lunas')
                                            <span
                                                class="px-2.5 py-1 bg-green-100 text-green-700 text-xs rounded-md">Lunas</span>
                                        @elseif($order->payment_status == 'piutang')
                                            <span
                                                class="px-2.5 py-1 bg-blue-100 text-blue-700 text-xs rounded-md">Piutang</span>
                                        @endif
                                    </td>

                                    {{-- FIX STATUS PRODUKSI --}}
                                    <td class="px-6 py-4">
                                        @if ($order->status_order == 'done')
                                            <span
                                                class="px-2.5 py-1 bg-green-100 text-green-700 text-xs rounded-md">Selesai</span>
                                        @elseif($order->status_order == 'process')
                                            <span
                                                class="px-2.5 py-1 bg-blue-100 text-blue-700 text-xs rounded-md">Proses</span>
                                        @elseif($order->status_order == 'pending')
                                            <span
                                                class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs rounded-md">Menunggu</span>
                                        @elseif($order->status_order == 'cancel')
                                            <span
                                                class="px-2.5 py-1 bg-red-100 text-red-700 text-xs rounded-md">Dibatalkan</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-sm">
                                        {{ \Carbon\Carbon::parse($order->deadline)->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4" onclick="event.stopPropagation()">
                                        <div class="flex gap-2">
                                            <a href="{{ route('kasir.order.show', $order->id) }}">
                                                <img src="{{ asset('assets/icons/edit.png') }}" class="w-5 h-5">
                                            </a>
                                            <button class="btn-delete" data-id="{{ $order->id }}"
                                                data-number="{{ $order->order_number }}">
                                                <img src="{{ asset('assets/icons/delete.png') }}" class="w-5 h-5">
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                        Belum ada data pesanan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
