<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class SliderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $title = "Manage Sliders";
        $sliders = Slider::all();
        return view('admin.sliders.index')->with(compact('title','sliders'));
    }

    public function addslider()
    {
        $title = "Add New Slider";
        return view('admin.sliders.addslider')->with(compact('title'));
    }

    public function saveslider(Request $request){
       
        $this->validate(request(), [
            'sliderImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'             
        ]);

        if (isset($request->sliderImage)) {
            $width = '1024';
            $height = '360';
            $sliderImage = \App\HelperClass::UploadImage($request->sliderImage,'sliders','images/sliders/',$width,$height);
        }

        $slider = Slider::create( [     
            'title' => $request->title,
            'image' => @$sliderImage,              
            'status' => $request->status, 
            'link' => $request->link,            
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy,           
        ]);

        // $product = Product::create($request->all());

        return redirect(route('slideradd.page'))->with('msg','Slider Added Successfully');     
    }

    public function changeStatus(Request $request)
    {
        if($request->ajax())
        {   
            $data = Slider::find($request->slider_id);
            $data->status = $data->status ^ 1;
            $data->update();
            print_r(1);       
            return;
        }

        return redirect(route('sliders.index')) -> with( 'message', 'Wrong move!');
    }

    public function sliderStatus($id){
        $slider = Slider::find($id);
        if ($slider->status == 0) {
            $slider->update( [           
            'status' => '1',       
            ]);
        }else{
            $slider->update( [           
            'status' => '0',       
            ]);
        }

        return redirect(route('sliders.index')); 
    }

    public function editSlider($id)
    {
        $title = "Edit Slider";
        $sliders = Slider::where('id',$id)->first();
        return view('admin.sliders.updateslider')->with(compact('title','sliders'));
    }

    public function updateSlider(Request $request){
        $sliderId = $request->sliderId;

        $slider = Slider::find($sliderId);

        if($request->sliderImage){
            @unlink($slider->image);
            $width = '1024';
            $height = '360';
            $sliderImage = \App\HelperClass::UploadImage($request->sliderImage,'sliders','images/sliders/',$width,$height);
            $slider->update( [
                'image' => $sliderImage,          
            ]);
        }
        
        $slider->update( [
            'title' => $request->title,              
            'status' => $request->status, 
            'link' => $request->link, 
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy,        
        ]);

        return redirect(route('sliders.index'))->with('msg','slider Updated Successfully');     
    }

    public function deleteSlider($id){
        $sliderImage = Slider::find($id);
        @unlink(@$sliderImage->image);
        Slider::where('id',$id)->delete();
        return redirect(route('sliders.index'))->with('msg','Slider Deleted Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',                
        ]);



        if($request->ajax())
            {
                $image_upload = \App\HelperClass::_uploadImage($request->image);
                $slider = Slider::create([
                    'image'=>$image_upload,
                ]);
                return response()->json([
                    'slider'=>$slider,
                ]);
            } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider, Request $request)
    {
        if($request->ajax())
            {
                $slider->delete();
                print_r(1);       
                return;
            }
    }

     
}
