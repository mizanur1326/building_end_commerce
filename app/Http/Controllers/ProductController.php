<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Intervention\Image\Facades\Image;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Create product
        $product = Product::create($request->only([
            'name',
            'description',
            'price',
            'category_id',
        ]));

        // Handle each uploaded image
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = "products/{$filename}";

                // Resize and encode the image
                $image = Image::read($file)
                    ->resize(800, null, fn($c) => $c->aspectRatio()->upsize())
                    ->toJpeg(80);

                // Store the image on the public disk
                Storage::disk('public')->put($path, (string) $image);

                // Save image record to DB
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'category_id' => 'nullable|exists:categories,id',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);

    $product->update($request->only([
        'name',
        'description',
        'price',
        'category_id',
    ]));

    // If new images are uploaded, remove old ones
    if ($request->hasFile('images')) {
        // Delete old image files and DB entries
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image); // delete file from disk
            $img->delete(); // delete record from DB
        }

        // Upload and save new images
        foreach ($request->file('images') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = "products/{$filename}";

            $image = Image::read($file)
                ->resize(800, null, fn ($c) => $c->aspectRatio()->upsize())
                ->toJpeg(80);

            Storage::disk('public')->put($path, (string) $image);

            ProductImage::create([
                'product_id' => $product->id,
                'image'      => $path,
            ]);
        }
    }

    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
