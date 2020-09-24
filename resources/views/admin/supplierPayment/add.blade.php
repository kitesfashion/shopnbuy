@extends('admin.layouts.master')

@section('content')

@php
    use App\SupplierPayment;
    use App\CreditPurchase;
    $supplierPayment = SupplierPayment::whereRaw('id = (select max(`id`) from supplier_payments)')->first();
    if(!$supplierPayment)
    {
        $payment_no = 1000000+1;
    }
    else
    {
        $payment_no = 1000000+$supplierPayment->id+1;
    }

    $paymentTypes = array('Cash' => 'Cash', 'Check' => 'Check', 'Others' => 'Others');
@endphp
<form class="form-horizontal" action="{{ route('supplierPayment.save') }}" method="POST" enctype="multipart/form-data" id="newMenu" name="newMenu">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="row">
               <div class="col-6">
                    <label for="supplier">Supplier</label>
                    <div class="form-group {{ $errors->has('supplier_id') ? ' has-danger' : '' }}">
                        <select class="form-control form-control-danger chosen-select supplier" name="supplier_id" required="">
                            <option value=" ">Select Supplier</option>
                            <?php
                                foreach ($vendors as $vendor) {
                                $supplierPayments = SupplierPayment::where('supplier_id',$vendor->id)->sum('payment_now');
                                $supplierInvoice = CreditPurchase::where('supplier_id',$vendor->id)->first();
                                if($supplierPayments != @$supplierInvoice->credit_invoice OR empty($supplierPayments)){
                            ?>
                            <option value="{{$vendor->id}}">{{$vendor->vendorName}}</option>
                            <?php } } ?>
                        </select>
                        @if ($errors->has('supplier_id'))
                        @foreach($errors->get('supplier_id') as $error)
                        <div class="form-control-feedback">{{ $error }}</div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <label for="payment-no">Payment No</label>
                    <div class="form-group {{ $errors->has('payment_no') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger" name="payment_no" value="{{$payment_no}}" required readonly>
                        @if ($errors->has('payment_no'))
                            @foreach($errors->get('payment_no') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
               <div class="col-6">
                    <label for="payment-date">Payment Date</label>
                    <div class="form-group {{ $errors->has('payment_date') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger add_datepicker" name="payment_date" required readonly>
                        @if ($errors->has('payment_date'))
                            @foreach($errors->get('payment_date') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <label for="current-due">Current Due</label>
                    <div class="form-group {{ $errors->has('current_due') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger current_due" name="current_due" value="0" required readonly>
                        @if ($errors->has('current_due'))
                            @foreach($errors->get('current_due') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="payment-now">Payment Now</label>
                    <div class="form-group {{ $errors->has('payment_now') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger payment_now" name="payment_now" oninput="Balance()" value="0" required>
                        @if ($errors->has('payment_now'))
                            @foreach($errors->get('payment_now') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <label for="balance">Balance</label>
                    <div class="form-group {{ $errors->has('balance') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger balance" name="balance" value="0" required readonly>
                        @if ($errors->has('balance'))
                            @foreach($errors->get('balance') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <label for="money-receipt">Money Receipt</label>
                    <div class="form-group {{ $errors->has('money_receipt') ? ' has-danger' : '' }}">
                        <input type="text" class="form-control form-control-danger" name="money_receipt">
                        @if ($errors->has('money_receipt'))
                            @foreach($errors->get('money_receipt') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-6">
                    <label for="payment-method">Payment Method</label>
                    <div class="form-group {{ $errors->has('payment_type') ? ' has-danger' : '' }}">
                        <select class="form-control form-control-danger chosen-select payment_type" name="payment_type" required="">
                            <option value=" ">Select Payment Type</option>
                            <?php
                                foreach ($paymentTypes as $key=>$value) {
                            ?>
                            <option value="{{$key}}">{{$value}}</option>
                            <?php } ?>
                        </select>
                        @if ($errors->has('payment_type'))
                            @foreach($errors->get('payment_type') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
               <div class="col-12">
                    <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Rmarks</label>
                    <div class="form-group {{ $errors->has('remarks') ? ' has-danger' : '' }}">
                        <textarea class="form-control" name="remarks" rows="8"></textarea>
                        @if ($errors->has('remarks'))
                            @foreach($errors->get('remarks') as $error)
                                <div class="form-control-feedback">{{ $error }}</div>
                            @endforeach
                        @endif
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
@endsection

@section('custom-js')
    <script src="{{ asset('/public/admin-elite/assets/node_modules/datatables/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            var updateThis ;
                //Get Purchase order id
                $(".supplier").change(function () {
                    var supplier_id = $('.supplier').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type : 'POST',
                        url: "{{route('getSupplierInfo')}}",
                        data : {
                            supplier_id : supplier_id,
                        },
                        success : function(data){
                            var supplierInvoice = data.supplierInvoice;
                            var supplier_payments_current_due = data.supplier_payments_current_due;

                            if(supplier_payments_current_due == 0)
                            {
                                var current_due = supplierInvoice;
                            }
                            else
                            {
                                var current_due =parseFloat(supplierInvoice) - parseFloat(supplier_payments_current_due);
                            }

                            $(".current_due").val(current_due);
                            Balance();
                        }
                    })
                }); 


                $("form").submit(function(e){
                    var supplier = $(".supplier").val();
                    var payment_type = $(".payment_type").val();
                    var supplier = $.trim(supplier);
                    var payment_type = $.trim(payment_type);

                    if(supplier == '')
                    {
                        alert('Please Select Supplier !');
                        e.preventDefault();
                    }

                    if(payment_type == '')
                    {
                        alert('Please Select Payment Method !');
                        e.preventDefault();
                    }
                });            
            });        
    </script>

    <script type="text/javascript">
        function Balance(){
            var current_due = $(".current_due").val();
            var payment_now;

            if ($(".payment_now").val() == "")
            {
                payment_now = 0;
            }
            else
            {
                payment_now = $('.payment_now').val();
            }

            var balance = parseFloat(current_due) - parseFloat(payment_now);
            if (balance == current_due)
            {
                $(".balance").val("0");            
            }
            else
            {
                $(".balance").val(balance.toFixed(2));
            }        
        }      
    </script>
@endsection