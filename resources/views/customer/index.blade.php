@extends('layouts.customer-layout')

@section('content')
        <div class="container">
            <a href="{{ route('customer.create') }}" class="add_action_style mt-50"><i class="fas fa-plus"></i> Customer</a>
            <div class="w-bg p-50">
                <h1 style="padding-bottom: 20px"><i class="fas fa-users"></i> Customers</h1>
                <table class="table_main_style">
                    <thead>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Operation</th>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phoneNumber }}</td>
                                <td class="flex">
                                    <a href="{{ route('customer.show',['customer'=>$customer->id]) }}"><i class="fas fa-eye"></i></a>
                                    <a style="margin: 0 25px" href="{{ route('customer.edit',['customer'=>$customer->id]) }}"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('customer.destroy',['customer' => $customer->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection