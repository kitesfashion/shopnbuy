@extends('frontend.master')

@section('mainContent')
@php
    use App\Product;
    use App\ProductImage;
@endphp
  <app-category-page _nghost-c4="">
    <div _ngcontent-c4="" id="skip-header"></div>
      <div _ngcontent-c4="" class="row no-gutters">
          <div _ngcontent-c4="" class="col-md-12 col-12 p-12 mb-2">
              <div _ngcontent-c4="">
                  <div _ngcontent-c4="" class="row bg-white">
                      
                  </div>
              </div>
          </div>
      </div>

    <div _ngcontent-c15="" class="row pb-1 bg-grey">
      <div _ngcontent-c15="" class="col-md-12">
        <div _ngcontent-c15="" class="card"> 
          <p _ngcontent-c15="" class="p-2 mb-0">Showing ({{count(@$productList)}}) results</p> 
        </div>
      </div>
    </div>

    <div _ngcontent-c4="" class="row no-gutters bg-white">
      @foreach ($productList as $product)
      @php
          $productImage = ProductImage::where('productId',$product->id)->where('section','content')->first();
          $name = str_replace(' ', '-', $product->name);
          if(file_exists(@$productImage->images)){
              $image = $productImage->images;
          }else{
              $image = $noImage;
          }
          if(@$product->discount){
            $price = @$product->discount;
          }else{
            $price = @$product->price;
          }
      @endphp
        <div _ngcontent-c4="" class="col-md-3 col-6 p-1 mb-2">
          <div _ngcontent-c8="" class="product text-center">
            <div _ngcontent-c8="" class="product-image pointer" tabindex="0">
                <a href="{{ route('product.details',['productId'=>$product->id,'productName'=>$name]) }}">
                    <img _ngcontent-c8="" class="img img-fluid" src="{{ $image }}">
                </a>
            
            </div>
            <div _ngcontent-c8="" class="product-footer text-center mb-1">
                <div _ngcontent-c8="" class="product-header pointer" tabindex="0">{{str_limit($product->name,40)}}
                    <span _ngcontent-c8="" class="tooltiptext">{{$product->name}} ({{$product->deal_code}})</span>
                </div>
                <div _ngcontent-c8="" class="success mb-3" tabindex="0">
                    <p _ngcontent-c8="" class="sku">
                        [
                            <span _ngcontent-c8="" class="weight">
                                {{$product->deal_code}}
                            </span> 
                        ]
                    </p>
                    @if($product->discount)
                        <strong _ngcontent-c8="" class="old_price">৳ {{$product->price}}</strong>

                        <strong _ngcontent-c8="">৳ {{$product->discount}}</strong>
                    @else
                        <strong _ngcontent-c8="">৳ {{$product->price}}</strong>
                    @endif
                </div>
                <app-add-to-cart _ngcontent-c8="" _nghost-c13="">
                    <!---->
                    <button onclick="addCart({{ $product->id}},{{$price}})" class="btn add-to-bag">
                        <i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag
                    </button>

                    <!---->

                    <div _ngcontent-c13="" class="product-link">

                        <a _ngcontent-c13="" href="{{ route('product.details',['productId'=>$product->id,'productName'=>$name]) }}">Details</a>
                    </div>

                </app-add-to-cart>
            </div>
        </div>
        </div>
      @endforeach
    </div>
  </app-category-page>
@endsection