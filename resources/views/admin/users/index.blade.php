@extends('admin.layouts.master')

@section('content')
    <style type="text/css">
        a{
            cursor: pointer;
        }

        #cancel_{{Auth::user()->id}}{
            display: none !important;
        }

        #status_{{Auth::user()->id}}{
            display: none !important;
        }
    </style>
   

    <div class="table-responsive">
        <table id="usersTable" class="table table-bordered table-striped datatable"  name="usersTable">
            <thead>
                <tr>
                    <th width="5%">SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="5%">status</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 0;
                @endphp
                @foreach($userList as $user)
                @php
                   $i++;
               @endphp                           
                <tr class="row_{{$user->id}}">
                    <td>{{$i}}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roleName }}</td>
                    <td>
                        @php echo \App\Helper\UserLink::status($user->id,$user->status) @endphp
                    </td>
                    <td class="text-nowrap">
                        @php echo \App\Helper\UserLink::action($user->id) @endphp
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('custom-js')

    <script>
            //ajax delete code

            function DeleteData(user_id){
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });
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
                            // url: "{!! url('categories' ) !!}" + "/" + user_id,
                            url: "{{ route('users.index') }}" + "/" + user_id,
                            // data: "user_id=" + user_id,
                            dataType: "JSON",
                            data: {
                                id:user_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "User Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+user_id).remove();
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
                            text: "Your data is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }
            /*$('#usersTable tbody').on( 'click', 'i.fa-trash', function () {
                
            }); */
                
        //ajax status change code
        function statusChange(user_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('user.changeuserStatus', 0) }}",
                    data: "user_id=" + user_id,
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