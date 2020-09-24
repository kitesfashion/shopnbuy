@php
use App\ProductImage;
    $productImage = ProductImage::where('section','original')->where('productId',$product->id)->first();

    if(file_exists($productImage->images)){
        $image = asset($productImage->images);
    }else{
       $image = $noImage; 
    }
    if(@$product->discount){
      $price = @$product->discount;
    }else{
      $price = @$product->price;
    }
@endphp
<div _ngcontent-c14="" class="col-md-8 mb-1">
    <div _ngcontent-c14="" class="card" id="single_center">
        <div _ngcontent-c14="" class="row">
            <div _ngcontent-c14="" class="col-md-5">
                <div _ngcontent-c14="" class="single-product-image p-3">
                    <ngx-image-zoom _ngcontent-c14="" ngclass="img img-fluid" _nghost-c15="" class="img img-fluid">
                        <div _ngcontent-c15="" class="ngxImageZoomContainer" id="view" {{-- style="width: 150px; height: 150px;" --}}> 
                              <img src="{{ $image }}" height="100%" width="100%" class="block__pic" />
                        </div>
                    </ngx-image-zoom>
                </div>
            </div>
            <div _ngcontent-c14="" class="col-md-7">
                <div _ngcontent-c14="" class="product mb-4 p-4 ">
                    <div _ngcontent-c14="">
                        <h3 _ngcontent-c14="">{{$product->name}}</h3></div>
                        
                    <p _ngcontent-c14="" class="sku">
                        [ 
                            <span _ngcontent-c8="" class="weight">
                                {{$product->deal_code}}
                            </span> 
                </span> ]
                    </p>
                    <!---->
                    <hr _ngcontent-c14="">
                    <div _ngcontent-c14="" class="product-footer">
                        <div _ngcontent-c14="" class="row">
                            <div _ngcontent-c14="" class="col-md-6">
                                @if($product->discount)
                                    <strong _ngcontent-c8="" class="old_price">৳ {{$product->price}}</strong>

                                    <strong _ngcontent-c8="">৳ {{$price}}</strong>
                                @else
                                    <strong _ngcontent-c8="">৳ {{$product->price}}</strong>
                                @endif
                            </div>
                            <!---->
                            <div _ngcontent-c14="" class="col-md-6">
                                <!---->
                                <button onclick="addCart({{ $product->id}},{{$price}})" class="btn add-to-bag">
                                    <i aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag
                                </button>
                                <!---->
                            </div>
                            <!---->

                            <!---->
                        </div>
                    </div>
                </div>

                <div _ngcontent-c14="">
                    <!---->
                </div>
            </div>

            <!---->
        </div>
    </div>
</div>

@section('custom_js')
    <script>
        $(document).ready(function() {
            $('#view').setZoomPicture({
          thumbsContainer: '#pics-thumbs',
          prevContainer: '#nav-left-thumbs',
          nextContainer: '#nav-right-thumbs',
          zoomContainer: '#zoom',
          zoomLevel: 2,
            }); 
        });
     </script>
@endsection