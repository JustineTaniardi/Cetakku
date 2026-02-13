<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Unit;
use App\Models\Supplier;
use App\Models\SupplierMaterial;
use App\Models\Product;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $query = Material::with(['unit', 'supplier_material.supplier']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $materials = $query->orderBy('created_at', 'desc')->paginate(15);

        // Stats
        $totalMaterials = Material::count();
        $lowStock = Material::where('qty', '<', 10)->count();
        $totalSuppliers = Supplier::count();
        $totalUnits = Unit::count();

        // For Buy Material Modal
        $products = Product::with('product_material.material')->get();

        return view('kasir.supply.material', compact('materials', 'totalMaterials', 'lowStock', 'totalSuppliers', 'totalUnits', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'qty' => 'required|numeric|min:0',
        ]);

        Material::create($request->all());

        return redirect()->route('kasir.material')->with('success', 'Material berhasil ditambahkan!');
    }

    public function show($id)
    {
        $material = Material::with(['unit', 'supplier_material.supplier'])->findOrFail($id);

        // Get available suppliers not yet added to this material
        $availableSuppliers = Supplier::whereNotIn(
            'id',
            $material->supplier_material->pluck('supplier_id')
        )->get();

        return view('kasir.supply.material-detail', compact('material', 'availableSuppliers'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'unit_id' => 'required|exists:units,id',
            'qty' => 'required|numeric|min:0',
        ]);

        $material->update($request->all());

        return redirect()->route('kasir.material')->with('success', 'Material berhasil diupdate!');
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);

        // Check if material is used in products
        if ($material->product_material()->count() > 0) {
            return redirect()->route('kasir.material')->with('error', 'Material tidak dapat dihapus karena sudah digunakan di produk!');
        }

        $material->delete();

        return redirect()->route('kasir.material')->with('success', 'Material berhasil dihapus!');
    }

    // Material Supplier Methods
    public function addSupplier(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'buy_price' => 'required|numeric|min:0',
        ]);

        // Check if supplier already exists for this material
        $exists = SupplierMaterial::where('material_id', $id)
            ->where('supplier_id', $request->supplier_id)
            ->exists();

        if ($exists) {
            return redirect()->route('kasir.material.show', $id)
                ->with('error', 'Pemasok sudah ada dalam daftar material ini!');
        }

        SupplierMaterial::create([
            'material_id' => $id,
            'supplier_id' => $request->supplier_id,
            'buy_price' => $request->buy_price,
        ]);

        return redirect()->route('kasir.material.show', $id)
            ->with('success', 'Pemasok berhasil ditambahkan!');
    }

    public function updateSupplier(Request $request, $materialId, $supplierId)
    {
        $request->validate([
            'buy_price' => 'required|numeric|min:0',
        ]);

        $supplierMaterial = SupplierMaterial::where('material_id', $materialId)
            ->where('supplier_id', $supplierId)
            ->firstOrFail();

        $supplierMaterial->update([
            'buy_price' => $request->buy_price,
        ]);

        return redirect()->route('kasir.material.show', $materialId)
            ->with('success', 'Harga pemasok berhasil diupdate!');
    }

    public function deleteSupplier($materialId, $supplierId)
    {
        $supplierMaterial = SupplierMaterial::where('material_id', $materialId)
            ->where('supplier_id', $supplierId)
            ->firstOrFail();

        $supplierMaterial->delete();

        return redirect()->route('kasir.material.show', $materialId)
            ->with('success', 'Pemasok berhasil dihapus dari material!');
    }

    // Get Materials by Product (AJAX)
    public function getMaterialsByProduct($productId)
    {
        $product = Product::with('product_material.material.supplier_material.supplier')->findOrFail($productId);

        $materials = $product->product_material->map(function ($pm) {
            return [
                'id' => $pm->material->id,
                'name' => $pm->material->name,
                'unit' => $pm->material->unit->name ?? '-',
                'suppliers' => $pm->material->supplier_material->map(function ($sm) {
                    return [
                        'id' => $sm->supplier->id,
                        'name' => $sm->supplier->name,
                        'address' => $sm->supplier->address,
                        'buy_price' => $sm->buy_price,
                    ];
                })
            ];
        });

        return response()->json($materials);
    }

    // Purchase Material
    public function purchaseMaterial(Request $request)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'qty' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Update material stock
        $material = Material::findOrFail($request->material_id);
        $material->qty += $request->qty;
        $material->save();

        // Here you can add logic to create Purchase record if you have purchases table
        // Purchase::create([...]);

        return redirect()->back()->with('success', 'Pembelian bahan berhasil! Stok telah ditambahkan.');
    }

    // Get Suppliers by Material (AJAX)
    public function getSuppliersByMaterial($materialId)
    {
        $material = Material::with('supplier_material.supplier')->findOrFail($materialId);

        $suppliers = $material->supplier_material->map(function ($sm) {
            return [
                'id' => $sm->supplier->id,
                'name' => $sm->supplier->name,
                'address' => $sm->supplier->address,
                'buy_price' => $sm->buy_price,
            ];
        });

        return response()->json($suppliers);
    }
}
