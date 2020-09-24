<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Article;
use App\Menu;

class PageController extends Controller
{
  public function Page($menuName,$menuId){ 
    $customerId = Session::get('customerId');

    $menu = Menu::where('id',$menuId)->first();
    if($menuId == 8){
      if(isset($customerId)){
        return redirect(route('customer.order'));
      }else{
        return view('frontend.order.shippingEmail');
      }
      
    }else{
      $article = Article::where('menuId',$menu->id)->first();
      $title = $menu->menuName;
      $metaTag =[
          'meta_keyword'=>$article->metaKeyword,
          'meta_title' =>$article->metaTitle,
          'meta_description' =>$article->metaDescription
       ];
      return view('frontend.pages.page_content')->with(compact('metaTag','title','menu','article'));
    }
    
  }

}
