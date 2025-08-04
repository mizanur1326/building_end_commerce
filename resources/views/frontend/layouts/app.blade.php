<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/74bd3f5679.js" crossorigin="anonymous"></script>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Alata&family=Satisfy&display=swap"
        rel="stylesheet" />
    <title>@yield('title', 'Default Title')</title>
</head>

<body class="alata">
    @include('frontend.partials.header')

    <main>
        @yield('home')
    </main>


    <script>
document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = '{{ csrf_token() }}';

    function updateQtyDisplay(productId, quantity, itemTotalPrice, cartTotal) {
        // Update all qty inputs with this productId
        const qtyInputs = document.querySelectorAll(`#qty-input-${productId}`);
        qtyInputs.forEach(input => input.value = quantity);

        // Update all price fields with this productId
        const priceFields = document.querySelectorAll(`#price-${productId}`);
        priceFields.forEach(field => field.innerText = `৳${parseFloat(itemTotalPrice).toFixed(2)}`);

        // Update all cart subtotal fields
        const cartSubtotals = document.querySelectorAll('#cart-subtotal');
        cartSubtotals.forEach(elem => elem.innerText = `৳${parseFloat(cartTotal).toFixed(2)}`);
    }

    function removeCartRow(productId) {
        // Remove the cart page row if present
        const row = document.getElementById(`cart-row-${productId}`);
        if (row) row.remove();
    }

    // Attach qty-btn handlers once
    document.querySelectorAll('.qty-btn').forEach(button => {
        // Remove previous event listeners if any (avoid duplicates)
        button.replaceWith(button.cloneNode(true));
    });

    // Re-select buttons after cloning
    document.querySelectorAll('.qty-btn').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.productId;
            const action = this.dataset.action;

            const qtyInput = document.getElementById(`qty-input-${productId}`);
            const currentQty = qtyInput ? parseInt(qtyInput.value) : 1;

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

                updateQtyDisplay(productId, data.quantity, data.itemTotalPrice, data.cartTotal);
            })
            .catch(error => console.error('Quantity update failed:', error));
        });
    });

    document.querySelectorAll('.remove-btn').forEach(button => {
        button.replaceWith(button.cloneNode(true));
    });

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

            // Remove cart row from cart page (if exists)
            removeCartRow(productId);

            // Update subtotal everywhere
            const cartSubtotals = document.querySelectorAll('#cart-subtotal');
            cartSubtotals.forEach(elem => elem.innerText = `৳${parseFloat(data.cartTotal).toFixed(2)}`);

            // If cart empty, reload or update UI accordingly
            if (data.cartCount === 0) {
                location.reload();
            }
        })
        .catch(error => console.error('Remove failed:', error));
    }
});
</script>

</body>

</html>