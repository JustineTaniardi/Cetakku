<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Receivable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $pendingOrders = Order::where('status_order', 'pending')->count();
        $pendingInProcess = Order::where('status_order', 'process')->count();

        $todayOmset = Order::whereDate('order_date', Carbon::today())
            ->where('status_order', '!=', 'cancel')
            ->sum('total_price');

        $totalReceivables = Receivable::where('status', 'unpaid')->sum('amount');
        $countReceivables = Receivable::where('status', 'unpaid')->count();

        $totalOrdersToday = Order::whereDate('order_date', Carbon::today())
            ->where('status_order', '!=', 'cancel')
            ->count();

        $monthlyOrders = Order::whereMonth('order_date', $currentMonth)
            ->whereYear('order_date', $currentYear)
            ->where('status_order', '!=', 'cancel')
            ->count();
        $monthlyOrdersProcessed = Order::whereMonth('order_date', $currentMonth)
            ->whereYear('order_date', $currentYear)
            ->where('status_order', 'done')
            ->count();

        $activeCustomers = Customer::whereHas('order', function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('order_date', $currentMonth)
                ->whereYear('order_date', $currentYear);
        })->count();

        $weeklyOrders = [];
        for ($week = 1; $week <= 4; $week++) {
            $startOfWeek = Carbon::now()->startOfMonth()->addWeeks($week - 1);
            $endOfWeek = $startOfWeek->copy()->endOfWeek();

            $weeklyOrders[] = Order::whereBetween('order_date', [$startOfWeek, $endOfWeek])
                ->where('status_order', '!=', 'cancel')
                ->count();
        }

        // Grafik Orderan Tahun 2026 (per bulan)
        $yearlyOrders = [];
        for ($month = 1; $month <= 12; $month++) {
            $yearlyOrders[] = Order::whereMonth('order_date', $month)
                ->whereYear('order_date', $currentYear)
                ->where('status_order', '!=', 'cancel')
                ->count();
        }

        // Transaksi Terbaru (7 transaksi terakhir)
        $recentTransactions = Order::with(['customer', 'user'])
            ->latest()
            ->take(7)
            ->get()
            ->map(function ($order) {
                return [
                    'invoice' => $order->order_number,
                    'customer' => $order->customer->name,
                    'status' => $order->payment_status,
                    'kasir' => $order->user->name
                ];
            });

        return view('kasir.main.dashboard', compact(
            'pendingOrders',
            'pendingInProcess',
            'todayOmset',
            'totalReceivables',
            'countReceivables',
            'totalOrdersToday',
            'monthlyOrders',
            'monthlyOrdersProcessed',
            'activeCustomers',
            'weeklyOrders',
            'yearlyOrders',
            'recentTransactions'
        ));
    }
}
