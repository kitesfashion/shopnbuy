@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Supplier Statement History On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }}
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                @php
                    if ($previousBalances)
                    {
                        $previousBalance = $previousBalances->lifting - ($previousBalances->payment + $previousBalances->others);
                    }
                    else
                    {
                        $previousBalance = 0;
                    }
                    
                @endphp
                <th colspan="6" style="text-align: right; font-weight: bold;">Previous Balance</th>
                <th style="text-align: right;">{{ $previousBalance }}</th>
            </tr>
            <tr>
                <th width="20px">Sl</th>
                <th width="80px">Date</th>
                <th>Description</th>
                <th width="80px">Lifting</th>
                <th width="80px">Payment</th>
                <th width="80px">Others</th>
                <th width="80px">Balance</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
                $balance = 0;
                $totalLifting = 0;
                $totalPayment = 0;
                $totalOthers = 0;
                $totalBalance = 0;
            @endphp

            @foreach ($supplierStatements as $supplierStatement)
                @php
                    $sl++;
                    if ($sl == 1)
                    {
                        $balance = ($previousBalance + $supplierStatement->lifting) - ($supplierStatement->payment + $supplierStatement->others);
                    }
                    else
                    {
                        $balance = $balance - ($supplierStatement->lifting - $supplierStatement->payment - $supplierStatement->others); 
                    }
                    $totalLifting = $totalLifting + $supplierStatement->lifting;
                    $totalPayment = $totalPayment + $supplierStatement->payment;
                    $totalOthers = $totalOthers + $supplierStatement->others;                     
                    $totalBalance = $totalBalance + $balance;                     
                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ Date('d-m-Y',strtotime($supplierStatement->date)) }}</td>
                    <td>{{ $supplierStatement->vendorName }}</td>
                    <td style="text-align: right;">{{ $supplierStatement->lifting }}</td>
                    <td style="text-align: right;">{{ $supplierStatement->payment }}</td>
                    <td style="text-align: right;">{{ $supplierStatement->others }}</td>
                    <td style="text-align: right;">{{ $balance }}</td>
                </tr>                                    
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Grand Total</th>
                <th style="text-align: right;">{{ $totalLifting }}</th>
                <th style="text-align: right;">{{ $totalPayment }}</th>
                <th style="text-align: right;">{{ $totalOthers }}</th>
                <th style="text-align: right;">{{ $totalBalance }}</th>
            </tr>
        </tfoot>
    </table>
@endsection
