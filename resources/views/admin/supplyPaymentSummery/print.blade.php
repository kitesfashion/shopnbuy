@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Supplier And Payment Summery On The Month {{ $month }} Of {{ $year }}
    </div>                          
    <table class="print-table">
        <thead>
        	<tr>
                <th width="20px" rowspan="2">Sl</th>
        		<th rowspan="2">Client Name</th>
        		<th rowspan="2">Previous Years</th>
        		<th colspan="3">For The Years 2019</th>
        		<th colspan="3">For The Month November</th>
        		<th rowspan="2">Current Balance</th>
        	</tr>
            <tr>
            	<th>Purchase</th>
            	<th>Payments</th>
            	<th>Balance</th>
            	<th>Purchase</th>
            	<th>Payments</th>
            	<th>Balance</th>
            </tr>
        </thead>

        <tbody id="tbody">
            @php
                $sl = 0;
                $previousBalance = 0;
                $totalPreviousBalance = 0;

                $yearlyBalance = 0;
                $totalYearlyBalance = 0;

                $monthlyBalance = 0;
                $totalMonthlyBalance = 0;

                $currentBalance = 0;
                $totalCurrentBalance = 0;
                $currentId = 0;
            @endphp

            @foreach ($supplierStatements as $supplierStatement)
                @php
                    $sl++;
                    $yearlyPurchase = 0;
                    $yearlyPayment = 0;
                    $monthlyPurchase = 0;
                    $monthlyPayment = 0;                                    
                @endphp
                @if ($supplierStatement->vendorId != $currentId)
                    @foreach ($supplierStatements as $value)
                        @php
                            if ($supplierStatement->vendorId == $value->vendorId)
                            {
                                $yearlyPurchase = $yearlyPurchase + $value->yearlyPurchase;
                                $yearlyPayment = $yearlyPayment + $value->yearlyPayment;
                                $monthlyPurchase = $monthlyPurchase + $value->monthlyPurchase;
                                $monthlyPayment = $monthlyPayment + $value->monthlyPayment;
                            }
                            $currentId = $supplierStatement->vendorId;
                        @endphp
                    @endforeach
                    @php
                    	$previousBalance = $supplierStatement->previousPayment - $supplierStatement->previousPurchase;
                    	$totalPreviousBalance = $totalPreviousBalance + $previousBalance;

                    	$yearlyBalance = $yearlyPayment - $yearlyPurchase;
                    	$totalYearlyBalance = $totalYearlyBalance + $yearlyBalance;

                    	$monthlyBalance = $monthlyPayment - $monthlyPurchase;
                    	$totalMonthlyBalance = $totalMonthlyBalance + $monthlyBalance;

                    	$currentBalance = $previousBalance + $yearlyBalance;
                    	$totalCurrentBalance = $totalCurrentBalance + $currentBalance;
                    @endphp
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $supplierStatement->vendorName }}</td>
                        <td style="text-align: right;">{{ $previousBalance }}</td>
                        <td style="text-align: right;">{{ $yearlyPurchase }}</td>
                        <td style="text-align: right;">{{ $yearlyPayment }}</td>
                        <td style="text-align: right;">{{ $yearlyBalance }}</td>
                        <td style="text-align: right;">{{ $monthlyPurchase }}</td>
                        <td style="text-align: right;">{{ $monthlyPayment }}</td>
                        <td style="text-align: right;">{{ $monthlyBalance }}</td>
                        <td style="text-align: right;">{{ $currentBalance }}</td>
                    </tr>
                @endif                                    
            @endforeach
        </tbody>

        <tfoot>
        	<tr>
        		<th colspan="2">Total Due Amonut</th>
        		<th style="text-align: right;">{{ $totalPreviousBalance }}</th>
        		<th colspan="2"></th>
        		<th style="text-align: right;">{{ $totalYearlyBalance }}</th>
        		<th colspan="2"></th>
        		<th style="text-align: right;">{{ $totalMonthlyBalance }}</th>
        		<th style="text-align: right;">{{ $totalCurrentBalance }}</th>
        	</tr>
        </tfoot>
    </table>
@endsection

