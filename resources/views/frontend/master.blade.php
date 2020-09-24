<!DOCTYPE html>
<html lang="en">
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<head>
		<META NAME="KEYWORDS" CONTENT="<?php echo @$metaTag['meta_keyword']; ?>">
		<META property="og:title" NAME="TITLE" CONTENT="<?php echo @$metaTag['meta_title']; ?>">
		<META property="og:description" NAME="DESCRIPTION" CONTENT="<?php echo @$metaTag['meta_description']; ?>">
		<meta name="author" content="{{$information->siteName}}">
		<link rel="shortcut icon" type="image/png" href="{{ asset('/').@$information->sitefavIcon }}">
		<title>{{$information->siteName}} @if(@$title) {{@$information->titlePrefix}} @endif {{ @$title }}</title>
		@include('frontend.include.header.header-asset')
	</head>
	<body class="fixed-sn mdb-skin-custom" data-spy="scroll" data-target="#scrollspy" data-offset="15" aria-busy="true">&#65279;
		@include('frontend.include.others.location_chose')
		<main>
			<div class="container-fluid" style="padding-left: 5px; padding-right: 5px; overflow-x: hidden !important;">
				<app-root _nghost-c0="" ng-version="5.2.11">
					<app-header _ngcontent-c0="" _nghost-c1="">
						@include('frontend.include.header.login_form')
						@include('frontend.include.header.side_menu')
						@include('frontend.include.header.header_top')
					</app-header>
					<router-outlet _ngcontent-c0=""></router-outlet>	
    				@include('frontend.shopping_cart.shopping_cart')
    				<div class="mainContent">
    					@yield('mainContent')
    				</div>
					
					<app-footer _ngcontent-c0="" _nghost-c2="">
	                    <footer _ngcontent-c2="" class="page-footer card" id="footer">
	                        @include('frontend.include.footer.footer_top')
	                        @include('frontend.include.footer.footer_bottom')
	                    </footer>
	                </app-footer>

	                 @include('frontend.include.others.cart_content')
				</app-root>
	                @include('frontend.include.others.facebook_page')
			</div>
			<div id="loader"></div>
		</main>
			<img onclick="topFunction()" id="myBtn" title="Go to top" src="{{asset('public/frontend/')}}/up-arrow.png" style="display: none;">

		 @include('frontend.include.footer.footer_asset')
		 @include('frontend.include.others.window_load_javascript')
		 @include('frontend.include.others.shopping_cart_javascript')
		 @include('frontend.include.others.location_chose_javascript')
		 @include('frontend.category.category_product_javascript')
	</body>
</html>