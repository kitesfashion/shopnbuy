@extends('admin.layouts.master')

@section('content')
	<div class="modal-body">
		<form class="form-horizontal" action="{{ route('salesHistory.index') }}" method="post" enctype="multipart/form-data">
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
				<div class="col-md-6 form-group">
                    <label for="from_date">From Date</label>
                    <input  type="text" class="form-control datepicker" id="from_date" name="from_date" placeholder="Select Date From">
				</div>
				<div class="col-md-6 form-group">
                    <label for="to_date">To Date</label>
                    <input  type="text" class="form-control datepicker" id="to_date" name="to_date">
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
                    <label for="client">Client</label>
                    <div class="form-group">
                    	<select class="form-control" id="client" name="client">
                    		<option value="">Select Client</option>
                        	@foreach ($clients as $clientInfo)
                        		<option value="{{ $clientInfo->id }}">{{ $clientInfo->name }}</option>
                    		@endforeach
                    		<option value="Cash">Cash</option>
                    	</select>
                    </div>							
				</div>

				<div class="col-md-6">
                    <label for="company">Company</label>
                    <div class="form-group">
                    	<select class="form-control" id="company" name="company">
                    		<option value="">Select Company</option>
                    		@foreach ($vendors as $vendor)
                        		<option value="{{ $vendor->id }}">{{ $vendor->vendorName }}</option>
                    		@endforeach
                    	</select>
                    </div>	
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
                    <label for="category">Category</label>
                    <div class="form-group">
                    	<select class="form-control" id="category" name="category">
                    		<option value="">Select Category</option>
                    		@foreach ($categories as $cat)
                    			<option value="{{ $cat->id }}">{{ $cat->categoryName }}</option>
                    		@endforeach
                    	</select>
                    </div>								
				</div>

				<div class="col-md-6">
                    <label for="product">Product</label>
                    <div class="form-group">
                    	<select class="form-control" id="product" name="product">
                    		<option value="">Select Product</option>
                    		@foreach ($products as $pro)
                    			<option value="{{ $pro->id }}">{{ $pro->name }}</option>
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
							<form class="form-horizontal" action="{{ route('salesHistory.print') }}" target="_blank" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="from_date" value="{{ $fromDate }}">
								<input type="hidden" name="to_date" value="{{ $toDate }}">
								<input type="hidden" name="client" value="{{ $client }}">
								<input type="hidden" name="company" value="{{ $company }}">
								<input type="hidden" name="category" value="{{ $category }}">
								<input type="hidden" name="product" value="{{ $product }}">
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
									<th>Sl</th>
									<th>Invoice Date</th>
									<th>Invoice No</th>
									<th>Client Name</th>
									<th>Category Name</th>
									<th>Product Name</th>
                                    <th>Qty</th>
									<th>Rate</th>
                                    <th>Amount</th>
								</tr>
							</thead>

                            <tbody id="tbody">
                                @php $sl = 0; @endphp

                                @foreach ($cashSales as $cashSale)
                                    @php $sl++; @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ Date('d-m-Y',strtotime($cashSale->invoice_date)) }}</td>
                                        <td>{{ $cashSale->invoice_no }}</td>
                                        <td>{{ $cashSale->payment_type }}</td>
                                        <td>{{ $cashSale->categoryName }}</td>
                                        <td>{{ $cashSale->name }}</td>
                                        <td>{{ $cashSale->item_quantity }}</td>
                                        <td>{{ $cashSale->item_rate }}</td>
                                        <td>{{ $cashSale->item_price }}</td>
                                    </tr>                                    
                                @endforeach

                                @foreach ($creditSales as $creditSale)
                                    @php $sl++; @endphp
                                    <tr>
                                        <td>{{ $sl }}</td>
                                        <td>{{ Date('d-m-Y',strtotime($creditSale->invoice_date)) }}</td>
                                        <td>{{ $creditSale->invoice_no }}</td>
                                        <td>{{ $creditSale->clientName }}</td>
                                        <td>{{ $creditSale->categoryName }}</td>
                                        <td>{{ $creditSale->name }}</td>
                                        <td>{{ $creditSale->item_quantity }}</td>
                                        <td>{{ $creditSale->item_rate }}</td>
                                        <td>{{ $creditSale->item_price }}</td>
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