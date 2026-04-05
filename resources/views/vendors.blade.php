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
<h1>Vendors</h1>

<form method="POST" action="/admin/vendors/add">
    @csrf
    <input type="text" name="name" placeholder="Vendor Name" required>
    <button type="submit">Add Vendor</button>
</form>

<hr>

@foreach($vendors as $vendor)
    <div class="card">
        {{ $vendor->name }}
        <a class="btn btn-danger" href="/admin/vendors/delete/{{ $vendor->id }}">Delete</a>
    </div>
@endforeach

<br>
<a href="/admin">Back</a>