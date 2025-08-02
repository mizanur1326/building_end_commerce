@php
$cart = session('cart', []);
$cartCount = collect($cart)->sum('quantity');
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
                <!-- <div class="relative flex items-center hidden lg:block">
             <i class="fa fa-search absolute ml-3" aria-hidden="true"></i>
            <input type="search" name="search" placeholder="Search Products" class="bg-gray-500 text-white pl-10 rounded-2xl border-none" id=""> 
           </div> -->

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
                    <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-80 bg-base-100 shadow">
                        <div class="card-body">
                            <span class="font-bold text-lg">{{ $cartCount }} Item(s)</span>

                            @if ($cartCount > 0)
                            <div class="divide-y divide-gray-200 max-h-60 overflow-y-auto">
                                @foreach ($cart as $id => $item)
                                <div class="flex items-center py-2 space-x-3">
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-12 h-12 object-cover rounded" alt="{{ $item['name'] }}">

                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium truncate">{{ $item['name'] }}</p>

                                        <div class="flex items-center space-x-2 mt-1">
                                            <!-- Decrement Button -->
                                            <button
                                                class="qty-btn px-2 py-1 bg-gray-200 rounded"
                                                data-product-id="{{ $id }}"
                                                data-action="decrement"
                                                type="button">-</button>

                                            <!-- Quantity display -->
                                            <input
                                                type="text"
                                                readonly
                                                value="{{ $item['quantity'] }}"
                                                class="w-10 text-center border rounded"
                                                id="qty-input-{{ $id }}">

                                            <!-- Increment Button -->
                                            <button
                                                class="qty-btn px-2 py-1 bg-gray-200 rounded"
                                                data-product-id="{{ $id }}"
                                                data-action="increment"
                                                type="button">+</button>
                                            <!-- Unit price display -->
                                            <p class="text-xs text-gray-600 ml-4">
                                                X <span id="unit-price-{{ $id }}">{{ number_format($item['price'], 2) }}</span>
                                            </p>

                                            <!-- Price display -->
                                            <p class="text-xs text-gray-600 ml-4">
                                                ৳<span id="price-{{ $id }}">{{ $item['price'] * $item['quantity'] }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

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

<script>
    document.querySelectorAll('.qty-btn').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const action = this.getAttribute('data-action');

            // Get current quantity from input field
            const qtyInput = document.getElementById(`qty-input-${productId}`);
            const currentQty = parseInt(qtyInput.value);

            // If decrement and quantity is 1, confirm removal
            if (action === 'decrement' && currentQty === 1) {
                if (!confirm('This will remove the item from your cart. Are you sure?')) {
                    return; // user cancelled, stop further action
                }

                // Send remove request
                fetch(`{{ url('/cart/remove') }}/${productId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        // Optionally update UI or reload page
                        // For now, reload to reflect cart changes:
                        location.reload();
                    })
                    .catch(err => console.error(err));

                return; // stop normal decrement fetch below
            }

            // Normal increment/decrement fetch
            fetch(`{{ url('/cart/update-quantity') }}/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        action
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }
                    // Update quantity input
                    qtyInput.value = data.quantity;
                    // Update price display for this item
                    document.getElementById(`price-${productId}`).innerText = data.itemTotalPrice;
                    // Update subtotal
                    document.getElementById('cart-subtotal').innerText = data.cartTotal;
                })
                .catch(err => console.error(err));
        });
    });
</script>