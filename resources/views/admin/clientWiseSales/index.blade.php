@extends('admin.layouts.master')

@section('content')
	<div class="modal-body">
		<form class="form-horizontal" action="{{ route('clientWiseSales.index') }}" method="post" enctype="multipart/form-data">
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
                    <label for="client">Client</label>
                    <div class="form-group">
                    	<select class="form-control" id="client" name="client">
                    		<option value="">Select Client</option>
                    		@foreach ($clients as $clientInfo)
                    		@php
                    			if($clientInfo->id == $client){
                    				$selected = "selected";
                    			}else{
                    				$selected = "";
                    			}
                    		@endphp
                    		@php
                    			if($client == "Cash"){
                    				$selected = "selected";
                    			}else{
                    				$selected = "";
                    			}
                    		@endphp
                    			<option {{@$selected}} value="{{ $clientInfo->id }}">{{ $clientInfo->name }}</option>
                    		@endforeach
                    		<option {{@$selected}} value="Cash">Cash</option>
                    	</select>
                    </div>	
				</div>

				<div class="col-md-6">
					<div class="row">
						<div class="col-md-6 form-group">
                            <label for="from_date">From Date</label>
                            <input  type="text" class="form-control datepicker" id="from_date" name="from_date">
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
                    <button type="submit" class="btn btn-outline-info btn-lg waves-effect" onclick="return save()">
                        <span style="font-size: 16px;">
                            <i class="fa fa-save"></i> Search Data
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
							<form class="form-horizontal" action="{{ route('clientWiseSales.print') }}" target="_blank" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="from_date" value="{{ $fromDate }}">
								<input type="hidden" name="to_date" value="{{ $toDate }}">
								<input type="hidden" name="client" value="{{ $client }}">
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
									<th>Client Name</th>
									<th>Owner Name</th>
									<th>Payment Type</th>
                                    <th>Total Sales Amount</th>
								</tr>
							</thead>

                            <tbody id="tbody">
                                @php
                                	$sl = 0;
                                	$itemId = 0;
                                	$creditClientId = 0;

                                	$cashTotalNetAmount = 0;
                                	$cashClient = "";
                                	$cashPaymentType = "";
                                @endphp

                                @foreach ($cashSales as $cashSale)
                                    @php
                                		$cashTotalNetAmount = $cashTotalNetAmount + $cashSale->net_amount;
                                		$cashClient = $cashSale->payment_type;
                                		$cashPaymentType = $cashSale->payment_type;
                                    @endphp
                                @endforeach

                                <tr>
                                    <td>{{ ++$sl }}</td>
                                    <td>{{ $cashClient }}</td>
                                    <td></td>
                                    <td>{{ $cashPaymentType }}</td>
                                    <td>{{ $cashTotalNetAmount }}</td>
                                </tr>

                                @foreach ($creditSales as $creditSaleClientId)
                                	@if ($creditSaleClientId->clientId != $creditClientId)
	                                	@php
		                                    $sl++;
	                                		$l = 0;
	                                		$arrayCount = count($creditSales);
	                                		$creditClient = "";
	                                		$totalNetAmount = 0;
	                                	@endphp
		                                @foreach ($creditSales as $creditSale)
		                                    @php
		                                    	if ($creditSale->clientId == $creditSaleClientId->clientId)
		                                    	{
		                                    		$totalNetAmount = $totalNetAmount + $creditSale->net_amount;
		                                    		$creditClient = $creditSale->clientName;
		                                    		$creditClientId = $creditSale->clientId;
		                                    	}
		                                    	$l++;
		                                    @endphp

		                                    @if ($arrayCount == $l)
			                                    <tr>
			                                        <td>{{ $sl }}</td>
			                                        <td>{{ $creditClient }}</td>
			                                        <td></td>
			                                        <td>{{ $creditSale->payment_type }}</td>
			                                        <td>{{ $totalNetAmount }}</td>
			                                    </tr>
		                                    @endif                                   
		                                @endforeach
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