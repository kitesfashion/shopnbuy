@extends('admin.layouts.master')

@section('content')

<?php
    use App\Category;

?>
    <div class="table-responsive">
        <table id="categoriesTable" class="table table-bordered table-striped"  name="categoriesTable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th>Group Name</th>
                    <th>Code</th>
                    <th width="20px">Status</th>
                    <th width="20px">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php $i= 1; ?>
                @foreach($customer_groups as $group)                            
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $group->groupName }}</td>
                    <td>{{ $group->groupCode }}</td>
                    <td>
                        <?php echo \App\Link::status($group->id,$group->groupStatus)?>
                    </td>
                    <td class="text-nowrap">
                       <?php echo \App\Link::action($group->id)?>
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

            
            //ajax delete code
            $('#categoriesTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                group_id = $(this).parent().data('id');
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
                            
                            url: "{{ route('customerGroup.deletes') }}",
                            data: {
                                group_id:group_id
                            },
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Customer Group Deleted Successfully!",
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
        function statusChange(group_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('customerGroup.status', 0) }}",
                    data: "group_id=" + group_id,
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