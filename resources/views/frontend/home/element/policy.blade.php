@if(count($policyList) >0)
  <div _ngcontent-c7="" class="card mb-1" id="footer-top-banner">
    <div _ngcontent-c7="" class="row no-gutters" id="footer-payment">
      @foreach ($policyList as $policy)
      @php
        if(file_exists($policy->image)){
          $policyImage = asset($policy->image);
        }else{
          $policyImage = $noImage;
        }
      @endphp
        <div _ngcontent-c7="" class="col-md-3 col-6 text-center pt-4 cod">
          <img _ngcontent-c7="" alt="Payment Methods" class="img img-fluid" src="{{$policyImage}}">
          <h6 _ngcontent-c7="" class="p-4">{{$policy->title}}</h6>
        </div>
      @endforeach

    </div>
  </div>
@endif