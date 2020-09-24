@extends('admin.layouts.master')

@section('content')
	<div class="modal-body">
        <form class="form-horizontal" action="{{ route('productWiseProfit.index') }}" method="post" enctype="multipart/form-data">
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
                    <label for="customer">Products</label>
                    <div class="form-group">
                        {{-- <select class="form-control chosen-select" id="customer" name="customer[]" multiple>
                            @foreach ($customers as $customerInfo)
                                @php
                                    $select = "";
                                    if ($customer)
                                    {
                                        if (in_array($customerInfo->id, $customer))
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                    }
                                @endphp
                                <option value="{{ $customerInfo->id }}" {{ $select }}>{{ $customerInfo->name }}</option>
                            @endforeach
                        </select> --}}

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

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="from_date">From Date</label>
                            <input  type="text" class="form-control datepicker" id="from_date" name="from_date" placeholder="Select Date From">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="to_date">To Date</label>
                            <input  type="text" class="form-control datepicker" id="to_date" name="to_date">
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
							<form class="form-horizontal" action="{{ route('productWiseProfit.print') }}" target="_blank" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="from_date" value="{{ $fromDate }}">
								<input type="hidden" name="to_date" value="{{ $toDate }}">

                                {{-- @if ($customer)
                                    @foreach ($customer as $customerInfo)
                                        <input type="hidden" name="customer[]" value="{{ $customerInfo }}">
                                    @endforeach
                                @endif --}}

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
									<th width="70px">Code</th>
									<th>Name</th>
									<th width="60px">Qty</th>
									<th width="80px">Price</th>
									<th width="80px">Vat</th>
									<th width="80px">Discount</th>
									<th width="80px">Total</th>
									<th width="80px">Costing</th>
									<th width="80px">Profit</th>
									<th width="75px">% Profit</th>
								</tr>
							</thead>

                            <tbody id="tbody">
                                @php
                                	$sl = 0;
                                    $total = 0;
                                    $costing = 0;
                                    $profit = 0;
                                    $percentageProfit = 0;
                                @endphp
                                @foreach ($productWiseProfits as $productWiseProfit)
                                    @php
                                        $sl++;
                                        $total = ($productWiseProfit->price + $productWiseProfit->vat) - $productWiseProfit->discount;
                                        $avgPrice = DB::table('stock_valuation_report')
                                            ->select(DB::raw('((SUM(stock_valuation_report.cashPurchaseAmount) + SUM(stock_valuation_report.creditPurchaseAmount)) - SUM(stock_valuation_report.purchaseReturnAmount)) / ((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) as avgPrice'))
                                            ->where('productId',$productWiseProfit->productId)
                                            ->first();
                                        $costing = $avgPrice->avgPrice * $productWiseProfit->qty;
                                        $profit = $total - $costing;
                                        $percentageProfit = ($profit * 100)/$total;
                                    @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ $productWiseProfit->categoryName }}</td>
                                        <td>{{ $productWiseProfit->productId }}</td>
                                        <td>{{ $productWiseProfit->productName }}</td>
                                        <td style="text-align: right;">{{ $productWiseProfit->qty }}</td>
                                        <td style="text-align: right;">{{ $productWiseProfit->price }}</td>
                                        <td style="text-align: right;">{{ $productWiseProfit->vat }}</td>
                                        <td style="text-align: right;">{{ $productWiseProfit->discount }}</td>
                                        <td style="text-align: right;">{{ $total }}</td>
                                        <td style="text-align: right;">{{ number_format($costing,'2','.','') }}</td>
                                        <td style="text-align: right;">{{ number_format($profit,'2','.','') }}</td>
                                        <td style="text-align: right;">{{ number_format($percentageProfit,'2','.','') }}</td>
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
        });
    </script>
@endsection