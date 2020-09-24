@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Stock Status Report On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }}
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th width="100px">Code</th>
                <th>Product</th>
                <th width="90px">Opening</th>
                <th width="100px">Receive Qty</th>
                <th width="90px">Sales Qty</th>
                <th width="90px">Balance</th>
                <th width="90px">Amount</th>
            </tr>
        </thead>

        <tbody id="tbody">
            @php
                $sl = 0;
                $currentId = 0;
                $grandTotalOpening = 0;
                $grandTotalReceiveQty = 0;
                $grandTotalSaleQty = 0;
                $grandTotalBalance = 0;
                $grandTotalAmount = 0;
            @endphp

            @foreach ($stockStatusReports as $stockStatusReport)
                @php
                    $sl++;
                    $totalOpening = 0;                                       
                    $totalReceiveQty = 0;                                       
                    $totalSaleQty = 0;
                    $balance = 0;                                       
                    $amount = 0;                                       
                @endphp
                @if ($stockStatusReport->productId != $currentId)
                    @foreach ($stockStatusReports as $value)
                        @php
                            if ($stockStatusReport->productId == $value->productId)
                            {
                                $totalOpening = $totalOpening + $value->opening;
                                $totalReceiveQty = $totalReceiveQty + $value->receiveQty;
                                $totalSaleQty = $totalSaleQty + $value->saleQty;
                            }
                            $currentId = $stockStatusReport->productId;
                        @endphp
                    @endforeach
                    @php
                        $balance = $totalReceiveQty - $totalSaleQty;
                        $amount = $stockStatusReport->avgPrice * $balance;
	                    $grandTotalOpening = $grandTotalOpening + $totalOpening;
	                    $grandTotalReceiveQty = $grandTotalReceiveQty + $totalReceiveQty;
	                    $grandTotalSaleQty = $grandTotalSaleQty + $totalSaleQty;
	                    $grandTotalBalance = $grandTotalBalance + $balance;
	                    $grandTotalAmount = $grandTotalAmount + $amount;                            
                    @endphp
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $stockStatusReport->code }}</td>
                        <td>{{ $stockStatusReport->productName }}</td>
                        <td style="text-align: right;">{{ $totalOpening }}</td>
                        <td style="text-align: right;">{{ $totalReceiveQty }}</td>
                        <td style="text-align: right;">{{ $totalSaleQty }}</td>
                        <td style="text-align: right;">{{ $balance }}</td>
                        <td style="text-align: right;">{{ $amount }}</td>
                    </tr>
                @endif                                   
            @endforeach
        </tbody>

        <tfoot>
        	<tr>
        		<th colspan="3">Total</th>
        		<th style="text-align: right;">{{ $grandTotalOpening }}</th>
        		<th style="text-align: right;">{{ $grandTotalReceiveQty }}</th>
        		<th style="text-align: right;">{{ $grandTotalSaleQty }}</th>
        		<th style="text-align: right;">{{ $grandTotalBalance }}</th>
        		<th style="text-align: right;">{{ $grandTotalAmount }}</th>
        	</tr>
        </tfoot>
    </table>
@endsection

