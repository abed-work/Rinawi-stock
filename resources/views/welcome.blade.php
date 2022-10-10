<!DOCTYPE html>
<html>
<head>
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="mystyles.css">
    <link rel="icon" type="image/x-icon" href="storage/assets/images/products/rt.jpeg">
    <title>@yield('title')</title>
</head>
<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: lightgray;
    }
    .py-4{
        padding: 1rem;

    }
    nav a{
        padding: .5rem;
    }
    h3{
        color: #e2e8f0;
    }
    h1{
        color: black;
    }
    .btn-group-vertical{
        display: flex;
        flex-wrap: wrap;
        flex-direction: row
    }
    .btn-group-vertical a {
        width: 40%;
    }
</style>
<body>
    <header>
        <h1 class="header-1">Rinawi Tech-Store</h1>
    </header>
    <div class="btn-group-vertical">
        <a class="btn-5" href="/welcome1">Inventory</a>
        <a class="btn-5" href="{{ route('invoice.index') }}"> Sales</a>
        <a class="btn-5" href="/finance"> Finance</a>
        <a class="btn-5" href="/purchase"> Purchase</a>
        <a class="btn-5" href="{{ route('customer.index') }}"> Customers</a>
    </div>
</body>
</html>