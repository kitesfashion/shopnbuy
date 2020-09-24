@extends('admin.layouts.master')

@section('custom_css')
    <style type="text/css">
        .table td{
            height: 75px;
            line-height: 75px;
        }
    </style>
@endsection

@section('content')
    @php
      use App\ProductImage;      
      use App\Category;        
    @endphp

    <div class="table-responsive">
        <table id="productTable" class="table table-bordered table-striped"  name="productTable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th width="130px">Product Code</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th width="20px">Status</th>
                    <th width="20px">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @foreach($products as $product)                        
                    <tr>
                        @php
                            $sl = 0;
                        @endphp
                        @php
                            $sl++;
                            if($product->discount){
                                $discount = $product->discount;
                            }else{
                                $discount = '0.00';
                            }
                        @endphp
                        <td>{{ $sl }}</td>
                        <td>{{ @$product->deal_code }}</td>
                        <td>{{ @$product->name }}</td>
                        <td>{{ @$product->catName }}</td>
                        <td>
                            @php
                                if(file_exists($product->images)){
                                    $image = asset('/').@$product->images;
                                }else{
                                    $image = $noImage;
                                }
                            @endphp
                            <img src="{{ @$image }}" style="width: 75px; height: 75px; margin: 0px;">
                        </td>
                        <td>{{ @$product->price }}</td>
                        <td>{{ @$discount}}</td>                                        
                        <td><?php echo \App\Link::status($product->id,$product->status)?></td>
                        <td class="text-nowrap"><?php echo \App\Link::action($product->id)?></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            var updateThis ;

            var table = $('#productTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
            //ajax
            
            
            //ajax delete code
            $('#productTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                product_id = $(this).parent().data('id');
                var product = this;
                /*$.ajax({
                    type : 'POST',
                    url : "{{ route('single-product-destroy') }}",
                    data : {product_id:product_id},
                    success:function(res){
                        alert("success");
                    }
                }); */

                swal({   
                    title: "Are you sure?",   
                    text: "You will not be able to recover this imaginary file!",   
                    type: "warning",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Yes, delete it!",   
                    cancelButtonText: "No, cancel plx!",   
                    closeOnConfirm: false,   
                    closeOnCancel: false 
                }, function(isConfirm){   
                    if (isConfirm) {     
                        $.ajax({
                            type: "POST",
                           url : "{{ route('single-product-destroy') }}",
                            data : {product_id:product_id},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Product deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(product).parents('tr'))
                                    .remove()
                                    .draw();
                            },
                            error: function(response) {
                                error = "Failed.";
                                swal({
                                    title: "<small class='text-danger'>Error!</small>", 
                                    type: "error",
                                    text: error,
                                    timer: 1000,
                                    html: true,
                                });
                            }
                        });   
                    } else { 
                        swal({
                            title: "Cancelled", 
                            type: "error",
                            text: "Your product is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(product_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('products.changeStatus', 0) }}",
                    data: "product_id=" + product_id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Status successfully updated!",
                            timer: 1000,
                            html: true,
                        });
                    },
                    error: function(response) {
                         swal({
                            title: "<small class='text-success'>Success!</small>", 
                            type: "success",
                            text: "Status successfully updated!",
                            timer: 1000,
                            html: true,
                        });
                       /* error = "Failed.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 2000,
                            html: true,
                        });*/
                    }
                });
            }
    </script>
@endsection