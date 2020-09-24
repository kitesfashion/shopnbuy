@extends('admin.layouts.master_print')

@section('print')
    <div class="header">
        Stock Valuation Report 
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th width="50px">Code</th>
                <th>Product</th>
                <th width="80px">Sales Price</th>
                <th width="120px">Avg Lifting Price</th>
                <th width="50px">Qty</th>
                <th width="80px">Sales</th>
                <th width="80px">Purchase</th>
            </tr>
        </thead>

        <tbody id="tbody">
            @php
                $sl = 0;
                $sales = 0;
                $purchase = 0;
                $totalSales = 0;
                $totalPurchase = 0;
            @endphp

            @foreach ($stockValuationReports as $stockValuationReport)
                @php
                    $sl++;
                    $sales = $stockValuationReport->salesPrice * $stockValuationReport->stockQty;
                    $purchase = $stockValuationReport->avgLifting * $stockValuationReport->stockQty;
                    $totalSales = $totalSales + $sales;
                    $totalPurchase = $totalPurchase + $purchase;
                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $stockValuationReport->code }}</td>
                    <td>{{ $stockValuationReport->productName }}</td>
                    <td style="text-align: right;">{{ $stockValuationReport->salesPrice }}</td>
                    <td style="text-align: right;">{{ number_format($stockValuationReport->avgLifting,'2','.','') }}</td>
                    <td style="text-align: right;">{{ $stockValuationReport->stockQty }}</td>
                    <td style="text-align: right;">{{ number_format($sales,'2','.','') }}</td>
                    <td style="text-align: right;">{{ number_format($purchase,'2','.','') }}</td>
                </tr>                                  
            @endforeach
        </tbody>

        <tfoot>
        	<tr>
        		<th colspan="8"></th>
        	</tr>
        </tfoot>
    </table>

    <div class="footer">
        <table width="100%">
        	<tr>
        		<th colspan="4" style="text-align: center;">Total Sales : {{ number_format($totalSales,'2','.','') }}</th>
        		<th colspan="4" style="text-align: center;">Total Purchase : {{ number_format($totalPurchase,'2','.','') }}</th>
        	</tr>
        </table> 
    </div> 
@endsection

