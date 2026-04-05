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

<h1>Admin Dashboard</h1>


<a class="btn" href="/admin/vendors">Vendors</a>
<a class="btn" href="/admin/products">Products</a>
<a class="btn" href="/admin/orders-ui">Orders</a>