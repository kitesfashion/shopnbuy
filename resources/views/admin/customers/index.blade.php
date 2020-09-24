@extends('admin.layouts.master')

@section('content')
    <div class="table-responsive">
        <table id="customersTable" class="table table-bordered table-striped"  name="customersTable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="20px">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php $sl = 0; @endphp
                @foreach($customers as $customer)
                @php $sl++; @endphp
                <tr class="row_{{ @$customer->id }}">
                    <td>{{ $sl }}</td>
                    <td>{{ @$customer->name }}</td>
                    <td>{{ @$customer->email }}</td>
                    <td>{{ @$customer->mobile }}</td>
                    <td class="text-nowrap">
                    <?php echo \App\Link::action($customer->id)?>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('custom-js')

    <!-- This is data table -->
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('#customersTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax
            
            
            //ajax delete code
            $('#customersTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                customerId = $(this).parent().data('id');
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
                            url : "{{ route('customer.customerDestroy') }}",
                            data : {customerId:customerId},
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Customer Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+customerId).remove();
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
                            text: "Your article is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            });  

        });
                
    
    </script>
@endsection