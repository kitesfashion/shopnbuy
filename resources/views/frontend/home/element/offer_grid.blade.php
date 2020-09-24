@php
  use App\ProductImage;
@endphp
<app-exclusive-offers _ngcontent-c7="" _nghost-c8="">
  <div _ngcontent-c8="" class="classic-tabs">
    <ul _ngcontent-c8="" class="nav tabs-red" id="myClassicTab" role="tablist">
      <li _ngcontent-c8="" class="nav-item">
        <a _ngcontent-c8="" aria-controls="profile-classic" aria-selected="true" class="nav-link  waves-light active show" data-toggle="tab" onclick="BannerSection('exclusive_banner')"  role="tab">EXCLUSIVE OFFERS</a>
      </li>
      <li _ngcontent-c8="" class="nav-item">
        <a _ngcontent-c8="" aria-controls="follow-classic" aria-selected="false" class="nav-link waves-light" data-toggle="tab"  id="follow-tab-classic" onclick="BannerSection('new_product')" role="tab">NEW ARRIVALS</a>
      </li>
    </ul>
  </div>

    <div _ngcontent-c8="" class="row pb-2 pt-1 bg-grey" id="exclusive_banner">
        <div _ngcontent-c8="" class="col-md-12">
            <div _ngcontent-c8="" class="card">
                <div _ngcontent-c8="" class="card-body">
                    <div class="carousel" id="carousel" data-flickity='{ "groupCells": false,"autoPlay": 3500,"cellAlign": "left", "contain": true,"freeScroll": false,"draggable": false ,"wrapAround": false,"pauseAutoPlayOnHover": true}'>
                        @foreach ($exclusiveBannerList as $exclusiveBanner)
                            <div class="col-md-3 col-sm-6">
                                <img src="{{ asset($exclusiveBanner->bannerImage) }}">
                            </div>
                        @endforeach
                    </div>
                  
                </div>
            </div>
        </div>
    </div>


    <div _ngcontent-c8="" class="row pb-2 pt-1 bg-grey" id="new_product">
      <div _ngcontent-c8="" class="col-md-12">
          <div _ngcontent-c8="" class="card">
              <div _ngcontent-c8="" class="card-body">
                  <div class="carousel" id="carousel" data-flickity='{ "groupCells": false,"autoPlay": 3500,"cellAlign": "left", "contain": true,"freeScroll": false,"draggable": false ,"wrapAround": false,"pauseAutoPlayOnHover": true}'>
                      @foreach ($newProductList as $newProduct)
                      @php
                          $productImage = ProductImage::where('productId',$newProduct->id)->where('section','content')->first();
                          $name = str_replace(' ', '-', $newProduct->name);
                          if(file_exists(@$productImage->images)){
                              $newProductImage = $productImage->images;
                          }else{
                              $newProductImage = $noImage;
                          }
                          if(@$newProduct->discount){
                            $price = @$newProduct->discount;
                          }else{
                            $price = @$newProduct->price;
                          }
                      @endphp
                          <div class="carousel-cell col-md-3 col-sm-6">
                              <div _ngcontent-c8="" class="item mb-1">
                                  <div _ngcontent-c8="">
                                      <div _ngcontent-c8="" class="product text-center">
                                          <div _ngcontent-c8="" class="product-image pointer" tabindex="0">
                                              <a href="{{ route('product.details',['productId'=>$newProduct->id,'productName'=>$name]) }}">
                                                  <img _ngcontent-c8="" class="img img-fluid" src="{{ $newProductImage }}">
                                              </a>
                                          
                                          </div>
                                          <div _ngcontent-c8="" class="product-footer text-center mb-1">
                                              <div _ngcontent-c8="" class="product-header pointer" tabindex="0">{{str_limit($newProduct->name,40)}}
                                                  <span _ngcontent-c8="" class="tooltiptext">{{$newProduct->name}} ({{$newProduct->deal_code}})</span>
                                              </div>
                                              <div _ngcontent-c8="" class="success mb-3" tabindex="0">
                                                  <p _ngcontent-c8="" class="sku">
                                                      [
                                                          <span _ngcontent-c8="" class="weight">
                                                              {{$newProduct->deal_code}}
                                                          </span> 
                                                      ]
                                                  </p>
                                                  @if($newProduct->discount)
                                                      <strong _ngcontent-c8="" class="old_price">৳ {{$newProduct->price}}</strong>

                                                      <strong _ngcontent-c8="">৳ {{$newProduct->discount}}</strong>
                                                  @else
                                                      <strong _ngcontent-c8="">৳ {{$newProduct->price}}</strong>
                                                  @endif
                                              </div>
                                              <app-add-to-cart _ngcontent-c8="" _nghost-c13="">
                                                  <!---->
                                                  <button onclick="addCart({{ $newProduct->id}},{{$price}})" class="btn add-to-bag">
                                                      <i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag
                                                  </button>

                                                  <!---->

                                                  <div _ngcontent-c13="" class="product-link">

                                                      <a _ngcontent-c13="" href="{{ route('product.details',['productId'=>$newProduct->id,'productName'=>$name]) }}">Details</a>
                                                  </div>

                                              </app-add-to-cart>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
</app-exclusive-offers>
