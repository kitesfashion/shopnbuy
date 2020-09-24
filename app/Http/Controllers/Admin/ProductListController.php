<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;

use DB;
use PDF;
use MPDF;

class ProductListController extends Controller
{
    public function index(Request $request)
    {
        $title = "Product List";

        $product_category = $request->product_category;
        $product = $request->product;

        $categories = Category::orderBy('categoryName','asc')->get();
        $products = Product::orderBy('name','asc')->get();

    	// $data = $request->all();
    	// dd($data);

        if ($product_category == "" && $product == "")
        {
        	$productLists = array();
        }
        else
        {
	        $productLists = Product::select('categories.categoryName as categoryName','products.name as productName','products.price as unitPrice')
	        	->join('categories','categories.id','=','products.category_id')
	            ->orWhere(function($query) use($product_category,$product){
	                if ($product_category)
	                {
	                    $query->whereIn('categories.id',$product_category);
	                }

	                if ($product)
	                {
	                    $query->whereIn('products.id',$product);
	                }
	            })
	            ->orderBy('categoryName')
	            ->orderBy('productName')
	            ->get();
        }

        return view('admin.productList.index')->with(compact('title','categories','products','productLists','product_category','product'));
    }

    public function print(Request $request)
    {
        $title = "Print Product List";

        $product_category = $request->product_category;
        $product = $request->product;

    	// $data = $request->all();
    	// dd($data);

        if ($product_category == "" && $product == "")
        {
        	$productLists = array();
        }
        else
        {
	        $productLists = Product::select('categories.categoryName as categoryName','products.name as productName','products.price as unitPrice')
	        	->join('categories','categories.id','=','products.category_id')
	            ->orWhere(function($query) use($product_category,$product){
	                if ($product_category)
	                {
	                    $query->whereIn('categories.id',$product_category);
	                }

	                if ($product)
	                {
	                    $query->whereIn('products.id',$product);
	                }
	            })
	            ->orderBy('categoryName')
	            ->orderBy('productName')
	            ->get();
        }

        $pdf = PDF::loadView('admin.productList.print',['title'=>$title,'productLists'=>$productLists]);

        return $pdf->stream('product_lists.pdf');
    }
}
