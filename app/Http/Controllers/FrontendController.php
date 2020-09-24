<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

use DB;
use Session;
use App\Policy;
use App\Category;
use App\Product;
use App\ProductSections;
use App\Slider;
use App\Settings;
use App\Article;
use App\Banner;
use App\DeliveryZone;
use App\Area;

class FrontendController extends Controller
{
  public function index()
  {    
    $metaInfo = Settings::first();
    $title = $metaInfo->siteTitle;
    $metaTag =[
      'meta_keyword'=>$metaInfo->metaKeyword,
      'meta_title' =>$metaInfo->metaTitle,
      'meta_description' =>$metaInfo->metaDescription
    ];
    $sliders = Slider::where('status',1)->orderBy('orderBy','ASC')->get();

    $exclusiveBannerList = Banner::where('bannerStatus',1)->orderBy('orderBy','ASC')->get();

    $newProductList = DB::table('product_sections')
                      ->select('product_sections.productId','product_sections.productSection','products.*')
                      ->join('products','products.id','=','product_sections.productId')
                      ->whereRaw('FIND_IN_SET(?,product_sections.productSection)',1)
                      ->where('status',1)
                      ->orderBy('orderBy','ASC')
                      ->get();

    $categoryList = Category::where('categoryStatus',1)->where('showInHomepage',1)->orderBy('orderBy','ASC')->get();

    $homeCategoryListWithoutSubcategory = Category::where('categoryStatus',1)->where('showInHomeCategoryProduct',1)->orderBy('orderBy','ASC')->get();

    $homeCategoryListWithSubcategory = Category::where('categoryStatus',1)->where('showInHomeCategoryProductWithSubcategory',1)->orderBy('orderBy','ASC')->get();

     $firstTopGadgetProduct = DB::table('product_sections')
                      ->select('product_sections.productId','product_sections.productSection','products.*')
                      ->join('products','products.id','=','product_sections.productId')
                      ->whereRaw('FIND_IN_SET(?,product_sections.productSection)',2)
                      ->where('status',1)
                      ->orderBy('orderBy','ASC')
                      ->first();

    $topGadgetProductList = DB::table('product_sections')
                      ->select('product_sections.productId','product_sections.productSection','products.*')
                      ->join('products','products.id','=','product_sections.productId')
                      ->whereRaw('FIND_IN_SET(?,product_sections.productSection)',2)
                      ->where('status',1)
                      ->take(7)
                      ->orderBy('orderBy','ASC')
                      ->get();

    $homeCategoryListWithProduct = Category::where('categoryStatus',1)->where('showInHomeCategoryProductWithProduct',1)->orderBy('orderBy','ASC')->get();

    $about = Article::where('id','1')->where('articleStatus',1)->first();
    $policyList = Policy::where('policiesStatus','1')->orderBy('orderBy','ASC')->get();

    return view('frontend.home.home')->with(compact('title','metaTag','sliders','exclusiveBannerList','newProductList','categoryList','homeCategoryListWithoutSubcategory','homeCategoryListWithSubcategory','firstTopGadgetProduct','topGadgetProductList','homeCategoryListWithProduct','about','policyList'));
  }

  public function searchProduct(Request $request){
    //$search = $request->searchProduct;
    $search = $_GET['search_query'];
    // dd($search);
    $categories = @$request->categorySelect;
    if ($categories) {
      $products = Product::where('status',1)
                        ->where('name','LIKE','%'.$search.'%')
                        ->orWhere('deal_code','LIKE','%'.$search.'%')
                        ->paginate(10);
      $products->appends(['searchProduct' => $search]);
    }else{
      $products = Product::where('status',1)
                        ->where('name','LIKE','%'.$search.'%')
                        ->orWhere('deal_code','LIKE','%'.$search.'%')
                        ->paginate(10);
      $products->appends(['searchProduct' => $search]);
    }

    $categorySelect = Category::where('id',$categories)->first();

    return view('frontend.search.searchProduct')->with(compact('products','search','categorySelect'));
  }

  public function GetDeliveryArea(Request $request){
        $areaList = Area::where('delivery_zone_id',$request->delivery_zone_id)->get();
        $data = "";
        $data .= '<option value="">Select Delivery Area</option>';
        foreach ($areaList as $area) {
            $data .= '<option value="'.$area->id.'">'.$area->name.'</option>';
        }

        return response()->json([
            'area'=>$data
        ]);
    }

  public function Page404(){
      return view('frontend.pages.page404');
  }
}
