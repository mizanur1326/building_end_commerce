<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductFrontendController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand', 'images'])
            ->where('status', true)
            ->latest()
            ->get();

        return view('frontend.pages.products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.products.show', compact('product'));
    }
}
