<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Material;
use App\Models\ProductMaterial;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'unit']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);

        // Stats
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $priceRange = Product::selectRaw('MIN(price) as min_price, MAX(price) as max_price')->first();

        // Categories for filter
        $categories = Category::all();

        return view('kasir.products.product', compact('products', 'totalProducts', 'totalCategories', 'priceRange', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('kasir.product')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'unit', 'product_material.material.unit', 'product_material.material.supplier_material.supplier'])->findOrFail($id);

        // Get available materials not yet added to this product
        $availableMaterials = Material::whereNotIn(
            'id',
            $product->product_material->pluck('material_id')
        )->with('unit')->get();

        return view('kasir.products.product-detail', compact('product', 'availableMaterials'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($request->all());

        return redirect()->route('kasir.product')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Check if product is used in orders
        if ($product->order_item()->count() > 0) {
            return redirect()->route('kasir.product')->with('error', 'Produk tidak dapat dihapus karena sudah digunakan di pesanan!');
        }

        $product->delete();

        return redirect()->route('kasir.product')->with('success', 'Produk berhasil dihapus!');
    }

    // Product Material Methods
    public function addMaterial(Request $request, $id)
    {
        $request->validate([
            'material_id' => 'required|exists:materials,id',
            'quantity_needed' => 'required|numeric|min:0',
        ]);

        // Check if material already exists for this product
        $exists = ProductMaterial::where('product_id', $id)
            ->where('material_id', $request->material_id)
            ->exists();

        if ($exists) {
            return redirect()->route('kasir.product.show', $id)
                ->with('error', 'Material sudah ada dalam daftar produk ini!');
        }

        ProductMaterial::create([
            'product_id' => $id,
            'material_id' => $request->material_id,
            'quantity_needed' => $request->quantity_needed,
        ]);

        return redirect()->route('kasir.product.show', $id)
            ->with('success', 'Material berhasil ditambahkan!');
    }

    public function updateMaterial(Request $request, $productId, $materialId)
    {
        $request->validate([
            'quantity_needed' => 'required|numeric|min:0',
        ]);

        $productMaterial = ProductMaterial::where('product_id', $productId)
            ->where('material_id', $materialId)
            ->firstOrFail();

        $productMaterial->update([
            'quantity_needed' => $request->quantity_needed,
        ]);

        return redirect()->route('kasir.product.show', $productId)
            ->with('success', 'Kuantitas material berhasil diupdate!');
    }

    public function deleteMaterial($productId, $materialId)
    {
        $productMaterial = ProductMaterial::where('product_id', $productId)
            ->where('material_id', $materialId)
            ->firstOrFail();

        $productMaterial->delete();

        return redirect()->route('kasir.product.show', $productId)
            ->with('success', 'Material berhasil dihapus dari produk!');
    }
}
