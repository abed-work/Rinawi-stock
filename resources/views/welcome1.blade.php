<!DOCTYPE html>
<html>
<head>
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="mystyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" type="image/x-icon" href="storage/assets/images/products/rt.jpeg">
    <title>@yield('title')</title>


</head>
<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: lightgray;
    }
    .py-4{
        padding: 3rem;

    }
    nav a{
        padding: .7rem;

    }
    h3{
        color: #e2e8f0;
    }
    h1{
        color: black;
    }
    .topnav {
        overflow: hidden;
        background-color:lightgray;
    }

    .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
        transition: all .5s;
    }

    .topnav a:hover {
        background-color: #af4279;
        color: skyblue;
    }
    .btn-group-vertical{
        display: flex;
        flex-direction: row
    }
</style>
<body class="antialiased">
<div class="topnav">
    <a href="/welcome">Back</a>
</div>
<br><br>
<br>
<br>

<div class="btn-group-vertical">

    <a class="btn-5" href="/products">Products</a>

    <a class="btn-5" href="/category"> Category</a>

    <a class="btn-5" href="/brand"> Brand</a>
</div>


</body>
</html>
