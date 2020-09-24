<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DeliveryZone;
use App\Area;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::orderBy('id','ASC')->get();
        $title = 'Manage Area';
        return view('admin.area.index')->with(compact('areas','title'));
    }

    public function add(){
        $title = 'Add Area';
        $deliveryZoneList = DeliveryZone::all();
        return view('admin.area.add')->with(compact('title','deliveryZoneList'));
    }

     public function save(Request $request){
        $this->validate(request(), [
             'name' => 'required',                   
             'delivery_zone_id' => 'required',                   
            ],
            [
                'delivery_zone_id.required' => 'You must select deivery zone',
            ]
        );
        $area = Area::create( [         
            'name' => $request->name,                           
            'delivery_zone_id' => $request->delivery_zone_id,                           
        ]);

       return redirect(route('area.index'))->with('msg','Area Added Successfully');     
    }

     public function edit($id){
        $title = 'Edit Area';
        $area = Area::where('id',$id)->first();
        $deliveryZoneList = DeliveryZone::all();
        return view('admin.area.edit')->with(compact('title','deliveryZoneList','area'));
    }

     public function update(Request $request){
     	$this->validate(request(), [
             'name' => 'required',                   
             'delivery_zone_id' => 'required',                   
            ],
            [
                'delivery_zone_id.required' => 'You must select deivery zone',
            ]);
        $areaId = $request->areaId;
        $area = Area::find($areaId);

        $area->update( [
            'name' => $request->name,                            
            'delivery_zone_id' => $request->delivery_zone_id,                         
        ]);

        return redirect(route('area.index'))->with('msg','Area Updated Successfully');     
    }

    public function destroy(Request $request)
    {   
        Area::where('id',$request->areaId)->delete();
       
    }
}

