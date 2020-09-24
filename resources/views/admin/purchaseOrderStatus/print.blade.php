@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Purchase Order Status On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }}
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                <th width="25px">Sl</th>
                <th width="80px">PO No</th>
                <th>Product Name</th>
                <th width="100px">Order Qty</th>
                <th width="100px">Receive Qty</th>
                <th width="110px">Remaining Qty</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
                $row = 0;
                $remainingQty = 0;
                $currentOrderNo = 0;

                $totalOrderQty = 0;
                $totalReceiveQty = 0;
                $totalRemainingQty = 0;
            @endphp

            @foreach ($poStatus as $pos)
                @php
                    $sl++;
                    $remainingQty = $pos->orderQty - $pos->receiveQty;

                    $totalOrderQty = $totalOrderQty + $pos->orderQty;
                    $totalReceiveQty = $totalReceiveQty + $pos->receiveQty;
                    $totalRemainingQty = $totalRemainingQty + $remainingQty;
                    if ($currentOrderNo == $pos->orderNo)
                    {
                        $row++;
                    }
                    else
                    {
                        $currentOrderNo = $pos->orderNo;
                        $rowSpan = DB::table('purchase_order_status')
                            ->where('supplierId',$pos->supplierId)
                            ->where('orderNo',$pos->orderNo)
                            ->where('orderQty','>',0)
                            ->distinct('productId')
                            ->count('productId');
                        $row = 1;
                    }
                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    @if ($row == 1)
                        <td rowspan="{{ $rowSpan }}">{{ $pos->orderNo }}</td>
                        <td>{{ $pos->productName }}</td>
                        <td style="text-align: right;">{{ $pos->orderQty }}</td>
                        <td style="text-align: right;">{{ $pos->receiveQty }}</td>
                        <td style="text-align: right;">{{ $remainingQty }}</td>
                    @else
                        <td>{{ $pos->productName }}</td>
                        <td style="text-align: right;">{{ $pos->orderQty }}</td>
                        <td style="text-align: right;">{{ $pos->receiveQty }}</td>
                        <td style="text-align: right;">{{ $remainingQty }}</td>
                    @endif
                </tr>                                    
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Grand Total</th>
                <th style="text-align: right;">{{ $totalOrderQty }}</th>
                <th style="text-align: right;">{{ $totalReceiveQty }}</th>
                <th style="text-align: right;">{{ $totalRemainingQty }}</th>
            </tr>
        </tfoot>
    </table>
@endsection

