@extends('frontend.master')

@section('mainContent')
    <app-register _nghost-c14="">
        <div _ngcontent-c14="" class="row bg-grey">
            <div _ngcontent-c14="" class="col-md-12 {{-- offset-md-1 --}}">
                <div class="cart-grid row">
                    <div class="cart-grid-body col-xs-12 col-lg-8">
                        <div class="card cart-container" style="padding: 20px;">
                            <?php
                                $message = Session::get('msg');
                                if (isset($message)) {
                                    echo $message;
                                }
                            ?>
                            <h4 class="checkout-subtitle" style="font-weight: bold;">Profile Deatils</h4>
                            <form action="{{route('customer.update')}}" class="register-form outer-top-xs" role="form" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1" style="font-weight: bold;">Full Name </label>
                                    <input type="text" name="name" value="{{$customers->name}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
                                </div>
                                <input type="hidden" name="customerId" value="{{$customers->id}}">
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2" style="font-weight: bold;">Email Address </label>
                                    <input type="email" name="email"  value="{{$customers->email}}" class="form-control unicase-form-control text-input" id="exampleInputEmail2" required>
                                </div>        
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1" style="font-weight: bold;">Phone Number </label>
                                    <input type="text" name="mobile"  value="{{$customers->mobile}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail1" style="font-weight: bold;">Your Address </label>
                                    <input type="text" name="address"  value="{{$customers->address}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
                                </div> 
                                <button type="submit" class="btn-upper btn btn-primary checkout-page-button" style="font-weight: bold;">Update Profile</button>
                            </form>
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

