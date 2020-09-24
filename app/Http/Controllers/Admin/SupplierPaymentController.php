<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CreditPurchase;
use App\SupplierPayment;
use App\Vendors;
use DB;

class SupplierPaymentController extends Controller
{
    public function index()
    {   if($this->deliveryZoneId){
            $supplierPayment = SupplierPayment::select('supplier_payments.*','vendors.vendorName')
                ->join('vendors','vendors.id','=','supplier_payments.supplier_id')
                ->orderBy('vendors.vendorName','asc')
                ->orderBy('supplier_payments.payment_date','asc')
                ->where('supplier_payments.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $supplierPayment = SupplierPayment::select('supplier_payments.*','vendors.vendorName')
                ->join('vendors','vendors.id','=','supplier_payments.supplier_id')
                ->orderBy('vendors.vendorName','asc')
                ->orderBy('supplier_payments.payment_date','asc')
                ->get();
        }

        $title = 'Supplier Payment';
        return view('admin.supplierPayment.index')->with(compact('supplierPayment','title'));
    }

    public function add(){
    	$vendors = Vendors::where('vendorStatus',1)->get();
        $title = 'Create Supplier Payment';
        return view('admin.supplierPayment.add')->with(compact('title','vendors'));
    }

     public function save(Request $request){
        $payment_date = date('Y-m-d', strtotime($request->payment_date));
        
        $this->validate(request(), [       
             'supplier_id' => 'required',  
             'payment_type' => 'required',  
        ]);
        $supplierPayment = SupplierPayment::create( [     
            'supplier_id' => $request->supplier_id,                      
            'payment_no' => $request->payment_no,                      
            'payment_date' => $payment_date,                                  
            'current_due' => $request->current_due, 
            'payment_now' => $request->payment_now, 
            'balance' => $request->balance, 
            'money_receipt' => $request->money_receipt, 
            'payment_type' => $request->payment_type, 
            'remarks' => $request->remarks,
            'delivery_zone_id' => $this->deliveryZoneId, 
                   
        ]);

       return redirect(route('supplierPayment.index'))->with('msg','Supplier Payment Complete Successfully');     
    }

    public function edit($id){
    	$vendors = Vendors::where('vendorStatus',1)->get();
        $supplierPayment = SupplierPayment::where('id',$id)->first();
        $title = 'Edit Supplier Payment';
        return view('admin.supplierPayment.edit')->with(compact('vendors','title','supplierPayment'));
    }


     public function update(Request $request){
        $payment_date = date('Y-m-d', strtotime($request->payment_date));
        
        $this->validate(request(), [       
             'supplier_id' => 'required',  
             'payment_type' => 'required',  
        ]);
        $supplierPaymentId = $request->supplierPaymentId;
        $supplierPayment = SupplierPayment::find($supplierPaymentId);

        $supplierPayment->update( [            
           	'supplier_id' => $request->supplier_id,                      
            'payment_no' => $request->payment_no,                      
            'payment_date' => $payment_date,                                  
            'current_due' => $request->current_due, 
            'payment_now' => $request->payment_now, 
            'balance' => $request->balance, 
            'money_receipt' => $request->money_receipt, 
            'payment_type' => $request->payment_type, 
            'remarks' => $request->remarks,             
        ]);

       

        return redirect(route('supplierPayment.index'))->with('msg','Supplier Payment Updated Successfully');     
    }


	public function destroy(Request $request){   
	    SupplierPayment::where('id',$request->supplierPaymentId)->delete();
    }


    public function getSupplierInfo(Request $request)
    {
    	$supplierInvoice = CreditPurchase::where('supplier_id',$request->supplier_id)->sum('net_amount');
    	$supplier_payments_current_due = SupplierPayment::where('supplier_id',$request->supplier_id)->sum('payment_now');
    	$data = ['supplierInvoice' => $supplierInvoice,'supplier_payments_current_due'=>$supplier_payments_current_due];

    	return $data;
    }
}


