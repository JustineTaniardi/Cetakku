<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Unit;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categoriesQuery = Category::withCount('product');
        $unitsQuery = Unit::withCount('product');

        // Search categories
        if ($request->filled('search_category')) {
            $categoriesQuery->where('name', 'like', "%{$request->search_category}%");
        }

        // Search units
        if ($request->filled('search_unit')) {
            $unitsQuery->where('name', 'like', "%{$request->search_unit}%");
        }

        $categories = $categoriesQuery->orderBy('created_at', 'desc')->get();
        $units = $unitsQuery->orderBy('created_at', 'desc')->get();

        return view('kasir.products.category', compact('categories', 'units'));
    }

    // Category Methods
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('kasir.category')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('kasir.category')->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroyCategory($id)
    {
        $category = Category::findOrFail($id);
        
        if ($category->product()->count() > 0) {
            return redirect()->route('kasir.category')->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk!');
        }

        $category->delete();

        return redirect()->route('kasir.category')->with('success', 'Kategori berhasil dihapus!');
    }

    // Unit Methods
    public function storeUnit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name',
            'abbreviation' => 'nullable|string|max:50',
            'value' => 'required|integer|min:1',
        ]);

        Unit::create([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'value' => $request->value,
        ]);

        return redirect()->route('kasir.category')->with('success', 'Satuan berhasil ditambahkan!');
    }

    public function updateUnit(Request $request, $id)
    {
        $unit = Unit::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $id,
            'abbreviation' => 'nullable|string|max:50',
            'value' => 'required|integer|min:1',
        ]);

        $unit->update([
            'name' => $request->name,
            'abbreviation' => $request->abbreviation,
            'value' => $request->value,
        ]);

        return redirect()->route('kasir.category')->with('success', 'Satuan berhasil diupdate!');
    }

    public function destroyUnit($id)
    {
        $unit = Unit::findOrFail($id);
        
        if ($unit->product()->count() > 0 || $unit->material()->count() > 0) {
            return redirect()->route('kasir.category')->with('error', 'Satuan tidak dapat dihapus karena masih digunakan!');
        }

        $unit->delete();

        return redirect()->route('kasir.category')->with('success', 'Satuan berhasil dihapus!');
    }
}