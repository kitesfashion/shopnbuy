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
	<?php
		foreach ($blogs as $blog) {
			
	?>
		<div class="row">
			<div class="blog-page">
					<div class="col-md-12">
						<div class="blog-post  wow fadeInUp">
							<a href="{{url('/blog-details/'.$blog->id)}}"><img style="width: 100%;" class="img-responsive" src="{{asset('/').$blog->blogImage}}" alt=""></a>
							<h1><a href="{{url('/blog-details/'.$blog->id)}}">{{$blog->title}}</a></h1>
							
							<p>{{str_limit($blog->description,600)}}</p>
							<a href="{{url('/blog-details/'.$blog->id)}}" class="btn btn-upper btn-primary read-more">read more</a>
						</div>

				</div>
				
			</div>
		</div>

	<?php } ?>
	</div>
	

	</div>
</div>

@endsection

