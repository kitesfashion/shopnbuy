@extends('admin.layouts.master')

@section('content')
    <div class="table-responsive">
        <table id="bannersTable" class="table table-bordered table-striped"  name="bannersTable">
            <thead>
                <tr>
                    <th width="5%">SL</th>
                    <th>Title</th>
                    <th width="10%">Image</th>
                    <th width="5%">Order</th>
                    <th width="5%">Status</th>
                    <th width="10%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 0;
                @endphp
                @foreach($banners as $banner)                          
                <tr class="row_{{$banner->id}}">
                    <td>{{ $i++}}</td>
                    <td>{{ $banner->title }}</td>
                     <td>
                        @if(file_exists($banner->bannerImage))
                            <img src="{{ asset('/').$banner->bannerImage }}" style="height: 75px">
                        @else
                            <img src="{{ $noImage }}" style="height: 75px">
                        @endif
                    </td>
                    <td class="text-center">{{ $banner->orderBy }}</td>
                    <td>
                        <?php echo \App\Link::status($banner->id,$banner->bannerStatus)?>
                    </td>
                    <td class="text-center">
                        <?php echo \App\Link::action($banner->id)?>
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

            var table = $('#bannersTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            
            //ajax delete code
            $('#bannersTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                bannerId = $(this).parent().data('id');
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
                            url : "{{ route('banner.delete') }}",
                            data : {bannerId:bannerId},
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Article Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+bannerId).remove();
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
            
    //ajax status change code
    function statusChange(bannerId) {
        $.ajax({
                type: "GET",
                url: "{{ route('banners.changebannerStatus', 0) }}",
                data: "bannerId=" + bannerId,
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