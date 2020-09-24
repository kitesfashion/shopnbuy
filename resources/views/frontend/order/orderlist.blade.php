@extends('frontend.master')

@section('mainContent')
    <app-register _nghost-c14="">
        <div _ngcontent-c14="" class="row bg-grey">
            <div _ngcontent-c14="" class="col-md-12 {{-- offset-md-1 --}}">
                <div class="cart-grid row">
                    <div class="cart-grid-body col-xs-12 col-lg-8">
                        <div class="card cart-container">
                            <div class="card-block">
                                <h2 style="padding-left: 15px;">Order Summary</h2>
                            </div>
                            <hr class="separator">
                            <div class="cart-overview js-cart">
                                <div class="table-responsive" style="padding: 20px;">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th width="60px" class="center" style="font-weight: bold;" >SL</th>
                                                <th class="center" style="font-weight: bold;">Total</th>
                                                <th width="150px" class="text-center" style="font-weight: bold;">Order Status</th>
                                                <th width="60px" class="text-center"style="font-weight: bold;">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
                                            <?php
                                                $i = 0;
                                            ?>
                                            @foreach($orderlist as $list)
                                                <?php
                                                $customerId = Session::get('customerId');
                                                foreach ($orderlist as $order) {
                                                    $customer_group =  DB::table('customer_group_sections')->where(['customerGroupId'=>@$customers->clientGroup])
                                                    ->where(['productId'=>$order->product_id])
                                                    ->first();

                                                    if(@$customer_group->customerGroupPrice){
                                                        $price = $customer_group->customerGroupPrice;
                                                    }else{
                                                        $price = $order->price;
                                                    }

                                                    $subtotal = $price*$order->qty;
                                                }

                                              /* if(@$customer_group->customerGroupId){
                                                $total = $customer_group->customerGroupPrice*$order->qty;
                                                }else{
                                                    $total = $list->total;  
                                                }*/

                                                ?>
                                                <tr>
                                                    <td class="text-center">{{++$i}}</td>
                                                    <td>৳ {{$list->total_amount}}</td>
                                                    <td class="text-center">{{$list->status}}</td>
                                                    <td class="text-center">
                                                        <a href="{{route('order.details',$list->id)}}" data-toggle="tooltip" data-original-title="View Details" data-id=""> 
                                                            <i class="fa fa-eye text-success m-r-10"></i> 
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
                    <div class="cart-grid-right col-xs-12 col-lg-4">
                        <div class="card cart-summary">
                            @include('frontend.customer.profileLink')
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </app-register>
@endsection



  


