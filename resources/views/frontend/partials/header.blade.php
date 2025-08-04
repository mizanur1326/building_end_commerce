@php
$cart = session('cart', []);
$cartCount = count($cart); // ✅ number of distinct items
$cartTotal = collect($cart)->sum(function($item) {
return $item['price'] * $item['quantity'];
});
@endphp

<header>
    <!-- Top Discount Bar -->
    <div class="">
        <p class="text-white bg-black flex items-center justify-center p-2 text-sm satisfy">
            Sign up and get 20% off to your first order. Sign Up Now
        </p>
    </div>
    <!-- Nav Bar -->
    <div>
        <div class="navbar bg-base-100 px-8 lg:px-20">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="{{ route( 'home') }}">Home</a></li>
                        <li><a href="{{ route('products') }}">Products</a></li>
                        <li><a href="/cart.html">Cart</a></li>
                    </ul>
                </div>
                <a href="{{ route( 'home') }}" class="text-2xl lg:text-3xl">ShopUp</a>
            </div>

            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal px-1 lg:text-sm">
                    <li><a href="{{ route( 'home') }}">Home</a></li>
                    <li><a href="{{ route('products') }}">Products</a></li>
                    <li><a href="/cart.html">Cart</a></li>
                </ul>
            </div>

            <div class="navbar-end">
                <div class="lg:relative flex items-center">
                    <i class="fa fa-search lg:absolute ml-3 inset-y-0 left-0 flex items-center justify-center"
                        aria-hidden="true"></i>
                    <input type="search" name="search" placeholder="Search Products"
                        class="bg-slate-200 text-white pl-10 lg:pl-12 pr-4 py-2 rounded-2xl border-none hidden lg:block" id="">
                </div>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                        <div class="indicator">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="badge badge-sm indicator-item">{{ $cartCount }}</span>
                        </div>
                    </div>
                    <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content  bg-base-100 shadow">
                        <div class="card-body">
                            <span class="font-bold text-lg">You have {{ $cartCount }} Item's in Cart</span>

                            @if ($cartCount > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 text-sm">
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
                                        @foreach ($cart as $id => $item)
                                        <tr>
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
                                                ৳<span id="price-{{ $id }}">{{ $item['price'] * $item['quantity'] }}</span>
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
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <p class="font-semibold">Subtotal: ৳<span id="cart-subtotal">{{ $cartTotal }}</span></p>
                                <a href="{{ route('cart.index') }}" class="btn btn-primary btn-block mt-2">View Cart</a>
                            </div>
                            @else
                            <p class="text-center text-sm text-gray-500 mt-2">Your cart is empty.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <button class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="badge badge-xs badge-primary indicator-item"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const csrfToken = '{{ csrf_token() }}';

        // Handle Increment/Decrement Quantity
        document.querySelectorAll('.qty-btn').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;
                const action = this.dataset.action;
                const qtyInput = document.getElementById(`qty-input-${productId}`);
                const currentQty = parseInt(qtyInput.value);

                if (action === 'decrement' && currentQty === 1) {
                    if (!confirm('This will remove the item from your cart. Are you sure?')) return;
                    return removeFromCart(productId);
                }

                fetch(`{{ url('/cart/update-quantity') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ action })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) return alert(data.error);
                    qtyInput.value = data.quantity;
                    document.getElementById(`price-${productId}`).innerText = data.itemTotalPrice;
                    document.getElementById('cart-subtotal').innerText = data.cartTotal;
                })
                .catch(error => console.error('Quantity update failed:', error));
            });
        });

        // Handle Remove
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.productId;
                if (!confirm('Are you sure you want to remove this item from your cart?')) return;
                removeFromCart(productId);
            });
        });

        function removeFromCart(productId) {
            fetch(`{{ url('/cart/remove') }}/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) return alert(data.error);
                location.reload();
            })
            .catch(error => console.error('Remove failed:', error));
        }
    });
</script> -->

