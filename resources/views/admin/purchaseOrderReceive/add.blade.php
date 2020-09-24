@extends('admin.layouts.master')

@php
    use App\PurchaseOrderReceive;
    use App\PurchaseOrderReceiveItem;
@endphp

@section('content')
<form class="form-horizontal" action="{{ route('purchaseOrderReceive.save') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
    {{ csrf_field() }}
    <div class="col-md-12 m-b-20 text-right">
        <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
            <span style="font-size: 16px;">
                <i class="fa fa-save"></i> Save Data
            </span>
        </button>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
               <div class="col-6">
                    <label for="po-no">Purchase Order NO</label>
                    <div class="form-group {{ $errors->has('purchaseOrderNo') ? ' has-danger' : '' }}">
                        <select class="form-control chosen-select purchaseOrderNo" name="purchaseOrderNo" required>
                            <option value=" ">Select Purchase Order Number</option>
                            @foreach ($purchaseOrder as $order)
                                @php
                                    $qtySum = 0;
                                    $purchaseOrderReceives = PurchaseOrderReceive::where('purchaseOrderNo',$order->id)->get();
                                    foreach ($purchaseOrderReceives as $purchaseOrderReceive)
                                    {
                                        $purchaseOrderReceiveItemSum = PurchaseOrderReceiveItem::where('purchase_order_receive_id',$purchaseOrderReceive->id)->sum('qty');
                                        $qtySum = $qtySum + $purchaseOrderReceiveItemSum;
                                    }
                                @endphp
                                @if (@$qtySum != $order->total_qty)
                                    <option value="{{$order->id}}">{{$order->order_no}}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('purchaseOrderNo'))
                            @foreach($errors->get('purchaseOrderNo') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <label for="receive-date">Receive Date</label>
                    <div class="form-group {{ $errors->has('receive_date') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger add_datepicker" name="receive_date" required readonly>
                        @if ($errors->has('receive_date'))
                            @foreach($errors->get('receive_date') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for=""></label>
                    <div class="form-group">
                        <table class="table table-striped gridTable" >
                            <thead>
                                <tr>
                                    <th width="20%">Product Name</th>
                                    <th>Order Qty</th>
                                    <th>Rec Qty</th>
                                    <th>Cur Qty</th>
                                    <th>Bal Qty</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>
                                        <input style="text-align: right;" type="text" name="product_id">
                                    </td>
                                    <td><input style="text-align: right;" class="qty qty_1" type="number" name="qty[]" oninput="totalAmount('1')"></td>
                                    <td><input style="text-align: right;" class="rec_qty rec_qty_1" type="number" name="rec_qty[]" oninput="totalAmount('1')"></td>
                                    <td><input style="text-align: right;" class="cur_qty cur_qty_1" type="number" name="cur_qty[]" oninput="totalAmount('1')"></td>
                                    <td><input style="text-align: right;" class="due_qty due_qty_1" type="number" name="due_qty[]" oninput="totalAmount('1')"></td>
                                    <td><input style="text-align: right;" class="rate_1" type="number" name="rate[]" oninput="totalAmount('1')"></td>
                                    <td><input style="text-align: right;" class="amount amount_1" type="number" name="amount[]" readonly></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr style="text-align: right;">
                                    <th>Total Summary</th>
                                    <td><input style="text-align: right;" class="total_qty" type="number" name="total_qty" readonly></td>
                                    <td><input style="text-align: right;" class="total_rec_qty" type="number" name="total_rec_qty" readonly></td>
                                    <td><input style="text-align: right;" class="total_cur_qty" type="number" name="total_cur_qty" readonly></td>
                                    <td><input style="text-align: right;" class="total_due_qty" type="number" name="total_due_qty" readonly></td>
                                    <th>Total Amount</th>
                                    <td><input style="text-align: right;" class="total_amount" type="number" name="total_amount" readonly></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 m-b-20 text-right">
                        <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
                            <span style="font-size: 16px;">
                                <i class="fa fa-save"></i> Save Data
                            </span>
                        </button>
                    </div>                            
                </div>
            </div>
        </div>
    </div>              
</form>

<div id="itemList" style="display:none">
    <div class="input select">
    <select>
        <option value=" ">Select Item</option>
        <?php
            foreach ($products as $product) {
        ?>
        <option value="{{$product->id}}">{{$product->name}} ({{$product->deal_code}})</option>
        <?php } ?>
    </select>
    </div>
</div>

@endsection

@section('custom-js')

<script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function() {
        var updateThis ;

        // Get Purchase order id
        $(".purchaseOrderNo").change(function () {
            var purchaseOrderId = $('.purchaseOrderNo').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : 'POST',
                url: "{{route('getPurchaseOrderItem')}}",
                data : {
                    purchaseOrderId : purchaseOrderId,
                },
                success : function(data){
                   var purchaseOrderItems = data.purchaseOrderItems;
                   var purchaseOrderReceiveItem = data.purchaseOrderReceiveItem;
                   var purchaseOrder = data.purchaseOrder;
                   $(".total_qty").val(purchaseOrder.total_qty);
                   $(".gridTable tbody tr").remove();
                   var i= 0;
                   for (var row of purchaseOrderItems) {
                    var qty = 0;
                    i++;
                    for (var itemInfo of purchaseOrderReceiveItem) {
                        if (itemInfo.product_id == row.productId) {
                            qty = qty + parseFloat(itemInfo.qty);

                        }
                    }
                     if(qty < 1)
                     {
                        qty = parseFloat(0).toFixed('2');
                        qty = parseFloat(0).toFixed('2');
                        var curreny_qty = parseFloat(0).toFixed('2');
                        var balance_qty = parseFloat(0).toFixed('2');
                        var balance_qty = parseFloat(0).toFixed('2');
                        var amount = parseFloat(0).toFixed('2');
                    }else{
                         var curreny_qty = row.qty-parseFloat(qty);
                         var balance_qty = parseFloat(row.qty)-(parseFloat(qty)+parseFloat(curreny_qty));
                         var amount = row.rate*parseFloat(curreny_qty);
                    }

                    
                    // 01611118855
                    
                    if (row.qty != qty)
                    {
                        $(".gridTable tbody").append('<tr id="itemRow_' + i + '">' +
                            '<td><input class="item item_'+i+'" type="hidden" name="product_id[]" value="'+row.productId+'" >'+
                            '<input class="item item_'+i+'" type="text" name="product_name[]" value="'+row.name+'" required readonly></td>'+
                            '<td><input style="text-align: right;" class="qty qty_'+i+'" type="number" name="qty[]" required oninput="totalAmount('+i+')" value="'+row.qty+'" readonly></td>'+
                            '<td><input style="text-align: right;" class="rec_qty rec_qty_'+i+'" type="number" name="rec_qty[]" required onchange="totalAmount('+i+')" value="'+qty+'" readonly></td>'+
                            '<td><input style="text-align: right;" class="cur_qty cur_qty_'+i+'" type="number" name="cur_qty[]" value="'+curreny_qty+'" required oninput="totalAmount('+i+')"></td>'+
                            '<td><input style="text-align: right;" class="due_qty due_qty_'+i+'" type="number" name="due_qty[]" value="'+balance_qty+'" required oninput="totalAmount('+i+')" readonly></td>'+
                            '<td><input style="text-align: right;" class="rate_'+i+'" type="number" name="rate[]" required oninput="totalAmount('+i+')" value="'+row.rate+'" readonly></td>'+
                            '<td><input style="text-align: right;" class="amount amount_'+i+'" type="number" name="amount[]" required readonly value="'+amount+'"></td>'+
                            '</tr>');
                    }
                } 
            }
        })
    });

    $("form").submit(function(e){
        var purchaseOrderNo = $(".purchaseOrderNo").val();
        var purchaseOrderNo = $.trim(purchaseOrderNo);
        if(purchaseOrderNo == ''){
            alert('Please Select PO No !');
            e.preventDefault();
        }
    });
});


