<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Vendors;
use App\CashPurchase;
use App\CreditPurchase;
use App\PurchaseReturn;
use App\SupplierPayment;

use DB;
use PDF;
use MPDF;

class SupplierStatementController extends Controller
{
    public function index(Request $request)
    {
        $title = "Supplier Statement";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        $supplier = $request->supplier;

        $previousBalances = array();
        $supplierStatements = array();

        $vendors = Vendors::orderBy('vendorName','asc')->get();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $previousBalances = DB::table('supplier_statement_report')
                ->select(DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'))
                ->orWhere(function($cashQuery) use($lastDate,$supplier){
                    if (!empty($lastDate))
                    {
                        $cashQuery->where('supplier_statement_report.date','<=', $lastDate);
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('supplier_statement_report.vendorId',$supplier);
                    }
                })
                ->where('supplier_statement_report.delivery_zone_id',$this->deliveryZoneId)
                ->first();

            $supplierStatements = DB::table('supplier_statement_report')
                ->select('supplier_statement_report.date as date', DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'),'vendors.vendorName as vendorName')
                ->join('vendors','vendors.id','=','supplier_statement_report.vendorId')
                ->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier){
                    if (!empty($fromDate))
                    {
                        $cashQuery->whereBetween('supplier_statement_report.date', array($fromDate,$toDate));
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('vendors.id',$supplier);
                    }
                })
                ->where('supplier_statement_report.delivery_zone_id',$this->deliveryZoneId)
                ->groupBy('supplier_statement_report.date','vendors.vendorName')
                ->get();
        }else{
            $previousBalances = DB::table('supplier_statement_report')
                ->select(DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'))
                ->orWhere(function($cashQuery) use($lastDate,$supplier){
                    if (!empty($lastDate))
                    {
                        $cashQuery->where('supplier_statement_report.date','<=', $lastDate);
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('supplier_statement_report.vendorId',$supplier);
                    }
                })
                ->first();

            $supplierStatements = DB::table('supplier_statement_report')
                ->select('supplier_statement_report.date as date', DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'),'vendors.vendorName as vendorName')
                ->join('vendors','vendors.id','=','supplier_statement_report.vendorId')
                ->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier){
                    if (!empty($fromDate))
                    {
                        $cashQuery->whereBetween('supplier_statement_report.date', array($fromDate,$toDate));
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('vendors.id',$supplier);
                    }
                })
                ->groupBy('supplier_statement_report.date','vendors.vendorName')
                ->get();
        }
        return view('admin.supplierStatement.index')->with(compact('title','previousBalances','supplierStatements','fromDate','toDate','vendors','supplier'));
    }

    public function print(Request $request)
    {
        $title = "Print Supplier Statement";

        $fromDate = Date('Y-m-d',strtotime($request->from_date));
        $toDate = Date('Y-m-d',strtotime($request->to_date));

        $supplier = $request->supplier;

        $previousBalances = array();
        $supplierStatements = array();

        $lastDate = Date('Y-m-d',strtotime("-1 day", strtotime($fromDate)));

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            $previousBalances = DB::table('supplier_statement_report')
                ->select(DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'))
                ->orWhere(function($cashQuery) use($lastDate,$supplier){
                    if (!empty($lastDate))
                    {
                        $cashQuery->where('supplier_statement_report.date','<=', $lastDate);
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('vendors.id',$supplier);
                    }
                })
                ->where('supplier_statement_report.delivery_zone_id',$this->deliveryZoneId)
                ->first();

            $supplierStatements = DB::table('supplier_statement_report')
                ->select('supplier_statement_report.date as date', DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'),'vendors.vendorName as vendorName')
                ->join('vendors','vendors.id','=','supplier_statement_report.vendorId')
                ->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier){
                    if (!empty($fromDate))
                    {
                        $cashQuery->whereBetween('supplier_statement_report.date', array($fromDate,$toDate));
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('vendors.id',$supplier);
                    }
                })
                ->where('supplier_statement_report.delivery_zone_id',$this->deliveryZoneId)
                ->groupBy('supplier_statement_report.date','vendors.vendorName')
                ->get();
        }else{
            $previousBalances = DB::table('supplier_statement_report')
                ->select(DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'))
                ->orWhere(function($cashQuery) use($lastDate,$supplier){
                    if (!empty($lastDate))
                    {
                        $cashQuery->where('supplier_statement_report.date','<=', $lastDate);
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('vendors.id',$supplier);
                    }
                })
                ->first();

            $supplierStatements = DB::table('supplier_statement_report')
                ->select('supplier_statement_report.date as date', DB::raw('SUM(supplier_statement_report.lifting) as lifting'), DB::raw('SUM(supplier_statement_report.payment) as payment'), DB::raw('SUM(supplier_statement_report.others) as others'),'vendors.vendorName as vendorName')
                ->join('vendors','vendors.id','=','supplier_statement_report.vendorId')
                ->orWhere(function($cashQuery) use($fromDate,$toDate,$supplier){
                    if (!empty($fromDate))
                    {
                        $cashQuery->whereBetween('supplier_statement_report.date', array($fromDate,$toDate));
                    }

                    if (@$supplier)
                    {
                        $cashQuery->whereIn('vendors.id',$supplier);
                    }
                })
                ->groupBy('supplier_statement_report.date','vendors.vendorName')
                ->get();
        }
        $pdf = PDF::loadView('admin.supplierStatement.prints',['title'=>$title,'fromDate'=>$fromDate,'toDate'=>$toDate,'previousBalances'=>$previousBalances,'supplierStatements'=>$supplierStatements]);

        return $pdf->stream('supplier_statement_history_'.$fromDate.'_to_'.$toDate.'.pdf');
    }
}

