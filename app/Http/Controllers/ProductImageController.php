<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    public function destroy(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $productId = $image->product_id;
        $image->delete();

        return redirect()->route('products.edit', $productId)->with('success', 'Image deleted successfully!');
    }
}
