@extends('admin.layouts.master')

@section('content')
	<form class="form-horizontal" action="{{ route('cashSale.update') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="row">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div style="display:inline-block; width: auto;" class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right" style="padding-bottom: 10px;">
                <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
                    <span style="font-size: 16px;">
                        <i class="fa fa-save"></i> Update Data
                    </span>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group row {{ $errors->has('invoice_no') ? ' has-danger' : '' }}">
                    <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Invoice No</label>
                    <div class="col-sm-9">
                        <input type="hidden" class="form-control form-control-danger" name="payment_type" value="Cash" required readonly/>
                        <input type="hidden" class="form-control form-control-danger" name="cash_sale_id" value="{{ $cashSaleId }}" required readonly/>
                        <input type="text" class="form-control form-control-danger" name="invoice_no" value="{{ $cashSale->invoice_no }}" required readonly/>
                        @if ($errors->has('invoice_no'))
                            @foreach($errors->get('invoice_no') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>                              
            </div>

            <div class="col-md-6">
                <div class="form-group row {{ $errors->has('invoice_date') ? ' has-danger' : '' }}">
                    <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Invoice Date</label>
                    <div class="col-sm-9">
                        <input  type="text" class="form-control form-control-danger add_datepicker" name="invoice_date" value="{{ $cashSale->invoice_date }}">
                        @if ($errors->has('invoice_date'))
                            @foreach($errors->get('invoice_date') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped gridTable" >
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
                        @php $i = 0; @endphp
                        @foreach ($cashSaleItems as $cashSaleItem)
                            @php $i++; @endphp
                            <tr id="itemRow_{{ $i }}">
                                <td>
                                    <input type="hidden" name="product_id[]" value="{{$cashSaleItem->product_id}}">
                                    <input class="" type="text" name="product_name[]" value="{{$cashSaleItem->product_name}}" readonly required>
                                </td>
                                <td>
                                    <input style="text-align: right;" class="qty qty_{{ $i }}" type="number" name="qty[]" oninput="totalAmount({{ $i }})" value="{{ $cashSaleItem->item_quantity }}" required>
                                </td>

                                <td>
                                    <input style="text-align: right;" class="rate_{{ $i }}" type="number" name="rate[]" oninput="totalAmount({{ $i }})" value="{{ $cashSaleItem->item_rate }}" required>
                                </td>

                                <td>
                                    <input style="text-align: right;" class="amount amount_{{ $i }}" type="number" name="amount[]" value="{{ $cashSaleItem->item_price }}" required readonly>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Total Quantity</th>
                            <td>
                                <input class="total_qty" type="number" name="total_qty" readonly>
                            </td>

                            <th>Total Amount</th>
                            <td>
                                <input style="text-align: right;" class="total_amount" type="number" name="total_amount" value="{{ $cashSale->invoice_amount }}" readonly>
                            </td>
                            
                            <td align="center">
                                <input type="hidden" class="row_count" value="{{ $i }}">
                                <span class="btn btn-success add_item">
                                    <i class="fa fa-plus-circle"></i> Add More
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="5" colspan="2">
                                <div class="row" style="margin: 10px;">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" value="fixed" name="discountType"> Fixed Discount
                                        </label>
                                        &nbsp;&nbsp;
                                        <label class="radio-inline">
                                            <input type="radio" value="percentage" name="discountType" checked> Discount (%)
                                        </label>
                                    </div>
                                </div>

                                <div class="row" style="margin: 10px;">
                                    <div class="col-md-3">Discount As %</div>
                                    <div class="col-md-9">
                                        <input style="text-align: right;" class="discount_percentage" type="number" name="discount_percentage" oninput="netAmount()" value="{{ $cashSale->discount_as }}">
                                    </div>
                                </div>
                            </td>

                            <th>Discount</th>
                            <td>
                                <input style="text-align: right;" class="discount" type="number" name="discount" oninput="netAmount()" value="{{ $cashSale->discount_amount }}" readonly="">
                            </td>

                            <td rowspan="5" class="text-right" style="padding-top: 5px;">
                                <div style="padding-top: 10px;">
                                    <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
                                        <span style="font-size: 16px;">
                                            <i class="fa fa-save"></i> Update Data
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>Vat</th>
                            <td>
                                <input style="text-align: right;" class="vat" type="number" name="vat" oninput="netAmount()"value="{{ $cashSale->vat_amount }}" readonly>
                            </td>
                        </tr>

                        <tr>
                            <th>Net Amount</th>
                            <td>
                                <input style="text-align: right;" class="net_amount" type="number" name="net_amount" value="{{ $cashSale->net_amount }}" readonly>
                            </td>
                        </tr>

                        <tr>
                            <th>Customer Paid</th>
                            <td>
                                <input style="text-align: right;" class="customer_paid" type="number" name="customer_paid" oninput="netAmount()" value="{{ $cashSale->customer_paid }}">
                            </td>
                        </tr>

                        <tr>
                            <th>Change Amount</th>
                            <td>
                                <input style="text-align: right;" class="change_amount" type="number" name="change_amount" value="{{ $cashSale->change_amount }}" readonly>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </form>

    <div id="itemList" style="display:none">
        <div class="input select">
            <select>
                <option value=" ">Select Item</option>
                <?php
                    foreach ($products as $product)
                    {
                ?>
                    <option value="{{$product->id}}">{{$product->name}} ({{$product->deal_code}})</option>
                <?php
                    }
                ?>
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
                '<td><input style="text-align: right;" class="qty qty_'+total+'" type="number" name="qty[]" required oninput="totalAmount('+total+')"></td>'+
                '<td><input style="text-align: right;" class="rate_'+total+'" type="number" name="rate[]" required oninput="totalAmount('+total+')"></td>'+
                '<td><input style="text-align: right;" class="amount amount_'+total+'" type="number" name="amount[]" required readonly></td>'+
                '<td align="center"><span class="btn btn-danger item_remove" onclick="itemRemove(' + total + ')"><i class="fa fa-trash"></i> Delete</span></td>'+
                '</tr>');
            $('.row_count').val(total);
            var itemList = $("#itemList div select").html();
            $('.itemList_'+total).html(itemList);
            $('.chosen-select').chosen();
            $('.chosen-select').trigger("chosen:updated");
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

            netAmount();

            $("#itemRow_" + i).remove();
        }

        $("input[type='radio']").click(function(){
            var radioValue = $("input[name='discountType']:checked").val();
            if(radioValue == "fixed")
            {
                $('.discount_percentage').prop('readonly', true);
            	$('.discount_percentage').val("");
            	$('.discount').prop('readonly', false);
            }

            if (radioValue == "percentage")
            {
            	$('.discount').prop('readonly', true);
                $('.discount').val("");
                $('.discount_percentage').prop('readonly', false);
            }
        });

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

            if($(".discount_percentage").val() == '')
            {
                var discount_percentage = 0;
            }
            else
            {
                var discount_percentage = parseFloat($(".discount_percentage").val());
                var total_amount = parseFloat($('.total_amount').val());
                var discount = (total_amount * discount_percentage)/100;
                $('.discount').val(discount.toFixed(2));
            }

            if($(".discount").val() == '')
            {
                var discount = 0;
            }
            else
            {
                var discount = $(".discount").val();
            }

            // if($(".vat").val() == '')
            // {
            //     var vat = 0;
            // }
            // else
            // {
            //     var vat = $(".vat").val();
            // }

            var vat = (parseFloat($(".total_amount").val()) * 4.5)/100;
            $(".vat").val(vat.toFixed(2));

            net_amount = (parseFloat(total_amount)+parseFloat(vat))-parseFloat(discount);
            $('.net_amount').val(net_amount.toFixed(2));

            if ($(".customer_paid").val() != '')
            {                
                var customer_paid = parseFloat($(".customer_paid").val());

                var change_amount = customer_paid - net_amount;
                $(".change_amount").val(change_amount.toFixed(2));
            }
        }

        function row_sum() {
            var total_qty = 0;
            var total_amount = 0;
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

            $('.total_qty').val(total_qty.toFixed(2));
            $('.total_amount').val(total_amount.toFixed(2));
        }          
    </script>
@endsection