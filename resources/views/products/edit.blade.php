@extends('products.layout')

@section('content')

<style>
    .images{
        text-align: left;
        margin: 25px 0;
    }                                                                                                       
    .product-image{
        display: inline-block;
        position: relative;                                                                                                        
    }
    .images img{
        width: 250px;
        height: 250px;
        object-fit: cover
    }
    .remove{
        position: absolute;
        top: 0;
        right: 10px;
        color: #f00;
        font-size: 45px;
        cursor: pointer;
    }
    .hidden{
        visibility: hidden;
    }
    .white-bg{
        background-color: #fff;
        margin: 50px 0;
        text-align: left;
        padding: 30px;
    }
    .white-bg input{
        text-align: left;
        width: 100%  !important;
        background-color: transparent !important;
    }
    strong{
        color: #000;
    }
    textarea{
        height: 300px;
    }
    button[type='submit']{
        min-width: 150px
    }
</style>


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

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-75">
                <div class="container">
                    <div class="row white-bg">
                        <div class="col-50">
                    <strong>Product Name:</strong>
                    <input type="text" name="productName" value="{{ $product->productName }}" class="form-control" placeholder="product Name">


                    <strong>Model Number:</strong>
                    <input type="text" name="modelNumber" value="{{ $product->modelNumber }}" class="form-control" placeholder="model">


                    <strong>Category:</strong>
                    <input type="text" name="category" value="{{ $product->category }}" class="form-control" placeholder="category">


                    <strong>Brand:</strong>
                    <input type="text" name="brand" value="{{ $product->brand }}" class="form-control" placeholder="brand">

                    <strong>Desciption:</strong>
                    <textarea class="form-control" name="description" placeholder="Detail" >{{ $product->description }} </textarea>
                    <button type="submit" class="btn btn-primary">Submit</button>

                    </div>

                        <div class="col-50">
                        
                            @if (Auth::user()->userRole)

                                @if (Auth::user()->userRole == 1)
                                    <strong>Cost:</strong>
                                    <input type="text" name="cost" value="{{ $product->cost }}" class="form-control" placeholder="cost">
                
                
                                    <strong>Whole:</strong>
                                    <input type="text" name="whole" value="{{ $product->whole }}" class="form-control" placeholder="whole">
                                @endif
            
                                <strong>Online:</strong>
                                <input type="text" name="online" value="{{ $product->online }}" class="form-control" placeholder="online"> 
            
                                <strong>Retail:</strong>
                                <input type="text" name="retail" value="{{ $product->retail }}" class="form-control" placeholder="retail">

                                <strong>Quantity</strong>
                                <input type="text" name="quantity" value="{{ $product->quantity }}">
                                
                            @endif

                            <br>


            <div class="images">

                @foreach ($product->images as $image)
                    <div class="product-image" data-image-id="{{ $image->id }}">
                        <span class="remove">&times;</span>
                        <img src="{{ asset('storage/assets/images/products/'.$image->src) }}" alt="">
                    </div>
                @endforeach
                    
                <div class="hidden">

                </div>
            
            </div>
            
            
            <strong>Image:</strong>
            <input type="file" class="image" style="background-color: lightgray; width: 25%" name="product_images[]">{{ $product->image }}</input>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <script>
        let removeBtns = document.querySelectorAll('.product-image .remove');
        let hiddenDiv = document.querySelector('.hidden');

        removeBtns.forEach((removeBtn)=>{
            removeBtn.addEventListener('click',()=>{
                let removedImageId = removeBtn.parentElement.getAttribute('data-image-id');
                let elemet = document.createElement('div');
                let childElement =`<input name='removed_images[]' value='${removedImageId}' />`;
                elemet.innerHTML = childElement;
                hiddenDiv.appendChild(elemet);
                removeBtn.parentElement.remove();
            })
        })
    </script>

@endsection
