@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Product Wise Report On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }}
    </div>                          
    <table class="print-table">
		<thead>
			<tr>
				<th width="20px">Sl</th>
				<th>Category</th>
				<th width="70px">Code</th>
				<th>Name</th>
				<th width="30px">Qty</th>
				<th width="50px">Price</th>
				<th width="40px">Vat</th>
				<th width="60px">Discount</th>
				<th width="50px">Total</th>
				<th width="50px">Costing</th>
				<th width="60px">Profit</th>
				<th width="60px">% Profit</th>
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
                    <td>{{ $productWiseProfit->code }}</td>
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
@endsection

