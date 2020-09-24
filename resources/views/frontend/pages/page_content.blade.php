@extends('frontend.master')

@section('mainContent')
	<app-static-page _nghost-c14="">
    <div _ngcontent-c14="" id="skip-header"></div>
	    <div _ngcontent-c14="" class="container-fluid bg-grey mt-1">
	        <div _ngcontent-c14="" class="row">
	            <div _ngcontent-c14="" class="p-3 card mt-1 mb-1">
	            	@if($article->firstInnerTitle != '')
	            		<h2 class="text-center">{{$article->firstInnerTitle}}</h2>
	            	@else
	            		<h2 class="text-center">{{$menu->menuName}}</h2>
	            	@endif
	                @php
	                	echo $article->innerDescription;
	                @endphp
	            </div>
	        </div>
	    </div>
	</app-static-page>
@endsection
