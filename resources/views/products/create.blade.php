@extends('products.layout')

@section('content')


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

    <h1 class="announcement-bar__message">
        Here, you can add products.
    </h1>



    <!-- Trigger/Open The Modal -->
    <a id="myBtn" class="btn"><i class="fa fa-plus"></i>Add product</a>
    <!-- The Modal -->

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="{{route('products.store')}}" method="post">


                @csrf
                <div class="row">
                    <div class="col-75">
                        <div class="container">


                            <div class="row">
                                <div class="col-50">
                                    <label for="productName"> Product name</label>
                                    <input type="text" id="pn" name="pn" placeholder="product name">
                                    <label for="modelNumber">Model Number :</label>
                                    <input type="text" id="mn" name="mn" placeholder="module#">
                                    <label for="brand"></i> Brand name:</label>
                                    <input type="text" id="brand" name="brand" placeholder="brand name">
                                    <label for="category"> Category name:</label>
                                    <input type="text" id="category" name="cat" placeholder="category">


                                </div>

                                <div class="col-50">

                                    <label>Enter the Price of the Product</label>


                                    <input name ="cost"  type="text" id="cost" class="Cprice"  placeholder="Cost Price"/>
                                    <input  name ="whole"  type="text"  id="whole" class="Wprice"  placeholder="whole Price"/>
                                    <input  name ="online"  type="text"  id="online" class="Oprice"  placeholder="online Price" />
                                    <input  name ="retail"  type="text" id="retail" class="Rprice"  placeholder="retail Price" />


                                    <label>Write the description</label>
                                    <input type="text" id="description" name ="description" class="description"> </input>

                                    <label>Add an image </label>


                                    <input name ="product_images" type="file"  class="image" multiple/>



                                </div>

                            </div>


                        </div>
                    </div>

                </div> <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>

        </div>
       </div>


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

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection

