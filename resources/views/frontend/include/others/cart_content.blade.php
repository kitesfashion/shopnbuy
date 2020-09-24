 @php
     $customerId = Session::get('customerId');
 @endphp
 <style>
.dropbtn {
  background-color: #2ab574;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

.dropup {
  position: relative;
  display: inline-block;
}

.dropup-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  bottom: 50px;
  z-index: 1;
}

.dropup-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropup-content a:hover {background-color: #ccc}

.dropup:hover .dropup-content {
  display: block;
}

.dropup:hover .dropbtn {
  background-color: #2ab574;
}
</style>
 <div _ngcontent-c0="" class="row bg-grey authcontainershop">
    <div _ngcontent-c0="" class="col-md-4 offset-md-4">
        <div _ngcontent-c0="" class="card">
            <button _ngcontent-c0="" class="close"></button>
            <div _ngcontent-c0="" class="mt-4 mb-4 authdialogshop">
                <div _ngcontent-c0="" class="card-body">
                    <h4 _ngcontent-c0="">ADD ITEM/S TO YOUR CART</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div _ngcontent-c0="" class="container d-block d-md-none d-xl-none" id="mobile-footer" style="max-width: 100%;">
    <div _ngcontent-c0="" class="row">

        
        <div _ngcontent-c0="" class="col text-center p-1 pointer">
            @if(isset($customerId))
            <div class="dropup">
                <div _ngcontent-c0="" class="icon text-center text-white">
                    <i _ngcontent-c1="" aria-hidden="true" class="fa fa-user"></i>
                    <button class="dropbtn">Account</button>
                </div>
              <div class="dropup-content">
                <a _ngcontent-c1="" href="{{route('customer.profile',$customerId)}}">Profile</a>
                <a _ngcontent-c1="" href="{{route('customer.order')}}">Order History</a>
                <a _ngcontent-c1="" href="{{route('customer.logout')}}">Logout</a>
              </div>
            </div>
            @else
                <a href="{{ route('customer.login') }}">
                    <div _ngcontent-c0="" class="icon text-center text-white">
                        <i _ngcontent-c0="" class="fa fa-sign-in fa-2x"></i>
                    </div>
                    <div _ngcontent-c0="" class="text">
                        <h6 _ngcontent-c0="" class="text-white">Login</h6>
                    </div>
                </a>
            @endif
        </div>

        <!---->

        <div _ngcontent-c0="" class="col text-center p-1">
            {{-- <div _ngcontent-c0="" class="icon text-center text-white">
                <i _ngcontent-c0="" class="fa"><img _ngcontent-c0="" alt="shop-now" id="custom_icon" src="https://www.meenaclick.com/assets/img/home/footer-cart.svg"></i>
            </div>
            <div _ngcontent-c0="" class="text">
                <h6 _ngcontent-c0="" class="text-white">Shop Now</h6>
            </div> --}}
        </div>

        <div _ngcontent-c0="" class="col text-center cart-toggling p-1">
            <div _ngcontent-c0="" class="icon text-center text-white">
                <i _ngcontent-c0="" class="fa fa-shopping-cart fa-2x"></i>
            </div>
            <div _ngcontent-c0="" class="text">
                <h6 _ngcontent-c0="" class="text-white">Cart</h6>
            </div>
        </div>
    </div>
</div>