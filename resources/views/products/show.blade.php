@extends('products.layout')
@section('title','')
@section('content')
<style>
    * {box-sizing: border-box;}
    body {
        font-family: 'Nunito', sans-serif;
        background-color: lightgrey;
    }
    .container{
        max-width: 1500px;
        width: 95%;
        margin: auto;
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

    /*popup prices */
    .popup {
        position: relative;
        display: inline-block;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;

    }

    /* The actual popup */
    .popup .popuptext {
        visibility: hidden;
        width: 160px;
        background-color: #555;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 50%;
        margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
        visibility: visible;
        -webkit-animation: fadeIn 1s;
        animation: fadeIn 1s;
    }

    table{
        border: 1px solid #eee;
        width: 100%;
        margin-bottom: 15px;
    }

    tr,td,th{
        border: 1px solid #eee;
        padding: 5px;
    }
    .active-image{
        border: 3px solid #000;
        cursor: pointer;
    }
    
    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }
    .flex{
        display: flex;
        gap: 80px;
        justify-content: space-between;
    }
    .card{
        padding: 35px;
    }
    .thumbnail-images{
        display: flex;
        margin: 15px 0;
        gap:20px;
    }
    .thumbnail-images img{
        width: 100px;
        height: 100px;

    }
    .flex i{
        font-size: 25px;
    }
</style>

<body class="antialiased">


    <div class="container">
        <div class="flex" >
            <div>
                <div class="images" style="margin-top: 50px">
                    <div class="product-main-image">
                        @if ($product->images[0]->src)
                            <img src="{{asset('storage/assets/images/products/'.$product->images[0]->src)}}">
                        @endif
                    </div>
                    <div class="thumbnail-images">
                        @foreach ($product->images as $image)
                            <img class="thumbnail" src="{{asset('storage/assets/images/products/'.$image->src)}}">
                        @endforeach
                    </div>
                </div>
            </div>
        
            <div style="flex-grow: 1">
                <div class="card" style=" background-color: #fff; margin-top: 50px" align="left">
                    <div class="flex">
                        <div>
                            <a href="{{ route('products.show',['product'=> $product->id - 1]) }}"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
                        </div>
                        <div>
                            <a href="{{ route('products.show',['product'=> $product->id + 1]) }}"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    <h1><strong>{{ $product->productName }}</strong></h1>
                    <p style="color: #4a5568">Model Number : {{ $product->modelNumber }}, <strong>{{ $product->brand }} - {{ $product->category }}</strong> </p>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Cost</th>
                                    <th>Whole</th>
                                    <th>Online</th>
                                    <th>Retail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @if (Auth::user()->userRole == 1)
                                        <td>{{ $product->cost }}</td>
                                        <td>{{ $product->whole }}</td>
                                        <td>{{ $product->online }}</td>
                                        <td>{{ $product->retail }}</td>
                                    @elseif(Auth::user()->userRole == 2)
                                        <td>-</td>
                                        <td>-</td>
                                        <td>{{ $product->online }}</td>
                                        <td>{{ $product->retail }}</td>
                                    @else
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div><strong>Quantity</strong> {{ $product->quantity }}</div>
                    <div>
                        <strong>Description</strong>
                        {{ $product->description }}
                    </div>
                    <div class="mt-4" style="padding-left: 550px">
        
                        <form style="text-align: end" id="deleteBtn" action="{{ route('products.destroy',$product->id) }}" method="POST">
                            <a  href="{{route('products.edit',$product->id)}}" title="Edit product" > <i class="fa fa-edit" style="color: black; font-size: xx-large"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: lightgray;color: red ;border: 0ch" title="Delete"> <i class="fa fa-trash" style="font-size: xx-large" ></i> </button>
                            <a href="{{ URL::previous() }}" id="btnshow" title="Back"><i class="fa fa-arrow-left" aria-hidden="true" style="font-size: xx-large"></i></a>
                        </form>
            
                        <form style="visibility: hidden" id="hiddenForm" action="{{ route('products.destroy',$product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background-color: lightgray;color: red ;border: 0ch" title="Delete"> <i class="fa fa-trash" style="font-size: xx-large" ></i> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">

        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close" align="right">&times;</span>
                @csrf
                @method('PUT')
                <center> 
                    <div class="row">
                        <div class="col-75">
                            <div class="container12">


                                <div class="row">
                                    <div class="col-50">
                                        <strong>Product Name:</strong>
                                        <input type="text"  name="productName" value="{{ $product->productName }}"  placeholder="product Name">
                                        <br><br>

                                        <strong>Model Number:</strong>
                                        <input type="text"  name="modelNumber" value="{{ $product->modelNumber }}"  placeholder="model"> <br> <br>


                                        <strong>Category:</strong>
                                        <input type="text"  name="category" value="{{ $product->category }}"  placeholder="category"> <br> <br>


                                        <strong>Brand:</strong>
                                        <input type="text"  name="brand" value="{{ $product->brand }}" placeholder="brand"> <br> <br>

                                    </div>

                                    <div class="col-50">

                                        <strong>Cost:</strong>
                                        <input type="text"  name="cost" value="{{ $product->cost }}"  placeholder="cost"> <br> <br>

                                        <strong>Whole:</strong>
                                        <input type="text"  name="whole" value="{{ $product->whole }}"  placeholder="whole"> <br> <br>

                                        <strong>Online:</strong>
                                        <input type="text" name="online" value="{{ $product->online }}"  placeholder="online"> <br> <br>
                                        <strong>Retail:</strong>
                                        <input type="text" name="retail" value="{{ $product->retail }}"  placeholder="retail"> <br> <br>

                                        <strong>Desciption:</strong>
                                        <textarea style="height:50px" rows="2" name="description" placeholder="Detail">{{ $product->description }}</textarea> <br> <br>

                                        <strong>Image:</strong>
                                        <input type="file" class="image" style="height:150px" name="product_images[]">{{ $product->image }}</input>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="button" align="center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </center>
            </div>
        </div>
    </form>

    <script>
        let form = document.getElementById('deleteBtn');
        let hiddenForm = document.getElementById('hiddenForm');
        form.addEventListener('submit',(e)=>{
            e.preventDefault();
            let text = "Are you sure?";
            if (confirm(text) == true) {
                hiddenForm.submit();
            }
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        jQuery(document).ready(function($){
            $('.thumbnail-images img').first().addClass('active-image');
            $('.thumbnail-images img').click(function(){
                $('.thumbnail-images img').each(function(){
                    $(this).removeClass('active-image');
                });
                $(this).addClass('active-image');
                let getSrc = $(this).attr('src');
                $('.product-main-image img').attr('src',getSrc);
            });
        });
    </script>

@endsection
