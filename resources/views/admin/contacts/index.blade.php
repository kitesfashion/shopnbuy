@extends('admin.layouts.master')

@section('content')

<div class="table-responsive">
    <table id="contactsTable" class="table table-bordered table-striped"  name="contactsTable">
        <thead>
            <tr>
                <th width="5%">SL</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Subject</th>
                <th class="text-center" width="10%">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @php $i = 0; @endphp
            @foreach($contacts as $contact)                         
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $contact->contactName }}</td>
                 <td>{{ $contact->contactPhone }}</td>
                  <td>{{ $contact->contactEmail }}</td>
                  <td>{{ str_limit($contact->contactTitle,'30') }}</td>

                <td class="text-center">
                    <?php echo \App\Link::action($contact->id)?>
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
            var table = $('#contactsTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax
            
            
            //ajax delete code
            $('#contactsTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                contact_id = $(this).parent().data('id');
                var contact = this;
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
                            
                            url: "{{ route('contacts.index') }}" + "/" + contact_id,
                            
                            dataType: "JSON",
                            data: {
                                id:contact_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Contact Message Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(contact).parents('tr'))
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
                            text: "Your contact message is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
    
    </script>
@endsection