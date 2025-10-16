@php
    // Define products aligned with your varieties. Prices are examples.
    $products = [
        ['id' => 'W180', 'label' => 'W180 Premium', 'img' => 'images/img/variety/W180.png', 'price' => 1499],
        ['id' => 'W240', 'label' => 'W240 Select',  'img' => 'images/img/variety/w240.png', 'price' => 1299],
        ['id' => 'W320', 'label' => 'W320 Classic', 'img' => 'images/img/variety/w320.png', 'price' => 1099],
        ['id' => 'LWP',  'label' => 'LWP',          'img' => 'images/img/variety/lwp.png',  'price' => 899],
        ['id' => 'WS',   'label' => 'WS',           'img' => 'images/img/variety/ws.png',   'price' => 799],
    ];
@endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop - AK Cashews</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>
<body>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Buy Cashews</h1>
        <div>
            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Back to Home</a>
            <a href="{{ url('/cart') }}" class="btn btn-primary ms-2"><i class="bi bi-cart me-1"></i> Cart</a>
        </div>
    </div>

    <div class="row g-4">
        @foreach($products as $p)
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100">
                    <div class="p-3 text-center bg-light">
                        <img src="{{ asset($p['img']) }}" alt="{{ $p['label'] }}" class="img-fluid" style="height:160px;object-fit:contain;">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $p['label'] }}</h5>
                        <p class="text-muted mb-4">1kg pack</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <strong>₹ {{ number_format($p['price']) }}</strong>
                            <form method="POST" action="{{ url('/cart/add') }}" class="d-inline-flex align-items-center">
                                @csrf
                                <input type="hidden" name="id" value="{{ $p['id'] }}">
                                <input type="hidden" name="label" value="{{ $p['label'] }}">
                                <input type="hidden" name="price" value="{{ $p['price'] }}">
                                <input type="number" name="qty" value="1" min="1" class="form-control form-control-sm me-2" style="width:80px;">
                                <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-bag-plus me-1"></i>Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>