@extends('admin.layouts.master')

@section('content')
    <div class="modal-body">
        <form class="form-horizontal" action="{{ route('productList.index') }}" method="post" enctype="multipart/form-data">
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
                    <label for="product_category">Category</label>
                    <div class="form-group">
                        <select class="form-control chosen-select" id="product_category" name="product_category[]" multiple>
                            @foreach ($categories as $category)
                                @php
                                    $select = "";
                                    if ($product_category)
                                    {
                                        if (in_array($category->id, $product_category))
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                    }
                                @endphp
                                <option value="{{ $category->id }}" {{ $select }}>{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>

                <div class="col-md-6">
                    <label for="product">Product</label>
                    <div class="form-group">
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
                                <option value="{{ $productInfo->id }}" {{ $select }}>{{ $productInfo->name }} ({{ $productInfo->deal_code }})</option>
                            @endforeach
                        </select>
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
                            <form class="form-horizontal" action="{{ route('productList.print') }}" target="_blank" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                @if ($product_category)
                                    @foreach ($product_category as $categoryInfo)
                                        <input type="hidden" name="product_category[]" value="{{ $categoryInfo }}">
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
                                    <th>Product Name</th>
                                    <th width="90px">Unit Price</th>
                                </tr>
                            </thead>

                            <tbody id="tbody">
                                @php $sl = 0; @endphp

                                @foreach ($productLists as $productList)
                                	@php $sl++; @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $productList->categoryName }}</td>
                                        <td>{{ $productList->productName }}</td>
                                        <td style="text-align: right;">{{ $productList->unitPrice }}</td>
                                    </tr>                                    
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

    <script type="text/javascript">
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
        });
    </script>
@endsection