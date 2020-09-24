<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Customer;
use App\Product;

use DB;
use PDF;

class ProductWiseProfitController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Product Wise Profit";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        // $customer = $request->customer;
        $product = $request->product;

    	$customers = Customer::orderBy('name','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	$productWiseProfits = array();
        if($this->deliveryZoneId){
            $productWiseProfits = DB::table('product_wise_profit')
            ->select('categories.categoryName as categoryName','product_wise_profit.productId as productId','products.name as productName','products.deal_code as code',DB::raw('SUM(product_wise_profit.cashProductQty) + SUM(product_wise_profit.creditProductQty) AS qty'), DB::raw('SUM(product_wise_profit.cashPriceAmount) + SUM(product_wise_profit.creditPriceAmount) as price'), DB::raw('SUM(product_wise_profit.cashVatAmount) + SUM(product_wise_profit.creditVatAmount) as vat'), DB::raw('SUM(product_wise_profit.cashDiscountAmount) + SUM(product_wise_profit.creditDiscountAmount) as discount'))
            ->join('categories','categories.id','=','product_wise_profit.categoryId')
            ->join('products','products.id','=','product_wise_profit.productId')
            ->orWhere(function($query) use($fromDate,$toDate,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('product_wise_profit.date', array($fromDate,$toDate));
                }

                if (@$product)
                {
                    $query->where('product_wise_profit.productId',$product);
                }
            })
            ->where('product_wise_profit.delivery_zone_id',$this->deliveryZoneId)
            ->groupBy('product_wise_profit.productId')
            ->orderBy('productName')
            ->get();
        }else{
            $productWiseProfits = DB::table('product_wise_profit')
            ->select('categories.categoryName as categoryName','product_wise_profit.productId as productId','products.name as productName','products.deal_code as code',DB::raw('SUM(product_wise_profit.cashProductQty) + SUM(product_wise_profit.creditProductQty) AS qty'), DB::raw('SUM(product_wise_profit.cashPriceAmount) + SUM(product_wise_profit.creditPriceAmount) as price'), DB::raw('SUM(product_wise_profit.cashVatAmount) + SUM(product_wise_profit.creditVatAmount) as vat'), DB::raw('SUM(product_wise_profit.cashDiscountAmount) + SUM(product_wise_profit.creditDiscountAmount) as discount'))
            ->join('categories','categories.id','=','product_wise_profit.categoryId')
            ->join('products','products.id','=','product_wise_profit.productId')
            ->orWhere(function($query) use($fromDate,$toDate,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('product_wise_profit.date', array($fromDate,$toDate));
                }

                if (@$product)
                {
                    $query->where('product_wise_profit.productId',$product);
                }
            })
            ->groupBy('product_wise_profit.productId')
            ->orderBy('productName')
            ->get();
        }
    	return view('admin.productWiseProfit.index')->with(compact('title','products','fromDate','toDate','product','productWiseProfits'));
    }

     public function print(Request $request)
    {
        $title = "Print Product Wise Report";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        // $customer = $request->customer;
        $product = $request->product;

        $customers = Customer::orderBy('name','asc')->get();
        $products = Product::orderBy('name','asc')->get();

        $productWiseProfits = array();
        if($this->deliveryZoneId){
            $productWiseProfits = DB::table('product_wise_profit')
            ->select('categories.categoryName as categoryName','product_wise_profit.productId as productId','products.name as productName','products.deal_code as code',DB::raw('SUM(product_wise_profit.cashProductQty) + SUM(product_wise_profit.creditProductQty) AS qty'), DB::raw('SUM(product_wise_profit.cashPriceAmount) + SUM(product_wise_profit.creditPriceAmount) as price'), DB::raw('SUM(product_wise_profit.cashVatAmount) + SUM(product_wise_profit.creditVatAmount) as vat'), DB::raw('SUM(product_wise_profit.cashDiscountAmount) + SUM(product_wise_profit.creditDiscountAmount) as discount'))
            ->join('categories','categories.id','=','product_wise_profit.categoryId')
            ->join('products','products.id','=','product_wise_profit.productId')
            ->orWhere(function($query) use($fromDate,$toDate,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('product_wise_profit.date', array($fromDate,$toDate));
                }

                if (@$product)
                {
                    $query->where('product_wise_profit.productId',$product);
                }
            })
            ->where('product_wise_profit.delivery_zone_id',$this->deliveryZoneId)
            ->groupBy('product_wise_profit.productId')
            ->orderBy('productName')
            ->get();
        }else{
            $productWiseProfits = DB::table('product_wise_profit')
            ->select('categories.categoryName as categoryName','product_wise_profit.productId as productId','products.name as productName','products.deal_code as code',DB::raw('SUM(product_wise_profit.cashProductQty) + SUM(product_wise_profit.creditProductQty) AS qty'), DB::raw('SUM(product_wise_profit.cashPriceAmount) + SUM(product_wise_profit.creditPriceAmount) as price'), DB::raw('SUM(product_wise_profit.cashVatAmount) + SUM(product_wise_profit.creditVatAmount) as vat'), DB::raw('SUM(product_wise_profit.cashDiscountAmount) + SUM(product_wise_profit.creditDiscountAmount) as discount'))
            ->join('categories','categories.id','=','product_wise_profit.categoryId')
            ->join('products','products.id','=','product_wise_profit.productId')
            ->orWhere(function($query) use($fromDate,$toDate,$product){
                if (!empty($fromDate))
                {
                    $query->whereBetween('product_wise_profit.date', array($fromDate,$toDate));
                }

                if (@$product)
                {
                    $query->where('product_wise_profit.productId',$product);
                }
            })
            ->groupBy('product_wise_profit.productId')
            ->orderBy('productName')
            ->get();
        }
        $pdf = PDF::loadView('admin.productWiseProfit.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'product'=>$product,'productWiseProfits'=>$productWiseProfits]);

        return $pdf->stream('product_wise_profit_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
