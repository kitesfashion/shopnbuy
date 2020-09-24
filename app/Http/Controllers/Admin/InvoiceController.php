<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Order;
use App\OrderList;
use App\Product;
use App\Settings;
use App\Checkout;

use PDF;

class InvoiceController extends Controller
{   
	public function addtoInvoice($orderId)
    {
		$orderInfo = OrderList::where('id',$orderId)->first();
		$productAmount = $orderInfo->qty*$orderInfo->price;
		$invoices = Invoice::create([
                    'invoiceId'=>$orderInfo->order_id,
                    'orderId'=>$orderId,
                    'productCode'=>$orderInfo->code,
                    'productName'=>$orderInfo->name,
                    'productQuantity'=>$orderInfo->qty,
                    'productPrice'=>$orderInfo->price,
                    'productAmount'=>$productAmount,
                    'delivery_zone_id'=>$orderInfo->delivery_zone_id,
                    'delivery_zone_name'=>$orderInfo->delivery_zone_name,
                ]);

		return redirect(url('/admin/list-product/'.$orderInfo->order_id))->with('msg','Added Invoices Successfully');   
	}


	public function viewInvoice($invoiceId)
    {
        $title = "View Invoice";
		$company = Settings::first();
        $order = Order::where('id',$invoiceId)->first();
        $orderList = Invoice::select('invoices.*','product_sections.free_shipping','order_list.*')
                    ->join('order_list', 'order_list.code', '=', 'invoices.productCode')
                    ->join('product_sections', 'product_sections.productId', '=', 'order_list.product_id')
                    ->where('invoices.invoiceId', $invoiceId)
                    ->get();

        return view('admin.orders.invoices.viewInvoice')->with(compact('title','order','orderList','company'));
	}

	public function manualInvoicePdf($invoiceId){
        $title = "Print Invoice";
        $company = Settings::first();
        $orders = Order::where('id',$invoiceId)->first();
        $orderList = Invoice::select('invoices.*','product_sections.free_shipping','order_list.*')
                    ->join('order_list', 'order_list.code', '=', 'invoices.productCode')
                    ->join('product_sections', 'product_sections.productId', '=', 'order_list.product_id')
                    ->where('invoices.invoiceId', $invoiceId)
                    ->get();

        $pdf = PDF::loadView('admin.orders.invoices.manualInvoicePdf',['title'=>$title,'orders'=>$orders,'orderList'=>$orderList,'company'=>$company]);

        return $pdf->stream('invoice.pdf');
        }

    public function deletefromInvoice($orderId){
    	$orderInfo = OrderList::where('id',$orderId)->first();
        Invoice::where('orderId',$orderId)->delete();

        return redirect(url('/admin/list-product/'.$orderInfo->order_id))->with('msg','Remove from Invoices Successfully');   
    }
    
}
