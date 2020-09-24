@extends('frontend.master')

@section('body')
<div class="container">
    <div class="row justify-content-center" style="margin: 50px;">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">

                <div class="card-body">
                    <h3 class="text-center text-success" id="xyz">{{ Session::get('message') }}</h3>

                    <table class="table table-bordered table-resposive">
                        <tr class="bg-primary">
                            <th>Sl No</th>
                            <th>Product Name</th>
                            <th>Product Weight</th>
                            <th>Order quantity</th>
                            <th>Total Price</th>
                        </tr>
                        @php($i=1)
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $product->prod_name }}</td>
                                <td>{{ $product->prod_weight }}</td>
                                <td>{{ $product->qty }}</td>
                                <td>{{ $product->prod_price*$product->qty }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
