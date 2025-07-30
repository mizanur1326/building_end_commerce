@extends('frontend.layouts.app')

@section('title', 'All Products')

@section('home')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">All Products</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($products as $product)
        <div class="card bg-white shadow rounded overflow-hidden">
            <img src="{{ asset('storage/' . $product->getMainImage()) }}"
                alt="{{ $product->name }}"
                class="w-full h-48 object-cover">

            <div class="p-4">
                <!-- <h2 class="text-lg font-bold">{{ $product->name }}</h2> -->
                <h2 class="text-lg font-bold">
                    <a href="{{ route('frontend.products.show', $product->slug) }}" class="text-blue-600 hover:underline">
                        {{ $product->name }}
                    </a>
                </h2>
                <p class="text-sm text-gray-600">{{ $product->category->name ?? 'Uncategorized' }}</p>

                @if ($product->discount_price)
                <p class="text-red-600 font-semibold">
                    ৳{{ $product->discount_price }}
                    <span class="line-through text-gray-500 text-sm">৳{{ $product->regular_price }}</span>
                </p>
                @else
                <p class="text-gray-800 font-semibold">৳{{ $product->regular_price }}</p>
                @endif

                <p class="text-sm mt-1">
                    @if ($product->stock_quantity > 0)
                    <span class="text-green-600">In Stock</span>
                    @else
                    <span class="text-red-600">Out of Stock</span>
                    @endif
                </p>
            </div>
        </div>
        @empty
        <p>No products available.</p>
        @endforelse
    </div>
</div>
@endsection