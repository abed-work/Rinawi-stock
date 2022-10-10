@extends('layouts.invoice-layout')

@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            <i class="far fa-check-circle"></i> {{ session()->get('message') }}
        </div>
    @endif

    <div class="container">
        <div class="invoice">
            <h1><i class="far fa-file-invoice-dollar"></i> Edit the Invoice/ #{{ $invoice->id }}</h1>
            <form action="{{ route('invoice.update',['id' => $invoice->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group date">
                    <strong>Date: {{ substr($invoice->created_at,0,10) }}</strong>
                </div>

                <div class="form-group">
                    <div class="label"><strong>Customer Name</strong></div>
                    <select id="select-state" placeholder="Pick a customer..." name="customerId">
                        @foreach ($customers as $customer)
                            @if ($customer->id == $invoice->customer_id)
                                <option value="{{$customer->id}}" selected>{{ $customer->name }}</option>
                            @else
                                <option value="{{$customer->id}}">{{ $customer->name }}</option>
                            @endif    
                        @endforeach
                      </select>
                </div>

                <div class="rows">
                    <div class="row">
                        <div class="form-group">
                            <div class="label">
                            <strong>Product Name</strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <strong>Price</strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <strong>Quantity</strong>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="label">
                                <strong>Total</strong>
                            </div>
                        </div>
                    </div>

                    @foreach ($invoice->invoiceRows as $invoiceRow)
                        <div class="row">
                            <div class="form-group">
                                <div class="label"><strong></strong></div>
                                <input type="text" name="productName[]" id="productName" class="productName" onkeyup="onKeyUp(this)" value="{{ $invoiceRow->product->productName }}">
                                <input type="text" name="product_id[]" id="productId" class="product_id" value="{{ $invoiceRow->product_id }}" hidden>
                                <div id="productsList" class="dropDown productsList"></div>
                            </div>
                            <div class="form-group">
                                <input type="text" name="productPrice[]" id="productPrice" onkeyup="updatePriceOrQuantity(this)" value="{{ $invoiceRow->product_price }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="productQuantity[]" id="productQuantity" onkeyup="updatePriceOrQuantity(this)" value="{{ $invoiceRow->product_quantity ? $invoiceRow->product_quantity : 1 }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="productTotalPrice[]" id="productTotalPrice" value="{{ $invoiceRow->total }}" readonly>
                            </div>
                            <div onclick="removeRow(this)" class="removeRow"><i class="fas fa-minus-circle"></i></div>
                        </div>
                    @endforeach

                </div>
                <div class="addRow"><i class="fas fa-plus-square"></i></div>
                <div class="total">
                    Total
                    <br/>
                    $ <input name="total" type="text" class="totalValue" value="{{ $invoice->total }}" readonly >
                </div>
                <div class="form-group">
                    <button class="save-btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>

@endsection