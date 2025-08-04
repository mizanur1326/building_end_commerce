@extends('frontend.layouts.app')

@section('title', 'Checkout')

@section('home')
<div class="p-6 max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <table class="min-w-full bg-white border text-sm mb-6">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Qty</th>
                <th class="px-4 py-2">Unit Price</th>
                <th class="px-4 py-2">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <td class="px-4 py-2">{{ $item['name'] }}</td>
                <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                <td class="px-4 py-2">৳{{ number_format($item['price'], 2) }}</td>
                <td class="px-4 py-2">৳{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
            </tr>
            @endforeach
            <tr class="font-bold bg-gray-50">
                <td colspan="3" class="px-4 py-2 text-right">Total:</td>
                <td class="px-4 py-2">৳{{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('checkout.store') }}" method="POST" class="space-y-4 bg-gray-50 p-4 rounded shadow">
        @csrf
        <div>
            <label class="block font-medium mb-1">Name *</label>
            <input type="text" name="name" class="w-full border px-4 py-2 rounded" required>
        </div>
        <div>
            <label class="block font-medium mb-1">Email (optional)</label>
            <input type="email" name="email" class="w-full border px-4 py-2 rounded">
        </div>
        <div>
            <label class="block font-medium mb-1">Phone (optional)</label>
            <input type="text" name="phone" class="w-full border px-4 py-2 rounded">
        </div>
        <div>
            <label class="block font-medium mb-1">Address (optional)</label>
            <textarea name="address" class="w-full border px-4 py-2 rounded"></textarea>
        </div>

            <a href="{{ route('cart.index') }}"
                class="inline-block mb-4 text-sm text-blue-600 hover:underline">
                ← Back to Cart
            </a>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Place Order
        </button>
    </form>
</div>
@endsection