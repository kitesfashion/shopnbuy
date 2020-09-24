@extends('admin.layouts.master')

@section('content')
	<form class="form-horizontal" action="{{ route('creditSale.save') }}" method="post" enctype="multipart/form-data">
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
                <button type="submit" class="btn btn-outline-info btn-lg waves-effect" onclick="return save()">
                    <span style="font-size: 16px;">
                        <i class="fa fa-save"></i> Save Data
                    </span>
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group row {{ $errors->has('invoice_no') ? ' has-danger' : '' }}">
                    <label for="inputHorizontalDnger" class="col-sm-4 col-form-label">Invoice No</label>
                    <div class="col-sm-8 ">
                        <input type="hidden" class="form-control form-control-danger" name="payment_type" value="Credit" required readonly/>
                        <input type="text" class="form-control form-control-danger" name="invoice_no" value="{{ $invoice_no }}" required readonly/>
                        @if ($errors->has('invoice_no'))
                            @foreach($errors->get('invoice_no') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>                              
            </div>

            <div class="col-md-4">
                <div class="form-group row {{ $errors->has('invoice_date') ? ' has-danger' : '' }}">
                    <label for="inputHorizontalDnger" class="col-sm-5 col-form-label">Invoice Date</label>
                    <div class="col-sm-7">
                        <input  type="text" class="form-control form-control-danger add_datepicker" name="invoice_date" value="{{ old('invoice_date') }}">
                        @if ($errors->has('invoice_date'))
                            @foreach($errors->get('invoice_date') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group row {{ $errors->has('client') ? ' has-danger' : '' }}">
                    <label for="inputHorizontalDnger" class="col-sm-3 col-form-label">Client</label>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <select class="form-control" id="client" name="client">
                                <option value="">Select Client</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @if ($errors->has('client'))
                            @foreach($errors->get('client') as $error)
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
                        <tr>
                            <td>
                                <select class="form-control form-control-danger chosen-select" name="product_id[]" required="">
                                    <option value=" ">Select Item</option>
                                    <?php
                                        foreach ($products as $product)
                                        {
                                    ?>
                                            <option value="{{$product->id}}">{{$product->name}}
                                                ({{$product->deal_code}})
                                            </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <input style="text-align: right;" class="qty qty_1" type="number" name="qty[]" oninput="totalAmount('1')" required>
                            </td>

                            <td>
                                <input style="text-align: right;" class="rate_1" type="number" name="rate[]" oninput="totalAmount('1')" required>
                            </td>

                            <td>
                                <input style="text-align: right;" class="amount amount_1" type="number" name="amount[]" required readonly>
                            </td>
                        </tr>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Total Quantity</th>
                            <td>
                                <input class="total_qty" type="number" name="total_qty" readonly>
                            </td>

                            <th>Total Amount</th>
                            <td>
                                <input style="text-align: right;" class="total_amount" type="number" name="total_amount" readonly>
                            </td>
                            
                            <td align="center">
                                <input type="hidden" class="row_count" value="1">
                                <span class="btn btn-success add_item">
                                    <i class="fa fa-plus-circle"></i> Add More
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td rowspan="3" colspan="2">
                                <div class="row" style="margin: 5px;">
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

                                <div class="row" style="margin: 5px;">
                                    <div class="col-md-3">Discount As %</div>
                                    <div class="col-md-9">
                                        <input style="text-align: right;" class="discount_percentage" type="number" name="discount_percentage" oninput="netAmount()">
                                    </div>
                                </div>
                            </td>

                            <th>Discount</th>
                            <td>
                                <input style="text-align: right;" class="discount" type="number" name="discount" oninput="netAmount()" readonly="">
                            </td>

                            <td rowspan="5" class="text-right" style="padding-top: 5px;">
                                <div style="padding-top: 10px;">
                                    <button type="submit" class="btn btn-outline-info btn-lg waves-effect" onclick="return save()">
                                        <span style="font-size: 16px;">
                                            <i class="fa fa-save"></i> Save Data
                                        </span>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <th>Vat</th>
                            <td>
                                <input style="text-align: right;" class="vat" type="number" name="vat" oninput="netAmount()" readonly>
                            </td>
                        </tr>

                        <tr>
                            <th>Net Amount</th>
                            <td>
                                <input style="text-align: right;" class="net_amount" type="number" name="net_amount" readonly>
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
        function save()
        {
            var client = $('#client').val();
            if (client == "")
            {
                alert("Client Can't Be Empty");
                return false;
            }
        }

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