@extends('admin.layouts.master')

@section('content')

@php
   use App\Product;
@endphp
    <div class="table-responsive">
        <table id="policiesTable" class="table table-bordered table-striped"  name="policiesTable">
            <thead>
                <tr>
                    <th width="40px">SL</th>
                    <th width="160px">Name</th>
                    <th>Product</th>
                    <th width="130px">Code</th>
                    <th>Summary</th>
                    <th>Rating</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 0;
                @endphp
                @foreach($reviews as $review) 
                @php
                    $product = Product::where('id',$review->productId)->first();
                    $i++
                @endphp                         
                <tr>
                    <td>{{ @$i }}</td>
                    <td>{{ @$review->name }}</td>
                    <td>{{ @$product->name }}</td>
                    <td>{{ @$product->deal_code }}</td>
                    <td>{{ @$review->review }}</td>
                    <td>{{ @$review->star }}</td>

                   <td>
                        <?php echo \App\Link::status($review->id,$review->status)?>
                    </td>
                    <td class="text-nowrap">
                    <?php echo \App\Link::action($review->id)?>
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

            var table = $('#policiesTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

           
            //ajax delete code
            $('#policiesTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                review_id = $(this).parent().data('id');
                var category = this;
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
                            // url: "{!! url('categories' ) !!}" + "/" + review_id,
                            url: "{{ route('reviews.index') }}" + "/" + review_id,
                            // data: "review_id=" + review_id,
                            dataType: "JSON",
                            data: {
                                id:review_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "review deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(category).parents('tr'))
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
                            text: "Your category is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(review_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('reviews.changereviewStatus', 0) }}",
                    data: "review_id=" + review_id,
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