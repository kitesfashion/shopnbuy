<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\CashSale;
use App\CashSaleItem;
use DB;

class CashSaleController extends Controller
{
    public function index()
    {   
    	$title = "Cash Sale";
        if($this->deliveryZoneId){
    	   $cashSales = CashSale::orderBy('id','DESC')
                ->where('delivery_zone_id',$this->deliveryZoneId)
                ->get();
        }else{
           $cashSales = CashSale::orderBy('id','DESC')->get(); 
        }
    	return view('admin.cashSale.index')->with(compact('title','cashSales'));
    }

    public function add()
    {
    	$title = "Cash Sale";
    	$products = Product::where('status',1)->get();

        $cash_sale_id = CashSale::whereRaw('id = (select max(`id`) from cash_sales)')->first();

        if(!$cash_sale_id)
        {
            $random_no = 1;
        }
        else
        {
            $random_no = $cash_sale_id->id+1;
        }

    	$invoice_no = vsprintf("%04d-%04d-%04d",str_split(sprintf("%012d", $random_no), 4));

    	return view('admin.cashSale.add')->with(compact('title','products','invoice_no'));
    }

    public function save(Request $request)
    {
        $invoice_date = date('Y-m-d', strtotime($request->invoice_date));
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");

        $this->validate(request(), [
        	'invoice_no' => 'required',
        	'invoice_date' => 'required',
        	'customer_paid' => 'required',
        ]);

        // $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit();

        $cashSale = CashSale::create( [
            'invoice_no' => $request->invoice_no,            
            'invoice_date' => $invoice_date,            
            'invoice_amount' => $request->total_amount,            
            'discount_as' => $request->discount_percentage,            
            'discount_amount' => $request->discount,            
            'vat_amount' => $request->vat,            
            'net_amount' => $request->net_amount,
            'customer_paid' => $request->customer_paid,               
            'change_amount' => $request->change_amount, 
            'payment_type' => $request->payment_type,
            'delivery_zone_id' => $this->deliveryZoneId,                  
        ]);

        $countProduct = count($request->product_id);

        if($request->product_id){
            $postData = [];
            for ($i=0; $i <$countProduct ; $i++) { 
                $postData[] = [
                    'cash_sale_id'=> $cashSale->id,
                    'invoice_no'=> $request->invoice_no,
                    'item_id' => $request->product_id[$i],
                    'item_quantity' => $request->qty[$i], 
                    'item_rate' => $request->rate[$i],
                    'item_price' => $request->amount[$i],
                    'delivery_zone_id' => $this->deliveryZoneId, 
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
            }                
            CashSaleItem::insert($postData);
        }

        return redirect(route('cashSale.index'))->with('msg','Cash Sale Added Successfully');
    }

    public function edit($id)
    {
    	$title = "Cash Sale";
    	$products = Product::where('status',1)->get();
    	$cashSale = CashSale::where('id',$id)->first();
    	$cashSaleId = $id;

    	$cashSaleItems = CashSaleItem::select('cash_sale_items.*','products.name as product_name','products.id as product_id')
    		->join('products','products.id','=','cash_sale_items.item_id')
    		->where('cash_sale_items.cash_sale_id',$id)->get();

    	return view('admin.cashSale.edit')->with(compact('title','products','cashSale','cashSaleItems','cashSaleId'));
    }

    public function update(Request $request)
    {
        $invoice_date = date('Y-m-d', strtotime($request->invoice_date));
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $case_sale_id = $request->cash_sale_id;

        $this->validate(request(), [
        	'invoice_no' => 'required',
        	'invoice_date' => 'required',
        	'customer_paid' => 'required',
        ]);

        // $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // exit();

        $cashSale = CashSale::find($case_sale_id);

        $cashSale->update( [
            'invoice_no' => $request->invoice_no,            
            'invoice_date' => $invoice_date,            
            'invoice_amount' => $request->total_amount,            
            'discount_as' => $request->discount_percentage,            
            'discount_amount' => $request->discount,            
            'vat_amount' => $request->vat,            
            'net_amount' => $request->net_amount,
            'customer_paid' => $request->customer_paid,               
            'change_amount' => $request->change_amount, 
            'payment_type' => $request->payment_type,                  
        ]);

        $countProduct = count($request->product_id);
        DB::table('cash_sale_items')->where('cash_sale_id', $case_sale_id)->delete();

        if($request->product_id){
            $postData = [];
            for ($i=0; $i <$countProduct ; $i++) { 
                $postData[] = [
                    'cash_sale_id'=> $cashSale->id,
                    'invoice_no'=> $request->invoice_no,
                    'item_id' => $request->product_id[$i],
                    'item_quantity' => $request->qty[$i], 
                    'item_rate' => $request->rate[$i],
                    'item_price' => $request->amount[$i],
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ];
            }                
            CashSaleItem::insert($postData);
        }

        return redirect(route('cashSale.index'))->with('msg','Cash Sale Update Successfully');    	
    }

    public function destroy(Request $request)
    {
    	CashSale::where('id',$request->cashSaleId)->delete();
    	CashSaleItem::where('cash_sale_id',$request->cashSaleId)->delete();
    }
}
