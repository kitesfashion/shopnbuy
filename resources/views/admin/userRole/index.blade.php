@extends('admin.layouts.master')

@section('content')
    <style type="text/css">
        a{
            cursor: pointer;
        }

        #cancel_{{Auth::user()->role}}{
            display: none !important;
        }

        #status_{{Auth::user()->role}}{
            display: none !important;
        }
    </style>
    <div class="table-responsive">
        <table id="usersTable" class="table table-bordered table-striped datatable"  name="usersTable">
            <thead>
                <tr>
                    <th width="5%">SL</th>
                    <th>Name</th>
                    <th width="5%">status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                <?php $i=0; ?>
            	@foreach($userRoles as $role)
                @php
                    $i++;
                @endphp
                    <tr class="user{{$role->id}}">
                        <td>{{ $i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <?php echo \App\Link::status($role->id,$role->status)?>
                        </td>
                        <td class="text-nowrap">
                        <?php echo \App\Link::action($role->id)?>
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
        
            //ajax delete code
            $('#usersTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                userRole_id = $(this).parent().data('id');
                var user = this;
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
                            type: "DELETE",
                            // url: "{!! url('categories' ) !!}" + "/" + userRole_id,
                            url: "{{ route('user-roles.index') }}" + "/" + userRole_id,
                            // data: "userRole_id=" + userRole_id,
                            dataType: "JSON",
                            data: {
                                id:userRole_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "User Roll Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(user).parents('tr'))
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
                            text: "Your date is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(userRole_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('userRole.changeuserRoleStatus', 0) }}",
                    data: "userRole_id=" + userRole_id,
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