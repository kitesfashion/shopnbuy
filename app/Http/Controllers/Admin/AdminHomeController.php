<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;

use App\Product;
use App\Order;
use App\Customer;

class AdminHomeController extends Controller
{
   /* public function __construct()
    {
        $this->middleware('auth:admin');
        $this->deliveryZoneId = @Auth::user()->delivery_zone_id;
    }*/

    public function index()
    {
        $title = "Dashboard";
	    $customerCount = Customer::count();
	    $productCount = Product::where('status',1)->count();

        if ($this->deliveryZoneId) {
            $newOrderCount = Order::where('delivery_zone_id',@$this->deliveryZoneId)
                            ->where('status','Waiting')
                            ->count();
            $completeOrderCount = Order::where('delivery_zone_id',@$this->deliveryZoneId)
                                ->where('status','Complete')
                                ->count();

            $pendingOrderList = Order::where('delivery_zone_id',@$this->deliveryZoneId)
                                ->where('status','Waiting')
                                ->get();

            $pendingAmount = DB::table('orders')
                    ->where('orders.status','Waiting')
                    ->where('orders.delivery_zone_id',@$this->deliveryZoneId)
                    ->select('orders.total_amount')
                    ->sum('total_amount');

            $topclients = DB::table('orders')
                    ->join('customers', 'customers.id', '=', 'orders.customer_id')
                    ->select('customers.id','customers.name','orders.total_amount',DB::raw('sum(orders.total_amount) as totalAmount','orders.delivery_zone_id'))
                    ->groupBy('orders.customer_id')
                    ->where('orders.delivery_zone_id',@$this->deliveryZoneId)
                    ->take(6)
                    ->orderBy('totalAmount','DESC')
                    ->get();

            $saleByAmount = DB::table('order_list')
                    ->select('order_list.*',DB::raw('sum(order_list.total) as totalSum'))
                    ->groupBy('order_list.product_id')
                    ->where('order_list.delivery_zone_id',@$this->deliveryZoneId)
                    ->take(6)
                    ->orderBy('totalSum','DESC')
                    ->get();

            $saleByQuantity = DB::table('order_list')
                    ->select('order_list.*',DB::raw('sum(order_list.qty) as totalQty'))
                    ->groupBy('order_list.product_id')
                    ->where('order_list.delivery_zone_id',@$this->deliveryZoneId)
                    ->take(6)
                    ->orderBy('totalQty','DESC')
                    ->get();

            $saleByCategory = DB::table('products')
                    ->join('order_list', 'products.id', '=', 'order_list.product_id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('categories.categoryName',DB::raw('sum(order_list.price) as sum','order_list.*'))
                    ->groupBy('categoryName')
                    ->where('order_list.delivery_zone_id',@$this->deliveryZoneId)
                    ->take(6)
                    ->orderBy('sum','DESC')
                    ->get();

            $month = date("m");
            $year = date("Y");

            $monthFrom = $year."-".$month."-01";
            $monthTo = $year."-".$month."-31";

            $monthlyIncome =  Order::whereBetween('created_at', [$monthFrom, $monthTo])
                            ->where('delivery_zone_id',@$this->deliveryZoneId)
                            ->sum('total_amount');

            $salesbymonth = DB::table('order_list')
                    ->select('order_list.*',DB::raw('sum(order_list.price*order_list.qty) as sum'))
                    ->whereBetween('order_list.created_at', [$monthFrom, $monthTo])
                    ->groupBy('order_list.product_id')
                    ->where('order_list.delivery_zone_id',@$this->deliveryZoneId)
                    ->orderBy('sum','DESC')
                    ->get();
            $totalsales = Order::where('delivery_zone_id',@$this->deliveryZoneId)->get();
        }else{
            $newOrderCount = Order::where('status','Waiting')->count();
            $completeOrderCount = Order::where('status','Complete')->count();

            $pendingOrderList = Order::where('status','Waiting')->get();

            $pendingAmount = DB::table('orders')
                    ->where('orders.status','Waiting')
                    ->select('orders.total_amount')
                    ->sum('total_amount');

            $topclients = DB::table('orders')
                    ->join('customers', 'customers.id', '=', 'orders.customer_id')
                    ->select('customers.id','customers.name','orders.total_amount',DB::raw('sum(orders.total_amount) as totalAmount'))
                    ->groupBy('orders.customer_id')
                    ->take(6)
                    ->orderBy('totalAmount','DESC')
                    ->get();

            $saleByAmount = DB::table('order_list')
                    ->select('order_list.*',DB::raw('sum(order_list.total) as totalSum'))
                    ->groupBy('order_list.product_id')
                    ->take(6)
                    ->orderBy('totalSum','DESC')
                    ->get();

            $saleByQuantity = DB::table('order_list')
                    ->select('order_list.*',DB::raw('sum(order_list.qty) as totalQty'))
                    ->groupBy('order_list.product_id')
                    ->take(6)
                    ->orderBy('totalQty','DESC')
                    ->get();

            $saleByCategory = DB::table('products')
                    ->join('order_list', 'products.id', '=', 'order_list.product_id')
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('categories.categoryName',DB::raw('sum(order_list.price) as sum'))
                    ->groupBy('categoryName')
                    ->take(6)
                    ->orderBy('sum','DESC')
                    ->get();

            $month = date("m");
            $year = date("Y");

            $monthFrom = $year."-".$month."-01";
            $monthTo = $year."-".$month."-31";

            $monthlyIncome =  Order::whereBetween('created_at', [$monthFrom, $monthTo])->sum('total_amount');

            $salesbymonth = DB::table('order_list')
                    ->select('order_list.*',DB::raw('sum(order_list.price*order_list.qty) as sum'))
                    ->whereBetween('order_list.created_at', [$monthFrom, $monthTo])
                    ->groupBy('order_list.product_id')
                    ->orderBy('sum','DESC')
                    ->get();
            $totalsales = Order::all();
        }

    	return view('admin.dashboard.index')->with(compact('title','newOrderCount','completeOrderCount','customerCount','productCount','pendingOrderList','pendingAmount','topclients','saleByAmount','saleByQuantity','saleByCategory','monthlyIncome','salesbymonth','totalsales'));
    }

}
