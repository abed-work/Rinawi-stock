@extends('products.layout')

@section('content')

    <div class="addProduct">
        <a id="myBtn"><i class="fa fa-plus"></i> add brand</a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
        <table class="table table-main-style">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Brand Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brand as $brand)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $brand->brandName }}</td>
        
                        <th>
                            <form action="{{ route('brand.destroy',$brand->id) }}" method="POST">
        
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: lightgray;color: red ;border: 0ch"><i class="fa fa-trash"></i></button>
                            </form>
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
    <form action="{{route('brand.store')}}" method="post">
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
                                    <label for="brandName"> Brand name</label>
                                    <input type="text" id="pn" name="brandName" placeholder="brand name" required="required">

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <div class="button">
                    <input type="submit" class="btn-1"   value="Add" /><br>
                </div>


            </div>
        </div>
    </form>


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
            modal.style.display = "none";   }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }



    </script>



@endsection
