@extends('layouts.purchase-layout')

@section('styles')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css" />

@endsection


@section('content')
    
    @if(session()->has('message'))
        <div class="alert alert-success">
            <i class="far fa-check-circle"></i> {{ session()->get('message') }}
        </div>
    @endif

    <div class="container mt-50">
        <div class="addInvoice">
            <a class="add_action_style" href="{{ route('invoice.create') }}"><i class="fas fa-plus"></i> Add Purchase</a>
        </div>
        <div class="w-bg p-50">
            <h1 style="margin: 10px 0">Purchase</h1>
            <table border="0" cellspacing="5" cellpadding="5">
                <tbody><tr>
                    <td>Minimum date:</td>
                    <td><input type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Maximum date:</td>
                    <td><input type="text" id="max" name="max"></td>
                </tr>
            </tbody></table>
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Purchase Id</th>
                        <th>Product Name</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ $purchase->product }}</td>
                            <td>$ {{ $purchase->total }}</td>
                            <td>{{ substr($purchase->created_at,0,10) }}</td>
                            <td class="flex">
                                <a href=""><i class="fas fa-eye"></i></a>
                                <a style="margin: 0 20px" href=""><i class="fas fa-edit"></i></a>
                                <form action="" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="deleteBtn" type="submit"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Invoice Id</th>
                        <th>Customer Name</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <script>
        var minDate, maxDate;
 
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date( data[4] );
        
                if (
                    ( min === null && max === null ) ||
                    ( min === null && date <= max ) ||
                    ( min <= date   && max === null ) ||
                    ( min <= date   && date <= max )
                ) {
                    return true;
                }
                return false;
            }
        );
        
        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });
        
            // DataTables initialisation
            var table = $('#example').DataTable();
        
            // Refilter the table
            $('#min, #max').on('change', function () {
                table.draw();
            });
        });
    </script>


    <script>

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
    });

    /*$('.productName').on('keyup', function(){
        $(this).next().show();
        search($(this));
    });*/

    function onKeyUp(element){
        $(element).next().show();
        search($(element));
    }

    function search(element){
        var keyword = $(element).val();
        if (!keyword){
            $(element).next().hide();
        }
        
        $.post('{{ route("products.search") }}',
        {
            // _token: $('meta[name="csrf-token"]').attr('content'),
            keyword:keyword
        },
        function(data){
            table_post_row(data,element);
            // console.log(data['products'][0].productName);
        });
    }

    function table_post_row(res,element){
        let htmlView = '';
        if(res.products.length <= 0){
            htmlView+= `
            <div>
                <td colspan="4">No data.</td>
            </div>`;
        }
        for(let i = 0; i < res.products.length; i++){
            htmlView += `
                <div onclick=clickOnProduct(this) class='product-result' data-id=${res.products[i].id} data-price=${res.products[i].retail}>`+res.products[i].productName+`</div>
                `;
        }
        //console.log(element);
        //$('.productsList').html(htmlView);
        $(element).parent().find('.productsList').html(htmlView);
    }


    function clickOnProduct(element){

        //console.log($(element).attr('data-id'), $(element).text(),$(element).attr('data-price'));

        //console.log('-------------------------------------------------------------------------');

        productIdInput          = $(element).parents('.row').find('#productId');


        productNameInput        = $(element).parents('.row').find('#productName');
        productPriceInput       = $(element).parents('.row').find('#productPrice');
        productQuantityInput    = $(element).parents('.row').find('#productQuantity');
        productTotalInput       = $(element).parents('.row').find('#productTotalPrice');

        productIdInput.val($(element).attr('data-id'));

        productNameInput.val($(element).text());
        productPriceInput.val($(element).attr('data-price'));

        productTotalInput.val(1 * $(element).attr('data-price') );

        $(element).parent().hide();

        calculateTotal();
    }


    $('.addRow').click(function(){
        row = `  <div class="row">
                    <div class="form-group">
                        <input type="text" name="productName[]" id="productName" class="productName" onkeyup="onKeyUp(this)">
                        <input type="text" name="product_id[]" id="productId" class="product_id" hidden>
                        <div id="productsList" class="dropDown productsList"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="productPrice[]" id="productPrice" onkeyup="updatePriceOrQuantity(this)">
                    </div>
                    <div class="form-group">
                        <input type="text" name="productQuantity[]" value ="1" id="productQuantity" onkeyup="updatePriceOrQuantity(this)">
                    </div>
                    <div class="form-group">
                        <input type="text" name="productTotalPrice[]" id="productTotalPrice" readonly>
                    </div>
                    <div onclick="removeRow(this)" class="removeRow"><i class="fas fa-minus-circle"></i></div>
                </div>`;
        $('.rows').append(row);
    })


    function updatePriceOrQuantity(element){

        // newPrice        =  $(element).val();
        newPrice                = $(element).parents('.row').find('#productPrice').val();
        productQuantityInput    = $(element).parents('.row').find('#productQuantity').val();
        productTotalInput       = $(element).parents('.row').find('#productTotalPrice');

        if (newPrice && productQuantityInput){
            productTotalInput.val( parseFloat(newPrice * productQuantityInput, 10).toFixed(2) );
        }

        calculateTotal();
    }


    function calculateTotal(){
        
        total = 0;

        $('input[name="productTotalPrice[]"]').each(function(){
            total+=parseFloat($(this).val(),10);
        })


        $('.totalValue').val(parseFloat(total).toFixed(2));
    }

    function removeRow(element){
        $(element).parents('.row').remove();
        calculateTotal();
    } 

    </script>

@endsection