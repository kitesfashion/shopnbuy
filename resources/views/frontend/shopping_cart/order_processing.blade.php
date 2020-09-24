@extends('frontend.master')

@section('mainContent')
<form action="{{route('order.save')}}" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="total_amount" value="{{Cart::subtotal()}}">
  <input type="hidden" name="delivery_zone_id">
  <input type="hidden" name="delivery_zone_name">
  <input type="hidden" name="shipping_location_id">
  <input type="hidden" name="shipping_location_name">
  <app-register _nghost-c14="">
    <div class="row bg-grey">
      <div class="col-md-6">
        <div class="card mt-4 mb-4">
          <div class="card-body">
            <h4>SHIPPING ADDRESS</h4>

            <div class="form-group">
              <label for="name">Full Name <span class="required">*</span></label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="text" name="name" required="1">
            </div>

            <div class="form-group">
              <label for="phone">Phone Number <span class="required">*</span></label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="text" name="phone" required="1">
            </div>
            
            <div class="form-group">
              <label for="email">Email Address (To receive the Invoice/Bill)</label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="email" name="email">
            </div>

            <div class="form-group">
              <label for="shipping_address">Address <span class="required">*</span></label>
              <input class="form-control ng-untouched ng-pristine ng-valid" type="text" name="shipping_address" required="1">
            </div>

            <div class="form-group">
              <button class="btn add-to-bag">Submit</button>
            </div>
          </div>
        </div>    
      </div>

      <div class="col-md-6">
        <div class="card mt-4 mb-4">
          <div class="card-body">
            <h4>ORDER SUMMARY</h4>
            @php
              foreach(Cart::content() as $carts){
                if(file_exists($carts->options->image)){
                    $image = asset(@$carts->options->image);
                }else{
                    $image = $noImage;
                }
            @endphp
              <div _ngcontent-c5="" class="card m-1 p-1">
                <div _ngcontent-c5="" class="d-flex align-items-center">
                  <img _ngcontent-c5="" src="{{$image}}" style="height: 60px">
                  <div _ngcontent-c5="" class="cart-calc">
                    <p _ngcontent-c5="" class="product">
                      {{str_limit($carts->name,30)}} x <span>{{$carts->qty}}</span>
                      <span _ngcontent-c8="" class="tooltiptext">{{$carts->name}} x <span>{{$carts->qty}}</span>
                    </p>
                    
                    <p _ngcontent-c5="">৳ {{$carts->price}}</p>
                  </div>
                </div>
                <div _ngcontent-c5="" class="sub-total">
                  <p _ngcontent-c5="">৳ {{$carts->qty*$carts->price}}</p>
                </div>
              </div>
            @php
              }
            @endphp
          </div>
        </div>   

        <div class="card mt-4 mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <span>{{Cart::count()}} Item</span>
              </div>
              <div class="col-md-6">
                <span class="pull-right">Total: {{Cart::subtotal()}}</span>
              </div>
            </div>
          </div>
        </div> 
      </div>
    </div>
  </app-register>
</form>
@endsection

@section('custom_js')
<script type="text/javascript">
  $( "input[name*='delivery_zone_id']" ).val($.cookie("deliveryZoneId"));
  $( "input[name*='delivery_zone_name']" ).val($.cookie("deliveryZoneName"));
  $( "input[name*='delivery_area_id']" ).val($.cookie("deliveryAreaId"));
  $( "input[name*='delivery_area_name']" ).val($.cookie("deliveryAreaName"));
</script>
@endsection

