@extends('admin.layouts.master')

@section('content')
<?php
    use App\PurchaseOrder;
    $purchase_order = PurchaseOrder::whereRaw('id = (select max(`id`) from purchase_orders)')->first();
    if(!$purchase_order){
        $order_no = 1000000+1;
    }else{
        $order_no = 1000000+$purchase_order->id+1;
    }
?>
<form class="form-horizontal" action="{{ route('purchaseOrder.save') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
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
                    <label for="supplier">Supplier</label>
                    <div class="form-group {{ $errors->has('supplier_id') ? ' has-danger' : '' }}">
                        <select class="form-control form-control-danger chosen-select" name="supplier_id" required="">
                            <option value=" ">Select Supplier</option>
                            <?php
                                foreach ($vendors as $vendor) {
                            ?>
                            <option value="{{$vendor->id}}">{{$vendor->vendorName}}</option>
                            <?php } ?>
                        </select>
                        @if ($errors->has('supplier_id'))
                            @foreach($errors->get('supplier_id') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <label for="order-no">Order No</label>
                    <div class="form-group {{ $errors->has('order_no') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger" name="order_no" value="{{ $order_no }}" required readonly>
                        @if ($errors->has('order_no'))
                            @foreach($errors->get('order_no') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                 <div class="col-6">
                    <label for="delivery-date">Delivery Date</label>
                    <div class="form-group {{ $errors->has('delivery_date') ? ' has-danger' : '' }}">
                        <input  type="text" class="form-control form-control-danger add_datepicker" name="delivery_date" value="{{ old('delivery_date') }}" readonly>
                        @if ($errors->has('delivery_date'))
                            @foreach($errors->get('delivery_date') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-6">
                    <label for="order-date">Order Date</label>
                    <div class="form-group {{ $errors->has('order_date') ? ' has-danger' : '' }}">
                        <input  type="text" class="form-control form-control-danger add_datepicker" name="order_date" value="{{ old('order_date') }}" readonly>
                        @if ($errors->has('order_date'))
                            @foreach($errors->get('order_date') as $error)
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
                                    <th width="40%">Product Name & Code</th>
                                    <th width="16%">Quantity</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                <tr>
                                    <td>
                                        <select class="form-control form-control-danger chosen-select" name="product_id[]" required="">
                                            <option value=" ">Select Item</option>
                                            <?php
                                                foreach ($products as $product) {
                                            ?>
                                            <option value="{{$product->id}}">{{$product->name}} ({{$product->deal_code}})</option>
                                            <?php } ?>
                                    </select>
                                    </td>
                                    <td><input style="text-align: right;" class="qty qty_1" type="number" name="qty[]" value="1" oninput="totalAmount('1')" required></td>
                                    <td><input style="text-align: right;" class="rate_1" type="number" name="rate[]" value="0" oninput="totalAmount('1')" required></td>
                                    <td><input style="text-align: right;" class="amount amount_1" type="number" name="amount[]" value="0" required readonly></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Total Quantity</th>
                                    <td>
                                        <input class="total_qty" type="number" name="total_qty" value="1" readonly>
                                    </td>
                                    <th>Total Amount</th>
                                    <td>
                                        <input class="total_amount" type="number" name="total_amount" value="0" readonly>                                         
                                    </td>

                                    <td align="center">
                                        <input type="hidden" class="row_count" value="1">
                                        <span class="btn btn-success add_item">
                                            <i class="fa fa-plus-circle"></i> Add More
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
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
    $(".add_item").click(function () {
        var row_count = $('.row_count').val();
        var total = parseInt(row_count) + 1; 
        $(".gridTable tbody").append('<tr id="itemRow_' + total + '">' +
            '<td>'+
            '<select name="product_id[]" class="form-control chosen-select itemList_'+total+'">'+
            '</select>'+
            '</td>'+
            '<td><input style="text-align: right;" class="qty qty_'+total+'" type="number" name="qty[]" value="1" required oninput="totalAmount('+total+')"></td>'+
            '<td><input style="text-align: right;" class="rate_'+total+'" type="number" name="rate[]" value="0" required oninput="totalAmount('+total+')"></td>'+
            '<td><input style="text-align: right;" class="amount amount_'+total+'" type="number" name="amount[]" value="0" required readonly></td>'+
            '<td align="center"><span class="btn btn-danger item_remove" onclick="itemRemove(' + total + ')"><i class="fa fa-trash"></i> Delete</span></td>'+
            '</tr>');
        $('.row_count').val(total);
        var itemList = $("#itemList div select").html();
        $('.itemList_'+total).html(itemList);
         $('.chosen-select').chosen();
        $('.chosen-select').trigger("chosen:updated");

        row_sum();
    });

    function itemRemove(i) {
        var total_qty = $('.total_qty').val();
        var total_amount = $('.total_amount').val();

        var quantity = $('.qty_'+i).val();
        var amount = $('.amount_'+i).val();

        total_qty = total_qty - quantity;
        total_amount = total_amount - amount;

        $('.total_qty').val(total_qty.toFixed(2));
        $('.total_amount').val(total_amount.toFixed(2));
        
        $("#itemRow_" + i).remove();
    }

    function totalAmount(i){
         var qty = $(".qty_" + i).val();
        var rate = $(".rate_" + i).val();
        var sum_total = parseFloat(qty) *parseFloat(rate);
        $(".amount_" + i).val(sum_total.toFixed(2));

        row_sum(); 
        netAmount() 
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
        var discountAndVat = parseFloat(discount)+parseFloat(vat);
        net_amount = parseFloat(total_amount)-discountAndVat;
        $('.net_amount').val(net_amount.toFixed(2));
    }

    function row_sum() {
        var total_qty = 0;
        var total_amount = 0;
        $(".qty").each(function () {
            var stvalTotal = parseFloat($(this).val());
            //            console.log(stval);
            total_qty += isNaN(stvalTotal) ? 0 : stvalTotal;
        });

        $(".amount").each(function () {
            var stvalAmount = parseFloat($(this).val());
            //            console.log(stval);
            total_amount += isNaN(stvalAmount) ? 0 : stvalAmount;
        });

        $('.total_qty').val(total_qty.toFixed(2));
        $('.total_amount').val(total_amount.toFixed(2));

    }
      
</script>

@endsection