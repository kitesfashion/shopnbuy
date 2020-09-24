@extends('admin.layouts.master')

@section('content')
<?php
    use App\Transaction;
?>

<div class="table-responsive">
    <table id="orderTable" class="table table-bordered table-striped"  name="orderTable">
        <thead>
            <tr>
                <th width="5%">S/L</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Amount</th>
                <th>Dellivery Address</th>
                <th>Zone</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @php
                $i = 1;
            @endphp
            @foreach($orderList as $order)
            @php
                $i++;
            @endphp
                <tr class="pendingRow_{{ $order->id }}">
                    <td width="5%">{{$i}}</td>
                    <td>{{ @$order->name }}</td>
                    <td>{{ @$order->phone }}</td>
                    <td>{{@$order->total_amount}}</td>
                    <td>{{@$order->shipping_address }}</td>
                    <td>{{@$order->delivery_zone_name }}</td>
                    <td class="text-center">
                        <?php echo \App\Link::action($order->id)?>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- sample modal content for show shipping-->
<div id="showShipping" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Show shipping detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container " id="shippingContent">
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            table = $('#orderTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );
            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax
            //ajax show code
          /*  $('#orderTable tbody').on( 'click', 'i.fa-eye', function () { 
                updateThis = this;
                order_id = $(this).parent().data('id');
                showFunction(order_id);
                             
            });*/

            //ajax delete code
            $('#orderTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                order_id = $(this).parent().data('id');
                var order = this;
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
                            url: "{{ route('order.delete') }}",
                           
                            data: {
                                order_id:order_id
                            },
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Order Information Deleted successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(order).parents('tr'))
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
                            text: "Your Order is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

            //ajax show status code
            $('#orderTable tbody').on( 'click', 'i.fa-shopping-bag', function () { 
                order_id = $(this).parent().data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ url('/admin/order/status') }}"+'/'+order_id,
                    /*data: "order_id=" + order_id + "&option=status" ,*/
                    data : {},
                    
                    success: function(response) {      
                        showStatus(response);
                    },
                    error: function(response) {
                        error = "Something wrong.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 1000,
                            html: true,
                        });
                    }
                });              
            });

            //seperate the all status view function
            function showStatus(response){
               <?php $checkoutStatus = ['Waiting', 'Processing', 'Shipping', 'Complete'] ?>

                if(response.order.status == 'Waiting') 
                    badge = '"badge badge-pill badge-info"';
                else if(response.order.status == 'Processing') 
                    badge = '"badge badge-pill badge-danger"';  
                else if(response.order.status == 'Shipping') 
                    badge = '"badge badge-pill badge-warning"'; 
                else if(response.order.status == 'Complete') 
                    badge = '"badge badge-pill badge-success"';
                else
                    badge = '"badge badge-pill badge-danger"';

                var content =   `<div class="form-group text-center">
                                    <h4><span class=`+badge+`
                                    style="float: center;"> `+response.order.status+`</span></h4>
                                </div>`+
                                `<div class="row col-sm-12">
                                Total order status
                                </div>
                                <form action="javascript:void(0)" method="POST" name="orderForm">
                                    <div class="form-group row">
                                    <input type="hidden" name="order_id" value="`+response.order.id+`">
                                        <div class="col-sm-6 ">
                                            <select class="form-control" name="status">
                                                <option value="">--- Select status ---</option>
                                                @foreach($checkoutStatus as $key=>$value)
                                                    <option value="{{ $value }}" >{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6"><button type="button" class="btn btn-info waves-effect" onclick="checkoutFunction(this)">Update status</button> 
                                        </div>
                                    </div>
                                </form>`
                                ;
                $('#shippingContent').html(content);
                $("#showShipping").modal();

                document.forms['orderForm'].elements['status'].value = response.order.status;
               
            }    
        });

       

        function checkoutFunction(){
            order_id = $("form[name='orderForm'] input[name='order_id']").val();
            status = $("form[name='orderForm'] select[name='status']").val();
            statusChange(order_id, status);
        }

        function statusChange(order_id, status) {
            $.ajax({
                type: "GET",
                url: "{{ url('/admin/order/status') }}"+'/'+order_id,
                data : {
                        status:status,
                    },
                success: function(response) {  
                    order = response.order
                    $('.modal').modal('hide');
                    if(status != 'Waiting'){
                        $(".pendingRow_"+order_id).remove();
                    }
                    swal({
                        title: "<small class='text-success'>Success!</small>", 
                        type: "success",
                        text: "Order Successfully Updated!",
                        timer: 2000,
                        html: true,
                    });
                    $("#mydiv").load(location.href + " #mydiv"); 
                },
                error: function(response) {
                    error = "Something wrong.";
                    swal({
                        title: "<small class='text-danger'>Error!</small>", 
                        type: "error",
                        text: error,
                        timer: 1000,
                        html: true,
                    });
                }
            });
        }    
    </script>
@endsection
