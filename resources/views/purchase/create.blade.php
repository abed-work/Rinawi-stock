@extends('layouts.purchase-layout')


@section('styles')
    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #111010;
            width: 80%;
        }

        .modal-content input{
            margin: 15px 0;
        }

        /* The Close Button */
        .close {
            color: #111010;
            float: right;
            font-size: 30px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;

        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="invoice">
            <h1><i class="far fa-file-invoice-dollar"></i> Make a Purchase</h1>
            <form action="{{ route('purchase.store') }}" method="post" enctype="multipart/form-data">
                @csrf   
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
                            <input type="text" name="productName[]" id="productName" class="productName" onkeyup="onKeyUp(this)" autocomplete="off">
                            <input type="text" name="product_id[]" id="productId" class="product_id" value="" hidden>
                            <div id="productsList" class="dropDown productsList"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="productQuantity[]" value ="1" id="productQuantity" onkeyup="updatePriceOrQuantity(this)">
                        </div>
                        <div class="form-group">
                            <input type="text" name="productPrice[]" id="productPrice" onkeyup="updatePriceOrQuantity(this)">
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
                    <button class="save-btn" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>    

    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="addPurchaseForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-75">
                        <div class="container">
                            <div class="row">
                                <div class="col-50">
                                    <label for="productName"> Product name</label>
                                    <input type="text" id="pn" name="productName" placeholder="product name">
                                    <label for="modelNumber">Model Number :</label>
                                    <input type="text" id="mn" name="modelNumber" placeholder="module#">
                                    <label for="brand"></i> Brand name:</label>
                                    <input type="text" id="brand" name="brand" placeholder="brand name">
                                    <label for="category"> Category name:</label>
                                    <input type="text" id="category" name="category" placeholder="category">
                                </div>

                                <div class="col-50">
                                    <label>Enter the Price of the Product</label>
                                    <input name  ="cost"  type="text" id="cost" class="Cprice"  placeholder="Cost Price"/>
                                    <input  name ="whole"  type="text"  id="whole" class="Wprice"  placeholder="whole Price"/>
                                    <input  name ="online"  type="text"  id="online" class="Oprice"  placeholder="online Price" />
                                    <input  name ="retail"  type="text" id="retail" class="Rprice"  placeholder="retail Price" />
                                    <label>Write the description</label>
                                    <input type="text" id="description" name="description" class="description">

                                    <label>Add an image </label>

                                    <input name="product_images[]" type="file"  class="image" multiple/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                <div class="loader"></div>
                <div class="successMessage">
                    <p>The product has been added successfully!</p>
                </div>
            </form>

        </div>
       </div>

       <script>

        $.ajaxSetup({
            beforeSend: function(xhr, type) {
                if (!type.crossDomain) {
                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
                }
            },
        });
    
        $(".btn-primary").click(function(e){

            // show the loader

            $('.loader').css('display','block');

            e.preventDefault();
            var images = $("input[name=product_images]").val();
            var url = '{{ route('products.store') }}';
            $.ajax({
               url:url,
               method:'POST',
                data: new FormData(document.getElementById("addPurchaseForm")),
                contentType: false,
                cache: false,
                processData: false,
               success:function(response){
                    $('.loader').css('display','none');
                    $('.successMessage').css('display','block');
               },
               error:function(error){
                  console.log('errrorr ',error)
               }
            });
        });
    
    </script>
    

    <script>

        function showProductTemp(){

            // Get the modal
            var modal = document.getElementById("myModal");


            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            modal.style.display = "block";
            

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
                $('.successMessage').css('display','none');
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }
    </script>
    
    
    <script>
        $('#invoiceHTML').val($('.invoice').html());

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
                    <td colspan="4"><a onclick=showProductTemp()>Add new product</a></td>
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
                            <input type="text" name="productName[]" id="productName" class="productName" onkeyup="onKeyUp(this)" autocomplete="off">
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