<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/').@$information->adminfavIcon }}">
    <title>{{@$information->adminTitle}} @if(@$title)- {{@$title}} @endif</title>
    <link rel="icon" type="image/png" sizes="20x20" href="{{ asset('/').@$information->adminfavIcon }}">

    <style type="text/css">
    .modal {
        position: absolute;
        top: 10px;
        right: 100px;
        bottom: 0;
        left: 0;
        z-index: 10040;
        overflow: auto;
        overflow-y: auto;
    }
</style>

@include('admin.partials.header-assets')
@yield('custom-css')
</head>
<?php
    use App\UserMenu;
    use App\UserMenuActions;
    use App\UserRoles;
        $roleId =  Auth::user()->role;
        $userRoles = UserRoles::where('id',$roleId)->first();
        $rolePermission = explode(',', $userRoles->actionPermission);

        $routeName = \Request::route()->getName();
        $userMenus = UserMenu::where('menuLink',$routeName)->first();

        $actions = UserMenuActions::where('actionLink',$routeName)->first();

        //Link for add new button and go back
        if(@$userMenus){
            $addActions = UserMenuActions::where('parentmenuId',@$userMenus->id)->where('menuType',1)->first();
            $Menu = UserMenu::where('id',@$addActions->parentmenuId)->first();
        }else{
            $userMenuActionsAdd = UserMenuActions::where('actionLink',$routeName)->first();
            $addActions = UserMenuActions::where('parentmenuId',@$userMenuActionsAdd->parentmenuId)->where('menuType',1)->first();

            $Menu = UserMenu::where('id',@$userMenuActionsAdd->parentmenuId)->first();
            if(@$Menu->menuLink){
              $goBackActions = route(@$Menu->menuLink);  
            }
            
        }
                
    //Condition for go back link
    if(@$routeName != "admin.index"){
        $goBackLink = 'onclick="goBack()"';
    }
?>

<style type="text/css">
    @if (@$Menu->menuLink)
        @if ($routeName != @$Menu->menuLink)
            .card-body form{
                border: 2px solid #f3bfbf;
                padding: 15px;
            }
        @endif
    @endif
</style>
<body class="skin-default fixed-layout">
    @include('admin.partials.preloader')

    <div id="main-wrapper">
        <header class="topbar">
            @include('admin.partials.top-navbar')
        </header>
         
        @include('admin.partials.menu')
       
        <div class="page-wrapper">
            
            <div class="container-fluid">
               
                @yield('bread-crumb')


                <div style="padding-bottom: 10px;"></div>

                @php
                    $message = Session::get('msg');
                @endphp

                @if (isset($message))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong style="font-weight: bold;color: #0daf3f;font-size: 16px;">
                            Success!
                        </strong> 
                        <strong style="font-weight: bold;color: #097d6a;">
                            {{ $message }}
                        </strong>
                    </div>
                @endif

                @php
                    Session::forget('msg');
                @endphp

                @if( count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong style="font-weight: bold;color: #e4280a;font-size: 16px;">
                            Oops!
                        </strong> 
                        <strong style="font-weight: bold;color: #ca0c0c;;">
                            {{ $errors->first() }}
                        </strong>
                    </div>
                @endif

                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6"><h4 class="card-title">{{ @$title }}</h4></div>
                                <div class="col-md-6 text-right">
                                    <span class="shortlink">
                                        <?php
                                            if ($routeName != @$Menu->menuLink) { 
                                        ?>
                                            <a class="btn btn-success" <?php echo @$goBackLink ?>>
                                                    <i class="fa fa-arrow-left"></i> 
                                                Go Back
                                            </a>
                                    <?php } ?>

                                        <?php
                                            if(in_array(@$addActions->id, @$rolePermission)){
                                                if ($userMenus || @$actions->menuType == 2) { 
                                        ?>
                                        <a class="btn btn-primary" href="{{route(@$addActions->actionLink)}}">
                                            <i class="fa fa-plus-circle"></i> 
                                             Add New
                                        </a>
                                    <?php } } ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Card Body Content -->
                            @yield('content')

                        </div>
                    </div>
              
                @include('admin.partials.right-sidebar')
               
            </div>
          
        </div>
        
        <footer class="footer">
            {{Date('Y')}} Developed by <a target="_blank" href="http://www.technoparkbd.com/">Techno Park</a>
           
        </footer>
        

    </div>
   


    @include('admin.partials.footer-assets')


    @yield('custom-js')

</body>
</html>