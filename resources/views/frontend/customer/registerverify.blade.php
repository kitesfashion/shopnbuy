@extends('frontend.master')


@section('mainContent')
	<div class="container">
		<br>
		<div class="row">
		<div style="margin-top: 20px;" class="col-md-5 col-md-offset-4">
			<div class="login-panel panel panel-default">
                    <div class="panel-heading">
			<?php
				$message = Session::get('msg');
				  if (isset($message)) {
				    echo $message;
				  }
				  
				?>
				<h5><strong>Check Your Email for Code </strong></h5>
				<form action="{{url('/confirm-code')}}" method="post">
					{{ csrf_field() }}  
					
			  <div class="form-group">
			    <input type="text" class="form-control" id="exampleFormControlInput1" name="verify" placeholder="VERIFICATION CODE" required>
			  </div>

			 <button class="btn btn-success">NEXT</button>		  
			  
			 
			</form>
		</div>
	</div>
		</div>
	</div>

</div>



@endsection