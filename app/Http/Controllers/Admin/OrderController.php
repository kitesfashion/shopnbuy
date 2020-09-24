<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use PDF;

use App\Product;
use App\Order;
use App\OrderList;
use App\Customer;
use App\Settings;

class OrderController extends Controller
{
    public function NeworderList()
    {
        $title = "Manage Pending Orders";
        if ($this->deliveryZoneId) {
            $orderList = Order::where('delivery_zone_id',$this->deliveryZoneId)->where('status','Waiting')->get();
        }else{
            $orderList = Order::where('status','Waiting')->get();
        }
        
        return view('admin.orders.neworderList')->with(compact('title','orderList'));
    }

    public function ProcessingOrder()
    {
        $title = "Manage Processing Order";
        if ($this->deliveryZoneId) {
            $orderList = Order::where('delivery_zone_id',$this->deliveryZoneId)->where('status','Processing')->get();
        }else{
            $orderList = Order::where('status','Processing')->get();
        }
        return view('admin.orders.processingOrder')->with(compact('title','orderList'));
    }

    public function ShippingOrder()
    {
        $title = "Manage ShippingManage Complete Ordes Orders";
        if ($this->deliveryZoneId) {
            $orderList = Order::where('delivery_zone_id',$this->deliveryZoneId)->where('status','Shipping')->get();
        }else{
            $orderList = Order::where('status','Shipping')->get();
        }
        return view('admin.orders.shippingOrder')->with(compact('title','orderList'));
    }
    

    public function CompleteOrderList()
    {
        $title = "Manage Complete Ordes";
        if ($this->deliveryZoneId) {
            $orderList = Order::where('delivery_zone_id',$this->deliveryZoneId)->where('status','Complete')->get();
        }else{
            $orderList = Order::where('status','Complete')->get();
        }
        return view('admin.orders.completeorderList')->with(compact('title','orderList'));
    }

    public function status($order_id,Request $request)
    {
        $order = Order::find($order_id);
        $status = @$_GET['status'];

        if($status == 'Waiting') {
            $order->update(['status'=>'Waiting']);
        } else if($status == 'Processing') {
            $order->update(['status'=>'Processing']);
        } else if($status == 'Shipping') {
            $order->update(['status'=>'Shipping']);
        } else if($status == 'Complete') {
            $order->update(['status'=>'Complete']);
        }

        $order->update();
        return response()->json([
                'order'=>$order,
            ]);
        // return "view is not completed yet!! its from controller .";
    }

     public function ListProduct($id)
     {
        $title = "Order List";
        if ($this->deliveryZoneId) {
            $orders = OrderList::where('delivery_zone_id',$this->deliveryZoneId)->where('order_id',$id)->get();
        }else{
            $orders = OrderList::where('order_id',$id)->get();
        }
        $invoiceId = $id;
        return view('admin.orders.listProduct')->with(compact('title','orders','invoiceId'));
    }

     public function updateQuantity(Request $request, $rowId, $qty)
    {
        if($request->ajax())
        {   
            $orders = Order::find($rowId);
            $orders->update( [
            'qty' => $qty,                        
            ]);
            print_r(1);       
            return ;
        }

        return redirect(route('orders.updateQuantity'));
    }

     public function updatePrice(Request $request, $rowId, $price)
    {
        if($request->ajax())
        {   
            $orders = Order::find($rowId);
            $orders->update( [
            'price' => $price,                        
            ]);
            print_r(1);       
            return ;
        }

        return redirect(route('orders.updateQuantity'));
    }

    public function MonthlySales($month,Request $request){
        $year = date("Y");
        $monthFrom = $year."-".$month."-01";
        $monthTo = $year."-".$month."-31";

        $monthName = date("F", mktime(0, 0, 0, $month, 10));

        if ($this->deliveryZoneId) {

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
        }else{
            $monthlyIncome =  Order::whereBetween('created_at', [$monthFrom, $monthTo])->sum('total_amount');

            $salesbymonth = DB::table('order_list')
                ->select('order_list.*',DB::raw('sum(order_list.price*order_list.qty) as sum'))
                ->whereBetween('order_list.created_at', [$monthFrom, $monthTo])
                ->groupBy('order_list.product_id')
                ->orderBy('sum','DESC')
                ->get();
        }
       

        $monthlySales = [];
        foreach ($salesbymonth as $monthlySale) {
            $sales = '
                <tr>
                    <td class="txt-oflo" width="71%">'.str_limit($monthlySale->name,20).'</td>
                    <td><span class="text-success">'.$monthlySale->sum.' BDT</span></td>
                    
                </tr>
           ';
           array_push($monthlySales, $sales);      
        }
            
        if($request->ajax())
            {
                return response()->json([
                    'monthlySales'=>$monthlySales,
                    'monthlyIncome'=>$monthlyIncome,
                    'monthName'=>$monthName,
                ]);
            } 
        }

    public function DeleteOrder(Request $request){
        if($request->ajax()){   
            Order::where('id',$request->order_id)->delete();
            OrderList::where('order_id',$request->order_id)->delete();
        }
    }

    public function invoices($id)
    {
        $title = "View Invoice";
        $company = Settings::first();
        $order = Order::where('id',$id)->first();
        $orderList = OrderList::select('order_list.*')
                    ->where('order_list.order_id', $id)
                    ->get();

        return view('admin.orders.invoice')->with(compact('title','order','orderList','company'));
    }

    public function downloadInvoices($orderId){
        $company = Settings::first();
        $orderList = Order::where('id',$orderId)->first();
        $shippings = Shipping::where('id',$orderList->shipping_id)->first();
        $transactions = Transaction::where('order_id',$orderId)->first();
        $orders = Order::select('orders.*', 'products.name','product_sections.free_shipping', 'products.deal_code')
                    ->join('products', 'products.id', '=', 'orders.product_id')
                     ->join('product_sections', 'product_sections.productId', '=', 'orders.product_id')
                    ->where('orders.order_id', $orderId)
                    ->get();
        $pdf = PDF::loadView('admin.orders.downloadInvoices',['shippings'=>$shippings,'orders'=>$orders,'transactions'=>$transactions,'orderList'=>$orderList,'company'=>$company]);

        return $pdf->download('invoice.pdf');
        }

        public function viewPdf($orderId){
        $title = "Print Invoice";
        $company = Settings::first();
        $order = Order::where('id',$orderId)->first();
        $orderList = OrderList::select('order_list.*')
                    ->where('order_list.order_id', $orderId)
                    ->get();
        $pdf = PDF::loadView('admin.orders.viewPdf',['title'=>$title,'orders'=>$order,'orderList'=>$orderList,'company'=>$company]);

        return $pdf->stream('invoice.pdf');
        }

}
