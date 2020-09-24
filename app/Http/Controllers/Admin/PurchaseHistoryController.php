<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Vendors;
use App\Category;
use App\Product;

use App\CashPurchase;
use App\CreditPurchase;

use PDF;
use MPDF;

class PurchaseHistoryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Purchase History";

    	$fromDate = Date('Y-m-d',strtotime($request->from_date));
    	$toDate = Date('Y-m-d',strtotime($request->to_date));

    	$supplier = $request->supplier;
    	$purchaseType = $request->purchase_type;
    	$productCategory = $request->product_category;
    	$product = $request->product;

    	$cashPurchases = array();
    	$creditPurchases = array();

    	$vendors = Vendors::orderBy('vendorName','asc')->get();
    	$categories = Category::orderBy('categoryName','asc')->get();
    	$products = Product::orderBy('name','asc')->get();

    	// $data = $request->all();
    	// dd($productCategory);
    	if($this->deliveryZoneId){
			$cashPurchases = CashPurchase::select('cash_purchase.*','cash_purchase_item.product_id','cash_purchase_item.qty','cash_purchase_item.rate','cash_purchase_item.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('cash_purchase_item','cash_purchase_item.cash_puchase_id','=','cash_purchase.id')
				->join('products','products.id','=','cash_purchase_item.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','cash_purchase.supplier_id')
				->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$cashQuery->whereBetween('cash_purchase.voucher_date', array($fromDate,$toDate));
		    		}

		    		if (@$supplier)
		    		{
		    			$cashQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$cashQuery->whereIn('cash_purchase.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$cashQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$cashQuery->whereIn('products.id',$product);
		    		}
				})
	            ->where('cash_purchase.delivery_zone_id',$this->deliveryZoneId)
	            ->get();

			$creditPurchases = CreditPurchase::select('credit_purchases.*','credit_purchase_items.product_id','credit_purchase_items.qty','credit_purchase_items.rate','credit_purchase_items.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('credit_purchase_items','credit_purchase_items.credit_puchase_id','=','credit_purchases.id')
				->join('products','products.id','=','credit_purchase_items.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','credit_purchases.supplier_id')
				->orWhere(function($creditQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$creditQuery->whereBetween('credit_purchases.voucher_date', array($fromDate,$toDate));
		    		}

		    		if ($supplier)
		    		{
		    			$creditQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$creditQuery->whereIn('credit_purchases.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$creditQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$creditQuery->whereIn('products.id',$product);
		    		}
				})
	            ->where('credit_purchases.delivery_zone_id',$this->deliveryZoneId)
	            ->get();
	     }else{
	     	$cashPurchases = CashPurchase::select('cash_purchase.*','cash_purchase_item.product_id','cash_purchase_item.qty','cash_purchase_item.rate','cash_purchase_item.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('cash_purchase_item','cash_purchase_item.cash_puchase_id','=','cash_purchase.id')
				->join('products','products.id','=','cash_purchase_item.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','cash_purchase.supplier_id')
				->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$cashQuery->whereBetween('cash_purchase.voucher_date', array($fromDate,$toDate));
		    		}

		    		if (@$supplier)
		    		{
		    			$cashQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$cashQuery->whereIn('cash_purchase.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$cashQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$cashQuery->whereIn('products.id',$product);
		    		}
				})
	            ->get();

			$creditPurchases = CreditPurchase::select('credit_purchases.*','credit_purchase_items.product_id','credit_purchase_items.qty','credit_purchase_items.rate','credit_purchase_items.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('credit_purchase_items','credit_purchase_items.credit_puchase_id','=','credit_purchases.id')
				->join('products','products.id','=','credit_purchase_items.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','credit_purchases.supplier_id')
				->orWhere(function($creditQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$creditQuery->whereBetween('credit_purchases.voucher_date', array($fromDate,$toDate));
		    		}

		    		if ($supplier)
		    		{
		    			$creditQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$creditQuery->whereIn('credit_purchases.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$creditQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$creditQuery->whereIn('products.id',$product);
		    		}
				})
	            ->get();
	     }
    	return view('admin.purchaseHistory.index')->with(compact('title','vendors','categories','products','cashPurchases','creditPurchases','fromDate','toDate','supplier','purchaseType','productCategory','product'));
    }

    public function print(Request $request)
    {
    	$title = "Print Purchase History";

    	$fromDate = Date('Y-m-d',strtotime($request->from_date));
    	$toDate = Date('Y-m-d',strtotime($request->to_date));

    	$supplier = $request->supplier;
    	$purchaseType = $request->purchase_type;
    	$productCategory = $request->product_category;
    	$product = $request->product;

    	$cashPurchases = array();
    	$creditPurchases = array();

    	// $data = $request->all();
    	// dd($productCategory);
    	if($this->deliveryZoneId){
			$cashPurchases = CashPurchase::select('cash_purchase.*','cash_purchase_item.product_id','cash_purchase_item.qty','cash_purchase_item.rate','cash_purchase_item.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('cash_purchase_item','cash_purchase_item.cash_puchase_id','=','cash_purchase.id')
				->join('products','products.id','=','cash_purchase_item.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','cash_purchase.supplier_id')
				->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$cashQuery->whereBetween('cash_purchase.voucher_date', array($fromDate,$toDate));
		    		}

		    		if (@$supplier)
		    		{
		    			$cashQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$cashQuery->whereIn('cash_purchase.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$cashQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$cashQuery->whereIn('products.id',$product);
		    		}
				})
	            ->where('cash_purchase.delivery_zone_id',$this->deliveryZoneId)
	            ->get();

			$creditPurchases = CreditPurchase::select('credit_purchases.*','credit_purchase_items.product_id','credit_purchase_items.qty','credit_purchase_items.rate','credit_purchase_items.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('credit_purchase_items','credit_purchase_items.credit_puchase_id','=','credit_purchases.id')
				->join('products','products.id','=','credit_purchase_items.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','credit_purchases.supplier_id')
				->orWhere(function($creditQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$creditQuery->whereBetween('credit_purchases.voucher_date', array($fromDate,$toDate));
		    		}

		    		if ($supplier)
		    		{
		    			$creditQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$creditQuery->whereIn('credit_purchases.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$creditQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$creditQuery->whereIn('products.id',$product);
		    		}
				})
	            ->where('credit_purchases.delivery_zone_id',$this->deliveryZoneId)
	            ->get();
	     }else{
	     	$cashPurchases = CashPurchase::select('cash_purchase.*','cash_purchase_item.product_id','cash_purchase_item.qty','cash_purchase_item.rate','cash_purchase_item.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('cash_purchase_item','cash_purchase_item.cash_puchase_id','=','cash_purchase.id')
				->join('products','products.id','=','cash_purchase_item.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','cash_purchase.supplier_id')
				->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$cashQuery->whereBetween('cash_purchase.voucher_date', array($fromDate,$toDate));
		    		}

		    		if (@$supplier)
		    		{
		    			$cashQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$cashQuery->whereIn('cash_purchase.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$cashQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$cashQuery->whereIn('products.id',$product);
		    		}
				})
	            ->get();

			$creditPurchases = CreditPurchase::select('credit_purchases.*','credit_purchase_items.product_id','credit_purchase_items.qty','credit_purchase_items.rate','credit_purchase_items.amount','categories.categoryName','products.name','vendors.vendorName as vendorName')
				->join('credit_purchase_items','credit_purchase_items.credit_puchase_id','=','credit_purchases.id')
				->join('products','products.id','=','credit_purchase_items.product_id')
				->join('categories','categories.id','=','products.category_id')
				->join('vendors','vendors.id','=','credit_purchases.supplier_id')
				->orWhere(function($creditQuery) use($fromDate,$toDate,$supplier,$purchaseType,$productCategory,$product){
		    		if (!empty($fromDate))
		    		{
		    			$creditQuery->whereBetween('credit_purchases.voucher_date', array($fromDate,$toDate));
		    		}

		    		if ($supplier)
		    		{
		    			$creditQuery->whereIn('vendors.id',$supplier);
		    		}

		    		if ($purchaseType)
		    		{
		    			$creditQuery->whereIn('credit_purchases.type',$purchaseType);
		    		}

		    		if ($productCategory)
		    		{
		    			$creditQuery->whereIn('categories.id',$productCategory);
		    		}

		    		if ($product)
		    		{
		    			$creditQuery->whereIn('products.id',$product);
		    		}
				})
	            ->get();
	     }
		$pdf = PDF::loadView('admin.purchaseHistory.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'cashPurchases'=>$cashPurchases,'creditPurchases'=>$creditPurchases]);

        return $pdf->stream('purchase_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
