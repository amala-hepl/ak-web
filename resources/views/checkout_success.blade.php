<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Success - AK Cashews</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container py-5">
    <div class="alert alert-success">
        <h4 class="alert-heading">Payment Successful!</h4>
        <p>Your test payment was processed successfully. Thank you for your purchase.</p>
        <hr>
        <a href="{{ url('/') }}" class="btn btn-primary">Back to Home</a>
    </div>
</div>
</body>
</html>