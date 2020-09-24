<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Banner;

class BannersController extends Controller
{
    
    public function index()
    {
        $title = "Manage All Advertisement";
        $banners = Banner::all();
        return view('admin.banners.index')->with(compact('title','banners'));
    }

    
    public function destroy(Banner $banner, Request $request)
    {
        if($request->ajax())
        {
            $banner->delete();
            print_r(1);       
            return;
        }

        $banner->delete();
        return redirect(route('banners.index')) -> with( 'message', 'Deleted Successfully');
    }

    public function addbanner()
    {
        $title = "Create New Advertisement";
        return view('admin.banners.addbanners')->with(compact('title','banners'));
    }

     public function savebanner(Request $request){
        $this->validate(request(), [
            'bannerImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'               
        ]);

         if (isset($request->bannerImage)) {
            $width = '200';
            $height = '200';
            $bannerImage = \App\HelperClass::UploadImage($request->bannerImage,'banners','images/banners/',@$width,@$height);
        }

        $banner = Banner::create( [     
            'title' => $request->title,
            'bannerImage' => @$bannerImage,              
            'urlLink' => $request->urlLink,
            'bannerStatus' => $request->bannerStatus, 
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy,           
        ]);

        return redirect(route('banners.index'))->with('msg','banner Added Successfully');     
    }

    public function editbanner($id)
    {
        $title = "Edit Advertisement";
        $banners = Banner::where('id',$id)->first();
        return view('admin.banners.updatebanners')->with(compact('title','banners'));
    }

    public function updatebanner(Request $request){
        $bannerId = $request->bannerId;

        $banner = Banner::find($bannerId);
        if (isset($request->bannerImage)) {
            @unlink($banner->bannerImage);
            $width = '200';
            $height = '200';
            $bannerImage = \App\HelperClass::UploadImage($request->bannerImage,'banners','images/banners/',@$width,@$height);
            $banner->update( [
                'bannerImage' => $bannerImage,          
            ]);
        }

        $banner->update( [
            'title' => $request->title,              
            'urlLink' => $request->urlLink,              
            'bannerStatus' => $request->bannerStatus,
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy,          
        ]);

        return redirect(route('banners.index'))->with('msg','Banner Updated Successfully');     
    }

     public function status($id)
    {  
        $bannerId = $_GET['bannerId'];
        $data = Banner::find($bannerId);
        $data->bannerStatus = $data->bannerStatus ^ 1;
        $data->update();
        print_r(1);       
        return;

    }

    public function deleteBanner(Request $request){
        $banner = Banner::where('id',$request->bannerId)->first();
        @unlink($banner->bannerImage);
        $banner->delete();
        return redirect(route('banners.index'))->with('msg','Banner Deleted Successfully');
    }

}
