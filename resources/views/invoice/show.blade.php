@extends('layouts.invoice-layout')

@section('content')
    <div class="container">
        <div class="w-bg mt-50 p-50">
            <div class="invoiceNumber">
                <strong>Invoice number</strong>
                #{{ $invoice->id }}
            </div>
            <div style="margin: 15px 0">
                <strong>Date: {{ substr($invoice->created_at,0,10) }}</strong>
            </div>
            <div class="customerNumber">
                <strong>Customer name</strong>
                {{ $invoice->customer->name }}
            </div>

            <div>
                <table class="table_main_style" style="width:100%">
                    <thead>
                        <th>#</th>
                        <th>product id</th>
                        <th>product price</th>
                        <th>quantity</th>
                        <th>total</th>
                    </thead>
                    <tbody>
                        @foreach ($invoice->invoiceRows as $singleInvoice)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $singleInvoice->product->productName  }}</td>
                                <td>{{ $singleInvoice->product_price }}</td>
                                <td>{{ $singleInvoice->product_quantity }}</td>
                                <td>{{ $singleInvoice->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="txt-right">
                <strong>total:</strong>
                {{ $invoice->total }}
                $
            </div>
        </div>

        <form target="_blank" action="{{ route('invoice.pdf') }}" method="post">
            @csrf
            <input hidden type="text" name="invoiceHTML" id="invoiceHTML" value="">
            <input type="text" name="customerName" value="{{ $invoice->customer_name }}" hidden>
            <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
            <button class="print" type="submit"><i class="fas fa-print"></i> print</button>
        </form>


    </div>

    <script>
        $('#invoiceHTML').val($('.w-bg').html());

    </script>

@endsection