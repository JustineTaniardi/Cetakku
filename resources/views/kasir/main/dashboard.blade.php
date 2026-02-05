@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Greeting --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Halo, Kasir!</h1>
        <p class="text-gray-600">Semangat Bekerja Hari Ini</p>
    </div>

    {{-- Stats Cards Row 1 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Orderan Pending --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Orderan Pending</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $pendingOrders + $pendingInProcess }}</h3>
                    <p class="text-xs text-purple-600">{{ $pendingOrders }} pending, {{ $pendingInProcess }} dalam proses</p>
                </div>
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Omset Hari Ini --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Total Omset Hari Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp{{ number_format($todayOmset, 0, ',', '.') }}</h3>
                    <p class="text-xs text-purple-600">Omset hari ini</p>
                </div>
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Piutang --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Piutang</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp{{ number_format($totalReceivables, 0, ',', '.') }}</h3>
                    <p class="text-xs text-purple-600">{{ $countReceivables }} Jumlah piutang</p>
                </div>
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Orderan Total --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Orderan Total</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $totalOrdersToday }}</h3>
                    <p class="text-xs text-purple-600">Orderan hari ini</p>
                </div>
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards Row 2 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Orderan Bulan Ini --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Orderan Bulan Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $monthlyOrders }}</h3>
                    <p class="text-xs text-purple-600">{{ $monthlyOrdersProcessed }} Orderan telah diproses bulan ini</p>
                </div>
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Konsumen --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-2">Total Konsumen</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">{{ $activeCustomers }}</h3>
                    <p class="text-xs text-purple-600">Konsumen Aktif</p>
                </div>
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts and Transactions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Monthly Chart --}}
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Grafik Orderan Bulan <span class="text-purple-600">Oktober 2026</span></h3>
                </div>
                <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filter
                </button>
            </div>
            <canvas id="monthlyChart" height="80"></canvas>
        </div>

        {{-- Recent Transactions --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Transaksi</h3>
                <a href="#" class="text-sm text-purple-600 hover:text-purple-700">Lihat semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-purple-900 text-white text-xs">
                            <th class="px-3 py-2 text-left rounded-tl-lg">Invoice</th>
                            <th class="px-3 py-2 text-left">Konsumen</th>
                            <th class="px-3 py-2 text-left">Status</th>
                            <th class="px-3 py-2 text-left rounded-tr-lg">Kasir</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs">
                        @foreach($recentTransactions as $transaction)
                        <tr class="border-b border-gray-100">
                            <td class="px-3 py-2">{{ $transaction['invoice'] }}</td>
                            <td class="px-3 py-2">{{ $transaction['customer'] }}</td>
                            <td class="px-3 py-2">
                                @if($transaction['status'] == 'lunas')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Lunas</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs">Belum Lunas</span>
                                @endif
                            </td>
                            <td class="px-3 py-2">{{ $transaction['kasir'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Yearly Chart --}}
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Grafik Orderan Tahun <span class="text-purple-600">2026</span></h3>
            <button class="px-4 py-2 border border-gray-300 rounded-lg text-sm hover:bg-gray-50">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filter
            </button>
        </div>
        <canvas id="yearlyChart" height="60"></canvas>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Orderan',
                data: @json($weeklyOrders),
                borderColor: '#7C3AED',
                backgroundColor: 'rgba(124, 58, 237, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#7C3AED',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Yearly Chart
    const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
    const yearlyChart = new Chart(yearlyCtx, {
        type: 'line',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            datasets: [{
                label: 'Orderan',
                data: @json($yearlyOrders),
                borderColor: '#7C3AED',
                backgroundColor: 'rgba(124, 58, 237, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#7C3AED',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection