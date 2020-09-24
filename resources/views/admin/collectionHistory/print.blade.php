@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Collection History On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }}
    </div>                          
    <table class="print-table">
		<thead>
			<tr>
				<th width="20px">Sl</th>
				<th width="90px">Date</th>
				<th>Client Name</th>
				<th width="115px">Money Receipt</th>
                <th width="90px">Pay Mode</th>
                <th width="90px">Amount</th>
			</tr>
		</thead>

        <tbody id="tbody">
            @php
            	$sl = 0;
            	$totalCollection = 0;

            	$currentDate = 0;
            	$dateRow = 0;

            	$currentClientId = 0;
            	$clientIdRow = 0;

            	$currentType = 0;
            	$typeRow = 0;

            	$typeRowSpan = 1;
            	$clientIdRowSpan = 1;
            @endphp
            @foreach ($collectionHistories as $collectionHistory)
                @php
                	$sl++;
                	$totalCollection = $totalCollection + $collectionHistory->paymentAmount;

            		if ($customer)
            		{
                    	if ($currentDate == $collectionHistory->date)
                    	{
                    		$dateRow++;
                    	}
                    	else
                    	{
                    		$currentDate = $collectionHistory->date;
	                    	$dateRowSpan = DB::table('credit_collections')
	                    		->where('payment_date',$collectionHistory->date)
	                    		->whereIN('client_id',$customer)
	                    		->count('payment_date');
	                    	$dateRow = 1;
                    	}
            		}
            		else
            		{
                    	if ($currentDate == $collectionHistory->date)
                    	{
                    		$dateRow++;
                    	}
                    	else
                    	{
                    		$currentDate = $collectionHistory->date;
	                    	$dateRowSpan = DB::table('credit_collections')
	                    		->where('payment_date',$collectionHistory->date)
	                    		->count('payment_date');
	                    	$dateRow = 1;
	                    }
            		}

                	if ($currentDate == $collectionHistory->date AND $currentClientId == $collectionHistory->clientId)
                	{
                		$clientIdRow++;
                	}
                	else
                	{
                		$currentClientId = $collectionHistory->clientId;
                    	$clientIdRowSpan = DB::table('credit_collections')
                    		->where('payment_date',$collectionHistory->date)
                    		->where('client_id',$collectionHistory->clientId)
                    		->count('client_id');
                    	$clientIdRow = 1;
                	}

                	// if ($currentDate == $collectionHistory->date AND $currentClientId == $collectionHistory->clientId AND $currentType == $collectionHistory->moneyReceiptType)
                	// {
                	// 	$typeRow++;
                	// }
                	// else
                	// {
                	// 	$currentType = $collectionHistory->moneyReceiptType;
                    // 	$typeRowSpan = DB::table('credit_collections')
                    // 		->where('payment_date',$collectionHistory->date)
                    // 		->where('client_id',$collectionHistory->clientId)
                    // 		->where('money_receipt_type',$collectionHistory->moneyReceiptType)
                    // 		->count('money_receipt_type');
                    // 	$typeRow = 1;
                	// }
                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    @if ($dateRow == 1)
                        <td rowspan="{{ $dateRowSpan }}">{{ Date('d-m-Y',strtotime($collectionHistory->date)) }}</td>
                        <td rowspan="{{ $clientIdRowSpan }}">{{ $collectionHistory->clientName }}</td>
                        <td>{{ $collectionHistory->moneyReceiptNo }}</td>
                        <td>{{ $collectionHistory->moneyReceiptType }}</td>
                        <td>{{ $collectionHistory->paymentAmount }}</td>
                    @else
                    	@if ($clientIdRow != 1)
	                        <td>{{ $collectionHistory->moneyReceiptNo }}</td>
	                        <td>{{ $collectionHistory->moneyReceiptType }}</td>
	                        <td>{{ $collectionHistory->paymentAmount }}</td>
                    	@else
	                        <td rowspan="{{ $clientIdRowSpan }}">{{ $collectionHistory->clientName }}</td>
	                        <td>{{ $collectionHistory->moneyReceiptNo }}</td>
	                        <td>{{ $collectionHistory->moneyReceiptType }}</td>
	                        <td>{{ $collectionHistory->paymentAmount }}</td>
                    	@endif
                    @endif
                </tr>                                    
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="6"></th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <table width="100%">
        	<tr>
        		<th style="text-align: center;">Total Collection Summery : {{ number_format($totalCollection,'2','.','') }}</th>
        	</tr>
        </table> 
    </div>
@endsection

