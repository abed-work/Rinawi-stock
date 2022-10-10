@extends('products.layout')

@section('content')

    <style>
        .white-bg{
            background-color: #fff;
            padding: 50px;
            margin: 50px 0;
            text-align: left
        }
        button{
            background-color: #3cb70d;
            color: #fff;
            padding: 10px 25px;
            text-align: center;
            min-width: 150px;
        }
    </style>


    <div class="white-bg">
        <form action="{{ route('category.update',['category' => $category->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="label">Category name</div>
                <input type="text" name="categoryName" value="{{ $category->categoryName }}">
            </div>
            <div class="form-group">
                <div class="label">Category model number</div>
                <input type="text" name="modelNumber" value="{{ $category->modelNumber }}">
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
@endsection
