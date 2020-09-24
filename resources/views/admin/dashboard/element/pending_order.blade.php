<div class="col-lg-8 col-md-8">
    <div class="card orderTable" style="overflow:scroll; height:441px;">
        <div class="card-body">
            <h4 class="card-title" style="float: left;">Pending Orders</h4>
            <h4 class="card-title" style="float: right;">Order Amount: {{$pendingAmount}} BDT</h4>
            <div class="table-responsive">
                <table id="orderTable" class="table table-bordered table-striped"  name="orderTable">
                    <thead class="thead">
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Amount</th>
                            <th class="text-center" width="12%">status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @php
                            $sl = 0;
                        @endphp
                        @foreach ($pendingOrderList as $pendingOrder)
                        @php
                            $sl++;
                        @endphp
                            <tr class="pendingRow_{{ $pendingOrder->id }}">
                                <td>{{$pendingOrder->name}}</td>
                                <td>{{$pendingOrder->phone}}</td>
                                <td>{{$pendingOrder->total_amount}}</td>
                                <td><span class='badge badge-pill badge-info'>{{$pendingOrder->status}}</span></td>
                                <td class="text-nowrap action text-center">
                                    <a href="javascript:void(0)" title="Order status" data-id="{{ $pendingOrder->id }}"> 
                                        <i class="fa fa-shopping-bag text-danger m-r-10"></i> 
                                    </a>

                                    <a href="{{route('view.invoices',$pendingOrder->id)}}" title="Order Details"> <i class="fa fa-eye text-success m-r-10"></i> </a>

                                    <a href="javascript:void(0)" title="Delete" data-id="{{$pendingOrder->id}}"  data-token="{{ csrf_token() }}"> 
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="showShipping" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Order Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="container " id="shippingContent">
                </div>
            </div>
        </div>
    </div>
</div>