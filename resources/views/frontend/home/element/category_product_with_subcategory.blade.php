@php
    use App\Product;
    use App\ProductImage;
    use App\Category;
@endphp

@if(count($homeCategoryListWithSubcategory) > 0)
    @foreach ($homeCategoryListWithSubcategory as $homeCategory)
        @php
            $homeCategoryProductList = Product::where('category_id',$homeCategory->id)
                                    ->where('status',1)
                                    ->orderBy('orderBy',"ASC")
                                    ->get();
            $subCategoryList = Category::where('parent',$homeCategory->id)->where('categoryStatus',1)->orderBy('orderBy','ASC')->get();
            $categoryName = str_replace(' ', '-', $homeCategory->categoryName);
            $categoryLink =  url('/categories/'.@$homeCategory->id.'/'.@$categoryName);
        @endphp
        <app-books-collection _ngcontent-c7="" _nghost-c10="">
            <div _ngcontent-c10="" class="row pt-1 pb-1 bg-grey">
                <div _ngcontent-c10="" class="col-md-12 text-center pointer" tabindex="0">
                    <a href="{{$categoryLink}}">
                        {{-- <img _ngcontent-c10="" alt="Flash Deals" class="img img-fluid rounded" src="https://www.meenaclick.com/assets/img/section.png"> --}}
                        <div _ngcontent-c10="" class="categorySection">
                            @if(file_exists($homeCategory->headerImage))
                                <img _ngcontent-c7="" class="thumb-icon" src="{{ $category->headerImage }}" style="height: 20px;"> 
                              @endif
                            <h3 _ngcontent-c10="">{{$homeCategory->categoryName}}</h3>
                        </div>
                    </a>
                </div>
            </div>

            @if(count($subCategoryList) > 0)
                <div class="carousel" id="carousel" data-flickity='{ "groupCells": false,"autoPlay": false,"cellAlign": "left", "contain": true,"freeScroll": false,"draggable": false ,"wrapAround": false,"pauseAutoPlayOnHover": true,"pageDots":false}'>
                    @foreach ($subCategoryList as $subcat)
                    @php
                      $subCategoryName = str_replace(' ', '-', $subcat->categoryName);
                      $subCategoryLink =  url('/categories/'.@$subcat->id.'/'.@$subCategoryName);
                    @endphp
                      <div _ngcontent-c9="" class="col-6 col-md-3 pointer" tabindex="0">
                        <div>
                          <a href="{{@$subCategoryLink}}">
                            @if(file_exists($subcat->image))
                              <img _ngcontent-c9="" class="img img-fluid" src="{{ $subcat->image }}" style="width: 100%;height: 170px;">
                            @else
                              <img _ngcontent-c9="" class="img img-fluid rounded" src="{{$noImage}}" style="width: 100%;height: 170px;">
                            @endif

                            <div _ngcontent-c9="" class="sub-header" style="top: 79%;width: 90%">
                                <span _ngcontent-c9="" class="sub-heading" style="line-height: 31px;margin: 0 auto;display: table;">
                                  @if(file_exists($subcat->headerImage))
                                    <img _ngcontent-c7="" class="thumb-icon" src="{{ $subcat->headerImage }}" style="height: 20px;"> 
                                  @endif
                                  {{ $subcat->categoryName }}
                                </span>
                            </div>
                          </a>
                        </div>
                      </div>
                    @endforeach
                </div>
            @endif
           

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
