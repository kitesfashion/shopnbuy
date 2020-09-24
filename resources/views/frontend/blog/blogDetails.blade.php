@extends('frontend.master')

@section('title', 'View Cart')

@section('mainContent')

<style type="text/css">
	p{
		text-align: justify;
	}
</style>


<div class="main-container container">
	<div class="row">
		<div class="col-md-12" id="content">
			<div class="blog-post  wow fadeInUp">
				<img style="width: 100%;" class="img-responsive" src="{{asset('/').$blogs->blogImage}}" alt="">
				<h1>{{$blogs->title}}</h1>
				
				<p>{{$blogs->description}}</p>
				
			</div>

		</div>
			
	</div>
</div>


@endsection

