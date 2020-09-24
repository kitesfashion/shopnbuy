<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CashPurchase;
use App\CreditPurchase;
use App\CreditPurchaseItem;
use App\Vendors;
use App\Product;
use DB;

class CreditPurchaseController extends Controller
{
    public function index()
    {   if($this->deliveryZoneId){
            $creditPurchase = CreditPurchase::select('credit_purchases.*','vendors.vendorName')
                ->join('vendors','vendors.id','=','credit_purchases.supplier_id')
                ->orderBy('credit_purchases.purchase_by','asc')
                ->orderby('vendors.vendorName','asc')
                ->where('credit_purchases.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $creditPurchase = CreditPurchase::select('credit_purchases.*','vendors.vendorName')
                ->join('vendors','vendors.id','=','credit_purchases.supplier_id')
                ->orderBy('credit_purchases.purchase_by','asc')
                ->orderby('vendors.vendorName','asc')
                ->get();   
        }

        $title = 'Credit Purchase';
        return view('admin.creditPurchase.index')->with(compact('creditPurchase','title'));
    }

    public function add(){
        $vendors = Vendors::where('vendorStatus',1)->get();
        $products = Product::where('status',1)->get();
        $cashPurchase = CashPurchase::all();
        $title = 'Credit Purchase';
        return view('admin.creditPurchase.add')->with(compact('title','vendors','products','cashPurchase'));
    }

     public function save(Request $request){
        $submission_date = date('Y-m-d', strtotime($request->submission_date));
        $voucher_date = date('Y-m-d', strtotime($request->voucher_date));
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
      
        $this->validate(request(), [       
           'credit_serial' => 'required',  
           'vouchar_no' => 'required',  
           'supplier_id' => 'required',  
           'purchase_by' => 'required',
           'voucher_date' => 'required',   
       ]);

        // $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit();

        $creditPurchase = CreditPurchase::create( [
            'credit_serial' => $request->credit_serial,            
            'vouchar_no' => $request->vouchar_no,            
            'supplier_id' => $request->supplier_id,            
            'submission_date' => $submission_date,            
            'purchase_by' => $request->purchase_by,
            'voucher_date' => $voucher_date,               
            'total_qty' => $request->total_qty, 
            'total_amount' => $request->total_amount, 
            'discount' => $request->discount, 
            'vat' => $request->vat, 
            'net_amount' => $request->net_amount,  
            'delivery_zone_id' => $this->deliveryZoneId,                    
        ]);

        $countProduct = count($request->product_id);
            if($request->product_id){
                $postData = [];
                for ($i=0; $i <$countProduct ; $i++) { 
                    $postData[] = [
                        'credit_puchase_id'=> $creditPurchase->id,
                        'product_id' => $request->product_id[$i],
                        'qty' => $request->qty[$i], 
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],  
                        'delivery_zone_id' => $this->deliveryZoneId,
                        'created_at' => $created_at,
                        'updated_at' => $updated_at, 
                    ];
                }                
                CreditPurchaseItem::insert($postData);
            }

       return redirect(route('creditPurchase.index'))->with('msg','Credit Purchase Added Successfully');     
    }

    public function edit($id){
    	$cashPurchase = CashPurchase::all();
    	$creditPurchase = CreditPurchase::where('id',$id)->first();
        $vendors = Vendors::where('vendorStatus',1)->get();
        $products = Product::where('status',1)->get();
        $creditPurchaseItem = CreditPurchaseItem::where('credit_puchase_id',$id)->get();
        $title = 'Edit Credit Purchase';
        return view('admin.creditPurchase.edit')->with(compact('creditPurchase','cashPurchase','title','vendors','products','creditPurchaseItem'));
    }

     public function update(Request $request){
        $submission_date = date('Y-m-d', strtotime($request->submission_date));
        $voucher_date = date('Y-m-d', strtotime($request->voucher_date));
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $this->validate(request(), [       
             'credit_serial' => 'required',  
             'vouchar_no' => 'required',  
             'supplier_id' => 'required',  
             'purchase_by' => 'required', 
        ]);
        $creditPurchaseId = $request->creditPurchaseId;
        $creditPurchase = CreditPurchase::find($creditPurchaseId);

        $creditPurchase->update( [            
            'credit_serial' => $request->credit_serial,            
            'vouchar_no' => $request->vouchar_no,            
            'supplier_id' => $request->supplier_id,            
            'submission_date' => $submission_date,            
            'purchase_by' => $request->purchase_by,
            'voucher_date' => $voucher_date,               
            'total_qty' => $request->total_qty, 
            'total_amount' => $request->total_amount, 
            'discount' => $request->discount, 
            'vat' => $request->vat, 
            'net_amount' => $request->net_amount,           
        ]);

        $countProduct = count($request->product_id);
         DB::table('credit_purchase_items')->where('credit_puchase_id', $creditPurchaseId)->delete();
        if($request->product_id){
                $postData = [];
                for ($i=0; $i <$countProduct ; $i++) { 
                    $postData[] = [
                        'credit_puchase_id'=> $creditPurchase->id,
                        'product_id' => $request->product_id[$i],
                        'qty' => $request->qty[$i], 
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ];
                }
                
                CreditPurchaseItem::insert($postData);
            }

        return redirect(route('creditPurchase.index'))->with('msg','Credit Purchase Updated Successfully');     
    }


public function destroy(Request $request){   
    CreditPurchase::where('id',$request->creditPurchaseId)->delete();
    CreditPurchaseItem::where('credit_puchase_id',$request->creditPurchaseId)->delete();
    }
}
