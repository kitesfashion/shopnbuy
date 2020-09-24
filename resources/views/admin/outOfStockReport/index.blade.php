@extends('admin.layouts.master')

@section('content')
    <div class="modal-body">
        <form class="form-horizontal" action="{{ route('outOfStockReport.index') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="col-md-12">
                    @if (count($errors) > 0)
                        <div style="display:inline-block; width: auto;" class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">                                  
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control chosen-select" id="category" name="category[]" multiple>
                            @foreach ($categories as $categoryInfo)
                                @php
                                    $select = "";
                                    if ($category)
                                    {
                                        if (in_array($categoryInfo->id, $category))
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                    }
                                @endphp
                                <option value="{{ $categoryInfo->id }}" {{ $select }}>{{ $categoryInfo->categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product">product</label>
                        <div id="prodct-select-menu">
                            <select class="form-control chosen-select" id="product" name="product[]" multiple>
                                @foreach ($products as $productInfo)
                                    @php
                                        $select = "";
                                        if ($product)
                                        {
                                            if (in_array($productInfo->id, $product))
                                            {
                                                $select = "selected";
                                            }
                                            else
                                            {
                                                $select = "";
                                            }
                                        }
                                    @endphp
                                    <option value="{{ $productInfo->id }}" {{ $select }}>{{ $productInfo->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>   
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right" style="padding-bottom: 10px;">
                    <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
                        <span style="font-size: 16px;">
                            <i class="fa fa-save"></i> Serach Data
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 form-group">
            <div class="card" style="margin-bottom: 0px;">              
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                        <div class="col-md-6 text-right">
                            <form class="form-horizontal" action="{{ route('outOfStockReport.print') }}" target="_blank" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @if ($category)
                                    @foreach ($category as $categoryInfo)
                                        <input type="hidden" name="category[]" value="{{ $categoryInfo }}">
                                    @endforeach
                                @endif

                                @if ($product)
                                    @foreach ($product as $productInfo)
                                        <input type="hidden" name="product[]" value="{{ $productInfo }}">
                                    @endforeach
                                @endif

                                <button type="submit" class="btn btn-info btn-lg waves-effect">
                                    <span style="font-size: 16px;">
                                        <i class="fa fa-save"></i> Print Data
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @php
                        $message = Session::get('msg');
                        if (isset($message))
                        {
                            echo "<div style='display:inline-block;width: auto;' class='alert alert-success'><strong>" .$message."</strong></div>";
                        }
                        Session::forget('msg');
                        // echo $fromDate;
                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";
                    @endphp

                    <div class="table-responsive">
                        <table id="dataTable" name="dataTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="20px">Sl</th>
                                    <th>Category</th>
                                    <th width="110px">Product Code</th>
                                    <th>Product</th>
                                    <th width="105px">Available Qty</th>
                                </tr>
                            </thead>

                            <tbody id="tbody">
                                @php
                                    $sl = 0;
                                @endphp

                                @foreach ($stockOutReports as $stockOutReport)
                                    @php
                                        $sl++;
                                    @endphp
                                    @if ($stockOutReport->remainingQty <= $stockOutReport->reorderQty)
	                                    <tr>
	                                        <td>{{ $sl }}</td>
	                                        <td>{{ $stockOutReport->categoryName }}</td>
	                                        <td>{{ $stockOutReport->code }}</td>
	                                        <td>{{ $stockOutReport->productName }}</td>
	                                        <td style="text-align: right;">{{ $stockOutReport->remainingQty }}</td>
	                                    </tr>
                                    @endif                                  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <!-- This is data table -->
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var updateThis ;

            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function() {
                new Switchery($(this)[0], $(this).data());
            });

            var table = $('#dataTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>

    <script type="text/javascript">
    	$(document).on('change', '#category', function(){
    		$.ajaxSetup({
    			headers: {
    				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
    		});
    		
    		var id = $('#category').val();

    		$.ajax({
    			type:'post',
    			url:'{{ route('outOfStockReport.getAllProductByCategory') }}',
    			data:{id:id},
    			success:function(data){
    				$('#prodct-select-menu').html(data);
                    $(".chosen-select").chosen();
    			}
    		});
    	});

    </script>
@endsection