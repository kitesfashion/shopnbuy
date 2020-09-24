@extends('frontend.master')

@section('mainContent')
    
<app-register _nghost-c14="">
	<div _ngcontent-c14="" class="row bg-grey">
		<div _ngcontent-c14="" class="col-md-10 offset-md-1">
			<div _ngcontent-c14="" class="card mt-4 mb-4">
				<div _ngcontent-c14="" class="card-body">
					@php
                        $message = Session::get('msg');
                          if (isset($message)) {
                            echo $message;
                          }
                        Session::forget('msg');
                    @endphp
					<h4 _ngcontent-c14="">CREATE AN ACCOUNT</h4>
					<form action="{{route('customer.register')}}" method="post" role="form">
			        {{ csrf_field() }}
				        <input type="hidden" name="setReview" value="{{@$setReview}}">
						<div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Full Name <span>*</span></label>
		                    <input type="text" name="name" placeholder="Enter your full name" value="{{old('name')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
		                </div>
		                <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
		                    <input type="email" name="email" placeholder="Enter your valid email address" value="{{old('email')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail2" required>
		                </div>

		                <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Phone Number <span>*</span></label>
		                    <input type="text" name="mobile" placeholder="Enter your valid phone number" value="{{old('mobile')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
		                </div>

		                <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Your Address <span>*</span></label>
		                    <input type="text" name="address" placeholder="Enter your address" value="{{old('address')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
		                </div>


		                <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Password <span>*</span></label>
		                    <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
		                </div>
		                <div class="form-group">
		                    <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
		                    <input type="password" name="confirmPassword" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
		                </div>
						<div _ngcontent-c14="" class="form-group">
							<button _ngcontent-c14="" class="btn btn btn-primary">Submit</button>
							<a href="{{route('customer.login',['setReview'=>@$setReview])}}"
							 type="submit" class="btn-upper btn btn-success">Already Have an Account ?
							</a>
						</div>
					</form>
				</div>
			</div>		
		</div>
	</div>
</app-register>
@endsection

