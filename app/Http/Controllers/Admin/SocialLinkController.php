<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\SocialLink;
use App\Category;

class SocialLinkController extends Controller
{     public function index()
    {
        $socials_links = SocialLink::all();
        $title = 'Manage All Social Links';
        return view('admin.socials_links.index')->with(compact('socials_links','title'));
    }

    public function add(Request $request){
        $title = 'Add New Social Link';
        if(count($request->all()) > 0){
            
           $social = SocialLink::create( [     
                'name' => $request->name,                              
                'icon' => $request->icon,                              
                'link' => $request->link,                              
                'orderBy' => $request->orderBy,
                'status' => $request->status,      
            ]); 

           return redirect(route('social.index'))->with('msg','Icon Created Successfully');
        }else{
            return view('admin.socials_links.add')->with(compact('title'));
        }
        
    }

    public function edit(Request $request, $id=NULL){
        $title = 'Edit Social Link';
        $social = SocialLink::find($id);
        if(count($request->all()) > 0){
            $social->update( [
                'name' => $request->name,                              
                'icon' => $request->icon,                              
                'link' => $request->link,                              
                'orderBy' => $request->orderBy,
                'status' => $request->status,         
            ]);

            return redirect(route('social.index'))->with('msg','Social Link Updated Successfully'); 
        }else{
            return view('admin.socials_links.edit')->with(compact('social','title'));
        }
    }


    public function status(Request $request)
    {
        if($request->ajax())
        {   
            $data = SocialLink::find($request->socialId);
            $data->status = $data->status ^ 1;
            $data->update();
            return;
        }
    }

    public function delete(Request $request,$id = NULL)
    {   
        if($request->socialId){
            $socialId = $request->socialId; 
        }else{
            $socialId = $id;
        }
        SocialLink::where('id',$socialId)->delete();
        return redirect(route('social.index'))->with('msg','Category Successfully'); 
    }

}
