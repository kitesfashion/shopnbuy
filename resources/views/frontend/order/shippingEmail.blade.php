@extends('frontend.master')

@section('mainContent')    

    <app-register _nghost-c14="">
        <div class="row bg-grey">
            <div class="col-md-7 offset-md-2">
                <div class="card mt-4 mb-4">
                  <div class="card-body">
                    <section class="login-form">
                        <?php
                        $message = Session::get('message');
                          if (isset($message)) {
                            echo $message;
                          }
                          Session::forget('message');
                        ?>

                        <h2 class=""font-size:20px; font-weight: bold>Email Address / Phone No</h2>
                        <form action="{{url('/view-order')}}" method="post" class="register-form outer-top-xs" role="form">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" name="custemail" placeholder="Enter your email or phone no" value="{{old('custemail')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail2" required>
                            </div>

                            <button type="submit" class="btn-upper btn btn-primary checkout-page-button">GO</button>
                        </form>
                    </section>
                  </div>
                </div>    
            </div>
        </div>
    </app-register>
@endsection

