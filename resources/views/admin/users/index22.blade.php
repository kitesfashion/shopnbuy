@extends('admin.layouts.master')

@section('content')
@php
    use App\Admin;
@endphp
    <div class="table-responsive" >
        <ul class="dropdown-menuC sub-menu" style="padding: 0px">
            <li>
                <a href="javascript:void(0)" class="trigger my-link" style="color: #26ae0d;">
                    {{$currentUser->roleName}}
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="35%">Username</th>
                            <th width="35%">Email</th>
                            <th width="8%">Status</th>
                            <th width="15%" style="text-align:center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$currentUser->name}}</td>
                            <td>{{$currentUser->email}}</td>
                            <td>
                                @php 
                                    echo \App\Link::status($currentUser->id,$currentUser->status) 
                                @endphp
                            </td>
                             <td class="text-center">
                                 @php 
                                    echo \App\Link::action($currentUser->id) 
                                @endphp
                            </td>
                        </tr>
                    </tbody>
                </table>
            </li>

            @foreach($childUserRoleList as $childUserRole)
            @php
                $userList = Admin::where('role',$childUserRole->id)->get();
            @endphp
                <li>
                    <a href="javascript:void(0)" class="trigger my-link">
                        {{$childUserRole->name}}
                    </a>
                    <table class="table table-bordered table-striped" id="usersTable">
                        <thead>
                            <tr>
                                <th width="35%">Username</th>
                                <th width="35%">Email</th>
                                <th width="8%">Status</th>
                                <th width="15%" style="text-align:center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userList as $user)
                                <tr class="row_"{{$user->id}}>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @php 
                                            echo \App\Link::status($user->id,$user->status) 
                                        @endphp
                                    </td>
                                     <td class="text-center">
                                         @php 
                                            echo \App\Link::action($user->id) 
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </li>
            @endforeach

            @php
                echo \App\UserRollMenu::UserRoleList($currentUser->role);
            @endphp
        </ul>
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

                user_id = $(this).parent().data('id');
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
                                    text: "user deleted Successfully!",
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
            }); 

        });
                
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