@extends('admin.layouts.master')

@section('content')
@php
    use App\DeliveryZone;
    use App\Area;
@endphp
    <div class="table-responsive">
        <table id="categoriesTable" class="table table-bordered table-striped"  name="categoriesTable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th>Delivery Zone</th>
                    <th>Delivery Area</th>
                    <th>Shipping Charge</th>
                    <th width="20px">Status</th>
                    <th width="20px">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php $i= 1; ?>
                @foreach($shippingCharges as $charge) 
                @php
                    $deliveryZone = DeliveryZone::where('id',$charge->delivery_zone_id)->first();
                    $deliveryArea = Area::where('id',$charge->delivery_area_id)->first();
                 @endphp                         
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $deliveryZone->name }}</td>
                    <td>{{ $deliveryArea->name }}</td>
                    <td>{{ $charge->shippingCharge }}</td>
                    <td>
                        <?php echo \App\Link::status($charge->id,$charge->shippingStatus)?>
                    </td>
                    <td class="text-nowrap">
                       <?php echo \App\Link::action($charge->id)?>
                    </td>
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

            var table = $('#categoriesTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax

            
            
            //ajax delete code
            $('#categoriesTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                charge_id = $(this).parent().data('id');
                var shippingCharges = this;
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
                            
                            url: "{{ route('shippingCharges.deletes') }}",
                            data: {
                                charge_id:charge_id
                            },
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Shipping Charge Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(shippingCharges).parents('tr'))
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
                            text: "Shipping charge is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(charge_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('shippingCharge.shippingChargeStatus', 0) }}",
                    data: "charge_id=" + charge_id,
                    
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
                        error = "Failed.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 2000,
                            html: true,
                        });
                    }
                });
            }
    </script>
@endsection