<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Blog;
use DB;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    
    public function index()
    {
        $articles = Blog::all();
        $title = 'Manage All Blog';
        return view('admin.blogs.index')->with(compact('articles','title'));
    }

    public function status(Request $request)
    {
        if($request->ajax())
        {   
            $data = Blog::find($request->blogId);
            $data->articleStatus = $data->articleStatus ^ 1;
            $data->update();
            print_r(1);       
            return;
        }
    }
    
     public function addblog(){
        $categories = blog::all();
        $title = 'Add New Blog';
        return view('admin.blogs.addblog')->with(compact('categories','title'));
    }

     public function saveblog(Request $request){
        if (isset($request->firstHomeImage)) {
            $firstHomeImage = \App\HelperClass::UploadImage($request->firstHomeImage,'blogs','public/uploads/blogs/home/');
        }

         if (isset($request->firstInnerImage)) {
            $firstInnerImage = \App\HelperClass::UploadImage($request->firstInnerImage,'blogs','public/uploads/blogs/inner_page/');
        }

       $articles = Blog::create( [   
            'firstHomeTitle' => @$request->firstHomeTitle,
            'secondHomeTitle' => @$request->secondHomeTitle,
            'firstInnerTitle' => @$request->firstInnerTitle,
            'secondInnerTitle' => @$request->secondInnerTitle,
            'firstHomeImage' => @$firstHomeImage,
            'firstInnerImage' => @$firstInnerImage,
            'homeDescription' => $request->homeDescription,
            'innerDescription' => $request->innerDescription,
            'urlLink' => $request->urlLink,
            'articleIcon' => $request->articleIcon,
            'metaTitle' => $request->metaTitle,            
            'metaKeyword' => $request->metaKeyword,            
            'metaDescription' => $request->metaDescription,            
            'orderBy' => $request->orderBy, 
            'articleStatus' => $request->articleStatus,      
        ]); 

        
        return redirect(route('blogs.index'))->with('msg','Blog Added Successfully');     
    }

  
    public function editBlog($id){
        $articles = Blog::find($id);
        $title = 'Edit Blog';
        return view('admin.blogs.updateblog')->with(compact('articles','title'));
    }


    public function updateBlog(Request $request,$id){
        $articles = Blog::find($id);
        if (isset($request->firstHomeImage)) {
                @unlink($articles->firstHomeImage);
                $firstHomeImage = \App\HelperClass::UploadImage($request->firstHomeImage,'blogs','public/uploads/blogs/home/');
                $articles->update( [
                    'firstHomeImage' => $firstHomeImage, 
                    ]);
            }

            if (isset($request->firstInnerImage)) {
                 @unlink($articles->firstInnerImage);
                 $firstInnerImage = \App\HelperClass::UploadImage($request->firstInnerImage,'blogs','public/uploads/blogs/inner_page/');
                $articles->update( [
                    'firstInnerImage' => $firstInnerImage,
                    ]);
            }
            $articles->update( [
                'firstHomeTitle' => @$request->firstHomeTitle,
                'secondHomeTitle' => @$request->secondHomeTitle,
                'firstInnerTitle' => @$request->firstInnerTitle,
                'secondInnerTitle' => @$request->secondInnerTitle,
                'homeDescription' => $request->homeDescription,
                'innerDescription' => $request->innerDescription,
                'urlLink' => $request->urlLink,
                'articleIcon' => $request->articleIcon,
                'metaTitle' => $request->metaTitle,            
                'metaKeyword' => $request->metaKeyword,            
                'metaDescription' => $request->metaDescription,            
                'orderBy' => $request->orderBy, 
                'articleStatus' => $request->articleStatus,          
            ]);

        return redirect(route('blogs.index'))->with('msg','Blog Updated Successfully');     
    }

    //Delete blog from update page

    public function deleteBlog($id){

        Blog::where('id',$id)->delete();

        return redirect(route('blogs.index')) -> with( 'msg', 'Deleted Successfully');
    }

    public function delete(Request $request,$id = NULL)
        {   
            if($request->blogId){
                $blogId = $request->blogId; 
            }else{
                $blogId = $id;
            }
            $blogs = Blog::find($blogId);
            @unlink($blogs->firstHomeImage);
            @unlink($blogs->firstInnerImage);
            Blog::where('id',$blogId)->delete(); 
            return redirect(route('blogs.index'))->with('msg','Blog Deleted Successfully');
        }

   
}
