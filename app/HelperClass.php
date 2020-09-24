<?php

namespace App;

use Intervention\Image\ImageManagerStatic as Image;
use  File;

class HelperClass
{
    public static function _uploadImage($file)
    {
        $data = getimagesize($file);
        $width = $data[0];
        $height = $data[1];

        $logoName = date("Y_m_d_H_i_s_u").'-'.str_random(20);
        $logoExtension = $file->getClientOriginalExtension();

        if($logoExtension=='pdf' || $logoExtension=='doc' || $logoExtension=='docx' ){

            $directory = 'public/uploads/cv/'.date('Y_m_d').'/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$logoName.$logoExtension");
            return $directory.($logoName.'.'.$logoExtension);
        }

        $directory = 'public/uploads/images/'.date('Y_m_d').'/';
        if(!file_exists ($directory))
            mkdir($directory);
        $logoUrl = $directory.($logoName.'.'.$logoExtension);
        Image::make($file)->resize(min(1200,$width) , min(800,$height))->save($logoUrl);  
        return $logoUrl;
    }

    public static function _sliderImage($file)
    {
        $data = getimagesize($file);
        $width = $data[0];
        $height = $data[1];

        $logoName = date("Y_m_d_H_i_s_u").'-'.str_random(20);
        $logoExtension = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();

        if($logoExtension=='pdf' || $logoExtension=='doc' || $logoExtension=='docx' ){

            $directory = 'public/uploads/cv/'.date('Y_m_d').'/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$logoName.$logoExtension");
            return $directory.($logoName.'.'.$logoExtension);
        }

        $directory = 'public/uploads/slider_image/';
        if(!file_exists ($directory))
            mkdir($directory);
        $logoUrl = $directory.($name);
        Image::make($file)->resize(min(1200,$width) , min(800,$height))->save($logoUrl);  
        return $logoUrl;
    }

    public static function _bannerImage($file)
    {
        $data = getimagesize($file);
        $width = $data[0];
        $height = $data[1];

        $logoName = date("Y_m_d_H_i_s_u").'-'.str_random(20);
        $logoExtension = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();

        if($logoExtension=='pdf' || $logoExtension=='doc' || $logoExtension=='docx' ){

            $directory = 'public/uploads/cv/'.date('Y_m_d').'/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$logoName.$logoExtension");
            return $directory.($logoName.'.'.$logoExtension);
        }

        $directory = 'public/uploads/banner_image/';
        if(!file_exists ($directory))
            mkdir($directory);
        $logoUrl = $directory.($name);
        Image::make($file)->resize(min(1200,$width) , min(800,$height))->save($logoUrl);  
        return $logoUrl;
    }

    public static function _blogImage($file)
    {
        $data = getimagesize($file);
        $width = $data[0];
        $height = $data[1];

        $logoName = date("Y_m_d_H_i_s_u").'-'.str_random(20);
        $logoExtension = $file->getClientOriginalExtension();
        $name = $file->getClientOriginalName();

        if($logoExtension=='pdf' || $logoExtension=='doc' || $logoExtension=='docx' ){

            $directory = 'public/uploads/cv/'.date('Y_m_d').'/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$logoName.$logoExtension");
            return $directory.($logoName.'.'.$logoExtension);
        }

        $directory = 'public/uploads/blog_image/';
        if(!file_exists ($directory))
            mkdir($directory);
        $logoUrl = $directory.($name);
        Image::make($file)->resize(min(1200,$width) , min(800,$height))->save($logoUrl);  
        return $logoUrl;
    }

    public static function _vendorImage($file)
    {
        $data = getimagesize($file);
        $width = $data[0];
        $height = $data[1];

        $logoName = date("Y_m_d_H_i_s_u").'-'.str_random(20);
        $logoExtension = $file->getClientOriginalExtension();

        if($logoExtension=='pdf' || $logoExtension=='doc' || $logoExtension=='docx' ){

            $directory = 'public/uploads/cv/'.date('Y_m_d').'/';
            if(!file_exists ($directory))
            mkdir($directory);
            move_uploaded_file($file, "$directory$logoName.$logoExtension");
            return $directory.($logoName.'.'.$logoExtension);
        }

        $directory = 'public/uploads/vendor/';
        if(!file_exists ($directory))
            mkdir($directory);
        $logoUrl = $directory.($logoName.'.'.$logoExtension);
        Image::make($file)->resize(min(1200,$width) , min(800,$height))->save($logoUrl);  
        return $logoUrl;
    }

    /*This is last modified function for upload any image*/
    public static function UploadImage($file,$table=null,$directory=null,$width=null,$height=null)
    {   
        $lastData = \DB::table($table)->find(\DB::table($table)->max('id'));
        if(@$lastData){
            $maxId = $lastData->id+1+rand(100000000,99999999999);
        }else{
           $maxId = '1'.+rand(100000000,99999999999); 
        }
        
        $data = getimagesize($file);
        $filename = $file->getClientOriginalName(); 
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $logoExtension = $file->getClientOriginalExtension();
       if (!File::exists($directory)) {
            File::makeDirectory($directory, 0775, true, true);
        }
        $logoUrl = $directory.($name.'_'.$maxId.'.'.$logoExtension);
        if(@$width == null && @$height == null){
            move_uploaded_file($file, "$directory$name".'_'.$maxId.'.'."$logoExtension");
        }
        if(@$width != null && @$height != null){
            Image::make($file)->resize($width, $height)->save($logoUrl);
        }
        return $logoUrl;
    }
}
