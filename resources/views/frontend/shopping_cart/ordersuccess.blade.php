@extends('frontend.master')

@section('mainContent')

<?php
	$customerId = Session::get('customerId');
?>	
	<app-register _nghost-c14="">
		<div class="row bg-grey">
			<div class="col-md-12">
				<div class="card mt-4 mb-4">
				  <div class="card-body">
				    <div class="x-text text-center">
						<h2 class="text-success" style=" font-size:20px; font-weight: bold">Your order is complete</h2>
						<p style="font-size: 14px;">Thank's for visite our website. </p>
						<div class="shopping-cart-btn">
							<span class="">
								<a style="color: #fff;font-size: 20px; border-radius: 5px" href="{{route('home.index')}}" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
								
							</span>
						</div>
						<br>
						<?php if(!isset($customerId)){ ?>
								<a href="{{url('/shipping-email')}}" class="btn btn-success" style="font-size: 16px;color: #fff;border-radius: 5px"> You can check your order summary</a>
						<?php }else{ ?>
							<a href="{{route('customer.order')}}"  class="btn btn-success" style="font-size: 16px;color: #fff;border-radius: 5px"> You can now check your order</a>
						<?php } ?>
					</div>
				  </div>
				</div>    
			</div>
		</div>
	</app-register>
@endsection
