<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mystyles.css')}}">
    <link rel="icon" type="image/x-icon" href="storage/assets/images/products/rt.jpeg">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    * {box-sizing: border-box;}
    body {
        font-family: 'Nunito', sans-serif;
        background-color: lightgray;
    }
    .py-4{
        padding: 1rem;

    }

    h3{
        color: #e2e8f0;
    }
    h1{
        color: black;
    }
    .btnadd:hover{
        background-color: lightgray;
        color: red;
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

    .dropbtnbrand {
        background-color: lightgrey;
        color: black;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropbtnbrand:hover, .dropbtnbrand:focus {
        background-color: lightslategray;
    }

    #myInput {
        box-sizing: border-box;

        background-position: 14px 12px;
        background-repeat: no-repeat;
        font-size: 16px;
        padding: 14px 20px 12px 45px;
        border: none;
        border-bottom: 1px solid gray;
    }

    #myInput:focus {outline: 3px solid #ddd;}

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: gray;
        min-width: 230px;
        overflow: auto;
        border: 1px solid #ddd;
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown a:hover {background-color: #ddd;}

    .show {display: block;}
</style>
<body class="antialiased">

    <div class="topnav">
        <div class="container">
            <nav>
                <ul>
                    <li><a href="/welcome1">Inventory</a></li>
                    <li><a href="/category" >category</a></li>
                    <li><a href="/brand" >brand</a></li>
                    @if (Auth::user())
                        <li><a href="/">LogOut</a></li>
                    @endif
                </ul>
                
                <div class="pull-right">
                    <form action="/products/search" method="GET">
                        <div class="form-group">
                            <input name="search" type="text" id="searchBox" 
                            placeholder="Search products ...">
                            <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script>
        // function myFunction() {
        //     //search

        //         // Declare search string
        //     var filter = searchBox.value.toUpperCase();

        //     // Loop through first tbody's rows
        //     for (var rowI = 0; rowI < trs.length; rowI++) {

        //         // define the row's cells
        //         var tds = trs[rowI].getElementsByTagName("td");

        //         // hide the row
        //         trs[rowI].style.display = "none";

        //         // loop through row cells
        //         for (var cellI = 0; cellI < tds.length; cellI++) {

        //             // if there's a match
        //             if (tds[cellI].innerHTML.toUpperCase().indexOf(filter) > -1) {

        //                 // show the row
        //                 trs[rowI].style.display = "";

        //                 // skip to the next row
        //                 continue;

        //             }
        //         }
        //     }

        // }

        // // declare elements
        // const searchBox = document.getElementById('searchBox');
        // const table = document.getElementById("table");
        // const trs = table.tBodies[0].getElementsByTagName("tr");

        // add event listener to search box
        //searchBox.addEventListener('keyup', myFunction);
    </script>

    <div class="container">
        @yield('content')
    </div>
    @yield('scripts')


</body>
</html>