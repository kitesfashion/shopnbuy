<?php

namespace App\Providers;
use DB;
use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Settings;
use App\Category;
use App\SocialLink;
use App\UserMenu;
use App\UserMenuActions;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('*',function($siteInfo){
            $information = Settings::where('id',1)->first();
            $siteInfo->with('information',$information);
        });

        View::composer('*',function($socialInfo){
            $socialLink = SocialLink::where('status',1)->get();
            $socialInfo->with('socialLink',$socialLink);
        });

        /*View::composer('*',function($others){
            $othersInfo = OtherInformation::first();
            $others->with('othersInfo',$othersInfo);
        });*/

        View::composer('*',function($blankImage){
            $blank = asset('/public/frontend/no-image-icon.png');
            $blankImage->with('noImage',$blank);
        });

        View::composer('*',function($categories){
            $publishedCategories = Category::where('parent',NULL)->where('categoryStatus',1)->orderBy('orderBy','ASC')->orderBy('categoryName','ASC')->get();
            $categories->with('publishedCategories',$publishedCategories);
        });

         //Link for Add New Button
        View::composer('*',function($addLink){
            $routeName = \Request::route()->getName();
            $userMenus = UserMenu::where('menuLink',$routeName)->first();
            $userMenuAction = UserMenuActions::where('parentmenuId',@$userMenus->id)->where('menuType',1)->first();
            $addLink->with('addNewLink',@$userMenuAction->actionLink);
        });

        //Link for Go Back
        View::composer('*',function($backLink){
            $routeName = \Request::route()->getName();
            $userMenuAction = UserMenuActions::where('actionLink',@$routeName)->first();
            $userMenu = UserMenu::where('id',@$userMenuAction->parentmenuId)->first();
            $backLink->with('goBackLink',@$userMenu->menuLink);
        });

    }

}
