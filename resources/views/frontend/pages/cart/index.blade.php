@extends('frontend.layouts.app')

@section('title', 'Shopping Cart')

@section('home')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

    @if (session('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif

    @if (count($cart))
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="p-4 text-left">Product</th>
                    <th class="p-4 text-left">Quantity</th>
                    <th class="p-4 text-left">Price</th>
                    <th class="p-4 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php $total += $item['price'] * $item['quantity']; @endphp
                    <tr>
                        <td class="p-4">
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 inline mr-2">
                            {{ $item['name'] }}
                        </td>
                        <td class="p-4">{{ $item['quantity'] }}</td>
                        <td class="p-4">৳{{ $item['price'] * $item['quantity'] }}</td>
                        <td class="p-4">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-600 hover:underline">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="2" class="p-4 font-bold">Total</td>
                    <td class="p-4 font-bold">৳{{ $total }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
