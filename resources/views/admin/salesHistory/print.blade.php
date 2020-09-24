@extends('admin.layouts.master_print')

@section('print')
	<div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px;">
		Sales History On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }} 
		Company Name:
	</div>							
	<table class="print-table">
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

		<tbody>
			@php
				$sl = 0;
				$totalCashSaleQty = 0;
				$totalCashSaleAmount = 0;

				$totalCreditSaleQty = 0;
				$totalCreditSaleAmount = 0;
			@endphp

            @foreach ($cashSales as $cashSale)
                @php
                	$sl++;
                	$totalCashSaleQty = $totalCashSaleQty + $cashSale->item_quantity;
                	$totalCashSaleAmount = $totalCashSaleAmount + $cashSale->item_price;
                @endphp
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
				@php
					$sl++;
                	$totalCreditSaleQty = $totalCreditSaleQty + $creditSale->item_quantity;
                	$totalCreditSaleAmount = $totalCreditSaleAmount + $creditSale->item_price;
				@endphp
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


    <div style="border: 1px solid black; padding: 0px; margin-top: 20px;">
        <table class="total-table">
            <tr>
                <td>Total Cash Sales Quantity</td>
                <td>{{ $totalCashSaleQty }}</td>
                <td>Total Cash Sales Amount</td>
                <td>{{ $totalCashSaleAmount }}</td>
            </tr>

            <tr>
                <td>Total Credit Sales Quanity</td>
                <td>{{ $totalCreditSaleQty }}</td>
                <td>Total Credit Sales Amount</td>
                <td>{{ $totalCreditSaleAmount }}</td>
            </tr>
            
            <tr>
                <td>Grand Total Quantity</td>
                <td>{{ $totalCashSaleQty + $totalCreditSaleQty }}</td>
                <td>Grand Total Amount</td>
                <td>{{ $totalCashSaleAmount + $totalCreditSaleAmount }}</td>
            </tr>
        </table>
    </div>
@endsection

