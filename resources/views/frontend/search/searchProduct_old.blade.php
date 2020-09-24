@extends('frontend.master')

@section('mainContent')
 <?php
  use App\ProductImage;
  use App\Product;
  use App\Category;
?>

<!-- Main Container  -->
  <div class="main-container container">
    <div class="row">
      <!--Left Part Start -->
      <aside class="col-sm-4 col-md-3 content-aside" id="column-left">
     
      </aside>
        <?php
          if ($products->count() >= 1) {

        ?>
        <!--Middle Part Start-->
        <br>
          <div class="col-md-9 col-sm-8">
            <?php
          
          if ($categorySelect) {
            $searchName = $categorySelect->categoryName;
          }else{
            $searchName = $search;
          }
       ?>
            <div class="products-category">
                    <h3 class="title-category">Search result for {{$searchName}}</h3>
              <!-- Filters -->
                    <div class="product-filter product-filter-top filters-panel">
                        <div class="row">
                           
              <!--changed listings-->
                    <div class="products-list row nopadding-xs so-filter-gird grid">
                      <div class="row">
                      <div class="col-sm-6 text-left"></div>
                      <div class="col-sm-6 text-right">{{ $products->links() }}</div>
                    </div>
                      <?php
                        $countP = 0; 
                      ?>
                    @foreach($products as $product)
                    <?php
                          
                         $image = ProductImage::where('productId',$product->id)->first();
                         $name = str_replace(' ', '-', $product->name);
                          
                    ?>
                      <input type="hidden" id="pro_id<?php echo $countP;?>" value="{{@$product->id}}"/>
                      <div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12" style="height: 280px;">
                                  <div class="product-item-container">
                                    <div class="left-block left-b">
                                        
                                        <div class="product-image-container second_img" style="height: 164px;">
                                           <?php if(file_exists($image->images)){ ?>
                                              <a href="{{url('product/'.@$product->id.'/'.@$name)}}"><img src="{{ asset('/').$image->images }}" class="img-responsive productCategoryImage" alt="img cate"><br></a>
                                          <?php }else{ ?>
                                            <a><img src="{{ asset('/')}}public/frontend/no-image.png" alt="img cate" class="img-responsive" style="height: 164px;width: 100%;"><br></a>
                                            <?php } ?>
                                        </div>
                                       
                                    </div>
                                    <div class="right-block" style="min-height: 98px;">
                                        <div class="button-group so-quickview cartinfo--left" style="margin-top: -50px;">
                                            <button type="button" class="addToCart" title="Add to cart" onclick="addCart('{{ $product->id}}')">
                                                <span>Add to cart </span>   
                                            </button>
                                           
                                            
                                        </div>
                                        <div class="caption">
                                            <h4 style="min-height: 34px;"><a href="{{url('product/'.@$product->id.'/'.@$name)}}" title="Pastrami bacon" target="_self">  {{ str_limit($product->name, 38) }}</a></h4>
                                            <h4>Code: {{@$product->deal_code}}</h4>
                                            
                                        </div>
                                        <p class="price">
                                        <?php  if($product->discount){?>
                                          <span class="price-new">৳ {{@$product->discount}}</span>
                                          <span class="price-old">৳ {{@$product->price}}</span>
                                        <?php }else{ ?>
                                            <span class="price-new">৳ {{@$product->price}}</span>
                                        <?php } ?>
                                        </p>
                                    </div>

                                </div>
                      </div>
                  <?php $countP++?>
         @endforeach
                     
                    </div>
                     <div class="row">
                            <div class="col-sm-6 text-left"></div>
                            <div class="col-sm-6 text-right">{{ $products->links() }}</div>
                        </div>
              <!--// End Changed listings-->
             
              <!-- //end Filters -->
              
            </div>
            
          </div>
          

          <!--Middle Part End-->
           
        </div>
    </div>
  <!-- //Main Container -->
  <?php }else{ ?>
         <h3 class="text-center">No Product Available</h3>
      <?php } ?>
</div>
</div>


@endsection