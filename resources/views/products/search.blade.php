@extends('products.layout')
@section('title','Inventory')
@section('content')

        <table class="table table-main-style" style="margin: 50px 0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Model Number</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Retail</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id}}</td>
                        <td>{{ $product->productName }}</td>
                        <td>{{ $product->modelNumber }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->brand}}</td>
                        <td>{{ $product->retail }}</td>
                        <td>
                            <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                                <a href="{{route('products.show',$product->id)}}" title="show product"><i class="fa fa-eye" style="color:black; font-size: x-large"></i></a>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table> 

@endsection
