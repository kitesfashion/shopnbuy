<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use DB;
use Session;
use App\Product;
use App\ProductSections;
use App\Review;

class ProductController extends Controller
{
  public function ProductDetails($id){
    $product = Product::where('id',$id)->first();
    $productSection = ProductSections::where('productId',@$product->id)->first();
    $relatedProduct = explode(',', $productSection->related_product);
    $relatedProductList = Product::whereIn('id',$relatedProduct)
                                        ->where('status',1)
                                        ->orderBy('orderBy',"ASC")
                                        ->get();
    $reviews = Review::where('status','1')->where('productId',$id)->get();
    $metaTag =[
      'meta_keyword'=>$product->metaKeyword,
      'meta_title' =>$product->metaTitle,
      'meta_description' =>$product->metaDescription
    ];

    $title = $product->name;
    return view('frontend.product.product_details')->with(compact('product','metaTag','title','reviews','relatedProductList'));
  }
}
