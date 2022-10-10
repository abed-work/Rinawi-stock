@extends('layouts.customer-layout')

@section('content')
    <div class="container">
        <div class="w-bg p-50 mt-50">
            <div class="cutomerName">Name: <strong>{{ $customer->name }}</strong> </div>
            <div class="phoneNumber">Phone Number <strong>{{ $customer->phoneNumber }}</strong></div>
            <h2 style="margin: 20px 0 10px">{{ $customer->name }}'s Invoices</h2>
            <table class="table_main_style" style="width:100%">
                <thead>
                    <th>#</th>
                    <th>Invoice Id</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Operation</th>
                </thead>
                <tbody>
                    @foreach ($customer->invoices as $invoice)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->customer->name }}</td>
                            <td>$ {{ $invoice->total }}</td>
                            <td>{{ substr($invoice->created_at,0,10) }}</td>
                            <td class="flex">
                                <a href="{{ route('invoice.show',['id' => $invoice->id]) }}"><i class="fas fa-eye"></i></a>
                                <a style="margin: 0 20px" href="{{ route('invoice.edit',['id' => $invoice->id]) }}"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('invoice.destroy',['id'=>$invoice->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="deleteBtn" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection