@extends('frontend.master')

@section('mainContent')
	<app-register _nghost-c14="">
	    <div _ngcontent-c14="" class="row bg-grey">
	        <div _ngcontent-c14="" class="col-md-10 offset-md-1">
	            <div _ngcontent-c14="" class="card mt-4 mb-4">
	                <div _ngcontent-c14="" class="card-body">
	                    <?php
							$message = Session::get('msg');
							  if (isset($message)) {
							    echo $message;
							  }
						?>
						<form action="{{url('/customer/password-mail')}}" method="post">
							{{ csrf_field() }}  
							  <div class="form-group">
							    <label for="exampleFormControlInput1" style="font-size: 13px !important;">Give Your Email Address</label>
							    <input type="text" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Enter your email address" value="{{old('email')}}" required=>
							  </div>
							 <button class="btn btn-primary">Submit</button>	
						</form>
	                </div>
	            </div>      
	        </div>
	    </div>
	</app-register>
@endsection