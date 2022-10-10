@extends('layouts.customer-layout')

@section('content')
    <div class="container">
        <div class="w-bg p-50 mt-50">
            <h1><i class="fas fa-plus"></i> Customer</h1>

            <form action="{{ route('customer.update',['customer' => $customer->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="label">Customer name</div>
                    <input type="text" name="customerName" value="{{ $customer->name }}">
                </div>
                <div class="form-group">
                    <div class="label">Phone Number</div>
                    <input type="text" name="customerPhoneNumber" value="{{ $customer->phoneNumber }}">
                </div>
                <div class="form-group">
                    <button class="save-btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection