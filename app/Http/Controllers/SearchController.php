<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use DB;

use App\Category;
use App\Product;

class SearchController extends Controller
{
  public function searchProduct(Request $request){
    $search = $_GET['search_query'];
    $productList = Product::where('status',1)
                ->where('name','LIKE','%'.$search.'%')
                ->orWhere('deal_code','LIKE','%'.$search.'%')
                ->orWhere('tag','LIKE','%'.$search.'%')
                ->get();
    return view('frontend.search.searchProduct')->with(compact('productList','search'));
  }
}
