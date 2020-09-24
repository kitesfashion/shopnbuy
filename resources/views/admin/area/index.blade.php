@extends('admin.layouts.master')
@section('content')
@php
    use App\DeliveryZone;
@endphp
    <div class="table-responsive">
        <table id="menusTable" class="table table-bordered table-striped"  name="menusTable">
            <thead>
                <tr>
                    <th width="5%">Sl</th>
                    <th>Name</th>
                    <th>Zone</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @php
                    $i = 1;
                    foreach($areas as $area){
                        $zone = DeliveryZone::where('id',$area->delivery_zone_id)->first();
                @endphp                      
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $area->name }}</td>
                    <td>{{ @$zone->name }}</td>
                    <td class="text-nowrap">
                    <?php echo \App\Link::action($area->id)?>
                    </td>
                </tr>
                @php
                    }
                @endphp
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

            var table = $('#menusTable').DataTable( {
                "order": [[0, 'asc' ]],
                "pageLength": 50,
            } );

            //ajax            

            //ajax delete code
            $('#menusTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                areaId = $(this).parent().data('id');
                var area = this;
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
                           url : "{{ route('area.destroy') }}",
                            data : {areaId:areaId},
                           
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Area Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                table
                                    .row( $(area).parents('tr'))
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
                            text: "Your area is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(country_id) {
            $.ajax({
                    type: "GET",
                    url: "",
                    data: "country_id=" + country_id,
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