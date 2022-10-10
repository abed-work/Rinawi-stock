@extends('layouts.invoice-layout')

@section('content')
    <div class="container">
        <div class="invoice">
            <h1><i class="far fa-file-invoice-dollar"></i> Make an Invoice</h1>
            <form action="{{ route('invoice.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <div class="label"><strong>Customer Name</strong></div>
                    <select id="select-state" placeholder="Pick a customer..." name="customerId">
                        <option value="">Select a state...</option>
                        @foreach ($customers as $customer)
                            <option value="{{$customer->id}}">{{ $customer->name }}</option>
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
                    <div class="row">
                        <div class="form-group">
                            <div class="label"><strong></strong></div>
                            <input type="text" name="productName[]" id="productName" class="productName" onkeyup="onKeyUp(this)">
                            <input type="text" name="product_id[]" id="productId" class="product_id" value="" hidden>
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
                    </div>
                </div>
                <div class="addRow"><i class="fas fa-plus-square"></i></div>
                <div class="total">
                    Total
                    <br/>
                    <input name="total" type="text" class="totalValue" value="00.00" readonly>
                </div>
                <div class="form-group">
                    <button class="save-btn" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <script>

        $('#invoiceHTML').val($('.invoice').html());

        console.log($('.invoice').html())

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
    <script>
        $(document).ready(function () {
            $('select').selectize({
                sortField: 'text'
            });
        });
    </script>
@endsection