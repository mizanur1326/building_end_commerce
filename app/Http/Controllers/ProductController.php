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
            'images' => 'nullable|array|max:4', // max 4 files allowed
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
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',

        ]);

        // Count existing images after possible deletions
        $existingCount = $product->images()->count();
        $newImagesCount = $request->hasFile('images') ? count($request->file('images')) : 0;

        if ($existingCount + $newImagesCount > 4) {
            return back()->withErrors(['images' => 'Total images (old + new) cannot exceed 4.'])->withInput();
        }

        $product->update($request->only([
            'name',
            'description',
            'price',
            'category_id',
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = "products/{$filename}";

                $image = Image::read($file)
                    ->resize(800, null, fn($c) => $c->aspectRatio()->upsize())
                    ->toJpeg(80);

                Storage::disk('public')->put($path, (string) $image);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', "Product Name = '{$product->name}' updated successfully!");
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
