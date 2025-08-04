@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

@section('home')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

    @if (session('success'))
    <p class="text-green-600">{{ session('success') }}</p>
    @endif

    @if (count($cart))
    <table class="min-w-full divide-y divide-gray-200 text-sm bg-white shadow rounded">
        <thead class="bg-gray-100 text-left text-gray-700">
            <tr>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Quantity</th>
                <th class="px-4 py-2">Unit Price</th>
                <th class="px-4 py-2">Total</th>
                <th class="px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @php $total = 0; @endphp
            @foreach ($cart as $id => $item)
            @php $itemTotal = $item['price'] * $item['quantity']; $total += $itemTotal; @endphp
            <tr id="cart-row-{{ $id }}">
                <td class="px-4 py-2">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover rounded">
                </td>
                <td class="px-4 py-2">
                    <p class="font-medium">{{ $item['name'] }}</p>
                </td>
                <td class="px-4 py-2">
                    <div class="flex items-center space-x-2">
                        <button
                            class="qty-btn px-2 py-1 bg-gray-200 rounded"
                            data-product-id="{{ $id }}"
                            data-action="decrement"
                            type="button">-</button>

                        <input
                            type="text"
                            readonly
                            value="{{ $item['quantity'] }}"
                            class="w-10 text-center border rounded"
                            id="qty-input-{{ $id }}">

                        <button
                            class="qty-btn px-2 py-1 bg-gray-200 rounded"
                            data-product-id="{{ $id }}"
                            data-action="increment"
                            type="button">+</button>
                    </div>
                </td>
                <td class="px-4 py-2">
                    ৳<span id="unit-price-{{ $id }}">{{ number_format($item['price'], 2) }}</span>
                </td>
                <td class="px-4 py-2">
                    ৳<span id="price-{{ $id }}">{{ number_format($itemTotal, 2) }}</span>
                </td>
                <td class="px-4 py-2">
                    <button
                        class="remove-btn text-red-600 hover:text-red-800"
                        data-product-id="{{ $id }}">
                        Remove
                    </button>
                </td>
            </tr>
            @endforeach
            <tr id="cart-total-row">
                <td colspan="4" class="px-4 py-3 text-right font-bold">Subtotal</td>
                <td colspan="2" class="px-4 py-3 font-bold" id="cart-subtotal">৳{{ number_format($total, 2) }}</td>
            </tr>
            <tr>
                <td colspan="6" class="px-4 py-4 text-right">
                    <a href="{{ route('checkout.page') }}"
                        class="inline-block bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Proceed to Checkout
                    </a>
                </td>
            </tr>

        </tbody>

    </table>
    @else
    <p>Your cart is empty.</p>
    @endif
</div>

@endsection