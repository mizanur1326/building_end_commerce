@extends('frontend.layouts.app')

@section('title', $product->name)

@section('home')
    <div class="p-6 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">{{ $product->name }}</h1>

        <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
                @if ($product->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $product->images->first()->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-auto rounded shadow">
                @else
                    <img src="{{ asset('images/no-image.jpg') }}" 
                         alt="No image available" 
                         class="w-full h-auto rounded shadow">
                @endif
            </div>

            <div class="md:w-1/2">
                <p><strong>Description:</strong> {{ $product->description }}</p>
                <p class="text-gray-700 mb-2">
                    <strong>Category:</strong> {{ $product->category->name ?? 'Uncategorized' }}
                </p>

                <p class="text-gray-700 mb-2">
                    <strong>Brand:</strong> {{ $product->brand->name ?? 'No Brand' }}
                </p>

                <p class="text-gray-700 mb-2">
                    <strong>Price:</strong>
                    @if ($product->discount_price)
                        <span class="text-red-600 font-semibold">৳{{ number_format($product->discount_price, 2) }}</span>
                        <span class="line-through text-gray-500 ml-2">৳{{ number_format($product->regular_price, 2) }}</span>
                    @else
                        <span class="font-semibold">৳{{ number_format($product->regular_price, 2) }}</span>
                    @endif
                </p>

                <p class="text-gray-700 mb-4">
                    <strong>Stock:</strong>
                    @if ($product->stock_quantity > 0)
                        <span class="text-green-600">In Stock ({{ $product->stock_quantity }})</span>
                    @else
                        <span class="text-red-600">Out of Stock</span>
                    @endif
                </p>

                <!-- Add to Cart button placeholder -->
                @if ($product->stock_quantity > 0)
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Add to Cart
                    </button>
                @else
                    <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                        Out of Stock
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection