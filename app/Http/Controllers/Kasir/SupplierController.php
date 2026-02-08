<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use App\Models\Material;
use App\Models\SupplierMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $suppliers = $query->withCount('supplier_material')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // Calculate total debt for each supplier
        foreach ($suppliers as $supplier) {
            $supplier->total_debt = $supplier->debt()->sum('amount');
        }

        return view('kasir.supply.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('kasir.supplier')->with('success', 'Pemasok berhasil ditambahkan!');
    }

    public function show($id)
    {
        $supplier = Supplier::with(['supplier_material.material.unit'])->findOrFail($id);

        // Get available materials not yet added to this supplier
        $availableMaterials = Material::whereNotIn(
            'id',
            $supplier->supplier_material->pluck('material_id')
        )->with('unit')->get();

        $totalDebt = $supplier->debt()->sum('amount');

        return view('kasir.supply.supplier-detail', compact('supplier', 'availableMaterials', 'totalDebt'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('kasir.supplier')->with('success', 'Pemasok berhasil diupdate!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        // Check if supplier has materials
        if ($supplier->supplier_material()->count() > 0) {
            return redirect()->route('kasir.supplier')->with('error', 'Pemasok tidak dapat dihapus karena masih memiliki bahan!');
        }

        $supplier->delete();

        return redirect()->route('kasir.supplier')->with('success', 'Pemasok berhasil dihapus!');
    }

    // Supplier Material Methods
    public function addMaterial(Request $request, $id)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'buy_price' => 'required|numeric|min:0',
        ]);

        // Check if material already exists for this supplier
        $exists = SupplierMaterial::where('supplier_id', $id)
            ->where('material_id', $request->material_id)
            ->exists();

        if ($exists) {
            return redirect()->route('kasir.supplier.show', $id)
                ->with('error', 'Bahan sudah ada dalam daftar pemasok ini!');
        }

        SupplierMaterial::create([
            'supplier_id' => $id,
            'material_id' => $request->material_id,
            'buy_price' => $request->buy_price,
        ]);

        return redirect()->route('kasir.supplier.show', $id)
            ->with('success', 'Bahan berhasil ditambahkan!');
    }

    public function updateMaterial(Request $request, $supplierId, $materialId)
    {
        $request->validate([
            'buy_price' => 'required|numeric|min:0',
        ]);

        $supplierMaterial = SupplierMaterial::where('supplier_id', $supplierId)
            ->where('material_id', $materialId)
            ->firstOrFail();

        $supplierMaterial->update([
            'buy_price' => $request->buy_price,
        ]);

        return redirect()->route('kasir.supplier.show', $supplierId)
            ->with('success', 'Harga bahan berhasil diupdate!');
    }

    public function deleteMaterial($supplierId, $materialId)
    {
        $supplierMaterial = SupplierMaterial::where('supplier_id', $supplierId)
            ->where('material_id', $materialId)
            ->firstOrFail();

        $supplierMaterial->delete();

        return redirect()->route('kasir.supplier.show', $supplierId)
            ->with('success', 'Bahan berhasil dihapus dari pemasok!');
    }
}
