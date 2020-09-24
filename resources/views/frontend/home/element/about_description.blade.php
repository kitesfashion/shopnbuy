@if(strlen(@$about->homeDescription) > 68)
	<div _ngcontent-c7="" class="container-fluid bg-grey mt-1">
	  <div _ngcontent-c7="" class="row">
	    <div _ngcontent-c7="" class="p-3 card mt-1 mb-1" id="footer-text">
	      @php
	      	echo $about->homeDescription;
	      @endphp
	    </div>
	  </div>
	</div>
@endif