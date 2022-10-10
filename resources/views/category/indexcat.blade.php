@extends('products.layout')

@section('content')

    <style>
        .flex{
            display: flex;
            justify-content: center;
        }
        .flex > *{
            margin: 0 15px;
        }
    </style>

    <div class="addProduct">
        <a id="myBtn" style="margin-right: 20px"><i class="fa fa-plus"></i> add category</a>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
        <table class="table table-main-style" style="margin-bottom: 50px">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Model Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->categoryName }}</td>
                        <td>{{ $category->modelNumber }}</td>
        
                        <th class="flex">
                            <a href="{{ route('category.edit',['category' => $category->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                            <form action="{{ route('category.destroy',$category->id) }}" method="POST">
        
        
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: lightgray;color: red ;border: 0ch"><i class="fa fa-trash"></i></button>
        
                            </form>
                        </th>
                    </tr>
                @endforeach
            </tbody>
         </table> 

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
    <form action="{{route('category.store')}}" method="post">
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content" >
                <span class="close" align="right">&times;</span>



                @csrf
                <div class="row">
                    <div class="col-75">
                        <div class="container">


                            <div class="row">
                                <div class="col-50">
                                    <label for="categoryName"> Category name</label>
                                    <input type="text" id="pn" name="categoryName" placeholder="category name" required="required">
                                    <label for="modelNumber">Model Number :</label>
                                    <input type="text" id="mn" name="modelNumber" placeholder="model#" required="required">

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="button">
                    <input type="submit" class="btn-1"  id="btnaddcat" value="Add" onclick="popupsuccess()" /><br>

                </div>


            </div>
        </div>
    </form>

    <script>
        function popupsuccess(){
            console.log("success");
        }
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn2 = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn2.onclick = function() {
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





@endsection
