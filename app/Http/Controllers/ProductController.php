<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('admin.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.pages.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'regular_price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            // 'discount_price' => 'nullable|numeric|min:0', // no longer needed
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'discount_start_date' => 'nullable|date',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Calculate discount price automatically
        $discountPrice = null;
        if (!empty($validated['discount_percentage'])) {
            $discountAmount = ($validated['regular_price'] * $validated['discount_percentage']) / 100;
            $discountPrice = round($validated['regular_price'] - $discountAmount, 2);
        }

        // Handle 'null' string for category_id dropdown (Uncategorized)
        // $validated['category_id'] = $request->category_id === 'null' ? null : $validated['category_id'];


        // $validated['category_id'] = $request->category_id === 'null' ? null : $validated['category_id'];
        // $validated['brand_id'] = $request->brand_id === 'null' ? null : $validated['brand_id'];

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'regular_price' => $validated['regular_price'],
            'discount_percentage' => $validated['discount_percentage'] ?? null,
            'discount_price' => $discountPrice,
            'category_id' => $validated['category_id'] ?? null,
            'brand_id' => $validated['brand_id'] ?? null,
            'stock_quantity' => $validated['stock_quantity'],
            'status' => $validated['status'],
            'discount_start_date' => $validated['discount_start_date'] ?? null,
            'discount_end_date' => $validated['discount_end_date'] ?? null,
        ]);

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

        if ($request->category_id === 'null') {
            $validated['category_id'] = null;
        }

        if ($request->brand_id === 'null') {
            $validated['brand_id'] = null;
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.pages.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'regular_price' => 'required|numeric|min:0',
            'discount_percentage' => 'nullable|numeric|min:0|max:100',
            // 'discount_price' => 'nullable|numeric|min:0', // no longer needed
            'category_id' => 'nullable|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'stock_quantity' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'discount_start_date' => 'nullable|date',
            'discount_end_date' => 'nullable|date|after_or_equal:discount_start_date',
            'images' => 'nullable|array|max:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Calculate discount price automatically
        $discountPrice = null;
        if (!empty($validated['discount_percentage'])) {
            $discountAmount = ($validated['regular_price'] * $validated['discount_percentage']) / 100;
            $discountPrice = round($validated['regular_price'] - $discountAmount, 2);
        }

        // Handle 'null' string for category_id dropdown (Uncategorized)
        $validated['category_id'] = $request->category_id === 'null' ? null : $validated['category_id'];

        $existingCount = $product->images()->count();
        $newImagesCount = $request->hasFile('images') ? count($request->file('images')) : 0;

        if ($existingCount + $newImagesCount > 4) {
            return back()->withErrors(['images' => 'Total images (old + new) cannot exceed 4.'])->withInput();
        }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'regular_price' => $validated['regular_price'],
            'discount_percentage' => $validated['discount_percentage'] ?? null,
            'discount_price' => $discountPrice,
            'category_id' => $validated['category_id'],
            'brand_id' => $validated['brand_id'] ?? null,
            'stock_quantity' => $validated['stock_quantity'],
            'status' => $validated['status'],
            'discount_start_date' => $validated['discount_start_date'] ?? null,
            'discount_end_date' => $validated['discount_end_date'] ?? null,
        ]);

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

        return redirect()->route('products.index')
            ->with('success', "Product '{$product->name}' updated successfully!");
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully!');
    }


    public function show(Product $product)
    {
        return view('admin.pages.products.show', compact('product'));
    }
}
