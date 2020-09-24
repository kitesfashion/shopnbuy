@extends('admin.layouts.master')

@php
    $months = array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December');
@endphp

@section('content')
    <div class="modal-body">
        <form class="form-horizontal" action="{{ route('salesCollectionOutstanding.index') }}" method="post" enctype="multipart/form-data">
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
                <div class="col-md-6">
                    <label for="customer">Customers</label>
                    <div class="form-group">
                        <select class="form-control chosen-select" id="customer" name="customer[]" multiple>
                            @foreach ($customers as $customerInfo)
                                @php
                                    $select = "";
                                    if ($customer)
                                    {
                                        if (in_array($customerInfo->id, $customer))
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                    }
                                @endphp
                                <option value="{{ $customerInfo->id }}" {{ $select }}>{{ $customerInfo->name }}</option>
                            @endforeach
                        </select>
                    </div>  
                </div>

                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="month">Month</label>
                            <select class="form-control" id="month" name="month">
                                <option value="">Select Month</option>
                                @php
                                    $select = "";
                                    if ($month == "")
                                    {
                                        $month = date('m');
                                    }
                                @endphp
                                @foreach ($months as $key => $value)
                                    @php
                                        if ($key == $month)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                    @endphp
                                    <option value="{{ $key }}" {{ $select }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="from_date">Year</label>
                            <select class="form-control" id="year" name="year">
                                <option value="">Select Year</option>
                                @php
                                    $select = "";
                                    if ($year == "")
                                    {
                                        $year = date('Y');
                                    }
                                    $currentYear = date('Y');
                                @endphp
                                @for ($i = $currentYear; $i >= 1900; $i--)
                                    @php
                                        if ($i == $year)
                                        {
                                            $select = "selected";
                                        }
                                        else
                                        {
                                            $select = "";
                                        }
                                    @endphp
                                    <option value="{{ $i }}" {{ $select }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>                                  
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-right" style="padding-bottom: 10px;">
                    <button type="submit" class="btn btn-outline-info btn-lg waves-effect">
                        <span style="font-size: 16px;">
                            <i class="fa fa-save"></i> Serach Data
                        </span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12 form-group">
            <div class="card" style="margin-bottom: 0px;">              
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6"><h4 class="card-title">{{ $title }}</h4></div>
                        <div class="col-md-6 text-right">
                            <form class="form-horizontal" action="{{ route('salesCollectionOutstanding.print') }}" target="_blank" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="year" value="{{ $year }}">
                                <input type="hidden" name="month" value="{{ $month }}">

                                @if ($customer)
                                    @foreach ($customer as $customerInfo)
                                        <input type="hidden" name="customer[]" value="{{ $customerInfo }}">
                                    @endforeach
                                @endif

                                <button type="submit" class="btn btn-info btn-lg waves-effect">
                                    <span style="font-size: 16px;">
                                        <i class="fa fa-save"></i> Print Data
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @php
                        $message = Session::get('msg');
                        if (isset($message))
                        {
                            echo "<div style='display:inline-block;width: auto;' class='alert alert-success'><strong>" .$message."</strong></div>";
                        }
                        Session::forget('msg');
                        // echo $fromDate;
                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";
                    @endphp

                    <div class="table-responsive">
                        <table id="dataTable" name="dataTable" class="table table-bordered">
                            <thead>
                            	<tr>
                                    <th width="20px" rowspan="2">Sl</th>
                            		<th rowspan="2">Client Name</th>
                            		<th rowspan="2" width="120px">Previous Years</th>
                            		<th colspan="3">For The Year {{ $year }}</th>
                            		<th colspan="3">For The Month {{ date('F', mktime(0, 0, 0,$month, 10)) }}</th>
                            		<th rowspan="2" width="120px">Current Balance</th>
                            	</tr>
                                <tr>
                                	<th width="90px">Sales</th>
                                	<th width="90px">Realization</th>
                                	<th width="90px">Inc/Dec</th>
                                	<th width="90px">Sales</th>
                                	<th width="90px">Realization</th>
                                	<th width="90px">Inc/Dec</th>
                                </tr>
                            </thead>

                            <tbody id="tbody">
                                @php
                                    $sl = 0;
                                    $balance = 0;
                                    $currentId = 0;
                                @endphp

                                @foreach ($salesCollections as $salesCollection)
                                    @php
                                        $sl++;
                                        $yearlySales = 0;
                                        $yearlyCollection = 0;
                                        $monthlySales = 0;
                                        $monthlyCollection = 0;                                    
                                    @endphp
                                    @if ($salesCollection->customerId != $currentId)
                                        @foreach ($salesCollections as $value)
                                            @php
                                                if ($salesCollection->customerId == $value->customerId)
                                                {
                                                    $yearlySales = $yearlySales + $value->yearlySales;
                                                    $yearlyCollection = $yearlyCollection + $value->yearlyCollection;
                                                    $monthlySales = $monthlySales + $value->monthlySales;
                                                    $monthlyCollection = $monthlyCollection + $value->monthlyCollection;
                                                }
                                                $currentId = $salesCollection->customerId;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td>{{ $sl }}</td>
                                            <td>{{ $salesCollection->customerName }}</td>
                                            <td style="text-align: right;">{{ $salesCollection->previousSales - $salesCollection->previousCollection }}</td>
                                            <td style="text-align: right;">{{ $yearlySales }}</td>
                                            <td style="text-align: right;">{{ $yearlyCollection }}</td>
                                            <td style="text-align: right;">{{ $yearlySales - $yearlyCollection }}</td>
                                            <td style="text-align: right;">{{ $monthlySales }}</td>
                                            <td style="text-align: right;">{{ $monthlyCollection }}</td>
                                            <td style="text-align: right;">{{ $monthlySales - $monthlyCollection }}</td>
                                            <td style="text-align: right;">{{ $salesCollection->previousSales - $salesCollection->previousCollection + $yearlySales - $yearlyCollection }}</td>
                                        </tr>
                                    @endif                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')

    <script type="text/javascript">
        $(document).ready(function() {
            var updateThis ;

            var table = $('#dataTable').DataTable( {
                "order": [[ 0, "asc" ]]
            } );

            table.on('order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                } );
            } ).draw();
        });
    </script>
@endsection