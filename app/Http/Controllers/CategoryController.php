<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

use App\Category;
use App\Product;
use App\ProductImage;



class CategoryController extends Controller
{
  public function ProductByCategory($id){
     $category = Category::where('id',$id)->first();

     $metaTag =[
        'meta_keyword'=>$category->metaKeyword,
        'meta_title' =>$category->metaTitle,
        'meta_description' =>$category->metaDescription
     ];

     $title = $category->categoryName;

     return view('frontend.category.productbycategory')->with(compact('category','metaTag','title'));
  }

  public function GetCategoryProduct($id){
    $sortingBy = @$_GET['sortingBy'];
    $sortingOrder = @$_GET['sortingOrder'];
    $filterBy = @$_GET['filterBy'];
    $productLimit = @$_GET['productLimit'];

    $limit = 40;
    if(@$productLimit){
       $limit = $limit+$productLimit;
    }
   

    if(@$filterBy){
      $productList = Product::whereRaw('FIND_IN_SET(?,category_id)',[$id])
                    ->where('status',1)
                    ->where($filterBy,'!=',NULL)
                    ->take($limit)
                    ->orderBy('orderBy','ASC')
                    ->get();
    }elseif($sortingBy && $sortingOrder){
      $productList = Product::whereRaw('FIND_IN_SET(?,category_id)',[$id])
                    ->where('status',1)
                    ->take($limit)
                    ->orderBy($sortingBy,$sortingOrder)
                    ->get();
    }else{
      $productList = Product::whereRaw('FIND_IN_SET(?,category_id)',[$id])
                    ->where('status',1)
                    ->take($limit)
                    ->orderBy('orderBy','ASC')
                    ->get();
    }

    $totalProduct = Product::whereRaw('FIND_IN_SET(?,category_id)',[$id])
                    ->where('status',1)
                    ->orderBy('orderBy','ASC')
                    ->get();
    
    $data = "";
    if(count($productList) > 0){
      foreach ($productList as $product) {
        $productImage = ProductImage::where('productId',$product->id)->where('section','content')->first();
        $name = str_replace(' ', '-', $product->name);
        
        if(file_exists(@$productImage->images)){
            $image = asset($productImage->images);
        }else{
            $image = asset('/public/frontend/no-image-icon.png');
        }
        if(@$product->discount){
          $price = @$product->discount;
        }else{
          $price = @$product->price;
        }
        $data .='<div _ngcontent-c4="" class="col-md-3 col-6 p-1 mb-2">';
        $data .='<div _ngcontent-c4="" class="product text-center p-2">';
        $data .='<div _ngcontent-c4="" class="product-image" tabindex="0">';
        $data .='<a href="'.route('product.details',['productId'=>$product->id,'productName'=>$name]).'">';
        $data .='<img _ngcontent-c4="" class="img img-fluid" src="'.$image.'" alt="">';
        $data .='</a>';
        $data .='</div>';
        $data .='<div _ngcontent-c8="" class="product-header pointer"tabindex="0">'.str_limit($product->name,40);
        $data .='<span _ngcontent-c8="" class="tooltiptext">'.$product->name. '('.$product->deal_code.')';
        $data .='</span>';
        $data .='</div>';
        $data .='<div _ngcontent-c4="" class="product-footer text-center">';
        $data .='<div _ngcontent-c4="" class="success mb-1" tabindex="0">';
        $data .='<p _ngcontent-c4="" class="sku">';
        $data .='[ <span _ngcontent-c4="" class="weight">'.$product->deal_code.'</span> ]';
        $data .='</p>';
        $data .='<strong _ngcontent-c4="">';

        if(@$product->discount){
          $data .='<strong _ngcontent-c8="" class="old_price">৳ '.$product->price.'</strong>';
          $data .='<span _ngcontent-c4="" class="taka"> ৳</span> '.$product->discount.' <br>';
        }else{
          $data .='<span _ngcontent-c4="" class="taka">৳</span> '.$product->price.' <br _ngcontent-c4="">';
        }

        $data .='</strong>';
        $data .='</div>';
        $data .='<app-add-to-cart _ngcontent-c4="" _nghost-c6="">';
        $data .='<button _ngcontent-c6="" class="btn add-to-bag" onclick="addCart('.$product->id.','.$price.')">';
        $data .='<i _ngcontent-c6="" aria-hidden="true" class="fa fa-shopping-cart"></i> Add to Bag';
        $data .='</button>';
        $data .='<div _ngcontent-c6="" class="product-link">';
        $data .='<a _ngcontent-c6="" href="'.route('product.details',['productId'=>$product->id,'productName'=>$name]).'">Details</a>';
        $data .='</div>';
        $data .='</app-add-to-cart>';
        $data .='</div>';
        $data .='</div>';
        $data .='</div>';
      }
    }else{
      $data .='<div _ngcontent-c4="" class="col-md-12 col-12 p-1 mb-2">';
      $data .='<h3 style="text-align: center;">There is no product available of your request</h3>';
      $data .='</div">';
    }

    return response()->json([
            'totalProduct'=>count($totalProduct),
            'products'=>$data,
            'productLimit'=>$limit,
        ]);
  }
}
