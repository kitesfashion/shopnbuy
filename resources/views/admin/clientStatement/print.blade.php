@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Client Statement History On Date {{ Date('d-M-Y',strtotime($fromDate)) }} To {{ Date('d-M-Y',strtotime($toDate)) }}
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                @php
                    if ($previousBalances)
                    {
                        $previousBalance = $previousBalances->sales - ($previousBalances->collection + $previousBalances->others);
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
                <th width="100px">Date</th>
                <th>Description</th>
                <th width="90px">sales</th>
                <th width="90px">collection</th>
                <th width="90px">Others</th>
                <th width="90px">Balance</th>
            </tr>
        </thead>

        <tbody>
            @php
                $sl = 0;
                $balance = 0;
                $totalSales = 0;
                $totalCollection = 0;
                $totalOthers = 0;
                $totalBalance = 0;
            @endphp

            @foreach ($clientStatements as $clientStatement)
                @php
                    $sl++;
                    if ($sl == 1)
                    {
                        $balance = $previousBalance + ($clientStatement->sales - $clientStatement->collection - $clientStatement->others);
                    }
                    else
                    {
                        $balance = $balance + ($clientStatement->sales - $clientStatement->collection - $clientStatement->others); 
                    }
                    $totalSales = $totalSales + $clientStatement->sales;
                    $totalCollection = $totalCollection + $clientStatement->collection;
                    $totalOthers = $totalOthers + $clientStatement->others;                     
                    $totalBalance = $totalBalance + $balance;                     
                @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ Date('d-m-Y',strtotime($clientStatement->date)) }}</td>
                    <td>{{ $clientStatement->customerName }}</td>
                    <td style="text-align: right;">{{ $clientStatement->sales }}</td>
                    <td style="text-align: right;">{{ $clientStatement->collection }}</td>
                    <td style="text-align: right;">{{ $clientStatement->others }}</td>
                    <td style="text-align: right;">{{ $balance }}</td>
                </tr>                                    
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Grand Total</th>
                <th style="text-align: right;">{{ $totalSales }}</th>
                <th style="text-align: right;">{{ $totalCollection }}</th>
                <th style="text-align: right;">{{ $totalOthers }}</th>
                <th style="text-align: right;">{{ $totalBalance }}</th>
            </tr>
        </tfoot>
    </table>
@endsection

