<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/images/img_1.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
<body>

<div class="topnav">
    <a href="{{ route('login') }}" >LogIn</a>
    @if (Auth::user())
        <a href="{{ route('signout') }}" >LogOut</a>
    @endif
</div>
@yield('content')
</body>
</html>
