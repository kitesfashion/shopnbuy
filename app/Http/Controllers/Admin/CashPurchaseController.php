<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CashPurchase;
use App\CashPurchaseItem;
use App\Vendors;
use App\Product;
use DB;

class CashPurchaseController extends Controller
{
    public function index()
    {   if($this->deliveryZoneId){
            $cashPurchase = CashPurchase::select('cash_purchase.*','vendors.vendorName')
                ->join('vendors','vendors.id','=','cash_purchase.supplier_id')
                ->orderBy('vendors.vendorName','asc')
                ->where('cash_purchase.delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
            $cashPurchase = CashPurchase::select('cash_purchase.*','vendors.vendorName')
                ->join('vendors','vendors.id','=','cash_purchase.supplier_id')
                ->orderBy('vendors.vendorName','asc')
                ->get();
        }
        

        $title = 'Cash Purchase';
        return view('admin.cashPurchase.index')->with(compact('cashPurchase','title'));
    }

    public function add(){
        $vendors = Vendors::where('vendorStatus',1)->get();
        $products = Product::where('status',1)->get();
        $title = 'Cash Purchase';
        return view('admin.cashPurchase.add')->with(compact('title','vendors','products'));
    }

     public function save(Request $request)
     {
        $voucher_date = date('Y-m-d', strtotime($request->voucher_date));
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
      
        $this->validate(request(), [       
             'cash_serial' => 'required',  
             'supplier_id' => 'required',  
             'voucher_date' => 'required',  
        ]);

        $cashPurchase = CashPurchase::create( [
            'cash_serial' => $request->cash_serial,            
            'voucher_no' => $request->vouchar_no,            
            'supplier_id' => $request->supplier_id,            
            'voucher_date' => $voucher_date,            
            'total_qty' => $request->total_qty, 
            'total_amount' => $request->total_amount,  
            'delivery_zone_id' => $this->deliveryZoneId,  
            'created_at' => $created_at,
            'updated_at' => $updated_at, 
                   
        ]);

        $countProduct = count($request->product_id);
            if($request->product_id){
                $postData = [];
                for ($i=0; $i <$countProduct ; $i++) { 
                    $postData[] = [
                        'cash_puchase_id'=> $cashPurchase->id,
                        'product_id' => $request->product_id[$i],
                        'qty' => $request->qty[$i], 
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],  
                        'delivery_zone_id' => $this->deliveryZoneId,   
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ];
                }
                
                CashPurchaseItem::insert($postData);
            }

       return redirect(route('cashPurchase.index'))->with('msg','Cash Purchase Added Successfully');     
    }

    public function edit($id){
        $cashPurchase = CashPurchase::where('id',$id)->first();
        $vendors = Vendors::where('vendorStatus',1)->get();
        $products = Product::where('status',1)->get();
        $cashPurchaseItem = CashPurchaseItem::where('cash_puchase_id',$id)->get();
        $title = 'Edit Cash Purchase';
        return view('admin.cashPurchase.edit')->with(compact('cashPurchase','title','vendors','products','cashPurchaseItem'));
    }

     public function update(Request $request){
        $voucher_date = date('Y-m-d', strtotime($request->voucher_date));
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
      
        $this->validate(request(), [       
             'cash_serial' => 'required',  
             'supplier_id' => 'required',  
             'voucher_date' => 'required',  
        ]);
        $cashPurchaseId = $request->cashPurchaseId;
        $cashPurchase = CashPurchase::find($cashPurchaseId);

        $cashPurchase->update( [            
            'voucher_no' => $request->voucher_no,            
            'supplier_id' => $request->supplier_id,            
            'voucher_date' => $voucher_date,            
            'total_qty' => $request->total_qty, 
            'total_amount' => $request->total_amount,  
            'created_at' => $created_at,
            'updated_at' => $updated_at,         
        ]);

        $countProduct = count($request->product_id);
         DB::table('cash_purchase_item')->where('cash_puchase_id', $cashPurchaseId)->delete();
        if($request->product_id){
                $postData = [];
                for ($i=0; $i <$countProduct ; $i++) { 
                    $postData[] = [
                        'cash_puchase_id'=> $cashPurchase->id,
                        'product_id' => $request->product_id[$i],
                        'qty' => $request->qty[$i], 
                        'rate' => $request->rate[$i],
                        'amount' => $request->amount[$i],  
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ];
                }
                
                CashPurchaseItem::insert($postData);
            }

        return redirect(route('cashPurchase.index'))->with('msg','Cash Purchase Updated Successfully');     
    }


public function destroy(Request $request){   
    CashPurchase::where('id',$request->cashPurchaseId)->delete();
    CashPurchaseItem::where('cash_puchase_id',$request->cashPurchaseId)->delete();
    }
}
