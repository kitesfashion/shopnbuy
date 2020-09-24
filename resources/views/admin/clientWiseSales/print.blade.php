@extends('admin.layouts.master_print')

@section('print')
	<div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px;">
		Client Wise Sales On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }} 
		Company Name:
	</div>

	<table class="print-table">
		<thead>
			<tr>
				<th>Sl</th>
				<th>Client Name</th>
				<th>Owner Name</th>
				<th>Payment Type</th>
                <th>Total Sales Amount</th>
			</tr>
		</thead>

        <tbody>
            @php
            	$sl = 0;
            	$itemId = 0;
            	$creditClientId = 0;

            	$cashTotalNetAmount = 0;
            	$cashClient = "";
            	$cashpaymentType = "";

            	$creditGrandTotal = 0;
            @endphp

            @foreach ($cashSales as $cashSale)
                @php
            		$cashTotalNetAmount = $cashTotalNetAmount + $cashSale->net_amount;
                @endphp
            @endforeach

            <tr>
                <td>{{ ++$sl }}</td>
                <td>{{ @$cashSale->payment_type }}</td>
                <td></td>
                <td>{{ @$cashSale->payment_type }}</td>
                <td>{{ @$cashTotalNetAmount }}</td>
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
                                $creditGrandTotal = $creditGrandTotal + $creditSale->net_amount;
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


    <div style="border: 1px solid black; padding: 0px; margin-top: 20px;">
        <table class="total-table">
            <tr>
                <td>Total Cash Sales Amount</td>
                <td>{{ $cashTotalNetAmount }}</td>
            </tr>

            <tr>
                <td>Total Credit Sales Amount</td>
                <td>{{ $creditGrandTotal }}</td>
            </tr>
            
            <tr>
                <td>Grand Total Amount</td>
                <td>{{ $cashTotalNetAmount + $creditGrandTotal }}</td>
            </tr>
        </table>
    </div>
@endsection

