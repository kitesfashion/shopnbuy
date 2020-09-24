@extends('admin.layouts.master')


@section('content')

@php
    $invoice_date = $order->created_at->format('d-m-Y');
    $invoice_no = 10000000 + $order->id;
@endphp 
    
<style type="text/css">
    .inv-col, .inv-col span{
        color: #333;
        font-size: 16px;
    }
    .card{
        font-family: sans-serif;
    }
    .price, .subtotal, .shipping-charge{
        color: #333;
    }
</style>

    <div class="panel">
        <div class="panel-body invoice">
            <div class="row">
                <div class="col-md-8 col-sm-4">
                    <h1 class="invoice-title">invoice</h1>
                </div>
                <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
                     <h3 class="inv-to"> 
                        <img style="margin-left: -30px;" src="{{ asset('/').@$company->adminLogo }}" class="light-logo large-logo" alt="large" />
                    </h3>
                    <p class="cust_info">
                        {{ @$company->siteAddress1}}<br/> 
                        {{@$company->siteAddress2}}<br>
                        {{@$company->mobile1}}
                        {{@$company->mobile2}}
                    </p>
                </div>
            </div>
            <div class="invoice-address">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h4 class="inv-to">Invoice To</h4>
                        <p class="cust_info">{{$order->name}}</p>
                        <p class="cust_info" style="margin-top: -15px;">
                            {{$order->shipping_address}}
                        <br>
                        Contact No: {{$order->phone}}<br>  
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-4">

                        <h4 class="inv-to">Shipment To</h4>
                        <p class="cust_info">{{$order->name}}</p>
                        <p class="cust_info" style="margin-top: -15px;">
                            {{$order->shipping_address}}
                        <br>
                        Contact No: {{$order->phone}}<br>  
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="inv-col"><span>Invoice#</span> {{$invoice_no}}</div>
                        <div class="inv-col"><span>Invoice Date :</span> {{$invoice_date}}</div>
                        <div>
                            <span  class="inv-col">Delivery Zone: {{@$order->delivery_zone_name}}</span>
                        </div>
                        <div class="inv-col"><span>Payment Method: </span></div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-stripedno-footer">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th class="text-center">Unit Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                        $i = 0;
                        foreach($orderList as $orderdetails){ 
                        $i++;
                    @endphp
                    <tr>
                        <td><strong>{{$i}}</strong></td>
                        <td><strong>{{$orderdetails->code}}</strong></td>
                        <td>
                            <p class="price">{{str_limit($orderdetails->name,30)}}</p>
                            
                        </td>
                        <td class="text-center"><strong>{{$orderdetails->price}}</strong></td>
                        <td class="text-center"><strong>{{$orderdetails->qty}}</strong></td>
                        <td class="text-right">
                            <strong>৳ {{$orderdetails->price * $orderdetails->qty}}</strong>
                        </td>
                    </tr>
                    @php
                        $subtotal += $orderdetails->price * $orderdetails->qty;
                    }
                    @endphp
                
                    <tr>
                        <td colspan="2" class="payment-method">
                            
                        </td>
                        <td class="text-right" colspan="3">
                            <p class="subtotal">Sub Total</p>
                            <p class="shipping-charge">Shipping Charge (+)</p>
                            <p><strong>GRAND TOTAL</strong></p>
                        </td>
                        
                        <td class="text-right">
                            <p class="subtotal">৳ {{$subtotal}}</p>
                            <p class="shipping-charge">0</p>
                            <p><strong>৳ {{$subtotal}}</strong></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center ">
            <a href="{{ route('view.pdf',$order->id) }}" target="_blank" class="btn btn-primary btn-lg" ><i class="fa fa-print"></i> View PDF </a>
        </div>
    </div>
@endsection
