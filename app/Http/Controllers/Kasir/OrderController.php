<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Receivable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'user', 'order_item.product']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhereHas('customer', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status_order
        if ($request->filled('status_order')) {
            $query->where('status_order', $request->status_order);
        }

        // Filter by payment_status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by deadline
        if ($request->filled('deadline')) {
            $deadline = $request->deadline;
            $query->whereDate('deadline', $deadline);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('kasir.main.order', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $products = Product::with(['category', 'unit'])->orderBy('name')->get();

        // Generate order number
        $lastOrder = Order::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->orderBy('id', 'desc')
            ->first();

        if ($lastOrder) {
            $lastNumber = intval(substr($lastOrder->order_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $orderNumber = 'ORD-' . date('Ym') . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return view('kasir.main.order-create', compact('customers', 'products', 'orderNumber'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'deadline' => 'required|date',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.qty' => 'required|numeric|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Generate order number
            $lastOrder = Order::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', date('m'))
                ->orderBy('id', 'desc')
                ->first();

            if ($lastOrder) {
                $lastNumber = intval(substr($lastOrder->order_number, -4));
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }

            $orderNumber = 'ORD-' . date('Ym') . '-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            // Calculate total
            $totalPrice = 0;
            foreach ($request->products as $product) {
                $totalPrice += $product['price'] * $product['qty'];
            }

            // Create order
            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_id' => $request->customer_id,
                'user_id' => Auth::id(),
                'order_date' => $request->order_date,
                'deadline' => $request->deadline,
                'status_order' => 'pending',
                'payment_status' => 'piutang',
                'total_price' => $totalPrice,
                'paid_amount' => 0,
            ]);

            // Create order items (dengan timestamps & soft delete support)
            foreach ($request->products as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'subtotal' => $product['price'] * $product['qty'],
                ]);
            }

            // Create receivable
            Receivable::create([
                'customer_id' => $request->customer_id,
                'order_id' => $order->id,
                'amount' => $totalPrice,
                'due_date' => now(),
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('kasir.order')->with('success', 'Pesanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $order = Order::with([
            'customer',
            'user',
            'order_item.product.unit',
            'order_item.product.category',
            'payment',
            'receivable'
        ])->findOrFail($id);

        return view('kasir.main.order-detail', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status_order' => 'required|in:pending,process',
            'payment_status' => 'required|in:lunas,piutang',
        ]);

        $order->update($request->only(['status_order', 'payment_status']));

        // Update receivable status
        if ($request->payment_status == 'lunas') {
            $order->receivable()->update(['status' => 'lunas']);
        }

        return redirect()->route('kasir.order.show', $id)->with('success', 'Status pesanan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // Soft delete order items juga
        $order->order_item()->delete();

        // Soft delete order
        $order->delete();

        return redirect()->route('kasir.order')->with('success', 'Pesanan berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'status_order' => 'required|in:pending,process',
        ]);

        $order->update(['status_order' => $request->status_order]);

        return response()->json([
            'success' => true,
            'message' => 'Status produksi berhasil diupdate!'
        ]);
    }

    public function updatePayment(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'payment_status' => 'required|in:lunas,piutang',
        ]);

        $order->update(['payment_status' => $request->payment_status]);

        // Update receivable status
        if ($request->payment_status == 'lunas') {
            $order->receivable()->update(['status' => 'lunas']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Status pembayaran berhasil diupdate!'
        ]);
    }
}
