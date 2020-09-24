@extends('frontend.master')

@section('body')
    <app-register _nghost-c17=""><div _ngcontent-c17="" class="row bg-grey">
    <div _ngcontent-c17="" class="col-md-10 offset-md-1">
        <div _ngcontent-c17="" class="card mt-4 mb-4">
            <div _ngcontent-c17="" class="card-body">
                <h4 _ngcontent-c17="">CREATE AN ACCOUNT</h4>
                <!---->
                <div _ngcontent-c17="" class="form-group">
                    <label _ngcontent-c17="" for="name">Mobile Number</label>
                    <input _ngcontent-c17="" class="form-control ng-untouched ng-pristine ng-valid" id="mobile_no" name="mobile_no" type="text">
                </div>
                
                <div _ngcontent-c17="" class="form-group">
                    <label _ngcontent-c17="" for="mobile-number">Pin Code (You will receive a PIN via SMS within next 30 seconds to 5 minutes)</label>
                    <input _ngcontent-c17="" class="form-control ng-untouched ng-pristine ng-valid" id="pin_code" placeholder="Enter Your PIN Code" type="text">
                </div>
                <div _ngcontent-c17="" class="form-group">
                    <label _ngcontent-c17="" for="zone">Full Name</label>
                    <input _ngcontent-c17="" class="form-control ng-untouched ng-pristine ng-valid" type="text">
                </div>
                <div _ngcontent-c17="" class="form-group">
                    <label _ngcontent-c17="" for="address">Email (To receive the Invoice/Bill)</label>
                    <input _ngcontent-c17="" class="form-control ng-untouched ng-pristine ng-valid" id="address" type="text">
                </div>
                <!----><div _ngcontent-c17="" class="form-group">
                    <button _ngcontent-c17="" class="btn add-to-bag">Submit</button>
                </div>
        
        <!---->

        </div>
            </div>      
    </div>
</div>
</app-register>
@endsection