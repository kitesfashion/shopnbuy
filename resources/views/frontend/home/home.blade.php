@extends('frontend.master')  

@section('mainContent')
  <app-home _nghost-c7="">
    @include('frontend.home.element.slider_grid')
    @include('frontend.home.element.offer_grid')
    @include('frontend.home.element.category_grid')
    @include('frontend.home.element.category_product_without_subcategory')
    @include('frontend.home.element.category_product_with_subcategory')
    @include('frontend.home.element.gadget')
    @include('frontend.home.element.category_product_with_product')
    @include('frontend.home.element.flash_sell')
    @include('frontend.home.element.about_description')
    @include('frontend.home.element.policy')
  </app-home>
@endsection