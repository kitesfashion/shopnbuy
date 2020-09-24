<?php

namespace App\Http\Controllers\Admin;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HeaderBlock;

class HeaderBlockController extends Controller
{
    public function HeaderBlockInfo(Request $request, $section=NULL){
        $title = @$_GET['title'];
        $headerInfo = HeaderBlock::where('section',$section)->first();
        if($request->isMethod('post')){
        if(count($request->all()) > 0){
            if($headerInfo){
                if (isset($request->firstHomeImage)) {
                    @unlink($headerInfo->firstHomeImage);
                    $firstHomeImage = \App\HelperClass::UploadImage($request->firstHomeImage,'events','public/uploads/events/home/');
                    $headerInfo->update( [
                        'firstHomeImage' => $firstHomeImage, 
                        ]);
                }

                if (isset($request->firstInnerImage)) {
                     @unlink($headerInfo->firstInnerImage);
                     $firstInnerImage = \App\HelperClass::UploadImage($request->firstInnerImage,'events','public/uploads/events/inner_page/');
                    $headerInfo->update( [
                        'firstInnerImage' => $firstInnerImage,
                        ]);
                }
                $headerInfo->update( [
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
                    'section' => $request->section,           
                ]);
            }else{
                 if (isset($request->firstHomeImage)) {
                    $firstHomeImage = \App\HelperClass::UploadImage($request->firstHomeImage,'header_block','public/uploads/header_block/home/');
                }

                 if (isset($request->firstInnerImage)) {
                    $firstInnerImage = \App\HelperClass::UploadImage($request->firstInnerImage,'header_block','public/uploads/header_block/inner_page/');
                }
                 $header_block = HeaderBlock::create( [   
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
                    'section' => $request->section,        
                ]);
            }
            

            return redirect(route($section.'.index'))->with('msg','headerInfo Updated Successfully'); 
        }}else{
            return view('admin.header-block.headerBlock')->with(compact('section','headerInfo','title'));
        }
    }

}
