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

class OutOfStockReportController extends Controller
{
	public function index(Request $request)
	{
        $title = "Stock Status Report";

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

        $stockOutReports = array();

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $stockOutReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId as productId','products.name as productName','products.deal_code as code','products.reorder_qty as reorderQty', DB::raw('(((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) - ((SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty)) - SUM(stock_valuation_report.salesReturnQty))) as remainingQty'))
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
            $stockOutReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId as productId','products.name as productName','products.deal_code as code','products.reorder_qty as reorderQty', DB::raw('(((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) - ((SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty)) - SUM(stock_valuation_report.salesReturnQty))) as remainingQty'))
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
        // dd($stockOutReports);

        return view('admin.outOfStockReport.index')->with(compact('title','categories','category','products','product','stockOutReports'));
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
        $title = "Print Stock Status Report";

        $category = $request->category;
        $product = $request->product;

        $stockOutReports = array();

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $stockOutReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId as productId','products.name as productName','products.deal_code as code','products.reorder_qty as reorderQty', DB::raw('(((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) - ((SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty)) - SUM(stock_valuation_report.salesReturnQty))) as remainingQty'))
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
            $stockOutReports = DB::table('stock_valuation_report')
            ->select('stock_valuation_report.categoryId','categories.categoryName as categoryName','stock_valuation_report.productId as productId','products.name as productName','products.reorder_qty as reorderQty', DB::raw('(((SUM(stock_valuation_report.cashPurchaseQty) + SUM(stock_valuation_report.creditPurchaseQty)) - SUM(stock_valuation_report.purchaseReturnQty)) - ((SUM(stock_valuation_report.cashSaleQty) + SUM(stock_valuation_report.creditSaleQty)) - SUM(stock_valuation_report.salesReturnQty))) as remainingQty'))
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
        // dd($stockOutReports);

        $pdf = PDF::loadView('admin.outOfstockReport.print',['title'=>$title,'stockOutReports'=>$stockOutReports]);

        return $pdf->stream('out_of_stock_history.pdf');
	}
}
