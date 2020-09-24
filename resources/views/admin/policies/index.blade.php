@extends('admin.layouts.master')

@section('content')

<div class="table-responsive">
    <table id="policiesTable" class="table table-bordered table-striped"  name="policiesTable">
        <thead>
            <tr>
                <th width="5%">SL</th>
                <th>Title</th>
                <th>Description</th>
                <th>Icon</th>
                <th width="5%" class="text-center">Order</th>
                <th width="5%">status</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @php
                $i = 0;
            @endphp
            @foreach($policies as $policy)
            @php
                $i++;
             @endphp                         
               <tr class="row_{{$policy->id}}">
                    <td>{{ $i }}</td>
                    <td>{{ $policy->title }}</td>
                    <td>{{ $policy->description }}</td>
                    <td>{{ $policy->icon }}</td>
                    <td class="text-center">{{ $policy->orderBy }}</td>
                    <td>
                        <?php echo \App\Link::status($policy->id,$policy->policiesStatus)?>
                    </td>
                    <td class="text-nowrap text-center">
                        <?php echo \App\Link::action($policy->id)?>
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

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();

            //ajax
            

            //ajax show code
            $('#policiesTable tbody').on( 'click', 'i.fa-eye', function () { 
                updateThis = this;
                policy_id = $(this).parent().data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('categories.index') }}" + "/" + policy_id + "/edit",
                    data: "policy_id=" + policy_id,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(response) {                        
                        category = response.category;
                        showFunction(category);
                    },
                    error: function(response) {
                        error = "Something wrong.";
                        swal({
                            title: "<small class='text-danger'>Error!</small>", 
                            type: "error",
                            text: error,
                            timer: 1000,
                            html: true,
                        });
                    }
                });              
            });

            //seperate the show function to understand
            function showFunction(category){
                if(category.policiesSttus == 1) 
                    policiesSttus =    `<div class="form-group row">
                                    <span class="badge badge-pill badge-success">Active</span>
                                </div>`;
                else
                    policiesSttus =    `<div class="form-group row">
                                    <span class="badge badge-pill badge-danger">In-active</span>
                                </div>`
                var content =   `<div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control"><b>Category name</b></label>
                                    <div class="col-sm-8 form-control">`+category.categoryName+`</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control"><b>Category position</b></label>
                                    <div class="col-sm-8 form-control">`+category.position+`</div>
                                </div>`+policiesSttus;

                $('#showContent').html(content);
                $("#showCategory").modal(); 
            }
            
            //ajax delete code
            $('#policiesTable tbody').on( 'click', 'i.fa-trash', function () {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            policyId = $(this).parent().data('id');
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
                        url : "{{ route('policy.delete',0) }}",
                        data : {policyId:policyId},
                        success: function(response) {
                            swal({
                                title: "<small class='text-success'>Success!</small>", 
                                type: "success",
                                text: "Policy Deleted Successfully!",
                                timer: 1000,
                                html: true,
                            });
                            $('.row_'+policyId).remove();
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
        function statusChange(policy_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('policies.changepolicyStatus', 0) }}",
                    data: "policy_id=" + policy_id,
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