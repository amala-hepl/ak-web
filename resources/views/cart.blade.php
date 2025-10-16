@php
    $cart = session('cart', []);
    $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart - AK Cashews</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Your Cart</h1>
        <div>
            <a href="{{ url('/shop') }}" class="btn btn-outline-secondary">Continue Shopping</a>
        </div>
    </div>

    @if(empty($cart))
        <div class="alert alert-info">Your cart is empty.</div>
    @else
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th width="140">Price</th>
                        <th width="120">Qty</th>
                        <th width="160">Total</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <td>{{ $item['label'] }}</td>
                            <td>₹ {{ number_format($item['price']) }}</td>
                            <td>
                                <form method="POST" action="{{ url('/cart/update') }}" class="d-flex align-items-center">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" class="form-control form-control-sm me-2" style="width:80px;">
                                    <button class="btn btn-sm btn-outline-primary">Update</button>
                                </form>
                            </td>
                            <td>₹ {{ number_format($item['price'] * $item['qty']) }}</td>
                            <td>
                                <form method="POST" action="{{ url('/cart/remove') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <div class="card" style="max-width:420px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <strong>₹ {{ number_format($subtotal) }}</strong>
                    </div>
                    <p class="text-muted small mb-3">Taxes and shipping are included in this demo.</p>

                    <form method="POST" action="{{ url('/checkout') }}">
                        @csrf
                        <button type="submit" class="btn btn-success w-100"><i class="bi bi-credit-card me-1"></i> Pay with Stripe (Test)</button>
                    </form>
                    <p class="text-muted small mt-2 mb-0">Test mode: no real charges.</p>
                </div>
            </div>
        </div>
    @endif
</div>
</body>
</html>