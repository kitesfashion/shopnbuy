@php
  use App\ProductImage;
@endphp
@if(@$firstTopGadgetProduct)
  @php
    $productImage = ProductImage::where('productId',$firstTopGadgetProduct->id)->where('section','top_gadget')->first();
    $name = str_replace(' ', '-', $firstTopGadgetProduct->name);
    @endphp
  <app-top-gadgets _ngcontent-c7="" _nghost-c13="">
    <div _ngcontent-c13="" class="container-fluid bg-grey">
      <div _ngcontent-c13="" class="row pt-2">
        <div _ngcontent-c13="" class="p-2 col-md-12 green-gradient card">
          <p _ngcontent-c13="" class="text-white">TOP GADGETS</p>
        </div>
      </div>
    </div>
    <div _ngcontent-c13="" class="row no-gutters">
      <div _ngcontent-c13="" class="col-md-6 col-sm-12 pt-1 bg-grey pointer" tabindex="0">
        <a href="{{ route('product.details',['productId'=>$firstTopGadgetProduct->id,'productName'=>$name]) }}">
          @if(file_exists(@$productImage->images))
            <img src="{{asset($productImage->images)}}"  style="height: 99%;width: 100%;">
          @else
            <img src="{{$noImage}}" style="height: 610px;">
          @endif
        </a>
      </div>
      <div _ngcontent-c13="" class="col-md-6 col-sm-12 bg-grey">
        <div _ngcontent-c13="" class="row no-gutters">
          @php $i = 0; @endphp
          @foreach ($topGadgetProductList as $topGadgetProduct)
            @php
                $i++;
                if($i != 1){
                  $productImage = ProductImage::where('productId',$topGadgetProduct->id)->where('section','content')->first();
                  $name = str_replace(' ', '-', $topGadgetProduct->name);
                  if(file_exists(@$productImage->images)){
                      $topGadgetProductImage = $productImage->images;
                  }else{
                      $topGadgetProductImage = $noImage;
                  }
                  if(@$topGadgetProduct->discount){
                    $price = @$topGadgetProduct->discount;
                  }else{
                    $price = @$topGadgetProduct->price;
                  }
            @endphp
            <div _ngcontent-c11="" class="col-md-4 col-6 col-sm-6 p-1">
              <div _ngcontent-c8="" class="product text-center card p-1">
                <div _ngcontent-c8="" class="product-image pointer" tabindex="0">
                    <a href="{{ route('product.details',['productId'=>$topGadgetProduct->id,'productName'=>$name]) }}">
                        <img _ngcontent-c8="" class="img img-fluid" src="{{ $topGadgetProductImage }}">
                    </a>
                
                </div>
                <div _ngcontent-c8="" class="product-footer text-center mb-1">
                    <div _ngcontent-c8="" class="product-header pointer" tabindex="0">{{str_limit($topGadgetProduct->name,30)}}
                        <span _ngcontent-c8="" class="tooltiptext">{{$topGadgetProduct->name}} ({{$topGadgetProduct->deal_code}})</span>
                    </div>
                    <div _ngcontent-c8="" class="success mb-3" tabindex="0">
                        <p _ngcontent-c8="" class="sku">
                            [
                                <span _ngcontent-c8="" class="weight">
                                    {{$topGadgetProduct->deal_code}}
                                </span> 
                            ]
                        </p>
                        @if($topGadgetProduct->discount)
                            <strong _ngcontent-c8="" class="old_price">৳ {{$topGadgetProduct->price}}</strong>

                            <strong _ngcontent-c8="">৳ {{$topGadgetProduct->discount}}</strong>
                        @else
                            <strong _ngcontent-c8="">৳ {{$topGadgetProduct->price}}</strong>
                        @endif
                    </div>
                    <app-add-to-cart _ngcontent-c8="" _nghost-c13="">
                      <button onclick="addCart({{ $topGadgetProduct->id}},{{$price}})" class="btn add-to-bag">
                          <i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag
                      </button>
                      <div _ngcontent-c13="" class="product-link">

                          <a _ngcontent-c13="" href="{{ route('product.details',['productId'=>$topGadgetProduct->id,'productName'=>$name]) }}">Details</a>
                      </div>
                    </app-add-to-cart>
                </div>
              </div>
            </div>
            @php } @endphp
          @endforeach 
        </div>
      </div>
    </div>
  </app-top-gdgets>
@endif