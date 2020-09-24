@extends('frontend.master') 

@section('mainContent')

  <app-single-product _nghost-c14="">
      <div _ngcontent-c14="" id="skip-header"></div>
      <div _ngcontent-c14="" class="row bg-grey">

        @include('frontend.product.element.productInfo')

        @include('frontend.product.element.paymentMethod')
          
        @include('frontend.product.element.relatedProduct')
      </div>
  </app-single-product>

@endsection
