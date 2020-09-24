@extends('admin.layouts.master')

@section('content')
    @php
        use App\Category;
    @endphp
    <div class="row">
        <div class="col-md-3">
            <h5><strong>Search By Parent Category</strong></h5>
            <form>
                <select name="parentCategoryParam" class="form-control chosen-select parentCategory">
                        <option value="">View All</option>
                    @foreach ($parentCategoryList as $parentCategory)
                       @php
                            if(@$parentCategoryParam){
                                if($parentCategory->id == $parentCategoryParam){
                                    $selected = 'selected';
                                }else{
                                    $selected = '';
                                }
                            }
                       @endphp
                        <option {{@$selected}} value="{{$parentCategory->id}}">{{$parentCategory->categoryName}}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table id="categoriesTable" class="table table-bordered table-striped datatable"  name="categoriesTable">
            <thead>
                <tr>
                    <th width="20px">SL</th>
                    <th>Name</th>
                    <th width="20px" class="text-center">Image</th>
                    <th width="250px">Parent</th>
                    <th width="20px" class="text-center">Order</th>
                    <th width="20px">Status</th>
                    <th width="20px" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody id="">
                @php
                    $sl = 0;
                @endphp
                @foreach($categories as $category)
                    @php
                        $sl++;
                    @endphp                         
                    <tr class="row_{{$category->id}}">
                        <td>{{ $sl }}</td>
                        <td>{{ $category->categoryName }}</td>
                        <td class="text-center">
                            @if (!file_exists(@$category->image))
                                <img src="{{ $noImage }}" style="height: 75px">
                            @else
                                <img src="{{ asset('/').$category->image }}" style="height: 75px">
                            @endif
                        </td>

                        <td>
                            @if (@$category->parentName == "")
                                Root
                            @else
                                {{ @$category->parentName }}
                            @endif                                            
                        </td>

                        <td class="text-center">{{ $category->orderBy }}</td>
                        
                        <td>
                            <?php echo \App\Link::status($category->id,$category->categoryStatus)?>
                        </td>
                        <td class="text-nowrap">
                        <?php echo \App\Link::action($category->id)?>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


<!-- sample modal content for show category-->
<div id="showCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Show Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container" id="showContent">
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



@endsection

@section('custom-js')
    <script>
        $(document).ready(function() {
            var updateThis ;
            
            //ajax show code
            $('#categoriesTable tbody').on( 'click', 'i.fa-eye', function () { 
                updateThis = this;
                category_id = $(this).parent().data('id');
                $.ajax({
                    type: "GET",
                    url: "{{ route('categories.index') }}" + "/" + category_id + "/edit",
                    data: "category_id=" + category_id,
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
                if(category.categoryStatus == 1) 
                    categoryStatus =    `<div class="form-group row">
                                    <span class="badge badge-pill badge-success">Active</span>
                                </div>`;
                else
                    categoryStatus =    `<div class="form-group row">
                                    <span class="badge badge-pill badge-danger">In-active</span>
                                </div>`
                var content =   `<div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control"><b>Category name</b></label>
                                    <div class="col-sm-8 form-control">`+category.categoryName+`</div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label form-control"><b>Category position</b></label>
                                    <div class="col-sm-8 form-control">`+category.position+`</div>
                                </div>`+categoryStatus;

                $('#showContent').html(content);
                $("#showCategory").modal(); 
            }
            
            //ajax delete code
            $('#categoriesTable tbody').on( 'click', 'i.fa-trash', function () {
                $.ajaxSetup({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
                });

                categoryId = $(this).parent().data('id');
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
                            url : "{{ route('category.delete',0) }}",
                            data : {categoryId:categoryId},
                            success: function(response) {
                                swal({
                                    title: "<small class='text-success'>Success!</small>", 
                                    type: "success",
                                    text: "Category Deleted Successfully!",
                                    timer: 1000,
                                    html: true,
                                });
                                $('.row_'+categoryId).remove();
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
                            text: "Your Category is safe :)",
                            timer: 1000,
                            html: true,
                        });    
                    } 
                });
            }); 

        });
                
        //ajax status change code
        function statusChange(category_id) {
            $.ajax({
                    type: "GET",
                    url: "{{ route('categories.changecategoryStatus', 0) }}",
                    data: "category_id=" + category_id,
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

    <script type="text/javascript">
        $('.parentCategory').on('change', function(){
          var parentCategory = $('.parentCategory').val();
          window.location.href = "{{route('categories.index')}}"+"?parentCategory="+parentCategory;
        }); 
    </script>
@endsection