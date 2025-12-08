<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        // Format harga: hilangkan titik dan konversi ke integer
        $harga = str_replace('.', '', $validated['price']);
        
        Product::create([
            'name' => $validated['name'],
            'price' => (int)$harga,
            'stock' => $validated['stock'],
            'description' => $validated['description']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        // Format harga untuk ditampilkan di form
        $product->formatted_price = number_format($product->price, 0, ',', '.');
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string'
        ]);

        // Format harga: hilangkan titik dan konversi ke integer
        $harga = str_replace('.', '', $validated['price']);
        
        $product->update([
            'name' => $validated['name'],
            'price' => (int)$harga,
            'stock' => $validated['stock'],
            'description' => $validated['description']
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        
        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');
    }
}