<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="mystyles.css">
    <link rel="icon" type="image/x-icon" href="storage/assets/images/products/rt.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>@yield('title')</title>
</head>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
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
    .topnav {
        overflow: hidden;
        background-color: lightgray;
    }

    .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .topnav a:hover {
        background-color: lightgray;
        color: red;
    }
</style>
<body class="antialiased">
<div class="topnav">
    <a href="/welcome1" >Inventory</a>
    <a href="/products" >products</a>
    <a href="/category" >category</a>
    <a href="/">LogOut</a>

</div>


@yield('content')
@yield('scripts')
</body>
</html>
