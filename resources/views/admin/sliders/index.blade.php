@extends('admin.layouts.master')

@section('content')
    <div class="table-responsive">
        <table id="categoriesTable" class="table table-bordered table-striped"  name="categoriesTable">
            <thead>
                <tr>
                    <th width="5%">SL</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th width="5%" class="text-center">Order</th>
                    <th width="5%">Status</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php $i = 1; @endphp
                @foreach($sliders as $slider)                           
                <tr>
                    <td>{{ $i++}}</td>
                    <td>{{ $slider->title }}</td>
                     <td>
                        <img src="{{ asset('/').$slider->image }}" style="height: 75px">
                     </td>
                     <td class="text-center">{{ $slider->orderBy }}</td>
                     <td>
                        <?php echo \App\Link::status($slider->id,$slider->status)?>
                    </td>
                    <td class="text-center">
                        <?php echo \App\Link::action($slider->id)?>
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

                slider_id = $(this).parent().data('id');
                var slider = this;
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
                            url: "{{ route('sliders.index') }}" + "/" + slider_id,
                            dataType: "JSON",
                            data: {
                                id:slider_id
                            },
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Slider deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(slider).parents('tr'))
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
                            text: "Your slider is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(slider_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('sliders.changeStatus', 0) }}",
                    data: "slider_id=" + slider_id,
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


