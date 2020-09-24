@extends('admin.layouts.master_invoice_print')

@section('print_invoice')

    <table style="margin-top: 0px;border-bottom: 1px solid #333;" width="100%">
        <tr>
            <td width="50%">
                <div>
                    <h4 class="inv-to">INVOICE FOR</h4>
                    <h4 class="corporate-id" style="margin-top: -10px;">
                        {{$orders->name}}
                    </h4>
                    <p class="cust_info" style="margin-top: -15px;">
                        {{$orders->shipping_address}}
                    <br>
                    Contact No: {{$orders->phone}}<br>  
                    </p>

                </div>
            </td>
            <td width="50%" style="text-align: right;">
                <div>

                    <h4 class="inv-to">SHIPPING TO</h4>
                    <h4 class="corporate-id" style="margin-top: -10px;">
                        {{$orders->name}}
                    </h4>
                    <p class="cust_info" style="margin-top: -15px;">
                        {{$orders->shipping_address}}
                    <br>
                    Contact No: {{$orders->phone}}<br>  
                    </p>

                </div>
            </td>
           
        </tr>
    </table>

    <table class="orderList" width="100%" style="margin-top: 20px;">
        <thead >
        <tr style="text-align: center;background-color: #aeb1b7;line-height: 30px;"> 
            <th>SL</th>
            <th>Product Name</th>
            <th>Product Code</th>
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
                <tr style="text-align: center;line-height: 12px;">
                     <td>{{ $i }}</td>
                    <td>
                        <p class="price">{{ $orderdetails->name }}</p> 
                    </td>
                     <td>
                        <p class="price">{{ $orderdetails->code }}</p>
                        
                    </td>
                    <td class="text-center">{{ $orderdetails->price }}</td>
                    <td class="text-center">{{ $orderdetails->qty }}
                    </td>
                    <td class="text-center"> {{ $orderdetails->price * $orderdetails->qty }}</td>
                </tr>
            @php
                $subtotal += $orderdetails->price * $orderdetails->qty;
                }
            @endphp
        </tbody>
    </table>

    <footer>  
        <span class="totalTable">
            <table width="100%">
                <tr>
                    <td width="30%"></td>
                    <td width="30%"></td>
                    <td>
                        <p class="subtotal" align="right">Sub Total <br> Shipping Charge (+)</p>
                        <p align="right"><strong>GRAND TOTAL</strong></p>
                    </td>
                    <td>
                        <p class="subtotal" align="right"> {{ $subtotal }} Tk<br> 0 Tk</p>
                        <p align="right"><strong>{{ $subtotal }} Tk</strong></p>
                    </td>
                </tr>
            </table>
        </span>
    </footer> 
@endsection
     
     