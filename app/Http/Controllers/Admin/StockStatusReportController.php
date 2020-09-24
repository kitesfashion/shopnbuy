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

class StockStatusReportController extends Controller
{
    public function index(Request $request)
    {
        $title = "Stock Status Report";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        $supplier = $request->supplier;
        $category = $request->category;
        $product = $request->product;

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

        $previousBalances = array();
        $supplierStatements = array();

        $vendors = Vendors::orderBy('vendorName','asc')->get();
        $categories = Category::orderBy('categoryName','asc')->get();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $openingBalance = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId', 'categories.categoryName as categoryName', 'stock_status_report.productId', 'products.name as productName','products.deal_code as code', DB::raw('SUM(stock_status_report.receiveQty) - (SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty)) as opening'), DB::raw('0 as receiveQty'), DB::raw('0 as saleQty'), DB::raw('0 as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($lastDate,$category,$product,$supplier){
                    if (!empty($lastDate))
                    {
                        $query->where('stock_status_report.date','<=', $lastDate);
                    }

                    if (@$category)
                    {
                    	foreach ($category as $categoryId)
                    	{
                    		$query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                    	}
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->where('stock_status_report.delivery_zone_id',$this->deliveryZoneId)
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name');

            $stockStatusReports = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId','categories.categoryName as categoryName','stock_status_report.productId','products.name as productName','products.deal_code as code', DB::raw('0 as opening'), DB::raw('SUM(stock_status_report.receiveQty) as receiveQty'), DB::raw('SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty) as saleQty'), DB::raw('sum(stock_status_report.receiveAmount)/SUM(stock_status_report.receiveQty) as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($fromDate,$toDate,$category,$product,$supplier){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('stock_status_report.date', array($fromDate,$toDate));
                    }

                    if (@$category)
                    {
                    	foreach ($category as $categoryId)
                    	{
                    		$query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                    	}
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name')
                ->unionAll($openingBalance)
                ->orderBy('categoryId','asc')
                ->orderBy('productId','asc')
                ->where('stock_status_report.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $openingBalance = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId', 'categories.categoryName as categoryName', 'stock_status_report.productId', 'products.name as productName','products.deal_code as code', DB::raw('SUM(stock_status_report.receiveQty) - (SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty)) as opening'), DB::raw('0 as receiveQty'), DB::raw('0 as saleQty'), DB::raw('0 as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($lastDate,$category,$product,$supplier){
                    if (!empty($lastDate))
                    {
                        $query->where('stock_status_report.date','<=', $lastDate);
                    }

                    if (@$category)
                    {
                        foreach ($category as $categoryId)
                        {
                            $query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                        }
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name');

            $stockStatusReports = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId','categories.categoryName as categoryName','stock_status_report.productId','products.name as productName','products.deal_code as code', DB::raw('0 as opening'), DB::raw('SUM(stock_status_report.receiveQty) as receiveQty'), DB::raw('SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty) as saleQty'), DB::raw('sum(stock_status_report.receiveAmount)/SUM(stock_status_report.receiveQty) as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($fromDate,$toDate,$category,$product,$supplier){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('stock_status_report.date', array($fromDate,$toDate));
                    }

                    if (@$category)
                    {
                        foreach ($category as $categoryId)
                        {
                            $query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                        }
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name')
                ->unionAll($openingBalance)
                ->orderBy('categoryId','asc')
                ->orderBy('productId','asc')
                ->get();
        }

        // DB::select(
        // 	'
        // 	CREATE OR REPLACE VIEW stock_status_report_temporary_table AS
        // 	SELECT `stock_status_report`.`categoryId` AS categoryId, `categories`.`categoryName` AS `categoryName`, `stock_status_report`.`productId` AS productId, `products`.`name` AS `productName`, 0 AS opening, SUM(stock_status_report.receiveQty) AS receiveQty, SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty) AS saleQty
        // 	FROM `stock_status_report` INNER JOIN `categories` ON `categories`.`id` = `stock_status_report`.`categoryId` INNER JOIN `products` ON `products`.`id` = `stock_status_report`.`productId`
        // 	WHERE (`stock_status_report`.`date` BETWEEN "'.$fromDate.'" AND "'.$toDate.'" AND `stock_status_report`.`categoryId` IN ('.$category.') AND `stock_status_report`.`productId` IN ('.$product.'))
        // 	GROUP BY `stock_status_report`.`categoryId`, `categories`.`categoryName`, `stock_status_report`.`productId`, `products`.`name`

        // 	UNION all

        // 	SELECT `stock_status_report`.`categoryId` AS categoryId, `categories`.`categoryName` AS `categoryName`, `stock_status_report`.`productId` AS productId, `products`.`name` AS `productName`, SUM(stock_status_report.receiveQty) - (SUM(stock_status_report.cAShSaleQty) + SUM(stock_status_report.creditSaleQty)) AS opening, 0 AS receiveQty, 0 AS saleQty
        // 	FROM `stock_status_report`

        // 	INNER JOIN `categories` ON `categories`.`id` = `stock_status_report`.`categoryId`
        // 	INNER JOIN `products` ON `products`.`id` = `stock_status_report`.`productId`
        // 	WHERE (`stock_status_report`.`date` <= "'.$lastDate.'" AND `stock_status_report`.`categoryId` IN ('.$category.') AND `stock_status_report`.`productId` IN ('.$product.'))
        // 	GROUP BY `stock_status_report`.`categoryId`, `categories`.`categoryName`, `stock_status_report`.`productId`, `products`.`name`

        // 	ORDER BY categoryId ASC, productId ASC
        // 	'
        // );

        // $stockStatusReports = DB::table('stock_status_report_temporary_table')
        // 	->select('categoryname','productId','productName', DB::raw('SUM(opening) as opening'), DB::raw('SUM(receiveQty) as receiveQty'), DB::raw('SUM(saleQty) as saleQty'), DB::raw('SUM(receiveQty) - SUM(saleQty) as balance'))
        // 	->groupBy('categoryName','productId','productName')
        // 	->get();

        // dd($stockStatusReport);

        return view('admin.stockStatusReport.index')->with(compact('title','fromDate','toDate','vendors','supplier','categories','category','products','product','stockStatusReports'));
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

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        $supplier = $request->supplier;
        $category = $request->category;
        $product = $request->product;

        $openingBalance = array();
        $stockStatusReports = array();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $openingBalance = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId', 'categories.categoryName as categoryName', 'stock_status_report.productId', 'products.name as productName','products.deal_code as code', DB::raw('SUM(stock_status_report.receiveQty) - (SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty)) as opening'), DB::raw('0 as receiveQty'), DB::raw('0 as saleQty'), DB::raw('0 as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($lastDate,$category,$product,$supplier){
                    if (!empty($lastDate))
                    {
                        $query->where('stock_status_report.date','<=', $lastDate);
                    }

                    if (@$category)
                    {
                        foreach ($category as $categoryId)
                        {
                            $query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                        }
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->where('stock_status_report.delivery_zone_id',$this->deliveryZoneId)
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name');

            $stockStatusReports = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId','categories.categoryName as categoryName','stock_status_report.productId','products.name as productName','products.deal_code as code', DB::raw('0 as opening'), DB::raw('SUM(stock_status_report.receiveQty) as receiveQty'), DB::raw('SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty) as saleQty'), DB::raw('sum(stock_status_report.receiveAmount)/SUM(stock_status_report.receiveQty) as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($fromDate,$toDate,$category,$product,$supplier){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('stock_status_report.date', array($fromDate,$toDate));
                    }

                    if (@$category)
                    {
                        foreach ($category as $categoryId)
                        {
                            $query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                        }
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name')
                ->unionAll($openingBalance)
                ->orderBy('categoryId','asc')
                ->orderBy('productId','asc')
                ->where('stock_status_report.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $openingBalance = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId', 'categories.categoryName as categoryName', 'stock_status_report.productId', 'products.name as productName', DB::raw('SUM(stock_status_report.receiveQty) - (SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty)) as opening'), DB::raw('0 as receiveQty'), DB::raw('0 as saleQty'), DB::raw('0 as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($lastDate,$category,$product,$supplier){
                    if (!empty($lastDate))
                    {
                        $query->where('stock_status_report.date','<=', $lastDate);
                    }

                    if (@$category)
                    {
                    	foreach ($category as $categoryId)
                    	{
                    		$query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                    	}
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name');

            $stockStatusReports = DB::table('stock_status_report')
                ->select('stock_status_report.categoryId','categories.categoryName as categoryName','stock_status_report.productId','products.name as productName', DB::raw('0 as opening'), DB::raw('SUM(stock_status_report.receiveQty) as receiveQty'), DB::raw('SUM(stock_status_report.cashSaleQty) + SUM(stock_status_report.creditSaleQty) as saleQty'), DB::raw('sum(stock_status_report.receiveAmount)/SUM(stock_status_report.receiveQty) as avgPrice'))
                ->join('categories','categories.id','=','stock_status_report.categoryId')
                ->join('products','products.id','=','stock_status_report.productId')
                ->orWhere(function($query) use($fromDate,$toDate,$category,$product,$supplier){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('stock_status_report.date', array($fromDate,$toDate));
                    }

                    if (@$category)
                    {
                    	foreach ($category as $categoryId)
                    	{
                    		$query->whereRaw('find_in_set(?,stock_status_report.categoryId)',[$categoryId]);
                    	}
                    }

                    if (@$product)
                    {
                        $query->whereIn('stock_status_report.productId',$product);
                    }

                    if (@$supplier)
                    {
                        $query->whereIn('stock_status_report.supplierId',$supplier);
                    }
                })
                ->groupBy('stock_status_report.categoryId','categories.categoryName','stock_status_report.productId','products.name')
                ->unionAll($openingBalance)
                ->orderBy('categoryId','asc')
                ->orderBy('productId','asc')
                ->get();
        }

        $pdf = PDF::loadView('admin.stockStatusReport.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'stockStatusReports'=>$stockStatusReports]);

        return $pdf->stream('supplier_statement_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
