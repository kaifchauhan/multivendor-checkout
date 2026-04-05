<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h1, h2 {
            color: #333;
        }

        .card {
            background: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .btn {
            display: inline-block;
            padding: 8px 12px;
            margin-top: 8px;
            background: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-danger {
            background: #e3342f;
        }

        .btn-success {
            background: #38c172;
        }

        input, select {
            padding: 8px;
            margin: 5px 0;
            width: 200px;
        }

        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #f4f6f9;
        margin: 0;
        padding: 20px;
    }

    h1, h2 {
        color: #333;
    }

    .card {
        background: #fff;
        padding: 15px;
        margin: 10px 0;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .btn {
        display: inline-block;
        padding: 8px 12px;
        margin-top: 8px;
        background: #3490dc;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn:hover {
        opacity: 0.9;
    }

    .btn-danger {
        background: #e3342f;
    }

    .btn-success {
        background: #38c172;
    }

    input, select {
        padding: 8px;
        margin: 5px 0;
        width: 200px;
    }

    form {
        margin-bottom: 20px;
    }
</style>
<body>
@if(session('success'))
    <div style="
        background: #38c172;
        color: white;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
    ">
        {{ session('success') }}
    </div>
@endif

<h1>Products</h1>

@foreach($products as $product)
    <div class="card">
        <h3>{{ $product->name }}</h3>
        <p>Vendor: {{ $product->vendor->name }}</p>
        <p>Price: ₹{{ $product->price }}</p>

        <form method="POST" action="/add-to-cart">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <label>Qty:</label>
            <input 
                type="number" 
                name="quantity" 
                value="1" 
                min="1" 
                max="{{ $product->stock }}" 
                style="width:60px;"
            >

            <button class="btn btn-success">Add to Cart</button>
        </form>

        <p>Stock: {{ $product->stock }}</p>
    </div>
@endforeach

<br>
<a class="btn btn-primary" href="/cart-ui">Go to Cart</a>

</body>
</html>