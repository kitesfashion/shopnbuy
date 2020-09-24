<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryZone;

class DeliveryZoneController extends Controller
{
    public function index()
    {
        $deliveryZoneList = DeliveryZone::all();
        $title = 'Manage Delivery Zone';
        return view('admin.deliveryZone.index')->with(compact('deliveryZoneList','title'));
    }

    public function add(){
        $title = 'Add Delivery Zone';
        return view('admin.deliveryZone.add')->with(compact('title'));
    }

     public function save(Request $request){
        $this->validate(request(), [
             'name' => 'required|unique:zone',                  
        ]);
        $DeliveryZone = DeliveryZone::create( [         
            'name' => $request->name,                           
        ]);

       return redirect(route('deliveryZone.index'))->with('msg','Delivery Zone Added Successfully');     
    }

     public function edit($id){
        $deliveryZone = DeliveryZone::where('id',$id)->first();
        $title = 'Edit Delivery Zone';
        return view('admin.deliveryZone.edit')->with(compact('deliveryZone','title'));
    }

     public function update(Request $request){
     	$this->validate(request(), [
             'name' => 'required',                   
        ]);
        $deliveryZoneId = $request->deliveryZoneId;
        $deliveryZone = DeliveryZone::find($deliveryZoneId);

        $deliveryZone->update( [
            'name' => $request->name,                        
        ]);

        return redirect(route('deliveryZone.index'))->with('msg','Delivery Zone Updated Successfully');     
    }

    public function destroy(Request $request)
    {   
        DeliveryZone::where('id',$request->deliveryZoneId)->delete();
       
    }
}

