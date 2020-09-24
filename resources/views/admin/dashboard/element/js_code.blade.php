@section('custom-js')
    <script>
        $(document).ready(function() {
            var updateThis ;

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


<?php
$dataPoints = array();
$i = 0;
foreach ($totalsales as $monthlySales) {
   array_push($dataPoints, array("y"=>$monthlySales->total, "label"=> $i));

}

   /* $dataPoints = array(
        array("y" => 25, "label" => "5"),
        array("y" => 15, "label" => "10"),
        array("y" => 25, "label" => "15"),
        array("y" => 5, "label" => "20"),
        array("y" => 10, "label" => "25"),
        array("y" => 0, "label" => "30"),
    );*/

    ?>

    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("monthly-chart", {
                title: {
                    text: ""
                },
                axisY: {
                    title: ""
                },
                data: [{
                    type: "line",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>


    <script type="text/javascript">
     $(document).ready(function(){ 
        $("#month").change(function(){ 
          var month = $(this).val(); 
          $.ajax({ 
            type: "GET",
            url: "<?php echo url('/admin/monthly-sales');?>"+"/"+ month, 
            data: {}, 
            success: function(response){ 
              $("#monthly-sales").html(response.monthlySales);
              $(".monthlyIncome").html(response.monthlyIncome + " BDT"); 
              $(".monthName").html(response.monthName);
          }
      });

      });
    });
</script>


<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


@endsection