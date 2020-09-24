@extends('admin.layouts.master')

@section('custom-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="table-responsive">
        <table id="subscribersTable" class="table table-bordered table-striped"  name="contactUsesTable">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th>Email</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $sl = 0;
                @endphp
                @foreach($subscribers as $subscriber)
                    @php $sl++; @endphp                         
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $subscriber->subscribeEmail }}</td>
                        
                        <td class="text-nowrap">
                        <?php echo \App\Link::action($subscriber->id)?>
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

            var table = $('#subscribersTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();


            //ajax delete code
            $('#subscribersTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                subscriber_id = $(this).parent().data('id');
                var updateThis = this;
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
                            url: "{{ route('subscribers.index') }}" + "/" + subscriber_id,
                            dataType: "JSON",
                            data: {
                                id:subscriber_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "subscriber email deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(updateThis).parents('tr'))
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
                            text: "Your subscriber email is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 


        });
    </script>
@endsection