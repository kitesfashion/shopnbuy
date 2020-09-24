<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Product;
use App\CashSale;
use App\CreditSale;
use App\ClientEntry;
use App\Vendors;
use PDF;
use MPDF;

class SalesHistoryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Sales History";

    	$fromDate = Date('Y-m-d',strtotime($request->from_date));
    	$toDate = Date('Y-m-d',strtotime($request->to_date));
    	$client = $request->client;
    	$company = $request->company;
    	$category = $request->category;
    	$product = $request->product;
    	$cashSales = array();
    	$creditSales = array();

    	$categories = Category::orderBy('categoryName','ASC')->get();
    	$products = Product::orderBy('name','ASC')->get();
    	$clients = ClientEntry::orderBy('name','ASC')->get();
    	$vendors = Vendors::orderBy('vendorName','ASC')->get();
    	if($this->deliveryZoneId){
    		$cashSales = CashSale::select('cash_sales.*','cash_sale_items.item_id','cash_sale_items.item_quantity','cash_sale_items.item_rate','cash_sale_items.item_price','categories.categoryName','products.name')
				->join('cash_sale_items','cash_sale_items.cash_sale_id','=','cash_sales.id')
				->join('products','products.id','=','cash_sale_items.item_id')
				->join('categories','categories.id','=','products.category_id')
				->orWhere(function($cashQuery) use($fromDate,$toDate,$category,$product,$client){
		    		if (!empty($fromDate))
		    		{
		    			$cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
		    		}

		    		if ($product)
		    		{
		    			$cashQuery->where('products.id',$product);
		    		}

		    		if ($category)
		    		{
		    			$cashQuery->where('categories.id',$category);
		    		}

		    		if ($client)
		    		{
		    			$cashQuery->where('cash_sales.payment_type',$client);
		    		}
				})
                ->where('cash_sales.delivery_zone_id',$this->deliveryZoneId)
                ->get();

			$creditSales = CreditSale::select('credit_sales.*','credit_sale_items.item_id','credit_sale_items.item_quantity','credit_sale_items.item_rate','credit_sale_items.item_price','categories.categoryName','products.name','client_entries.name as clientName')
				->join('credit_sale_items','credit_sale_items.credit_sale_id','=','credit_sales.id')
				->join('products','products.id','=','credit_sale_items.item_id')
				->join('categories','categories.id','=','products.category_id')
				->join('client_entries','client_entries.id','=','credit_sales.customer_id')
				->orWhere(function($creditQuery) use($fromDate,$toDate,$category,$product,$client){
		    		if (!empty($fromDate))
		    		{
		    			$creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
		    		}

		    		if ($product)
		    		{
		    			$creditQuery->where('products.id',$product);
		    		}

		    		if ($category)
		    		{
		    			$creditQuery->where('categories.id',$category);
		    		}

		    		if ($client)
		    		{
		    			$creditQuery->where('client_entries.id',$client);
		    		}
				})
                ->where('credit_sales.delivery_zone_id',$this->deliveryZoneId)
                ->get();
    	}else{
			$cashSales = CashSale::select('cash_sales.*','cash_sale_items.item_id','cash_sale_items.item_quantity','cash_sale_items.item_rate','cash_sale_items.item_price','categories.categoryName','products.name')
				->join('cash_sale_items','cash_sale_items.cash_sale_id','=','cash_sales.id')
				->join('products','products.id','=','cash_sale_items.item_id')
				->join('categories','categories.id','=','products.category_id')
				->orWhere(function($cashQuery) use($fromDate,$toDate,$category,$product,$client){
		    		if (!empty($fromDate))
		    		{
		    			$cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
		    		}

		    		if ($product)
		    		{
		    			$cashQuery->where('products.id',$product);
		    		}

		    		if ($category)
		    		{
		    			$cashQuery->where('categories.id',$category);
		    		}

		    		if ($client)
		    		{
		    			$cashQuery->where('cash_sales.payment_type',$client);
		    		}
				})->get();

			$creditSales = CreditSale::select('credit_sales.*','credit_sale_items.item_id','credit_sale_items.item_quantity','credit_sale_items.item_rate','credit_sale_items.item_price','categories.categoryName','products.name','client_entries.name as clientName')
				->join('credit_sale_items','credit_sale_items.credit_sale_id','=','credit_sales.id')
				->join('products','products.id','=','credit_sale_items.item_id')
				->join('categories','categories.id','=','products.category_id')
				->join('client_entries','client_entries.id','=','credit_sales.customer_id')
				->orWhere(function($creditQuery) use($fromDate,$toDate,$category,$product,$client){
		    		if (!empty($fromDate))
		    		{
		    			$creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
		    		}

		    		if ($product)
		    		{
		    			$creditQuery->where('products.id',$product);
		    		}

		    		if ($category)
		    		{
		    			$creditQuery->where('categories.id',$category);
		    		}

		    		if ($client)
		    		{
		    			$creditQuery->where('client_entries.id',$client);
		    		}
				})->get();
		}

    	return view('admin.salesHistory.index')->with(compact('title','fromDate','toDate','client','company','category','product','clients','vendors','categories','products','cashSales','creditSales'));
    }

    public function print(Request $request)
    {
    	$title = "Print Sales History";
    	$fromDate = Date('Y-m-d',strtotime($request->from_date));
    	$toDate = Date('Y-m-d',strtotime($request->to_date));
    	$client = $request->client;
    	$company = $request->company;
    	$category = $request->category;
    	$product = $request->product;
    	
    	$cashSales = array();
    	$creditSales = array();

    	// $data = $request->all();
    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";
    	// exit();
    if($this->deliveryZoneId){
		$cashSales = CashSale::select('cash_sales.*','cash_sale_items.item_id','cash_sale_items.item_quantity','cash_sale_items.item_rate','cash_sale_items.item_price','categories.categoryName','products.name')
			->join('cash_sale_items','cash_sale_items.cash_sale_id','=','cash_sales.id')
			->join('products','products.id','=','cash_sale_items.item_id')
			->join('categories','categories.id','=','products.category_id')
			->orWhere(function($cashQuery) use($fromDate,$toDate,$category,$product,$client){
	    		if (!empty($fromDate))
	    		{
	    			$cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
	    		}

	    		if ($product)
	    		{
	    			$cashQuery->where('products.id',$product);
	    		}

	    		if ($category)
	    		{
	    			$cashQuery->where('categories.id',$category);
	    		}

	    		if ($client)
	    		{
	    			$cashQuery->where('cash_sales.payment_type',$client);
	    		}
			})
            ->where('cash_sales.delivery_zone_id',$this->deliveryZoneId)
            ->get();

		$creditSales = CreditSale::select('credit_sales.*','credit_sale_items.item_id','credit_sale_items.item_quantity','credit_sale_items.item_rate','credit_sale_items.item_price','categories.categoryName','products.name','client_entries.name as clientName')
			->join('credit_sale_items','credit_sale_items.credit_sale_id','=','credit_sales.id')
			->join('products','products.id','=','credit_sale_items.item_id')
			->join('categories','categories.id','=','products.category_id')
			->join('client_entries','client_entries.id','=','credit_sales.customer_id')
			->orWhere(function($creditQuery) use($fromDate,$toDate,$category,$product,$client){
	    		if (!empty($fromDate))
	    		{
	    			$creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
	    		}

	    		if ($product)
	    		{
	    			$creditQuery->where('products.id',$product);
	    		}

	    		if ($category)
	    		{
	    			$creditQuery->where('categories.id',$category);
	    		}

	    		if ($client)
	    		{
	    			$creditQuery->where('client_entries.id',$client);
	    		}
			})
            ->where('credit_sales.delivery_zone_id',$this->deliveryZoneId)
            ->get();
	}else{
		$cashSales = CashSale::select('cash_sales.*','cash_sale_items.item_id','cash_sale_items.item_quantity','cash_sale_items.item_rate','cash_sale_items.item_price','categories.categoryName','products.name')
			->join('cash_sale_items','cash_sale_items.cash_sale_id','=','cash_sales.id')
			->join('products','products.id','=','cash_sale_items.item_id')
			->join('categories','categories.id','=','products.category_id')
			->orWhere(function($cashQuery) use($fromDate,$toDate,$category,$product,$client){
	    		if (!empty($fromDate))
	    		{
	    			$cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
	    		}

	    		if ($product)
	    		{
	    			$cashQuery->where('products.id',$product);
	    		}

	    		if ($category)
	    		{
	    			$cashQuery->where('categories.id',$category);
	    		}

	    		if ($client)
	    		{
	    			$cashQuery->where('cash_sales.payment_type',$client);
	    		}
			})->get();

		$creditSales = CreditSale::select('credit_sales.*','credit_sale_items.item_id','credit_sale_items.item_quantity','credit_sale_items.item_rate','credit_sale_items.item_price','categories.categoryName','products.name','client_entries.name as clientName')
			->join('credit_sale_items','credit_sale_items.credit_sale_id','=','credit_sales.id')
			->join('products','products.id','=','credit_sale_items.item_id')
			->join('categories','categories.id','=','products.category_id')
			->join('client_entries','client_entries.id','=','credit_sales.customer_id')
			->orWhere(function($creditQuery) use($fromDate,$toDate,$category,$product,$client){
	    		if (!empty($fromDate))
	    		{
	    			$creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
	    		}

	    		if ($product)
	    		{
	    			$creditQuery->where('products.id',$product);
	    		}

	    		if ($category)
	    		{
	    			$creditQuery->where('categories.id',$category);
	    		}

	    		if ($client)
	    		{
	    			$creditQuery->where('client_entries.id',$client);
	    		}
			})->get();
	}

		$customPaper = array(0,0,720,1440);

		$pdf = PDF::loadView('admin.salesHistory.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'cashSales'=>$cashSales,'creditSales'=>$creditSales]);

        return $pdf->stream('cash_sales_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
