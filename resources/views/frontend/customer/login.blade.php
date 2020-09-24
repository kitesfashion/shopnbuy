@extends('frontend.master')

@section('mainContent')
    <app-register _nghost-c14="">
        <div _ngcontent-c14="" class="row bg-grey">
            <div _ngcontent-c14="" class="col-md-10 offset-md-1">
                <div _ngcontent-c14="" class="card mt-4 mb-4">
                    <div _ngcontent-c14="" class="card-body">
                        @php
                            $message = Session::get('message');
                              if (isset($message)) {
                                echo $message;
                              }
                            Session::forget('message');
                        @endphp
                        <h4 _ngcontent-c14="">Login To Your Account</h4>
                        <form  action="{{route('customer.dologin')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="setReview" value="{{@$setReview}}">
                            <div _ngcontent-c14="" class="form-group">
                                <label _ngcontent-c14="" for="name">Email Address</label>
                                <input _ngcontent-c14="" class="form-control ng-untouched ng-pristine ng-valid" id="custemail" name="custemail" type="email" value="{{old('custemail')}}" required>
                            </div>
                            
                            <div _ngcontent-c14="" class="form-group">
                                <label _ngcontent-c14="" for="zone">Password</label>
                                <input _ngcontent-c14="" class="form-control ng-untouched ng-pristine ng-valid" name="password" type="password" required>
                            </div>
                            <div _ngcontent-c14="" class="form-group">
                               <button class="btn btn-primary" type="submit" class="form-control-submit">
                                    Login
                                </button>
                                <a class="btn btn-danger" href="{{route('customer.registration')}}" rel="nofollow">
                                  Create an Account
                                </a>

                                <a class="btn btn-warning" href="{{route('password.forget')}}" rel="nofollow">
                                  Forgot your password ?
                                </a>
                            </div>
                        </form>
                    </div>
                </div>      
            </div>
        </div>
    </app-register>
@endsection