</script>

<script type="text/javascript">

    function totalAmount(i) {
        var qty = parseFloat($(".qty_" + i).val());
        var rate = parseFloat($(".rate_" + i).val());

        if ($(".rec_qty_" + i).val() == 0) {
            var rec_qty = 0;
        }
        else {
            var rec_qty = parseFloat($(".rec_qty_" + i).val());
        }

        var check_qty = qty - rec_qty;

        if ($(".cur_qty_" + i).val() > check_qty)
        {
            due_qty = qty - rec_qty;
            $(".cur_qty_" + i).val(due_qty);
            totalAmount(i);
        }

        var cur_qty = $(".cur_qty_" + i).val();
        var due_qty = parseFloat(qty) - (parseFloat(rec_qty) + parseFloat(cur_qty));

        var sum_total = parseFloat(cur_qty) * parseFloat(rate);
        $(".amount_" + i).val(sum_total.toFixed(2));

        $(".due_qty_" + i).val(due_qty.toFixed(2));

        row_sum(); 
        netAmount(); 
    }

    function netAmount(){
        var net_amount = 0;
        var total_amount = $(".total_amount").val();
        if($(".discount").val() == ''){
            var discount = 0;
        }else{
           var discount = $(".discount").val();
        }
        if($(".vat").val() == ''){
            var vat = 0;
        }else{
           var vat = $(".vat").val(); 
        }
        
        net_amount = (parseFloat(total_amount) + parseFloat(vat)) - parseFloat(discount);
        $('.net_amount').val(net_amount.toFixed(2));
    }

    function row_sum() {
        var total_qty = 0;
        var total_amount = 0;
        var total_rec_qty = 0;
        var total_cur_qty = 0;
        var total_due_qty = 0;
        $(".qty").each(function () {
            var stvalTotal = parseFloat($(this).val());
            // console.log(stval);
            total_qty += isNaN(stvalTotal) ? 0 : stvalTotal;
        });

        $(".amount").each(function () {
            var stvalAmount = parseFloat($(this).val());
            // console.log(stval);
            total_amount += isNaN(stvalAmount) ? 0 : stvalAmount;
        });

        $(".rec_qty").each(function () {
            var rec_qty = parseFloat($(this).val());
            total_rec_qty += isNaN(rec_qty) ? 0 : rec_qty;
        });

        $(".cur_qty").each(function () {
            var cur_qty = parseFloat($(this).val());
            total_cur_qty += isNaN(cur_qty) ? 0 : cur_qty;
        });

        $(".due_qty").each(function () {
            var due_qty = parseFloat($(this).val());
            total_due_qty += isNaN(due_qty) ? 0 : due_qty;
        });

        $('.total_qty').val(total_qty.toFixed(2));
        $('.total_amount').val(total_amount.toFixed(2));
        $('.total_rec_qty').val(total_rec_qty.toFixed(2));
        $('.total_cur_qty').val(total_cur_qty.toFixed(2));
        $('.total_due_qty').val(total_due_qty.toFixed(2));

    }


   /* $(".purchaseOrderNo").change(function () {
        var purchaseOrderId = $('.purchaseOrderNo').val();
        console.log(purchaseOrderId);
        $.ajax({
        type: 'GET',
        url: '<?php echo url('/get-purchase-order') ;?>/'+ purchaseOrderId,
        dataType: "JSON",
        success: function(response) {
            var blcntr = data.containers;
            $(".cntr tbody tr").remove();
                for (var row of blcntr) {
                $(".gridTable tbody").append('<tr id="itemRow_' + total + '">' +
            '<td>'+
            '<select name="product_id[]" class="form-control chosen-select itemList_'+total+'">'+
            '</select>'+
            '</td>'+
            '<td><input class="qty qty_'+total+'" type="number" name="qty[]" required oninput="totalAmount('+total+')"></td>'+
            '<td><input class="rate_'+total+'" type="number" name="rate[]" required oninput="totalAmount('+total+')"></td>'+
            '<td><span class="item_remove"><i class="fa fa-times" onclick="itemRemove(' + total + ')"></i>'+
            '<input class="amount amount_'+total+'" type="number" name="amount[]" required readonly></span></td>'+
            '</tr>');
                }
            }
      });

             $('.chosen-select').chosen();
            $('.chosen-select').trigger("chosen:updated");

    });*/
      
</script>

@endsection