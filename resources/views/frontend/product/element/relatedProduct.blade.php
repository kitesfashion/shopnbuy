@php
    use App\ProductImage;
@endphp
@if(count(@$relatedProductList) > 0)
    <div _ngcontent-c14="" class="col-md-12 mb-1">
        <div _ngcontent-c14="" class="card mt-2" id="you-may-like">
            <div _ngcontent-c14="" class="card-header green-gradient">
                <p _ngcontent-c14="" class="text-white">YOU MAY ALSO LIKE</p>
            </div>
            <div _ngcontent-c8="" class="card-body">
                <div class="carousel" id="carousel" data-flickity='{ "groupCells": false,"autoPlay": 3500,"cellAlign": "left", "contain": true,"freeScroll": false,"draggable": false ,"wrapAround": false,"pauseAutoPlayOnHover": true}'>
                    @foreach ($relatedProductList as $relatedProduct)
                    @php
                        $relatedProductImage = ProductImage::where('productId',$relatedProduct->id)->where('section','content')->first();
                        $name = str_replace(' ', '-', $relatedProduct->name);
                        if(file_exists(@$relatedProductImage->images)){
                            $relatedProductImage = asset($relatedProductImage->images);
                        }else{
                            $relatedProductImage = $noImage;
                        }
                        if(@$relatedProduct->discount){
                          $price = @$relatedProduct->discount;
                        }else{
                          $price = @$relatedProduct->price;
                        }
                    @endphp
                        <div class="carousel-cell col-md-3 col-sm-6">
                            <div _ngcontent-c8="" class="item mb-1">
                                <div _ngcontent-c8="">
                                    <div _ngcontent-c8="" class="product text-center">
                                        <div _ngcontent-c8="" class="product-image pointer" tabindex="0">
                                            <a href="{{ route('product.details',['productId'=>$relatedProduct->id,'productName'=>$name]) }}">
                                                <img _ngcontent-c8="" class="img img-fluid" src="{{ $relatedProductImage }}">
                                            </a>
                                        
                                        </div>
                                        <div _ngcontent-c8="" class="product-footer text-center mb-1">
                                            <div _ngcontent-c8="" class="product-header pointer" tabindex="0">{{str_limit($relatedProduct->name,40)}}
                                                <span _ngcontent-c8="" class="tooltiptext">{{$relatedProduct->name}} ({{$relatedProduct->deal_code}})</span>
                                            </div>
                                            <div _ngcontent-c8="" class="success mb-3" tabindex="0">
                                                <p _ngcontent-c8="" class="sku">
                                                    [
                                                        <span _ngcontent-c8="" class="weight">
                                                            {{$relatedProduct->deal_code}}
                                                        </span> 
                                                    ]
                                                </p>
                                                @if($relatedProduct->discount)
                                                    <strong _ngcontent-c8="" class="old_price">৳ {{$relatedProduct->price}}</strong>

                                                    <strong _ngcontent-c8="">৳ {{$relatedProduct->discount}}</strong>
                                                @else
                                                    <strong _ngcontent-c8="">৳ {{$relatedProduct->price}}</strong>
                                                @endif
                                            </div>
                                            <app-add-to-cart _ngcontent-c8="" _nghost-c13="">
                                                <!---->
                                                <button onclick="addCart({{ $relatedProduct->id}},{{$price}})" class="btn add-to-bag">
                                                    <i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag
                                                </button>

                                                <!---->

                                                <div _ngcontent-c13="" class="product-link">

                                                    <a _ngcontent-c13="" href="{{ route('product.details',['productId'=>$relatedProduct->id,'productName'=>$name]) }}">Details</a>
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
@endif