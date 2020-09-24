<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Customer;

use DB;
use PDF;
use MPDF;

class CollectionHistoryController extends Controller
{
    public function index(Request $request)
    {
    	$title = "Collection History";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        $customer = $request->customer;

    	$customers = Customer::orderBy('name','asc')->get();

    	$collectionHistories = array();
        if($this->deliveryZoneId){
            $cashCollectionHistories = DB::table('cash_sales')
                ->select(DB::raw('"Cash Sales" as clientName'),DB::raw('"cash" as clientId'),'invoice_date as date',DB::raw('"cash-sale" as moneyReceiptNo'),DB::raw('payment_type as moneyReceiptType'),DB::raw('SUM(net_amount) as paymentAmount'))
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('invoice_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('payment_type',$customer);
                    }
                })
                ->where('cash_sales.delivery_zone_id',$this->deliveryZoneId)
                ->groupBy('invoice_date');

            $collectionHistories = DB::table('credit_collections')
                ->select('customers.name as clientName','credit_collections.client_id as clientId','credit_collections.payment_date as date','credit_collections.money_receipt_no as moneyReceiptNo','credit_collections.money_receipt_type as moneyReceiptType','credit_collections.payment_amount as paymentAmount')
                ->join('customers','customers.id','=','credit_collections.client_id')
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('credit_collections.payment_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('customers.id',$customer);
                    }
                })
                ->unionAll($cashCollectionHistories)
                ->orderBy('date')
                ->orderBy('clientName')
                ->orderBy('moneyReceiptType')
                ->where('credit_collections.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $cashCollectionHistories = DB::table('cash_sales')
                ->select(DB::raw('"Cash Sales" as clientName'),DB::raw('"cash" as clientId'),'invoice_date as date',DB::raw('"cash-sale" as moneyReceiptNo'),DB::raw('payment_type as moneyReceiptType'),DB::raw('SUM(net_amount) as paymentAmount'))
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('invoice_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('payment_type',$customer);
                    }
                })
                ->groupBy('invoice_date');

            $collectionHistories = DB::table('credit_collections')
                ->select('customers.name as clientName','credit_collections.client_id as clientId','credit_collections.payment_date as date','credit_collections.money_receipt_no as moneyReceiptNo','credit_collections.money_receipt_type as moneyReceiptType','credit_collections.payment_amount as paymentAmount')
                ->join('customers','customers.id','=','credit_collections.client_id')
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('credit_collections.payment_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('customers.id',$customer);
                    }
                })
                ->unionAll($cashCollectionHistories)
                ->orderBy('date')
                ->orderBy('clientName')
                ->orderBy('moneyReceiptType')
                ->get();
        }
    	return view('admin.collectionHistory.index')->with(compact('title','customers','fromDate','toDate','customer','collectionHistories'));
    }

    public function print(Request $request)
    {
    	$title = "Print Collection History";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        $customer = $request->customer;

    	$collectionHistories = array();
        if($this->deliveryZoneId){
            $cashCollectionHistories = DB::table('cash_sales')
                ->select(DB::raw('"Cash Sales" as clientName'),DB::raw('"cash" as clientId'),'invoice_date as date',DB::raw('"cash-sale" as moneyReceiptNo'),DB::raw('payment_type as moneyReceiptType'),DB::raw('SUM(net_amount) as paymentAmount'))
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('invoice_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('payment_type',$customer);
                    }
                })
                ->where('cash_sales.delivery_zone_id',$this->deliveryZoneId)
                ->groupBy('invoice_date');

            $collectionHistories = DB::table('credit_collections')
                ->select('customers.name as clientName','credit_collections.client_id as clientId','credit_collections.payment_date as date','credit_collections.money_receipt_no as moneyReceiptNo','credit_collections.money_receipt_type as moneyReceiptType','credit_collections.payment_amount as paymentAmount')
                ->join('customers','customers.id','=','credit_collections.client_id')
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('credit_collections.payment_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('customers.id',$customer);
                    }
                })
                ->unionAll($cashCollectionHistories)
                ->orderBy('date')
                ->orderBy('clientName')
                ->orderBy('moneyReceiptType')
                ->where('credit_collections.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $cashCollectionHistories = DB::table('cash_sales')
                ->select(DB::raw('"Cash Sales" as clientName'),DB::raw('"cash" as clientId'),'invoice_date as date',DB::raw('"cash-sale" as moneyReceiptNo'),DB::raw('payment_type as moneyReceiptType'),DB::raw('SUM(net_amount) as paymentAmount'))
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('invoice_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('payment_type',$customer);
                    }
                })
                ->groupBy('invoice_date');

            $collectionHistories = DB::table('credit_collections')
                ->select('customers.name as clientName','credit_collections.client_id as clientId','credit_collections.payment_date as date','credit_collections.money_receipt_no as moneyReceiptNo','credit_collections.money_receipt_type as moneyReceiptType','credit_collections.payment_amount as paymentAmount')
                ->join('customers','customers.id','=','credit_collections.client_id')
                ->orWhere(function($query) use($fromDate,$toDate,$customer){
                    if (!empty($fromDate))
                    {
                        $query->whereBetween('credit_collections.payment_date', array($fromDate,$toDate));
                    }

                    if (@$customer)
                    {
                        $query->whereIn('customers.id',$customer);
                    }
                })
                ->unionAll($cashCollectionHistories)
                ->orderBy('date')
                ->orderBy('clientName')
                ->orderBy('moneyReceiptType')
                ->get();
        }

        $pdf = PDF::loadView('admin.collectionHistory.print',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'customer'=>$customer,'collectionHistories'=>$collectionHistories]);

        return $pdf->stream('collection_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}
