@extends('layouts.sales-layout')

@section('title','Sales')
    
@section('body')
    <div class="container">
        <h1>Sales</h1>
        <div class="sales-info">
            <div class="actions-nav">
                <ul>
                    <li><a class="sell" href="">Sell a product</a></li>
                    <li><a class="stock-amount" href="">Stock amount check</a></li>
                    <li><a class="price-check" href="">Price check</a></li>
                </ul>
            </div>
            <table class="sales-table">
                <thead>
                    <th>#</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Price</th>
                    <th>Operation</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1231</td>
                        <td>Dummy</td>
                        <td>2</td>
                        <td>100.000L.L</td>
                        <td class="operation">
                            <a href=""><i class="far fa-save"></i></a>
                            <a href=""><i class="fas fa-print"></i></a>
                            <a href=""><i class="fas fa-minus-circle"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="add_product" class="pop_up">
            <form action="" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Product Name*</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label for="">Quantity*</label>
                    <input type="number" name="" id="" value="1">
                </div>
                <div class="form-group">
                    <label for="">Price*</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input type="text">
                </div>
                <div class="form-group">
                    <button class="addBtn">Add</button>
                    <button class="cancelBtn">Cancel</button>
                </div>
            </form>
        </div>
        <div class="overlay"></div>
    </div>
@endsection