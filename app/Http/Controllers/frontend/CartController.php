<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        // If already in cart, increase quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->discount_price ?? $product->regular_price,
                'image' => $product->getMainImage(),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('frontend.pages.cart.index', compact('cart'));
    }

    public function updateQuantity(Request $request, $id)
    {
        $action = $request->input('action'); // 'increment' or 'decrement'
        $cart = session('cart', []);

        if (!isset($cart[$id])) {
            return response()->json(['error' => 'Product not found in cart.'], 404);
        }

        $currentQty = $cart[$id]['quantity'];

        if ($action === 'increment') {
            $cart[$id]['quantity'] = $currentQty + 1;
        } elseif ($action === 'decrement' && $currentQty > 1) {
            $cart[$id]['quantity'] = $currentQty - 1;
        }

        session(['cart' => $cart]);

        $updatedQty = $cart[$id]['quantity'];
        $updatedPrice = $cart[$id]['price'] * $updatedQty;

        // Calculate new cart total
        $cartTotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return response()->json([
            'quantity' => $updatedQty,
            'itemTotalPrice' => $updatedPrice,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function remove($productId)
    {
        $cart = session('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session(['cart' => $cart]);

            // Recalculate total quantity and price for response (optional)
            $cartCount = collect($cart)->sum('quantity');
            $cartTotal = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            return response()->json([
                'message' => 'Item removed successfully.',
                'cartCount' => $cartCount,
                'cartTotal' => number_format($cartTotal, 2),
            ]);
        }

        return response()->json(['error' => 'Item not found in cart.'], 404);
    }
}
