@extends('admin.layouts.master')

@section('content')
<div class="table-responsive">
    <table id="socialTabel" class="table table-bordered table-striped datatable"  name="socialTabel">
        <thead>
            <tr>
                <th width="5%">SL</th>
                <th>Name</th>
                <th width="10%" class="text-center">icon</th>
                <th width="5%">Status</th>
                <th width="5%">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php $i = 0; ?>
        	@foreach($socials_links as $social)
            <?php $i++; ?>                        	
        	<tr class="row_{{$social->id}}">
                <td>{{ $i }}</td>
                 <td>{{ $social->name }}</td>
                 <td class="text-center"><?php echo $social->icon ?></td>
                 <td>
                    <?php echo \App\Link::status($social->id,$social->status)?>
                </td>
                <td class="text-nowrap">
                <?php echo \App\Link::action($social->id)?>
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

            //ajax delete code
            $('#socialTabel tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                socialId = $(this).parent().data('id');
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
                }, function(isConfirm){   
                    if (isConfirm) {     
                       $.ajax({
                            type: "POST",
                           url : "{{ route('social.delete',0) }}",
                            data : {socialId:socialId},
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Social Link Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+socialId).remove();
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
                            text: "Your social is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(socialId) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('social.status', 0) }}",
                    data: "socialId=" + socialId,
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


