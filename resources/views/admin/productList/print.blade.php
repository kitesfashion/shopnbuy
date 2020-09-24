@extends('admin.layouts.master_print')

@section('print')
    <div style="border: 1px solid black; box-shadow: 5px 5px #888888; padding: 0px; margin-bottom: 10px; text-align: center;">
        Product Lists
    </div>                          
    <table class="print-table">
        <thead>
            <tr>
                <th width="20px">Sl</th>
                <th>Category</th>
                <th>Product Name</th>
                <th width="100px">Unit Price</th>
            </tr>
        </thead>

        <tbody>
            @php $sl = 0; @endphp

            @foreach ($productLists as $productList)
            	@php $sl++; @endphp
                <tr>
                    <td>{{ $sl }}</td>
                    <td>{{ $productList->categoryName }}</td>
                    <td>{{ $productList->productName }}</td>
                    <td style="text-align: right;">{{ $productList->unitPrice }}</td>
                </tr>                                    
            @endforeach
        </tbody>
    </table>
@endsection

