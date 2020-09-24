<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Vendors;
use App\Category;
use App\Product;

use DB;
use PDF;
use MPDF;

class StockValuationReportController extends Controller
{
	public function index(Request $request)
	{
        $title = "Stock Valuation Report";

        $category = $request->category;
        $product = $request->product;

        $categories = Category::orderBy('categoryName','asc')->get();

        if ($category)
        {
	    	$products = DB::table('products')
	    	    ->Where(function($query) use($category){
	                if (@$category)
	                {
	                	foreach ($category as $categoryInfo)
	                	{
	                    	$query->orWhereRaw('find_in_set(?,category_id)',[$categoryInfo]);
	                	}
	                }
	             })
	    		->orderBy('name','asc')
	    		->get();
        }
        else
        {
        	$products = Array();
        }

        $stockValuationReports = array();

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $stockValuationReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId','products.name as productName','products.deal_code as code', DB::raw('SUM(stock_valuation_report.cashSaleAmount) + SUM(stock_valuation_report.creditSaleAmount) as salesPrice'), DB::raw('((SUM(stock_valuation_report.cashPurchaseAmount) + SUM(stock_valuation_report.creditPurchaseAmount)) - SUM(stock_valuation_report.purchaseReturnAmount)) / ((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) as avgLifting'), DB::raw('(SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty) + SUM(stock_valuation_report.salesReturnQty)) - (SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty) + SUM(stock_valuation_report.purchaseReturnQty)) as stockQty'))
            ->join('categories','categories.id','=','stock_valuation_report.categoryId')
            ->join('products','products.id','=','stock_valuation_report.productId')
            ->orWhere(function($query) use($category,$product){
                if (@$category)
                {
                	foreach ($category as $categoryId)
                	{
                		$query->whereRaw('find_in_set(?,stock_valuation_report.categoryId)',[$categoryId]);
                	}
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation_report.productId',$product);
                }
            })
            ->groupBy('stock_valuation_report.categoryId','categories.categoryName','stock_valuation_report.productId','products.name')
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->where('stock_valuation_report.delivery_zone_id',$this->deliveryZoneId)
            ->get();
        }else{
            $stockValuationReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId','products.name as productName','products.deal_code as code', DB::raw('SUM(stock_valuation_report.cashSaleAmount) + SUM(stock_valuation_report.creditSaleAmount) as salesPrice'), DB::raw('((SUM(stock_valuation_report.cashPurchaseAmount) + SUM(stock_valuation_report.creditPurchaseAmount)) - SUM(stock_valuation_report.purchaseReturnAmount)) / ((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) as avgLifting'), DB::raw('(SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty) + SUM(stock_valuation_report.salesReturnQty)) - (SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty) + SUM(stock_valuation_report.purchaseReturnQty)) as stockQty'))
            ->join('categories','categories.id','=','stock_valuation_report.categoryId')
            ->join('products','products.id','=','stock_valuation_report.productId')
            ->orWhere(function($query) use($category,$product){
                if (@$category)
                {
                    foreach ($category as $categoryId)
                    {
                        $query->whereRaw('find_in_set(?,stock_valuation_report.categoryId)',[$categoryId]);
                    }
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation_report.productId',$product);
                }
            })
            ->groupBy('stock_valuation_report.categoryId','categories.categoryName','stock_valuation_report.productId','products.name')
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->get();
        }
        // dd($stockValuationReports);

        return view('admin.stockValuationReport.index')->with(compact('title','categories','category','products','product','stockValuationReports'));
	}

    public function getAllProductByCategory(Request $request)
    {
    	$output = '';
    	$results = '';
    	$ids = $request->id;

    	$products = DB::table('products')
    	    ->Where(function($query) use($ids){
                if (@$ids)
                {
                	foreach ($ids as $id)
                	{
                    	$query->orWhereRaw('find_in_set(?,category_id)',[$id]);
                	}
                }
             })
    		->orderBy('name','asc')
    		->get();

    	if ($products)
    	{
    		$output .= '<select class="form-control chosen-select" id="product" name="product[]" multiple>';
    		$output .= '<option value="">Select Product</option>';    		
    		foreach ($products as $product)
    		{
    			$output .= '<option value="'.$product->id.'">'.$product->name.'</option>';
    		}
    		$output .= '</select>';    		
    	}
    	else
    	{
    		$output .= '<select class="form-control chosen-select" id="product" name="product[]" multiple>';
    		$output .= '</select>';
    	}  

    	echo $output;    	
    }

	public function print(Request $request)
	{
        $title = "Print Stock Valuation Report";

        $category = $request->category;
        $product = $request->product;

        $stockValuationReports = array();

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $stockValuationReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId','products.name as productName','products.deal_code as code', DB::raw('SUM(stock_valuation_report.cashSaleAmount) + SUM(stock_valuation_report.creditSaleAmount) as salesPrice'), DB::raw('(SUM(stock_valuation_report.cashPurchaseAmount) + SUM(stock_valuation_report.creditPurchaseAmount)) / (SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) as avgLifting'), DB::raw('(SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty) + SUM(stock_valuation_report.salesReturnQty)) - (SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty) + SUM(stock_valuation_report.purchaseReturnQty)) as stockQty'))
            ->join('categories','categories.id','=','stock_valuation_report.categoryId')
            ->join('products','products.id','=','stock_valuation_report.productId')
            ->orWhere(function($query) use($category,$product){
                if (@$category)
                {
                    foreach ($category as $categoryId)
                    {
                        $query->whereRaw('find_in_set(?,stock_valuation_report.categoryId)',[$categoryId]);
                    }
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation_report.productId',$product);
                }
            })
            ->groupBy('stock_valuation_report.categoryId','categories.categoryName','stock_valuation_report.productId','products.name')
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->where('stock_valuation_report.delivery_zone_id',$this->deliveryZoneId)
            ->get();
        }else{
            $stockValuationReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId','products.name as productName','products.deal_code as code', DB::raw('SUM(stock_valuation_report.cashSaleAmount) + SUM(stock_valuation_report.creditSaleAmount) as salesPrice'), DB::raw('(SUM(stock_valuation_report.cashPurchaseAmount) + SUM(stock_valuation_report.creditPurchaseAmount)) / (SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) as avgLifting'), DB::raw('(SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty) + SUM(stock_valuation_report.salesReturnQty)) - (SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty) + SUM(stock_valuation_report.purchaseReturnQty)) as stockQty'))
            ->join('categories','categories.id','=','stock_valuation_report.categoryId')
            ->join('products','products.id','=','stock_valuation_report.productId')
            ->orWhere(function($query) use($category,$product){
                if (@$category)
                {
                	foreach ($category as $categoryId)
                	{
                		$query->whereRaw('find_in_set(?,stock_valuation_report.categoryId)',[$categoryId]);
                	}
                }

                if (@$product)
                {
                    $query->whereIn('stock_valuation_report.productId',$product);
                }
            })
            ->groupBy('stock_valuation_report.categoryId','categories.categoryName','stock_valuation_report.productId','products.name')
            ->orderBy('categoryId','asc')
            ->orderBy('productId','asc')
            ->get();
        }
        $pdf = PDF::loadView('admin.stockValuationReport.print',['title'=>$title,'stockValuationReports'=>$stockValuationReports]);

        return $pdf->stream('stock_valuation_history.pdf');
	}
}
