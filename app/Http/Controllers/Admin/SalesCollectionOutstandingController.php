<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Customer;

use DB;
use PDF;
use MPDF;

class SalesCollectionOutstandingController extends Controller
{
    public function index(Request $request)
    {
        $title = "Sales & Collection Statement";

        $year = $request->year;
        $month = $request->month;

        $customer = $request->customer;

        $customers = Customer::orderBy('name','asc')->get();

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            if ($year == "" || $month == "")
            {
                $salesCollections = array();
            }
            else
            {
                $previousSalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('SUM(sales_collection_standings.sales) as previousSales'), DB::raw('SUM(sales_collection_standings.collection) as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date','<',$year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->where('sales_collection_standings.delivery_zone_id',$this->deliveryZoneId)
                    ->groupBy('customers.id','customers.name');

                $monthlySalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('SUM(sales_collection_standings.sales) as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('SUM(sales_collection_standings.collection) as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$month,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$month)
                        {
                            $query->whereMonth('sales_collection_standings.date', $month);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->where('sales_collection_standings.delivery_zone_id',$this->deliveryZoneId)
                    ->groupBy('customers.id','customers.name');

                $salesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('SUM(sales_collection_standings.sales) as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('SUM(sales_collection_standings.collection) as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name')
                    ->unionAll($monthlySalesCollections)
                    ->unionAll($previousSalesCollections)
                    ->orderBy('customerId')
                    ->where('sales_collection_standings.delivery_zone_id',$this->deliveryZoneId)
                    ->get();
            }
        }else{
           if ($year == "" || $month == "")
            {
                $salesCollections = array();
            }
            else
            {
                $previousSalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('SUM(sales_collection_standings.sales) as previousSales'), DB::raw('SUM(sales_collection_standings.collection) as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date','<',$year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name');

                $monthlySalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('SUM(sales_collection_standings.sales) as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('SUM(sales_collection_standings.collection) as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$month,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$month)
                        {
                            $query->whereMonth('sales_collection_standings.date', $month);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name');

                $salesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('SUM(sales_collection_standings.sales) as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('SUM(sales_collection_standings.collection) as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name')
                    ->unionAll($monthlySalesCollections)
                    ->unionAll($previousSalesCollections)
                    ->orderBy('customerId')
                    ->get();
            } 
        }
        return view('admin.salesCollectionOutstanding.index')->with(compact('title','salesCollections','year','month','customers','customer'));
    }

    public function print(Request $request)
    {
        $title = "Sales & Collection Statement";

        $year = $request->year;
        $month = $request->month;

        $customer = $request->customer;

        // $data = $request->all();
        // dd($data)
        if($this->deliveryZoneId){
            if ($year == "" || $month == "")
            {
                $salesCollections = array();
            }
            else
            {
                $previousSalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('SUM(sales_collection_standings.sales) as previousSales'), DB::raw('SUM(sales_collection_standings.collection) as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date','<',$year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->where('sales_collection_standings.delivery_zone_id',$this->deliveryZoneId)
                    ->groupBy('customers.id','customers.name');

                $monthlySalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('SUM(sales_collection_standings.sales) as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('SUM(sales_collection_standings.collection) as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$month,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$month)
                        {
                            $query->whereMonth('sales_collection_standings.date', $month);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->where('sales_collection_standings.delivery_zone_id',$this->deliveryZoneId)
                    ->groupBy('customers.id','customers.name');

                $salesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('SUM(sales_collection_standings.sales) as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('SUM(sales_collection_standings.collection) as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name')
                    ->unionAll($monthlySalesCollections)
                    ->unionAll($previousSalesCollections)
                    ->orderBy('customerId')
                    ->where('sales_collection_standings.delivery_zone_id',$this->deliveryZoneId)
                    ->get();
            }
        }else{
            if ($year == "" || $month == "")
            {
                $salesCollections = array();
            }
            else
            {
                $previousSalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('SUM(sales_collection_standings.sales) as previousSales'), DB::raw('SUM(sales_collection_standings.collection) as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date','<',$year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name');

                $monthlySalesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('0 as yearlySales'), DB::raw('SUM(sales_collection_standings.sales) as monthlySales'), DB::raw('0 as yearlyCollection'), DB::raw('SUM(sales_collection_standings.collection) as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$month,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$month)
                        {
                            $query->whereMonth('sales_collection_standings.date', $month);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name');

                $salesCollections = DB::table('sales_collection_standings')
                    ->select(DB::raw('SUM(sales_collection_standings.sales) as yearlySales'), DB::raw('0 as monthlySales'), DB::raw('SUM(sales_collection_standings.collection) as yearlyCollection'), DB::raw('0 as monthlyCollection'), DB::raw('0 as previousSales'), DB::raw('0 as previousCollection'), 'customers.id as customerId', 'customers.name as customerName')
                    ->join('customers','customers.id','=','sales_collection_standings.customerId')
                    ->orWhere(function($query) use($year,$customer){
                        if (@$year)
                        {
                            $query->whereYear('sales_collection_standings.date', $year);
                        }

                        if (@$customer)
                        {
                            $query->whereIn('customers.id',$customer);
                        }
                    })
                    ->groupBy('customers.id','customers.name')
                    ->unionAll($monthlySalesCollections)
                    ->unionAll($previousSalesCollections)
                    ->orderBy('customerId')
                    ->get();
            }
        }

        $pdf = PDF::loadView('admin.salesCollectionOutstanding.print',['title'=>$title,'year'=>$year,'month'=>$month,'salesCollections'=>$salesCollections]);

        return $pdf->stream('sales_and_collection_standings_'.$month.'_of_'.$year.'.pdf');
    }
}
