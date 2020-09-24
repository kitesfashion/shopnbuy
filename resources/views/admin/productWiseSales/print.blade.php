@extends('admin.layouts.master_print')

@section('print')
	<div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px;">
		Product Wise Sales On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }} 
		Company Name:
	</div>

	<table class="print-table">
		<thead>
            <tr>
                <th>Sl</th>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Payment Type</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
		</thead>

        <tbody>
            @php
                $sl = 0;
                $itemId = 0;
                $cashItem = 0;
                $creditItem = 0;
                $cashGrandTotal = 0;
                $creditGrandTotal = 0;
                $cashGrandQty = 0;
                $creditGrandQty = 0;
            @endphp

            @foreach ($cashSales as $cashSaleItemId)
                @if ($cashSaleItemId->item_id != $cashItem)
                    @php
                        $sl++;
                        $l = 0;
                        $arrayCount = count($cashSales);
                        $cashItem = 0;
                        $itemName = 0;
                        $totalQty = 0;
                        $totalAmount = 0;
                    @endphp
                    @foreach ($cashSales as $cashSale)
                        @php
                            if ($cashSale->item_id == $cashSaleItemId->item_id)
                            {
                                $totalQty = $totalQty + $cashSale->item_quantity;
                                $totalAmount = $totalAmount + ($cashSale->item_quantity * $cashSale->item_rate);
                                $cashItem = $cashSale->item_id;
                                $itemName = $cashSale->name;
                                $cashGrandTotal = $cashGrandTotal + $totalAmount;
                                $cashGrandQty = $cashGrandQty + $totalQty;
                            }
                            $l++;
                        @endphp

                        @if ($arrayCount == $l)
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ $cashSale->deal_code }}</td>
                                <td>{{ $itemName }}</td>
                                <td>{{ $cashSale->payment_type }}</td>
                                <td>{{ $totalQty }}</td>
                                <td>{{ $totalAmount }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @foreach ($creditSales as $creditSaleItemId)
                @if ($creditSaleItemId->item_id != $creditItem)
                    @php
                        $sl++;
                        $l = 0;
                        $arrayCount = count($creditSales);
                        $creditItem = 0;
                        $itemName = 0;
                        $totalQty = 0;
                        $totalAmount = 0;
                    @endphp
                    @foreach ($creditSales as $creditSale)
                        @php
                            if ($creditSale->item_id == $creditSaleItemId->item_id)
                            {
                                $totalQty = $totalQty + $creditSale->item_quantity;
                                $totalAmount = $totalAmount + ($creditSale->item_quantity * $creditSale->item_rate);
                                $creditItem = $creditSale->item_id;
                                $itemName = $creditSale->name;
                                $creditGrandTotal = $creditGrandTotal + $totalAmount;
                                $creditGrandQty = $creditGrandQty + $totalQty;
                            }
                            $l++;
                        @endphp

                        @if ($arrayCount == $l)
                            <tr>
                                <td>{{ $sl }}</td>
                                <td>{{ $creditSale->deal_code }}</td>
                                <td>{{ $itemName }}</td>
                                <td>{{ $creditSale->payment_type }}</td>
                                <td>{{ $totalQty }}</td>
                                <td>{{ $totalAmount }}</td>
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
                <td>Total Cash Sales Quantity</td>
                <td>{{ $cashGrandQty }}</td>
                <td>Total Cash Sales Amount</td>
                <td>{{ $cashGrandTotal }}</td>
            </tr>

            <tr>
                <td>Total Credit Sales Quanity</td>
                <td>{{ $creditGrandQty }}</td>
                <td>Total Credit Sales Amount</td>
                <td>{{ $creditGrandTotal }}</td>
            </tr>
            
            <tr>
                <td>Grand Total Quantity</td>
                <td>{{ $cashGrandQty + $creditGrandQty }}</td>
                <td>Grand Total Amount</td>
                <td>{{ $cashGrandTotal + $creditGrandTotal }}</td>
            </tr>
        </table>
    </div>
@endsection

