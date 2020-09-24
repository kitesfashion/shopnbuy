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

class ClientWiseSalesController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Client Wise Sales History";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));    	
    	$toDate = Date('Y-m-d',strtotime($request->to_date));
    	$client = $request->client;
    	$cashSales = array();
    	$creditSales = array();

        if($this->deliveryZoneId){
            $clients = ClientEntry::orderBy('name','ASC')
                ->where('delivery_zone_id',$this->deliveryZoneId)
                ->get();

            $cashSales = CashSale::select('cash_sales.*')
                ->orWhere(function($cashQuery) use($fromDate,$toDate,$client){
                    if (!empty($fromDate))
                    {
                        $cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
                    }

                    if ($client)
                    {
                        $cashQuery->where('cash_sales.payment_type',$client);
                    }
                })
                ->where('cash_sales.delivery_zone_id',$this->deliveryZoneId)
                ->get();

            $creditSales = CreditSale::select('credit_sales.*','client_entries.id as clientId','client_entries.name as clientName')
                ->join('client_entries','client_entries.id','=','credit_sales.customer_id')
                ->Where(function($creditQuery) use($fromDate,$toDate,$client){
                    if (!empty($fromDate))
                    {
                        $creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
                    }

                    if ($client)
                    {
                        $creditQuery->where('client_entries.id',$client);
                    }
                })
                ->where('credit_sales.delivery_zone_id',$this->deliveryZoneId)
                ->orderBy('credit_sales.customer_id')
                ->get();
        }else{
        	$clients = ClientEntry::orderBy('name','ASC')->get();

    		$cashSales = CashSale::select('cash_sales.*')
    			->orWhere(function($cashQuery) use($fromDate,$toDate,$client){
    	    		if (!empty($fromDate))
    	    		{
    	    			$cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
    	    		}

                    if ($client)
                    {
                        $cashQuery->where('cash_sales.payment_type',$client);
                    }
    			})
                ->get();

    		$creditSales = CreditSale::select('credit_sales.*','client_entries.id as clientId','client_entries.name as clientName')
    			->join('client_entries','client_entries.id','=','credit_sales.customer_id')
    			->Where(function($creditQuery) use($fromDate,$toDate,$client){
    	    		if (!empty($fromDate))
    	    		{
    	    			$creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
    	    		}

    	    		if ($client)
    	    		{
    	    			$creditQuery->where('client_entries.id',$client);
    	    		}
    			})
                ->orderBy('credit_sales.customer_id')
                ->get();
        }
    	return view('admin.clientWiseSales.index')->with(compact('title','fromDate','toDate','client','clients','cashSales','creditSales'));
    }

    public function print(Request $request)
    {
    	$title = "Print Sales History";
    	$fromDate = Date('Y-m-d',strtotime($request->from_date));
    	$toDate = Date('Y-m-d',strtotime($request->to_date));
    	$client = $request->client;
    	$cashSales = array();
    	$creditSales = array();

    	// $data = $request->all();
    	// echo "<pre>";
    	// print_r($data);
    	// echo "</pre>";
    	// exit();
        if($this->deliveryZoneId){
            $cashSales = CashSale::select('cash_sales.*')
                ->orWhere(function($cashQuery) use($fromDate,$toDate,$client){
                    if (!empty($fromDate))
                    {
                        $cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
                    }

                    if ($client)
                    {
                        $cashQuery->where('cash_sales.payment_type',$client);
                    }
                })
                ->where('cash_sales.delivery_zone_id',$this->deliveryZoneId)
                ->get();

            $creditSales = CreditSale::select('credit_sales.*','client_entries.id as clientId','client_entries.name as clientName')
                ->join('client_entries','client_entries.id','=','credit_sales.customer_id')
                ->Where(function($creditQuery) use($fromDate,$toDate,$client){
                    if (!empty($fromDate))
                    {
                        $creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
                    }

                    if ($client)
                    {
                        $creditQuery->where('client_entries.id',$client);
                    }
                })
                ->where('credit_sales.delivery_zone_id',$this->deliveryZoneId)
                ->orderBy('credit_sales.customer_id')
                ->get();
        }else{
    		$cashSales = CashSale::select('cash_sales.*')
    			->orWhere(function($cashQuery) use($fromDate,$toDate,$client){
    	    		if (!empty($fromDate))
    	    		{
    	    			$cashQuery->whereBetween('cash_sales.invoice_date', array($fromDate,$toDate));
    	    		}

                    if ($client)
                    {
                        $cashQuery->where('cash_sales.payment_type',$client);
                    }
    			})
                ->get();

    		$creditSales = CreditSale::select('credit_sales.*','client_entries.id as clientId','client_entries.name as clientName')
    			->join('client_entries','client_entries.id','=','credit_sales.customer_id')
    			->Where(function($creditQuery) use($fromDate,$toDate,$client){
    	    		if (!empty($fromDate))
    	    		{
    	    			$creditQuery->whereBetween('credit_sales.invoice_date', array($fromDate,$toDate));
    	    		}

    	    		if ($client)
    	    		{
    	    			$creditQuery->where('client_entries.id',$client);
    	    		}
    			})
                ->orderBy('credit_sales.customer_id')
                ->get();
        }

		$pdf = PDF::loadView('admin.clientWiseSales.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'cashSales'=>$cashSales,'creditSales'=>$creditSales]);

        return $pdf->stream('product_wise_sales_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
