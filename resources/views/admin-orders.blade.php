<!DOCTYPE html>
<html>
<head>
    <title>Admin Orders</title>
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

<form method="GET" action="/admin/orders-ui">

    <input type="number" name="vendor_id" placeholder="Vendor ID">
    <input type="number" name="user_id" placeholder="User ID">

    <select name="status">
        <option value="">All Status</option>
        <option value="completed">Completed</option>
    </select>

    <button class="btn">Filter</button>
</form>

<h1>All Orders (Admin)</h1>

@foreach($orders as $order)
    <div class="card">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>User:</strong> {{ $order->user->name }}</p>
        <p><strong>Vendor:</strong> {{ $order->vendor->name }}</p>
        <p><strong>Total:</strong> ₹{{ $order->total_amount }}</p>

        <h4>Items:</h4>

        @foreach($order->items as $item)
            <div>
                {{ $item->product->name }} 
                (Qty: {{ $item->quantity }}) 
                - ₹{{ $item->price }}
            </div>
        @endforeach
    </div>
@endforeach

<br>
<a href="/admin">Back to Home</a>

</body>
</html>