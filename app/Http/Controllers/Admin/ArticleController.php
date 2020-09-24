<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Menu;

class ArticleController extends Controller
{
    public function index()
    {
        $title = 'Manage All Articles';
        $parentArticleParam = @$_GET['parentArticle'];
        $parentArticleList = Article::all(); 
        if($parentArticleParam){
            $articles = Article::where('parentArticle',$parentArticleParam)->orWhere('id',$parentArticleParam)->get(); 
        }else{
            $articles = Article::all();  
        }
        return view('admin.articles.index')->with(compact('title','parentArticleList','parentArticleParam','articles'));
    }

    public function add(Request $request){
        $title = 'Add Article';
        $articleList = Article::orderBy('id',"ASC")->get();
        $menus = Menu::orderBy('id',"ASC")->get();
        if(count($request->all()) > 0){
            $existArticleCheck =Article::where('parentArticle',$request->parentArticle)->where('articleName',$request->articleName)->first();
            if(@$existArticleCheck) {
                $this->validate(request(), [
                    'articleName' => 'required|unique:articles'
                ]);
            }
            $this->validate(request(), [
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            if (isset($request->firstHomeImage)) {
                $width = '800';
                $height = '540';
                $firstHomeImage = \App\HelperClass::UploadImage($request->firstHomeImage,'articles','public/uploads/articles/home/',@$width,@$height);
            }

             if (isset($request->firstInnerImage)) {
                $firstInnerImage = \App\HelperClass::UploadImage($request->firstInnerImage,'articles','public/uploads/articles/inner_page/');
            }

            if($request->menuName){
                $menu = Menu::create( [     
                'root_menu' => @$rootMenu,
                'parent' => $request->parentMenu,
                'menuName' => $request->menuName,
                'articleName' => $request->articleName,
                'firstHomeTitle' => $request->firstHomeTitle,
                'firstHomeImage' => @$firstHomeImage,
                'homeDescription' => $request->homeDescription,
                'urlLink' => $request->urlLink,
                'metaTitle' => $request->metaTitle,            
                'metaKeyword' => $request->metaKeyword,            
                'metaDescription' => $request->metaDescription,            
                'orderBy' => $request->orderBy, 
                'menuStatus' => '1',       
                'showInMenu' => 'yes',       
                ]);
            }

            $articles = Article::create( [   
                'menuId' => @$menu->id,  
                'parentArticle' => $request->parentArticle,  
                'articleName' => @$request->articleName,
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

           return redirect(route('articles.index',['parentArticle'=>$request->parentArticle]))->with('msg','Article Created Successfully');
        }else{
            return view('admin.articles.add')->with(compact('title','articleList','menus'));
        } 
    }

    public function edit(Request $request, $id=NULL){
        $title = 'Edit Article';
        $articleList = Article::orderBy('id',"ASC")->get();
        $menus = Menu::orderBy('id',"ASC")->get();
        $articles = Article::find($id);
        if(count($request->all()) > 0){
            if (isset($request->firstHomeImage)) {
                @unlink($articles->firstHomeImage);
                $width = '800';
                $height = '540';
                $firstHomeImage = \App\HelperClass::UploadImage($request->firstHomeImage,'articles','public/uploads/articles/home/',@$width,@$height);
                $articles->update( [
                    'firstHomeImage' => $firstHomeImage, 
                    ]);
            }

            if (isset($request->firstInnerImage)) {
                 @unlink($articles->firstInnerImage);
                 $firstInnerImage = \App\HelperClass::UploadImage($request->firstInnerImage,'articles','public/uploads/articles/inner_page/');
                $articles->update( [
                    'firstInnerImage' => $firstInnerImage,
                    ]);
            }
            $existMenuCheck = Menu::where('parent',$request->parentMenu)->where('menuName',$request->articleName)->first();
            if(!@$existMenuCheck){
                if($request->parentMenu && $articles->menuId == ''){
                    if($request->parentMenu){
                        $getRootMenu = Menu::where('id',$request->parentMenu)->first();
                    }
                    if(@$getRootMenu->parentMenu !=''){
                        $rootMenu = $getRootMenu->parentMenu;
                    }else{
                        $rootMenu = $request->parentMenu;
                    }
                    $menu = Menu::create( [     
                    'root_menu' => @$rootMenu,
                    'parent' => $request->parentMenu,
                    'menuName' => $request->menuName,
                    'articleName' => $request->articleName,
                    'firstHomeTitle' => $request->firstHomeTitle,
                    'firstHomeImage' => @$firstHomeImage,
                    'homeDescription' => $request->homeDescription,
                    'urlLink' => $request->urlLink,
                    'metaTitle' => $request->metaTitle,            
                    'metaKeyword' => $request->metaKeyword,            
                    'metaDescription' => $request->metaDescription,             
                    'orderBy' => $request->orderBy,
                    'menuStatus' => '1',       
                    'showInMenu' => 'yes',       
                    ]);

                    $articles->update( [
                        'menuId' => @$menu->id,
                    ]);
                }
            }else{
                $articles->update( [
                        'menuId' => @$existMenuCheck->id,
                    ]);
            }

            $articles->update( [
                'parentArticle' => $request->parentArticle,
                'articleName' => @$request->articleName,
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

            return redirect(route('articles.index',['parentArticle'=>$request->parentArticle]))->with('msg','Article Updated Successfully'); 
        }else{
            return view('admin.articles.edit')->with(compact('articles','articleList','menus','title'));
        }
    }

    public function status(Request $request)
    {
        if($request->ajax())
        {   
            $data = Article::find($request->articleId);
            $data->articleStatus = $data->articleStatus ^ 1;
            $data->update();
            print_r(1);       
            return;
        }

    }

    public function delete(Request $request,$id = NULL)
    {   
        if($request->articleId){
            $articleId = $request->articleId; 
        }else{
            $articleId = $id;
        }

        $articles = Article::find($articleId);
        @unlink($articles->firstHomeImage);
        @unlink($articles->firstInnerImage);
        Article::where('id',$articleId)->delete(); 
        return redirect(route('articles.index'))->with('msg','Article Deleted Successfully');
    }
  
}
