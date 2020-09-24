@php
    use App\Product;
    use App\ProductImage;
    use App\Category;
@endphp

@if(count($homeCategoryListWithProduct) > 0)
    @foreach ($homeCategoryListWithProduct as $homeCategory)
        @php
            $homeCategoryProductList = Product::where('category_id',$homeCategory->id)
                                    ->where('status',1)
                                    ->orderBy('orderBy',"ASC")
                                    ->get();
            $categoryName = str_replace(' ', '-', $homeCategory->categoryName);
            $categoryLink =  url('/categories/'.@$homeCategory->id.'/'.@$categoryName);
        @endphp
        <app-books-collection _ngcontent-c7="" _nghost-c10="">
            <div _ngcontent-c10="" class="row pt-1 pb-1 bg-grey">
                <div _ngcontent-c10="" class="col-md-12 text-center pointer" tabindex="0">
                    <a href="{{$categoryLink}}">
                        {{-- <img _ngcontent-c10="" alt="Flash Deals" class="img img-fluid rounded" src="https://www.meenaclick.com/assets/img/section.png"> --}}
                        <div _ngcontent-c10="" class="categorySection">
                            <h3 _ngcontent-c10="">{{$homeCategory->categoryName}}</h3>
                        </div>
                    </a>
                </div>
            </div>

            <div _ngcontent-c8="" class="row pb-2 pt-1 bg-grey">
                <div _ngcontent-c8="" class="col-md-12">
                    <div _ngcontent-c8="" class="card">
                        <div _ngcontent-c8="" class="card-body">
                            <div class="carousel" id="carousel" data-flickity='{ "groupCells": false,"autoPlay": 3500,"cellAlign": "left", "contain": true,"freeScroll": false,"draggable": false ,"wrapAround": false,"pauseAutoPlayOnHover": true}'>
                                @foreach ($homeCategoryProductList as $homeCategoryProduct)
                                @php
                                    $productImage = ProductImage::where('productId',$homeCategoryProduct->id)->where('section','content')->first();
                                    $name = str_replace(' ', '-', $homeCategoryProduct->name);
                                    if(file_exists(@$productImage->images)){
                                        $homeCategoryProductImage = $productImage->images;
                                    }else{
                                        $homeCategoryProductImage = $noImage;
                                    }
                                    if(@$homeCategoryProduct->discount){
                                      $price = @$homeCategoryProduct->discount;
                                    }else{
                                      $price = @$homeCategoryProduct->price;
                                    }
                                @endphp
                                    <div class="carousel-cell col-md-3 col-sm-6">
                                        <div _ngcontent-c8="" class="item mb-1">
                                            <div _ngcontent-c8="">
                                                <div _ngcontent-c8="" class="product text-center">
                                                    <div _ngcontent-c8="" class="product-image pointer" tabindex="0">
                                                        <a href="{{ route('product.details',['productId'=>$homeCategoryProduct->id,'productName'=>$name]) }}">
                                                            <img _ngcontent-c8="" class="img img-fluid" src="{{ $homeCategoryProductImage }}">
                                                        </a>
                                                    
                                                    </div>
                                                    <div _ngcontent-c8="" class="product-footer text-center mb-1">
                                                        <div _ngcontent-c8="" class="product-header pointer" tabindex="0">{{str_limit($homeCategoryProduct->name,40)}}
                                                            <span _ngcontent-c8="" class="tooltiptext">{{$homeCategoryProduct->name}} ({{$homeCategoryProduct->deal_code}})</span>
                                                        </div>
                                                        <div _ngcontent-c8="" class="success mb-3" tabindex="0">
                                                            <p _ngcontent-c8="" class="sku">
                                                                [
                                                                    <span _ngcontent-c8="" class="weight">
                                                                        {{$homeCategoryProduct->deal_code}}
                                                                    </span> 
                                                                ]
                                                            </p>
                                                            @if($homeCategoryProduct->discount)
                                                                <strong _ngcontent-c8="" class="old_price">৳ {{$homeCategoryProduct->price}}</strong>

                                                                <strong _ngcontent-c8="">৳ {{$homeCategoryProduct->discount}}</strong>
                                                            @else
                                                                <strong _ngcontent-c8="">৳ {{$homeCategoryProduct->price}}</strong>
                                                            @endif
                                                        </div>
                                                        <app-add-to-cart _ngcontent-c8="" _nghost-c13="">
                                                            <!---->
                                                            <button onclick="addCart({{ $homeCategoryProduct->id}},{{$price}})" class="btn add-to-bag">
                                                                <i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag
                                                            </button>

                                                            <!---->

                                                            <div _ngcontent-c13="" class="product-link">

                                                                <a _ngcontent-c13="" href="{{ route('product.details',['productId'=>$homeCategoryProduct->id,'productName'=>$name]) }}">Details</a>
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
        </app-books-collection>
    @endforeach
@endif
