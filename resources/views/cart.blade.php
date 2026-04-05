<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>

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

        .btn-danger {
            background: #e3342f;
        }

        .btn-success {
            background: #38c172;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>

<!-- ✅ SUCCESS MESSAGE -->
@if(session('success'))
    <div style="background:#38c172;color:white;padding:10px;margin-bottom:15px;border-radius:5px;">
        {{ session('success') }}
    </div>
@endif

<!-- ❌ ERROR MESSAGE -->
@if(session('error'))
    <div style="background:#e3342f;color:white;padding:10px;margin-bottom:15px;border-radius:5px;">
        {{ session('error') }}
    </div>
@endif


<h1>Your Cart</h1>

@if(empty($grouped) || count($grouped) == 0)

    <p>Cart is empty</p>

@else

    @php $grandTotal = 0; @endphp

    @foreach($grouped as $vendor => $items)

        <h2>{{ $vendor }}</h2>

        @php $vendorTotal = 0; @endphp

        @foreach($items as $item)

            @php 
                $total = $item->product->price * $item->quantity;
                $vendorTotal += $total;
                $grandTotal += $total;
            @endphp

            <div class="card">
                <strong>{{ $item->product->name }}</strong><br>

                Qty: {{ $item->quantity }} <br>
                Price: ₹{{ $item->product->price }} <br>
                Total: ₹{{ $total }}

                <br><br>

                <!-- <a class="btn btn-danger" href="/remove-item/{{ $item->id }}">
                    Remove
                </a> -->
            </div>

        @endforeach

        <!-- ✅ Vendor Total -->
        <div class="card">
            <strong>Total for {{ $vendor }}:</strong> ₹{{ $vendorTotal }}
        </div>

        <hr>

    @endforeach

    <!-- ✅ Grand Total -->
    <div class="card">
        <strong>Grand Total:</strong> ₹{{ $grandTotal }}
    </div>

    <br>

    <!-- ✅ SINGLE Checkout Button -->
    <form action="/checkout">
        <button class="btn btn-success">Checkout</button>
    </form>

@endif

<br><br>

<a class="btn" href="/">Back to Products</a>

</body>
</html>