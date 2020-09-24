@extends('admin.layouts.master')
@section('content')
    <div class="table-responsive">
        <table id="menusTable" class="table table-bordered table-striped"  name="menusTable">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th>Name</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php
                    $i = 0;
                ?>
                @foreach($deliveryZoneList as $deliveryZone) 
                <?php
                    $i++;
                ?>                      
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $deliveryZone->name }}</td>
                    <td class="text-nowrap">
                    <?php echo \App\Link::action($deliveryZone->id)?>
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
            var table = $('#menusTable').DataTable( {
                "order": [[0, 'asc' ]],
                "pageLength": 50,
            } );

            //ajax            

            //ajax delete code
            $('#menusTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                deliveryZoneId = $(this).parent().data('id');
                var deliveryZone = this;
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
                           url : "{{ route('deliveryZone.destroy') }}",
                            data : {deliveryZoneId:deliveryZoneId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Delivery Zone Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(deliveryZone).parents('tr'))
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
                            text: "Your DeliveryZone is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(country_id) {
            $.ajax({
                    type: "GET",
                    url: "",
                    data: "country_id=" + country_id,
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