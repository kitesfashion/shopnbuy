@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Sales And Collection Standings On The Month {{ $month }} Of {{ $year }}
    </div>                          
    <table class="print-table">
        <thead>
        	<tr>
                <th rowspan="2">Sl</th>
        		<th rowspan="2">Client Name</th>
        		<th rowspan="2">Previous Years</th>
        		<th colspan="3">For The Year {{ $year }}</th>
        		<th colspan="3">For The Month {{ date('F', mktime(0, 0, 0,$month, 10)) }}</th>
        		<th rowspan="2">Current Balance</th>
        	</tr>
            <tr>
            	<th>Sales</th>
            	<th>Realization</th>
            	<th>Inc/Dec</th>
            	<th>Sales</th>
            	<th>Realization</th>
            	<th>Inc/Dec</th>
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

            @foreach ($salesCollections as $salesCollection)
                @php
                    $sl++;
                    $yearlySales = 0;
                    $yearlyCollection = 0;
                    $monthlySales = 0;
                    $monthlyCollection = 0;                                    
                @endphp
                @if ($salesCollection->customerId != $currentId)
                    @foreach ($salesCollections as $value)
                        @php
                            if ($salesCollection->customerId == $value->customerId)
                            {
                                $yearlySales = $yearlySales + $value->yearlySales;
                                $yearlyCollection = $yearlyCollection + $value->yearlyCollection;
                                $monthlySales = $monthlySales + $value->monthlySales;
                                $monthlyCollection = $monthlyCollection + $value->monthlyCollection;
                            }
                            $currentId = $salesCollection->customerId;
                        @endphp
                    @endforeach
                    @php
                    	$previousBalance = $salesCollection->previousSales - $salesCollection->previousCollection;
                    	$totalPreviousBalance = $totalPreviousBalance + $previousBalance;

                    	$yearlyBalance = $yearlySales - $yearlyCollection;
                    	$totalYearlyBalance = $totalYearlyBalance + $yearlyBalance;

                    	$monthlyBalance = $monthlySales - $monthlyCollection;
                    	$totalMonthlyBalance = $totalMonthlyBalance + $monthlyBalance;

                    	$currentBalance = $previousBalance + $yearlyBalance;
                    	$totalCurrentBalance = $totalCurrentBalance + $currentBalance;
                    @endphp
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $salesCollection->customerName }}</td>
                        <td style="text-align: right;">{{ $previousBalance }}</td>
                        <td style="text-align: right;">{{ $yearlySales }}</td>
                        <td style="text-align: right;">{{ $yearlyCollection }}</td>
                        <td style="text-align: right;">{{ $yearlyBalance }}</td>
                        <td style="text-align: right;">{{ $monthlySales }}</td>
                        <td style="text-align: right;">{{ $monthlyCollection }}</td>
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

