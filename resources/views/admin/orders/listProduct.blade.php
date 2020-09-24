@extends('admin.layouts.master')

@section('content')
@php
  use App\Invoice;
@endphp
  <div class="row">
    <div class="col-md-6">
    </div>
    <div class="col-md-6">  
      <span class="shortlink pull-right">
       <a class="btn btn-info"  href="{{ url('/admin/view-invoice/'.$invoiceId) }}">
        View Invoice
      </a>
    </div>
  </div>

 <div class="table-responsive">
    <table id="ordersTable" class="table table-bordered table-striped"  name="ordersTable">
        <thead>
            <tr>
                <th class="text-center">S/L</th>
                <th>Code</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
            <?php  ?>
            @php
              $i = 0;
              foreach($orders as $order){
                $amount = $order->qty*$order->price;
                $invoices  = Invoice::where('orderId',$order->id)->first();
                $i++;
            @endphp
              <tr>
                <input type="hidden" name="rowId" value="{{ $order->id }}">
                <td>{{$i}}</td>
                <td>{{ @$order->code }}</td>
                <td>{{ str_limit(@$order->name,60) }}</td>
                <td class="quant-input" width="30%">
                  <input type="number" value ="{{ @$order->qty }}" name="" style="width: 40%">
                  &nbsp;&nbsp;&nbsp;
                <?php
                  if (!$invoices) {
                    
                ?>
                  <a class="btn btn-success" href="{{url('/admin/add-to-invoice/'.$order->id)}}" style="float: right;">ADD TO INVOICE</a> 
                <?php }else{ ?>
                  <a class="btn btn-success" href="{{url('/admin/remove-from-invoice/'.$order->id)}}" style="float: right;">Remove from Invoice</a> 
                <?php } ?>
                </td>
                <td class="price-column"><input type="number" value ="{{ @$order->price }}" name="" style="width: 78%"></td>
                <td class="amount-column">
                  <span class="amount">{{ @$amount }}</span>
                </td>
               
                <td class="text-nowrap">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Order status" data-id="{{ $order->id }}"> <i class="fa fa-shopping-bag text-danger m-r-10"></i> 
                    </a>

                    <a href="javascript:void(0)" data-toggle="tooltip" data-original-title="Delete" data-id="{{$order->id}}"  data-token="{{ csrf_token() }}"> <i class="fa fa-trash text-danger"></i> </a>
                </td>
              </tr>
            @php
              }
            @endphp
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script>
$(document).ready(function(){
  var fadeTime = 0;

//Update order quantity of Order
  $('.quant-input input').change( function() {
    
  var productRow = $(this).parent().parent();
 
  var quantity = $(this).val();
  var rowId = productRow.find('input[name=rowId]').val();
  var price = productRow.children('.price-column').children('input').val();
  var amount = quantity * price;
  
  $.ajax({
      url: "{!! url('/admin/ordersQuantity') !!}" + "/" + rowId+"/update/"+quantity,
      data: {
          rowId:rowId,
          qty:quantity,
      },
      cache:false,
      contentType: false,
      processData: false,
      success: function() {
         productRow.children('.amount-column').children('.amount').each(function () {
          $(this).fadeOut(fadeTime, function() {
            $(this).text(amount);
            $(this).fadeIn(fadeTime);
           
          });
        });
      },

      error: function() {
         swal({
            title: "<small class='text-danger'>error!</small>", 
            type: "success",
            text: "",
            timer: 1000,
            html: true,
        });
      }
  });   
});

// Update Order price of Order
  $('.price-column input').change( function() {
    
  var productRow = $(this).parent().parent();
 
  var price = $(this).val();
  var rowId = productRow.find('input[name=rowId]').val();
  var quantity = productRow.children('.quant-input').children('input').val();
  var amount = quantity * price;
  
  $.ajax({
      url: "{!! url('/admin/ordersPrice') !!}" + "/" + rowId+"/update/"+price,
      data: {
          rowId:rowId,
          price:price,
      },
      cache:false,
      contentType: false,
      processData: false,
      success: function() {
         productRow.children('.amount-column').children('.amount').each(function () {
          $(this).fadeOut(fadeTime, function() {
            $(this).text(amount);
            $(this).fadeIn(fadeTime);
           
          });
        });
      },

      error: function() {
         swal({
            title: "<small class='text-danger'>error!</small>", 
            type: "success",
            text: "",
            timer: 1000,
            html: true,
        });
      }
  });   
});
 
 
});
</script>

@endsection

