<!DOCTYPE html>
<html>
<head>
    <title>{{@$title}}</title>
    <link href="{{ asset('/public/admin-elite/dist/css/prints.css') }}" rel="stylesheet">
</head>
<body>
@php
    $invoice_date = $orders->created_at->format('d-m-Y');
    $invoice_no = 10000000 + $orders->id;
@endphp 
<style type="text/css">
    .inv-col, .inv-col span{
        color: #333;
        font-size: 16px;
    }
   
    .price, .subtotal, .shipping-charge{
        color: #333;
    }

</style>
    <table width="100%" style="margin-top: -30px;border-bottom: 1px solid #333;padding-bottom: -10px;">
        <tr>
            <td>
               <h2 class="invoice-title">INVOICE</h2>
               <div class="col-md-4 col-sm-4" style="margin-top: -20px;">
                <div class="inv-col"><span>Invoice #</span> {{$invoice_no}}</div>
                <div class="inv-col"><span>Date :</span> {{$invoice_date}}</div>
            </div>
                
            </td>
             <td>
                <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4">
                <h3 style="text-align: right;" class="inv-to"> 
                    {{$information->siteName}}
                </h3>
                <p style="text-align: right;margin-top: -20px;" class="cust_info">
                    {{ @$company->siteAddress1}}<br/> 
                    {{@$company->siteAddress2}}<br>
                    {{@$company->mobile1}}
                    {{@$company->mobile2}}
                </p>
            </div> 
            </td>
        </tr>
    </table>



    @yield('print_invoice')
</body>
</html>
     
     