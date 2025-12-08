<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // ambil semua data produk
        return view('products.index', compact('products'));
    }
}