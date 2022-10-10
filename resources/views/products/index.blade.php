@extends('products.layout')
@section('title','Inventory')
@section('content')

        <div class="addProduct">
            
            <a id="myBtn" style="margin-right: 20px;" type="submit" class="btnadd"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a>
        </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
        <table class="table table-main-style" id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Model Number</th>
                    <th>Category</th>
                    <th>Brand</th>
                    @if (Auth::user()->userRole)
                        <th>Retail</th>
                    @endif
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
                        @if (Auth::user()->userRole)
                            <td>{{ $product->retail }}</td>
                        @endif
                        <td>
                            <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                                <a href="{{route('products.show',$product->id)}}" title="show product"><i class="fa fa-eye" style="color:black; font-size: x-large"></i></a>

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table> 

    <div class="product-pagination">
        {!! $products->links() !!}
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <!-- Trigger/Open The Modal -->
    <!-- The Modal -->
    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" align="right">&times;</span>
                @csrf
                <div class="row">
                    <div class="col-75">
                        <div class="container">
                            <div class="row">
                                <div class="col-50">
                                    <label for="productName"> Product name</label>
                                    <input type="text" id="pn" name="productName" placeholder="product name" required="required">
                                    <label for="modelNumber">Model Number :</label>
                                    <input type="text" id="mn" name="modelNumber" placeholder="module#" required="required">

                                    <label for="brand"> Brand name:</label>
                                    <select name="brand">
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->brandName}}">{{$brand->brandName}}</option>
                                    @endforeach </select>
                                    <label for="category"> Category name:</label>
                                    <select name="category">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->categoryName}}">{{$category->categoryName}}</option>
                                        @endforeach </select>

                                    <label>Write the description</label>
                                    <input type="text" id="description" name ="description" class="description" required="required"> </input>
                                </div>
                                <div class="col-50" {{(Auth::user()->userRole ? '':'hidden')}}>

                                    <label>Enter the Price of the Product</label>

                                    <strong> Cost  :</strong>
                                    <input name ="cost"  type="text" id="cost" class="Cprice"  placeholder="Cost Price" value="0"/><br>
                                    <strong> Whole :</strong>
                                    <input name ="whole"  type="text"  id="whole" class="Wprice"  placeholder="whole Price" value="0"/><br>
                                    <strong> Online :</strong>
                                    <input name ="online"  type="text"  id="online" class="Oprice"  placeholder="online Price" value="0"  /><br>
                                    <strong> Retail  :</strong>
                                    <input name ="retail"  type="text" id="retail" class="Rprice"  placeholder="retail Price" value="0" />
                            </div>

                            <label>Add an image </label>
                            <input name ="product_images[]" type="file"  class="image" multiple required="required" />
                            
                        </div>
                    </div>
                </div>
            <div class="button">
                <input type="submit" class="btn-1"   value="Add product" /><br>
            </div>

        </div>
    </div>
    </div>
</form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <script>

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        // $(document).ready(function(){
        //     $("#searchBox").on("keyup", function() {
        //         var value = $(this).val().toLowerCase();
        //         $("#table tbody tr").filter(function() {
        //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        //         });
        //     });
        // });
    </script>

@endsection
