@extends('admin.layouts.master_print')

@section('print')
    <div class="header">
        Out Of Stock Report 
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Category</th>
                <th width="110px">Product Code</th>
                <th>Product</th>
                <th width="105px">Available Qty</th>
            </tr>
        </thead>

        <tbody id="tbody">
            @php
                $sl = 0;
            @endphp

            @foreach ($stockOutReports as $stockOutReport)
                @php
                    $sl++;
                @endphp
                @if ($stockOutReport->remainingQty <= $stockOutReport->reorderQty)
                    <tr>
                        <td>{{ $sl }}</td>
                        <td>{{ $stockOutReport->categoryName }}</td>
                        <td>{{ $stockOutReport->code }}</td>
                        <td>{{ $stockOutReport->productName }}</td>
                        <td style="text-align: right;">{{ $stockOutReport->remainingQty }}</td>
                    </tr>
                @endif                                  
            @endforeach
        </tbody>

        <tfoot>
        	<tr>
        		<th colspan="5"></th>
        	</tr>
        </tfoot>
    </table> 
@endsection

