<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\DeliveryZone;
use App\Area;
use App\ShippingCharges;

class ShippingChargeController extends Controller
{
    
    public function index()
    {
        $title = "Shipping Charge Configuration";
        $shippingCharges = ShippingCharges::all();

        return view('admin.shippingCharges.index')->with(compact('title','shippingCharges'));
    }

    public function shippingChargeStatus(Request $request)
    {
        if($request->ajax())
        {   
            $data = ShippingCharges::find($request->charge_id);
            $data->shippingStatus = $data->shippingStatus ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
        return redirect(route('shippingCharges.index')) -> with( 'message', 'Wrong move!');
    }

     public function addcharge(){
        $title = "Create Shipping Charge Configuration";
        $deliveryZoneList = DeliveryZone::all();
        return view('admin.shippingCharges.addcharge')->with(compact('title','deliveryZoneList'));
    }

     public function savecharge(Request $request){

        $this->validate(request(), [      
            'delivery_zone_id' => 'required',        
            'delivery_area_id' => 'required',        
        ],
            [
                'delivery_zone_id.required' => 'You must select deivery zone',
                'delivery_area_id.required' => 'You must select deivery area',
            ]
        );

        $shipping_charge = ShippingCharges::create( [     
            'delivery_zone_id' => $request->delivery_zone_id,            
            'delivery_area_id' => $request->delivery_area_id,            
            'shippingCharge' => $request->shippingCharge,             
            'orderBy' => @$request->orderBy,           
            'shippingStatus' => $request->shippingStatus,           
        ]);
        return redirect(route('shippingCharges.index'))->with('msg','Shipping Charge Added Successfully');     
    }

  
    public function editCharge($id){
        $title = "Edit Shipping Charge Configuration";
        $shipping_charges = ShippingCharges::where('id',$id)->first();
        $deliveryZoneList = DeliveryZone::all();
        $deliveryAreaList = Area::where('delivery_zone_id',$shipping_charges->delivery_zone_id)->get();
        return view('admin.shippingCharges.updatecharge')->with(compact('title','deliveryZoneList','deliveryAreaList','shipping_charges'));
    }


    public function updateCharge(Request $request){
       $this->validate(request(), [      
            'delivery_zone_id' => 'required',        
            'delivery_area_id' => 'required',        
        ],
            [
                'delivery_zone_id.required' => 'You must select deivery zone',
                'delivery_area_id.required' => 'You must select deivery area',
            ]
        );
        $chargeId = $request->chargeId;

        $shipping_charge = ShippingCharges::find($chargeId);
    
        $shipping_charge->update( [
            'delivery_zone_id' => $request->delivery_zone_id,            
            'delivery_area_id' => $request->delivery_area_id,            
            'shippingCharge' => $request->shippingCharge,             
            'orderBy' => @$request->orderBy,           
            'shippingStatus' => $request->shippingStatus,      
        ]);

        return redirect(route('shippingCharges.index'))->with('msg','Shipping Charge Updated Successfully');     
    }

    //Delete Category from update page

    public function deleteCharge($id){

        ShippingCharges::where('id',$id)->delete();

        return redirect(route('shippingCharges.index')) -> with( 'msg', 'Deleted Successfully');
    }


    public function destroy(Request $request)
    {   
        ShippingCharges::where('id',$request->charge_id)->delete();

    }

    public function GetDeliveryArea(Request $request){
        $areaList = Area::where('delivery_zone_id',$request->delivery_zone_id)->get();
        $data = "";
        $data .= '<option value="">Select Delivery Area</option>';
        foreach ($areaList as $area) {
            $data .= '<option value="'.$area->id.'">'.$area->name.'</option>';
        }

        return response()->json([
            'area'=>$data
        ]);
    }

}
