@extends('admin.layouts.master')

@section('content')
	<div class="table-responsive">
        <table id="dataTable" name="dataTable" class="table table-bordered">
            <thead>
                <tr>
                    <th width="20px">Sl</th>
                    <th>Client</th>
                    <th width="90px">Contact</th>
                    <th width="100px">Payment No</th>
                    <th width="80px">Date</th>
                    <th width="110px">Money Receipt</th>
                    <th width="70px">Type</th>
                    <th width="85px">New Paid</th>
                    <th width="220px">Remarks</th>
                    <th width="70px">Actions</th>
                </tr>
            </thead>

            <tbody id="tbody">
                @php $sl = 0; @endphp

                @foreach ($creditCollections as $creditCollection)
                    @php $sl++; @endphp
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $creditCollection->name }}</td>
                        <td>{{ $creditCollection->mobile }}</td>
                        <td>{{ $creditCollection->payment_no }}</td>
                        <td>{{ Date('d-m-Y',strtotime($creditCollection->payment_date)) }}</td>
                        <td>{{ $creditCollection->money_receipt_no }}</td>
                        <td>{{ $creditCollection->money_receipt_type }}</td>
                        <td>{{ $creditCollection->payment_amount }}</td>
                        <td>{{ $creditCollection->remarks }}</td>
                        <td>
                            @php
                            echo \App\Link::action($creditCollection->id)
                            @endphp
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

            var table = $('#dataTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax            

            //ajax delete code
            $('#dataTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                creditCollectionId = $(this).parent().data('id');
                var tableRow = this;
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
                },
                function(isConfirm){   
                    if (isConfirm) {     
                       $.ajax({
                            type: "POST",
                           url : "{{ route('creditCollection.destroy') }}",
                            data : {creditCollectionId:creditCollectionId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Credit Collection Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(tableRow).parents('tr'))
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
                            text: "Your Credit Collection is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(vendor_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('vendor.status', 0) }}",
                    data: "vendor_id=" + vendor_id,
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

            function summernote(){
                $('.summernote').summernote({
                    height: 200, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    focus: false // set focus to editable area after initializing summernote
                });
            }
    </script>
@endsection